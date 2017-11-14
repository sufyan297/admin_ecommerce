<?php
App::uses('AppController', 'Controller');

class AllItemsController extends AppController
{
    public $components = array('Paginator','Special');
    public $uses = array('AllItem','ItemCategory','Item','Variant','VariantProperty','ItemVariant','SellerItem','Seller','ItemSubCategory');

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
    *   Index All The Items
    *
    * @return array
    */
    public function index_all()
    {
        //GetItems By Page

        $this->Item->Behaviors->load('Containable');

        $this->Paginator->settings = array(
            'order' => 'Item.created DESC',
            'conditions' => [
                'Item.del_flag !=' => 1,
                'Item.item_id !=' => null //getting child items
            ],
            'fields' => [
                'Item.id',
                // 'Item.item_id'
            ],
            'contain' => []
        );

        $item_data = $this->Paginator->paginate('Item');
        if (!empty($item_data)) {
            $item_ids = $this->getItemIds($item_data);

            //We are going to Break Item_Ids in `100` Chunks
            $chunk_item_ids = array_chunk($item_ids, 100);
            foreach ($chunk_item_ids as $key => $chunk_ids) {
                $all_item_data = $this->getAllItemDetails($chunk_ids);
                
                // pr($all_item_data);die();
                $formatted_array_for_saveMany = $this->saveManyArray($all_item_data);

                if ($this->AllItem->saveMany($formatted_array_for_saveMany)) {
                    //successfully saved.
                }
            }

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Items indexes successfully updated.
                                      </div>');

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'items','action'=>'view')));
        } else {
            //[404] Oops No Items Found!
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Items indexes failed to update.
                                      </div>');

            return $this->redirect($this->Auth->redirectUrl(array('controller'=>'items','action'=>'view')));
        }

        pr($item_data);
    }


    /**
    *   Proper Formatted Array Which we can easily saveMany
    *
    * @return array
    */
    public function saveManyArray($item_data = [])
    {
        $arr = [];
        foreach ($item_data as $key => $val) {

            $tmp = [];
            $tmp_arr = [];

            $tmp['AllItem']['name'] = $val['Item']['name'];
            $tmp['AllItem']['item_id'] = $val['Item']['id']; //Child ItemID
            $tmp['AllItem']['parent_item_id'] = $val['Item']['item_id']; //Parent ItemID

            $tmp['AllItem']['price'] = $val['SellerItem'][0]['price'];
            $tmp['AllItem']['discount_price'] = $val['SellerItem'][0]['discount_price'];
            $tmp['AllItem']['seller_id'] = $val['SellerItem'][0]['seller_id'];
            $tmp['AllItem']['seller_name'] = $val['SellerItem'][0]['Seller']['name'];

            $tmp['AllItem']['url_slag'] = $val['Item']['url_slag'];
            $tmp['AllItem']['item_category_id'] = $val['Item']['item_category_id'];
            $tmp['AllItem']['item_sub_category_id'] = $val['Item']['item_sub_category_id'];

            $tmp['AllItem']['item_category_url_slag'] = $val['ItemCategory']['url_slag'];
            $tmp['AllItem']['item_sub_category_url_slag'] = $val['ItemSubCategory']['url_slag'];
            

            $tmp['AllItem']['sellers'] = json_encode($val['SellerItem']);

            foreach ($val['ItemVariant'] as $key => $itm_var) {
                $tmp['AllItem'][$itm_var['Variant']['url_slag']] = $itm_var['VariantProperty']['url_slag'];

                $tmp2 = [];
                $tmp2['v_url_slag'] = $itm_var['Variant']['url_slag'];
                $tmp2['vp_url_slag'] = $itm_var['VariantProperty']['url_slag'];

                array_push($tmp_arr, $tmp2);
            }

            $tmp['AllItem']['available_variants'] = json_encode($tmp_arr);
            $tmp['AllItem']['is_active'] = $val['Item']['is_active'];
            $tmp['AllItem']['del_flag'] = $val['Item']['del_flag'];

            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            $this->deleteChildItem($val['Item']['id']);
            //-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            array_push($arr, $tmp);
        }

        return $arr;
    }


    /**
    *   Delete Child Item From AllItem
    *
    * @return boolean
    */
    public function deleteChildItem($item_id = null)
    {
        $tmp = $this->AllItem->deleteAll(
            [
                'AllItem.item_id' => $item_id
            ]
        );
        return true;
    }


    /**
    *   Make Item Ids in Proper format so we can pass in 'IN' query.
    *
    * @return array
    */
    public function getItemIds($item_ids = [])
    {
        $new_item_ids = [];
        foreach ($item_ids as $key => $value) {
            $new_item_ids[] = $value['Item']['id'];
        }
        return $new_item_ids;
    }

    /**
    *   Multi Item Data
    * @return array
    */
    public function getAllItemDetails($item_ids = [])
    {
        $this->Item->Behaviors->load('Containable');

        $items = $this->Item->find('all',
            [
                'conditions' => [
                    'Item.id IN' => $item_ids
                ],
                'contain' => [
                    'SellerItem' => [
                        'order' => 'SellerItem.discount_price'
                    ],
                    'SellerItem.Seller',
                    'ItemVariant',
                    'ItemVariant.Variant',
                    'ItemVariant.VariantProperty',
                    'ItemCategory',
                    'ItemSubCategory'
                ]
            ]
        );

        return $items;
    }

    /**
    *   Get Each Item Data
    *
    * @return array
    */
    public function getItemDetails($item_id = null)
    {
        $item = $this->Item->find('all',
            [
                'conditions' => [
                    'Item.id' => $item_id
                ]
            ]
        );

        // pr($item); die();
        return $item;
    }
}
?>
