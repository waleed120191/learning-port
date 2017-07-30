<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
        ?>	
        <?php
        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";
        ?>
        <?php
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
            }
        ?>

        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Learning Port</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url('product/index'); ?>">Product</a></li>
                        <li><a href="<?php echo base_url('cart/index'); ?>">Cart <span id="cartNotification" class="badge"><?php echo total_items(); ?></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome <?php echo get_login_user_name(); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $output; ?>
    </body>
    <div class="modal" id="info_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Info</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>


