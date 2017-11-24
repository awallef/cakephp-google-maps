<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\ORM\Query;

class GoogleMapsQuery extends Query
{
  public function __debugInfo()
  {
    return ['Hello : ) This is a Google Maps Query Object' => 'Use foreach to execute it'];
  }
  protected function _execute()
  {
    $results = $this->getConnection()->getDriver()->query($this->repository()->service, $this->repository()->action, $this->getParams());
    return new GoogleMapsResultSet($results, $this->repository());
  }

  public function getParams()
  {
    $params = [];
    if($this->_parts['where'])
      $this->_parts['where']->traverse(function($c) use(&$params){$params[$c->getField()] = $c->getValue();});
    return $params;
  }
}
