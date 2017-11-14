<?php
App::uses('AppController', 'Controller');

class MenusController extends AppController
{
    public $components = array('Paginator');
    public $uses = ['Menu','MenuItem','ItemCategory'];

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
    *   Index
    *
    * @return void
    */
    public function index()
    {

    }


    /**
     *  View Menu
     * 
     * @return void
     */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Menus');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Menu.priority',
            'conditions' => [
                'Menu.is_active' => 1
            ]
        );
        $data = $this->Paginator->paginate('Menu');

        $this->set('menus', $data);
        
    }


    /**
     *  Save Priority
     * 
     * @return json
     */
    public function save_priority()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true );

            $this->log($data);
            $this->Menu->id = $data['menu_id'];            
            $data['Menu']['priority'] = $data['priority'];


            if ($this->Menu->save($data)) {
                //Successfully added.
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Priority saved.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {
                $res = new ResponseObject ( ) ;
                $res -> status = 'error' ;
                $res -> message = 'Oops! Something went wrong.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }
        }
    }


    /**
     *  Add Menu
     * 
     * @return void
     */
    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Menu');

        if ($this->request->is('post')) {
            $data = $this->request->data;

            if ($this->Menu->save($data)) {
                $this->Session->setFlash('
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Menu `'.$data['Menu']['name'].'` added.
                </div>');
                return $this->redirect(['controller'=> 'menus', 'action' => 'view']); 
            } else {
                $this->Session->setFlash('
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Oops! Something went wrong. Please try again later.
                </div>');
                return $this->redirect(['controller' => 'menus', 'action' => 'view']); 
            }
        }
    }


    /**
     *  Edit Menu
     * 
     * @param uuid $menu_id Menu ID
     * 
     * @return void
     */
    public function edit($menu_id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Menu');

        $tmp = $this->Menu->findById($menu_id);
        $this->set('menu', $tmp);

        if ($this->request->is('post')) {
            $data = $this->request->data;

            $data['Menu']['id'] = $menu_id;
            
            if ($this->Menu->save($data)) {
                $this->Session->setFlash('
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Menu `'.$data['Menu']['name'].'` modified.
                </div>');
                return $this->redirect(['controller'=> 'menus', 'action' => 'view']); 
            } else {
                $this->Session->setFlash('
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Oops! Something went wrong. Please try again later.
                </div>');
                return $this->redirect(['controller' => 'menus', 'action' => 'view']); 
            }
        }
    }


    /**
     * Add Menu Item
     * 
     * @param uuid $menu_id Menu ID (Parent)
     * 
     * @return void
     */
    public function add_item($menu_id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Menu Item');

        $category_list = $this->ItemCategory->find('list',
            [
                'conditions' => [
                    'ItemCategory.is_active' => 1,
                    'ItemCategory.del_flag !=' => 1
                ]
            ]
        );

        $this->set('category_list', $category_list);
        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $data['MenuItem']['menu_id'] = $menu_id;

            if (!$this->_checkItemCategoryExists($menu_id, $data['MenuItem']['item_category_id'])) {
                if ($this->MenuItem->save($data)) {
                    //Successfully added.
                    $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Menu Item successfully added.</b>
                                              </div>');
                    return $this -> redirect(array('controller' => 'menus', 'action' => 'view_items', $menu_id));
                } else {
                    //Failed to add
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Oops! Something went wrong. Please try again later.</b>
                                              </div>');
                    return $this -> redirect(array('controller' => 'menus', 'action' => 'add_item', $menu_id));
                }
            } else {
                //This category already exists in that menu.
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>This item category already exists in menu.</b>
                </div>');
                return $this -> redirect(array('controller' => 'menus', 'action' => 'add_item', $menu_id));
            }
        }
    }


    /**
     * View Menu Items
     * 
     * @return void
     */
    public function view_items($menu_id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Menu Items');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'MenuItem.modified DESC',
            'conditions' => [
                'MenuItem.menu_id' => $menu_id
            ]
        );
        $data = $this->Paginator->paginate('MenuItem');

        $this->set('menu_items', $data);
        $this->set('menu_id', $menu_id);
    }


    /**
     * Remove Item
     * 
     * @return void
     */
    public function delete_item($menu_item_id = null)
    {
        if ($menu_item_id != null) {
            if ($this->MenuItem->delete($menu_item_id)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Menu item successfully deleted.</b>
                </div>');
                return $this -> redirect(array('controller' => 'menus', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Oops! Something went wrong. Please try again later.</b>
                </div>');
                return $this -> redirect(array('controller' => 'menus', 'action' => 'view'));
            }
        }
    }

    /**
     * Check Item Category already exists in same Menu.
     * 
     * @return boolean
     */
    private function _checkItemCategoryExists($menu_id = null, $item_category_id = null)
    {

        $tmp = $this->MenuItem->find('first',
            [
                'conditions' => [
                    'MenuItem.menu_id' => $menu_id,
                    'MenuItem.item_category_id' => $item_category_id
                ]
            ]
        );

        if (empty($tmp)) {
            return false;
        } else {
            return true;
        }
    }
}
?>
