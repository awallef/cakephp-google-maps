<?php
namespace Awallef\GoogleMaps\Database\Schema;

use Awallef\GoogleMaps\Database\Driver\GoogleMapsApi;
use Cake\Database\Schema\Table;

class GoogleMapsSchema
{
  protected $_connection = null;

  public function __construct(GoogleMapsApi $conn)
  {
    $this->_connection = $conn;
  }

  public function describe($name, array $options = [])
  {
    $config = $this->_connection->config();
    if (strpos($name, '.')) {
      list($config['schema'], $name) = explode('.', $name);
    }
    $table = new Table(['table' => $name]);
    if (empty($table->primaryKey())) {
      $table->addColumn('_id', ['type' => 'string', 'default' => '_to_change_', 'null' => false]);
      $table->addConstraint('_id', ['type' => 'primary', 'columns' => ['_id']]);
    }
    return $table;
  }
}
