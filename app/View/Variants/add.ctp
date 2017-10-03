<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Add Variant<small>Variants</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Add Variant</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('Variant',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group">
						  <label for="inputName">Name</label>
						  <?php echo $this->Form->input('name',array(
                            'id' => 'inputName',
							'class'=>"form-control",
							'placeholder'=>'Variant for eg. Size, Color',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus'
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
							'required' => 'required',
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>

	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Add Variant',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>
</section>

<?php $this->end('main-content'); ?>
