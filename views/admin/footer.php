</div>
 <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2018 <a href="#" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Furnituremu </a>, All rights reserved. </span></p>
        </footer>

      </div>
    </div>
    <?php if($this->uri->segment(2) == "Invoice" && $this->uri->segment(3) == "new"){ ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <?php }else{ ?>
    <script src="<?php echo base_url('assets/')?>vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <?php } ?>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
     <script>
    $(document).ready( function () {


        $('#other_reasons_input').hide();  
        var $radios = $('input[name=covered_by_warranty]').change(function () {
            var value = $radios.filter(':checked').val();
            if(value == 'Yes'){
                $('#other_reasons_input').hide();
            }else{
                $('#other_reasons_input').show();                   
            }  
            
        });


            

        //$( "#date-select-reply").datepicker();

        $('#date-select-reply').datepicker({ minDate: 0, maxDate: "+1M +30D" });



        $('#mytable').DataTable();
        $('#usertable').DataTable();
       /*  $('#usertable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } ); */
    } );   
	</script> 

   <script type="text/javascript">

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('more_options')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }


        $(document).ready(function(){

            $('#use_aftersale_service_radio').click(function(){
               // alert('hi');
                if($("input:radio[name='use_aftersale_service']").is(":checked")) { 
                   // $(this).prop('checked', true);                  
                }else{
                   // $(this).prop('checked',false); 
                }
                
            });

           /* if($("input:radio[name='yourRadioName']").is(":checked")) {
                  //its checked
            }*/

            $('#customer_order_reply_form').on('submit',function(e){ 
                e.preventDefault(); 
                var formData= new FormData(this);
                formData.append('action','CustomerReplyForm');
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url("admin/Custmers/customerReplyHandle");?>',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,               
                    beforeSend: function() {          
                        //$('.message-box').html('<h3>Article Adding</h3>');
                         $("#customer-reply-submit-btn").html('Submitting');   
                        $("#customer-reply-submit-btn").prop('disabled', true);          
                    },
                    success: function(data) {  
                        obj = JSON.parse(data);
                        if(obj.status=='true'){  
                            //$('#admin-answer').html(obj.answer);
                            /*if(obj.htmlii){
                                $('#message-id-admin').val(obj.htmlii);
                            } */  
                            setTimeout(function(){
                                 $("#customer-reply-submit-btn").prop('disabled', false);
                                  $("#customer-reply-submit-btn").html('Submit'); 
                                window.location.href = "<?php echo base_url("admin/Custmers/newCustomer");?>";                  
                            }, 2000);
                                               
                        }
                    }
                });
            });

             $('#customer_order_reply_form2').on('submit',function(e){ 
                e.preventDefault(); 
                var formData= new FormData(this);
                formData.append('action','CustomerReplyForm');
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url("admin/Custmers/customerReplyUpdate");?>',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,               
                    beforeSend: function() {          
                        //$('.message-box').html('<h3>Article Adding</h3>');
                         $("#customer-reply-submit-btn").html('Submitting');   
                        $("#customer-reply-submit-btn").prop('disabled', true);          
                    },
                    success: function(data) {  
                        obj = JSON.parse(data);
                        if(obj.status=='true'){  
                            //$('#admin-answer').html(obj.answer);
                            /*if(obj.htmlii){
                                $('#message-id-admin').val(obj.htmlii);
                            } */  
                            setTimeout(function(){
                                 $("#customer-reply-submit-btn").prop('disabled', false);
                                  $("#customer-reply-submit-btn").html('Submit'); 
                                window.location.href = "<?php echo base_url("admin/Custmers/responseCustomer");?>";                  
                            }, 2000);
                                               
                        }
                    }
                });
            });






            $('#image-hold-table').hide(); 


            $('#upload-order-image').on('submit',function(e){ 
                e.preventDefault(); 
                var formData= new FormData(this);
                formData.append('action','uploadOrderImage');
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url("admin/Custmers/uploadImageHandle");?>',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,               
                    beforeSend: function() {          
                        $('#donesubmit').prop("disabled", true);             
                    },
                    success: function(data) {  
                        obj = JSON.parse(data);
						$('#donesubmit').prop("disabled", false);
                        if(obj.status=='true'){
							
						//alert(obj.message);
                        $('#upload-order-image')[0].reset();
                        $('#exampleModal22').modal('hide');
                        $('#image-hold-table').show();                        
                        $('#add-image-content').html(obj.html);
                        
                            //$('#admin-answer').html(obj.answer);
                            /*if(obj.htmlii){
                                $('#message-id-admin').val(obj.htmlii);
                            } */                      
                        }
                    }
                });
            });
           

            $('.not-covered-box').hide();  
            var $radios = $('input[name=covered_by_warranty]').change(function () {
                var value = $radios.filter(':checked').val();
                if(value == 'Yes'){
                    $('.not-covered-box').hide();
                }else{
                    $('.not-covered-box').show();                   
                }  
                
            });


            


        });
    </script>

    <script>
    $('#admin-question-form').on('submit',function(e){ 
        e.preventDefault();
        var formData= new FormData(this);
        formData.append('action','AdminQueryForm');
        $.ajax({
            type: 'post',
            url:'<?php echo base_url("admin/Custmers/adminChat");?>',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,               
            beforeSend: function() {          
                //$('.message-box').html('<h3>Article Adding</h3>');             
            },
            success: function(data) {  
                obj = JSON.parse(data);
                if(obj.status=='true'){   
                $('#admin-answer').html(obj.answer);
                if(obj.htmlii){
                    $('#message-id-admin').val(obj.htmlii);
                }              
                 
                }
            }
        });
    });
    </script>
	
	<script type="text/javascript">
        $(document).ready(function(){
            $('#toggleList').click(function(){
                // alert('chal');
                $('.hide-sidebar').css('transform','translate3d(0, 0, 0)');
            });
            $('#sidebarClose').click(function(){
                $('.hide-sidebar').css('transform','translate3d(-100%, 0, 0)');
            });
        });
    </script>
    <script> 
        check_option();
        function check_option(){
            var option_selected = $('.checkSelected').find(":selected").attr('id');
            $('.btn-disable-onselect').attr('disabled','disabled');
        }
        $(document).ready(function() {
            $('.checkSelected').change(function() {
                $(".btn-disable-onselect").prop('disabled', this.value == 1);
            }).change();
        });
    </script>

  </body>

</html>