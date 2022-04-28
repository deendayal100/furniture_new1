<?php if(isset($this->session->userdata["warehouse_user"]["username"])){  }else{ redirect('warehouse/Login') ; } ?>
<!DOCTYPE html>
<html lang="en" class="loading">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>FURNITURE.MU - Warehouse</title>
   <!--<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/')?>img/logo.JPG">-->
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/chartist.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>css/custom.css">
    <style>
    
.modal-header{background: #ff586b; border-radius: 0px; color: #fff; text-align: center; display: block;}
.modal-title{font-weight: 600; font-size: 22px; text-align: center; margin: 0px;}
.modal-title span {font-size: 16px; margin-left: 15px; font-weight: 500; position: relative; top: -2px;}
.modal-header .close{position: absolute; top: 9px; right: 10px; color: #fff; opacity: 1; padding: 0; margin: 0;}
.modal_inside{width: 100%; background: none; padding: 0px;}
.nav-tabs .nav-item{min-width: 40%; text-align: center;}
.tab-content{border: 1px solid #dee2e6; border-top: 0; padding: 20px 29px;}
.productTable{width: 100%; background: none; padding: 20px 25px;}

.productTable ul{margin: 0px auto; padding: 0px; list-style: none; text-align: left;}
.productTable li {
    border-bottom: 1px solid #f4f4f4;
    float: none;
    display: inline-block;
    padding: 5px 0px;
    text-align: left;
    font-size: 15px;
    color: #333;
    width: 100%;
}
.productTable li img {
    width: 30px;
    height: 30px;
    margin-right: 6px;
    position: relative;
    top: -2px;
}
.productTable h5{
    font-size: 20px;
    font-weight: 500;
}

    .neworder{
        color:orange;
    }
    .requested{
        color:#5390dc;
    }
    .accepted{
        color:blue;
    }
    .on_the_way{
        color:green;
    }
    .completed{
        color:green;
    }
     .failed{
        color:red;
    }
   
table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: normal !important;
}
.nav-tabs .nav-link {

    height: 100%;
    font-size: 15px;
    padding: 0.5rem 10px;
}

.nav-tabs .nav-item {

    min-width: 40%;
    text-align: center;
    min-width: 32% !important;
    width: 32% !important;

}
#DataTables_Table_0_wrapper{
  overflow: auto!important;
}

.table th, .table td{
    max-width: 200px;
    
}
/*.table td{word-break: break-word;}*/
.card .card-block{
    overflow: auto;
}

    
</style>
  </head>
  <?php $CI = & get_instance(); ?>
  <body data-col="2-columns" class=" 2-columns ">

    <div class="wrapper">

      <div data-active-color="black" data-background-color="white" data-image="" class="app-sidebar">

        <div class="sidebar-header">
          <div class="logo clearfix">
            <a href="<?php echo base_url('warehouse/Home/')?>" class="logo-text float-left">
              <div class="logo-img">
                  <img width="350px" height="50px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo"> 
                  <!--<p style="color: black;">Warehouse</p>-->
              </div>
            </a>
            <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-toggle-right toggle-icon"></i>
            </a>
            <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i>
            </a>
          </div>
        </div>

        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
              <li class=" nav-item <?php if($this->uri->segment(2)=="Home" && $this->uri->segment(3)==""){ echo "active"; } ?>"><a href="<?php echo base_url('warehouse/Home')?>"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
              </li>
               <li class="has-sub nav-item <?php if($this->uri->segment(2)=="Invoice"){ echo "open"; } ?>"><a href="#"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Invoices</span></a>
                <ul class="menu-content">
                 <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice')?>" class="menu-item">ALL</a>
                  </li>
                 <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "new" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/new')?>" class="menu-item">NEW</a>
                  </li>
                  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "scheduled" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/scheduled')?>" class="menu-item">SCHEDULED</a>
                  </li>
                   <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "withdriver" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/withdriver')?>" class="menu-item">WITH DRIVER</a>
                  </li>
				  <li class="mydels <?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "delbydriver" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/delbydriver')?>" class="menu-item">DELIVERED BY DRIVER</a>
                  </li>
                   <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "delivered" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/delivered')?>" class="menu-item">DELIVERED</a>
                  </li>
				  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "failed" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/failed')?>" class="menu-item">NOT DELIVERED/FAILED</a>
                  </li>
                   <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "own" ){ echo "active" ; } ?>"><a href="<?php echo base_url('warehouse/Invoice/own')?>" class="menu-item">OWN DELIVERY</a>
                  </li>
                </ul>
              <!--<li class=" nav-item <?php if($this->uri->segment(2)=="Invoice"){ echo "active"; } ?>" ><a href="<?php echo base_url('warehouse/Invoice')?>"><i class="fa fa-money"></i><span data-i18n="" class="menu-title">Invoices</span></a>-->
              <!--</li>-->
              <li class=" nav-item <?php if($this->uri->segment(2)=="Tracking"){ echo "active"; } ?>" ><a href="<?php echo base_url('warehouse/Tracking')?>"><i class="fa fa-truck"></i><span data-i18n="" class="menu-title">Tracking</span></a>
              </li>
               <li class=" nav-item <?php if($this->uri->segment(3)=="calls" ){ echo "active"; } ?>" ><a href="<?php echo base_url('warehouse/Home/calls')?>"><i class="fa fa-phone"></i><span data-i18n="" class="menu-title">Upload Calls</span></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="sidebar-background"></div>
      </div>


      <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
          <div class="navbar-header"> <i id="toggleList" class="fa fa-list"></i> </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="dropdown nav-item">
                  <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                    <!--<a href="profile.html" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>My Profile</span></a>-->
                    <a href="<?php echo base_url('warehouse/Login/logout')?>" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <!--<div class="main-panel">-->