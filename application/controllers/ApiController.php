<?php
/**
 * Class para comunicar el ExtJS con el api de Alegra.com
 */
class ApiController extends Zend_Controller_Action
{
  public function init()
  {
    // Init
  }

  /**
   * Metodo para listar los contactos
   * @method GET
   * @param  {string}  type
   * @param  {string}  query
   * @param  {int}     start
   * @param  {int}     limit
   * @param  {string}  orderDirection
   * @param  {string}  orderField
   * @param  {boolean} metadata
   * @return {object}  Retorna object con la lista de
   * contactos o json con error
   */
  public function indexAction()
  {
    $this->getHelper('Layout')->disableLayout();
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $start = intval($this->_request->getQuery('start')) ? intval($this->_request->getQuery('start')) : 0;
    $limit = intval($this->_request->getQuery('limit')) ? intval($this->_request->getQuery('limit')) : 20;
    $page = intval($this->_request->getQuery('page'));

    $contacts = new Application_Model_ContactMapper();
    $data = $contacts->fetchAll('', '', $start, $limit);

    return $this->_helper->json->sendJson($data);
  }

  /**
   * Metodo para recuperar la data de un contacto
   * @method GET
   * @param  {int}  type
   * @return {json} Retorna json con la data del
   * contacto o json con error
   */
  public function findAction()
  {
    $this->getHelper('Layout')->disableLayout();
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $contact = new Application_Model_ContactMapper();
    $data = $contact->find(2);

    return $this->_helper->json->sendJson($data);
  }

  /**
   * Metodo para crear un contacto
   * @method POST
   * @param  {string}   name
   * @param  {string}   identification
   * @param  {string}   phonePrimary
   * @param  {string}   phoneSecondary
   * @param  {string}   fax
   * @param  {string}   mobile
   * @param  {string}   observations
   * @param  {string}   email
   * @param  {object}   priceList
   * @param  {object}   seller
   * @param  {object}   term
   * @param  {object}   address
   * @param  {array}    type
   * @param  {[object]} internalContacts
   * @return {object}   Retorna object con la data del
   * contacto creado o object con error
   */
  public function createAction()
  {
    $this->getHelper('Layout')->disableLayout();
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $params = $this->getRequest()->getPost();

    $contact = new Application_Model_ContactMapper();
    $form = new Application_Model_Contact($params);
    $data = $contact->upsert($form);

    return $this->_helper->json->sendJson($data);
  }

  /**
   * Metodo para actualizar un contacto
   * @method POST
   * @param  {int}      id
   * @param  {string}   name
   * @param  {string}   identification
   * @param  {string}   phonePrimary
   * @param  {string}   phoneSecondary
   * @param  {string}   fax
   * @param  {string}   mobile
   * @param  {string}   observations
   * @param  {string}   email
   * @param  {object}   priceList
   * @param  {object}   seller
   * @param  {object}   term
   * @param  {object}   address
   * @param  {array}    type
   * @param  {[object]} internalContacts
   * @return {object}   Retorna object con la data del
   * contacto actualizado o object con error
   */
  public function updateAction()
  {
    $this->getHelper('Layout')->disableLayout();
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $params = $this->getRequest()->getPost();

    $contact = new Application_Model_ContactMapper();
    $form = new Application_Model_Contact($params);
    $data = $contact->upsert($form);

    return $this->_helper->json->sendJson($data);
  }

  /**
   * Metodo para actualizar un contacto
   * @method POST
   * @param  {int}    id
   * @return {object} Retorna object con mensaje de
   * confirmacion o object con error
   */
  public function deleteAction()
  {
    $this->getHelper('Layout')->disableLayout();
    $this->getHelper('ViewRenderer')->setNoRender();
    $this->getResponse()->setHeader('Content-Type', 'application/json');

    $param = $this->getRequest()->getParam('id');

    $contact = new Application_Model_ContactMapper();
    $data = $contact->delete($param);

    return $this->_helper->json->sendJson($data);
  }
}
