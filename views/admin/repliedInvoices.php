<?php include("header.php") ; ?>
 <div class="main-panel">

<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Manage Customer Activities </div>
        <p class="content-sub-header">All Customer data and Activities.</p>
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

                                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										
										if(!empty($view)){                                 
										$i = 1 ; 
										foreach($view as $vw){
											$odnub = $vw->order_number;
											$stst = $this->db->query("select status from invoice where orderno='$odnub'")->result();
											//echo '<pre>';print_r($stst);echo '</pre>';
                                        ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $vw->order_number; ?></td>
											<td><?php if($stst && $stst[0]){echo $stst[0]->status;} ?></td>
                                            <td>
												<a class="secondary p-0" title="Invoice" href="<?php echo base_url('admin/Custmers/repliedInvoiceView/').$vw->order_number;?>" >
                                                    <i class="fa fa-eye font-medium-3 mr-2"></i>
                                                </a>
                                            </td>
										 </tr>
										<?php $i++ ; }}?>   
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