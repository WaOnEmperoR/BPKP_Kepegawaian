<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MITENSILAN | Forgot Password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avant">
    <meta name="author" content="The Red Team">
    <link href="<?php echo base_url(); ?>assets/img/BPKP.png" rel="SHORTCUT ICON" />

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
            <img src="<?php echo base_url(); ?>assets/img/Logo Mitensilan.png" height="100px" width="275px">
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
            <h1><?php echo lang('forgot_password_heading');?></h1>
            <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

            <div id="infoMessage"><?php echo $message;?></div>

            <?php echo form_open("login/forgot_password");?>


                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                          <p>
                            <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                            <?php echo form_input($identity);?>
                          </p>
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
                <!--div class="clearfix">
                    <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                </div-->

        </div>
        <div class="panel-footer">

            <div class="pull-right">
                <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
            </div>
        </div>
        <?php echo form_close();?> 
    </div>
</div>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js'></script>
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
