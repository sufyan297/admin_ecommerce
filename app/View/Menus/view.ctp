<?php $this->start("main-content"); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
          <section class="content" ng-controller="ViewMenuController">
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
    	            <h3 class="box-title">View Menus</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <a href="<?php echo $this->Html->url(array('controller' => 'menus', 'action' => 'add')); ?>" class="btn btn-primary pull-left">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu
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
                                <th>Name</th>
                                <th>Add Menu Item</th>
                                <th>View Menu Items</th>
                                <th>Menu Priority</th>       
                                <th>Image Priority</th>                        
                                <th>Edit</th>
                                <th>Delete</th>
      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($menus as $data): ?>

                            <tr style="cursor: pointer;">

                                <td><span><?php echo $i++; ?></span></td>

                                <td>
                                    <?php echo $data['Menu']['name']; ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-plus')),array('controller'=>'menus','action'=>'add_item/'.$data['Menu']['id']),array('class'=>'btn btn-info btn-circle', 'escape' => false));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-eye')),array('controller'=>'menus','action'=>'view_items/'.$data['Menu']['id']),array('class'=>'btn btn-info btn-circle', 'escape' => false));
                                    ?>
                                </td>
                                <td>

                                    <input id="priority_<?= $data['Menu']['id'] ?>" type="number" class="form-control" value="<?= $data['Menu']['priority'] ?>" style="width: 30%;">
                                    <button class="btn btn-primary btn-xs" ng-click="savePriority('<?= $data['Menu']['id'] ?>')">Save</button>
                                </td>
                                <td>

                                    <input id="image_priority_<?= $data['Menu']['id'] ?>" type="number" class="form-control" value="<?= $data['Menu']['image_priority'] ?>" style="width: 30%;">
                                    <button class="btn btn-primary btn-xs" ng-click="savePriority('<?= $data['Menu']['id'] ?>')">Save</button>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-pencil')),array('controller'=>'menus','action'=>'edit/'.$data['Menu']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-times')),array('controller'=>'menus','action'=>'delete/'.$data['Menu']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false,'onclick'=>'return confirm(\'Are you sure? This action wont be rollback.\')'));
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
