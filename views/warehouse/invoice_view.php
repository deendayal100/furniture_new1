<?php include("header.php") ; ?>
 <style>
     
     .main_steps{
    width: 100%;
    background: none;
    padding: 80px 0px;
}

.main_steps ul{
    margin: 0px auto;
    padding: 0px;
    list-style: none;
    text-align: left;
}

.main_steps li {
    float: none;
    display: inline-block;
    font-size: 17px;
    width: 20%;
    text-align: center;
    position: relative;
    margin-bottom: 35px;
}

.main_steps li span {
    background: #225f3f;
    color: #fff;
    display: block;
    margin: auto;
    border-radius: 5px;
    border: 1px solid #e6e6e6;
    font-size: 15px;
    padding: 10px 0px;
}

.main_steps li strong {
    margin-top: 15px;
    display: block;
}

     
 </style>
 
<div class="main-panel">
<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">View order details
		<a href="<?php echo base_url('warehouse/Invoice/own') ?>" >
				<button class="btn btn-success pull-right">Back</button> 
			</a>
			<a style="display:none;margin-right:10px; float: right;" href="<?php echo base_url('warehouse/Invoice/edit') ?>/<?php echo $view->id; ?>" >
				<button class="btn btn-success pull-right">Edit</button> 
			</a>
			<a  style="display:none;margin-right:10px; float: right;" href="<?php echo base_url('warehouse/Invoice/add') ?>" >
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

