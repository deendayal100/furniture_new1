<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register/Login Aftersales</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/')?>aftersale/css/custom.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<style>
    .ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-draggable.ui-resizable {
    top: 12% !important;
}
</style>
<body>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$expl = explode('/',$actual_link);

$id = $expl[6];
?>
    <div class="login-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-section1">
                        <div class="logo-2">
                            <a href="#">
                                <img width="350px" height="100px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo">     </a>
                        </div>
                                <div class="cuff">
                                  
                                    <form action="#" method="POST" id="information">
                                        <h3>Fill The Details</h3>
                                        <div class="form-group form-box col-md-6">
                                            <label for="">Customer Name</label>
                                            <input type="text" name="name" id="name" class="input-text" placeholder="Name">
                                        </div>
                                        <div class="form-group form-box col-md-6">
                                            <label for="">Customer Phone</label>
                                            <input type="text" name="phone" id="phone" class="input-text" placeholder="Number">
                                        </div>
                                        <div class="form-group form-box col-md-6">
                                            <label for="">Customer Email</label>
                                            <input type="email" id="email" name="email" class="input-text" placeholder="Email">
                                        </div>
                                        <div class="form-group form-box col-md-6">
                                            <label for="">Customer Address</label>
                                            <input type="text" id="address" name="address" class="input-text" placeholder="Address">
                                        </div>
                                     
                                        <div class="maxwel">
                                            <div class="row p-4" id="cheap">
                                                <div class="form-group form-box col-md-6">
                                                    <label for="">Damage Item Code</label>
                                                    <div class="custom-length1 text-right aftrsale">
                                                        <a href="javascript:void(0)" id="btnShow"><i class="far fa-question-circle"></i></a> 
                                                    </div>
                                                    <input type="text" id="dmg_itemcode1" name="dmg_itemcode[1]" class="input-text" placeholder="Enter Code">
                                                </div>  
                                                <div class="form-group form-box col-md-6">
                                                    <label for="">Customer Address</label>
                                                    <input type="text" name="item_address[1]" id="item_address1" class="input-text" placeholder="Address">
                                                </div>
                                            <div class="col-sm-6 ">
                                                <button type="button" class="btn btn-warning btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
												<span>Customer Needs to select minimum 3 Images at a time</span>
                                                <div class="form-group inputDnD">
                                                  <label class="sr-only" for="inputFile">File Upload</label>
                                                  
                                                  <input name="images[1][]" class="input-text" accept="image/*" id="itemimage1" id="inputFile" type="file" data-title="Select and Upload Image" required> 

                                                  <input name="images[1][]" class="input-text" accept="image/*" id="itemimage1" id="inputFile" type="file" data-title="Select and Upload Image" required >

                                                  <input name="images[1][]" class="input-text" accept="image/*" id="itemimage1" id="inputFile" type="file" data-title="Select and Upload Image" required>

                                                  <!-- <div id="invp1" class="previwes">
                                                    
                                                      
                                                  </div> -->
                                                </div>
                                              </div>
                                              <div class=" col-sm-6 ">
                                                <button type="button" class="btn btn-warning btn-block" onclick="document.getElementById('inputFile').click()">Add Invoice</button>
                                                <div class="form-group inputDnD">
                                                  <label class="sr-only" for="inputFile">File Upload</label>
                                                  <input type="file" name="invoices[1]" class="form-control-file text-warning font-weight-bold readInvoice" id="iteminvoices1" accept="image/*" data-title="Select and Upload Image" data-preview="1">
                                                  <div id="previwes1" class="previwes">
                                                      <img src="" id="output1" class="output"></img><span style="display:none;" id="invo1" class="invo1" data-id="1" >X</span>
                                                      
                                                  </div>
                                                </div>
                                                <div class="custom-length2 text-right aftrsale"> <a href="javascript:void(0)" id="btnShow1"><i class="far fa-question-circle"></i></a>
                                                    
                                              </div>
                                            </div>

                                            <div class="form-group form-box col-md-12">
                                                <label for="">How did the Damage Occurred ?</label>                         
                                                <textarea class="input-text  form-control"  rows = "7"  id="damaged_message1" name="damaged_message[1]" placeholder="Enter Message" ></textarea>
                                            </div>  

                                             
                                        </div><!-- end row -->


                                        </div><!--- end maxwell -->
                                        <div class="wrapper">
                                            <div class="form-groupform-box mb-0 clearfix">
                                              <button type="button" id="addMe" class="btn-md2 btn-theme float-left">Add More Item</button>
                                            </div>
                                        </div>
                                            
                                            <div class="form-section1 word">
                                                <div class="logo-2">
                                                    <a href="#">
                                                        <img width="350px" height="100px" src="<?php echo base_url('assets/')?>img/Furniture_mu.jpg" alt="logo">
                                                    </a>
                                                </div>
                                                <h2 class="text-center terms">Warranty & After Sales</h2>
                                                <h6 class="text-center products">Products mentioned on the receipt as promotional item, sold “as is,where is”<br> are sold at discounted prices and do not have any warranty cover.<br> All after sale repairs done for such products will be charged.</h6>
                                                <hr>
                                                <div class="row text-left">
                                                   <div class="col-md-12 terms1">
                                                      <ul class="term-list">
                                                         <li> AFTERSALE SHALL BE REPORTED EXCLUSIVELY ON OUR AFTERSALE WEBSITE (<a href="https://aftersale.furniture/furniture.mu/Register/">aftersale.furniture</a>). NO COMPLAINT WILL BE
