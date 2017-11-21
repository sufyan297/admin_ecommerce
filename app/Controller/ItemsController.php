<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'AllItems'); // mention at top

class ItemsController extends AppController
{
    public $components = array('Paginator','Special');
    public $uses = array('ItemCategory','Item','Variant','VariantProperty','ItemVariant','SellerItem','Seller','ItemSubCategory','ItemPhoto');

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


    //Private functions
    private function _checkUrlSlag($url_slag = null)
    {
        // $tmp = $this->Item->
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
            if (empty($data['Item']['item_sub_category_id'])) {
                $data['Item']['item_sub_category_id'] = null;
            }
            $url_slag = null;
            $url_slag = $this->Special->getItemUrlSlag($data['Item']['url_slag']);
            $chk_url_slag = $this->url_slag_exists($url_slag);
            if ($chk_url_slag != false) {
                $data['Item']['url_slag'] = $chk_url_slag;
            }

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
        if ($this->request->is('post')) {
            $data = $this->request->data;

            if (isset($data['Item']['show_description']) && $data['Item']['show_description'] == true) {
                $data['Item']['show_description'] = 1;                
            } else {
                $data['Item']['show_description'] = 0;
            }
            $this->Item->id = $id;
            if (empty($data['Item']['item_sub_category_id']) || $data['Item']['item_sub_category_id'] == 'undefined') {
                $data['Item']['item_sub_category_id'] = null;
            }

            $url_slag = null;
            $data['Item']['url_slag'] = $this->Special->getItemUrlSlag($data['Item']['url_slag']);

            if ($this->Item->save($data)) {
                //Successfully modified.
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Item successfully modified.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'view'));
            } else {
                //Failed to add
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong. Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $id));
            }
        }

        $this->set('data', $tmp);
    }

    /**
    *   View Page for Items
    *
    */
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Items');

        $this->Item->Behaviors->load('Containable');

        $q = "";
        if (isset($this->request->query['search'])) {
            $q = $this->request->query['search'];
        }

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Item.created DESC',
            'conditions' => [
                'Item.item_id' => null,
                'Item.del_flag !=' => 1,
                'OR' => [
                    'Item.name LIKE' => '%'.$q.'%',
                    'ItemCategory.name LIKE' => '%'.$q.'%'
                ]
            ],
            'contain' => [
                'ItemCategory'
            ]
        );
        $data = $this->Paginator->paginate('Item');
        $this->set('items', $data);
        $this->set('search_query', $q);

    }

    /**
    *   Delete Item (Soft delete)
    *
    * @return redirect
    */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->Item->id = $id;
            $tmp = [];
            $tmp['Item']['del_flag'] = 1;
            if ($this->Item->save($tmp)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Item successfully deleted.
                                          </div>');
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Failed to delete item. Please try again later.
                                          </div>');
            }

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'items','action'=>'view')));
        }
    }

    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    public function editChildItem()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $item_id = $data['Item']['item_id'];
            unset($data['Item']['item_id']);

            if ($this->Item->save($data)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Item successfully modified.</b>
                </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $item_id));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Oops! Something went wrong. Please try again later.</b>
                </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $item_id));
            }
        }
    }


    //-=======================================
    // Upload Multiple Photos
    public function multiPhotos()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $item_id = $data['ItemPhoto']['id'];
            // pr($data); die();
            unset($data['ItemPhoto']['id']);
            
            if ($this->ItemPhoto->save($data)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Item Photo successfully added.</b>
                </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $item_id));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Oops! Something went wrong. Please try again later.</b>
                </div>');
                return $this -> redirect(array('controller' => 'items', 'action' => 'edit', $item_id));
            }
            pr($data); die();
        }
    }

    public function savePhotoPriority()
    {
        if ($this->request->is('post')) {

            $data = $this->request->input('json_decode',true);
            
            $this->ItemPhoto->id = $data['id'];
            $data['ItemPhoto']['priority'] = $data['priority'];

            if ($this->ItemPhoto->save($data)) {

                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Photo Priority saved.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {

                $res = new ResponseObject ( ) ;
                $res -> status = 'error' ;
                $res -> message = 'Oops!! Something went wrong.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }
        }
    }

    //This is For Temp Purpose.
    // public function deletePhoto($id = null)
    // {
    //     if ($this->ItemPhoto->delete($id)) {
            
    //         $res = new ResponseObject ( ) ;
    //         $res -> status = 'success' ;
    //         $res -> message = 'Photo successfully removed.' ;
    //         $this -> response -> body ( json_encode ( $res ) ) ;
    //         return $this -> response ;
    //     } else {

    //         $res = new ResponseObject ( ) ;
    //         $res -> status = 'error' ;
    //         $res -> message = 'Oops!! Something went wrong.' ;
    //         $this -> response -> body ( json_encode ( $res ) ) ;
    //         return $this -> response ;
    //     }                
    // }
    //=-=-=-=-=-=-=-=-=-=-=-

    public function deleteItemPhoto()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);
            

            if ($this->ItemPhoto->delete($data['id'])) {
                
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Photo successfully removed.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {

                $res = new ResponseObject ( ) ;
                $res -> status = 'error' ;
                $res -> message = 'Oops!! Something went wrong.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }                
        }            
    }

    //----------------------------------
    private function _addItemChild($item_id = null, $id = null, $price = null, $discount_price = null)
    {
        if ($item_id != null && $price != null && $discount_price != null) {

            //getParentItem
            $parent_item = $this->Item->findById($item_id);

            unset($parent_item['Item']['id']);
            unset($parent_item['Item']['image_file']);
            unset($parent_item['Item']['image_dir']);
            unset($parent_item['Item']['kv_description']); //do not copy KV Description for Child Items.

            // $parent_item['Item']['image_file'] = null; //Legacy - After adding picture for Each Child
            // $parent_item['Item']['image_dir'] = null; //Legacy - After adding picture for Each Child

            $child_item = $parent_item; //clone it

            //update or add details
            $child_item['Item']['item_id'] = $item_id;
            $child_item['Item']['price'] = $price;
            $child_item['Item']['discount_price'] = $discount_price;

            if ($id == null) {
                $this->Item->create(); //create new child
            } else {
                $this->Item->id = $id; //update current one
            }

            if ($resp = $this->Item->save($child_item)) {
                if ($id != null) {
                    $resp['Item']['id'] = $id;
                }
                $this->log("RESPONSE: ");
                $this->log($resp);
                return $resp;
            }

        }
        return false;
    }

    //--------------------------
    private function _removeExistingVariants($child_item_id = null)
    {
        if ($child_item_id != null) {
            $this->ItemVariant->deleteAll(
                [
                    'ItemVariant.item_id' => $child_item_id
                ]
            );

            return true;
        }
        return false;
    }
    //----------------------
    private function _removeExistingSellerItems($child_item_id = null)
    {
        if ($child_item_id != null) {
            $this->SellerItem->deleteAll(
                [
                    'SellerItem.item_id' => $child_item_id
                ]
            );
            return true;
        }
        return false;
    }

    private function _addItemVariant($child_item_id = null, $variant_id = null, $variant_property_id = null)
    {
        if ($child_item_id != null && $variant_id != null && $variant_property_id != null) {
            $tmp = [];

            $tmp['ItemVariant']['item_id'] = $child_item_id;
            $tmp['ItemVariant']['variant_id'] = $variant_id;
            $tmp['ItemVariant']['variant_property_id'] = $variant_property_id;
            $this->ItemVariant->create();
            if ($resp = $this->ItemVariant->save($tmp)) {
                return $resp;
            }
        }
        return false;
    }

    private function _addSellerItem($seller_item_id = null, $child_item_id = null, $seller_id = null, $price = 0.00, $discount_price = 0.00, 
        $seller_sku_code = null
        ) {
        if ($child_item_id != null && $seller_id != null) {
            $tmp = [];

            $tmp['SellerItem']['item_id'] = $child_item_id;
            $tmp['SellerItem']['seller_id'] = $seller_id;
            $tmp['SellerItem']['price'] = $price;
            $tmp['SellerItem']['discount_price'] = $discount_price;
            $tmp['SellerItem']['seller_sku_code'] = $seller_sku_code;

            if ($seller_item_id == null) {
                $this->SellerItem->create();
            } else {
                $this->SellerItem->id = $seller_item_id;
            }
            if ($resp = $this->SellerItem->save($tmp)) {
                return $resp;
            }
        }
        return false;
    }

    public function removeSellerItem()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);

            if (isset($data['seller_item_id'])) {
                if ($this->SellerItem->delete($data['seller_item_id'])) {

                    $res = new ResponseObject ( ) ;
                    $res -> status = 'success' ;
                    $res -> message = 'Seller item removed.' ;
                    $this -> response -> body ( json_encode ( $res ) ) ;
                    return $this -> response ;    
                }
            }

            $res = new ResponseObject ( ) ;
            $res -> status = 'error' ;
            $res -> message = 'Oops! Something went wrong.' ;
            $this -> response -> body ( json_encode ( $res ) ) ;
            return $this -> response ;
        }
    }

    //------------------------------------------------
    //  API
    //--------------------------------------------
    /**
    *   Add Child Item
    *
    * @return void
    */
    public function addChildItem()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);

            $sorted_seller = [];
            //----------------------------------------------------------------------------
            if (isset($data['variant']['sellers']) && sizeof($data['variant']['sellers']) > 0) {
                //Sorted Seller List by Least discount Price on Top
                $sorted_seller = $this->Special->sortMultiArray('discount_price',$data['variant']['sellers']);

                $this->log("SORTED_ARRAY:");
                $this->log($sorted_seller);

                foreach ($sorted_seller as $key => $val) {
                    //Least Price for a Item Table
                    $data['variant']['price'] = $val['price'];
                    $data['variant']['discount_price'] = $val['discount_price'];
                    break;
                }
            }
            //----------------------------------------------------------------------------

            //Save Item Price
            $child_item = $this->_addItemChild($data['item_id'], $data['variant']['id'], $data['variant']['price'], $data['variant']['discount_price']);
            if ($child_item != false) {
                //AddThisItemForLoggedInSeller
                //For Now let's add for just single seller
                // $this->_removeExistingSellerItems($child_item['Item']['id']); //Legacy

                foreach ($sorted_seller as $key => $val) {
                    $this->_addSellerItem($val['seller_item_id'],$child_item['Item']['id'], $val['id'], $val['price'], $val['discount_price'], $val['seller_sku_code']); //
                }

                //-------------------
                //remove existing variants
                $this->_removeExistingVariants($child_item['Item']['id']);

                //Save Item Variants
                $this->log($data);
                foreach ($data['variant']['sub_variants'] as $key => $value) {
                    $this->_addItemVariant($child_item['Item']['id'], $value['variant_id'], $value['variant_property_id']);
                }

                //INDEX THIS ITEM
                try {
                    $all_items = new AllItemsController;
                    // Call a method from
                    $all_items->index_one($data['variant']['id']);
                } catch(Exception $err) {}

                //=-=-=-=-=-=-=-=-=-=-=-

                //Successfully added.
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> data = $child_item ;
                $res -> message = 'Child Item added.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {
                //SEND OOPS SOMETHING WENT WRONG.
                $res = new ResponseObject ( ) ;
                $res -> status = 'error' ;
                $res -> message = 'Oops! Something went wrong.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }
        }
    }

    public function removeChildItem()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);

            $tmp = [];
            $tmp['Item']['del_flag'] = 1;
            $this->Item->id = $data['child_item_id'];
            if ($this->Item->save($tmp)) {
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Child Item removed.' ;
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



    //---------------------------------
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

    //---------------------
    public function getAllChildItems()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);

            $this->Item->Behaviors->load('Containable');

            $item = $this->Item->find(
                'first',
                [
                    'fields' => [
                        'Item.id',
                        // 'Item.item_category_id'
                    ],
                    'conditions' => [
                        'Item.id' => $data['item_id']
                    ],
                    'contain' => [
                        'ChildItems' => [
                            'fields' => [
                                'ChildItems.id',
                                'ChildItems.price',
                                'ChildItems.discount_price',
                                'ChildItems.image_file',
                                'ChildItems.image_dir'
                            ],
                            'conditions' => [
                                'ChildItems.del_flag !=' => 1
                            ]
                        ],
                        'ChildItems.ItemVariant',
                        'ChildItems.SellerItem',
                        'ChildItems.ItemPhoto',
                        // 'ChildItems.ItemVariant.Variant' => [
                        //     'fields' => [
                        //         'Variant.id',
                        //         'Variant.name'
                        //     ]
                        // ],
                        // 'ChildItems.ItemVariant.VariantProperty' => [
                        //     'fields' => [
                        //         'VariantProperty.id',
                        //         'VariantProperty.name'
                        //     ]
                        // ],
                        'ChildItems.ItemVariant.Variant.VariantProperty' => [
                            'fields' => [
                                'VariantProperty.id',
                                'VariantProperty.name'
                            ]
                        ]
                    ]
                ]
            );

            //vars
            $child_items = [];

            $this->log("ITEM");
            $this->log($item);

            // //getChildItems
            foreach ($item['ChildItems'] as $key => $value) {
                $tmp = [];
                $tmp['id'] = $value['id'];
                $tmp['price'] = $value['price'];
                $tmp['discount_price'] = $value['discount_price'];
                $tmp['image_file'] = $value['image_file'];
                $tmp['image_dir'] = $value['image_dir'];
                

                $tmp['sub_variants'] = [];
                $tmp['sellers'] = [];
                $tmp['item_photos'] = [];
                
                foreach ($value['ItemVariant'] as $key => $val2) {
                    $tmp2 = [];
                    $tmp2['variant_id'] = $val2['variant_id'];
                    $tmp2['variant_property_id'] = $val2['variant_property_id'];
                    $tmp2['all_properties'] = [];
                    foreach ($val2['Variant']['VariantProperty'] as $key => $val3) {
                        $tmp3 = [];
                        $tmp3['VariantProperty']['id'] = $val3['id'];
                        $tmp3['VariantProperty']['name'] = $val3['name'];

                        array_push($tmp2['all_properties'], $tmp3);
                    }

                    // $this->log("SUB_CHILD_ITEM");
                    // $this->log($tmp2);

                    array_push($tmp['sub_variants'], $tmp2);
                }
                foreach ($value['SellerItem'] as $key => $val3) {
                    $tmp4 = [];
                    $tmp4['id'] = $val3['seller_id'];
                    $tmp4['price'] = $val3['price'];
                    $tmp4['discount_price'] = $val3['discount_price'];
                    $tmp4['seller_item_id'] = $val3['id'];
                    $tmp4['seller_sku_code'] = $val3['seller_sku_code'];
                    
                    array_push($tmp['sellers'], $tmp4);
                }

                //ItemPhotos
                foreach ($value['ItemPhoto'] as $key4 => $val4) {
                    $tmp5 = [];

                    $tmp5['id'] = $val4['id'];
                    $tmp5['image_file'] = $val4['image_file'];
                    $tmp5['image_dir'] = $val4['image_dir'];
                    $tmp5['priority'] = $val4['priority'];

                    array_push($tmp['item_photos'], $tmp5);
                }
                // $this->log("CHILD_ITEM");
                // $this->log($tmp);
                array_push($child_items, $tmp);
            }
            //
            // $item_vars =
            // $this->log($child_items);
            $res = new ResponseObject ( ) ;
            $res -> status = 'success' ;
            $res -> data = $child_items ;
            $res -> message = 'Child items are fetched.' ;
            $this -> response -> body ( json_encode ( $res ) ) ;
            return $this -> response ;
        }
    }

    /**
    *   Bulk Items Upload
    *
    * @return void
    */
    public function bulk_upload_items()
    {
        error_reporting(0);
        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $file=$this->data['BulkItem']['file'];
            $organization_id = $data['BulkItem']['organization_id'];

            $file_name=$this->data['BulkItem']['file']['name'];
            $target_path = APP."uploads/";
            $path_parts = pathinfo($this->data['BulkItem']['file']['name']);
            $extension = $path_parts['extension'];


            if ($extension == "xls" || $extension == "xlsx")
            {
                $target_path = $target_path."bulk_items.".$extension;
                move_uploaded_file($this->data['BulkItem']['file']['tmp_name'], $target_path);

                //PHP Import
                $path = ROOT . DS . "vendors" . DS. "Classes" . DS;
                ini_set('max_execution_time', 1000000); //increase max_execution_time to 10 min if data set is very large
                set_include_path($path);
                include 'PHPExcel/IOFactory.php';
                try {
                    $objPHPExcel = PHPExcel_IOFactory::load($target_path);
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                    $success_count = 0;
                    $failure_count = 0;
                    $idx = 0;
                    foreach ($sheetData as $key => $value) {
                        if ($idx != 0) { //Ignore Header Line Which is First Line in Excel Sheet

                            $chk_flg = false;
                            $item_category_id = null;
                            $item_sub_category_id = null;

                            $item_category_id = $this->getCategoryId($value['B']);

                            if ($item_category_id != false) {
                                //If SubCategory Is available then get it's ID
                                if (!empty($value['C'])) {
                                    $item_sub_category_id = $this->getSubCategoryId($item_category_id, $value['C']);
                                }
                                //-------------------------------------------------------

                                $resp = $this->addItem($value['A'], $item_category_id, $item_sub_category_id, $value['D'], $value['E'], $value['F']);
                                if ($resp != false) {
                                    //Successfully Inserted
                                    //Success_Count ++;
                                    $success_count ++;
                                    $chk_flg = true;
                                }
                            }

                            if ($chk_flg == false) {
                                //Fail to Insert due to Invalid Category.
                                //Or Something Went Wrong
                                $failure_count ++;
                            }

                        }

                        $idx++;
                    }
                    $tmp_msg = "Operation successfully completed.<br/> Successfully Added Items: <b>". $success_count . "</b><br/>Failed to Add Items: <b>".$failure_count."</b>";
                    $this->Session->setFlash('<div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                '.$tmp_msg.'
                                              </div>');

                    return $this -> redirect(array('controller' => 'items', 'action' => 'view'));
                } catch(Exception $e) {
                    die('Error loading file "'.pathinfo($target_path,PATHINFO_BASENAME).'": '.$e->getMessage());
                }

            }
        }
    }

    private function url_slag_exists($url_slag = null)
    {
        $new_url_slag = "";
        $item = $this->Item->find('count',
            [
                'conditions' => [
                    'Item.url_slag' => $url_slag,
                    'Item.item_id' => null
                ]
            ]
        );

        if ($item != 0) {
            //URL_SLAG_EXISTS
            $new_url_slag = $url_slag."-".$item;
            return $new_url_slag;
        }
        return false; //URL_SLAG_DOES_NOT_EXISTS
    }

    /**
    *   Add Item
    *
    */
    public function addItem($item_name = null, $item_category_id = null, $item_sub_category_id = null, $short_desc = null, $long_desc = null, $keyword = null)
    {
        $item = [];
        $item['Item']['name'] = $item_name;

        //Legacy
        // $url_slag = str_replace(" ","-", strtolower($item_name));
        // $url_slag = str_replace("'","", $url_slag);
        //=-=-=-=-=-=-=-=-
        $url_slag = $this->Special->getItemUrlSlag($item['Item']['name']);
        $chk_url_slag = $this->url_slag_exists($url_slag);
        if ($chk_url_slag != false) {
            //Already_Exists_It Means we got another URL_SLAG
            $url_slag = $chk_url_slag;
        }

        $item['Item']['url_slag'] = $url_slag;
        $item['Item']['sku_code'] = null;
        $item['Item']['item_id'] = null;
        $item['Item']['short_desc'] = $short_desc;
        $item['Item']['long_desc'] = $long_desc;
        $item['Item']['keyword'] = $keyword;
        $item['Item']['item_category_id'] = $item_category_id;
        $item['Item']['item_sub_category_id'] = $item_sub_category_id;
        $item['Item']['is_active'] = 1;
        $item['Item']['del_flag'] = 0;

        if ($resp = $this->Item->save($item)) {
            return $resp;
        }
        return false;
    }


    /**
    *   Get Category Id By Name
    *
    * @return item_category_id
    */
    public function getCategoryId($category_name = null)
    {
        if ($category_name != null) {
            $this->ItemCategory->Behaviors->load('Containable');
            $category_name = trim($category_name);
            $cat = $this->ItemCategory->findByName($category_name);

            if (!empty($cat)) {
                return $cat['ItemCategory']['id'];
            }
        }
        return false;
    }


    /**
    *   Get Subcategory Id
    *
    * @return sub_category_id
    */
    public function getSubCategoryId($item_category_id = null, $sub_category_name = null)
    {
        if ($item_category_id != null && $sub_category_name != null) {
            $sub_category_name = trim($sub_category_name);

            $cat = $this->ItemSubCategory->find('first',
                [
                    'conditions' => [
                        'ItemSubCategory.item_category_id' => $item_category_id,
                        'ItemSubCategory.name' => $sub_category_name
                    ]
                ]
            );

            if (!empty($cat)) {
                return $cat['ItemSubCategory']['id'];
            }
        }
        return false;
    }


    /**
     *  Other Details
     * 
     * @return json
     */
    public function editItemDescription()
    {
        if ($this->request->is('post')) {
            
            $data = $this->request->input('json_decode',true);

            $tmp = [];
            $this->Item->id = $data['item_id'];
            $tmp['Item']['kv_description'] = json_encode($data['kv_description']);

            if ($this->Item->save($tmp)) {
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Key/Value Description successfully updated.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            } else {
                $res = new ResponseObject ( ) ;
                $res -> status = 'success' ;
                $res -> message = 'Oops!! Something went wrong. Please try again later.' ;
                $this -> response -> body ( json_encode ( $res ) ) ;
                return $this -> response ;
            }
        }            
    }
    
}
?>
