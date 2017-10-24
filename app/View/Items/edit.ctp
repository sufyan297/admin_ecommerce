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
                                  <?=  $this->Html->image('/files/item/image_file/'.$data['Item']['image_dir']."/sm_".$data['Item']['image_file']); ?>
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

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success pull-right" ng-click="addChildItem()">
                <i class="fa fa-plus"></i> Add Child Item
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
	            <h3 class="box-title">Child Item {{var_idx + 1}}</h3>

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
                                  <div class="col-md-3">
                                      <div class="form-group">
                                            <label for="inputSellerPrice">Seller Price<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <input id="inputSellerPrice" type="text" ng-model="seller.price" class="form-control" required/>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                            <label for="inputDiscountPrice">Seller Discount Price<span style='color: red;'>*</span></label>
                                            <!-- New addition -->
                                            <input id="inputDiscountPrice" type="text" ng-model="seller.discount_price" class="form-control" required/>
                                            <!-- okao skdo -->
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <!-- <br/> -->
                                          <label for="inputVariantName">&nbsp;</label>
                                          <button class="btn btn-danger btn-block" ng-click="removeSeller(var_idx, sub_var_idx)">
                                              <i class="fa fa-times"></i> Remove
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
	            	</div>
	                <!-- /.box-body -->

		            <div class="box-footer">
                        <!-- <div class=" col-md-4">
                        </div> -->
                        <div class="col-md-offset-8 col-md-4" ng-if="var.id === null">
                            <button class="btn btn-success btn-block" ng-click="addChildItem_DB(var)">
                                <i class="fa fa-plus"></i> Add Child Item
                            </button>
                        </div>

                        <div class="col-md-offset-4 col-md-4" ng-if="var.id !== null">
                            <button class="btn btn-warning btn-block" ng-click="addChildItem_DB(var)">
                                <i class="fa fa-pencil"></i> Edit Child Item
                            </button>
                        </div>

                        <div class="col-md-4" ng-if="var.id !== null">
                            <button class="btn btn-danger btn-block" ng-click="removeChildItem_DB(var)">
                                <i class="fa fa-times"></i> Remove Child Item
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
