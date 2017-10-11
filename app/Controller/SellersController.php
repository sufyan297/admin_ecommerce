<?php
App::uses('AppController', 'Controller');

class SellersController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('Seller');

    public function beforeFilter()
    {
        AppController::beforeFilter();
        //Basic Setup
        $this->Auth->authenticate = array('Form');
        $this->Auth->authenticate = array(
          'Form' => array('userModel' => 'Admin')
        );
        date_default_timezone_set("Asia/Kolkata");
        $this->Auth->allow('login'); //Without Logged IN which page can be access.. assign here
    }



    /**
    *   ADD Seller
    *
    * @return void
    */
    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Seller');

        if($this->request->is('post'))
        {
            $data = $this->request->data;

            if ($this->Seller->save($data)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Seller successfully added.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'sellers', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'sellers', 'action' => 'add'));
            }
        }
    }

    /**
    *   Edit Seller
    *
    * @return void
    */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Item category');

        $tmp = $this->Seller->findById($id);
        $this->set('data', $tmp);
        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->Seller->id = $id;
            if ($this->Seller->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Seller successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'sellers', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'sellers', 'action' => 'edit', $id));
            }
        }

    }


    /**
    *   View Seller
    *
    * @return void
    */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Sellers');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Seller.created DESC',
            'conditions' => [
                'Seller.is_active' => 1,
                'Seller.del_flag !=' => 1
            ]
        );
        $data = $this->Paginator->paginate('Seller');
        $this->set('sellers', $data);
    }

    /**
    *   Delete Seller
    *
    * @return redirect
    */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->Seller->id = $id;
            $tmp = [];
            $tmp['Seller']['del_flag'] = 1;
            if ($this->Seller->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Seller successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete Item Category. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'sellers','action'=>'view')));
        }
    }


    public function getAllSellers()
    {
        if ($this->request->is('post')) {

            $tmp = $this->Seller->find('all',
                [
                    'conditions' => [
                        'Seller.is_active' => 1,
                        'Seller.del_flag !=' => 1
                    ],
                    'fields' => [
                        'Seller.id',
                        'Seller.name'
                    ]
                ]
            );

            $res = new ResponseObject ( ) ;
            $res -> status = 'success' ;
            $res -> data = $tmp ;
            $res -> message = 'Sellers are fetched.' ;
            $this -> response -> body ( json_encode ( $res ) ) ;
            return $this -> response ;
        } else {
            $res = new ResponseObject ( ) ;
            $res -> status = 'error' ;
            $res -> message = 'INVALID_METHOD.' ;
            $this -> response -> body ( json_encode ( $res ) ) ;
            return $this -> response ;
        }
    }

}
?>
