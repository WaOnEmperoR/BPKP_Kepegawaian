<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "incl.php"; ?>
</head>

<body class="">
<?php
    include "header.php";
?>
<div id="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php
        /*if($this->session->userdata('level')=='1'){
            echo $this->load->view('sidebar');
        } else if($this->session->userdata('level')=='2'){
            echo $this->load->view('sidebar_dinas');
        } else if($this->session->userdata('level')=='3'){
            echo $this->load->view('sidebar_operator_sekolah');
        } else if($this->session->userdata('level')=='5'){
            echo $this->load->view('sidebar_eksekutif');
        } else if($this->session->userdata('level')=='6'){
            echo $this->load->view('sidebar_kepala_sekolah');
        } else if($this->session->userdata('level')=='7'){
            echo $this->load->view('sidebar_operator_un');
        }*/

        if ($this->ion_auth->in_group(1))
        {
            echo $this->load->view('sidebar');
        }
    ?>

    <?php echo $content; ?>

    <?php include "footer.php"; ?>
</div> <!-- page-container -->

</body>
</html>
