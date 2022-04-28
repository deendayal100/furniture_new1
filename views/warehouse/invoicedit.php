<?php include("header.php") ;  date_default_timezone_set("Indian/Mauritius");?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}
</style>
<div class="main-panel">
<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Edit Invoice
		 
			 <a href="<?php echo base_url('warehouse/Invoice') ?>" >
				<button class="btn btn-success pull-right">Back</button> 
			</a>
			<a style="margin-right:10px; float: right;" href="<?php echo base_url('warehouse/Invoice/view') ?>/<?php echo $view->id; ?>" >
				<button class="btn btn-success pull-right">View</button> 
			</a>
			<a style="margin-right:10px; float: right;" href="<?php echo base_url('warehouse/Invoice/add') ?>" >
				<button class="btn btn-success pull-right">Add</button> 
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
                <h5 style="text-align: center;font-size: 25px;"><b>Invoice No : <span style="color:red">#<?php echo $view->orderno; ?>-<?php echo $view->location; ?></span></b></h5>
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                              
                               
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Warehouse</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Delivery Date</label><br>
                                        <input type="date" name="delivery_date" required class="form-control" value="<?php if($view->actual_del_date==''){ echo date('Y-m-d'); }else{ echo $view->actual_del_date; } ?>" >
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Remarks</label><br>
                                        <textarea class="form-control" name="remark"><?php echo $view->remarks?></textarea>
                                    </div>
                                    </div>
                                  
                                    
                                   </div>
                                 
                                  <div class="row">
                                 <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Customer Phone no</label><br>
                                        <input type="number" name="phone" required class="form-control" value="<?php echo $view->phone; ?>" >
                                    </div>
                                    </div>     
                                    
                                   <div class="col-md-6">
                                     <div class="form-group">
                                        <label >Own Delivery</label><br>       
                                        <label class="switch">
                                        <?php if($view->own_delivery==1){ ?>
                                         <input type="checkbox" value="1" name="own_delivery" checked>
                                        <?php }else{ ?>
                                         <input type="checkbox" value="1" name="own_delivery">
                                        <?php } ?>
                                       
                                        <span class="slider round"></span>
                                        </label>
                                        </div>
                                       </div>
                                     
                                    </div>
                                     <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Customer mobile no</label><br>
                                        <input type="number" name="mobile" required class="form-control" value="<?php echo $view->mobile; ?>" >
                                    </div>
                                    </div>
                                   <div class="col-md-6">
                                     <div class="form-group">
                                        <label >Express Delivery</label><br>       
                                        <label class="switch">
                                        <?php if($view->express_delivery==1){ ?>
                                         <input type="checkbox" value="1" name="express_delivery" checked>
                                        <?php }else{ ?>
                                         <input type="checkbox" value="1" name="express_delivery">
                                        <?php } ?>
                                       
                                        <span class="slider round"></span>
                                        </label>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Extra mobile no</label><br>
                                        <input type="number" name="extra_mobile_no"  class="form-control" value="<?php echo $view->extra_mobile_no; ?>" >
                                    </div>
                                    </div> 
                                 
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
</section> 
 <section style="background: #4083f4;padding: 15px;border-radius: 5px;">
                <div class="row">
                    <div class="col-12">
                          <div class="form-group col-md-12">
                              <h4 style="color:#FFF">Change Status</h4>
                          </div>    
                          <form class="row" action="" method="post">
                            <div class="form-group col-md-8" style="float:left;">
                             <input type="hidden" name="orderno" required class="form-control" value="<?php echo $view->orderno?>" readonly>   
                           <select class="form-control driverStatus" name="status" id="status" required onchange="chkval(this.value)">
                                            <option value="">--Select-- </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="RECEIVED BY RT" <?php if($view->status=='RECEIVED BY RT'){ echo "selected"; } ?> disabled>RECEIVED BY RT </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="DEL TODAY" <?php if($view->status=='DEL TODAY'){ echo "selected"; }?> >DEL TODAY </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="DEL TOMORROW" <?php if($view->status=='DEL TOMORROW'){ echo "selected"; }?>>DEL TOMORROW </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="DEL SCHEDULED" <?php if($view->status=='DEL SCHEDULED'){ echo "selected"; }?>>DEL SCHEDULED </option>
        <?php if($view->own_delivery==0){?> <option id="id<?php echo $view->id++ ?>" class="driverClass" value="WITH DRIVER" <?php if($view->status=='WITH DRIVER'){ echo "selected"; }?>>WITH DRIVER </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="FROM DRIVER" <?php if($view->status=='FROM DRIVER'){ echo "selected"; }?>>FROM DRIVER </option><?php } ?>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="DELIVERED" <?php if($view->status=='DELIVERED'){ echo "selected"; }?>>DELIVERED  </option>
                                            <option id="id<?php echo $view->id++ ?>" class="driverClass" value="SENT TO PL" <?php if($view->status=='SENT TO PL'){ echo "selected"; }?>>SENT TO PL  </option>
                                        </select>
                            </div>
                            
                            <div class="form-group col-md-2">
                                
                               	<button type="submit" name="statussubmit" value="save" class="btn btn-raised btn-primary btnDriverStatus" onclick="return valid();">
									<i class="fa fa-check-square-o"></i> Save
								</button>
                            </div>
                             <div class="form-group col-md-8" style="float:left;display:none;" id="deldate">
                               
                                        <label style="color:#FFF">Delivery Date</label><br>
                                        <input type="date" name="delivery_date" id="dele_date" class="form-control" value="<?php if($view->actual_del_date==''){ /*echo date('Y-m-d'); */ }else{ echo $view->actual_del_date; } ?>" >
                                    
                           
                            </div>
                             <div class="form-group col-md-8" style="float:left;<?php if($view->driver_id>0){ echo 'display:block;';  }else { echo 'display:none;'; }?>" id="driverlist">
                                 	<?php
												if($view->own_delivery==0){
												//$assign = $this->db->get_where(TBL_ASSIGN,array('order_no'=>$view->orderno,'cancel_status'=>1))->row();
												$assign = $this->db->query("select * from assign where order_no='".$view->orderno."' AND cancel_status='1' ORDER BY `id` DESC ")->result();
												//echo '<pre>';
												//print_r($assign);
												//if($view->status!='WITH DRIVER'){ ?>
												<label style="color:#FFF">Drivers</label><br>
													 <select class="form-control" name="driver_id" id="driver_id">
														<option value="">--Select driver--</option>
														<?php 
														if(!empty($drivers)){
														  foreach($drivers as $drv){
														?>
														 <option value="<?php echo $drv->id?>"><?php echo $drv->name?></option>
														<?php }} ?>
													</select><br>
												   
													 <label style="color:#FFF">Delivery Note No</label><br>
													 <input type="number" class="form-control" name="delivery_note_no" id="delivery_note_no" pattern="\d*" maxlength="6">
												<!--<div class="mox" style="display:none;">
												     <label style="color:#FFF">Drivers</label><br>
													 <select class="form-control" name="driver_id" id="driver_id">
														<option value="">--Select driver--</option>
														<?php 
														if(!empty($drivers)){
														  foreach($drivers as $drv){
														?>
														 <option value="<?php echo $drv->id?>"><?php echo $drv->name?></option>
														<?php }} ?>
													</select><br>
												   
													 <label style="color:#FFF">Delivery Note No</label><br>
													 <input type="number" class="form-control" name="delivery_note_no" id="delivery_note_no" pattern="\d*" maxlength="6" required>
												</div> -->
												<?php //}
												if($assign){
												foreach($assign as $key=>$val){
												?>
												<?php if($key>0){ ?>
												<button type="button" class="btn btn-primary" style="background-color:gray;border-color:gray;" onclick="driverinfo('<?php echo $val->driver_id?>','<?php echo $val->id; ?>','<?php echo $key; ?>')">Not delivered</button>
												
												<?php }else{ ?>
													<button type="button" class="btn btn-primary" style="background-color:gray;border-color:gray;" onclick="driverinfo('<?php echo $val->driver_id?>','<?php echo $val->id; ?>','<?php echo $key; ?>')">Assigned</button>
													<br>
												<label style="color:#FFF">Delivery Note No</label><br>
                                                <h4><b><?php echo $view->delivery_note_no?></b></h4>
												<?php }
												
												}
												}?>
													
												<?php 
												} ?>
                                     
                                    
                           
                            </div>
                         </form>   
                    </div>
               </div>
            </section>   
            <script>
               
                function chkval(a){
                    if(a=='DEL SCHEDULED'){
                        $('#deldate').show();
                    }else{
                        $('#deldate').hide();
                    }
                    if(a=='WITH DRIVER'){
                        $('#driverlist').show();
						$('.mox').show();
                        //$('#del_note_no').show();
                    }else{
                        $('#driverlist').hide();
                        //$('#del_note_no').hide();
                    }
                    
                    
                    
                }
               

                function valid(){
                   var st = $("#status option:selected").val();
                   if(st=='DEL SCHEDULED'){
                       var dele_date = $("#dele_date").val();
                       if(dele_date==''){
                           return false;
                       }
                   }
                   if(st=='WITH DRIVER'){
                       var driver_id = $("#driver_id option:selected").val();
                       var delivery_note_no = $("#delivery_note_no").val();
                       if(driver_id==''){
                           alert('Please select driver');
                           return false;
                       }
                       if(delivery_note_no==''){
                           alert('Please Enter Delivery Note No.');
                           return false;
                       }
                       if(delivery_note_no.length>6){
                           alert('Please Enter Maximum six digit no.');
                           return false;
                       }
                   }
                }
                 function driverinfo(id,assign,key){
        var url = "<?php echo base_url()?>warehouse/Invoice/getdriverinfo"; 
       
        $.ajax({
                url: url,
                type: "post",
                data: {'driver_id':id },
                success: function(d) {
                    $('#drvdetail').html(d);
					var urlbu = "<?php echo base_url('warehouse/Invoice/cancel/edit/')?>"+assign+'/<?php echo $view->id; ?>'; 
					$('#shpw').attr('src',urlbu);
					if(key=='0'){
						$('#shpw').show();
						$('.modal-title').html('Assigned driver');
						
					}else{
						$('#shpw').hide();
						$('.modal-title').html('Not delivery by driver');
					}
                    $('#driver').modal('show');
                }
            });     
       
    }
            </script>
             <section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Add Comment</h4>
                                <div class="col-md-12"  style="float:left">
                                  
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Comment</label><br>
                                        <?php
                                        $comm = $this->db->get_where(TBL_COMMENT,['orderno'=>$view->orderno])->row();
                                        if(!empty($comm)){
                                            $com = $comm->comment;
                                        }else{
                                            $com = ""; 
                                        }
                                        ?>
                                        <textarea name="comment" required class="form-control"><?php echo $com ?></textarea>
                                    </div>
                                    </div>
                                    
                                   </div>
                                 
                                </div>
                              <div class="form-actions center">
								<button type="submit" name="commentsubmit" value="save" class="btn btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
                                </div>
                                
                            </div>
                            
						</form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section> 
