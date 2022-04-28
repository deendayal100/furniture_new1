<?php include("header.php") ; ?>
<div class="main-panel">
<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Call Recordings
		<a href="<?php echo base_url('warehouse/Home/calls') ?>" >
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



<section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                              
                               
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Calls</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Upload Recording Files</label><br>
                                        <input type="file" name="recordings[]" multiple required class="form-control" accept="video/mpeg">
                                    </div>
                                    </div>
                                   
                                    
                                   </div>
                                    
                                 
                                </div>
                            </div>
                            <div class="form-actions center">
								<button type="submit" name="userSubmit" value="save" class="btn btn-raised btn-primary">
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

