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
			
			<a href="<?php echo base_url('admin/Invoice') ?>" >
				<button class="btn btn-success pull-right">Back</button> 
			</a>
			<a style="margin-right:10px; float: right;" href="<?php echo base_url('admin/Invoice/view') ?>/<?php echo $view->id; ?>" >
				<button class="btn btn-success pull-right">View</button> 
			</a>
			<a style="margin-right:10px; float: right;" href="<?php echo base_url('admin/Invoice/add') ?>" >
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
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Update Invoice</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                    <div class="col-md-3">
                                         <div class="form-group">
                                        <label >Order No</label><br>
                                       <input type="text" name="orderno" required class="form-control" value="<?php echo $view->orderno?>" readonly>
                                    </div>
                                     
                                    </div>
                                     <div class="col-md-3">
                                        <div class="form-group">
                                        <label >Order Date</label><br>
                                        <input type="text" name="order_date" required class="form-control" value="<?php echo $view->order_date ?>" >
                                    </div>
                                    </div>
                                      <div class="col-md-3">
                                         <div class="form-group">
                                        <label >Quanity sold</label><br>
                                        <input type="number" name="txt_Quantity" required class="form-control" value="<?php echo $view->txt_Quantity ?>" >
                                    </div>
                                    </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                        <label >Quanity to deliver </label><br>
                                        <input type="text" name="txt_Qty_Delivered" required class="form-control" value="<?php echo $view->txt_Qty_Delivered ?>" >
                                    </div>
                                    </div>
                                   </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                         <div class="form-group">
                                        <label >Paid amount</label><br>
                                        <input type="text" name="amount_paid" required class="form-control" value="<?php echo $view->amount_paid?>" >
                                    </div>
                                     
                                    </div>
                                     <div class="col-md-3">
                                        
                                     <div class="form-group">
                                        <label >Due amount</label><br>
                                        <input type="text" name="due_amount" required class="form-control" value="<?php echo $view->due_amount ?>" >
                                    </div>
                                    </div>
                                     <div class="col-md-3">
                                          <div class="form-group">
                                        <label >RT / PL </label><br>
                                        <input type="text" name="Combo68" required class="form-control" value="<?php echo $view->Combo68 ?>" >
                                    </div>
                                    </div>
                                      <div class="col-md-3">
                                           <div class="form-group">
                                        <label >Expected delivery date </label><br>
                                        <input type="date" name="expected_del_date"  class="form-control" value="<?php echo $view->expected_del_date ?>" >
                                    </div>
                                    </div>
                                     
                                    
                                   </div>
                                  <div class="row">
                                     <div class="col-md-3">
                                          <div class="form-group">
                                        <label >Customer name </label><br>
                                        <input type="text" name="name" required class="form-control" value="<?php echo $view->name ?>" >
                                    </div>
                                    </div>  
                                    <!--<div class="col-md-3">-->
                                    <!--     <div class="form-group">-->
                                    <!--    <label >Customer Mobile </label><br>-->
                                    <!--    <input type="text" name="mobile" required class="form-control" value="<?php echo $view->mobile ?>" >-->
                                    <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3">-->
                                    <!--     <div class="form-group">-->
                                    <!--    <label >Customer Phone </label><br>-->
                                    <!--    <input type="text" name="phone"  class="form-control" value="<?php echo $view->phone ?>" >-->
                                    <!--</div>-->
                                    <!--</div>-->
                                     <div class="col-md-3">
                                          <div class="form-group">
                                        <label >Customer Address </label><br>
                                        <input type="text" name="txtAddress" required class="form-control" value="<?php echo $view->txtAddress ?>" >
                                    </div>
                                    </div>
                                      
                                    
                                   </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Detail</label><br>
                                        <textarea name="Description" required class="form-control"><?php echo $view->Description ?></textarea>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                        <label >Order note</label><br>
                                        <textarea name="order_note" required class="form-control"><?php echo $view->order_note ?></textarea>
                                    </div>
                                    </div>
                                   </div>
                                 
                                </div>
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> Office</h4>
                                <div class="col-md-12"  style="float:left">
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label >cim approved</label><br>
                                        <div class="card-content">
                                          <div class="card-body">
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio1" name="cim_approved" value="YES" class="custom-control-input" <?php if($view->cim_approved=='YES'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio1">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio2" name="cim_approved" value="NO" class="custom-control-input" <?php if($view->cim_approved=='NO'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio2">No</label>
                                            </div>
                                           
                                          </div>
                                        </div>
                      
                                    </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Reserved</label><br>
                                        <div class="card-content">
                                          <div class="card-body">
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio3" name="reserved" value="YES" class="custom-control-input" <?php if($view->reserved=='YES'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio3">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio4" name="reserved" value="NO" class="custom-control-input" <?php if($view->reserved=='NO'){ echo "checked"; }?>>
                                              <label class="custom-control-label" for="customRadio4">No</label>
                                            </div>
                                           
                                          </div>
                                        </div>
                      
                                    </div>
                                    </div>
                                    
                                   
                                   </div>
                                    <div class="row">
                                         <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Date received</label><br>
                                        <input type="date" name="recieved_date" required class="form-control" value="<?php if($view->recieved_date==''){ echo date('Y-m-d'); }else{ echo $view->recieved_date; } ?>" >
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
                                        <label >Extra mobile no</label><br>
                                        <input type="number" name="extra_mobile_no"  class="form-control" value="<?php echo $view->extra_mobile_no; ?>" >
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
                                        <label >Customer mobile no</label><br>
                                        <input type="number" name="mobile" required class="form-control" value="<?php echo $view->mobile; ?>" >
                                    </div>
                                    </div>
                                  <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Customer Phone no</label><br>
                                        <input type="number" name="phone" required class="form-control" value="<?php echo $view->phone; ?>" >
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
                            </div>

						</form>
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
                          <form action="" method="post">
                            <div class="form-group col-md-8" style="float:left;">
                             <input type="hidden" name="orderno" required class="form-control" value="<?php echo $view->orderno?>" readonly>   
                             <select class="form-control" name="status" required>
                                  <option value="">--Select-- </option>
                                  <option value="OFFICE" <?php if($view->status=='OFFICE'){ echo "selected"; }?>>OFFICE </option>
                                  <option value="DEL OFFICE" <?php if($view->status=='DEL OFFICE'){ echo "selected"; }?>>DEL OFFICE </option>
                                  <!-- <option value="SENT TO RT" <?php //if($view->status=='SENT TO RT'){ echo "selected"; }?>>SENT TO RT </option> -->
                                  <option value="SENT FROM PC" <?php if($view->status=='SENT FROM PC'){ echo "selected"; }?>>SENT FROM PC</option>
                                  <option value="SENT FROM RT" <?php if($view->status=='SENT FROM RT'){ echo "selected"; }?>>SENT FROM RT</option>
                                  <option value="RECEIVED BY PL" <?php if($view->status=='RECEIVED BY PL'){ echo "selected"; }?>>RECEIVED BY PL </option>
                                  <option value="POSTED" <?php if($view->status=='POSTED'){ echo "selected"; }?>>POSTED </option>
                                  <option value="VOID" <?php if($view->status=='VOID'){ echo "selected"; }?>>VOID </option>
                                  <option value="RETURN TO PL" <?php if($view->status=='RETURN TO PL'){ echo "selected"; }?>>RETURN TO PL  </option>
                                  <option value="CHANGE OF ITEMS" <?php if($view->status=='CHANGE OF ITEMS'){ echo "selected"; }?>>CHANGE OF ITEMS  </option>
                              </select>
                            </div>
                            <div class="form-group col-md-2" style="float:left;">
                               	<button type="submit" name="statussubmit" value="save" class="btn btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
                            </div>
                         </form>   
                    </div>
               </div>
            </section> 
               <section style="background: #4083f4;padding: 15px;border-radius: 5px;margin-top: 10px;">
                <div class="row">
                    <div class="col-12">
                          <div class="form-group col-md-12">
                              <h4 style="color:#FFF">Warehouse Status</h4>
                          </div>    
                        
                            <div class="form-group col-md-8" style="float:left;">
                             <input type="hidden" name="orderno" class="form-control" value="<?php echo $view->orderno?>" readonly>   
                             <select name="wherestatus" class="form-control">
									<option value="">---- </option>
									<option value="RECEIVED BY RT" <?php if($view->status=='RECEIVED BY RT'){ ?> selected <?php } ?> >RECEIVED BY RT </option>
									<option value="DEL TODAY"  <?php if($view->status=='DEL TODAY'){ echo "selected"; }?>>DEL TODAY </option>
									<option value="DEL TOMORROW"  <?php if($view->status=='DEL TOMORROW'){ echo "selected"; }?>>DEL TOMORROW </option>
									<option value="WITH DRIVER"  <?php if($view->status=='WITH DRIVER'){ echo "selected"; }?>>WITH DRIVER </option>
									<option value="FROM DRIVER"  <?php if($view->status=='FROM DRIVER'){ echo "selected"; }?>>FROM DRIVER </option>
									<option value="DELIVERED"  <?php if($view->status=='DELIVERED'){ echo "selected"; }?>>DELIVERED  </option>
									<option value="SENT TO PL"  <?php if($view->status=='>SENT TO PL'){ echo "selected"; }?>> >SENT TO PL  </option>
							</select>
                            </div>
                          
                    </div>
               </div>
            </section> 
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
                                        <textarea name="comment" required class="form-control"><?php echo $view->comment ?></textarea>
                                    </div>
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
                           
						</form>
                    </div>
                </div>
            </div>
        </div>
    
