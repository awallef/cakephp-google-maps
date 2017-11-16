<?php
namespace Awallef\GoogleMaps\Database\Driver;

use Cake\Http\Client;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Core\InstanceConfigTrait;

class GoogleMapsApi
{
  use InstanceConfigTrait;

  protected $_client;
  protected $_url;
  protected $_key;

  protected $_defaultConfig = [
    'url' => 'https://maps.googleapis.com/maps/api/'
  ];

  public $connected = false;

  public function __construct(array $config = [])
  {
    $this->setConfig($config);
    $this->_url = $this->config()['url'];
  }

  public function connect()
  {
    return true;
  }

  private function createConnectionName()
  {
    return 'GoogleMapsApi';
  }
  public function disconnect()
  {
    return true;
  }
  public function isConnected()
  {
    return $this->connected;
  }

  public function query($service, $action, $args  = [])
  {
    $response = $this->_query($service, $action, $args);
  }

  protected function _query($service, $action, $args  = [])
  {
    $response = $this->_getClient()->get($this->_getUrl($service, $action),$this->_getArgs($args));
    switch($response->code)
    {
      case 200: return $this->_jsonParseResposnse($response->body);
      case 404: throw new NotFoundException("Service or action does not exists on Google Maps API.");
      default: throw new BadRequestException("Google Maps API encountered an unknown error.");
    }
  }

  protected function _jsonParseResposnse($body)
  {
    try {
      $result = json_decode($body);
    } catch (Exception $e) {
      throw new BadRequestException("Unable to decode Google Maps API JSON response");
    }
    switch ($result->status)
    {
      case 'OK': return $result->results;
      case 'ZERO_RESULTS': return [];
      case 'REQUEST_DENIED': throw new ForbiddenException("Google Maps API request denided: ".$result->error_message);
      default: throw new BadRequestException("Google Maps API Error: ".$result->status);
    }
  }

  protected function _getClient()
  {
    $this->_client = ($this->_client)? $this->_client: new Client();
    return $this->_client;
  }

  protected function _getUrl($service = null, $action = null)
  {
    $action = (empty($action))? '': '/'.$action;
    return $this->_url.$service.$action.'/json';
  }

  protected function _getArgs($args)
  {
    $args['key'] = $this->_key;
    return $args;
  }
}