TAKEN VERBALLY OR IN THE SHOWROOM. The online system allow us to record and attend all aftersales complaints systematically & promptly as verbal
complaints are difficult to track and monitor. Sales is being made conditionally if this requirement can be complied with. </li>
                                                         <li>Guarantee covers only construction method, and excludes glass, mirror frame, handles, locks,Foam, upholstery (eg fabric, leather etc.), any plastic parts, surface
coating (paper, varnish, lacquer), rusts and damages caused by liquid, insects or molds.</li>

                                                         <li>All after sale issues are handled at the factory located at Riche-Terre only. The buyer is responsible for the transportation to and from the factory since all
equipment, machine, tools, materials, supervision are available there. We can recommend transport contractors to collect and redeliver the goods and transport fees
to be negotiated directly with them.</li>
                                                         <li>Customers who wish to have their repair done at their house whenever possible, must pay a transportation charge in the showroom prior to repair.</li>
                                                         <li>After sale guarantee if any is limited to one year only as from date of purchase and no warranty applies if so is mentioned on the Sales Order.</li>
                                                         <li><strong>No guarantee is given</strong><br>
                                                             (i)  for materials and timber against woodborers, termites & other insects  <br>
                                                             (ii)  No guarantee is given against growth of fungus due to climatic
environment (“Moisissure”)<br>(iii) against changes of surface, mirrors, varnish, plating of hinges, handles ,fittings due to climatic condition, color fading due to sunlight
, wear and tear of covering material i.e. PVC and fabric.<br> (iv) Any misuse or not for the purpose intended and designed for. <br>(v) any parts other than the gas lift for
office chairs products  <br> (vi) lighting products including bulbs<br> (vii) TV Brackets and its fittings <br>(viii) Any electrical & electronic part that comes with the furniture.</li>
                                                         <li><strong>The Seller is not liable</strong><br>
                                                             (i) for customers traveling in the company’s vehicles.  <br>
                                                             (ii)  For customers giving free and unaccompanied access to employees in their premises & missing or stolen properties. <br>
                                                             (iii) For customers allowing employees to fix or bolt any furniture or fixtures, which might turn loose..<br> 
                                                             (iv) For customers not supervising the mounting of furniture at their premises, which later can become loose and cause injuries. <br>
                                                             (v) Gifts offered by the Seller do not form part of the sale transaction between the Seller and the customer. Gifts offered can change without prior notice and are not covered by any guarantee.   <br> 
                                                             (vi) for failing to follow the designated Sanitary protocols.  Our liability if any such not exceed Rs 5,000 per transaction.<br>
                                                      </ul>
                                                   </div>
                                                </div>
                                                <div class="link-term text-left">
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 clearfix">
												<div class="checkbox">
													<input type="checkbox" class="input-text" id="tc" name="tc" value="yes">
													<label class="tcand">I have read the Terms & Conditions</label>
											   </div>
											   
												<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
												<input type="hidden" id="date" name="date" value="<?php echo date("d-M-Y", strtotime($_GET['date'])); ?>">
                                                <button type="submit" id="registerCust" class="btn-md btn-theme float-left">Submit</button>
												<input type="reset" id="resetRegi" value="reset" style="display:none">
												<span id="rgMsg"></span>
                                            </div> 
                                        </div>
                                       
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="random-num" value="400">
     <input type="hidden" name="index" name="list[1]" id="index" value="1">
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/')?>aftersale/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/')?>aftersale/js/jquery.validate.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
 <div  id="show-box-script">
    </div>
