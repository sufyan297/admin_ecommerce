<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Change Password<small>Admin</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Change Password</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
                <?php echo $this->Form->create('Admin',array('class'=>'form-signin')); ?>
	              <div class="box-body">
                      <div class="form-group">
                        <label for="inputFirstName">Current Password</label>
                        <?php echo $this->Form->input('oldpassword',array(
                          'type' => 'password',
                          'class'=>"form-control",
                          'placeholder'=>'Enter your current password',
                          'label'=>false,
                          'required' => 'required',
                          'autofocus' => 'autofocus'
                        ));
                        ?>
                      </div>
                      <div class="form-group">
                          <label for="inputPassword">Password</label>
                          <?php echo $this->Form->input('password',array(
                                'placeholder'=>'New Password',
                                'class'=>'form-control',
                                'label'=>false,
                                'required' => 'required'
                            ));
                            ?>
                      </div>
                      <div class="form-group">
                          <label for="inputRetypePassword">Retype Password</label>
                          <?php echo $this->Form->input('rtpassword',array(
                                'placeholder'=>'Retype New Password',
                                'type'=>'password',
                                'class'=>'form-control',
                                'label'=>false,
                                'required' => 'required'
                            ));
                            ?>
                      </div>
                  </div>
                  <div class="box-footer">
                      <?php
                          echo $this->Form->input('Change Password',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                      ?>
                  </div>
                  <?php echo $this->Form->end(); ?>
          </div>
      </div>
  </div>
</section>
<?php $this->end('main-content'); ?>
