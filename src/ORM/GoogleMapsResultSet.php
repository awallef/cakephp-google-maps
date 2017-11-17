<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\Collection\CollectionTrait;
use \Cake\Datasource\ResultSetInterface;

class GoogleMapsResultSet implements ResultSetInterface {

  use CollectionTrait;

  protected $_results;
  protected $_table;
  protected $_index = 0;
  protected $_current;
  protected $_count;

  public function __construct($results, $table)
  {
    $this->_results = $results;
    $this->_table = $table;
  }

  public function toArray($preserveKeys = true)
  {
    $results = [];
    foreach ($this->_results as $result)
    {
      $document = new Document($result, $this->_table);
      $results[] = $document->cakefy();
    }
    return $results;
  }

  public function current()
  {
    return $this->_current;
  }

  public function key()
  {
    return $this->_index;
  }

  public function next()
  {
    $this->_index++;
  }

  public function valid()
  {
    $valid = $this->_index < $this->_count;
    if ($valid && $this->_results[$this->_index] !== null)
    {
      $this->_current = $this->_results[$this->_index];
      return true;
    }
    if (!$valid)
    {
      return $valid;
    }
  }

  public function rewind()
  {
    if ($this->_index == 0) {
      return;
    }
    $this->_index = 0;
  }

  public function count()
  {
    if ($this->_count !== null) {
      return $this->_count;
    }
    $this->_count = count($this->_results);

    return $this->_count;
  }

  public function serialize()
  {
    while ($this->valid()) {
      $this->next();
    }
    return serialize($this->_results);
  }

  public function unserialize($serialized)
  {
    $results = (array)(unserialize($serialized) ?: []);
    $this->_results = $results;
    $this->_useBuffering = true;
    $this->_count = $this->_results->count();
  }
}
