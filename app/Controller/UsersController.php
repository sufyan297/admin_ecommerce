<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('User','Order');

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
    *   View User
    *
    * @return void
    */
    public function view_user($user_id = null)
    {
        $this->layout = 'base_layout';
        if ($user_id != null) {
            $this -> set('page_title', 'View user');

            $user = $this->User->findById($user_id);
        
            //Orders
            $this->Paginator->settings = array(
                'limit' => 10,
                'order' => 'Order.created DESC',
                'conditions' => array(
                    'Order.user_id' => $user_id
                )
            );
            $orders = $this->Paginator->paginate('Order');

            $this->set('data', $user);
            $this->set('orders', $orders);
        }
    }

}
?>
