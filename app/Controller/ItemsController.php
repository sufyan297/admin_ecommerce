<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('Variant','VariantProperty');

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
        //Setters
        $this->set('item_categories', $item_categories);
        //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-
        if($this->request->is('post'))
        {
            $data = $this->request->data;


        }
    }

}
?>
