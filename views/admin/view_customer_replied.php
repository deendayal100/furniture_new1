<?php include("header.php") ; ?>
 <style>

.modal.fade {
  z-index: 999999999 !important;
  position: absolute;
}
     
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
        
      <div class="row">
    <div class="col-12">
        <div class="content-header">Reply To Customer
            <a href="<?php echo base_url('admin/Custmers/repliedCustomer') ?>" >
                <button class="btn btn-success pull-right">Back</button> 
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
                    <div class="col-sm-12">
                        <div class="card">

                          <!---  <h5 style="font-size: 25px;margin-bottom: 0;margin-top: 14px;padding: 3px 15px;border-bottom: 1px solid #d4d4d4;"><b>Order No : <span style="color:red">#<?php echo $view[0]->order_number; ?></span></b></h5>-->
                            <div class="card-header padding-set">
                                <h5>Reply</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">     
                                        <div class=" col-md-12 ">
                                            <form >
                                            <!---  <input type="hidden"  name="customer_rep_id" value="<?php echo $customer_id;?>">
                                               <input type="hidden"  name="order_number_rep_id" value="<?php echo $order_number;?>">-->
                                                <div class="form-group">
                                                    <strong style="margin-right:30px;">Covered by Warranty</strong>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio"  required name="covered_by_warranty" id="inlineRadio1" <?php if($replies[0]->covered_by_warranty == 'Yes'){?> checked <?php }?> value="Yes">
                                                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" required  name="covered_by_warranty" id="inlineRadio2"  <?php if($replies[0]->covered_by_warranty == 'No'){?> checked <?php }?>  value="No">
                                                      <label class="form-check-label" for="inlineRadio2">No</label>
                                                    </div>
                                                </div>

                                                <?php 
                                                if($replies[0]->covered_by_warranty == 'No'){?>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">  <strong style="margin-right:30px;">Not Covered by Warranty</strong> </label>

                                                    <?php 
													$options = $replies[0]->not_covered_by_warranty;
													 $getlate = explode(', ',$options);
													//echo '<pre>';print_r($getlate);
													foreach($getlate as $val){
														if($val == 'A'){ ?>
															<div class="form-check">
															  <label class="" for="exampleRadios1">
															   <strong style="margin-right:20px;">(A)</strong> Products mentioned on the receipt as promotional item, sold “as is, where is” are sold at discounted prices and do not have any warranty cover
																<!--<input class="" type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios1" value="A" 
																 <?php if($val == 'A'){?> checked
																 <?php }?> >-->
															  </label>
															</div>
														<?php }
														if($val == 'B'){ ?>
															<div class="form-check">
																<label class="" for="exampleRadios1">
															   <strong style="margin-right:20px;">(B)</strong> Guarantee covers only construction method, and excludes glass, mirror frame, fabrics, leather, any plastic parts and surface coating (paper, varnish, lacquer).
															   <!--<input class=""  type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios2" value="B"   <?php if($val == 'B'){?> checked
																	 <?php }?>>-->
															  </label>
															</div>
														<?php }
														if($val == 'C'){ ?>
														<div class="form-check">
                                                        <label class="" for="exampleRadios1">
                                                       <strong style="margin-right:20px;">(C)</strong> After sale guarantee if any is limited to one year only as from date of purchase
                                                       <!--<input class=""  type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios3" 
                                                       value="C" <?php if($val == 'C'){?> checked
                                                             <?php }?> >-->
                                                      </label>
                                                    </div>
														<?php }
														if($val == 'D'){ ?>
															<div class="form-check">
																<label class="" for="exampleRadios1">
															   <strong style="margin-right:20px;">(D)</strong> No guarantee is given
															   <!--<input class="" type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios4" 
															   value="D" <?php if($val == 'D'){?> checked <?php }?> >-->
															  </label>  
															</br>
															<?php 
																$noption = $replies[0]->no_gurantee_option;
																$opt = explode(', ',$noption);
															 ?>
															<div style="font-size: 17px;margin-left: 55px;font-weight: 600;">
													<?php if($opt){ 
													foreach($opt as $pst){
													?>
													<?php if($pst==1){ ?>
													<small>(i) for materials and timber against woodborers, termites & other insects  </small>   <br>
													<?php } ?>
													<?php if($pst==2){ ?>
													<small>(ii) No guarantee is given against growth of fungus due to climatic environment (“Moisissure”) </small>    <br>
													<?php } ?>
													<?php if($pst==3){ ?>
													<small>(iii) against changes of surface, mirrors, varnish, plating of hinges, handles ,fittings due to climatic condition, color fading due to sunlight , wear and tear of covering material i.e. PVC and fabric </small>    <br>
													<?php } ?>
													<?php if($pst==4){ ?>
													<small>(iv) Any misuse or not for the purpose intended and designed for. 
													</small>    <br>
													<?php } ?>
													<?php if($pst==5){ ?>
													<small> (v) any parts other than the gas lift for office chairs products </small>    <br>
													<?php } ?>
													<?php if($pst==6){ ?>
													<small>(vi) lighting products including bulbs</small>    <br>
													<?php } ?>
													<?php if($pst==7){ ?>
													<small>(vii) TV Brackets and its fittings </small>    <br>
													<?php } ?>
													<?php if($pst==8){ ?>
													<small>(viii) Any electrical & electronic part that comes with the furniture.
													</small><br>
													<?php } ?>
													<?php } } ?></div>
															</div>
														<?php }
													}
                                                    ?>
													<br>
													<?php
                                                      if($replies[0]->use_aftersale_service == 'Yes'){?>

                                                




                                                        <div class="form-check">
                                                        <label class="" for="exampleRadios6">
                                                       <strong > Use AFTERSALE service despite not covered.</strong>
                                                       <input class=""  type="radio" name="use_aftersale_service" id="exampleRadios6" 
                                                       value="Yes"  checked>
                                                      </label>                                             
                                                    </div>       

                                                    <?php }?>



                                                </div>

                                            <?php }?>

                                            <?php if(!empty($additional_message)){?>

                                                 <div class="form-group">
                                                    <strong style="margin-right:30px;">Additional Comment</strong>
                                                </br></br>
                                                    <div class="table-responsive">  
                                                         <?php $i = 1 ; 
                                                          if(!empty($additional_message)){

                                                          foreach($additional_message as $vwi){ ?>

                                                            <div class="form-group">   
                                                            <label for="exampleInputEmail<?php echo $i;?>">Item <?php echo $i;?></label>      
                                                            <textarea class="form-control" name="items[]"  readonly  id="exampleInputEmail<?php echo $i;?>" rows="3"><?php echo $vwi->item_message;?></textarea>
                                                            </div>
                                                          <?php  $i++;} } ?>
                                                  
                                                    </div>
                                                </div>

                                            <?php }?>

                                           <?php 
                                                if(!empty($replies[0]->simple_message)){?>

                                                 <div class="form-group">
                                                    <strong style="margin-right:30px;">Message</strong>
                                                </br></br>
                                                    <div class="table-responsive">                                                 

                                                            <div class="form-group">   
                                                           <!--- <label for="exampleInputEmail">Message</label>-->      
                                                            <textarea class="form-control" name="simple_message"  id="exampleInputEmail" rows="3" disabled ><?php echo $replies[0]->simple_message;?></textarea>
                                                            </div>                                                        
                                                  
                                                    </div>
                                                </div>
                                            <?php }?>


                                               <?php 
                                                if($replies[0]->more_options == 'Yes' ){?>

                                                 <div class="form-group">
                                                 <div class="form-check">
                                                       
                                                      <strong style="margin-right:10px;">More Options </strong> 
                                                       <input class=""  type="radio" name="more_options" id="exampleRadios477" 
                                                       value="Yes" <?php if($replies[0]->more_options == 'Yes'){?> checked
                                                             <?php }?> >
                                                        
                                                  </br>
                                                      <small>(i)  Repair at Premises (Rs 800) – Will be approved by Factory if repairs can be done at Home – Payment in Showroom at TFP Port Louis (Payment to be made prior to repairs)  </small>    <br>
                                                       <small>(ii) Repair will be done free of charge at our time convenience (schedule) 8888visible when we select. We will give 1 day notice but unfortunately, a specific time cannot be provided
                                                        This option, after 1-2 weeks, we will put the date, and customer must receive notification of schedule by SMS
                                                        (Customer must choose) </small>    <br>
                                                                                          
                                                     
                                     
                                                    </div>
                                                    </div> 
                                            <?php }?>



                                                <?php if(!empty($order_container)){?>

                                                 <table id="" class="table table-striped table-bordered nowrap" style="width:100%">
                                                  <thead>
                                                      <tr>
                                                          <th>S No.</th>
                                                          <th>Image Name</th>
                                                          <th>Image</th>
                                                          <th>Message</th>                                                                                                      
                                                    </tr>
                                                  </thead>
                                                  <tbody>                                                     
                                                    <?php $i=1;  if($order_container!=null){ foreach ($order_container as $cls) { ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $cls->image_name; ?></td>
                                                        <td> <img src="<?php echo base_url('uploads/order_images/') ?><?php echo $cls->order_image; ?>" style="width: 100px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 100px; ">

                                                           </td>
                                                        <td><?php echo $cls->order_message; ?></td>                                                       
                                                    </tr>
                                                  <?php $i++; }  } ?>
                                                  </tbody>                                                 
                                              </table>

                                          <?php }?>



                                             <!----   <div class="form-group">
                                                    <strong style="margin-right:30px;">Images</strong>
                                                    </br></br>
                                                    <div class="table-responsive">
                                                        <div class="form-group">  
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22">
                                                         Add Image
                                                        </button> 
                                                        </div>                                              
                                                    </div>
                                                </div>---->

                                              <!--  <div class="text-center"><button type="submit" class="btn btn-primary btn-lg">Submit</button></div>-->

                                            </form>   
                                        </div>    
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--- <div class="card">
                            <div class="card-header padding-set">
                                <h5>Informations</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Conversation --->
                      <!--  <div class="card">
                            <div class="card-header padding-set">
                                <h5>
                                  <a href="<?php echo base_url('admin/Custmers/replyUs') ?>" >
                                    <button class="btn btn-success pull-right">Reply to Customer</button> 
                                    </a>
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
                                      <!--  </div>
                                        <div class="col-md-12"  id="admin-answer">                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--->
                        <!-- end conversation -->



                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
            

  </div>
</div>
 
        
<?php include("footer.php") ; ?> 