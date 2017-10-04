<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('ItemCategory','Item','Variant','VariantProperty');

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
    *   ADD Item
    *
    * @return void
    */
    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Item');

        //getItemCategories
        $item_categories = $this->ItemCategory->find('list',
            [
                'conditions' => [
                    'ItemCategory.is_active' => 1,
                    'ItemCategory.del_flag !=' => 1
                ]
            ]
        );
        //-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-

        //Setters
        $this->set('item_categories', $item_categories);
        //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-

        if($this->request->is('post'))
        {
            $data = $this->request->data;

            if ($resp = $this->Item->save($data)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Item successfully added.</b>
                                          </div>');
                //Redirect it to Edit Page of This Item
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $resp['Item']['id']));
            } else {
                //Failed to Save Item
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'add'));
            }
        }
    }


    /**
    *   EDIT Item
    *
    * @return void
    */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Item');

        $tmp = $this->Item->findById($id);

        //getItemCategories
        $item_categories = $this->ItemCategory->find('list',
            [
                'conditions' => [
                    'ItemCategory.is_active' => 1,
                    'ItemCategory.del_flag !=' => 1
                ]
            ]
        );
        //-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-

        //Setters
        $this->set('item_categories', $item_categories);
        //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-


        $this->set('data', $tmp);
        pr($tmp);
    }


    //------------------------------------------------
    //  API
    public function getAllVariants()
    {
        if ($this->request->is('post')) {

            $tmp = $this->Variant->find('all',
                [
                    'conditions' => [
                        'Variant.is_active' => 1,
                        'Variant.del_flag !=' => 1
                    ],
                    'fields' => [
                        'Variant.id',
                        'Variant.name'
                    ]
                ]
            );

            $res = new ResponseObject ( ) ;
            $res -> status = 'success' ;
            $res -> data = $tmp ;
            $res -> message = 'Variants are fetched.' ;
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

    //--------------------
    public function getAllProperties()
    {
        if ($this->request->is('post')) {

            $data = $this->request->input('json_decode',true);

            $tmp = $this->VariantProperty->find('all',
                [
                    'conditions' => [
                        'VariantProperty.variant_id' => $data['variant_id'],
                        'VariantProperty.is_active' => 1,
                        'VariantProperty.del_flag !=' => 1
                    ],
                    'fields' => [
                        'VariantProperty.id',
                        'VariantProperty.name'
                    ]
                ]
            );

            $res = new ResponseObject ( ) ;
            $res -> status = 'success' ;
            $res -> data = $tmp ;
            $res -> message = 'Variant Properties are fetched.' ;
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
