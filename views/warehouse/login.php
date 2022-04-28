<!DOCTYPE html>
<html lang="en" class="loading">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Furniture.mu</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>vendors/css/chartist.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/')?>css/app.css">
    <style>
        .card .card-img.overlap {
    margin-top: 0px;
}
.card {
    padding: 30px 0px 0px;
    border: 1px solid #dadada;
}
    </style>
</head>
<body data-col="1-column" class=" 1-column  blank-page blank-page">
  <div class="wrapper">
      <div class="main-panel no_mrg">
        <div class="main-content">
            <div class="content-wrapper">
                <section id="login">
                    <div class="container-fluid">
                        <div class="row full-height-vh">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card gradient-indigo-purple text-center width-400">
                                    <div class="card-img overlap">
                                        <img width="350px" height="100px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo"> 
                                        <!--<p style="font-size: 30px;color:#fb821f;"> Furniture.mu</p>-->
                                    </div>
                                    <div class="card-body">
                                        <div class="card-block">
                                            <h2 class="white" style="color: #fb821f !important;font-weight: 600 !important;">Login</h2>
                                            <form action="<?php echo base_url('warehouse/Login/log')?>" method="post">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email" required >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="password" class="form-control" name="inputPass" id="inputPass" placeholder="Password" required>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <div class="col-md-12">
                                                        <p id="question"></p>
														<input id="ans" type="text" class="form-control">
														<div id="message">Please verify.</div>
														<div id="success">Validation complete :)</div>
														<div id="fail">Validation failed :(</div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" name="submit" value="submit" class="btn btn-pink btn-block btn-raised" style="background-color:#fb821f;color: #fdfbfb;">Submit</button>
                                                    </div>
                                                </div>
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
    </div>

    <script src="<?php echo base_url('assets/')?>vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>vendors/js/pace/pace.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/')?>vendors/js/chartist.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/')?>js/app-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>js/notification-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/')?>js/customizer.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/')?>js/dashboard1.js" type="text/javascript"></script>
	<script>
	var total;

	function getRandom(){return Math.ceil(Math.random()* 20);}
	function createSum(){
			var randomNum1 = getRandom(),
				randomNum2 = getRandom();
		total =randomNum1 + randomNum2;
	  $( "#question" ).text( randomNum1 + " + " + randomNum2 + "=" );  
	  $("#ans").val('');
	  checkInput();
	}

	function checkInput(){
			var input = $("#ans").val(), 
			slideSpeed = 200,
		  hasInput = !!input, 
		  valid = hasInput && input == total;
		$('#message').toggle(!hasInput);
		$('button[type=submit]').prop('disabled', !valid);  
		$('#success').toggle(valid);
		$('#fail').toggle(hasInput && !valid);
	}

	$(document).ready(function(){
		//create initial sum
		createSum();
		// On "reset button" click, generate new random sum
		$('button[type=reset]').click(createSum);
		// On user input, check value
		$( "#ans" ).keyup(checkInput);
	});
	</script>
</body>

</html>