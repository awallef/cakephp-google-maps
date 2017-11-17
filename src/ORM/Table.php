<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Table as CakeTable;

class Table extends CakeTable
{

  public static function defaultConnectionName(){ return 'google-map-api';}

  public function hasField($field){ return true; }

  public function query(){ return new GoogleMapsQuery($this->connection(), $this); }
}
