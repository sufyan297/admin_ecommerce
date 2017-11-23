<?php
App::uses('AppModel', 'Model');

class Subscriber extends Model
{
    var $belongsTo = ['User'];
}
?>
