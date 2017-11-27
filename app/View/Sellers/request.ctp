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
    	            <h3 class="box-title">View Sellers</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <a href="<?php echo $this->Html->url(array('controller' => 'sellers', 'action' => 'add')); ?>" class="btn btn-primary pull-left">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Seller
                            </a>
    		            </div>
    	            </div>
                  <!-- form start -->

                  <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                      <table class="table table-striped table-bordered table-hover" id="dataTables">
      	            		<thead>
      			              <tr>
                                <th>Personal Info</th>
                                <th>Product Category</th>
                                <th>Payment Info </th>
                                <th>Action</th>
      			              </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php foreach ($sellers as $data): ?>

                            <tr style="cursor: pointer;">
                                <td>
                                  <b><?= $data['Seller']['name'] ?></b>
                                  <ul>
                                    <li><b>Address:  </b><?= $data['Seller']['address']; ?></li>
                                    <li><b>Contact No 1: </b><?= $data['Seller']['mobile']; ?></li>
                                    <li><b>Contact No 2: </b><?= $data['Seller']['mobile_2']; ?></li>
                                    <li><b>PAN NO: </b><?= $data['Seller']['PAN']; ?></li>
                                    <li><b>BANK Account NO: </b><?= $data['Seller']['bank_account_no']; ?></li>
                                    <li><b>IFSC Code: </b><?= $data['Seller']['bank_IFSC']; ?></li>
                                    <li><b>Branch: </b><?= $data['Seller']['branch']; ?></li>
                                    <li><b>Email: </b><?= $data['Seller']['email']; ?></li>
                                    
                                  </ul>
                                </td>

                                <td>

                                    <?= $data['Seller']['product_category']; ?>


                                </td>

                                <td>
                                  <ul>
                                    <li><b>Payment Terms:</b><br><?= $data['Seller']['payment_terms']; ?></li>
                                    <li><b>Credit in day:</b><br><?= $data['Seller']['credit_period']; ?></li>
                                    <li><b>Return Policy Payment:</b><br><?= $data['Seller']['return_policy_payment']; ?></li>
                                    <li><b>Remark:</b><br><?= $data['Seller']['remarks']; ?></li>


                                  </ul>
                                </td>

                                <td>
                                  <?php
                                  echo $this->Html->link($this->Html->tag('i', ' Accept',array('class' => 'fa fa-check')),array('controller'=>'sellers','action'=>'accept/'.$data['Seller']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                  ?><br><br>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', ' Cancel',array('class' => 'fa fa-times')),array('controller'=>'sellers','action'=>'ignore/'.$data['Seller']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false,'onclick'=>'return confirm(\'Are you sure? This action wont be rollback.\')'));
                                    ?>
                                </td>

                          </tr>
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
