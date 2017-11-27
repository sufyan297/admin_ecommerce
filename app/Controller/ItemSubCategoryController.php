<?php
App::uses('AppController', 'Controller');

class ItemSubCategoryController extends AppController
{
    public $components = array('Paginator','Special');
    public $uses = array('ItemSubCategory','ItemCategory');

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
    *   ADD ItemSubCategory
    *
    * @return void
    */
    public function add($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Item category');

        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $data['ItemSubCategory']['item_category_id'] = $id;
            $data['ItemSubCategory']['url_slag'] = $this->Special->getUrlSlag($data['ItemSubCategory']['name']);
            
            if ($this->ItemSubCategory->save($data)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>ItemSubCategory successfully added.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_sub_category', 'action' => 'view', $id));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_sub_category', 'action' => 'add', $id));
            }
        }
    }

    /**
    *   Edit ItemSubCategory
    *
    * @return void
    */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Item category');

        $tmp = $this->ItemSubCategory->findById($id);
        $this->set('data', $tmp);
        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->ItemSubCategory->id = $id;
            $data['ItemSubCategory']['url_slag'] = $this->Special->getUrlSlag($data['ItemSubCategory']['name']);
            
            if ($this->ItemSubCategory->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>ItemSubCategory successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_sub_category', 'action' => 'view', $tmp['ItemSubCategory']['item_category_id']));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_sub_category', 'action' => 'edit', $tmp['ItemSubCategory']['item_category_id']));
            }
        }

    }


    /**
    *   View ItemSubCategory
    *
    * @return void
    */
    public function view($category_id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Item Sub Categories');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'ItemSubCategory.created DESC',
            'conditions' => [
                'ItemSubCategory.item_category_id' => $category_id,
                'ItemSubCategory.is_active' => 1,
                'ItemSubCategory.del_flag !=' => 1
            ]
        );
        $data = $this->Paginator->paginate('ItemSubCategory');
        $this->set('item_sub_categories', $data);
        $this->set('item_category_id', $category_id);
    }

    /**
    *   Delete ItemSubCategory
    *
    * @return redirect
    */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->ItemSubCategory->id = $id;
            $sub_cat = $this->ItemSubCategory->findById($id);
            $tmp = [];
            $tmp['ItemSubCategory']['del_flag'] = 1;
            if ($this->ItemSubCategory->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            ItemSubCategory successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete Item Category. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'item_sub_category','action'=>'view', $sub_cat['ItemSubCategory']['item_category_id'])));
        }
    }


    //-------------------------------------------------------------------------------
    // API
    public function getSubCategories()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);
            $this->ItemSubCategory->Behaviors->load('Containable');

            $sub_categories = $this->ItemSubCategory->find('all',
                [
                    'conditions' => [
                        'ItemSubCategory.is_active' => 1,
                        'ItemSubCategory.del_flag' => 0,
                        'ItemSubCategory.item_category_id' => $data['category_id']
                    ],
                    'contain' => []
                ]
            );

            if (!empty($sub_categories)) {
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> data = $sub_categories ;
                $res -> message = 'Item sub categories found.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {
                $res = new ResponseObject ( ) ;
                $res -> status = 'error' ;
                $res -> message = 'no sub categories found.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }
        }
    }
}
?>
