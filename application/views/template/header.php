<?php 
    $user  = $this->session->userdata('id');
    $this->load->model('general_model');
    $this->load->model('user_model');

    $user_data = $this->user_model->_user($user)[0];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
  <!-- Tell the browser to be responsive to screen width -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/custom_add.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/flat/blue.css">
  <!-- Minimal Drop down -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2/select2.min.css"> 
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/all.css">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/jQueryUI/jquery-ui.css">
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/jquery/jquery_new.js"></script>




  
  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/extra/buttons.bootstrap4.min.css">


</head>
<body class="hold-transition <?php if($this->uri->segment(2) == 'add_data' || $this->uri->segment(2) == 'view_data'){ echo 'sidebar-collapse'; }else{ echo 'sidebar-open'; } ?>">
  <div id="_preloader"></div>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      
    </ul>

    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <h6 style="margin-bottom: 0; padding: 5px;">Sem : 
            <select class="form-control-sm" style="width: 150px;" onchange="change_sem(this.value);">
                <option value="0" <?= ($this->session->userdata('sem') && $this->session->userdata('sem') == '0')?'selected':''; ?>>All</option>  
                <option value="1" <?= ($this->session->userdata('sem') && $this->session->userdata('sem') == '1')?'selected':''; ?>>SEM 1 - 3 - 5</option>  
                <option value="2" <?= ($this->session->userdata('sem') && $this->session->userdata('sem') == '2')?'selected':''; ?>>SEM 2 - 4 - 6</option>  
            </select>
          </h6>
        </li>
        <li class="nav-item">

          <h6 style="margin-bottom: 0; padding: 5px;">Active Financial Year : 
            <select class="form-control-sm" style="width: 150px;" onchange="change_year(this.value);">
                <?php foreach($this->db->get('financial_year')->result_array() as $y_ind => $year){  ?>

                  <?php foreach (explode(',',$user_data['year']) as $k => $val) { if($year['name'] == $val){ ?>

                    <option value="<?= $year['name'] ?>" <?php if($this->session->userdata('year') == $year['name']){ echo "selected"; } ?>><?= $year['name'] ?></option>
                    
                  <?php } } ?>


                <?php } ?>    
            </select>
          </h6>
          

        </li>
        <li class="nav-item">
          <a class="nav-link sign-out-custom" title="Sign Out" href="<?php echo base_url('dashboard/logout'); ?>"><i class="fa fa-power-off"></i></a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->


    <script type="text/javascript">

        $(function (){

            <?php if(!empty($this->session->flashdata('error'))){ ?>

                $.notify({
                  title: '<strong></strong>',
                  icon: 'fa fa-times-circle',
                  message: '<?php echo $this->session->flashdata('error'); ?>'
                },{
                  type: 'danger'
                });

            <?php $this->session->set_flashdata('error',''); } ?>

            <?php if(!empty($this->session->flashdata('msg'))){ ?>

                $.notify({
                  title: '<strong></strong>',
                  icon: 'fa fa-check',
                  message: '<?php echo $this->session->flashdata('msg'); ?>'
                },{
                  type: 'success'
                });

            <?php $this->session->set_flashdata('msg',''); } ?>


            <?php if(!empty(validation_errors())){ ?>

                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Your Form Was Not Submmited Check Your Form'
                },{
                    type: 'danger'
                }); 
            <?php } ?>

        })

    </script>


  

    <style type="text/css">
        #_preloader { position: fixed; left: 0; top: 0; z-index: 2000; width: 100%; height: 100%; overflow: visible; background: #ffffff url('<?=base_url();?>/image/loading.gif') no-repeat center center; }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
              $('#_preloader').fadeOut('slow');
              $('#_preloader').remove();
        })
    </script>


    <script type="text/javascript">
        function change_year(year)
        {
            if(confirm('Are you sure You Want To Change Financial Year ?'))
            {
                window.location.href = "<?= base_url('setting/') ?>active_year_dash/"+year;
            }
        }

        function change_sem(sem)
        {
            if(confirm('Are you sure You Want To Change Sem ?'))
            {
                window.location.href = "<?= base_url('setting/change_sem/') ?>"+sem;
            }
        }
    </script>