<?php
namespace Awallef\GoogleMaps\ORM;

use Cake\ORM\Entity;

class Document
{
  protected $_document;
  protected $_registryAlias;
  public function __construct($document, $table)
  {
    $this->_document = $document;
    $this->_registryAlias = $table;
  }
  public function cakefy($value = null)
  {
    $data = ($value)? $value: $this->_document;
    foreach ($data as $field => $value) {
      $type = gettype($value);
      if ($type == 'object') {
        switch (get_class($value)) {
          case 'stdClass':
            $document[$field] = $value;//->__toString();
            break;
          default:
            throw new \Exception(get_class($value) . ' conversion not implemented.');
            break;
        }
      //} elseif ($type == 'array') {
      //  $document[$field] = $this->cakefy($value);
      } else {
        $document[$field] = $value;
      }
    }
    return new Entity($document, ['markClean' => true, 'markNew' => false, 'source' => $this->_registryAlias]);
  }
}
