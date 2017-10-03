<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Admin<small>Admins</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit Admin</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('Admin',array('class'=>'form-group')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group">
						  <label for="inputFirstName">First tName</label>
						  <?php echo $this->Form->input('fname',array(
							'class'=>"form-control",
							'placeholder'=>'First Name',
							'label'=>false,
							'required' => 'required',
                            'value'=>$admin['Admin']['fname'],
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputLastName">Last Name</label>
						  <?php echo $this->Form->input('lname',array(
							'class'=>"form-control",
							'placeholder'=>'Last Name',
							'label'=>false,
							'required' => 'required',
                            'value'=>$admin['Admin']['lname'],
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputUsername">Username</label>
						  <?php echo $this->Form->input('username',array(
						    'class'=>"form-control",
						    'placeholder'=>'Username',
						    'label'=>false,
                            'disabled'=>'disabled',
						    'required' => 'required',
                            'value'=>$admin['Admin']['username'],
						    'autofocus' => 'autofocus'
						  ));
						  ?>
					  	</div>
						<div class="form-group">
							<label for="inputPassword">Password</label>
							<?php echo $this->Form->input('password',array(
								  'placeholder'=>'Password',
								  'class'=>'form-control',
								  'label'=>false,
							  ));
							  ?>
						</div>
						<div class="form-group">
							<label for="inputRetypePassword">Retype Password</label>
							<?php echo $this->Form->input('rtpassword',array(
								  'placeholder'=>'Retype Password',
								  'type'=>'password',
								  'class'=>'form-control',
								  'label'=>false,
							  ));
							  ?>
						</div>
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit Admin',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>



<?php $this->end('main-content'); ?>
