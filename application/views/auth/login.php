<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Login to site</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-6">
                    <p class="lead">Please choose <span class="text-success">Customer :</span></p>
                    <!--<ul class="list-unstyled" style="line-height: 3">-->
                    <?php foreach ($customers as $customer) { ?>
                        <button type="button" class="btn btn-primary mt-10 login-filler" data-email="<?php echo $customer->user_email; ?>" data-password="<?php echo $customer->user_password; ?>"><?php echo ucfirst($customer->user_type); ?></button>
                    <?php } ?>
                    <!--</ul>-->
                </div>
                <div class="col-xs-6">
                    <div class="well">
                        <form id="loginForm" method="POST" action="<?php echo base_url('auth/login'); ?>">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" title="Please enter you email" placeholder="example@mail.com"  required>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" title="Please enter your password"  required>
                                <span class="help-block"></span>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>