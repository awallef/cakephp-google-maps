<?php
namespace Awallef\GoogleMaps\Model\Table;

use Awallef\GoogleMaps\ORM\Table;

class PlacesTable extends Table {

  public $service = 'place';

  public function findTextsearch($query, $options)
  {
    $query->action = 'textsearch';
    return $query;
  }

}
