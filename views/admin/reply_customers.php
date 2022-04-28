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
			<a href="<?php echo base_url('admin/Custmers/newCustomer') ?>" >
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
                                            <form id="customer_order_reply_form"  method="post">
                                              <input type="hidden"  name="customer_rep_id" value="<?php echo $customer_id;?>">
											  <input type="hidden"  name="email_id" value="<?php echo $email_id;?>">
                                               <input type="hidden"  name="order_number_rep_id" value="<?php echo $order_number;?>">
                                                <div class="form-group">
                                                    <strong style="margin-right:30px;">Covered by Warranty</strong>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" style="width:20px;height:20px;"  type="radio"  required name="covered_by_warranty" id="inlineRadio1" value="Yes">
                                                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" style="width:20px;height:20px;"  type="radio" required  name="covered_by_warranty" id="inlineRadio2" value="No">
                                                      <label class="form-check-label" for="inlineRadio2">No</label>
                                                    </div>
                                                </div>

                                                <div class="form-group  not-covered-box">
                                                    <strong style="margin-right:30px;">Not Covered by Warranty</strong> 


                                                    <div class=" col-md-12 d-flex bd-highlight">
                                                      <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                        <div class="">
                                                          <input type="checkbox" id="checkbox1111" name="not_covered_by_warranty[]"  style="width:20px;height:20px;"  value="A">
                                                          <label for="checkbox2"></label>
                                                         </div>
                                                      </div>
                                                          <div class="p-2 w-100 bd-highlight">
                                                            <strong> </strong>Products mentioned on the receipt as promotional item, sold “as is, where is” are sold at discounted prices and do not have any warranty cover 
                                                      </div>                  
                                                    </div>


                                                    <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                      <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                        <div class="">
                                                          <input type="checkbox" id="checkbox1112" name="not_covered_by_warranty[]"  style="width:20px;height:20px;"  value="B">
                                                          <label for="checkbox2"></label>
                                                         </div>
                                                      </div>
                                                          <div class="p-2 w-100 bd-highlight">
                                                            <strong> </strong>Guarantee covers only construction methods, and excludes glass, mirror frame, fabrics, leather, any plastic parts and surface coating (paper, varnish, lacquer).
                                                      </div>                  
                                                    </div>

                                                       <div class=" col-md-12 d-flex bd-highlight">
                                                      <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                        <div class="">
                                                          <input type="checkbox" id="checkbox1113" name="not_covered_by_warranty[]"  style="width:20px;height:20px;"  value="C">
                                                          <label for="checkbox2"></label>
                                                         </div>
                                                      </div>
                                                          <div class="p-2 w-100 bd-highlight">
                                                            <strong> </strong>After sale guarantee if any is limited to one year only as from date of purchase.
                                                      </div>                  
                                                    </div>

                                                     <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                      <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                        <div class="">
                                                          <input type="checkbox" id="checkbox1114" name="not_covered_by_warranty[]"  style="width:20px;height:20px;"  value="D">
                                                          <label for="checkbox2"></label>
                                                         </div>
                                                      </div>
                                                          <div class="p-2 w-100 bd-highlight">
                                                           <strong> </strong>No guarantee is given.
                                                             </br>



                                                              <div class=" col-md-12 d-flex bd-highlight">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"   style="width:20px;height:20px;" value="1">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Or materials and timber against woodborers, termites & other insects </p>
                                                                    </div>                  
                                                              </div>

                                                               <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"   style="width:20px;height:20px;" value="2">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>No guarantee is given against growth of fungus due to climatic environment (“Moisissure”)</p>
                                                                    </div>                  
                                                              </div>


                                                               <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]" onclick="onlyOne(this)" 
                                                                     style="width:20px;height:20px;" value="3">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Against changes of surface, mirrors, varnish, plating of hinges, handles ,fittings due to climatic condition, color fading due to sunlight , wear and tear of covering material i.e. PVC and fabric.  </p>
                                                                    </div>                  
                                                              </div>


                                                               <div class=" col-md-12 d-flex bd-highlight" style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]" style="width:20px;height:20px;" value="4">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Any misuse or not for the purpose intended and designed for. </p>
                                                                    </div>                  
                                                              </div>

                                                                <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"   style="width:20px;height:20px;" value="5">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Any parts other than the gas lift for office chairs products</p>
                                                                    </div>                  
                                                              </div>

                                                                <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"  style="width:20px;height:20px;" value="6">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Lighting products including bulbs</p>
                                                                    </div>                  
                                                              </div>

                                                              <div class=" col-md-12 d-flex bd-highlight"  style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"  style="width:20px;height:20px;" value="7">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>TV Brackets and its fittings</p>
                                                                    </div>                  
                                                              </div> 

                                                                <div class=" col-md-12 d-flex bd-highlight" style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                    <input type="checkbox" id="checkbox4" name="no_gurantee_option[]"   style="width:20px;height:20px;" value="8">
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><strong> </strong>Any electrical & electronic part that comes with the furniture.</p>
                                                                    </div>                  
                                                              </div>  


                                                              <div class=" col-md-12 d-flex bd-highlight" style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">
                                                                     <input type="checkbox" id="other_reason_ckeckbox" name="no_gurantee_option[]"    style="width:20px;height:20px;" value="other">
                                                                   
                                                                    <label for="checkbox2"></label>
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p>Other Reason</p>
                                                                    </div>                  
                                                              </div> 


                                                              <div class=" col-md-12 d-flex bd-highlight other_reasons_input" style="margin-top:-30px;">
                                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                                  <div class="">                                                                 
                                                                   
                                                                   </div>
                                                                </div>
                                                                    <div class="p-2 w-100 bd-highlight">
                                                                      <p><input type="text"    placeholder ="Enter other reason" class="form-control other_reasons_input"></p>
                                                                    </div>                  
                                                              </div>                                                     
                                                               
                                                               
                                                                
                                                               
                                                      </div>                  
                                                    </div> 








                                                   <!--<div class="form-check">
                                                     
                                                      <label class="" for="exampleRadios1">
                                                       <strong style="margin-right:20px;">(A)</strong> Products mentioned on the receipt as promotional item, sold “as is, where is” are sold at discounted prices and do not have any warranty cover
                                                        <input class="" type="radio" name="not_covered_by_warranty" id="exampleRadios1" value="A" checked>
                                                      </label>
                                                      
                                                    </div>



                                                    <div class="form-check">
                                                        <label class="" for="exampleRadios1">
                                                       <strong style="margin-right:20px;">(B)</strong> Guarantee covers only construction method, and excludes glass, mirror frame, fabrics, leather, any plastic parts and surface coating (paper, varnish, lacquer).
                                                       <input class=""  type="radio" name="not_covered_by_warranty" id="exampleRadios2" value="B">
                                                      </label>                                             
                                                    </div>
                                                     <div class="form-check">
                                                        <label class="" for="exampleRadios1">
                                                       <strong style="margin-right:20px;">(C)</strong> After sale guarantee if any is limited to one year only as from date of purchase
                                                       <input class=""  type="radio" name="not_covered_by_warranty" id="exampleRadios3" 
                                                       value="C">
                                                      </label>                                             
                                                    </div>
                                                     <div class="form-check">
                                                        <label class="" for="exampleRadios1">
                                                       <strong style="margin-right:20px;">(D)</strong> No guarantee is given
                                                       <input class=""  type="radio" name="not_covered_by_warranty" id="exampleRadios4" 
                                                       value="D">
                                                      </label>  
                                                  </br>
                                                      <small>(i) for materials and timber against woodborers, termites & other insects  </small>    <br>
                                                       <small>(ii) No guarantee is given against growth of fungus due to climatic environment (“Moisissure”) </small>    <br>
                                                       <small>(iii) against changes of surface, mirrors, varnish, plating of hinges, handles ,fittings due to climatic condition, color fading due to sunlight , wear and tear of covering material i.e. PVC and fabric </small>    <br>
                                                       <small>(iv) Any misuse or not for the purpose intended and designed for. 
                                                         </small>    <br>
                                                       <small> (v) any parts other than the gas lift for office chairs products </small>    <br>
                                                       <small>(vi) lighting products including bulbs</small>    <br>
                                                       <small>(vii) TV Brackets and its fittings </small>    <br>
                                                       <small>(viii) Any electrical & electronic part that comes with the furniture.
                                                        </small><br>                                          
                                                     
                                     
                                                    </div> --->
                                                    </br>   

                                                     <div class=" col-md-12 d-flex bd-highlight">
                                                      <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                        <div class="">
                                                          <input type="checkbox" id="use_aftersale_service_radio" name="use_aftersale_service"  style="width:20px;height:20px;"  value="Yes">
                                                          <label for="checkbox2"></label>
                                                         </div>
                                                      </div>
                                                          <div class="p-2 w-100 bd-highlight">
                                                            <strong>Use AFTERSALE service despite covered. </strong> 
                                                      </div>                  
                                                    </div>




                                                   <!----  <div class="form-check">
                                                        <label class="" for="exampleRadios6">
                                                       <strong > Use AFTERSALE service despite not covered.</strong>
                                                       <input class=""  type="radio" name="use_aftersale_service" id="exampleRadios6" 
                                                       value="Yes">
                                                      </label>                                             
                                                    </div>       ---->                                      

                                                </div>

                                                 <div class="form-group">
                                                    <strong style="margin-right:30px;">Additional Comment</strong>
                                                </br></br>
                                                    <div class="table-responsive">  
                                                         <?php $i = 1 ; 
                                                          if(!empty($total_item)){

                                                          foreach($total_item as $vwi){ ?>

                                                            <div class="form-group">   
                                                            <label for="exampleInputEmail<?php echo $i;?>">Item <?php echo $i;?></label>      
                                                            <textarea class="form-control" name="items[]"  placeholder="Type here...." id="exampleInputEmail<?php echo $i;?>" rows="3"></textarea>
                                                            </div>

                                                          <?php  $i++;} } ?>
                                                  
                                                    </div>
                                                </div>

                                                 <div class="form-group">
                                                    <strong style="margin-right:30px;">Message </strong>
                                                </br></br>
                                                    <div class="table-responsive">                                                 

                                                            <div class="form-group">   
                                                           <!--- <label for="exampleInputEmail">Message</label>-->      
                                                            <textarea class="form-control" name="simple_message"  placeholder="Type here...." id="exampleInputEmail" rows="3"></textarea>
                                                            </div>                                                        
                                                  
                                                    </div>
                                                </div>



                                        <div class="form-group">
                                                 <strong style="margin-right:10px;">More Options </strong>
                                              <div class=" col-md-12 d-flex bd-highlight">
                                                <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                                  <div class="">
                                                    <input type="checkbox" id="checkbox2" name="more_options" onclick="onlyOne(this)"  style="width:20px;height:20px;" value="3">
                                                    <label for="checkbox2"></label>
                                                   </div>
                                                </div>
                                                    <div class="p-2 w-100 bd-highlight">
                                                      <p><strong> </strong>Repair at Premises (Rs 800) – Will be approved by Factory if repairs can be done at Home – Payment in Showroom at Furniture.mu Riche Terre (Payment to be made prior to repairs) </p>
                                                    </div>                  
                                              </div>

                                            <div class=" col-md-12 d-flex bd-highlight">

                                              <div class="p-2 flex-shrink-1 bd-highlight sample"> 
                                              <div class="">
                                                <input type="checkbox" id="checkbox" name="more_options"  onclick="onlyOne(this)" style="width:20px;height:20px;"  value="4">
                                                <label for="checkbox"></label>
                                               </div>
                                            </div>


                  <div class="p-2 w-100 bd-highlight">
                    <p><strong></strong>Repair will be done free of charge at our time convenience. We will give 1 day notice but unfortunately, a specific time cannot be provided.</p>
                  </div>
                  
                  </div>















                                              
                                                    </div> 



                                                <div class="form-group">
                                                    <strong style="margin-right:30px;">Images</strong>
                                                    </br></br>
                                                    <div class="table-responsive">
                                                        <div class="form-group">  
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22">
                                                         Add Image
                                                        </button> 
                                                        </div>                                              
                                                    </div>
                                                </div>



                                                <table id="image-hold-table" class="table table-striped table-bordered nowrap" style="width:100%">
                                                  <thead>
                                                      <tr>
                                                          <th>S No.</th>
                                                          <th>Image Name</th>
                                                          <th>Image</th>
                                                          <th>Message</th>                                                                                                      
                                                    </tr>
                                                  </thead>
                                                  <tbody id="add-image-content">                                                   
                                                   
                                                  </tbody>                                                 
                                              </table>



                                                <div class="text-center"><button type="submit" id="customer-reply-submit-btn" class="btn btn-primary btn-lg">Submit</button></div>

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
 <!-- Modal -->
