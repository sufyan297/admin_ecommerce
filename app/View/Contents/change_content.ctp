<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Modify Content<small>Customization</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Customize</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
                <?php echo $this->Form->create('Content',array('class'=>'form-signin','type'=>'file','role'=>'form', 'multiple')); ?>
                <div class="box-body">
                    <?php
                    // $img_path = $this->webroot.DS.'files'.DS.'content'.DS.'image_file'.DS.$content['Content']['image_dir'].DS.'api_'.$content['Content']['image_file'];
                    ?>
                    <?php echo $this->Form->input('id',array(
                      'class'=>"form-control",
                      'type'=>'hidden',
                      'label'=>false,
                      'value' => $content['Content']['id'] ,
                      'autofocus' => 'autofocus'
                    ));
                    ?>
                    <div class="form-group">
                        <?=  $this->Html->image($IMAGE_BASE_URL.'content/image_file/'.$content['Content']['image_dir']."/sm_".$content['Content']['image_file']); ?>

                        <!-- <img src="<?php echo $img_path; ?>" /> -->
                    </div>

                    <div class="form-group">
                        <label> Picture: </label>
                        <?php
                            echo $this->Form->input("image_file",array('type'=>'file','class'=>'form-control','label'=>false,'autofocus'=>true));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('Change Image', array('class' => 'btn btn-primary','type'=>'submit','label'=>false));
                        ?>
                    </div>

                    <div class="form-group">
                      <label for="inputFirstName">Title<span style="color:red;">*</span></label>
                      <?php echo $this->Form->input('title',array(
                        'class'=>"form-control",
                        'placeholder'=>'Title',
                        'label'=>false,
                        'value' => $content['Content']['title'] ,
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
                        'value' => $content['Content']['description'],
                        'label'=>false,
                        'required' => 'required',
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>

		            <div class="form-group">
                      <label for="inputFirstName">Button Name</label>
                      <?php echo $this->Form->input('short_description',array(
                        'class'=>"form-control",
                        'placeholder'=>'Button Name',
                        'label'=>false,
                        'value' => $content['Content']['short_description'] ,
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="inputFirstName">Button Link</label>
                      <?php echo $this->Form->input('link',array(
                        'class'=>"form-control",
                        'placeholder'=>'Button Link',
                        'label'=>false,
                        'value' => $content['Content']['link'] ,
                        'autofocus' => 'autofocus'
                      ));
                      ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?php
                        echo $this->Form->input('Edit Content',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                    ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

<script>
    CKEDITOR.replace( 'data[Content][description]' );
</script>
<?php $this->end('main-content'); ?>
