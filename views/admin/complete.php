<?php include("header.php") ; ?>


 <div class="main-panel">

<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header"><?php echo $page; ?> Invoice Activities  
	    
	    </div>
        <p class="content-sub-header">All Invoice data and Activities.</p>
         <?php if($this->session->flashdata("message")){ ?>
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
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
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <div class="card-body collapse show">
                                <div class="card-block card-dashboard">
                                    <?php if($this->uri->segment(3) == "scheduled"){ ?>
                                    <form action="" method="post" style="width: 100%;margin-bottom: 15px;">
                                    <div class="row">
                                         <div class="col-md-6">
                                         <input class="form-control" type="date" name="scheduled_date" value="<?php if(!empty($searchArr)){ echo $searchArr["searchdate"]; }?>" required>
                                         </div>
                                         <div class="col-md-6">
                                             <button class="btn btn-primary" type="submit" name="search" value="search">Search</button>
                                         </div>
                                    </div>
                                       </form> 
                                       <?php } ?>
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Name</th>
                                                <th>Location</th>
												<th>Phone</th>
												<?php if($this->uri->segment(3) == "scheduled"){ ?>
												<th>Delivery Date</th>
												<?php } ?>
												<th>Status</th>
											<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									  <?php $i = 1 ; 
									  if(!empty($view)){
									  foreach($view as $vw){ ?>
										<tr>
											<td><?php echo $i ; ?></td>
											<td><?php echo $vw->orderno; ?></td>
											<td><?php echo $vw->order_date; ?></td>
                                            <td><?php echo $vw->name; ?></td>
                                            <td><?php echo $vw->location; ?></td>
                                            <td><?php echo $vw->phone; ?></td>
                                            <?php if($this->uri->segment(3) == "scheduled"){ ?>
											<td><?php echo $vw->actual_del_date; ?></td>
											<?php } ?>
                                           <td><?php echo $vw->status; ?></td>
                                            <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('admin/Invoice/view/').$vw->id ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
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





