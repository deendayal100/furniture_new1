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
    <script src="<?php echo base_url('assets/')?>js/horizontal-timeline.min.js" type="text/javascript"></script>
     <script>
    $(document).ready( function () {
        $('#mytable').DataTable();
        $('#usertable').DataTable();
        $('#mytable111').DataTable();
       /*  $('#usertable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } ); */
    } );   
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
    <script type="text/javascript">
        driver_status();
        $(document).ready(function(){
            $('.nav-tabs li a').click(function(){
                $('.nav-tabs li').siblings().removeClass('active');
                $('.nav-tabs li a').removeClass('active');
                $(this).parent().addClass('active');
            });
        });
               
        // function driver_status(){
        //     var option_selected = $('.driverStatus').find(":selected").val();
        //     if(option_selected == 'WITH DRIVER'){
        //         $('.btnDriverStatus').attr('disabled','disabled');
        //     }
           
        // }

        // function driver_status(){
        //     const nodeList = document.querySelectorAll(".driverClass");
        //     //console.log(nodeList);
        //     for (let i = 0; i < nodeList.length; i++) {
        //         var k = nodeList[i].getAttribute('value');
        //         if(k == 'WITH DRIVER'){
        //             for(let j = 0; j < nodeList.length; j++){
        //                 if(nodeList[j].selected == true){
        //                     console.log(15);
        //                 }else{
        //                    // console.log(16); 
        //                 }
        //                 //nodeList[j].disabled = true;
        //             }
        //             $('.btnDriverStatus').attr('disabled','disabled');
        //         }
        //     }
           
        // } 

        function driver_status(){
           var id_selected = document.querySelector('.driverStatus').selectedIndex;
           var selected_val = document.querySelector('.driverStatus')[id_selected].getAttribute('value');
           if(selected_val == 'WITH DRIVER'){
                const nodeList = document.querySelectorAll(".driverClass");
                for (let i = 0; i < nodeList.length; i++) {
                    nodeList[i].disabled = true;
                }
                $('.btnDriverStatus').attr('disabled','disabled');
           }
        } 

       
        
       
    </script>

  </body>

</html>