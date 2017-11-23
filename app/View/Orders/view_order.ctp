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
                <h3 class="box-title">View order</h3>

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
                                <label for="inputFirstName">Order code</label>
                                <?php echo $this->Form->input('code',array(
                                'class'=>"form-control",
                                'placeholder'=>'Order code',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$order['Order']['code'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Total amount</label>
                                <?php echo $this->Form->input('total_amount',array(
                                'class'=>"form-control",
                                'placeholder'=>'Total amount',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$order['Order']['total_amount'],
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
                                'value'=>$order['User']['username'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Shipping charges</label>
                                <?php echo $this->Form->input('shipping_charges',array(
                                'class'=>"form-control",
                                'placeholder'=>'Shipping charges',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$order['Order']['shipping_charges'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                        $payment_status = "N/A";
                        if ($order['Order']['status'] == -1) {
                            $payment_status = "Cancelled";
                        } else if ($order['Order']['status'] == 0) {
                            $payment_status = "Incomplete";
                        } else if ($order['Order']['status'] == 1) {
                            $payment_status = "Payment completed";
                        } else if ($order['Order']['status'] == 2) {
                            $payment_status = "Dispatched";
                        }
                        
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputFirstName">Order status</label>
                                <?php echo $this->Form->input('status',array(
                                'class'=>"form-control",
                                'placeholder'=>'Email',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$payment_status,
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Payment mode</label>
                                <?php echo $this->Form->input('payment_mode',array(
                                'class'=>"form-control",
                                'placeholder'=>'Payment mode',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$order['Order']['payment_mode'],
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
                                <label for="inputFirstName">Admin remarks</label>
                                <?php echo $this->Form->input('admin_remarks',array(
                                'class'=>"form-control",
                                'placeholder'=>'Admin Remarks',
                                'label'=>false,
                                'required' => 'required',
                                'value'=>$order['Order']['admin_remarks'],
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Order Placed at</label>
                                <?php echo $this->Form->input('order_placed_at',array(
                                'class'=>"form-control",
                                'placeholder'=>'Order Placed at',
                                'label'=>false,
                                'required' => 'required',
                                'value'=> date('dS M Y h:i a', strtotime($order['Order']['order_placed_at'])),
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
                                <label for="inputFirstName">Order created at</label>
                                <?php echo $this->Form->input('created',array(
                                'class'=>"form-control",
                                'placeholder'=>'Created at',
                                'label'=>false,
                                'required' => 'required',
                                'value'=> date('dS M Y h:i a', strtotime($order['Order']['created'])),
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastName">Order modified at</label>
                                <?php echo $this->Form->input('modified',array(
                                'class'=>"form-control",
                                'placeholder'=>'Modified at',
                                'label'=>false,
                                'required' => 'required',
                                'value'=> date('dS M Y h:i a', strtotime($order['Order']['modified'])),
                                'autofocus' => 'autofocus',
                                'readonly'=>'readonly'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Shipping Address:</h3>
                            <h4><b><?= $order['ShippingAddress']['name'] ?></b></h4> <br/>

                            <?= $order['ShippingAddress']['line1'] ?> <?= $order['ShippingAddress']['line2'] ?> <br/>
                            <?= $order['ShippingAddress']['landmark'] ?> <br/>
                            <?= $order['ShippingAddress']['city'] ?> - <?= $order['ShippingAddress']['pincode'] ?> <br/>
                            <?= $order['ShippingAddress']['state'] ?> <br/>
                            <b>Phone: </b> <?= $order['ShippingAddress']['mobile'] ?>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>

         
                    <!-- Table -->      
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Order Items: </h2>
                        </div>
                        <div class="col-md-12">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <table class="table table-striped table-bordered table-hover" id="dataTables">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>##</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                    </tr>
                                    </thead>
                                <tbody class="tbody">
                                <?php $no = 1; ?>
                                <?php foreach ($order['OrderItem'] as $data): ?>
                                    <tr style="cursor: pointer;">

                                        <?php
                                            if (isset($data['variants']) && $data['variants'] != null) {
                                                $variants = json_decode($data['variants'], true);
                                            } else {
                                                $variants = [];
                                            }
                                        ?>

                                        <td>
                                            <?= $no ?>
                                        </td>

                                        <td>
                                            <?= $this->Html->image($data['item_image'], ['style' => 'width: 100px;']) ?>
                                        </td>

                                        <td>
                                            <?php echo $data['item_name']; ?>
                                            <br />
                                            (
                                            <?php foreach ($variants as $var): ?> 
                                                <b><?= $var['key'] ?></b> : <span style="color: green; font-weight: 800;"> <?= $var['value'] ?> </span>
                                            <?php endforeach; ?>
                                            )
                                            <br/>
                                            <b>Seller:</b> <?= $data['seller_name'] ?> &nbsp;&nbsp;&nbsp;
                                            <b>Seller SKU:</b> <?= $data['seller_sku_code'] ?>
                                        </td>

                                        <td>
                                            <?= $data['item_price'] ?>
                                        </td>


                                    </tr>
                                <?php $no = $no + 1; ?>
                                <?php endforeach; ?>

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- x0x0x0x0x -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <h1> Grand Total: </h1>
                                <h2 style="text-align: right;">&#8377; <?= round($order['Order']['total_amount'] + $order['Order']['shipping_charges'],2) ?>/-</h2>
                            </div>
                        </div>
                    </div>

                </div><!-- /.box -->
            </div>
            </div>

        </div>
    </section>
<?php $this->end("main-content"); ?>
