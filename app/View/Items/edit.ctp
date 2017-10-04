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
                                <?= $this -> Form -> input('item_category_id', array('options' => $item_categories, 'class' => 'form-control m-b parsley-validated', 'data-required' => 'true','id'=>'item_category', 'label' => false, 'div' => false, 'value' => $data['Item']['item_category_id'])); ?>
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

	            	</div>
	              <!-- /.box-body -->

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
                                <label for="inputPhoto">Photo<span style='color: red;'>*</span></label>
                                <?php
                                    echo $this->Form->input("image_file",array('id'=>'inputPhoto','type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true,'required'=>'required'));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->
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
    <?php echo $this->Form->end(); ?>

    <!-- Primary Photo ends here -->

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

    <div class="row" ng-repeat="var in variants track by $index" ng-init="var_idx = $index">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Variants {{var_idx + 1}}</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	              <div class="box-body">

                      <!-- Row Start -->
                      <input type="hidden" ng-model="var.id" />
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <?php echo $this->Form->input('price',array(
                                  'id' => 'inputPrice',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Price',
                                  'label'=>false,
                                  'ng-model' => 'var.price'
                                ));
                                ?>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="inputDiscountPrice">Discount Price</label>
                                <?php echo $this->Form->input('discount_price',array(
                                  'id' => 'inputDiscountPrice',
                                  'class'=>"form-control",
                                  'placeholder'=>'Enter Discount Price',
                                  'label'=>false,
                                  'ng-model' => 'var.discount_price'
                                ));
                                ?>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->

                      <!-- Row Start -->
                      <div class="row" ng-repeat="sub_var in var.sub_variants track by $index" ng-init="sub_var_idx = $index">
                          <div class="col-md-4">
                              <div class="form-group">
                                    <label for="inputVariantName">Variant Name</label>
                                    <select class="form-control select2" ng-model="sub_var.variant_id" style="width: 100%;" ng-change="getVariantProperties(var_idx, sub_var_idx, sub_var.variant_id)">
                                        <option ng-repeat="option in all_variants" value="{{option.Variant.id}}">{{option.Variant.name}}</option>
                                    </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                    <label for="inputVariantProperty">Variant Property</label>
                                    <select class="form-control select2" ng-model="sub_var.variant_property_id" style="width: 100%;">
                                        <option ng-repeat="option in sub_var.all_properties" value="{{option.VariantProperty.id}}">{{option.VariantProperty.name}}</option>
                                    </select>
                              </div>
                          </div>

                          <div class="col-md-1">
                              <div class="form-group">
                                  <!-- <br/> -->
                                  <label for="inputVariantName">&nbsp;</label>
                                  <button class="btn btn-danger btn-block" ng-click="removeSubVariant(var_idx, sub_var_idx)">
                                      <i class="fa fa-times"></i> Remove
                                  </button>
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-8">
                              <div class="form-group">
                                  <!-- <br/> -->
                                  <label for="inputVariantName">&nbsp;</label>
                                  <button class="btn btn-success btn-block" ng-click="addSubVariant(var_idx, sub_var_idx)">
                                      <i class="fa fa-plus"></i> Add
                                  </button>
                              </div>
                          </div>
                      </div>
                      <!-- Row Ends Here -->
	            	</div>
	                <!-- /.box-body -->

		            <div class="box-footer">
		            </div>
	        </div>
		</div>
	</div>
    <!-- Ends Here -->
</section>

<?php $this->end('main-content'); ?>