</section> 
<section id="extended">
    <div class="row">
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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                         <form class="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-body">
                                <h4 class="form-section"><i class="fa fa-bullhorn" aria-hidden="true"></i> SMS <?php //echo date_default_timezone_get(); ?></h4>
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
                                          <option value="Your order will be scheduled for delivery soon.( TFP )">1)Your order will be scheduled for delivery soon. </option>  
                                          <option value="our delivery is scheduled for tomorrow, we are unable to give a specific time as deliveries are grouped.( TFP )( TFP )">2)our delivery is scheduled for tomorrow, we are unable to give a specific time as deliveries are grouped.</option>  
                                          <option value="Our delivery is scheduled for today.( TFP )">3)Our delivery is scheduled for today.</option>  
                                          <option value="Your item has been successfully loaded on the truck. The delivery contractor shall call you prior to reaching your premises.( TFP )">4)Your item has been successfully loaded on the truck. The delivery contractor shall call you prior to reaching your premises.</option>  
                                          <option value="We are on the way to your premises, please stay by your phone with network.( TFP )">5)We are on the way to your premises, please stay by your phone with network.</option>  
                                          <option value="We are unable to reach you over the phone, we are in front of your house, please call us back within the next 15 minutes.( TFP )">6)We are unable to reach you over the phone, we are in front of your house, please call us back within the next 15 minutes.</option>  
                                          <option value="Your delivery will be rescheduled as we have been unable to reach you( TFP )">7)Your delivery will be rescheduled as we have been unable to reach you.</option>  
                                          <option value="We are unable to reach you over the phone, please call the us on 5865 3893( TFP )">8)We are unable to reach you over the phone, please call us on 5865 3893</option>
                                          <option value="We are unable to reach you over the phone, please call the us on 5893 8226( TFP )">9)We are unable to reach you over the phone, please call us on 5893 8226</option>
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

