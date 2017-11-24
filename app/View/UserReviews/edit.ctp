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
	            <h3 class="box-title">Edit Review</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
                <?php echo $this->Form->create('Review',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
                <div class="box-body">

                    <div class="form-group">
                      <label for="inputFirstName">Name<span style="color:red;">*</span></label>
                      <?php echo $this->Form->input('name',array(
                        'class'=>"form-control",
                        'placeholder'=>'Enter Name...',
                        'label'=>false,
                        'required' => 'required',
                        'autofocus' => 'autofocus',
                        'value' => $data['UserReview']['name']
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
                        'autofocus' => 'autofocus',
                        'value' => $data['UserReview']['description']
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
                        'autofocus' => 'autofocus',
                        'value' => $data['UserReview']['priority']

                      ));
                      ?>
                    </div>
                    <?php
                    // $img_path = $this->webroot.DS.'files'.DS.'review'.DS.'image_file'.DS.$data['Review']['image_dir'].DS.'sm_'.$data['Review']['image_file'];
                    ?>
                    <div class="form-group">

                    <?= 
                        $this->Html->image($IMAGE_BASE_URL.'user_review/image_file/'.$data['UserReview']['image_dir']."/tm_".$data['UserReview']['image_file'],array('style'=>'height: 100px;width: 100px;'));
                    ?>
                        <!-- <img src="<?php echo $img_path; ?>" /> -->
                    </div>

                    <div class="form-group">
                        <label>Picture: </label><span style="color:red;">*</span>
                        <?php
                            echo $this->Form->input("image_file",array('type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('Change Image', array('class' => 'btn btn-primary','type'=>'submit','label'=>false));
                        ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?php
                        echo $this->Form->input('Edit Review',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                    ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

<?php $this->end('main-content'); ?>