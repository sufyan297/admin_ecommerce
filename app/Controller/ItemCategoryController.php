<?php
App::uses('AppController', 'Controller');

class ItemCategoryController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('ItemCategory');

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
    *   ADD ItemCategory
    *
    * @return void
    */
    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Item category');

        if($this->request->is('post'))
        {
            $data = $this->request->data;

            if ($this->ItemCategory->save($data)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>ItemCategory successfully added.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_category', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_category', 'action' => 'add'));
            }
        }
    }

    /**
    *   Edit ItemCategory
    *
    * @return void
    */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Item category');

        $tmp = $this->ItemCategory->findById($id);
        $this->set('data', $tmp);
        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->ItemCategory->id = $id;
            if ($this->ItemCategory->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>ItemCategory successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_category', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'item_category', 'action' => 'edit', $id));
            }
        }

    }


    /**
    *   View ItemCategory
    *
    * @return void
    */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Item Categories');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'ItemCategory.created DESC',
            'conditions' => [
                'ItemCategory.is_active' => 1,
                'ItemCategory.del_flag !=' => 1
            ]
        );
        $data = $this->Paginator->paginate('ItemCategory');
        $this->set('item_categories', $data);
    }

    /**
    *   Delete ItemCategory
    *
    * @return redirect
    */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->ItemCategory->id = $id;
            $tmp = [];
            $tmp['ItemCategory']['del_flag'] = 1;
            if ($this->ItemCategory->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            ItemCategory successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete variant. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'item_category','action'=>'view')));
        }
    }

}
?>
