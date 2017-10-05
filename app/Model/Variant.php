<?php
App::uses('AppModel', 'Model');

class Variant extends Model
{
    var $hasMany = ['VariantProperty'];

}
?>