<div class="modal fade" id="exampleModal22" tabindex="-1"   role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
     <form  method="post"  id="upload-order-image">

	  <div class="modal-body">	
        <input type="hidden"  name="customer_rep_id" value="<?php echo $customer_id;?>">
        <input type="hidden"  name="order_number_rep_id" value="<?php echo $order_number;?>">	
        <div class="form-group">
        <label for="exampleInputEmail1">Image Name</label>
        <input type="text" class="form-control" name="image_name"  required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Image Name">       
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Upload Image</label>
        <input type="file" class="form-control" name="order_image" required   id="exampleInputPassword1">
        </div>
         <div class="form-group">
        <label for="exampleInputEmail1">Message</label>
        <textarea class="form-control"  name="order_message"></textarea>        
        </div>
    </div>

	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" id="donesubmit" class="btn btn-primary">Done</button>
	  </div>
     </form>
	</div>
  </div>
</div>
<!-- End Modal -->
        
<?php include("footer.php") ; ?> 


 <script>
    $(document).ready( function () {    
        $('.other_reasons_input').hide();  
        var $radios = $('#other_reason_ckeckbox').change(function () { 
          var value = $(this).val(); 
          //  var value = $radios.filter(':checked').val();
          if($(this).is(':checked')){
            if(value == 'other'){
                $('.other_reasons_input').show();
            }else{
                $('.other_reasons_input').hide();                   
            }
          }else{
             if(value == 'other'){
              $('.other_reasons_input').hide(); 

             }            
          }           
            
        });
		$('input:checkbox[name="no_gurantee_option[]"]').on('change',function(){
			if ( $("#checkbox1114").attr('checked') == true){
                $("#checkbox1114").attr('checked', false);
			}else{
				$("#checkbox1114").attr('checked', true);
			}
		})
    });
</script>