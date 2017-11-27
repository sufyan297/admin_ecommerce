<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Category<small>Categories</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit Item Category</h3>

		            <div class="box-tools pull-right">

                        <a href="<?= $this->Html->url(array('controller' => 'item_category', 'action' => 'view')) ?>" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>
                        </a>
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('ItemCategory',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group">
						  <label for="inputName">Name<span style='color: red;'>*</span></label>
						  <?php echo $this->Form->input('name',array(
                            'id' => 'inputName',
							'class'=>"form-control",
							'placeholder'=>'Category name',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'onChange' => 'changeUrlSlag()',
                            'value' => $data['ItemCategory']['name']
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputDescription">Description<span style='color: red;'>*</span></label>
						  <?php echo $this->Form->textarea('description',array(
                            'id' => 'inputDescription',
							'class'=>"form-control",
							'placeholder'=>'Description',
							'label'=>false,
							'required' => 'required',
                            'value' => $data['ItemCategory']['description']
						  ));
						  ?>
						</div>

                        <!-- <div class="form-group">
                          <label for="inputURLSlag">Url Slag<span style='color: red;'>*</span></label>
                          <?php echo $this->Form->input('url_slag',array(
                            'id' => 'inputURLSlag',
                            'class'=>"form-control",
                            'placeholder'=>'URL slag',
                            'label'=>false,
                            'required' => 'required',
                            'value' => $data['ItemCategory']['url_slag']
                          ));
                          ?>
                        </div> -->
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit Item category',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>
</section>


<?php $this->end('main-content'); ?>
