<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\ORM\Query;

class GoogleMapsQuery extends Query
{

  protected $_resultSet;

  public function __debugInfo()
  {
    return ['Hello : ) This is a Google Maps Query Object' => 'Use foreach to execute it'];
  }
  protected function _execute()
  {
    if($this->_resultSet == null)
    {
      $resultSet = $this->getConnection()->getDriver()->query($this->repository()->service, $this->repository()->action, $this->getParams());
      $this->_resultSet = new GoogleMapsResultSet($resultSet, $this->repository());
    }
    return $this->_resultSet;
  }

  public function getParams()
  {
    $params = [];
    if($this->_parts['where']) $this->_parts['where']->traverse(function($c) use(&$params){$params[$c->getField()] = $c->getValue();});
    return $params;
  }

  protected function _performCount()
  {
    if($this->_resultSet == null) $this->_execute();
    return $this->_resultSet->count();
  }
}
