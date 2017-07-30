<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <div class="col-md-4 col-sm-6 col-xs-12 col-md-push-8 col-sm-push-6">
                <!--REVIEW ORDER-->
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>Review Order</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <strong>Subtotal (# item)</strong>
                            <div class="pull-right"><span>$</span><span><?php echo $total_amount; ?></span></div>
                        </div>
                        <div class="col-md-12">
                            <strong>Discount</strong>
                            <div class="pull-right"><span>$</span><span><?php echo $total_discount; ?></span></div>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <strong>Order Total</strong>
                            <div class="pull-right"><span>$</span><span><?php echo $amount_after_discount; ?></span></div>
                            <hr>
                        </div>

                        <button type="button" class="btn btn-primary btn-lg btn-block disabled">Checkout</button>

                    </div>

                </div>
                <!--REVIEW ORDER END-->
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12 col-md-pull-4 col-sm-pull-6">
                <!--SHIPPING METHOD-->
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Current Cart</h4></div>
                    <div class="panel-body">
                        <?php if (count($cart_contents) > 0) { ?>
                            <table class="table borderless">
                                <thead>
                                    <tr>
                                        <td><strong>Your Cart: # item</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_contents as $k => $p) { ?>
                                        <tr>
                                            <td class="col-md-6">
                                                <div class="media">
                                                    <a class="pull-left"> <img class="media-object" src="<?php echo base_url('assets/themes/default/image/default-product.png'); ?>" style="width: 72px; height: 72px;"> </a>
                                                    <div class="media-body">

                                                        <h5 class="media-heading"><?php echo $p['name']; ?></h5>
                                                        <h5 class="media-heading"><?php echo $p['id']; ?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><?php echo $p['price']; ?></td>
                                            <td class="text-center"><?php echo $p['qty']; ?></td>
                                            <td class="text-right"><?php echo $p['subtotal']; ?></td>
                                            <!--<td class="text-right"><button type="button" class="btn btn-danger">Remove</button></td>-->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table> 
                        <?php } ?>
                    </div>
                </div>
                <!--SHIPPING METHOD END-->
            </div>
        </div>
    </div>
</div>