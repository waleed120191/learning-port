<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->

<div class="container">
    <div class="row">
        
        <?php foreach ($products as $key => $product) { ?>
        <div class="col-md-4">
            <div class="product-item">
                <div class="pi-img-wrapper">
                    <img src="<?php echo base_url('assets/themes/default/image/default-product.png'); ?>" class="img-responsive" alt="<?php echo $product->product_name; ?>">
                    <div>
                        <a data-title="More info" data-content="<?php echo $product->product_shortDecription; ?>" class="btn productMoreInfo">More info</a>
                    </div>
                </div>
                <h3><?php echo $product->product_name; ?></h3>
                <div class="pi-price">$ <?php echo $product->product_cost; ?></div>
                <a onclick="addProduct(this)" data-id="<?php echo $product->product_id; ?>" class="btn add2cart primary">Add to cart</a>

            </div>
        </div>
        <?php } ?>


        
    </div>
</div>
