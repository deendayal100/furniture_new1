<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="shortcut icon" href="/images/favicon.png">
		<title>Web Chat main</title>
		
		<link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/vendors/owl.carousel/css/owl.carousel.css" />
		<link rel="stylesheet" href="assets/vendors/owl.carousel/css/owl.theme.css" />
		<link rel="stylesheet" href="assets/vendors/fontawesome-5.7.2-web/css/all.min.css" />
		<link rel="stylesheet" href="assets/vendors/animate/css/animate.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
		
	</head>
	<body>
		<section class="chat_box_section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 chat_users_box">
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
					</div> 
					<div class="col-md-9 chat_front_user_box">
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
					</div>
					<div class="col-md-9 chat_content_box">
						<div class="mobile_back d-none">
							<button class="btn chatback_btn"><i class="fas fa-long-arrow-alt-left"></i></button> 
						</div>
						<div class="user_box online">
							<img src="images/user.jpg"/>   
							<div class="user_box_body">
								<h4>User Name</h4>   
								<small><i class="fas fa-circle"></i> Online</small>
							</div>
						</div> 
						<div class="userchat_body">
							<div class="chat_message chat_left">
								<img src="images/user.jpg"/> 
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<time>8:40 am</time>
								</p>
							</div>
							<div class="chat_message chat_right">
								<p>
									Lorem Ipsum is simply dummy text of the printing
									<time>8:40 am</time>
								</p>
								<img src="images/user.jpg"/> 
							</div>
							<div class="chat_message chat_left">
								<img src="images/user.jpg"/> 
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<time>8:40 am</time>
								</p>
							</div>
							<div class="chat_message chat_right">
								<p>
									Lorem Ipsum is simply dummy text of the printing
									<time>8:40 am</time>
								</p>
								<img src="images/user.jpg"/> 
							</div> 
							
							<div class="chat_old_messsage_date">
								<span>24 May 2019</span> 
							</div>
							
							<div class="chat_message chat_left">
								<img src="images/user.jpg"/> 
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<time>8:40 am</time>
								</p>
							</div>
							<div class="chat_message chat_right">
								<p>
									Lorem Ipsum is simply dummy text of the printing
									<time>8:40 am</time>
								</p>
								<img src="images/user.jpg"/> 
							</div> 
							
							<div class="chat_old_messsage_date">
								<span>Tuesday</span> 
							</div>
							
							<div class="chat_message chat_left">
								<img src="images/user.jpg"/> 
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<time>8:40 am</time>
								</p>
							</div>
							<div class="chat_message chat_right">
								<p>
									Lorem Ipsum is simply dummy text of the printing
									<time>8:40 am</time>
								</p>
								<img src="images/user.jpg"/> 
							</div> 
							
							<div class="chat_old_messsage_date">
								<span>Today</span> 
							</div>
							
							<div class="chat_message chat_left">
								<img src="images/user.jpg"/> 
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<time>8:40 am</time>
								</p>
							</div>
							<div class="chat_message chat_right">
								<p>
									Lorem Ipsum is simply dummy text of the printing
									<time>8:40 am</time>
								</p>
								<img src="images/user.jpg"/> 
							</div>
						</div>
						<div class="chatfooter_submit">
							<div class="col-md-12">
								<div class="emoji_box emoji_box_open" id="emoji_box_open">
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
									<i class="em em---1"></i> 
									<i class="em em-astonished"></i>
									<i class="em em-baby"></i>
									<i class="em em-blush"></i>
									<i class="em em-cry"></i>
									<i class="em em-disappointed"></i>
									<i class="em em-face_with_rolling_eyes"></i>
									<i class="em em-face_with_hand_over_mouth"></i>
								</div>  
							</div>  
							<div class="input-group user_submit_chat">
								<div class="input-group-prepend emoji_btn_click" id="emoji_btn_click">
									<span class="input-group-text"><i class="far fa-surprise"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Type a message" value="">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fab fa-telegram-plane"></i></span>
								</div>
							</div> 
						</div>
					</div>
				</div>		
			</div>  	
		</section>
	</body>
</html>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/owl.carousel/js/owl.carousel.js"></script>
<script src="assets/vendors/animate/js/wow.js"></script>
<script src="assets/js/style.js"></script>

<script>
	jQuery('.chat_content_box').hide();
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