<section id="extended">
    <div class="row" style="margin: 0px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                              
                               
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Call</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Call Date</label><br>
                                        <input type="date" name="call_date" required class="form-control" value="<?php echo date('Y-m-d');  ?>" >
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                        <label >Call time</label><br>
                                       <input type="text" name="call_time" required class="form-control" value="<?php echo date('H:i');  ?>" >
                                    </div>
                                     
                                    </div>
                                    
                                   </div>
                                  <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Remarks</label><br>
                                        <textarea class="form-control" name="remark"></textarea>
                                    </div>
                                    </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Call file/Recording</label><br>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    </div>
                                   </div>
                                 
                                 
                                </div>
                            </div>
                            <div class="form-actions center">
								<button type="submit" name="callsubmit" value="save" class="btn btn-raised btn-primary">
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
<section id="extended">
    <div class="row" style="margin: 0px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                              
                               
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> SMS</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >SMS Date</label><br>
                                        <input type="date" name="sms_date" required class="form-control" value="<?php echo date('Y-m-d');  ?>" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                        <label >SMS time</label><br>
                                       <input type="text" name="sms_time" required class="form-control" value="<?php echo date('H:i');  ?>" readonly>
                                    </div>
                                     
                                    </div>
                                    
                                   </div>
                                  <div class="row">
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Remarks</label><br>
                                        <select  class="form-control" name="remark" id="msglist">
                                          <option value="">--Select--</option>      
                                          <option value="Your order will be scheduled for delivery soon. ">1)Your order will be scheduled for delivery soon . </option>  
                                          <option value="our delivery is scheduled for tomorrow, we are unable to give a specific time as deliveries are grouped.">2)our delivery is scheduled for tomorrow, we are unable to give a specific time as deliveries are grouped.</option>  
                                          <option value="Your delivery is scheduled for today.">3)Your delivery is scheduled for today.</option>  
                                          <option value="Your item has been successfully loaded on the truck. The delivery contractor shall call you prior to reaching your premises.">4)Your item has been successfully loaded on the truck. The delivery contractor shall call you prior to reaching your premises.</option>  
                                          <option value="We are on the way to your premises, please stay by your phone with network.">5)We are on the way to your premises, please stay by your phone with network.</option>  
                                          <option value="We are unable to reach you over the phone, we are in front of your house, please call us back within the next 15 minutes.">6)We are unable to reach you over the phone, we are in front of your house, please call us back within the next 15 minutes.</option>  
                                          <option value="Your delivery will be rescheduled as we have been unable to reach you">7)Your delivery will be rescheduled as we have been unable to reach you.</option>  
                                          <option value="We are unable to reach you over the phone, please call the us on 5865 3893">8)We are unable to reach you over the phone, please call us on 5865 3893</option>
                                          <option value="We are unable to reach you over the phone, please call the us on 5893 8226">9)We are unable to reach you over the phone, please call us on 5893 8226</option>
                                        </select>
                                      
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Text message</label><br>
                                       <textarea class="form-control" name="text_msg" id="text_msg"></textarea>
                                      
                                    </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Mobile number</label><br>
                                        <select  class="form-control" name="mobileno" id="mobileno">
                                          <option value="">--Select number--</option>      
                                          <option value="<?php echo $view->mobile?>"><?php echo $view->mobile?></option>  
                                           <option value="<?php echo $view->phone?>"><?php echo $view->phone?></option> 
                                          <option value="<?php echo $view->extra_mobile_no?>"><?php echo $view->extra_mobile_no?></option>  
                                         
                                        </select>
                                      
                                    </div>
                                    </div>
                                   </div>
                                </div>
                            </div>
                            <div class="form-actions center">
								<button type="submit" name="smssubmit" value="save" class="btn btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Send
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
        	<a id="shpw" href="<?php //echo base_url('warehouse/Invoice/cancel/edit/'.$assign->id.'/'.$view->id)?>"><button type="button" class="btn btn-primary"  >Cancel</button></a>   
          <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
