<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Furniture.mu - User Dashboard</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/custom.css">
      <title>Messages</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
   <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-analytics.js"></script> 
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-firestore.js"></script>
    <script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyB03FfsqQr1FiTuXKEWezpMAfKaFAtwblA",
    authDomain: "furniture-7c5ae.firebaseapp.com",
    projectId: "furniture-7c5ae",
    storageBucket: "furniture-7c5ae.appspot.com",
    messagingSenderId: "920386007553",
    appId: "1:920386007553:web:ee05f00828d58976748600"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
<style type="text/css">
   .btn_hide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
}
</style>
    <script>
        var msgRef=firebase.database().ref("furniture_mu_messages");
       
        $(document).ready(function(){

                 
            //    $("#chat_link").click(function() {

            //       $('html, body').animate({                  
            //             scrollTop: $("#messages_r").height() 
            //          }, 1200);
                                       
            //      $("#messages_r").scrollTop(9999);                  
            // });
            
            $('#chat_link').click();

            $("#submit").on('submit',function(e){
                     e.preventDefault()

                      var message = $("#message").val();
                        if(message == ''){
                           alert('enter valid msg');
                           return false;
                        }
                  // save in database
                  var w = (new Date()).toDateString("YYYY-MM-DD")
                  var today = new Date();

                  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                  var dateTime = w.slice(4, 10) + ' ' + time;
                  msgRef.push().set({
                      "sender_id": '<?php echo $firebase_id; ?>',
                      "sender": 'vinod',
                      "receiver_id": '<?php echo $admin_firebase_id; ?>',
                      "message": message,
                      "time": dateTime,
                  });
                  $("#message").val('');

                  $.ajax({
                       url: "sendNoty",
                       type: "post",
                       data: {userId:'<?php echo $firebase_id; ?>'} ,
                       success: function (response) {                       
                          
                       },
                       error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                       }
                   });
                              
            });

            //submit message on Enter  
              $('#message').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                 {
                     if($(this).val()!='')
                     {
                         $('#sub_msg').click();
                     }
                 }
               }); 

            
        });
        
        function scrollToBottom(){
         setTimeout(() => {
            $('html, body').animate({                  
                        scrollTop: $("#messages_r").height() 
                     }, 1200);                                       
                 $("#messages_r").scrollTop(9999);
        },500);
      }
    </script>
   
    <script>
        // listen for incoming messages
        firebase.database().ref("furniture_mu_messages").orderByKey().on("child_added", function(snapshot) {
            var html = "";
            var html1 = "";
            // give each message a unique ID
           
            // show delete button if message is sent by me
            if (snapshot.val().sender_id == '<?php echo $firebase_id; ?>' && snapshot.val().receiver_id == '<?php echo $admin_firebase_id; ?>') {
              
                html += "<div class='send_msg'> <div class='send_msg_img'> </div><div class='send_msg' ><div class='send_withd_msg'><p class='msg-para' id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "</p>";
                html += "<span class='send_time_date'>";
                html += snapshot.val().time
                html += "</span></div></div></div>";
                // console.log(snapshot.val());
                // console.log('send');
            }else if (snapshot.val().sender_id =='<?php echo $admin_firebase_id; ?>' && snapshot.val().receiver_id == '<?php echo $firebase_id; ?>') {
                
                html += "<div class='incoming_msg'><div class='incoming_msg_img'> </div><div class='received_msg'><div class='received_withd_msg'><p id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "</p>";
                html += "<span class='time_date'>";
                html += snapshot.val().time
                html += "</span></div></div></div>";
                // console.log(snapshot.val());
                 console.log('recive');
            }

            
            //console.log(html1);
            

            document.getElementById("messages_r").innerHTML += html;
            // for auto scrolling
             $("#messages_r").scrollTop(9999);
            // document.getElementById("messages_rec").innerHTML += html1;
        });

        function deleteMessage(self) {
            // get message ID
            var messageId = self.getAttribute("data-id");

            // delete message
            firebase.database().ref("furniture_mu_messages").child(messageId).remove();
        }

        // attach listener for delete message
        firebase.database().ref("furniture_mu_messages").on("child_removed", function(snapshot) {
            // remove message node
            document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed";
        });
    </script>
   </head>
   <body>
      <div class="login-4">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-section1">
                     <div class="logo-2">
                        <a href="#">
                        <img width="350px" height="100px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo"> 
                        </a>
                     </div>
                     <section>

                      <br><br>

                      <?php
                      if(!empty($replies)){
                       foreach($replies as $rep){?>
                          
                              <a class="btn btn-primary" href="<?php echo base_url('Userdash/view/') .$rep->order_number ?>
                              " >
                              <span>View Your Information, Sales Order No <?php echo $rep->order_number;?></span>
                              </a>
                          
                          <?php  }
                              }
                              ?>

                      <ul class="nav nav-tabs" role="tablist">
                         <?php if(!empty($replies)){
                            $adminRepliedCheck = array();
                            if(!empty($admin_replied)){
                                foreach($admin_replied as $ncu){
                                    array_push($adminRepliedCheck,$ncu->order_number);
                                }
                            }

                            



                              $i = 1;
                              foreach($replies as $rep){?>
                           <li class="nav-item">
                              <a class="nav-link bg-transparent <?php if($i== 1){?>active<?php }?>" href="#panel<?php echo $rep->order_number;?>" data-toggle="tab" role="tab" aria-selected="false">
                              <span>Order Number <?php echo $rep->order_number;?></span>
                              </a>

                           </li>
                           <li class="nav-item position-relative">
                              <a class="nav-link bg-transparent <?php if($i== 2){?>active<?php }?>" href="#panelChat" id='chat_link' data-toggle="tab" role="tab" aria-selected="false"
                                 onclick="scrollToBottom()">
                              <span>Chat </span>
                              </a>
                             
                           </li>
                           <?php  $i = 2;
                              }
                              }
                              ?>
                           <!--<li class="nav-item">
                              <a class="nav-link bg-transparent active" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                                  <span>Register</span>
                              </a>
                              </li>
                              <li class="nav-item">
                              <a class="nav-link bg-transparent " href="#login" data-toggle="tab" role="tab" aria-selected="true">
                                  <span>Login</span>
                              </a>
                              </li>---->
                        </ul>
                        <div class="container condition-1">
                           <!--<div class="custom-heading">
                              <h5>(A) Loeram insum dolor asset met</h5>
                              </div>-->
                           <div class="tab-content">
                              <?php if(!empty($replies)){
                                 $i = 1;
                                 foreach($replies as $rep){?>
                              <div class="tab-pane fade  <?php if($i== 1){?>active show<?php }?>" role="tabpanel" id="panel<?php echo $rep->order_number;?>">
                                 <div class="cuff">


                               <?php  if(in_array($rep->order_number,$adminRepliedCheck)){

                                foreach($admin_replied as $cust){

                                   if($rep->order_number == $cust->order_number){
                                ?>

                                   <form>
                                       <div class="row text-left">


                                  <div class="form-group">
                                                                     <strong style="margin-right:10px;">Selected Options </strong>
                                                                     <?php 
                                                                        if($cust->more_options == '1' ){?>
                                                                     <div class=" col-md-12 d-flex bd-highlight">
                                                                        <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                                           <div class="">
                                                                              <!-- <input type="checkbox" id="checkbox2" name="more_options" onclick="onlyOne(this)"  style="width:20px;height:20px;" value="3">
                                                                                 <label for="checkbox2"></label>-->
                                                                           </div>
                                                                        </div>
                                                                        <div class="p-2 w-100 bd-highlight">
                                                                           <p><strong> </strong>Bring the damaged item to our warehouse using your own mean of Transport (Taxi Service available on 5865 - 3891)</p>
                                                                        </div>
                                                                     </div>
                                                                     <?php }?>
                                                                     <?php 
                                                                        if($cust->more_options == '2' ){?>
                                                                     <div class=" col-md-12 d-flex bd-highlight">
                                                                        <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                                           <div class="">
                                                                              <!-- <input type="checkbox" id="checkbox2" name="more_options" onclick="onlyOne(this)"  style="width:20px;height:20px;" value="3">
                                                                                 <label for="checkbox2"></label>-->
                                                                           </div>
                                                                        </div>
                                                                        <div class="p-2 w-100 bd-highlight">
                                                                           <p><strong> </strong>Request for transportation at the cost of Rs 1,200 per one way trip (Full Service at 2 x Rs 1,500 = Rs 3,000). Payment to be made by bank transfer or cash in showroom prior to repair being scheduled. Date & Time will be determined by the transport department.</p>
                                                                        </div>
                                                                     </div>
                                                                     <?php }?>
                                                                     <?php 
                                                                        if($cust->more_options == '3' ){?>
                                                                     <div class=" col-md-12 d-flex bd-highlight">
                                                                        <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                                           <div class="">
                                                                              <!-- <input type="checkbox" id="checkbox2" name="more_options" onclick="onlyOne(this)"  style="width:20px;height:20px;" value="3">
                                                                                 <label for="checkbox2"></label>-->
                                                                           </div>
                                                                        </div>
                                                                        <div class="p-2 w-100 bd-highlight">
                                                                           <p><strong> </strong>Repair the products at the customer premises, and accept to pay the sum of Rs 800 (transport charges) prior to delivery by bank transfer or cash in the showroom. Repair Date & Time will be determined by the factory through SMS.</p>
                                                                        </div>
                                                                     </div>
                                                                     <?php }?>
                                                                     <?php 
                                                                        if($cust->more_options == '4' ){?>
                                                                     <div class=" col-md-12 d-flex bd-highlight">
                                                                        <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                                           <div class="">
                                                                              <!---- <input type="checkbox" id="checkbox" name="more_options"  onclick="onlyOne(this)" style="width:20px;height:20px;"  value="4">
                                                                                 <label for="checkbox"></label>-->
                                                                           </div>
                                                                        </div>
                                                                        <div class="p-2 w-100 bd-highlight">
                                                                           <p><strong></strong>Repair will be done free of charge at our time convenience. We will give 1 day notice but unfortunately, a specific time cannot be provided.
                                                                           </p>
                                                                        </div>
                                                                     </div>
                                                                     <?php }?>
                                                                  </div>
                                                                </div>

                                                                <?php if(!empty($cust->more_options_date)){?>
                                                                    <div class="form-group">
                                                                     <strong style="margin-right:10px;">Date: <?php echo $cust->more_options_date;?> </strong>
                                                                   </div>
                                                                 <?php } else{

                                                                  if(!empty($cust->admin_more_options_date)){

                                                                  ?>
                                                                  <div class="form-group">
                                                                     <strong style="margin-right:10px;">Date: <?php echo $cust->admin_more_options_date;?> </strong>
                                                                   </div>

                                                                <?php } }?>

                                                                  <?php 
                                                if(!empty( $cust->simple_message)){?>

                                                 <div class="form-group">
                                                   <label> <strong style="margin-right:30px;">Message</strong></label>
                                                </br></br>
                                                    <div class="table-responsive">                                                 

                                                            <div class="form-group">   
                                                           <!--- <label for="exampleInputEmail">Message</label>-->      
                                                            <textarea class="form-control" name="simple_message"  id="exampleInputEmail" rows="3" disabled ><?php echo $cust->simple_message;?></textarea>
                                                            </div>                                                        
                                                  
                                                    </div>
                                                </div>
                                            <?php }?>




                                                              </form></div>
                               <?php } }}
                               else{?>


                                    <form method="post"  class="ajax_form">
                                       <div class="row text-left">
                                          <input type="hidden"  name="customer_id"  value="<?php echo $rep->customer_id;?>">
										  <input type="hidden"  name="email_id"  value="<?php echo $email_id;?>">
                                          <input type="hidden"  name="order_number"  value="<?php echo $rep->order_number;?>">
                                          <?php 
                                             if($rep->covered_by_warranty == 'Yes'){?>
                                          <div class="form-group">
                                             <strong style="margin-right:30px;">Covered by Warranty</strong>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"  required name="covered_by_warranty" id="inlineRadio1" <?php if($rep->covered_by_warranty == 'Yes'){?> checked <?php }?> value="Yes">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" required  name="covered_by_warranty" id="inlineRadio2"  <?php if($rep->covered_by_warranty == 'No'){?> checked <?php }?>  value="No">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                             </div>
                                          </div>
                                          <?php }?>
                                          <?php 
                                             if($rep->covered_by_warranty == 'No'){?>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">  <strong style="margin-right:30px;">Your Complaint is not covered by our warranty conditions for the following reason(s)</strong> </label>
                                             <?php 
											 $options = $rep->not_covered_by_warranty;
											 $getlate = explode(', ',$options);
											//echo '<pre>';print_r($rep);
											 foreach($getlate as $val){
												if($val == 'A'){ ?>
													<div class="form-check">
														<label class="" for="exampleRadios1">
														   1. Products mentioned on the receipt as promotional item, sold “as is, where is” are sold at discounted prices and do not have any warranty cover
														   <!--<input class="" type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios1" value="A" 
															  <?php if($val == 'A'){?> checked
															  <?php }?> > -->
														</label>
													 </div>
												<?php }
												if($val == 'B'){ ?>
													<div class="form-check">
														<label class="" for="exampleRadios1">
														    2. Guarantee covers only construction method, and excludes glass, mirror frame, fabrics, leather, any plastic parts and surface coating (paper, varnish, lacquer).
														   <!--<input class=""  type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios2" value="B" <?php if($val == 'B'){?> checked<?php }?>>-->
														</label>
													 </div>
												<?php }
												if($val == 'C'){ ?>
													<div class="form-check">
														<label class="" for="exampleRadios1">
														    3. After sale guarantee if any is limited to one year only as from date of purchase
														   <!--<input class=""  type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios3" 
															  value="C" <?php if($val== 'C'){?> checked <?php }?> >-->
														</label>
													 </div>
												<?php }
												if($val == 'D'){ ?>
													<div class="form-check">
														<label class="" for="exampleRadios1">
														    4. No guarantee is given
														   <!--<input class=""  type="checkbox" name="not_covered_by_warranty[]" id="exampleRadios3" 
															  value="D" <?php if($val== 'D'){?> checked <?php }?> >-->
														</label>
													 </div>
													 <?php 
														$noption = $rep->no_gurantee_option;
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
												<?php }
											 }  ?>
                                                
												<br>
												<?php
                                                if($rep->use_aftersale_service == 'Yes'){?>
												<div class="form-check checkonw">
													<label class="" for="exampleRadios6">
													<strong  style="margin-right:40px;margin-left:-20px;"> However as a customer gesture, we shall repair the items, please choose the following option below</strong>
													<span  style="width:20px;height:20px;" > <input class="" type="radio" name="check" id="exampleRadios6" value="Yes" style="width:20px;height:20px;"> Yes</span>
													<span style="margin-left:20px;width:20px;height:20px;"><input class="" type="radio" name="check" id="exampleRadios61" 
													   value="No" style="width:20px;height:20px;" checked> No </span>
													</label>
												 </div>
												 <div class="form-check yesno" style="display:none">
													<label class="" for="exampleRadios6">
													<strong  style="margin-right:40px;margin-left:-20px;"> Use AFTERSALE service despite not covered.</strong>
													<span  style="width:20px;height:20px;" > <input class=""  type="radio" name="use_aftersale_service" id="exampleRadios6" 
													   value="Yes"    style="width:20px;height:20px;" <?php  if($rep->use_aftersale_service == 'Yes'){ ?> checked <?php }?>> Yes</span>
													<span style="margin-left:20px;width:20px;height:20px;"><input class=""  type="radio" name="use_aftersale_service" id="exampleRadios61" 
													   value="No"  style="width:20px;height:20px;" <?php  if($rep->use_aftersale_service == 'No'){ ?> checked <?php }?>  >  No </span>
													</label>                                             
												 </div>
												<?php }?>
                                          </div>
                                          <?php }?>
                                          <?php if(!empty($order_container)){
                                             ?>
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
                                                <?php $i=1;  if($order_container!=null){
                                                   foreach ($order_container as $cls) { 
                                                   
                                                    if($cls->order_number == $rep->order_number){
                                                   
                                                   
                                                    ?>
                                                <tr>
                                                   <td><?php echo $i; ?></td>
                                                   <td><?php echo $cls->image_name; ?></td>
                                                   <td> <img src="<?php echo base_url('uploads/order_images/') ?><?php echo $cls->order_image; ?>" style="width: 100px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 100px; ">
                                                   </td>
                                                   <td><?php echo $cls->order_message; ?></td>
                                                </tr>
                                                <?php $i++;  } }  } ?>
                                             </tbody>
                                          </table>
                                          <?php }?>
                                          <?php if(!empty($additional_message)){
                                             ?>
                                          <div class=" col-md-12 ">
                                             <div class="form-group">
                                                <strong style="margin-right:30px;">Additional Comment</strong>
                                                </br></br>
                                                <div class="table-responsive">
                                                   <?php $i = 1 ; 
                                                      if(!empty($additional_message)){
                                                      
                                                      foreach($additional_message as $vwi){
                                                      
                                                      if($vwi->order_number == $rep->order_number){
                                                      
                                                       ?>
                                                   <div class="form-group">   
                                                      <label for="exampleInputEmail<?php echo $i;?>">Item <?php echo $i;?></label>      
                                                      <textarea class="form-control" name="items[]"  readonly  id="exampleInputEmail<?php echo $i;?>" rows="3"><?php echo $vwi->item_message;?></textarea>
                                                   </div>
                                                   <?php  $i++;}} } ?>
                                                </div>
                                             </div>
                                          </div>
                                          <?php }?>
                                          <div class=" col-md-12 ">
                                             <div class="col-md-6 user-select-date"  id="user-select-date">
                                                <div class="form-group">
                                                   <label for="exampleInputEmail1">Select Date Furniture will be brought to the Factory</label>
                                                   <input type="date" class="form-control  select-date-more-options"  name="more_options_date"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Select Date">                   
                                                </div>
                                             </div>
                                          </div>
                                          <div class=" col-md-12 d-flex bd-highlight">
                                             <div class="p-2 w-100 bd-highlight">
                                                <p><strong>(1) </strong>Own transport – Bring the furniture to Factory
                                                   .
                                                </p>
                                             </div>
                                             <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                <div class="">
                                                   <input type="radio" id="radioID" name="more_options"  style="width:20px;height:20px;" value="1">
                                                   <label for="checkbox2"></label>
                                                </div>
                                             </div>
                                          </div>
                                          <div class=" col-md-12 d-flex bd-highlight">
                                             <div class="p-2 w-100 bd-highlight">
                                                <p><strong>(2)</strong>Hire Private Contractor Transport To & From at Rs 800 per trip (Total Rs 1600) – 5865 3891.</p>
                                             </div>
                                             <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                <div class="">
                                                   <input type="radio" id="radioID" name="more_options"  style="width:20px;height:20px;"  value="2">
                                                   <label for="checkbox"></label>
                                                </div>
                                             </div>
                                          </div>
                                          <?php 
                                             if($replies[0]->more_options == '3' ){?>
                                          <div class=" col-md-12 d-flex bd-highlight">
                                             <div class="p-2 w-100 bd-highlight">
                                                <p><strong>(3) </strong>Repair at Premises (Rs 800) – Will be approved by Factory if repairs can be done at Home – Payment in Showroom at TFP Port Louis (Payment to be made prior to repairs).</p>
                                             </div>
                                             <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                <div class="">
                                                   <input type="radio" id="radioID" name="more_options"   style="width:20px;height:20px;"   value="3">
                                                   <!--<label for="checkbox3"></label>--->
                                                </div>
                                             </div>
                                          </div>
                                          <?php }?>
                                          <?php 
                                             if($replies[0]->more_options == '4' ){?>
                                          <div class=" col-md-12 d-flex bd-highlight">
                                             <div class="p-2 w-100 bd-highlight">
                                                <p><strong>(4) </strong>Repair will be done free of charge at our time convenience. We will give 1 day notice but unfortunately, a specific time cannot be provided.</p>
                                             </div>
                                             <div class="p-2 flex-shrink-1 bd-highlight sample">
                                                <div class="">
                                                   <input type="radio" id="radioID" name="more_options"   style="width:20px;height:20px;"  value="4">
                                                   <label for="checkbox4"></label>
                                                </div>
                                             </div>
                                          </div>
                                          <?php }?>
                                          </br><br>
                                          <table id="" class="table table-striped table-bordered nowrap" style="width:100%">
                                             <thead>
                                                <tr>
                                                   <th>
													<a href="https://appicsoftwares.in/development/furniture/assets/aftersale/img/Furniturem.jpeg" target="_blank" style="color: #000;text-decoration: none;">Our After-sale Terms & Conditions on your sales order read as follows: <br><br>
												   All after sale issues are handled at the factory located at Riche-Terre only. The buyer is responsible for the transportation to and from the factory since all equipment, machine, tools, materials, supervision are available there. We can recommend transport contractor to collect and redeliver the goods once repaired for charges varying from Rs 1,500 to Rs 2,000 depending on location.</a></th>
                                                </tr>
                                             </thead>
                                          </table>
                                          <div class="col-md-12">
                                             <div class="form-group mb-0 clearfix">
                                                <button type="submit" class="btn-md btn-theme customer-reply-submit-btn float-left">Submit</button>         
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                  <?php }?>
                                 </div>
                              </div>
                              <?php $i = 1;} }?>
                               <!-- <div class="tab-pane fade active show" role="tabpanel" id="register"> -->
                                 <div class="tab-pane fade  <?php if($i== 2){?>active show<?php }?>" role="tabpanel" id="panelChat">
                                 <div class="cuff">   
                                    <section>
                                         <div class="container">
                                             <div class="messaging">
                                                 <div class="inbox_msg">
                                                     <div class="inbox_people">
                                                         <div class="headind_srch">
                                                             <div class="recent_heading">
                                                                 <h4>Messaging</h4>
                                                             </div>

                                                             
                                                         </div>
                                                         
                                                     </div>
                                                     <div class="mesgs1">
                                                         

                                                         <div class="msg_history" id="messages_r">

                                                         </div>

                                                         <div class="type_msg">
                                                             <div class="input_msg_write">

                                                                 <form id="submit">
                                                                     <input id="message" name="comment" form="usrform">
                                                                     <button class="msg_send_btn" id="sub_msg" type="submit">
                                                                         SEND</button>
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
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="<?php echo base_url('assets/')?>aftersale/js/popper.min.js"></script>
   <script src="<?php echo base_url('assets/')?>aftersale/js/jquery-3.4.1.slim.min.js"></script>
   <script src="<?php echo base_url('assets/')?>aftersale/js/bootstrap.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      $(document).ready(function(){      
		$('.checkonw input').on('click',function(){
			var val = $(this).val();
			if(val=='Yes'){
				$('.yesno').show();
			}else{
				$('.yesno').hide();
			}
			console.log(val);
		})
        $('.ajax_form').on('submit',function(e){  
           e.preventDefault(); 
		   
		    if ($("input[name=more_options]:checked").length > 0) {
				var formData= new FormData(this);
				   formData.append('action','CustomerReplyForm');
				   $.ajax({
					   type: 'post',
					   url:'<?php echo base_url("Userdash/handleReply");?>',
					   cache: false,
					   data: formData,
					   processData: false,
					   contentType: false,               
					   beforeSend: function() {    
						$(".customer-reply-submit-btn").html('Submitting');   
						$(".customer-reply-submit-btn").prop('disabled', true);       
								   
					   },
					   success: function(data) {  
						   obj = JSON.parse(data);
						   if(obj.status=='true'){                     
							   setTimeout(function(){
								$(".customer-reply-submit-btn").prop('disabled', false);
								$(".customer-reply-submit-btn").html('Submit'); 
							   location.reload();                                     
							   }, 2000);                                          
						   }
					   }
				   });
			}else{
				alert('Choose atleast one option in more options');
			}
           
        });    
      
      
      $('.user-select-date').hide(); 
      
      
      $('input[type=radio][name=more_options]').change(function() { 
          if (this.value == '1') {  
              $('.user-select-date').show();
              $('.select-date-more-options').attr('required', 'required');
          }
          else if (this.value == '2') {
               $('.user-select-date').show();
               $('.select-date-more-options').attr('required', 'required');
          }else{
            $('.user-select-date').hide();
            $('.select-date-more-options').removeAttr('required');
          }
      });
      
    });
      
	


$(function () {
	            $(".msg_history").animate({
    scrollTop: $('.msg_history').get(0).scrollHeight
}, 2000);
});
   </script>
</html>