<section id="about">
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <h5 style="text-align: center;font-size: 25px;"><b>Invoice No : <span style="color:red">#<?php echo $view->orderno; ?>-<?php echo $view->location; ?></span></b></h5>
                            <div class="card-header padding-set">
                                <h5>Customer Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <hr style="margin-top: 0;">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                              
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->name?></span>
                                                </li>
                                                 
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Address  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->txtAddress?></span>
                                                
                                                
                                                </li>
                                               
                                                 
                                                 
                                               
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                 
                                             <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Mobile :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->mobile?></span>
                                                    </li>
                                                     <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer City  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->city?></span>
                                                </li>
                                                     
                                                    
                                                
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                               
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Phone :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->phone?></span>
                                                </li>
                                                
                                                    
                                                
                                              
                                            </ul>
                                        </div>
                                      
                                    </div>

                                   
                                    
                                </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-header padding-set">
                                <h5>Other Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <hr style="margin-top: 0;">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                              
                                                
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Expected delivery date :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($view->expected_del_date !=''){ echo date("d-m-Y",strtotime($view->expected_del_date)); } ?></span>
                                                </li>
                                                 
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Cim approved :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->cim_approved; //date("d-m-Y",strtotime($view->cim_approved));?></span>
                                                    </li>
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>GPS Location :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($view->gps_code==""){ echo "Not available"; }else{ ?><a href="<?php echo $view->gps_code?>"><?php echo $view->gps_code?></a><?php } ?></span>
                                                    </li>
                                                
                                               
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                    <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Date received :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($view->recieved_date !=''){ echo date("d-m-Y",strtotime($view->recieved_date)); } ?></span>
                                                </li>
                                            
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Reserved :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->reserved?></span>
                                                    </li>  
                                                   
                                                   <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Delivery Type :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($view->own_delivery==1){ echo "Own Delivery"; }else{ echo "Delivery"; } ?></span>
                                                    </li>  
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                                <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>RT / PL :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->Combo68?></span>
                                                </li>
                                                
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Status :</a></span>
                                                    <span class="display-block overflow-hidden"><?php /*if($view->status==1){ echo "On order"; }
                                                      elseif($view->status==2){ echo "On delivery"; }
                                                      elseif($view->status==3){ echo "Payment Pending"; }
                                                      elseif($view->status==4){ echo "Not ready to Del"; }
                                                      elseif($view->status==5){ echo "Void"; }
                                                      elseif($view->status==6){ echo "Back to Office"; }
                                                      elseif($view->status==7){ echo "Change of Item"; }*/
                                                      echo $view->status;
                                                      ?></span>
                                                    </li>
                                                    <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Extra Mobile Number  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->extra_mobile_no?></span>
                                                </li>
                                                  
                                                   
                                                
                                              
                                            </ul>
                                        </div>
                                      
                                    </div>

                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="booking">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Orders</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Item Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Oder No.</th>
                          <th>Order Date</th>
                          <th>Quantity Sold</th>
                          <th>Quantity To Deliver</th>
                          <th>Due Amount</th>
                          <th>Paid Amount</th>
                          <th>Detail </th>
                          <th>Order Note</th>
                          <th>Item Code</th>
                          <th>Item Note</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($orders!=null){ foreach ($orders as $ord) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $ord->orderno; ?></td>
                        <td><?php echo $ord->order_date;  ?></td>
                        <td><?php echo $ord->txt_Quantity ; ?></td>
                        <td><?php echo $ord->txt_Qty_Delivered ; ?></td>
                        <td><?php echo $ord->due_amount; ?></td>
                        <td><?php echo $ord->amount_paid; ?></td>
                        <td><?php echo $ord->Description  ; ?></td>
                        <td><?php echo $ord->order_note ; ?></td>
                        <td><?php echo $ord->item_code ; ?></td>
                        <td><?php echo $ord->item_note ; ?></td>
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="calls">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Calls</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Call Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Contact no</th>
                          <th>Title</th>
                          <th>Recording</th>
                          <th>Download</th>
                          
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($calls!=null){ foreach ($calls as $cls) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cls->contact; ?></td>
                        <td><?php echo $cls->name; ?></td>
                        <td>
                        <audio controls>
                        <source src="<?php echo base_url($cls->path)?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio> 
                        </td>
                        <td><center><a href="<?php echo base_url($cls->path)?>" download><i class="fa fa-download" style="font-size:24px;color: blue;" ></i></a></center></td>
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
             <section id="sms">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">SMS</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                SMS Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>SMS Date</th>
                          <th>SMS Time</th>
						  <th>Mobile</th>
                          <th>Message</th>
                          
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($SMS!=null){ foreach ($SMS as $sms) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sms->date; ?></td>
                        <td><?php echo $sms->time;  ?></td>
						<td><?php echo $sms->mobile;  ?></td>
                        <td><?php echo $sms->remark ; ?></td>
                        
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>       
            <section id="comment">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Comment</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Comment Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Comment Date</th>
                          <th>Comment Time</th>
                          <th>Comment</th>
                          
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($comments!=null){ foreach ($comments as $cm) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date('Y-m-d',strtotime($cm->created_on)); ?></td>
                        <td><?php echo date('H:i',strtotime($cm->created_on)); ?></td>
                        <td><?php echo $cm->comment ; ?></td>
                        
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  
            <?php
            $assign = $this->db->get_where(TBL_ASSIGN,['order_no'=>$view->orderno,'cancel_status'=>1])->row();
            if(empty($assign)){ 
				
			}else{
				$assignwerb = $this->db->query("select * from assign where order_no='".$view->orderno."' AND cancel_status='1' ORDER BY `id` DESC ")->result();
				$drdata = $this->db->get_where(TBL_DRIVER,['id'=>$assign->driver_id])->row(); 
            
            ?> 
            <div class="card">
                           
                            <div class="card-header padding-set">
                                <h5><?php if($view->own_delivery==1) {echo "Staff"; } else { echo "Driver" ;} ?>  Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <hr style="margin-top: 0;">
                                    	<a href="<?php echo base_url('warehouse/Invoice/cancel/view/'.$assign->id.'/'.$view->id)?>"><button type="button" class="btn btn-primary"  style="float: right;">Cancel</button></a> 
                                   
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                               <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a> <?php if($view->own_delivery==1) {echo "Staff"; } else { echo "Driver" ;} ?> ID :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if(!empty($drdata->staff_id)) { echo $drdata->staff_id; } ?></span>
                        </li>
                        <li class="mb-2">
                            <span class="text-bold-500 primary"><a>Email :</a></span>
                             <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->email : '';?></span>
                        </li>
                     </ul>
                                             </div>
                                             <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Name  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->name : '';?></span>
                                                
                                                
                                                </li>
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Truck Plate No :</a></span>
                                                       <span class="display-block overflow-hidden"><?php if(!empty($drdata->truck_plate_no)) { echo $drdata->truck_plate_no; } ?></span>
                                                   <span class="display-block overflow-hidden"><?php ?></span>
                                                    
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                 
                                             <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Mobile :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->mobile : '';?></span>
                                                    </li>
                                                     <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Date  :</a></span>
                                                    <span class="display-block overflow-hidden">
                                                        <?php if(!empty($drdata->created_on)) { $input = $drdata->created_on;
$date = strtotime($input);
echo date('Y-m-d', $date);  } ?>
                                                    </span>
                                                </li>
                                                     
                                                    
                                                
                                            </ul>
                                        </div>
                                    </div>

                                   
                                    
                                </div>
                              
                            </div>
							<div class="card-header padding-set" style="display: none;">
                                <h5>Not Delevered By Driver</h5>
                            </div>
							<div class="card-body">
                                <div class="card-block">
                                    <div class="row">
										<?php if($assignwerb){ 
										foreach($assignwerb as $key=>$val){
										if($assign->driver_id!=$val->driver_id){
										$ddata = $this->db->get_where(TBL_DRIVER,['id'=>$val->driver_id])->row();
										?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->name?></span>
                                                </li>
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Contact  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->mobile?></span>
                                                </li>
												<li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Email :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->email?></span>
												</li>
                                            </ul>
                                        </div>
										<?php }}} ?>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <?php } ?>
                         <div class="card">
                 <div class="card-header padding-set">
                               
                            </div>
	<div class="card-body">
		<div class="card-block"><hr style="margin-top: 0;">
			<section class="cd-horizontal-timeline123">
			
            
    <div class="main_steps">
    <div class="container">
        <ul>
           <?php
            if(!empty($driverstatus)){
              foreach($driverstatus as $drst){    
            ?>
            <li>
                <span> <?php echo date('d/m/Y',strtotime($drst->created_on));?> </span>
                <strong style="text-transform: uppercase;"> <?php echo $drst->status?> </strong>
            </li>
            <?php }} ?>
        </ul>
          <hr style="margin-top: 0;">
							<div class="card-header padding-set diset">
                                <h5>Delivery Image</h5>
                            </div>
							<div class="sdf">
                                <?php
                                 if(empty($assign)){ }else{
                                if($assign->status=="Own Delivered" || $assign->status=="Delivered"){ ?>
                                <?php
                                if(isset($assign) && $assign->image!=""){
                                ?>
                                <img src="<?php echo base_url($assign->image)?>" alt="Not found" class="img-thumbnail">
                                <?php }else{ ?>     
                                <span>Not Available</span>
                                <?php } ?>
                                 <?php
                                if(isset($assign) && $assign->image1!=""){
                                ?>
                                <img src="<?php echo base_url($assign->image1)?>" alt="Not found" class="img-thumbnail">
                                <?php }else{ ?>     
                                <span>Not Available</span>
                                <?php } ?>
                                 <?php
                                if(isset($assign) && $assign->image2!=""){
                                ?>
                                <img src="<?php echo base_url($assign->image2)?>" alt="Not found" class="img-thumbnail">
                                <?php }else{ ?>     
                                <span>Not Available</span>
                                <?php } ?>
                                 <?php
                                if(isset($assign) && $assign->image3!=""){
                                ?>
                                <img src="<?php echo base_url($assign->image3)?>" alt="Not found" class="img-thumbnail">
                                <?php }else{ ?>     
                                <span>Not Available</span>
                                <?php } ?>
                                <?php }} ?>
							<div class="card-header padding-set">
                                <h5>Invoice Image</h5>
                            </div>
							<?php if(isset($assign) && $assign->image4!=""){ ?>
                                <img src="<?php echo base_url($assign->image4)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
                                <span>Not Available</span>
							<?php } ?>
							<?php if(isset($assign) && $assign->image5!=""){ ?>
                                <img src="<?php echo base_url($assign->image5)?>" alt="Not found" class="img-thumbnail">
							<?php }else{ ?>     
                                <span>Not Available</span>
							<?php } ?>
							</div>
							<div class="card-header padding-set">
                                <h5>Record Time</h5>
                            </div>
							<?php if(isset($assign) && $assign->record_time!=""){ ?>
                                <?php echo $assign->record_time; ?>
							<?php } ?>
							
							
                                  <?php
                                 if(empty($assign)){ }else{
                                if($assign->status=="Not delivered"){ ?>
                                 <div class="card-header padding-set">
                                <h5>Reason</h5>
                            </div>
                                <p><?php echo $assign->reason; ?></p>
                                      
                                <?php }} ?>
    </div>
</div>
			
			
			</section>
		</div>
	</div>
</div>
             <div class="card">
                 <div class="card-header padding-set">
                                <h5> Status</h5>
                            </div>
	<div class="card-body">
		<div class="card-block"><hr style="margin-top: 0;">
			<section class="cd-horizontal-timeline123">
			
            
                        <div class="main_steps">
    <div class="container">
        <ul>
            <?php
            if(!empty($status)){
              foreach($status as $st){    
            ?>
             <li>
                <?php
                    if(!empty($st->driver_name))
                {
                    ?>
                                    <span><?php echo $st->driver_name;?></span>

                    <?php
                }
                ?>
                <span> <?php echo date('d-m-Y H:i:s',strtotime($st->created_on));?> </span>
                <strong> <?php echo $st->status?> </strong>
            </li>
            <?php }} ?>
        </ul>
    </div>
</div>
			
			
			</section>
		</div>
	</div>
</div>

  </div>
</div>