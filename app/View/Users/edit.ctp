<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit User<small>Users</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit User</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('User',array('class'=>'form-group')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group">
						  <label for="inputFirstName">First tName</label>
						  <?php echo $this->Form->input('first_name',array(
							'class'=>"form-control",
							'placeholder'=>'First Name',
							'label'=>false,
							'required' => 'required',
                            'value'=>$data['User']['first_name'],
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputLastName">Last Name</label>
						  <?php echo $this->Form->input('last_name',array(
							'class'=>"form-control",
							'placeholder'=>'Last Name',
							'label'=>false,
							'required' => 'required',
                            'value'=>$data['User']['last_name'],
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputUsername">Username</label>
						  <?php echo $this->Form->input('username',array(
                            'type' => 'email',
						    'class'=>"form-control",
						    'placeholder'=>'Username',
						    'label'=>false,
						    'required' => 'required',
                            'value'=>$data['User']['username'],
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
                          <span><font color='red'>Note:</font> If you don't want to change password then just leave it blank</span>
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
                              <span><font color='red'>Note:</font> If you don't want to change password then just leave it blank</span>
						</div>
                        <!-- <div class="form-group">
                            <label for="inputRetypePassword">Is Verified?</label>
                            <?php
                                echo $this->Form->input('is_verified',
                                array(
                                        'options' => array('0' => 'No', '1' => 'Yes'),
                                        'class'=>'form-control','label'=>false,'type'=>'select',
                                        'value' => $data['User']['is_verified']
                                    )
                                  );
                            ?>
                        </div> -->
                        

	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit User',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>
<?php $this->end('main-content'); ?>