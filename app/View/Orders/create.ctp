<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Create Bill<small>Bills</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Add Bill</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('Order',array('class'=>'form-signin')); ?>
                <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
    						  <label for="inputFirstName">Bill No</label>
    						  <?php echo $this->Form->input('bill_no',array(
    							'class'=>"form-control",
    							'placeholder'=>'Bill No',
    							'label'=>false,
    							'required' => 'required',
    							'autofocus' => 'autofocus'
    						  ));
    						  ?>
    						</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
    						  <label for="inputLastName">Bill Date</label>
    						  <?php echo $this->Form->input('bill_date',array(
                                'type' => 'text',
    							'class'=>"form-control datepicker",
    							'placeholder'=>'Bill Date',
    							'label'=>false,
    							'required' => 'required',
    							'autofocus' => 'autofocus',
                                'value' => date('d/m/Y'),
                                'readonly' => 'readonly'
    						  ));
    						  ?>
    						</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="inputFirstName">Tax rate</label>
                              <?php echo $this->Form->input('tax_rate',array(
                                'class'=>"form-control",
                                'placeholder'=>'Tax rate',
                                'label'=>false,
                                'required' => 'required',
                                'autofocus' => 'autofocus',
                                'value' => 12
                              ));
                              ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="form-group">
                              <label for="inputLastName">Bill Date</label>
                              <?php echo $this->Form->input('bill_date',array(
                                'type' => 'text',
                                'class'=>"form-control datepicker",
                                'placeholder'=>'Bill Date',
                                'label'=>false,
                                'required' => 'required',
                                'autofocus' => 'autofocus',
                                'value' => date('d/m/Y'),
                                'readonly' => 'readonly'
                              ));
                              ?>
                            </div> -->
                        </div>
                    </div>

	            	</div>
	              <!-- /.box-body -->

		            <!-- <div class="box-footer"> -->
						<?php
							// echo $this->Form->input('Add Admin',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            <!-- </div> -->
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>

        <!-- Customer Details -->
        <div class="col-md-6">
            <div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Customer Details</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>

                <div class="box-body">
                </div>
            </div>
        </div>
	</div>



<script>
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '+0d',
    orientation: 'bottom left',
    autoclose: true,
    forceParse: true,
    todayHighlight:true
});
</script>
<?php $this->end('main-content'); ?>
