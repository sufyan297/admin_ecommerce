<?php $this->start("main-content"); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
          <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!-- HEADER -->
                        <div class="box-header with-border">
            	            <h3 class="box-title">Search for Items</h3>

                            <div class="box-tools pull-right">
        		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        		                </button>
        		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        		            </div>
                        </div>
                        <!-- BODY -->
                        <?php echo $this->Form->create('Item',array('class'=>'form-group','type'=>'get')); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                      <label for="inputSearch">Search<span style='color: red;'>*</span></label>
                                      <?php echo $this->Form->input('search',array(
                                        'id' => 'inputSearch',
                                        'class'=>"form-control",
                                        'placeholder'=>'Type anything to search such as `name` `category`.',
                                        'label'=>false,
                                        'value' => $search_query
                                      ));
                                      ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="buttonSearch">&nbsp;</label><br/>
                                      <?= $this->Form->input('Search',array('class'=>'btn btn-primary btn-block','type'=>'submit','label'=>false)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </diV>
            <div class="row">
              <div class="row" style="padding-left: 10px;">
                <div class="col-md-8">
                  <?php echo $this->Session->flash(); ?>
                </div>
              </div>
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
    	            <h3 class="box-title">View Items</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <a href="<?php echo $this->Html->url(array('controller' => 'items', 'action' => 'add')); ?>" class="btn btn-primary pull-left">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Item
                            </a>
    		            </div>
    	            </div>
                  <!-- form start -->

                  <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                      <table class="table table-striped table-bordered table-hover" id="dataTables">
      	            		<thead>
      			              <tr>
                                <th>#</th>
                                <th>##</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($items as $data): ?>

                            <tr style="cursor: pointer;">

                                <td><span><?php echo $i++; ?></span></td>
                                <td>
                                    <?=         $this->Html->image('/files/item/image_file/'.$data['Item']['image_dir']."/tm_".$data['Item']['image_file'],array('style'=>'height: 100px;width: 100px;'));?>
                                </td>
                                <td>
                                    <?php echo $data['Item']['name']; ?>
                                </td>

                                <td>
                                    <?php echo $data['Item']['short_desc']; ?>
                                </td>
                                <td>
                                    <?= $data['ItemCategory']['name'] ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-pencil')),array('controller'=>'items','action'=>'edit/'.$data['Item']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-times')),array('controller'=>'items','action'=>'delete/'.$data['Item']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false,'onclick'=>'return confirm(\'Are you sure? This action wont be rollback.\')'));
                                    ?>
                                </td>

                          </tr>
                          <?php $no = $no + 1; ?>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
            <ul class="pagination" style="float: right;">
            <?php

                echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));

            ?>
            </ul>
            <?php
                echo $this->Paginator->counter(array('format' => 'range'));
            ?>
                </div><!-- /.box -->
              </div>
            </div>
          </div>

          </section>
<?php $this->end("main-content"); ?>
