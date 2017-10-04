<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Add Item<small>Items</small></h1>
</section>

<section class="content">
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
                                  'onChange' => 'changeUrlSlag()'
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
                                <?= $this -> Form -> input('item_category_id', array('options' => $item_categories, 'class' => 'form-control m-b parsley-validated', 'data-required' => 'true','id'=>'item_category', 'label' => false, 'div' => false)); ?>
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


    <!-- Item Variants -->
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
							echo $this->Form->input('Add Item',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
	        </div>
		</div>
	</div>
    <?php echo $this->Form->end(); ?>

    <!-- Item Variants ends here -->
</section>

<?php $this->end('main-content'); ?>
