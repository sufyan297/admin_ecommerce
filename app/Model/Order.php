<?php
App::uses('AppModel', 'Model');

class Order extends Model
{
    var $belongsTo = ['User','ShippingAddress' => ['className' => 'UserAddress', 'foreignKey'=>'shipping_address_id']];
    var $hasMany = ['OrderItem'];

}
?>
