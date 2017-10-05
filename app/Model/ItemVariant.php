<?php
App::uses('AppModel', 'Model');

class ItemVariant extends Model
{
    var $belongsTo = ['Item','Variant','VariantProperty'];

}
?>
