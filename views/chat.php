<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="shortcut icon" href="<?php echo base_url('application/')?>/images/favicon.png">
		<title>Chat</title>
		
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/owl.carousel/css/owl.carousel.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/owl.carousel/css/owl.theme.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/fontawesome-5.7.2-web/css/all.min.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/vendors/animate/css/animate.css" />
		<link rel="stylesheet" href="<?php echo base_url('application/')?>assets/css/style.css" />
		<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    
    <!--<link rel="stylesheet" href="css/style.css">-->
    <!------ Include the above in your HEAD tag ---------->
    <title>Messages</title>

    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
   <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-analytics.js"></script> 
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-firestore.js"></script>
   

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration

  const firebaseConfig = {
  apiKey: "AIzaSyB03FfsqQr1FiTuXKEWezpMAfKaFAtwblA",
  authDomain: "furniture-7c5ae.firebaseapp.com",
  databaseURL: "https://furniture-7c5ae-default-rtdb.firebaseio.com",
  projectId: "furniture-7c5ae",
  storageBucket: "furniture-7c5ae.appspot.com",
  messagingSenderId: "920386007553",
  appId: "1:920386007553:web:ee05f00828d58976748600"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
    <script>
        var msgRef=firebase.database().ref("furniture_mu_messages");
        
       
        $(document).ready(function(){
        	 
        	var callAjax = function(){
        	$.ajax({
                  url: "<?php echo base_url('admin/Custmers/read')?>",
                  type: "post",
                  data: {userId:'<?php echo $customer->firebase_id; ?>'} ,
                  success: function (response) {                       
                          
                    },
                  error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                      }
               });
        }
        callAjax();
         setInterval(callAjax,3000);



            $("#submit").on('submit',function(e){
                e.preventDefault()
                //alert('message');
               // return false;
                var message = $("#message").val();

            // save in database
            var w = (new Date()).toDateString("YYYY-MM-DD")
            var today = new Date();

            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = w.slice(4, 10) + ' ' + time;
            msgRef.push().set({
                "sender_id": '<?php echo $admin_firebase_id; ?>',
                "sender": 'vinod',
                "receiver_id": '<?php echo $customer->firebase_id; ?>',
                "message": message,
                "time": dateTime,
            });
            $("#message").val('');
            // prevent form from submitting
            //window.location="http://127.0.0.1/your_audition/chat_a?q={{$query}}";
            });

              $('input').keyup(function(event) {
                    if (event.which === 13)
                    {
                        event.preventDefault();
                        $('form').submit();
                    }
                });  

            
        });
        
    </script>
   
    <script>
        // listen for incoming messages
        firebase.database().ref("furniture_mu_messages").orderByKey().on("child_added", function(snapshot) {
            var html = "";
            var html1 = "";
            // give each message a unique ID
           
            // show delete button if message is sent by me
            if (snapshot.val().sender_id == '<?php echo $admin_firebase_id; ?>' && snapshot.val().receiver_id == '<?php echo $customer->firebase_id; ?>') {
              
                html += "<div class='chat_message chat_right'><p  id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "";
                html += "<time>";
                html += snapshot.val().time
                html += "</time><br/></p></div>";
                // console.log(snapshot.val());
                // console.log('send');
            }else if (snapshot.val().sender_id =='<?php echo $customer->firebase_id; ?>' && snapshot.val().receiver_id == '<?php echo $admin_firebase_id; ?>') {
                
                html += "<div class='chat_message chat_left'><p id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "";
                html += "<time>";
                html += snapshot.val().time
                html += "</time></p></div>";
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
		<section class="chat_box_section">
			<div class="container-fluid">
				<div class="row">
					<!--<div class="col-md-3 chat_users_box">
						<div class="input-group user_search_box">
							<input type="text" class="form-control" id="search_user" placeholder="Search">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-search"></i></span>
							</div>
						</div>  
						<div class="chatuser_list">
							<div class="user_box online active">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Online</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name <span class="float-right badge badge-secondary">5</span></h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							 <div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name<span class="float-right badge badge-secondary">2</span></h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name<span class="float-right badge badge-secondary">1</span></h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name<span class="float-right badge badge-secondary">8</span></h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>Users Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div>
							<div class="user_box away">
								<img src="images/user.jpg"/>   
								<div class="user_box_body">
									<h4>User Name</h4>   
									<small><i class="fas fa-circle"></i> Away</small>
								</div>
							</div> 
						</div>
					</div> -->
					<!-- <div class="col-md-9 chat_front_user_box">
						<div class="chat_front_user_main">
							<div class="chat_front_user_body">
								<h1 class="text-center mb-4">Welcome, User Name</h1> 
								<div class="userprofile_box">
									<img src="images/user.jpg"/>  
									<small><i class="fas fa-circle"></i></small>
								</div>
							</div>
							<div class="chat_front_user_footer text-center">
								<p>You are signed in as testuser@gmail.com</p>
								<p>Try <a href="javascript:void(0);">switching accounts</a> if you do not see your contacts or conversation history. <br><a href="javascript:void(0);" class="learn_more">Learn More</a></p>
							</div>
						</div>
					</div> -->
					<div class="col-md-9 chat_content_box">
						<div class="mobile_back d-none">
							<button class="btn chatback_btn"><i class="fas fa-long-arrow-alt-left"></i></button> 
						</div>
						<div class="user_box online">
							<img src="<?php echo base_url('application/')?>images/user.jpg"/>   
							<div class="user_box_body">
								<h4><?php echo $customer->name ; ?></h4>   
								<small><!--<i class="fas fa-circle"></i>--> Order Number - <?php echo $customer->password ; ?></small>
							</div>
						</div> 
						<div class="userchat_body" id='messages_r'>
							
							<!-- MESSAGE TAKE PLACE HERE   -->
							
						</div>
						<div class="chatfooter_submit">
							 
								<form id="submit">
							<div class="input-group user_submit_chat">
								
                                    <input id="message" type='text' class="form-control" placeholder="Type a message" name="comment" form="usrform">
                                    <div class="input-group-append">
                                    <button class="input-group-text" type="submit">
                                        SEND</button>
                                        </div>
								
								
									<!-- <span class="input-group-text"><i class="fab fa-telegram-plane"></i></span> -->
								
							</div> 
                                </form>
						</div>
					</div>
				</div>		
			</div>  	
		</section>
	</body>
</html>
<script src="<?php echo base_url('application/')?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url('application/')?>assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('application/')?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('application/')?>assets/vendors/owl.carousel/js/owl.carousel.js"></script>
<script src="<?php echo base_url('application/')?>assets/vendors/animate/js/wow.js"></script>
<script src="<?php echo base_url('application/')?>assets/js/style.js"></script>

<script>
	jQuery('.chat_content_box').show();
	jQuery('.user_box').click(function(){
		jQuery('.chat_content_box').show();
		jQuery('.chat_front_user_box').hide();
	});
	
	jQuery('.emoji_box_open').hide();
	$(document).ready(function(){
		$(".emoji_btn_click").click(function(){
			$(".emoji_box_open").toggle();
		});
	});
	
	// mobile media show hide  //
	if (matchMedia('only screen and (max-width:767px)').matches) {
		jQuery('.chat_front_user_box').hide();
		jQuery('.user_box').click(function(){
			jQuery('.chat_content_box').show();
			jQuery('.chat_users_box').hide();
		});
		jQuery('.chatback_btn').click(function(){
			jQuery('.chat_content_box').hide();
			jQuery('.chat_users_box').show();
		});
	}
	var messageBody = document.querySelector('.userchat_body');
	messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
</script>

