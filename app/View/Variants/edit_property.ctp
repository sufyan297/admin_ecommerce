<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Property<small>Variant Properties</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit Property</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('VariantProperty',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group">
						  <label for="inputName">Name<span style="color:red;">*</span></label>
						  <?php echo $this->Form->input('name',array(
                            'id' => 'inputName',
							'class'=>"form-control",
							'placeholder'=>'Property for eg. (Red, Blue) or (XL, XXL)',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'value' => $data['VariantProperty']['name']
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputDescription">Description</label>
						  <?php echo $this->Form->input('description',array(
                            'id' => 'inputDescription',
							'class'=>"form-control",
							'placeholder'=>'Description',
							'label'=>false,
							'autofocus' => 'autofocus',
                            'value' => $data['VariantProperty']['description']
						  ));
						  ?>
						</div>

	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit Property',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>
</section>

<?php $this->end('main-content'); ?>
