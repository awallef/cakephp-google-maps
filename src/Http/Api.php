<?php
namespace Awallef\GoogleMaps\Http;

use Cake\Core\InstanceConfigTrait;
use Cake\Http\Client;

class Api
{
  use InstanceConfigTrait;

  protected $_defaultConfig = [
    'base' => 'https://maps.googleapis.com/maps/api/',
    'key' => 'XXX'
  ];

}
