<?php
App::uses('AppController', 'Controller');

class VariantsController extends AppController
{
    public $components = array('Paginator','Special');
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
    *   ADD Variant
    *
    * @return void
    */
    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add variant');

        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $data['Variant']['url_slag'] = $this->Special->getUrlSlag($data['Variant']['name']);

            if ($this->Variant->save($data)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Variant successfully added.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'add'));
            }
        }
    }

    /**
    *   Edit Variant
    *
    * @return void
    */
    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit variant');

        $tmp = $this->Variant->findById($id);
        $this->set('data', $tmp);
        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->Variant->id = $id;
            $data['Variant']['url_slag'] = $this->Special->getUrlSlag($data['Variant']['name']);

            if ($this->Variant->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Variant successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'edit', $id));
            }
        }

    }


    /**
    *   View Variant
    *
    * @return void
    */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View variants');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Variant.created DESC',
            'conditions' => [
                'Variant.is_active' => 1,
                'Variant.del_flag !=' => 1
            ]
        );
        $data = $this->Paginator->paginate('Variant');
        $this->set('variants', $data);
    }

    /**
    *   Delete Variant
    *
    * @return redirect
    */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->Variant->id = $id;
            $tmp = [];
            $tmp['Variant']['del_flag'] = 1;
            if ($this->Variant->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Variant successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete variant. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'variants','action'=>'view')));
        }
    }


//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//      Variant Properties
//-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-
    /**
    *   Add Property
    *
    *
    * @return void
    */
    public function add_property($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Property');

        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $data['VariantProperty']['variant_id'] = $id;
            $data['VariantProperty']['url_slag'] = $this->Special->getUrlSlag($data['VariantProperty']['name']);

            if ($this->VariantProperty->save($data)) {
                //Successfully added.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Variant Property successfully added.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'view_properties', $id));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'add_property'));
            }
        }
    }

    /**
    *   View Properties
    *
    *
    * @return void
    */
    public function view_properties($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Properties');

        $tmp = $this->Variant->findById($id);
        $this->set('variant', $tmp);

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'VariantProperty.created DESC',
            'conditions' => [
                'VariantProperty.is_active' => 1,
                'VariantProperty.del_flag !=' => 1,
                'VariantProperty.variant_id' => $id
            ]
        );
        $data = $this->Paginator->paginate('VariantProperty');
        $this->set('variant_properties', $data);
    }

    /**
    *   Edit property
    *
    * @return void
    */
    public function edit_property($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Property');

        $tmp = $this->VariantProperty->findById($id);
        $this->set('data', $tmp);
        if($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->VariantProperty->id = $id;
            $data['VariantProperty']['url_slag'] = $this->Special->getUrlSlag($data['VariantProperty']['name']);

            if ($this->VariantProperty->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Property successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'view_properties', $tmp['VariantProperty']['variant_id']));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'variants', 'action' => 'edit_property', $id));
            }
        }
    }


    /**
    *   Delete property
    *
    *
    * @return redirect
    */
    public function delete_property($id = null)
    {
        if ($id != null) {
            $this->VariantProperty->id = $id;

            $data = $this->VariantProperty->findById($id);
            $tmp = [];
            $tmp['VariantProperty']['del_flag'] = 1;
            if ($this->VariantProperty->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Property successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete property. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'variants','action'=>'view_properties', $data['VariantProperty']['variant_id'])));
        }
    }

}
?>
