<?php include("header.php") ; ?>


 <div class="main-panel">

<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Manage Invoice Activities  
	     <a href="<?php echo base_url('admin/Invoice/add') ?>" >
             
			 <button class="btn btn-success pull-right">+ Add New </button> 
             </a>
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
<?php /*
<section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Upload Invoices</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="form-group">
                                        <label >Upload excel file(.xls/.xlsx)</label><br>
                                        <!--<img src="<?php echo base_url($thumbnail->wed_thumb)?>" height="80" width="100">-->
                                        <input type="file" name="image" required class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
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
</section> */ ?>
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
                                    
                                       <form action="" method="post">
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable123">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Name</th>
                                                <th>Location</th>
												<th>Phone</th>
												<th>Status</th>
												<!--<th>Send to RT</th>-->
												<th>Action</th>
												<?php if($this->uri->segment(3) == "new"){ ?>
												<th><input type="checkbox" name="sample" class="selectall"/> Select all</th>
												<?php } ?>
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
                                            <td><?php echo $vw->status; ?></td>
											<?php /*<td> 
											<?php if($vw->sent_to_rt==1){ ?>
										    <span style="color:green;">Success</span>
											<?php }else{ ?>
											<a  href="<?php echo base_url('admin/Invoice/send/').$vw->id ?>" ><button class="btn btn-primary" type="button">Send</button></a>
											<?php } ?>
											</td> */ ?>
                                            <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('admin/Invoice/view/').$vw->id ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
												</a>
                                                 <a class="success p-0" title="Edit" href="<?php echo base_url('admin/Invoice/edit/').$vw->id ?>" >
													<i class="ft-edit-2 font-medium-3 mr-2"></i>
												</a>
													<a class="danger p-0" href="<?php echo base_url('admin/Invoice/delete/').$vw->orderno ?>" onClick="return confirm('are you sure want to delete..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>
												<?php /*	if($vw->sent_to_rt==1){ ?>
												    <a href="<?php echo base_url('admin/Tracking/view/'.$vw->id); ?>"><button class="btn btn-primary" >Tracking</button></a>
												<?php }	*/ ?>
												
                                            </td>
                                            <?php if($this->uri->segment(3) == "new"){ ?>
											<td>
											    <input type="checkbox" name="invoice[]" value="<?php echo $vw->orderno?>">
											</td>
										  <?php } ?>
										 </tr>
									  <?php $i++ ; } }?>   
									</tbody>
                                    </table>
                                    	<?php if($this->uri->segment(3) == "new"){ ?>
                                    <button class="btn btn-primary" type="submit" name="senttort" value="save">SENT TO RT</button>
                                    <?php } ?>
                                    </form>
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

<script>
    $('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('input:checkbox').attr('checked', true);
    } else {
        $('input:checkbox').attr('checked', false);
    }
});
</script>


