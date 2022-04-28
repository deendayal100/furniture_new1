<?php include("header.php") ; ?>
<div class="main-panel">
<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Add New User
		<a href="<?php echo base_url('admin/User') ?>" >
             
			 <button class="btn btn-success pull-right">Back</button> 
             </a>
        </div>
        
        <?php if($this->session->flashdata("errmessage")){ ?>
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert" style="margin-top: 15px;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   <?php echo  $this->session->flashdata("errmessage") ; ?>
        </div>
       <?php } ?> 
       <?php if($this->session->flashdata("message")){ ?>
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert" style="margin-top: 15px;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   <?php echo  $this->session->flashdata("message") ; ?>
        </div>
       <?php } ?> 
        
    </div>
</div>

<style>
.custom-control {
    display: inline-block;
    margin-right: 25px;
}
</style>

<section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Fill All Detail</h4>
                                
                                <div class="col-md-12"  style="float:left">
                                    <div class="form-group">
                                        <label >Name</label>
                                       <input type="text" name="name" required class="form-control" value="<?php if(isset($records)){ echo $records->username; }?>">
                                    </div>
                                    <div class="form-group">
                                        <label >Email</label>
                                       <input type="email" name="email" required class="form-control" value="<?php if(isset($records)){ echo $records->email; }?>">
                                    </div>
                                    <!-- <div class="form-group">-->
                                    <!--    <label >Mobile number</label>-->
                                    <!--   <input type="text" name="mobile" required class="form-control" value="<?php if(isset($records)){ echo $records->mobile; }?>" <?php if(isset($records)){ echo "readonly"; } ?>>-->
                                    <!--</div>-->
                                     <div class="form-group">
                                        <label >Password</label>
                                       <input type="text" name="password" required class="form-control" value="<?php if(isset($records)){ echo $records->password; }?>">
                                    </div>
                                     <div class="form-group">
                                        <label >User Type</label><br>
                                        <div class="card-content">
                                          <div class="card-body">
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio1" name="user_type" value="PL" class="custom-control-input" <?php if(isset($records) && $records->type=='PL'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio1">PL</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio2" name="user_type" value="RT" class="custom-control-input" <?php if(isset($records) && $records->type=='RT'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio2">RT</label>
                                            </div>
                                           
                                          </div>
                                        </div>
                      
                                    </div>
                                    <!-- <div class="form-group">-->
                                    <!--    <label >Truck plate number</label>-->
                                    <!--   <input type="text" name="truck_plate"  class="form-control" value="<?php if(isset($records)){ echo $records->truck_plate_no; }?>">-->
                                    <!--</div>-->
                                    <!-- <div class="form-group">-->
                                    <!--    <label >Image</label><br>-->
                                    <!--    <?php if(isset($records)){ ?>-->
                                    <!--    <img src="<?php echo base_url($records->image); ?>" width="100" height="80" alt="Not available">-->
                                    <!--    <input type="hidden" name="old_img" value="<?php echo $records->image?>">-->
                                    <!--    <?php } ?>-->
                                    <!--   <input type="file" name="image"  class="form-control" >-->
                                    <!--</div>-->
                                 </div>
                                   
                            </div>

							<div class="form-actions center">
								<button type="submit" name="submit" value="save" class="btn btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>


  </div>
</div>
        
<?php include("footer.php") ; ?> 

