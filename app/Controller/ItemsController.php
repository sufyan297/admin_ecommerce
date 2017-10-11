<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController
{
    public $components = array('Paginator','Special');
    public $uses = array('ItemCategory','Item','Variant','VariantProperty','ItemVariant','SellerItem','Seller');

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
            if (empty($data['Item']['item_sub_category_id'])) {
                $data['Item']['item_sub_category_id'] = null;
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
            $this->Item->id = $id;
            if (empty($data['Item']['item_sub_category_id']) || $data['Item']['item_sub_category_id'] == 'undefined') {
                $data['Item']['item_sub_category_id'] = null;
            }

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
    //----------------------------------
    private function _addItemChild($item_id = null, $id = null, $price = null, $discount_price = null)
    {
        if ($item_id != null && $price != null && $discount_price != null) {

            //getParentItem
            $parent_item = $this->Item->findById($item_id);

            unset($parent_item['Item']['id']);
            $parent_item['Item']['image_file'] = null;
            $parent_item['Item']['image_dir'] = null;

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

    private function _addSellerItem($child_item_id = null, $seller_id = null, $price = 0.00, $discount_price = 0.00)
    {
        if ($child_item_id != null && $seller_id != null) {
            $tmp = [];

            $tmp['SellerItem']['item_id'] = $child_item_id;
            $tmp['SellerItem']['seller_id'] = $seller_id;
            $tmp['SellerItem']['price'] = $price;
            $tmp['SellerItem']['discount_price'] = $discount_price;
            $this->SellerItem->create();
            if ($resp = $this->SellerItem->save($tmp)) {
                return $resp;
            }
        }
        return false;
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
            $child_item = $this->_addItemChild($data['item_id'],$data['variant']['id'], $data['variant']['price'], $data['variant']['discount_price']);
            if ($child_item != false) {
                //AddThisItemForLoggedInSeller
                //For Now let's add for just single seller
                $this->_removeExistingSellerItems($child_item['Item']['id']);

                foreach ($sorted_seller as $key => $val) {
                    $this->_addSellerItem($child_item['Item']['id'], $val['id'], $val['price'], $val['discount_price']); //
                }

                //-------------------
                //remove existing variants
                $this->_removeExistingVariants($child_item['Item']['id']);

                //Save Item Variants
                $this->log($data);
                foreach ($data['variant']['sub_variants'] as $key => $value) {
                    $this->_addItemVariant($child_item['Item']['id'], $value['variant_id'], $value['variant_property_id']);
                }

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
                            ],
                            'conditions' => [
                                'ChildItems.del_flag !=' => 1
                            ]
                        ],
                        'ChildItems.ItemVariant',
                        'ChildItems.SellerItem',
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

                $tmp['sub_variants'] = [];
                $tmp['sellers'] = [];

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

                    array_push($tmp['sellers'], $tmp4);
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

}
?>
