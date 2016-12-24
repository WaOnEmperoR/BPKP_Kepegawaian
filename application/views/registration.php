<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Aplikasi Monitoring</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Avant">
        <meta name="author" content="The Red Team">
        <link href="<?php echo base_url(); ?>assets/img/favicon.png" rel="SHORTCUT ICON" />
        <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
        <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
        <style>
            .login-logo, .register-logo {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            }
        </style>
    </head>
    <body class="focusedform background-login">
        <div class="verticalcenter">
            <div class="login-logo">
                <a href="#">
                    <img src="<?php echo base_url(); ?>assets/img/logo_login.png">
                    <br>
                    <h4 class="description">
                        Sistem Informasi Monitoring SDM
                        <br>
                        BPKP Provinsi Maluku
                    </h4>
                </a>
                <h6>
                    <a href="#"></a>
                </h6>
            </div>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h3 class="text-center"><?php echo lang('create_user_heading');?></h3>
                    <?php echo form_open('login/registration');?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('edit_user_fname_label', 'first_name');?></label> 
                                <div class="col-sm-8">
                                    <?php echo form_input($first_name);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('edit_user_lname_label', 'last_name');?></label> 
                                <div class="col-sm-8">
                                    <?php echo form_input($last_name);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
						if($identity_column!=='email') {
							echo '<p>';
							echo lang('create_user_identity_label', 'identity');
							echo '<br />';
							echo form_error('identity');
							echo form_input($identity);
							echo '</p>';
						}
						?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('edit_user_company_label', 'company');?></label>
                                <div class="col-sm-8">
                                    <?php echo form_input($company);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('edit_user_phone_label', 'phone');?></label>
                                <div class="col-sm-8">
                                    <?php echo form_input($phone);?>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('create_user_email_label', 'email');?></label>
                                <div class="col-sm-8">
                                    <?php echo form_input($email);?>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('create_user_password_label', 'email');?></label>
                                <div class="col-sm-8">
                                    <?php echo form_input($password);?>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group"  style="width: 100%">
                                <label class="col-sm-4 control-label" style="padding-left:0px;"><?php echo lang('create_user_password_confirm_label', 'email');?></label>
                                <div class="col-sm-8">
                                    <?php echo form_input($password_confirm);?>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div id="infoMessage"><b><font color="red"><?php echo $message;?></font></b></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>
                    </div>
                </div>
                <?php echo form_close();?> 
            </div>
        </div>
    </body>
</html>