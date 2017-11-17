<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Seller<small>Sellers</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit Seller</h3>

		            <div class="box-tools pull-right">

                        <a href="<?= $this->Html->url(array('controller' => 'sellers', 'action' => 'view')) ?>" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>
                        </a>
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('Seller',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
						<div class="form-group col-md-12">
						  <label for="inputName">Name<span style='color: red;'>*</span></label>
						  <?php echo $this->Form->input('name',array(
                            'id' => 'inputName',
							'class'=>"form-control",
							'placeholder'=>'Seller name',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'onChange' => 'changeUrlSlag()',
                            'value' => $data['Seller']['name']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-12">
						  <label >Address<span style='color: red;'>*</span></label>
						  <?php echo $this->Form->input('address',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['address'],
              'required' => 'required'

						  ));
						  ?>
						</div>

            <div class="form-group col-md-6">
						  <label >Contact Number<span style='color: red;'>*</span></label>
						  <?php echo $this->Form->input('mobile',array(
							'class'=>"form-control",
							'label'=>false,
              'required' => 'required',
              
              'value' => $data['Seller']['mobile']
						  ));
						  ?>
						</div>

            <div class="form-group col-md-6">
						  <label >Alternate Contact Number</label>
						  <?php echo $this->Form->input('mobile_2',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['mobile_2']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >PAN Card Number</label>
						  <?php echo $this->Form->input('PAN',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['PAN']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Bank Account Number</label>
						  <?php echo $this->Form->input('bank_account_no',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['bank_account_no']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >IFSC Code</label>
						  <?php echo $this->Form->input('bank_IFSC',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['bank_IFSC']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Branch</label>
						  <?php echo $this->Form->input('branch',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['branch']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-12">
						  <label >Product Category</label>
						  <?php echo $this->Form->input('product_category',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['product_category']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Payment Terms</label>
						  <?php echo $this->Form->input('payment_terms',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['payment_terms']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Return Policy Payment</label>
						  <?php echo $this->Form->input('return_policy_payment',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['return_policy_payment']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Credit Period In Days</label>
						  <?php echo $this->Form->input('credit_period',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['credit_period']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-6">
						  <label >Remarks</label>
						  <?php echo $this->Form->input('remarks',array(
							'class'=>"form-control",
							'label'=>false,
              'value' => $data['Seller']['remarks']
						  ));
						  ?>
						</div>
            <div class="form-group col-md-12">
              <label for="inputDescription">Description</label>
              <?php echo $this->Form->textarea('description',array(
                'id' => 'inputDescription',
                'class'=>"form-control",
                'placeholder'=>'Description',
                'label'=>false,
                'value' => $data['Seller']['description']
              ));
              ?>
            </div>
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit Seller',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>
</section>


<?php $this->end('main-content'); ?>
