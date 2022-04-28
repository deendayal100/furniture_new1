<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register/Login Aftersales</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/custom.css">
   </head>
   <body>
    <div class="login-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-section1">
              <div class="logo-2">
                <a <img width="350px" height="100px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo"></a>
              </div> 
			  <br><br>
				<?php 
				$assign = $this->db->get_where(TBL_ASSIGN,['order_no'=>1111,'cancel_status'=>1])->row();
				?>
                <div class="card">
                  <div class="card-header padding-set">
                     <h5>Delivery Images <?php //echo $view->orderno; ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="card-block">
						<div class="sdf">
							<?php
							   if(empty($assign)){ }else{
							   if($assign->status=="Not delivered" || $assign->status=="Delivered"){ ?>
							<?php
							   if($assign->image!=""){
							   ?>
							<img src="<?php echo base_url($assign->image)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
							<span>Not Available</span>
							<?php } ?>
							<?php
							   if($assign->image1!=""){
							   ?>
							<img src="<?php echo base_url($assign->image1)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
							<span>Not Available</span>
							<?php } ?>
							<?php
							   if($assign->image2!=""){
							   ?>
							<img src="<?php echo base_url($assign->image2)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
							<span>Not Available</span>
							<?php } ?>
							<?php
							   if($assign->image3!=""){
							   ?>
							<img src="<?php echo base_url($assign->image3)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
							<span>Not Available</span>
							<?php } ?>
							<?php }} ?>
						 </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </body>
   <script src="<?php echo base_url('assets/')?>aftersale/js/popper.min.js"></script>
   <script src="<?php echo base_url('assets/')?>aftersale/js/jquery-3.4.1.slim.min.js"></script>
   <script src="<?php echo base_url('assets/')?>aftersale/js/bootstrap.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>