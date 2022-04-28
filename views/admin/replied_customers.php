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
												<th>Complaint date.</th>
												<th>Purchase date.</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Address</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									  <?php $i = 1 ; 
									  if(!empty($view)){

                                        $repliedcheck = array();
                                        if(!empty($newcust)){
                                            foreach($newcust as $ncu){
                                                array_push($repliedcheck,$ncu->order_number);
                                            }
                                        }
                                     

									  foreach($view as $vw){ 
                                        if(!in_array($vw->order_number,$repliedcheck)){

                                        }else{
                                        ?>
										<tr>
											<td><?php echo $i ; ?></td>
											<td><?php echo $vw->order_number; ?></td>
											<td><?php echo $vw->created_at; ?></td>
											<td><?php echo $vw->purchase_date; ?></td>
                                            <td><?php echo $vw->name; ?></td>
                                            <td><?php echo $vw->email; ?></td>
                                            <td><?php echo $vw->phone; ?></td>
											<td><?php echo $vw->address; ?></td>
                                            <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('admin/Custmers/view/').$vw->order_number ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
												</a>
                                                <?php if(!empty($vw->invoice_id)){?>
                                                 <!-- <a class="secondary p-0" title="Invoice" href="<?php echo base_url('admin/Invoice/view/').$vw->invoice_id .'/?back=customer&orderno='.$vw->order_number ;?>" >
                                                    <i class="fa fa-info font-medium-3 mr-2"></i>
                                                </a> -->
                                                 <!-- Change by vinod commented upper link and add new link  -->
                                                <a class="secondary p-0" title="Invoice" href="<?php echo base_url('admin/Invoice/view/').$vw->invoice_id;?>" >
                                                    <i class="fa fa-info font-medium-3 mr-2"></i>
                                                </a>
                                            <?php }           ?>
                                              
												<!-----<a class="danger p-0" href="<?php echo base_url('admin/Custmers/delete/').$vw->id ?>" onClick="return confirm('are you sure want to delete..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>---->
                                            </td>
										 </tr>
									  <?php } $i++ ; } }?>   
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