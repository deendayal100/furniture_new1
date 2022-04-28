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
<!-- change by vinod -->
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
                                    
                                      <form action="" method="post" style="width: 100%;margin-bottom: 15px;">
                                    <div class="row">
                                         <div class="col-md-6">
                                         <select class="form-control" name="status" required>
                                            <option value="">--Select-- </option>
                                            <option value="ALL" <?php if(isset($postval) && $postval=='ALL'){ echo "selected"; }?>>ALL </option>
                                            <option value="OFFICE" <?php if(isset($postval) && $postval=='OFFICE'){ echo "selected"; }?>>OFFICE </option>
                                            <option value="DEL OFFICE" <?php if(isset($postval) && $postval=='DEL OFFICE'){ echo "selected"; }?>>DEL OFFICE </option>
                                            <option value="SENT TO RT" <?php if(isset($postval) && $postval=='SENT TO RT'){ echo "selected"; }?>>SENT TO RT </option>
                                            <option value="RECEIVED BY PL" <?php if(isset($postval) && $postval=='RECEIVED BY PL'){ echo "selected"; }?>>RECEIVED BY PL </option>
                                            <option value="RECEIVED BY AL" <?php if(isset($postval) && $postval=='RECEIVED BY AL'){ echo "selected"; }?>>RECEIVED BY AL </option>
                                            <option value="POSTED" <?php if(isset($postval) && $postval=='POSTED'){ echo "selected"; }?>>POSTED </option>
                                            <option value="VOID" <?php if(isset($postval) && $postval=='VOID'){ echo "selected"; }?>>VOID </option>
                                            <option value="RETURN TO PL" <?php if(isset($postval) && $postval=='RETURN TO PL'){ echo "selected"; }?>>RETURN TO PL  </option>
                                            <option value="CHANGE OF ITEMS" <?php if(isset($postval) && $postval=='CHANGE OF ITEMS'){ echo "selected"; }?>>CHANGE OF ITEMS  </option>
                                        </select>
                                         </div>
                                         <div class="col-md-6">
											
                                             <button class="btn btn-primary" type="submit" name="search" value="search">Search</button>
                                         </div>
                                    </div>
                                       </form>
									   <?php if(isset($postval) && $postval=='SENT TO RT'){ ?>
									    <div class="row">
										<form name="owndel" action="" method="post">
											<div class="col-md-6">
												<input type="hidden" name="ids" id="ids" value="">
												<button class="btn btn-primary" id="own" type="submit" name="own" value="own">OWN Delivery</button>
											</div>
										</form>
										</div>
									   <?php } ?>
                                       <form action="" method="post">
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                                        <thead>
                                            <tr>
												<?php if(isset($postval) && $postval=='SENT TO RT'){ ?>
												<th>
													<input type="checkbox" id="selectAll" /> All
												</th>
												<?php } ?>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Name</th>
                                                <th>Location</th>
												<th>Phone</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									  <?php $i = 1 ; 
									  if(!empty($view)){
									  foreach($view as $vw){ ?>
										<tr>
											<?php if(isset($postval) && $postval=='SENT TO RT'){ ?>
											<td>
												<input type="checkbox" name="rt[]" id="<?php echo $vw->id; ?>" value="<?php echo $vw->id; ?>" />
											</td>
											<?php } ?>
											<td><?php echo $i ; ?></td>
											<td><?php echo $vw->orderno; ?></td>
											<td><?php echo $vw->order_date; ?></td>
                                            <td><?php echo $vw->name; ?></td>
                                            <td><?php echo $vw->location; ?></td>
                                            <td><?php echo $vw->phone; ?></td>
                                            <td><?php  echo $vw->status; if($vw->delivery_note_no=='From Customer'){echo ' (Aftersale)';} ?></td>
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
                                            </td>
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
<!-- pasted bellow code by vinod -->
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
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable1">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Name</th>
												<th>Phone</th>
												<th>Status</th>
												<!--<th>Send to RT</th>-->
												<th>Action</th>
											
                                            </tr>
                                        </thead>
                                        <tbody>
									  <?php $i = 1 ; 
									  if(!empty($returninvoice)){
									  foreach($returninvoice as $rinv){ ?>
										<tr>
											<td><?php echo $i ; ?></td>
											<td><?php echo $rinv->orderno; ?></td>
											<td><?php echo $rinv->order_date; ?></td>
                                            <td><?php echo $rinv->name; ?></td>
                                            <td><?php echo $rinv->phone; ?></td>
                                            <td><?php echo $rinv->status; ?></td>
											<?php /*<td> 
											<?php if($vw->sent_to_rt==1){ ?>
										    <span style="color:green;">Success</span>
											<?php }else{ ?>
											<a  href="<?php echo base_url('admin/Invoice/send/').$vw->id ?>" ><button class="btn btn-primary" type="button">Send</button></a>
											<?php } ?>
											</td> */ ?>
                                            <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('admin/Invoice/view/').$rinv->id ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
												</a>
                                                 <a class="success p-0" title="Edit" href="<?php echo base_url('admin/Invoice/edit/').$rinv->id ?>" >
													<i class="ft-edit-2 font-medium-3 mr-2"></i>
												</a>
													<a class="danger p-0" href="<?php echo base_url('admin/Invoice/delete/').$rinv->orderno ?>" onClick="return confirm('are you sure want to delete..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>
												<?php /*	if($vw->sent_to_rt==1){ ?>
												    <a href="<?php echo base_url('admin/Tracking/view/'.$vw->id); ?>"><button class="btn btn-primary" >Tracking</button></a>
												<?php }	*/ ?>
												
                                            </td>
                                           
										
										 </tr>
									  <?php $i++ ; } }?>   
									</tbody>
                                    </table>
                                    
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
<?php if(isset($postval) && $postval=='SENT TO RT'){ ?>
<script>
jQuery('#selectAll').click(function (e) {
    jQuery(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
jQuery('#own').click(function (e) {
	var list = jQuery("input[name='rt[]']:checked").map(function () {
		return this.value;
	}).get();
	if(list==''){
		alert('Please choose invoices');
		return false
	}else{
		jQuery('#ids').val(list);
	}
	
});]
</script>
<?php } ?> 



