<?php 
    $user  = $this->session->userdata('id');
    $user = $this->auth->get_admin($user);
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
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/jquery/jquery_new.js"></script>




  
  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/extra/buttons.bootstrap4.min.css">


</head>
<body class="hold-transition sidebar-mini">
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
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" onclick="read_notifi();">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge" id="bell">
              <?php if($this->auth->count_notifi() > 9){ echo "9+"; }else{ echo $this->auth->count_notifi(); } ?>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header" ><span id="notifi"><?= $this->auth->count_notifi(); ?></span> Notifications</span>
            
            <?php foreach ($this->auth->get_notifi() as $key => $value) { ?>

              <div class="dropdown-divider"></div>
              <a href="<?php if($value['notification_type'] == 'withdraw'){ echo base_url('withdraw_request'); }else{ echo '#'; } ?>" class="dropdown-item">
                <i class="fa fa-credit-card-alt"></i> <?= read_more($value['message']); ?>
                <span class="float-right text-muted text-sm"><?= ucfirst($value['notification_type']); ?></span>
              </a>

            <?php } ?>
              
            
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('notification'); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link sign-out-custom" title="Sign Out" href="<?php echo base_url('dashboard/logout'); ?>"><i class="fa fa-power-off"></i></a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <script type="text/javascript">
    

    function read_notifi()
    {
        $.ajax({
                type:'POST',
                url: "<?= base_url();?>notification/read",
                success: function(html){
                    $('#bell').html('0');
                    $('#notifi').html('0');
                }
        });
    }

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



<div class="modal fade" id="master_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form onsubmit="return submit_passs();" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Please Enter Master Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control form-control-sm" value="" type="password" name="m_pass" id="m_pass" placeholder="Master Password" autocomplete="off" >
                            <input type="hidden" name="" id="url">
                            <span id="ms_error" style="color: red;font-weight: 600;"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" name="" id="hidden_auth" value="<?= master_pass(); ?>">