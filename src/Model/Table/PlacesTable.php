<?php
namespace Awallef\GoogleMaps\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Awallef\GoogleMaps\ORM\Table;

class PlacesTable extends Table {

  public $service = 'place';
  public $action = 'details';

  public function initialize(array $config)
  {
    parent::initialize($config);
    $this->setPrimaryKey('placeid');
  }

  public function findTextsearch($query, $options)
  {
    $this->action = 'textsearch';
    return $query;
  }

  public function findNearbysearch($query, $options)
  {
    $this->action = 'nearbysearch';
    return $query;
  }

  public function findRadarsearch($query, $options)
  {
    $this->action = 'radarsearch';
    return $query;
  }
}
