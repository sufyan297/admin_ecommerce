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
                <h3 class="box-title">View user</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- form start -->

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputFirstName">First Name</label>
                                <?php echo $this->Form->input('first_name',array(
                                'class'=>"form-control",
                                'placeholder'=>'First Name',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$data['User']['first_name'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Last Name</label>
                                <?php echo $this->Form->input('last_name',array(
                                'class'=>"form-control",
                                'placeholder'=>'Last Name',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$data['User']['last_name'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputFirstName">Username</label>
                                <?php echo $this->Form->input('username',array(
                                'class'=>"form-control",
                                'placeholder'=>'Email',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$data['User']['username'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Mobile</label>
                                <?php echo $this->Form->input('mobile',array(
                                'class'=>"form-control",
                                'placeholder'=>'Mobile',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$data['User']['mobile'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
            </div>


            
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">View orders</h3>

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
                                <th>Status</th>
                                <th>Total amount</th>
                                <th>Shipping charges</th>
                                <th>Payment <br/>mode</th>
                                <th>Placed/Created at</th>
      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($orders as $data): ?>
                                <?php
                                    $placed = true;
                                ?>
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
                                    <?php if ($data['Order']['status'] == -1): ?>
                                        <span class="badge bg-red">Cancelled</span>
                                    <?php elseif($data['Order']['status'] == 0): ?>
                                        <span class="badge bg-gray">Payment Not completed</span>
                                        <?php
                                            $placed = false;
                                        ?>
                                    <?php elseif($data['Order']['status'] == 1): ?>
                                        <span class="badge bg-green">Payment Completed</span>
                                    <?php elseif($data['Order']['status'] == 2): ?>
                                        <span class="badge bg-primary">Dispatched</span>
                                    <?php endif; ?>
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
                                    <?php if ($placed == false): ?>
                                        <?= date('dS M Y h:m a', strtotime($data['Order']['created']))?>
                                    <?php else: ?>
                                        <?= date('dS M Y h:m a', strtotime($data['Order']['order_placed_at']))?>
                                    <?php endif; ?>
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
                </div>


                </div><!-- /.box -->
            </div>
            </div>


        </div>
    </section>
<?php $this->end("main-content"); ?>
