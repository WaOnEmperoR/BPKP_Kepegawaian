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
            <h4 class="text-center" style="margin-bottom: 25px;">Silahkan Login</h4>
            <!-- <?php echo form_open("login/index");?> -->
            <form method="post" action="<?php echo base_url(); ?>login/index" class="form-horizontal" style="margin-bottom: 0px !important;">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?php echo form_input($username,set_value('username')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <?php echo form_input($password); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">    
                            <div id="infoMessage"><b><font color="red"><?php echo $message;?></font></b></div>
                            <?php echo lang('login_remember_label', 'remember');?>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                            <p>
                                <a href="login/forgot_password"><?php echo lang('login_forgot_password');?></a>
                            </p>
                            
                        </div>
                    </div>
                </div>
        </div>
        <div class="panel-footer">

            <div class="pull-right">
                <a id="reset" class="btn btn-default">Reset</a>
                <?php echo form_button($submit,'Login');?>
                <!-- <?php echo form_submit('submit', lang('login_submit_btn'));?> -->
            </div>
        </div>
        </form>
        <!-- <?php echo form_close();?> -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#reset").click(function(){
            $('#username').val('');
            $('#password').val('');
        });
    });
</script>

</body>
</html>
