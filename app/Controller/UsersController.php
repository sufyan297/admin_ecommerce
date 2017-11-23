<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('User','Order','Subscriber');

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
     * View Subscribers
     * 
     * @return void
     */
    public function view_subscribers()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View subscribers');
        
        // $this->log($this->request->query);
        $this->Paginator->settings = array(
            'limit' => 30,
            'order' => 'Subscriber.modified DESC'
        );
        $data = $this->Paginator->paginate('Subscriber');
        $this->set('subscribers', $data);
    }

    /**
     * Remove from subscriber list
     * 
     * @return void
     */
    public function delete_subscriber($id = null, $status = 0) 
    {
        if ($id != null) {
            $data = [];

            $this->Subscriber->id = $id;
            $data['Subscriber']['is_active'] = $status;

            if ($this->Subscriber->save($data)) {

                if ($status == 1) {
                    $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Subscriber marked as active.</b>
                    </div>');
                } else {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Subscriber marked as inactive.</b>
                    </div>');    
                }
                return $this -> redirect(array('controller' => 'users', 'action' => 'view_subscribers'));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Oops! Something went wrong. Please try again later.</b>
                </div>');
                return $this -> redirect(array('controller' => 'users', 'action' => 'view_subscribers'));
            }
        }
    }

    /**
     * Edit User
     * 
     * @return void
     */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit User');
        $data = $this->User->findById($id);
        $this->set('data', $data);
        if ($this->request->is('post'))
        {
            $temp = $this->request->data;

            //userNameExists <Check>
            $usernameexists = $this->User->find('count',array(
                'conditions' => array(
                    'User.id !='=> $id,
                    'User.username'=> $temp['User']['username']
                )
            ));

            if ($usernameexists > 0) {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Username already exists.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'users', 'action' => 'edit',$id));
            }

            if(trim($temp['User']['password']) != trim($temp['User']['rtpassword'])) {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Both password must be same or just leave it blank.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'users', 'action' => 'edit',$id));
            } else {
                if(trim($temp['User']['password']) > 2) {
                    $this->User->id = $id;
                    if ($this->User->save($temp))
                    {
                        $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                      User <b>`".$temp['User']['username']."`</b> has been edited.</div>";
                        $this->Session->setFlash($tempMsg);
                        $this -> redirect(array('controller' => 'users', 'action' => 'view'));
                    } else {
                        $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <b>Oops! Something went wrong! Please try again later.</b>
                                                  </div>');
                    }
                } else {
                    //if password is Blank Then don't update it...
                    $this->User->id = $id;
                    $tp['User']['username'] = $temp['User']['username'];
                    $tp['User']['first_name'] = $temp['User']['first_name'];
                    $tp['User']['last_name'] = $temp['User']['last_name'];

                    //Didn't added support for News Letters and Verified user or not.
                    // $tp['User']['news_letters'] = $temp['User']['news_letters'];
                    // $tp['User']['is_verified'] = $temp['User']['is_verified'];

                    // pr($tp); die();
                    if ($this->User->save($tp))
                    {
                        $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                      User <b>`".$temp['User']['username']."`</b> has been edited.</div>";
                        $this->Session->setFlash($tempMsg);
                        return $this -> redirect(array('controller' => 'users', 'action' => 'view'));
                    } else {
                        $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <b>Oops! Something went wrong! Please try again later.</b>
                                                  </div>');
                    }
                }
                /* END OF PASSWORD LENGTH CHECK */
            }
            /* END OF PASS and RETYPE Pass check */
        }
        /* END OF METHOD MUST BE POST */
    }


    /**
    *  View User
    *
    *  @return void
    */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Users');
        $q = "";
        if (isset($this->request->query['search'])) {
            $q = $this->request->query['search'];
        }
        // $this->log($this->request->query);
        $this->Paginator->settings = array(
            'limit' => 20,
            'order' => 'User.created DESC',
            'conditions' => array(
                'OR' => [
                    'User.first_name LIKE' => '%'.$q.'%',
                    'User.last_name LIKE' => '%'.$q.'%',
                    'User.username LIKE' => '%'.$q.'%'
                ]
            )
        );
        $data = $this->Paginator->paginate('User');
        $this->set('users', $data);
        $this->set('search_query', $q);
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