<script type="text/javascript">
$(document).ready(function(){
    $(".previwes img").each(function() {
        var atr = $(this).attr("src"); 
        if(atr == "") {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
jQuery.validator.addMethod("alpha_email", function(e, a) {
	return this.optional(a) || e.toLowerCase() == e.toLowerCase().match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/)
}, 'Please choose valid email-address.');

jQuery(document).ready(function(){ 
    jQuery.validator.addClassRules("form-control-file", {
	required: true,
});

jQuery('#addMe').click( function(){
	add_inputs(); 
	$(".previwes img").each(function() {
        var atr = $(this).attr("src"); 
        if(atr == "") {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});

function add_inputs(){
	var indexVal =jQuery("#index").val();
	var index = parseInt(indexVal) + 1
	var html ='<div class="row p-4" id="cheap1"><div class="form-group form-box col-md-6"><label for="">Damage Item Code</label><div class="custom-length1 text-right aftrsale"><a href="javascript:void(0)"><i class="far fa-question-circle"></i></a></div><input type="text"  name="dmg_itemcode['+index+']"  id="dmg_itemcode'+index+'" class="input-text" placeholder="Enter Code"></div><div class="form-group form-box col-md-6"><label for="">Customer Address</label><input type="text" id="item_address'+index+'"  name="item_address['+index+']"  class="input-text" placeholder="Address"></div> <div class="col-sm-6 "><button type="button" class="btn btn-warning btn-block" onclick="document.getElementById("inputFile").click()">Add Image</button><span>Customer Needs to select minimum 3 Images at a time</span><div class="form-group inputDnD"><label class="sr-only" for="inputFile">File Upload</label><input id="itemimage'+index+'" type="file" name="images['+index+'][]" class="input-text" id="inputFile" accept="image/*" data-title="Drag and drop a file" required=""><input id="itemimage'+index+'" class="input-text" type="file" name="images['+index+'][]"  id="inputFile" accept="image/*" data-title="Drag and drop a file" required=""><input id="itemimage'+index+'" type="file" class="input-text" name="images['+index+'][]"  id="inputFile" accept="image/*" data-title="Drag and drop a file" required=""><div id="invp'+index+'" class="previwes"> </div> ';
	
    html +='<script> $("#itemimage'+index+'").on("change",function(){  $(".rows_"+g+" img").show(); var allFiles = this.files; var g=1; for (let i = 0; i < allFiles.length; i++) { var src = URL.createObjectURL(allFiles[i]); $("#invp'+index+'").prepend("<div class=rows_"+g+"><img src="+src+" class=output></img><span data-number="+g+" class=vixWb>X</span></div>"); g++; } }); <\/script>';
    
    html +='<script>$(".vixWb").on("click",function(){ var number = $(this).data("number"); $(".rows_"+number).remove();})<\/script>';
    
	html +='</div></div>  <div class=" col-sm-6 "><button type="button" class="btn btn-warning btn-block" onclick="document.getElementById("inputFile").click()">Add Invoice</button><div class="form-group inputDnD"><label class="sr-only" for="inputFile">File Upload</label><input id="iteminvoices'+index+'" type="file" name="invoices['+index+']" class="form-control-file text-warning font-weight-bold readInvoice" id="inputFile" accept="image/*" data-title="Drag and drop a file"  data-preview="'+index+'"><div id="previwes'+index+'" class="previwes"><img src="" id="output'+index+'" class="output"></img><span style="display:none;" id="invo'+index+'" class="invo1" data-id="'+index+'" >X</span><script> var check = $("#output'+index+'").attr("src"); if(check==""){$("#output'+index+'").hide();} $("#invo'+index+'").on("click",function(){ $("#output'+index+'").attr("src",""); $(this).hide(); $("#output'+index+'").hide(); }); $("#iteminvoices'+index+'").on("change",function(){  $("#invo'+index+'").show(); var output = document.getElementById("output'+index+'"); $(output).show(); output.src = URL.createObjectURL(this.files[0]); output.onload = function() { URL.revokeObjectURL(output.src)} }) <\/script></div></div><div class="custom-length2 text-right aftrsale"><a href="javascript:void(0)"><i class="far fa-question-circle"></i></a></div></div><div class="form-group form-box col-md-12"><label for="">How did the Damage Occurred ?</label><textarea class="input-text  form-control"  rows = "7"  id="damaged_message'+index+'" name="damaged_message['+index+']" placeholder="Enter Message" ></textarea> </div>  ';
		html += '<button class="btn btn-danger remove_course_btn">Remove</button></div></div>'; 
		jQuery('.maxwel').append(html);
		jQuery("#dmg_itemcode"+index).rules("add", "required");
		jQuery("#item_address"+index).rules("add", "required");
		jQuery("#itemimage"+index).rules("add", "required");
		jQuery("#iteminvoices"+index).rules("add", "required");
		jQuery("#index").val(index);
}


    jQuery(this).on("click",".remove_course_btn",function(){
       var target_input = jQuery(this).parent();
        target_input.remove();
    }) 
})



jQuery('form#information').on('submit', function(event) {
    jQuery('.input-text').each(function() { 
        jQuery(this).rules("add",{
			required: true,
			messages: {
				required: "This field is required",
			}
		});
    });
});

jQuery("#information").validate({
	submitHandler: function(form) {   
       var formData= new FormData(jQuery('#information')[0]);
		jQuery.ajax({
			type: 'post',
			url: "<?php echo base_url('Register/step2')?>",
			cache: false,
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function() {
				jQuery('#registerCust').text('Submitting...');
				//jQuery('#registerCust').attr('disabled','disabled');
			},
			success:function(data) {      
				var obj = JSON.parse(data);
				if(obj.status==true){
					var id = obj.id;
					jQuery('#rgMsg').css('display','block').html("<p style='color:red'><b>APPLICATION SUBMITTED SUCCESSFULLY </b></p>");
					jQuery('#registerCust').text('Submit');
					setTimeout(function(){
					   jQuery('#registerCust').removeAttr('disabled');
					   jQuery('#rgMsg').css('display','none').html('');  
					   window.location = "<?php echo base_url('Register/success'); ?>";
					  }, 2000);
						jQuery('#resetRegi').trigger('click');
				}else{
					jQuery('#registerCust').text('Submit');
					jQuery('#registerCust').removeAttr('disabled');
					jQuery('#rgMsg').css('display','block').html(obj.message);
					setTimeout(function(){
					   jQuery('#rgMsg').css('display','none').html('');
					}, 3000);
				}
			}
		});
		/* if(jQuery('#tc').is(':checked')){
         
		}else{
			jQuery('#rgMsg').css('display','block').html("<p style='color:red'><b>Please accept Term And conditions</b></p>");
			setTimeout(function(){
			   jQuery('#rgMsg').css('display','none').html('');
			}, 4000);
		} */
	}
});


$('#invoin1').on('click',function(){
    $('#invoutput1').attr('src','');
    $('#invoutput1').hide();
    $(this).hide();
})

$('#invoin2').on('click',function(){
    $('#invoutput2').attr('src','');
    $('#invoutput2').hide();
    $(this).hide();
})

$('#invoin3').on('click',function(){
    $('#invoutput3').attr('src','');
    $('#invoutput3').hide();
    $(this).hide();
})

$('#itemimage1').on('change',function(){
    $(".ap img").show();
    var allFiles = this.files;
    var g=1;
    for (let i = 0; i < allFiles.length; i++) {
        var src = URL.createObjectURL(allFiles[i]);
        console.log('src - '+src);
        $("#invp1").prepend('<div class="ap rows_'+g+'"><img src="'+src+'" id="invoutput'+g+'" class="output"></img><span id="invoin'+g+'" class="invo1 threeVax" data-number="'+g+'" data-nax="invp1">X</span></div><script>$(".threeVax").on("click",function(){ var number = $(this).data("number"); var nax = $(this).data("nax"); $(".rows_"+number).remove();})<\/script>');
        g++;
    }
})


/*$('.threeVax').on('click',function(){
    var number = $(this).data('number');
    alert('test - '+ number);
    var nax = $(this).data('nax');
    $('.rows_'+number).remove();
})*/
$('.invo1').on('click',function(){
    var number = $(this).data('id');
    $('#output'+number).attr('src','');
    $('#output'+number).hide();
    $(this).hide();
})
$('.readInvoice').on('change',function(){
    
    var number = $(this).data('preview');
    var output = document.getElementById('output'+number);
    $(output).show();
    output.src = URL.createObjectURL(this.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
    $('#invo'+number).show();
})
$(function () {
var fileName = "Invoice Image";
$(".aftrsale a").click(function () {
	$("#dialog").dialog({
		modal: true,
		title: fileName,
		width: 440,
		height: 450,
		buttons: {
			Close: function () {
				$(this).dialog('close');
			}
		},
		open: function () {
			var object = "<img src=\"https://aftersale.furniture/furniture.mu/assets/aftersale/img/invoice.jpg\">";
			$("#dialog").html(object);
		}
	});
});
});

</script>

	
<style>
    	    
    @media (max-width:767px) {
    
    .form-section .logo-2 img {
            width: 100%;
            height: auto;
        }
    }
</style>

<div id="dialog" style="display: none"></div>