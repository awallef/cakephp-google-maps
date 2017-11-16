<?php
namespace Awallef\GoogleMaps\Database;

use Awallef\GoogleMaps\Database\Driver\GoogleMapsApi;
use Awallef\GoogleMaps\Database\Schema\GoogleMapsSchema;
use Cake\Datasource\ConnectionInterface;
use Cake\Database\Log\LoggedQuery;
use Cake\Database\Log\QueryLogger;

class Connection implements ConnectionInterface
{
  protected $_config;
  protected $_driver = null;
  protected $_logQueries = false;
  protected $_logger = null;
  protected $_schemaCollection;

  public function __construct($config)
  {
    $this->_config = $config;
    $this->driver('google-maps-api', $config);
    if (!empty($config['log'])) {
      $this->logQueries($config['log']);
    }
  }

  public function __destruct()
  {
    if ($this->_driver->connected) {
      $this->_driver->disconnect();
      unset($this->_driver);
    }
  }

  public function config(){ return $this->_config; }

  public function configName(){ return 'google-maps-api'; }

  public function driver($driver = null, $config = [])
  {
    if ($driver === null) {
      return $this->_driver;
    }
    $this->_driver = new GoogleMapsApi($config);
    return $this->_driver;
  }

  public function connect()
  {
    try {
      $this->_driver->connect();
      return true;
    } catch (Exception $e) {
      throw new MissingConnectionException(['reason' => $e->getMessage()]);
    }
  }

  public function disconnect()
  {
    if ($this->_driver->isConnected()) {
      return $this->_driver->disconnect();
    }
    return true;
  }

  public function isConnected(){ return $this->_driver->isConnected(); }

  public function schemaCollection($collection = null){ return $this->_schemaCollection = new GoogleMapsSchema($this->_driver); }

  public function transactional(callable $transaction){ return false; }

  public function disableConstraints(callable $operation){ return false; }

  public function logQueries($enable = null)
  {
    if ($enable === null) {
      return $this->_logQueries;
    }
    $this->_logQueries = $enable;
  }

  public function logger($instance = null)
  {
    if ($instance === null) {
      if ($this->_logger === null) {
        $this->_logger = new QueryLogger;
      }
      return $this->_logger;
    }
    $this->_logger = $instance;
  }

  public function log($sql)
  {
    $query = new LoggedQuery;
    $query->query = $sql;
    $this->logger()->log($query);
  }
}
