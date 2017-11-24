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

  public function get($primaryKey, $options = [])
  {
      $key = (array)$this->getPrimaryKey();
      $alias = $this->getAlias();
      foreach ($key as $index => $keyname) {
          $key[$index] = $keyname;
      }
      $primaryKey = (array)$primaryKey;
      if (count($key) !== count($primaryKey)) {
          $primaryKey = $primaryKey ?: [null];
          $primaryKey = array_map(function ($key) {
              return var_export($key, true);
          }, $primaryKey);

          throw new InvalidPrimaryKeyException(sprintf(
              'Record not found in table "%s" with primary key [%s]',
              $this->getTable(),
              implode($primaryKey, ', ')
          ));
      }
      $conditions = array_combine($key, $primaryKey);

      $cacheConfig = isset($options['cache']) ? $options['cache'] : false;
      $cacheKey = isset($options['key']) ? $options['key'] : false;
      $finder = isset($options['finder']) ? $options['finder'] : 'all';
      unset($options['key'], $options['cache'], $options['finder']);

      $query = $this->find($finder, $options)->where($conditions);

      if ($cacheConfig) {
          if (!$cacheKey) {
              $cacheKey = sprintf(
                  'get:%s.%s%s',
                  $this->getConnection()->configName(),
                  $this->getTable(),
                  json_encode($primaryKey)
              );
          }
          $query->cache($cacheKey, $cacheConfig);
      }

      return $query->firstOrFail();
  }
}
