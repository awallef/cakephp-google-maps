<?php
namespace Awallef\GoogleMaps\Model\Table;

use Awallef\GoogleMaps\ORM\Table;

class GeocodesTable extends Table {
  public $service = 'geocode';

  public function initialize(array $config)
  {
    parent::initialize($config);
    $this->setPrimaryKey('address');
  }

}
