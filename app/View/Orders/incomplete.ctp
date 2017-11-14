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
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
    	            <h3 class="box-title">View Incomplete orders</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

    		            </div>
    	            </div>
                  <!-- form start -->

                  <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                      <table class="table table-striped table-bordered table-hover" id="dataTables">
      	            		<thead>
      			              <tr>
                                <th>View <br/> Order</th>
                                <th>Code</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Total amount</th>
                                <th>Shipping charges</th>
                                <th>Payment <br/>mode</th>
                                <th>Created at</th>
                                <th>Actions</th>
      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($orders as $data): ?>

                            <tr style="cursor: pointer;">

                                <td>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-eye')),array('controller'=>'orders','action'=>'view_order/'.$data['Order']['id']),array('class'=>'btn btn-info btn-circle btn-sm btn-block', 'escape' => false));
                                    ?>
                                </td>

                                <td>
                                    <?php echo $data['Order']['code']; ?>
                                </td>
                                <td>
                                    <center>
                                        <?= $data['User']['first_name'] ?>
                                        <?= $data['User']['last_name'] ?> 
                                    </center>
                                    <?php
                                        echo $this->Html->link($data['User']['username'],array('controller'=>'users','action'=>'view_user/'.$data['User']['id']),array('class'=>'btn btn-warning btn-circle btn-sm btn-block', 'escape' => false));
                                    ?>
                                </td>
                                <td>
                                    <span class="badge">Payment Not completed.</span>
                                </td>

                                <td>
                                    <?= $data['Order']['total_amount'] ?>
                                </td>

                                <td>
                                    <?= $data['Order']['shipping_charges'] ?>
                                </td>

                                <td>
                                    <?= $data['Order']['payment_mode'] ?> <b>(<?= $data['Order']['payment_through'] ?>)</b>
                                </td>

                                <td>
                                    <?= date('dS M Y h:m a', strtotime($data['Order']['created']))?>
                                </td>

                                <td>
                                    <?php
                                        echo $this->Html->link('Mark as completed',array('controller'=>'orders','action'=>'mark_order/'.$data['Order']['id'].'/1'),array('class'=>'btn btn-info btn-circle btn-sm', 'escape' => false));
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
