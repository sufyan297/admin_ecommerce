<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Item<small>Items</small></h1>
</section>

<section class="content" ng-controller="EditItemController">
	<?php
		echo $this->Session->flash();
	?>
    <!-- form start -->
    <?php echo $this->Form->create('Item',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Item Details</h3>

		            <div class="box-tools pull-right">
                        <a href="<?= $this->Html->url(array('controller' => 'items', 'action' => 'view')) ?>" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>
                        </a>

		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	              <div class="box-body">
                      <!-- Row -->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputName">Name<span style='color: red;'>*</span></label>
                                <?php echo $this->Form->input('name',array(
                                  'id' => 'inputName',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Item Name',
                                  'label'=>false,
                                  'required' => 'required',
                                  'autofocus' => 'autofocus',
                                  'onChange' => 'changeUrlSlag()',
                                  'value' => $data['Item']['name']
                                ));
                                ?>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputKeywords">Keywords</label>
                                <?php echo $this->Form->input('keyword',array(
                                  'id' => 'inputKeywords',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Keywords',
                                  'label'=>false,
                                  'value' => $data['Item']['keyword']
                                ));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Ends Here -->


                      <!-- Row -->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="item_category">Item Category<span style='color: red;'>*</span></label>

                                <select id="item_category" ng-model="obj.category_id" class="form-control select2" ng-change="getSubCategories()" required>
                                    <option ng-repeat="cat in obj.categories" value="{{cat.ItemCategory.id}}">{{cat.ItemCategory.name}}</option>
                                </select>

                                <?= $this -> Form -> input('item_category_id', array(
                                    'class' => 'form-control',
                                    'id'=>'inputCategoryId',
                                    'label' => false,
                                    'type' => 'hidden',
                                    'div' => false,
                                    'value' => $data['Item']['item_category_id'])
                                ); ?>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputSKUCode">SKU Code</label>
                                <?php echo $this->Form->input('sku_code',array(
                                  'id' => 'inputSKUCode',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter SKU Code for eg. SKU0001',
                                  'label'=>false,
                                  'value' => $data['Item']['sku_code']
                                ));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Ends Here -->

                      <!-- Row -->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="inputSubCategory">Sub Category</label>
                                  <select id="inputSubCategory" ng-model="obj.sub_category_id" class="form-control select2" ng-change="changeSubCategory()" required>
                                      <option ng-repeat="cat in obj.sub_categories" value="{{cat.ItemSubCategory.id}}">{{cat.ItemSubCategory.name}}</option>
                                  </select>
                                  <?php echo $this->Form->input('item_sub_category_id',array(
                                    'id' => 'inputSubCategoryId',
                                    'class'=>"form-control",
                                    'type' => 'hidden',
                                    'label'=>false,
                                    'value' => $data['Item']['item_sub_category_id']
                                  ));
                                  ?>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputURLSlag">URL Slag<span style='color: red;'>*</span></label>
                                <?php echo $this->Form->input('url_slag',array(
                                  'id' => 'inputURLSlag',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Url Slag',
                                  'label'=>false,
                                  'value' => $data['Item']['url_slag']
                                ));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Ends Here -->


                      <!-- Row -->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputShortDescription">Short Description<span style='color: red;'>*</span></label>
                                <?php echo $this->Form->textarea('short_desc',array(
                                  'id' => 'inputShortDescription',
                                  'class'=>"form-control",
                                  'placeholder'=>'Short description',
                                  'label'=>false,
                                  'required' => 'required',
                                  'value' => $data['Item']['short_desc']
                                ));
                                ?>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputLongDescription">Long Description<span style='color: red;'>*</span></label>
                                <?php echo $this->Form->textarea('long_desc',array(
                                  'id' => 'inputLongDescription',
                                  'class'=>"form-control",
                                  'placeholder'=>'Long description',
                                  'label'=>false,
                                  'value' => $data['Item']['long_desc']
                                ));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Ends Here -->


                        <!-- Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="inputKeyVal">
                                    <?= $this -> Form -> checkbox('show_description', array(
                                        'id' => 'inputKeyVal',
                                        'hiddenField' => false,
                                        'checked'=>$data['Item']['show_description'],
                                        'ng-model' => 'input_show_kv_panel',
                                        'ng-change' => 'toggleKVPanel()'
                                        )
                                    ); ?> Show Key/Value Pair description
                                </label>
                                <input id="inputKeyValuePair" type="hidden" value="<?= $data['Item']['show_description']?>" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            </div>
                        </div>
                    </div>
                    <!-- Ends Here -->


	            	</div>
	              <!-- /.box-body -->
                  <div class="box-footer">
                      <?php
                          echo $this->Form->input('Edit Item',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                      ?>
                  </div>
	        </div>
		</div>
	</div>


    <!-- Primary Photo -->
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Upload Primary Photo</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	              <div class="box-body">

                      <!-- Row Start -->
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <?=  $this->Html->image($IMAGE_BASE_URL.'item/image_file/'.$data['Item']['image_dir']."/sm_".$data['Item']['image_file']); ?>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="inputPhoto">Photo</label>
                                <?php
                                    echo $this->Form->input("image_file",array('id'=>'inputPhoto','type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->
	            	</div>
	                <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Change Picture',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
	        </div>
		</div>
	</div>
    <?php echo $this->Form->end(); ?>

    <!-- Primary Photo ends here -->
    <!-- Hidden Fields -->
        <input id="data_item_id" type="hidden" value="<?= $data['Item']['id'] ?>" />
        <input type="hidden" ng-model="item_id"/>
    <!-- Hidden Fields Over Here -->

    <!-- Item Specification -->

    <textarea id="kv_description_json" style="display: none;"><?= $data['Item']['kv_description'] ?></textarea>

    <div class="row" ng-show="show_kv_panel">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	                <h3 class="box-title">Other details: </h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputHeading">Heading</label>
                                <input id="inputHeading" type="text" ng-model="item_desc.heading" placeholder="Enter heading..." class="form-control"/>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputSubHeading">Sub Heading</label>
                                <input id="inputSubHeading" type="text" ng-model="item_desc.sub_heading" placeholder="Enter Sub heading..." class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-info btn-block" ng-click="addDetailsGroup()">
                                <i class="fa fa-plus"></i> Add Details Group
                            </button>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        
                        <div class="col-md-6" ng-repeat="desc in item_desc.body track by $index" ng-init="body_idx = $index">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <span ng-bind="desc.title"></span>

                                    <button class="btn btn-sm btn-danger pull-right" style="display:flex;" ng-click="removeDetailsGroup(body_idx)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputTitle">Title</label>
                                                <input id="inputTitle" type="text" ng-model="desc.title" placeholder="Enter title..." class="form-control"/>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSubTitle">Sub Title</label>
                                                <input id="inputSubTitle" type="text" ng-model="desc.sub_title" placeholder="Enter Sub title..." class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row" ng-repeat="content in desc.contents track by $index" ng-init="content_idx = $index">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="inputKey">Key:</label>
                                                <input id="inputKey" type="text" ng-model="content.key" placeholder="Enter Key.." class="form-control"/>
                                            </div> 
        
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="inputValue">Value:</label>
                                                <input id="inputValue" type="text" ng-model="content.value" placeholder="Enter Value..." class="form-control"/>
                                            </div> 
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="inputValue">&nbsp;</label>
                                                <button class="btn btn-danger btn-block" ng-click="removeDescriptionPair(body_idx, content_idx)">
                                                        <i class="fa fa-times"></i> Remove
                                                </button>
                                            </div>                                             
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success btn-block" ng-click="addDescriptionPair(body_idx)">
                                                <i class="fa fa-plus"></i> Add Pair
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-3 pull-right">
                            
                            <button class="btn btn-warning btn-block" ng-click="editDescription('<?= $data['Item']['id'] ?>')">
                                <i class="fa fa-pencil"></i> Edit details
                            </button>

                        </div>    
                    </div>    
                </div>

	        </div>
		</div>
	</div>


    <!-- 0-0-0-0-0-0-0-0-0-0-0-0-0-0- -->


    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success pull-right" ng-click="addChildItem()">
                <i class="fa fa-plus"></i> Add Item Combination
            </button>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <br/>
        </div>
    </div>
    <!-- Item Variants -->

    <div class="row">
		<div class="col-md-12" ng-repeat="var in variants track by $index" ng-init="var_idx = $index">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Item Combination {{var_idx + 1}}</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	              <div class="box-body">

                      <!-- Row Start -->

                      <!-- Hidden Fields -->
                      <input type="hidden" ng-model="var.id" />
                      <!-- Ok Great -->
                    <h4>Extra Options:</h4>
                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input id="inputFeatured{{var.id}}" type="checkbox" ng-model="var.is_featured" /> 							
								<label for="inputFeatured{{var.id}}"><h4>Show on homepage?<small>(Featured item)</small></h4></label>
							</div>
						</div>
                    </div>

                    <h5>
                        <b>Qty limit for item to be purchased in one order:</b>
                    </h5>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="inputMinQty{{var.id}}">Min Qty.<span style='color: red;'>*</span></label>
                                <input id="inputMinQty{{var.id}}" type="number" ng-model="var.item_min_qty" class="form-control" required/>
							</div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="inputMaxQty{{var.id}}">Max Qty.<span style='color: red;'>*</span></label>
                                <input id="inputMaxQty{{var.id}}" type="number" ng-model="var.item_max_qty" class="form-control" required/>
							</div>
                        </div>
                    </div>
                    <hr />
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputPrice"><h4>Variants</h4></label>
                                <hr />
                                <?php /*echo $this->Form->input('price',array(
                                  'id' => 'inputPrice',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Price',
                                  'label'=>false,
                                  'ng-model' => 'var.price'
                                ));*/
                                ?>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputDiscountPrice"><h4>Sellers</h4></label>
                                <hr />

                                <?php /*echo $this->Form->input('discount_price',array(
                                  'id' => 'inputDiscountPrice',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Discount Price',
                                  'label'=>false,
                                  'ng-model' => 'var.discount_price'
                              ));*/
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->

                      <!-- Row Start -->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="row" ng-repeat="sub_var in var.sub_variants track by $index" ng-init="sub_var_idx = $index">
                                  <!-- Variants -->
                                  <div class="col-md-4">
                                      <div class="form-group">
                                            <label for="inputVariantName">Variant Name<span style='color: red;'>*</span></label>
                                            <select class="form-control select2" ng-model="sub_var.variant_id" style="width: 100%;" ng-init="old_variant_id = sub_var.variant_id" ng-change="getVariantProperties(var_idx, sub_var_idx, sub_var.variant_id, old_variant_id)">
                                                <option ng-repeat="option in all_variants" value="{{option.Variant.id}}">{{option.Variant.name}}</option>
                                            </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                            <label for="inputVariantProperty">Variant Property<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <select class="form-control select2" ng-model="sub_var.variant_property_id" style="width: 100%;">
                                                <option ng-repeat="option in sub_var.all_properties" value="{{option.VariantProperty.id}}">{{option.VariantProperty.name}}</option>
                                            </select>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <!-- <br/> -->
                                          <label for="inputVariantName">&nbsp;</label>
                                          <button class="btn btn-danger btn-block" ng-click="removeSubVariant(var_idx, sub_var_idx)">
                                              <i class="fa fa-times"></i> Remove
                                          </button>
                                      </div>
                                  </div>
                                  <!-- Variants Ends Here -->
                              </div>
                          </div>

                          <!-- Sellers with Price -->
                          <div class="col-md-6">
                              <div class="row" ng-repeat="seller in var.sellers track by $index" ng-init="sub_var_idx = $index">
                                  <!-- Variants -->
                                  <div class="col-md-4">
                                      <div class="form-group">
                                            <label for="inputSellerName">Seller Name<span style='color: red;'>*</span></label>
                                            <select id="inputSellerName" class="form-control select2" ng-model="seller.id" style="width: 100%;" ng-init="old_seller_id = seller.id" ng-change="checkSellers(var_idx, sub_var_idx, seller.id, old_seller_id)" required>
                                                <option ng-repeat="option in all_sellers" value="{{option.Seller.id}}">{{option.Seller.name}}</option>
                                            </select>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                            <label for="inputSellerPrice">Seller Price<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <input id="inputSellerPrice" type="text" ng-model="seller.price" class="form-control" required/>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                            <label for="inputDiscountPrice">Discount Price<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <input id="inputDiscountPrice" type="text" ng-model="seller.discount_price" class="form-control" required/>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                            <label for="inputSKUCode">Seller SKU:<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <input id="inputSKUCode" type="text" ng-model="seller.seller_sku_code" class="form-control" required/>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>
                                  <div class="col-md-1">
                                      <div class="form-group">
                                          <!-- <br/> -->
                                          <label for="inputVariantName">&nbsp;</label>
                                          <button class="btn btn-danger btn-block" ng-click="removeSeller(var_idx, sub_var_idx)">
                                              <i class="fa fa-times"></i> 
                                          </button>
                                      </div>
                                  </div>
                                  <!-- Variants Ends Here -->
                              </div>
                          </div>
                          <!-- Seller Ends Here -->
                      </div>

                      <div class="row">
                          <!-- Add Variant -->
                          <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <br/> -->
                                  <label for="inputVariantName">&nbsp;</label>
                                  <button class="btn btn-success btn-block" ng-click="addSubVariant(var_idx, sub_var_idx)">
                                      <i class="fa fa-plus"></i> Add Variant
                                  </button>
                              </div>
                          </div>

                          <!-- Add Seller -->
                          <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <br/> -->
                                  <label for="inputVariantName">&nbsp;</label>
                                  <button class="btn btn-success btn-block" ng-click="addSeller(var_idx, sub_var_idx)">
                                      <i class="fa fa-plus"></i> Add Seller
                                  </button>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->

                      <!-- Child Primary Image -->
                        <hr />

                        <div class="row">

                              <div class="col-md-6">
                              <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="box-title">Upload Primary Photo</h4>
                                    </div>
                                </div>

                                    <!-- form start -->
                                    <?php echo $this->Form->create('Item',array('url'=> array('controller' => 'items', 'action' => 'editChildItem'), 'class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img src="<?= $IMAGE_BASE_URL ?>item/image_file/{{var.image_dir}}/sm_{{var.image_file}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPhoto">Photo: </label>                                
                                            <input type="hidden" name="data[Item][id]" value="{{var.id}}" />
                                            <input type="hidden" name="data[Item][item_id]" value="<?= $data['Item']['id'] ?>" />
                                            <input type="file" name="data[Item][image_file]" id="inputPhoto" class="form-control" autofocus="autofocus">
                                        </div>

                                        <div class="form-group pull-right">
                                            <?php
                                                echo $this->Form->input('Change Picture',array('class'=>'btn btn-primary','type'=>'submit','label'=>false));
                                            ?>
                                        </div>

                                    </div>
                                    <?php echo $this->Form->end(); ?>

                              </div>

                              <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="box-title">Upload Gallery Photos</h4>
                                        </div>
                                    </div>

                                    <div class="col-md-2" ng-repeat="photo in var.item_photos track by $index" ng-init="sub_photo_idx = $index">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <button class="btn btn-sm btn-danger" ng-click="deleteItemPhoto(photo,var_idx,sub_photo_idx)">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success" ng-click="savePhotoPriority(photo)">
                                                    <i class="fa fa-floppy-o"></i>
                                                </button>
                                            </div>
                                            <div class="panel-body" style="display: flex; justify-content: center; align-items: center;">
                                                <img src="<?= $IMAGE_BASE_URL ?>item_photo/image_file/{{photo.image_dir}}/sm_{{photo.image_file}}" style="width: 85px;" />
                                            </div>
                                            <div class="panel-footer">
                                                <input id="photo_priority_{{photo.id}}" type="number" class="form-control" name="data[ItemPhoto][priority]" value="{{photo.priority}}" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- form start -->
                                    <?php echo $this->Form->create('ItemPhoto',array('url'=> array('controller' => 'items', 'action' => 'multiPhotos'), 'class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <!-- <img src="<?= $IMAGE_BASE_URL ?>item_photo/image_file/{{var.image_dir}}/sm_{{var.image_file}}" /> -->
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputPhoto">Photo: </label>                                
                                            <input type="hidden" name="data[ItemPhoto][item_id]" value="{{var.id}}" /> <!-- ChildITemID -->
                                            <input type="hidden" name="data[ItemPhoto][id]" value="<?= $data['Item']['id'] ?>" />
                                            <!-- <input type="file" name="data[ItemPhoto][image_file]" id="inputPhoto" class="form-control" autofocus="autofocus"> -->
                                            <?php echo $this->Form->input("image_file",array('type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true)); ?>
                                        </div>

                                    <div class="form-group pull-right">
                                        <?php
                                            echo $this->Form->input('Upload',array('class'=>'btn btn-primary','type'=>'submit','label'=>false));
                                        ?>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                              </div>
                            
                            
                        </div>
                      <!-- #e43 343 434 -->
	            	</div>
	                <!-- /.box-body -->

		            <div class="box-footer">
                        <!-- <div class=" col-md-4">
                        </div> -->
                        <div class="col-md-offset-8 col-md-4" ng-if="var.id === null">
                            <button class="btn btn-success btn-block" ng-click="addChildItem_DB(var)">
                                <i class="fa fa-plus"></i> Add Item Combination
                            </button>
                        </div>

                        <div class="col-md-offset-4 col-md-4" ng-if="var.id !== null">
                            <button class="btn btn-warning btn-block" ng-click="addChildItem_DB(var)">
                                <i class="fa fa-pencil"></i> Edit Item Combination
                            </button>
                        </div>

                        <div class="col-md-4" ng-if="var.id !== null">
                            <button class="btn btn-danger btn-block" ng-click="removeChildItem_DB(var)">
                                <i class="fa fa-times"></i> Remove Item Combination
                            </button>
                        </div>
		            </div>
	        </div>
		</div>
	</div>
    <!-- Ends Here -->
</section>
<script>
    $(document).ready(function() {
        $('#inputLongDescription').autogrow({vertical: true, horizontal: false});
    });
</script>
<?php $this->end('main-content'); ?>
