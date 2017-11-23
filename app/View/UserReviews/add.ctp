<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Reviews<small>Customize</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Add Review</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
                <?php echo $this->Form->create('UserReview',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
                <div class="box-body">

                    <div class="form-group">
                      <label for="inputFirstName">Name<span style="color:red;">*</span></label>
                      <?php echo $this->Form->input('name',array(
                        'class'=>"form-control",
                        'placeholder'=>'Enter Name...',
                        'label'=>false,
                        'required' => 'required',
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="inputFirstName">Description<span style="color:red;">*</span></label>
                      <?php echo $this->Form->textarea('description',array(
                        'id' => 'desc_ckeditor',
                        'class' => 'form-control',
                        'rows'=>4,
                        'placeholder'=>'Description',
                        'label'=>false,
                        'required' => 'required',
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="inputPriority">Priority<span style="color:red;">*</span></label>
                      <?php echo $this->Form->input('priority',array(
                        'class'=>"form-control",
                        'placeholder'=>'Enter priority (order)',
                        'label'=>false,
                        'required' => 'required',
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>
                    <div class="form-group">
                        <label>Picture: </label><span style="color:red;">*</span>
                        <?php
                            echo $this->Form->input("image_file",array('type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true,'required'=>'required'));
                        ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?php
                        echo $this->Form->input('Add User Review',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                    ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

<?php $this->end('main-content'); ?>