<?php
namespace Awallef\GoogleMaps\ORM;

class GoogleMapsQuery
{
  public $action = '';
  public $service = '';

  protected $_table;
  protected $_connection;
  protected $_fields = [];
  protected $_options = [
    'conditions' => []
  ];

  public function __construct($connection, $table)
  {
    $this->_connection = $connection;
    $this->_table = $table;
    $this->service = $table->service;
  }

  public function select($fields = [])
  {
    $this->_fields = array_merge($this->_fields, $fields);
    return $this;
  }

  public function applyOptions($options = [])
  {
    $this->_options = array_merge($this->_options, $options);
    return $this;
  }

  public function getOptions()
  {
    return $this->_options;
  }

  public function where($conditions = [])
  {
    $this->_options['conditions'] = array_merge($this->_options['conditions'], $conditions);
    return $this;
  }

}
