<?php include("header.php") ; ?>


 <div class="main-panel">

<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Manage <?php if($this->uri->segment(3)=="failed"){ echo 'Failed'; } ?> Invoice Activities
			<?php if($this->uri->segment(3)=="failed"){ }else{ ?>
			<a href="<?php echo base_url('warehouse/Invoice/add') ?>" >
				<button class="btn btn-success pull-right">+ Add New </button> 
			</a>
			<?php } ?> 
	    </div>
        <p class="content-sub-header">All Invoice data and Activities.</p>
         <?php if($this->session->flashdata("message")){ ?>
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   <?php echo  $this->session->flashdata("message") ; ?>
        </div>
       <?php } ?> 
    </div>
</div><?php //echo $page ?>

<section id="extended">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All</h4>
                    
                </div>
                <div class="card-body">
                    
                <div class="card-body collapse show">
                                <div class="card-block card-dashboard">
                                    <?php if($this->uri->segment(3)=="new" || $this->uri->segment(3)=="failed" || $this->uri->segment(3)=="delbydriver"){ }else{ ?>
                                   <form action="" method="post" style="width: 100%;margin-bottom: 15px;">
                                    <div class="row">
                                         <div class="col-md-6">
                                          <select class="form-control" name="status" required>
                                            <option value="">--Select-- </option>
                                            <option value="RECEIVED BY RT" <?php if(isset($postval) && $postval=='RECEIVED BY RT'){ echo "selected"; }?>>RECEIVED BY RT </option>
                                            <option value="DEL TODAY" <?php if(isset($postval) && $postval=='DEL TODAY'){ echo "selected"; }?>>DEL TODAY </option>
                                            <option value="DEL TOMORROW" <?php if(isset($postval) && $postval=='DEL TOMORROW'){ echo "selected"; }?>>DEL TOMORROW </option>
                                            <option value="DEL SCHEDULED" <?php if(isset($postval) && $postval=='DEL SCHEDULED'){ echo "selected"; }?>>DEL SCHEDULED </option>
                                            <option value="WITH DRIVER" <?php if(isset($postval) && $postval=='WITH DRIVER'){ echo "selected"; }?>>WITH DRIVER </option>
                                            <option value="FROM DRIVER" <?php if(isset($postval) && $postval=='FROM DRIVER'){ echo "selected"; }?>>FROM DRIVER </option>
                                            <option value="DELIVERED" <?php if(isset($postval) && $postval=='DELIVERED'){ echo "selected"; }?>>DELIVERED  </option>
											<option value="Not delivered" <?php if(isset($postval) && $postval=='Not delivered'){ echo "selected"; }?>>NOT DELIVERED/FAILED</option>
                                            <option value="SENT TO PL" <?php if(isset($postval) && $postval=='SENT TO PL'){ echo "selected"; }?>>SENT TO PL  </option>
                                        </select>
                                         </div>
                                         <div class="col-md-6">
                                             <button class="btn btn-primary" type="submit" name="search" value="search">Search</button>
                                         </div>
                                    </div>
                                       </form>
                                       <?php } ?>
                                    <form action="" method="post">   
                                    <table class="table table-striped table-bordered zero-configuration" id="<?php if($this->uri->segment(3)=="new"){ echo "mytable123"; }else{ echo "mytable"; }?>">
                                        <thead>
										
                                            <tr>
												<th>#</th>
												<th>Order No.</th>
												<th>Order date.</th>
												<th>Name</th>
												<th>Phone</th>
												<th>Status</th>
												<?php if($this->uri->segment(3)=="failed" || (isset($postval) && $postval=='Not delivered') || $this->uri->segment(3)=="delbydriver"){ ?>
												<th>Driver Status</th>
												<?php } ?>
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
											<td><a href="<?php echo base_url('warehouse/Tracking/view/'.$vw->id); ?>"><?php echo $vw->orderno; ?></a></td>
											<td><?php echo $vw->order_date; ?></td>
                                            <td><?php echo $vw->name; ?></td>
                                            <td><?php echo $vw->phone; ?></td>
                                            <td><?php echo $vw->status; if($vw->delivery_note_no=='From Customer'){echo ' (Aftersale)';} ?>
                                       		</td>
                                            
                                           <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('warehouse/Invoice/view/').$vw->id ?>" >
													<i class="fa fa-eye font-medium-3 mr-2"></i>
												</a>
                                                 <a style="display:none"> class="success p-0" title="Edit" href="<?php echo base_url('warehouse/Invoice/edit/').$vw->id ?>" >
													<i class="ft-edit-2 font-medium-3 mr-2"></i>
												</a>
													<a style="display:none" class="danger p-0" href="<?php echo base_url('warehouse/Invoice/delete/').$vw->orderno ?>" onClick="return confirm('are you sure want to delete..?')">
													<i class="ft-x font-medium-3 mr-2"></i>
												</a>
                                            </td>

											
										
                                         
                                            <?php if($this->uri->segment(3) == "new"){ ?>
												<td>
											    <?php if($vw->status=="SENT TO RT"){ ?>
											    <input type="checkbox" name="invoice[]" value="<?php echo $vw->orderno?>">
											    <?php } ?>
											</td>
											<?php } ?>
										  
										 </tr>
									  <?php $i++ ; } }?>   
									</tbody>
                                    </table>
                                    	<?php if($this->uri->segment(3) == "new"){ ?>
                                    <button class="btn btn-primary" type="submit" name="receivedbyrt" value="save">RECEIVED BY RT</button>
                                    <?php } ?>
                                    </form>
                                </div>
                            </div>                
   
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($this->uri->segment(3)=="new" || $this->uri->segment(3)=="failed" || $this->uri->segment(3)=="delbydriver"){ }else{ ?>
<section id="extended">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Express Delivery</h4>
                    
                </div>
                <div class="card-body">
                    
                <div class="card-body collapse show">
                                <div class="card-block card-dashboard">
                                   <!--<form action="" method="post" style="width: 100%;margin-bottom: 15px;">-->
                                   <!-- <div class="row">-->
                                   <!--      <div class="col-md-6">-->
                                   <!--      <select class="form-control" name="status" required>-->
                                   <!--         <option value="">--Select-- </option>-->
                                   <!--         <option value="RECEIVED BY RT" <?php if(isset($postval) && $postval=='RECEIVED BY RT'){ echo "selected"; }?>>RECEIVED BY RT </option>-->
                                   <!--         <option value="DEL TODAY" <?php if(isset($postval) && $postval=='DEL TODAY'){ echo "selected"; }?>>DEL TODAY </option>-->
                                   <!--         <option value="DEL TOMORROW" <?php if(isset($postval) && $postval=='DEL TOMORROW'){ echo "selected"; }?>>DEL TOMORROW </option>-->
                                   <!--         <option value="DEL SCHEDULED" <?php if(isset($postval) && $postval=='DEL SCHEDULED'){ echo "selected"; }?>>DEL SCHEDULED </option>-->
                                   <!--         <option value="WITH DRIVER" <?php if(isset($postval) && $postval=='WITH DRIVER'){ echo "selected"; }?>>WITH DRIVER </option>-->
                                   <!--         <option value="FROM DRIVER" <?php if(isset($postval) && $postval=='FROM DRIVER'){ echo "selected"; }?>>FROM DRIVER </option>-->
                                   <!--         <option value="DELIVERED" <?php if(isset($postval) && $postval=='DELIVERED'){ echo "selected"; }?>>DELIVERED  </option>-->
                                   <!--         <option value="SENT TO PL" <?php if(isset($postval) && $postval=='SENT TO PL'){ echo "selected"; }?>>SENT TO PL  </option>-->
                                   <!--     </select>-->
                                   <!--      </div>-->
                                   <!--      <div class="col-md-6">-->
                                   <!--          <button class="btn btn-primary" type="submit" name="search" value="search">Search</button>-->
                                   <!--      </div>-->
                                   <!-- </div>-->
                                   <!--    </form>-->
                                    <table class="table table-striped table-bordered zero-configuration" id="mytable111">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order No.</th>
                                                <th>Order date.</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                      <?php $i = 1 ; 
                                      if(!empty($expressdel)){
                                      foreach($expressdel as $exp){ ?>
                                        <tr>
                                            <td><?php echo $i ; ?></td>
                                            <td><a href="<?php echo base_url('warehouse/Tracking/view/'.$exp->id); ?>"><?php echo $exp->orderno; ?></a></td>
                                            <td><?php echo $exp->order_date; ?></td>
                                            <td><?php echo $exp->expected_del_date; ?></td>
                                            <td><?php if($exp->own_delivery==1){ echo "Own delivery"; }elseif($exp->express_delivery==1){ echo "Express delivery"; }else{ echo "Delivery to home"; } ?></td>
                                            <td><?php /*if($vw->status==1){ echo "On order"; }
                                                      elseif($vw->status==2){ echo "On delivery"; }
                                                      elseif($vw->status==3){ echo "Payment Pending"; }
                                                      elseif($vw->status==4){ echo "Not ready to Del"; }
                                                      elseif($vw->status==5){ echo "Void"; }
                                                      elseif($vw->status==6){ echo "Back to Office"; }
                                                      elseif($vw->status==7){ echo "Change of Item"; }*/
                                                      echo $exp->status;
                                                      
                                                      ?></td>
                                        
                                            <td>
                                                <a class="success p-0" title="View" href="<?php echo base_url('warehouse/Invoice/view/').$exp->id ?>" >
                                                    <i class="fa fa-eye font-medium-3 mr-2"></i>
                                                </a>
                                                 <a class="success p-0" title="Edit" href="<?php echo base_url('warehouse/Invoice/edit/').$exp->id ?>" >
                                                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                                                </a>
                                                <!--    <a class="danger p-0" href="<?php echo base_url('warehouse/Invoice/delete/').$exp->orderno ?>" onClick="return confirm('are you sure want to delete..?')">-->
                                                <!--    <i class="ft-x font-medium-3 mr-2"></i>-->
                                                <!--</a>-->
                                                <?php /*
                                                if($exp->own_delivery==0){
                                                $assigndr = $this->db->get_where(TBL_ASSIGN,array('order_no'=>$exp->orderno))->row();
                                                if($assigndr){
                                                ?>
                                                <button class="btn btn-primary" style="background-color:gray;border-color:gray;" onclick="driverinfo('<?php echo $assigndr->driver_id?>')">Assigned</button>
                                                <?php }else{ ?>
                                                  <button class="btn btn-primary" onclick="assign('<?php echo $exp->orderno?>')">Assign</button>
                                                <?php }} */ ?>
                                                
                                                    <?php /*    if($vw->sent_to_rt==1){ ?>
                                                    <a href="<?php echo base_url('warehouse/Tracking/view/'.$vw->id); ?>"><button class="btn btn-primary" >Tracking</button></a>
                                                <?php } */ ?>
                                                
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
<?php } ?>

  </div>
</div>
 
<?php include("footer.php") ; ?> 
<script>
    function assign(id){
        $("#orderno").val(id);   
        $('#assign').modal('show');
    }
     function driverinfo(id){
        var url = "<?php echo base_url()?>warehouse/Invoice/getdriverinfo"; 
       
        $.ajax({
                url: url,
                type: "post",
                data: {'driver_id':id },
                success: function(d) {
                   
                    $('#drvdetail').html(d);
                    $('#driver').modal('show');
                }
            });     
       
    }
</script>
<div class="modal" id="assign">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Assign driver  </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="modal_inside">
              <div>
                  <div class="form-group">
                                
                                <div class="row">
                                    <form action="" method="post">
                                    <div class="col-md-12 col-sm-12" style="margin-top: 25px;">
                                         <div class="form-group">
                                        <label> Drivers </label>
                                        <input type="hidden" name="orderno" id="orderno">
                                        <select class="form-control" name="driver_id" >
                                            <option value="">--Select driver--</option>
                                            <?php 
                                            if(!empty($drivers)){
                                              foreach($drivers as $drv){
                                            ?>
                                             <option value="<?php echo $drv->id?>"><?php echo $drv->name?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                       
                                    </div>
                                   
                                </div>
                                
                            </div>  
                  
              </div>   
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" style="text-align: center">
          <button type="submit" class="btn btn-danger" name="assign" value="save">Assign</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="modal" id="driver">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Assigned driver  </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="modal_inside">
              <div>
                  <div class="form-group" id="drvdetail">
                                
                               
                                
                            </div>  
                  
              </div>   
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" style="text-align: center">
          <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<script>
    $('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('input:checkbox').attr('checked', true);
    } else {
        $('input:checkbox').attr('checked', false);
    }
});
</script>


