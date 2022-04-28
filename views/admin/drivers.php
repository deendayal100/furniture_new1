<?php include("header.php") ; ?>

<div class="main-panel">
  <div class="main-content">
    <div class="content-wrapper"><!--Statistics cards Starts-->
        
    <div class="row">
    <div class="col-12">
        <div class="content-header">Manage drivers Activities  
		 
               <a href="<?php echo base_url('admin/Driver/add') ?>" >
             
			 <button class="btn btn-success pull-right">+ Add New </button> 
             </a>
			 
       </div>
        <p class="content-sub-header">All users data and Activities.</p>
         <?php if($this->session->flashdata("message")){ ?>
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   <?php echo  $this->session->flashdata("message") ; ?>
        </div>
       <?php } ?> 
        <?php if($this->session->flashdata("errmessage")){ ?>
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert" style="margin-top: 15px;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   <?php echo  $this->session->flashdata("errmessage") ; ?>
        </div>
       <?php } ?> 
    </div>
</div>
<section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <div class="card-body collapse show">
                                <div class="card-block card-dashboard">
                                    <table class="table table-striped table-bordered zero-configuration" id="usertable">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Image</th>
												<th>Name</th>
											    <th>Contact</th>
											    <th>Email</th>
												<th>Truck Plate No.</th>
												<th>status</th>
											 	<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									  <?php $i = 1 ; 
									  if(!empty($view)){
									    foreach($view as $vw){ ?>
										<tr>
											<td><?php echo $i ; ?></td>
											<td><img src="<?php echo base_url($vw->image); ?>" width="100" height="80" alt="Not available"></td>
											<td><?php echo $vw->name; ?></td>
											<td><?php echo $vw->mobile; ?></td>
										    <td><?php echo $vw->email; ?></td>
											<td><?php echo $vw->truck_plate_no; ?></td>
											<td><?php if($vw->status==0){ echo "<span style='color:orange;'>New registration</span>"; }elseif($vw->status==1){ echo "<span style='color:green;'>Active</span>"; }else{ echo "<span style='color:red;'>Deactive</span>"; }  ?></td>
									        <td>
												 <a class="success p-0" title="Edit" href="<?php echo base_url('admin/Driver/edit/').$vw->id ?>" >
													<i class="ft-edit-2 font-medium-3 mr-2"></i>
												</a>
												<a class="danger p-0" href="<?php echo base_url('admin/Driver/delete/').$vw->id ?>" onClick="return confirm('are you sure want to delete..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>
											</td>
										 </tr>
									  <?php $i++ ; } }?>   
									</tbody>
                                    </table>
                                </div>
                            </div>                
                         </div>
                      </div>
                  </div>
              </div>
        </section>
   </div>
 </div>
 
<?php include("footer.php") ; ?> 





