<?php

App::uses('AppController', 'Controller');

class OrdersController extends AppController
{
    public $components = array('Paginator');
    // public $uses = array('Admin');

    public function beforeFilter()
    {
        AppController::beforeFilter();
        //Basic Setup
        $this->Auth->authenticate = array('Form');
        $this->Auth->authenticate = array(
          'Form' => array('userModel' => 'Admin')
        );
        $this->Auth->allow('login'); //Without Logged IN which page can be access.. assign here
    }

    /**
    *   Create Bill (aka. ORDER)
    *
    * @return void
    */
    public function create()
    {
        $this->layout = 'base_layout';
    }
}
?>
