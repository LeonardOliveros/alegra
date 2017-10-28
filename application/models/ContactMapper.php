<?php

class Application_Model_ContactMapper
{
  /**
   * @var string URi de la api de Alegra.com
   */
  private $_baseUri;

  /**
   * @var string URi de la api de Alegra.com incluyendo el sufijo(controlador)
   */
  private $_uri;

  /**
   * @var string Correo registrado en Alegra.com
   */
  private $_email;

  /**
   * @var string Token generado desde la configuracion
   * de Alegra.com
   */
  private $_token;

  /**
   * @var Zend_Http_Client Object cliente para la comunicacion
   */
  private $_client;

  public function __construct()
  {
    // Se obtinen las configuraciones en application.ini
    $dataBootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    // Se setea las configuraciones de configAlegra en una var
    $dataAlegra = $dataBootstrap->getOption('configAlegra');
    // Se asigna la URi a una variable privada
    $this->_baseUri = $dataAlegra['uri'];
    // Se setea el sufijo(controlador)
    $this->_uri = $this->_baseUri . '/contacts';
    // Se asigna el mail a una variable privada
    $this->_email = $dataAlegra['email'];
    // Se asigna el token a una variable privada
    $this->_token = $dataAlegra['token'];
    // Se crea una instancia de Zend_Http_Client para su posterior uso
    $this->_client = new Zend_Http_Client();
    // Se setea la URi
    $this->_client->setUri($this->_uri);
    // Se setean los datos de autenticacion
    $this->_client->setAuth($this->_email, $this->_token);
  }

  /**
   * Metodo para insertar o actualizar un contacto
   * @param {Application_Model_Contact} contact
   * @return {object} con la data del contacto o con
   * el error devuelto
   */
  public function upsert(Application_Model_Contact $contact)
  {
    $params = array(
      'id' => $contact->getId(),
      'name' => $contact->getName(),
      'identification' => $contact->getIdentification(),
      'phonePrimary' => $contact->getPhoneprimary(),
      'phoneSecondary' => $contact->getPhonesecondary(),
      'fax' => $contact->getFax(),
      'mobile' => $contact->getMobile(),
      'observations' => $contact->getObservations(),
      'email' => $contact->getEmail(),
      'priceList' => $contact->getPricelist(),
      'seller' => $contact->getSeller(),
      'term' => $contact->getTerm(),
      'address' => $contact->getAddress(),
      'type' => $contact->getType(),
      'internalContacts' => $contact->getInternalcontacts(),
    );

    if (null === ($id = $contact->getId())) {
      $this->_client->setUri($this->_uri);
      $response = $this->_client->setRawData(json_encode($params))->request('POST');
      $data = $response->getBody();
      $data = json_decode($data, true);
    } else {
      $this->_client->setUri($this->_uri . "/$id");
      $response = $this->_client->setRawData(json_encode($params))->request('PUT');
      $data = $response->getBody();
      $data = json_decode($data, true);
    }
    return $data;
  }

  /**
   * Metodo para encontrar un contacto
   * @param {int} id
   * @return {object} con la data del contacto
   */
  public function find($id)
  {
    $this->_client->setUri($this->_uri . "/$id");
    $response = $this->_client->request('GET');
    $data = $response->getBody();
    $data = json_decode($data, true);

    if (isset($data['code']) && $data['code'] !== 200) {
      return $data;
    }

    $contact = new Application_Model_Contact($data);

    return $contact;
  }

  /**
   * Metodo para encontrar todos los contactos
   * @param  {string}  type
   * @param  {string}  query
   * @param  {int}     start
   * @param  {int}     limit
   * @param  {string}  orderDirection
   * @param  {string}  orderField
   * @param  {boolean} metadata
   * @return {object}  Retorna object con la data del contacto
   */
  public function fetchAll($type = '', $query = '', $start = 0, $limit = 30, $orderDirection = 'ASC', $orderField = 'name', $metadata = false)
  {
    $params = "?start=$start&limit=$limit&order_direction=$orderDirection&order_field=$orderField";
    if ($metadata) {
      $params.= "&metadata=true";
    }
    if (!empty($type) && in_array($type, array('client', 'provider'))) {
      $params.= "&type=$type";
    }
    if (!empty($query)) {
      $params.= "&query=$query";
    }

    $this->_client->setUri($this->_uri . $params);
    $response = $this->_client->request('GET');
    $data = $response->getBody();
    $data = json_decode($data, true);

    if (isset($data['code']) && $data['code'] !== 200) {
      return $data;
    }

    $results = $metadata ? $data['data'] : $data;
    $contacts   = array();

    foreach ($results as $row) {
      $contact = new Application_Model_Contact($row);
      $contacts[] = $contact;
    }

    if ($metadata) {
      return [
        'total' => $data['metadata']['total'],
        'contacts' => $contacts,
      ];
    }

    return $contacts;
  }

  /**
   * Metodo para actualizar un contacto
   * @param  {int}    id
   * @return {object} Retorna object con mensaje de
   * confirmacion o object con error
   */
  public function delete($id)
  {
    $this->_client->setUri($this->_uri . "/$id");
    $response = $this->_client->request('DELETE');
    $data = $response->getBody();
    $data = json_decode($data, true);

    if (isset($data['code']) && $data['code'] !== 200) {
      return $data;
    }

    return $data;
  }
}
