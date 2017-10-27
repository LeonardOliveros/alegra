<?php
/**
 * Class para comunicacion con el api de Alegra.com
 */
class IndexController extends Zend_Controller_Action
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
  private $_mail;

  /**
   * @var string Token generado desde la configuracion
   * de Alegra.com
   */
  private $_token;

  /**
   * @var Zend_Http_Client Object cliente para la comunicacion
   */
  private $_client;

  public function init()
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
    $this->_mail = $dataAlegra['mail'];
    // Se asigna el token a una variable privada
    $this->_token = $dataAlegra['token'];
    // Se crea una instancia de Zend_Http_Client para su posterior uso
    $this->_client = new Zend_Http_Client();
    // Se setea la URi
    $this->_client->setUri($this->_uri);
    // Se setean los datos de autenticacion
    $this->_client->setAuth($this->_mail, $this->_token);
  }

  /**
   * Listar los contactos
   *
   * @return json
   */
  public function indexAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $this->_client->setUri($this->_uri);
    $response = $this->_client->request();
    $data = $response->getBody();

    $this->_getError($data);

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data,
    ]);
  }

  /**
   * Listar los clientes
   *
   * @return json
   */
  public function clientAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $this->_client->setUri($this->_uri . "?type=client");
    $response = $this->_client->request();
    $data = $response->getBody();

    $this->_getError($data);

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data,
    ]);
  }

  /**
   * Listar los proveedores
   *
   * @return json
   */
  public function providerAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');
    $this->_client->setUri($this->_uri . "?type=provider");

    $response = $this->_client->request();
    $data = $response->getBody();

    $this->_getError($data);

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data,
    ]);
  }

  /**
   * Recuperar la data de un solo registro
   * @return string
   */
  public function findAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    if (empty($this->_request->getQuery('id'))) {
      return $this->_helper->json->sendJson([
        'success' => false,
        'data' => 'El parametro id no tiene data',
      ]);
    }

    $this->_client->setUri($this->_uri . '/' . $this->_request->getQuery('id'));
    $response = $this->_client->request();
    $data = json_decode($response->getBody());

    $this->_getError($data);

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data,
    ]);
  }

  /**
   * Crear un contacto
   * @return json
   */
  public function createAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');
    $parameters = json_decode($this->_request->getPost('data'));

    if (!isset($parameters->name) || empty($parameters->name)) {
      return $this->_helper->json->sendJson([
        'success' => false,
        'data' => 'Es obligatorio el campo nombre',
      ]);
    }

    if ( isset($parameters->term) && !empty($parameters->term)) {
      $parameters->term = $this->_terms[$parameters->term];
    }

    if ( isset($parameters->priceList) && !empty($parameters->priceList)) {
      $parameters->priceList = $this->_priceList[$parameters->priceList];
    }

    $response = $this->_client->setRawData( json_encode($parameters) )->request('POST');
    $data = json_decode($response->getBody());

    $this->_getError($data, 201);

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data
    ]);
  }

  /**
   * Actualizar un contacto
   * @return json
   */
  public function updateAction()
  {
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $parameters = json_decode($this->_request->getPost('data'));

    if (!isset($parameters->id) || empty($parameters->id)) {
      return $this->_helper->json->sendJson([
        'success' => false,
        'data' => 'El parametro id no tiene data',
      ]);
    }

    if (!isset($parameters->name) || empty($parameters->name)) {
      return $this->_helper->json->sendJson([
        'success' => false,
        'data' => 'Es obligatorio el campo nombre',
      ]);
    }

    if ( isset($parameters->term) && !empty($parameters->term)) {
      $parameters->term = $this->_terms[$parameters->term];
    }

    if ( isset($parameters->priceList) && !empty($parameters->priceList)) {
      $parameters->priceList = $this->_priceList[$parameters->priceList];
    }

    $this->_client->setUri($this->_uri . '/' . $parameters->id);
    $response = $this->_client->setRawData(json_encode($parameters))->request('PUT');
    $data = json_decode($response->getBody());

    return $this->_helper->json->sendJson([
      'success' => true,
      'data' => $data,
    ]);
  }

  private function _getError($data, $codeValid = 200)
  {
    if (isset($data->code) && $data->code !== $codeValid) {
      return $this->_helper->json->sendJson([
        'success' => false,
        'data' => $data->message,
      ]);
    }
  }
}
