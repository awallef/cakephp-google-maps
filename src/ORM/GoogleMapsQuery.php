<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\ORM\Query;

class GoogleMapsQuery extends Query
{
  public function __debugInfo()
  {
    return [
      'Hello : ) This is a Google Maps Query Object' => 'Use foreach to execute it'
    ];
  }
  protected function _execute()
  {
    /*
    $this->triggerBeforeFind();
    if ($this->_results) {
      $decorator = $this->_decoratorClass();

      return new $decorator($this->_results);
    }
    $statement = $this->getEagerLoader()->loadExternal($this, $this->execute());


    */
    debug($this->type());
    switch($this->type())
    {
      case 'select': return $this->_select();
    }



    //return new GoogleMapsResultSet($this, $statement);
  }

  protected function _select()
  {
    debug($this->repository());
    debug($this->_parts['where']);
    return [];
  }
}
