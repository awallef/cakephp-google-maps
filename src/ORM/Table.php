<?php
namespace Awallef\GoogleMaps\ORM;

use BadMethodCallException;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table as CakeTable;

class Table extends CakeTable
{

  public $service = 'none';

  public static function defaultConnectionName()
  {
    return 'google-map-api';
  }

  public function hasField($field)
  {
    return true;
  }

  public function query()
  {
    return new GoogleMapsQuery($this->connection(), $this);
  }

  public function find($type = 'geocode', $options = [])
  {
    $query = $this->query();
    $query->select();
    return $this->callFinderIfExists($type, $query, $options);
  }

  public function callFinderIfExists($type, GoogleMapsQuery $query, array $options = [])
  {
      $query->applyOptions($options);
      $options = $query->getOptions();
      $finder = 'find' . $type;
      if (method_exists($this, $finder)) return $this->{$finder}($query, $options);
      throw new BadMethodCallException(sprintf('Unknown finder method "%s"', $type));
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
