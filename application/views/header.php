<header class="navbar navbar-inverse navbar-fixed-top" role="banner" >
    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
    <!--    <a id="rightmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="left" title="Toggle Infobar"></a>-->

    <div class="navbar-header pull-left">
        <a class="navbar-brand" href="<?php echo base_url(); ?>home"><?php echo $title; ?></a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?php echo $this->app_model->CariNamaPengguna();?> <i class="fa fa-caret-down"></i></span><img src="<?php echo base_url(); ?>assets/demo/avatar/doyle.png" alt="<?php echo $this->app_model->CariUserPengguna();?>" /></a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left"><img src="<?php echo base_url(); ?>assets/demo/avatar/doyle.png" alt="<?php echo $this->app_model->CariUserPengguna();?>"/></div>
                        <div class="pull-right"><h5>Hai, <?php echo $this->app_model->CariNamaPengguna();?></h5><small>Logged in as <span><?php echo $this->app_model->CariUserPengguna();?></span></small></div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li>
                            <?php if($this->session->userdata('id_level')=='01') { ?>
                                <a href="<?php echo base_url(); ?>pengguna/edit/<?php echo $this->app_model->CariUserPengguna();?>">Edit Profile <i class="pull-right fa fa-pencil"></i></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url(); ?>pengguna/edit_profile/<?php echo $this->app_model->CariUserPengguna();?>">Edit Profile <i class="pull-right fa fa-pencil"></i></a>
                            <?php } ?>
                        </li>
                        <!--<li><a href="#">Account <i class="pull-right fa fa-cog"></i></a></li>
                        <li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('login/logout'); ?>" class="text-right">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </li>
     
    </ul>
</header>
