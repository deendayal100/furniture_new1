<?php include("header.php") ; ?>


 <div class="main-panel">

<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Manage Not Delivered/Failed Invoice
	    </div>
        <p class="content-sub-header">All Failed Invoice data and Activities.</p>
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
                                    
                                       <form action="" method="post">
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Namesdf</th>
												<th>Phone</th>
												<th>Driver Status</th>
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
                                            <td><?php echo $vw->phone; ?></td>
                                            <td><?php echo $vw->status; ?></td>
                                            <td>
                                                <a class="success p-0" title="Restore Invoice" href="<?php echo base_url('admin/Deleted_invoice/restore/').$vw->orderno ?>" >
													<i class="fa fa-window-restore font-medium-3 mr-2"></i>
												</a>
												<a class="success p-0" title="View Invoice" href="<?php echo base_url('admin/Deleted_invoice/view/').$vw->id ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
												</a>
												<a class="danger p-0" title="Delete permanently" href="<?php echo base_url('admin/Deleted_invoice/delete/').$vw->orderno ?>" onClick="return confirm('are you sure want to delete permanently..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>
												
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




