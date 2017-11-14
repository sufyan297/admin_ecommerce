<?php
App::uses('AppModel', 'Model');

class MenuItem extends Model
{
    var $belongsTo = ['Menu','ItemCategory'];    
}
?>
