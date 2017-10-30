<?php

class Application_Model_Contact
{
  public $id;
  public $name;
  public $identification;
  public $phonePrimary;
  public $phoneSecondary;
  public $fax;
  public $mobile;
  public $observations;
  public $email;
  public $priceList;
  public $seller;
  public $term;
  public $address;
  public $type;
  public $internalContacts;

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
    $this->id = (int) $id;
    return $this;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setName($name)
  {
    $this->name = (string) $name;
    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setIdentification($identification)
  {
    $this->identification = (string) $identification;
    return $this;
  }

  public function getIdentification()
  {
    return $this->identification;
  }

  public function setPhonePrimary($phonePrimary)
  {
    $this->phonePrimary = (string) $phonePrimary;
    return $this;
  }

  public function getPhonePrimary()
  {
    return $this->phonePrimary;
  }

  public function setPhoneSecondary($phoneSecondary)
  {
    $this->phoneSecondary = (string) $phoneSecondary;
    return $this;
  }

  public function getPhoneSecondary()
  {
    return $this->phoneSecondary;
  }

  public function setFax($fax)
  {
    $this->fax = (string) $fax;
    return $this;
  }

  public function getFax()
  {
    return $this->fax;
  }

  public function setMobile($mobile)
  {
    $this->mobile = (string) $mobile;
    return $this;
  }

  public function getMobile()
  {
    return $this->mobile;
  }

  public function setObservations($observations)
  {
    $this->observations = (string) $observations;
    return $this;
  }

  public function getObservations()
  {
    return $this->observations;
  }

  public function setEmail($email)
  {
    $this->email = (string) $email;
    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setPriceList($priceList)
  {
    $this->priceList = $priceList;
    return $this;
  }

  public function getPriceList()
  {
    return $this->priceList;
  }

  public function setSeller($seller)
  {
    $this->seller = $seller;
    return $this;
  }

  public function getSeller()
  {
    return $this->seller;
  }

  public function setTerm($term)
  {
    $this->term = $term;
    return $this;
  }

  public function getTerm()
  {
    return $this->term;
  }

  public function setAddress($address)
  {
    $this->address = $address;
    return $this;
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function setType($type)
  {
    $this->type = $type;
    return $this;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setInternalContacts($internalContacts)
  {
    $this->internalContacts = $internalContacts;
    return $this;
  }

  public function getInternalContacts()
  {
    return $this->internalContacts;
  }
}
