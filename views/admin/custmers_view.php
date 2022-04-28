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
    width: 100px;
    height: 100px;
    display: block;
    margin: auto;
    border-radius: 50%;
    border: 1px solid #e6e6e6;
    font-size: 15px;
    padding: 38px 0px;
}

.main_steps li strong {
    margin-top: 15px;
    display: block;
}

     
 </style>
 
<div class="main-panel">
<div class="main-content">
   <div class="content-wrapper"><!--Statistics cards Starts-->
    <?php
    $repliedcheck = array();
    if($invoice_status=="false")
    {
        if(!empty($newcust)){
            foreach($newcust as $ncu){
                array_push($repliedcheck,$ncu->order_number);
            }
        }
    }
    ?>
        
      <div class="row">
    <div class="col-12">
     
        <div class="content-header">View <?php if($invoice_status=="false"){ echo "Customer"; }else { echo"staff"; }  ?>  details
            
			
            <?php if($invoice_status=="false"){?>
            <?php  if(in_array($view[0]->order_number,$repliedcheck)){?>
               <a href="<?php echo base_url('admin/Custmers/repliedCustomer') ?>" >
                <button class="btn btn-success pull-right"  >Back</button> 
                </a>
                <a href="<?php echo base_url('admin/Custmers/viewReplied/').$view[0]->order_number .'/'.$view[0]->id ?>"   >                  
                    <button class="btn btn-success pull-right" style="margin-right:10px;">Show Reply</button> 
                </a>
                

            <?php   }else{?>
            
                <a href="<?php echo base_url('admin/Custmers/newCustomer') ?>" >
                    <button class="btn btn-success pull-right"  >Back</button> 
                </a>
           <?php  }
            }
            else
            {
                ?>
                  <a href="<?php echo base_url('admin/Custmers/newCustomer') ?>" >
                    <button class="btn btn-success pull-right"  >Back</button> 
                </a>
                <?php
            }
           ?>
           
           
           <?php if(isset($invoice)) { ?>
                        
                        <a href="<?php echo base_url('admin/Invoice/view/').$invoice[0]->id ?>"  >
                            <button class="btn btn-success pull-right" style="margin-right:10px;">Invoice</button> 
                         </a>
                         
                <?php } ?>
          
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
<?php 
//echo '<pre>';
//print_r($itemcodes);
?>
<section id="about"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <h5 style="font-size: 25px;margin-bottom: 0;margin-top: 14px;padding: 3px 15px;border-bottom: 1px solid #d4d4d4;"><b>Order No : <span style="color:red">#<?php echo (isset($view[0]->order_number)? $view[0]->order_number:$images[0]->order_no )  ?></span></b></h5>
                            <div class="card-header padding-set">
                                <h5> <?php echo (isset($images[0]->order_no))? "Staff":"Customer"; ?>  Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <ul class="no-list-style">
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($invoice_status=="false"){ echo $view[0]->name; }else {
                                                    echo $images[0]->name;
                                                    } ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php 
                                            if($invoice_status=="false")
                                            {
                                                ?>
                                                										<div class="col-lg-2">
                                            <ul class="no-list-style">
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Address  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo  $view[0]->address;?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                            }
                                        ?>

                                        <div class="col-lg-2">
                                           <ul class="no-list-style">
												<li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Phone :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo (isset($view[0]->phone)? $view[0]->phone:$images[0]->mobile);?></span>
												</li>
                                            </ul>
                                        </div>
                                        <?php 
                                            if($invoice_status=="false")
                                            {
                                                ?>
                                                	<div class="col-lg-3">
                                           <ul class="no-list-style">
												<li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Email Address :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view[0]->email?></span>
												</li>
                                            </ul>
                                        </div>
                                                <?php
                                            }
                                        ?>
									
										<div class="col-lg-2">
                                           <ul class="no-list-style">
												 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a> <?php if($invoice_status=="false"){ echo "Purchase"; } ?>  Date  :</a></span>
                                                    <span class="display-block overflow-hidden"> <?php echo (isset($view[0]->purchase_date)? $view[0]->purchase_date:$images[0]->delivery_time);?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        
             <!--                           <div class="col-lg-2">-->
             <!--                              <ul class="no-list-style">-->
												 <!--<li class="mb-2">-->
             <!--                                       <span class="text-bold-500 primary"><a> Damage Reason  :</a></span>-->
             <!--                                       <span class="display-block overflow-hidden"> <?php echo (isset($view[0]->damaged_message)? $view[0]->damaged_message:"NO");?></span>-->
             <!--                                   </li>-->
             <!--                               </ul>-->
             <!--                           </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    if((!empty($image[0]->image) || (!empty($image[0]->image1)) || (!empty($image[0]->image2)) || (!empty($image[0]->image3)) || (!empty($image[0]->image4)) || (!empty($image[0]->image5))) || $invoice_status=="false")
                    {?>
                        
                         <div class="card">
                            <div class="card-header padding-set">
                                <h5>Informations</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <ul class="no-list-style">
											  <li class="mb-2">
                                                    <span class="text-bold-500 primary">
														<a> <?php 	if($invoice_status=="false") { echo "ITEM"; }else
														{
														    echo "INVOICE";
														}
														?>  PICTURE :</a>
													</span>
													<span class="display-block overflow-hidden">
														<ul style="list-style: none;padding: 0;">
														<?php 
														if($invoice_status=="false")
														{
														    if($itemcodes){
                                                                 $j=0;
                                                                 $d=0;
    															foreach($itemcodes as $key=>$val){
    																$custid = $val->customer_id;
    																$itemimage = $this->db->query("select images from customer_itemimages where customer_id=$custid")->result();
    																if(sizeof($itemimage)){
    																    if($d<sizeof($itemimage)){
    															?>
    
    																<li style="border: 2px solid #399faf;padding: 10px;border-radius: 5px;margin-bottom: 10px;">
    																	<div class="itmcode" style="padding: 0 0 20px 0;">Damage Item Code : <?php echo $val->dmg_itemcode; ?></div>
    																	<div class="itmcode" style="padding: 0 0 20px 0;">Damage Reason : <?php echo $val->damaged_message; ?></div>
    																	<?php 
    																	
                                                                        //change by vinod 
                                                                        
                                                                        $ImageLength = sizeof($itemimage);
    
                                                                         //if($key==0 && $itemimage){ 
    																	if($j==0){
    
                                                                        }
    																	//foreach($itemimage as $multi){
    																	for($j=$j; $j<($key+1)*3; $j++) { if($j<$ImageLength){
    																	    $d=$d+1;
    																	?>
    																	<div class="itemimage">
    																		Image : <img src="<?php echo base_url('uploads/customer_itemimage/') ?><?php echo $itemimage[$j]->images; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
    																	</div>
    																	<?php }}} } ?>
    																	<?php /*if($key==1 && $itemimage){ ?>
    																	<div class="itemimage">
    																		Image : <img src="<?php echo base_url('uploads/customer_itemimage/') ?><?php echo $itemimage[1]->images; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
    																	</div>
    																	<?php }*/ ?>
    																</li>
    														<?php }
    														}
														}
														else
														{
														   ?>
														   	<li style="border: 2px solid #399faf;padding: 10px;border-radius: 5px;margin-bottom: 10px;">
														   	    <?php 
														   	        if($invoice_status=="false")
														   	        {
														   	            ?>
														   	            <div class="itmcode" style="padding: 0 0 20px 0;">Damage Item Code : <?php echo $invoice[0]->item_code;?></div>
														   	
														   	            <?php
														   	        }
														   	    ?>
														   	<?php
														   	if(!empty($images[0]->image))
														   	{
														   	    ?><div class="itemimage">Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;"></div>  
				    									   	    <?php
														   	}
														   	?>
					<?php
														   	if(!empty($images[0]->image1))
														   	{
					?>
														  	<div class="itemimage">
											    				Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image1; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
															</div> 
															}
															if(!empty($images[0]->image2))
														   	{
															?>
															<div class="itemimage">
					        										Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image2; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
															</div>  
															<?php }
															
															if(!empty($images[0]->image3))
														   	{?>
															<div class="itemimage">
																Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image3; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
															</div>  
															<?php } 
															if(!empty($images[0]->image4))
														   	{
															?>
															
															<div class="itemimage">
																Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image4; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
															</div>
															<?php }
														if(!empty($images[0]->image5))
														{
															?>
															<div class="itemimage">
																Image : <img src="<?php echo base_url('uploads/Driver/from_staff/') ?><?php echo $images[0]->image5; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
														
															</div>
    													<?php }?>
    													   	</li>
														   <?php 
														}
														?>
														</ul>
													</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php 
                                            if($invoice_status=="false")
                                            {
                                                ?>
                                                <div class="col-12 col-md-6 col-lg-6">
                                           <ul class="no-list-style">
												<li class="mb-2">
                                                    <span class="text-bold-500 primary">
														<a>INVOICE :</a>
													</span>
													<span class="display-block overflow-hidden">
														<ul style="list-style: none;padding: 0;">
														<?php 
														if($itemaddress){
															foreach($itemaddress as $key=>$val){
																$custid = $val->customer_id;
																$iteminvode = $this->db->query("select * from customer_iteminvoice where customer_id=$custid")->result();
															?>
																<li style="border: 2px solid #399faf;padding: 10px;border-radius: 5px;margin-bottom: 10px;">
																	<div class="itmcode" style="padding: 0 0 20px 0;">Address : <?php echo $val->item_address; ?></div>
																	<?php if($key==0 && $iteminvode){ ?>
																	<div class="itemimage">
																		Image : <img src="<?php echo base_url('uploads/customer_iteminvoices/') ?><?php echo $iteminvode[0]->invoices; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
																	</div>
																	<?php } ?>
																	<?php if($key==1 && $iteminvode[1]){ ?>
																	<div class="itemimage">
																		Invoice : <img src="<?php echo base_url('uploads/customer_iteminvoices/') ?><?php echo $iteminvode[1]->invoices; ?>" style="width: 200px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 200px; object-fit: cover;">
																	</div>
																	<?php } ?>
																</li>
														<?php }
														}
														?>
														</ul>
													</span>
                                                </li>
                                            </ul>
                                        </div>
                                                <?php        
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
    <?php
      if($invoice_status=="false")
      {
      ?>
                        <!-- Conversation --->
                        <div class="card">
                            <div class="card-header padding-set">
                                <h5>

                                    <?php  if(!in_array($view[0]->order_number,$repliedcheck)){?>
                                          <a href="<?php echo base_url('admin/Custmers/replyUs/').$view[0]->order_number .'/'.$view[0]->id?>" >
                                    <button class="btn btn-success pull-right">Reply to Customer</button> 
                                    </a>
                                       
                                    <?php   }?>
                                     
                                
                                </h5>
                            </div>
                             <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class=" col-md-12 ">
                                          <!---  <form id="admin-question-form"  method="post">  
                                               
                                                <div class="row">    
                                                    <div class=" col-md-10 ">                                 
                                                        <div class="form-group">                                           
                                                            <textarea class="form-control" name="message"  placeholder="Type here...." id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                        <input type="hidden"  value="<?php echo $custid; ?>"  name="customer_id">
                                                        <input type="hidden"  name="type"  value="admin">
                                                         <input type="hidden"  name="message_id"  id="message-id-admin"  >                                                 

                                                        <input type="hidden"  id="order_id" name="order_id"  value="<?php echo $view[0]->order_number; ?>">
                                                    </div>
                                                    <div class=" col-md-2  "> 
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </div>
                                                </div>                                                

                                            </form>--->
                                        </div>
                                        <div class="col-md-12"  id="admin-answer">                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end conversation -->
                        <?php } ?>


                    </div>
                </div>
            </section>
		</div>
	</div>
</div>
            

  </div>
</div>

        
<?php include("footer.php") ; ?>  