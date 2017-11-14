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
    *   Pending Dispatch
    *
    * @return void
    */
    public function index()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Pending Dispatch');
        $this->Order->Behaviors->load('Containable');
        
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Order.order_placed_at DESC',
            'conditions' => [
                'Order.status' => 1,
            ],
            'contain' => [
                'OrderItem',
                'User'
            ]
        );

        $data = $this->Paginator->paginate('Order');

        // pr($data);
        $this->set('orders', $data);
    }


    /**
    *   Payment Completed 
    *
    * @return void
    */
    public function completed()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Completed orders');
        $this->Order->Behaviors->load('Containable');
        
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Pending Dispatch');
        $this->Order->Behaviors->load('Containable');
        
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Order.order_placed_at DESC',
            'conditions' => [
                'Order.status' =>2,
            ],
            'contain' => [
                'OrderItem',
                'User'
            ]
        );

        $data = $this->Paginator->paginate('Order');

        // pr($data);
        $this->set('orders', $data);

    }


    /**
    *   Payment Incomplete 
    *
    * @return void
    */
    public function incomplete()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Incomplete orders');
        $this->Order->Behaviors->load('Containable');
     
        
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Order.order_placed_at DESC',
            'conditions' => [
                'Order.status' => 0,
            ],
            'contain' => [
                'OrderItem',
                'User'
            ]
        );

        $data = $this->Paginator->paginate('Order');

        // pr($data);
        $this->set('orders', $data);

    }

    /**
     * Cancel Orders
     * 
     * @return void
     */
    public function cancel()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Cancel orders');
        $this->Order->Behaviors->load('Containable');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Order.order_placed_at DESC',
            'conditions' => [
                'Order.status' => -1,
            ],
            'contain' => [
                'OrderItem',
                'User'
            ]
        );

        $data = $this->Paginator->paginate('Order');

        $this->set('orders', $data);
    }

    /**
     * View Order
     * 
     * @return void
     */
    public function view_order($order_id = null)
    {
        if ($order_id != null) {
            $this->layout = 'base_layout';
            $this -> set('page_title', 'View order');
            $this->Order->Behaviors->load('Containable');
    
            $order = $this->Order->findById($order_id);

            // pr($order);
            $this->set('order', $order);
        }
    }

    /**
     *  Mark order
     * @return redirect
     */
    public function mark_order($order_id = null, $status = 0)
    {
        $this->Order->id = $order_id;
        $data = [];
        if ($status >= -1 && $status <= 2) {
            $data['status'] = $status;
        }

        //If Order is completed then also update admin_remarks and Order_placed_at
        if ($status == 1) {
            $data['order_placed_at'] = date('Y-m-d h:i:s');
            $data['admin_remarks'] = "Marked as completed.";
        }

        if ($this->Order->save($data)) {
            $this->Session->setFlash('
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Order successfully marked.
                </div>');
            return $this->redirect($this->referer()); 
        } else {
            $this->Session->setFlash('
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Oops! Something went wrong. Please try again later.
            </div>');
            return $this->redirect(['controller' => 'orders', 'action' => 'index']); 
        }
    }
}
?>
