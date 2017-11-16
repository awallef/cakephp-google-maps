<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Table as CakeTable;

class Table extends CakeTable
{

  public static function defaultConnectionName()
  {
    return 'google-map-api';
  }

  protected $service = '';

  public function hasField($field)
  {
    return true;
  }

  public function find($type = 'all', $options = [])
  {
    debug('coucou');
    debug($this->connection()->driver()->config());
    /*
    $query = new MongoFinder($this->__getCollection(), $options);
    $method = 'find' . ucfirst($type);
    if (method_exists($query, $method)) {
      $mongoCursor = $query->{$method}();
      $results = new ResultSet($mongoCursor, $this->alias());
      if (isset($options['whitelist'])) {
        return new MongoQuery($results->toArray(), $query->count());
      } else {
        return $results->toArray();
      }
    }
    throw new BadMethodCallException(
      sprintf('Unknown method "%s"', $method)
    );
    */
  }

  public function get($primaryKey, $options = [])
  {
    /*
    $query = new MongoFinder($this->__getCollection(), $options);
    $mongoCursor = $query->get($primaryKey);
    //if find document, convert to cake entity
    if ($mongoCursor->count()) {
      $document = new Document(current(iterator_to_array($mongoCursor)), $this->alias());
      return $document->cakefy();
    }
    throw new InvalidPrimaryKeyException(sprintf(
      'Record not found in table "%s" with primary key [%s]',
      $this->_table->table(),
      $primaryKey
    ));
    */
  }

  public function delete(EntityInterface $entity, $options = [])
  {
    return true;
  }

  public function save(EntityInterface $entity, $options = [])
  {
    return true;
  }
}
