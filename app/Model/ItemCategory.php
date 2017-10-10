<?php
App::uses('AppModel', 'Model');

class ItemCategory extends Model
{
    var $hasMany = ['ItemSubCategory'];


}
?>
