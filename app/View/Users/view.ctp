<?php $this->start("main-content"); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="row" style="padding-left: 10px;">
                <div class="col-md-8">
                  <?php echo $this->Session->flash(); ?>
                </div>
              </div>
              <!-- Search User -->

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search Users</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <!-- Body -->
                        <?php echo $this->Form->create('User',array('class'=>'form-group','type'=>'get')); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
            						  <!-- <label for="inputFirstName">Search</label> -->
            						  <?php echo $this->Form->input('search',array(
            							'class'=>"form-control",
            							'placeholder'=>'Type anything to search for a user...',
            							'label'=>false,
            							// 'required' => 'required',
            							'autofocus' => 'autofocus',
                                        'value' => $search_query
            						  ));
            						  ?>
            						</div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-md-12">
                                <?php
                                    echo $this->Form->input('Search',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
                                ?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>

              <!-- End Here -->

              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
    	            <h3 class="box-title">View Users</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

                            <!-- <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'export_subscribers')); ?>" class="btn btn-primary btn-sm pull-left">
                                <i class="fa fa-download"></i>&nbsp;&nbsp;Export Users
                            </a> -->

    		            </div>
    	            </div>
                  <!-- form start -->

                  <div class="box-body table-responsive no-padding">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                      <table class="table table-striped table-bordered table-hover" id="dataTables">
      	            		<thead>
      			              <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <!-- <th>Verified?</th> -->
                            <!-- <th>News Letters?</th> -->
                            <th>Edit</th>
                            <th>Delete</th>

      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($users as $data): ?>

                            <tr style="cursor: pointer;">

                                <td><span><?php echo $i++; ?></span></td>
                                <td>
                                    <?php echo $data['User']['first_name']; ?>
                                </td>
                                <td>
                                    <?php echo $data['User']['last_name']; ?>
                                </td>
                                <td>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_user',$data['User']['id'])); ?>" class="btn badge bg-yellow">
                                        <?php echo $data['User']['username']; ?>
                                    </a>

                                </td>

                                <!-- <td>
                                    <?php if ($data['User']['is_verified'] == 1): ?>
                                        <button class="btn badge bg-green">Yes</button>
                                    <?php else: ?>
                                        <button class="btn badge bg-red">No</button>
                                    <?php endif; ?>
                                </td> -->
                                <!-- <td>
                                    <?php if ($data['User']['news_letters'] == 1): ?>
                                        <button class="btn badge bg-green">Yes</button>
                                    <?php else: ?>
                                        <button class="btn badge bg-red">No</button>
                                    <?php endif; ?>
                                </td> -->
                              <td>
                                <?php
                                echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-pencil')),array('controller'=>'users','action'=>'edit/'.$data['User']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                ?>
                              </td>

                              <td>
                                <!-- <a ng-href="delete/<?php //echo $data['User']['id']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure? Guests will be removed too.')"><i class="fa fa-times"></i></a> -->
                                <?php
                                    echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-times')),array('controller'=>'users','action'=>'delete/'.$data['User']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false,'onclick'=>'return confirm(\'Are you sure? This action wont be rollback.\')'));
                                ?>
                              </td>

                          </tr>
                          <?php $no = $no + 1; ?>
                        <?php endforeach; ?>

                      </tbody>
                    </table>

                <ul class="pagination" style="float: right;">
                <?php
                    echo $this->Paginator->first(__('First'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                    echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                    echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                    echo $this->Paginator->last(__('Last'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
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