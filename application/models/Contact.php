<?php

class Application_Model_Contact
{
  protected $_id;
  protected $_name;
  protected $_identification;
  protected $_phonePrimary;
  protected $_phoneSecondary;
  protected $_fax;
  protected $_mobile;
  protected $_observations;
  protected $_email;
  protected $_priceList;
  protected $_seller;
  protected $_term;
  protected $_address;
  protected $_type;
  protected $_internalContacts;

  public function __construct(array $options = null)
  {
    if (is_array($options)) {
      $this->setOptions($options);
    }
  }

  public function __set($name, $value)
  {
    $method = 'set' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
      throw new Exception('Invalid contact property');
    }
    $this->$method($value);
  }

  public function __get($name)
  {
    $method = 'get' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
      throw new Exception('Invalid contact property');
    }
    return $this->$method();
  }

  public function setOptions(array $options)
  {
    $methods = get_class_methods($this);
    foreach ($options as $key => $value) {;
      $method = 'set' . ucfirst($key);
      if (in_array($method, $methods)) {
        $this->$method($value);
      }
    }
    return $this;
  }

  public function setId($id)
  {
    $this->_id = (int) $id;
    return $this;
  }

  public function getId()
  {
    return $this->_id;
  }

  public function setName($name)
  {
    $this->_name = (string) $name;
    return $this;
  }

  public function getName()
  {
    return $this->_name;
  }

  public function setIdentification($identification)
  {
    $this->_identification = (string) $identification;
    return $this;
  }

  public function getIdentification()
  {
    return $this->_identification;
  }

  public function setPhonePrimary($phonePrimary)
  {
    $this->_phonePrimary = (string) $phonePrimary;
    return $this;
  }

  public function getPhonePrimary()
  {
    return $this->_phonePrimary;
  }

  public function setPhoneSecondary($phoneSecondary)
  {
    $this->_phoneSecondary = (string) $phoneSecondary;
    return $this;
  }

  public function getPhoneSecondary()
  {
    return $this->_phoneSecondary;
  }

  public function setFax($fax)
  {
    $this->_fax = (string) $fax;
    return $this;
  }

  public function getFax()
  {
    return $this->_fax;
  }

  public function setMobile($mobile)
  {
    $this->_mobile = (string) $mobile;
    return $this;
  }

  public function getMobile()
  {
    return $this->_mobile;
  }

  public function setObservations($observations)
  {
    $this->_observations = (string) $observations;
    return $this;
  }

  public function getObservations()
  {
    return $this->_observations;
  }

  public function setEmail($email)
  {
    $this->_email = (string) $email;
    return $this;
  }

  public function getEmail()
  {
    return $this->_email;
  }

  public function setPriceList($priceList)
  {
    $this->_priceList = $priceList;
    return $this;
  }

  public function getPriceList()
  {
    return $this->_priceList;
  }

  public function setSeller($seller)
  {
    $this->_seller = $seller;
    return $this;
  }

  public function getSeller()
  {
    return $this->_seller;
  }

  public function setTerm($term)
  {
    $this->_term = $term;
    return $this;
  }

  public function getTerm()
  {
    return $this->_term;
  }

  public function setAddress($address)
  {
    $this->_address = $address;
    return $this;
  }

  public function getAddress()
  {
    return $this->_address;
  }

  public function setType($type)
  {
    $this->_type = $type;
    return $this;
  }

  public function getType()
  {
    return $this->_type;
  }

  public function setInternalContacts($internalContacts)
  {
    $this->_internalContacts = $internalContacts;
    return $this;
  }

  public function getInternalContacts()
  {
    return $this->_internalContacts;
  }
}
