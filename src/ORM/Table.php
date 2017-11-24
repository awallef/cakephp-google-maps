<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\ORM\Table as CakeTable;

class Table extends CakeTable
{

  public $service = 'geocode';
  public $action = null;

  public static function defaultConnectionName(){ return 'google-map-api';}

  public function hasField($field)
  {
    return true;
  }

  public function query()
  {
    return new GoogleMapsQuery($this->connection(), $this);
  }
}
