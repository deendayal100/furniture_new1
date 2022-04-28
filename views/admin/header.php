<?php if(isset($this->session->userdata["admin_user"]["username"])){  }else{ redirect('admin/Login') ; } ?>
<!DOCTYPE html>
<html lang="en" class="loading">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Furniture.mu</title>
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
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <style>
    
.modal-header{background: #ff586b; border-radius: 0px; color: #fff; text-align: center; display: block;}
.modal-title{font-weight: 600; font-size: 22px; text-align: center; margin: 0px;}
.modal-title span {font-size: 16px; margin-left: 15px; font-weight: 500; position: relative; top: -2px;}
.modal-header .close{position: absolute; top: 9px; right: 10px; color: #fff; opacity: 1; padding: 0; margin: 0;}
.modal_inside{width: 100%; background: none; padding: 0px;}
.nav-tabs .nav-item{min-width: 40%; text-align: center;}
.tab-content{border: 1px solid #dee2e6; border-top: 0; padding: 20px 29px ;}
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

.dataTables_wrapper{overflow: auto;}
.main_steps li span {
    background: #225f3f !important;
    color: #fff !important;
    height: auto !important;
    width: auto !important;
    display: block !important;
    margin: auto !important;
    border-radius: 5px !important;
    border: 1px solid #e6e6e6 !important;
    font-size: 15px !important;
    padding: 10px 0px !important;
}

    
</style>
  </head>
  <?php $CI = & get_instance(); ?>
  <body data-col="2-columns" class=" 2-columns ">

    <div class="wrapper">

      <div data-active-color="black" data-background-color="white" data-image="" class="app-sidebar">

        <div class="sidebar-header">
          <div class="logo clearfix">
            <a href="<?php echo base_url('admin/Home/')?>" class="logo-text float-left">
              <div class="logo-img">
                  <img width="250px" height="50px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo">                                             
                  <!--<p style="color: black;">Furniture.mu</p>-->
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
              <li class=" nav-item <?php if($this->uri->segment(2)=="Home" && $this->uri->segment(3)==""){ echo "active"; } ?>"><a href="<?php echo base_url('admin/Home')?>"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
              </li>
                <li class="has-sub nav-item <?php if($this->uri->segment(2)=="Invoice"){ echo "open"; } ?>"><a href="#"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Invoices</span></a>
                <ul class="menu-content">
                 
                 <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "new" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/new')?>" class="menu-item">NEW</a>
                  </li>
				  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "current" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/current')?>" class="menu-item">CURRENT</a>
                  </li>
				  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/')?>" class="menu-item">ALL</a>
                  </li>
				  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "scheduled" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/scheduled')?>" class="menu-item">SCHEDULED</a>
                  </li>
                 <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "posted" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/posted')?>" class="menu-item">POSTED</a>
                  </li>
                 <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "void" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/void') ;  ?>" class="menu-item">VOID</a>
                  </li>
                 <!--<li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "deleted" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/deleted')?>" class="menu-item">DELETED</a>
                  </li>-->
                 
                 
				  <li class="<?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "own" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Invoice/own')?>" class="menu-item">OWN DELIVERY</a>
                  </li>
                </ul></li>
              <!--<li class=" nav-item <?php if($this->uri->segment(2)=="Invoice"){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Invoice')?>"><i class="fa fa-money"></i><span data-i18n="" class="menu-title">Invoices</span></a>-->
              <!--</li>-->
               <li class=" nav-item <?php if($this->uri->segment(2)=="Driver"){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Driver')?>"><i class="fa fa-truck"></i><span data-i18n="" class="menu-title">Drivers</span></a>
              </li>
              <li class=" nav-item <?php if($this->uri->segment(2)=="Staff"){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Staff')?>"><i class="fa fa-users"></i><span data-i18n="" class="menu-title">Staff Members</span></a>
              </li>
			  <li class=" nav-item <?php if($this->uri->segment(2)=="Deleted_invoice"){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Deleted_invoice')?>"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Restore Invoice</span></a>
              </li>
               <li class=" nav-item <?php if($this->uri->segment(2)=="Tracking"){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Tracking')?>"><i class="fa fa-truck"></i><span data-i18n="" class="menu-title">Tracking</span></a>
              </li>
              <li class=" nav-item <?php if($this->uri->segment(3)=="calls" ){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Home/calls')?>"><i class="fa fa-phone"></i><span data-i18n="" class="menu-title">Upload Calls</span></a>
              </li>
              <li class="has-sub nav-item <?php if($this->uri->segment(2)=="User" ){ echo "active"; } ?>" ><a href="#"><i class="fa fa-user"></i><span data-i18n="" class="menu-title">Users</span></a>
				<ul class="menu-content">
					<li class="nav-item <?php if($this->uri->segment(2)=="User" ){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/User')?>"><i class="fa fa-user"></i><span data-i18n="" class="menu-title">User</span></a>
					</li>
          <li class=" nav-item <?php if($this->uri->segment(2)=="User" ){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Home/wipe')?>" onClick="return confirm('are you sure want to delete all database..?')"><i class="fa fa-trash"></i><span data-i18n="" class="menu-title">Wipe out database</span></a>
              </li>
					<li class=" nav-item" ><a href="<?php echo base_url('apk/furnituremu.apk')?>"><i class="fa fa-download"></i><span data-i18n="" class="menu-title">Download APK</span></a>
					</li>
				</ul>
              </li>
			  
              <li class=" nav-item <?php if($this->uri->segment(2)=="Report" ){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Report')?>"><i class="fa fa-user"></i><span data-i18n="" class="menu-title">Report</span></a>
              </li>


		<!---	  <li class=" nav-item <?php if($this->uri->segment(2)=="Custmers" ){ echo "active"; } ?>" ><a href="<?php echo base_url('admin/Custmers')?>"><i class="fa fa-users"></i><span data-i18n="" class="menu-title">Custmers Section</span></a>
              </li>--->


               <li class="has-sub nav-item <?php if($this->uri->segment(2)=="Custmers"){ echo "open"; } ?>"><a href="#"><i class="fa fa-users"></i><span data-i18n="" class="menu-title">Custmers Section</span></a>
                <ul class="menu-content">
                  <?php 
                   $all = $this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.tc ,customer_orderno.order_number,customer_orderno.purchase_date, invoice.id as invoice_id from customer left join customer_orderno on customer.id = customer_orderno.customer_id left join  invoice on customer_orderno.order_number = invoice.orderno GROUP BY id order by id desc")->result();
                   
                  
                   $replied = $this->db->query("select order_number from customer_order_reply")->result();
                   $newCust=0;
                   $repliedCust=0;
                   if(!empty($all)){
                                    $repliedcheck1 = array();
                                     if(!empty($replied)){
                                            foreach($replied as $ncu1){
                                                array_push($repliedcheck1,$ncu1->order_number);
                                            }
                                        } 
                                        foreach($all as $v){ 
                                        if(in_array($v->order_number,$repliedcheck1)){
                                            $repliedCust+=1;
                                        }else{
                                          $newCust+=1;
                                        }
                                      }
                                    }

                       $view1=$this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.tc ,customer_response.order_number,customer_response.more_options, invoice.id as invoice_id from customer left join customer_response  on customer.id = customer_response.customer_id left join  invoice on customer_response.order_number = invoice.orderno GROUP BY id order by id desc")->result();
                       $res=0;
                       if(!empty($view1)){

                                        $repliedcheck1 = array();
                                        if(!empty($replied)){
                                            foreach($replied as $ncu1){
                                                array_push($repliedcheck1,$ncu1->order_number);
                                            }
                                        }
                                     

                          foreach($view1 as $v){ 
                                        if(!in_array($v->order_number,$repliedcheck1)){

                                        }else{
                                          $res+=1;
                                        }
                                      }
                                    }
                    $invoiceRepied=$this->db->query("select * from customer_order_reply group by order_number order by id")->result();
                    $complent =    $this->db->query("SELECT assign.*,
        status_txn.type as status_type,
        invoice.name as invoice_name,
        invoice.phone as invoice_phone
        FROM assign 
        INNER join status_txn on status_txn.assign_id = assign.id
        INNER join invoice on invoice.orderno = assign.order_no
        where assign.status ='Own Delivered'  group by assign.id order by assign.id")->result();

                   ?>
                 <li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "newCustomer" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/allCustomer')?>" class="menu-item">ALL CUSTOMER --<?php echo count($all);?></a>
                    </li>
                  <li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "newCustomer" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/newCustomer')?>" class="menu-item">NEW --<?php echo $newCust;?></a> 
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "repliedCustomer" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/repliedCustomer')?>" class="menu-item">REPLIED --<?php echo $repliedCust;?></a> 
                  </li> 
                   <li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "responseCustomer" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/responseCustomer')?>" class="menu-item">CUSTOMER REPLIED --<?php echo $res;?></a>
                  </li>
				<li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "repliedInvoices" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/repliedInvoices')?>" class="menu-item">REPLIED INVOICES --<?php echo count($invoiceRepied);?></a>
                  </li>
        
        		<li class="<?php if($this->uri->segment(2) == "Custmers" && $this->uri->segment(3) == "complent" ){ echo "active" ; } ?>"><a href="<?php echo base_url('admin/Custmers/complaint')?>" class="menu-item">  COMPLAINT--<?php echo count($complent);?></a>
                  </li>
                 
                </ul></li>








            
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
                    <a href="<?php echo base_url('admin/Login/logout')?>" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <!--<div class="main-panel">-->