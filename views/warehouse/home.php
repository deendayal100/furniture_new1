 <?php include('header.php'); ?>
 
 
 <style>
     
     
.card{
    padding: 0px;
}
     
@media screen and (min-width: 300px) and (max-width: 480px){

    .card .card-block{padding: 20px 15px !important;}
    .card {max-width: 290px; display: block; margin-left: auto; margin-right: auto; padding: 0px;}

    
}

 </style>
 
  <div class="main-panel">
 
 <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->
            <div class="row">
            	<div class="col-xl-3 col-lg-6 col-md-6 col-12">
            		<div class="card gradient-blackberry">
            			<div class="card-body">
            				<div class="card-block pt-2 pb-0" style="height:130px;">
            					<div class="media">
            						<div class="media-body white text-left">
            							<h3 class="font-large-1 mb-0"><?php  echo  count($sent_to_rt);  ?></h3>
            							<span>SENT TO WAREHOUSE</span>
            						</div>
            						<div class="media-right white text-right">
            							<i class="fa fa-money font-large-1"></i>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
             <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            		<div class="card gradient-ibiza-sunset">
            			<div class="card-body">
            				<div class="card-block pt-2 pb-0" style="height:130px;">
            					<div class="media">
            						<div class="media-body white text-left">
            							<h3 class="font-large-1 mb-0"><?php echo count($item_to_pl); ?></h3>
            							<span>ITEMS TO RT</span>
            						</div>
            						<div class="media-right white text-right">
            							<i class="fa fa-money font-large-1"></i>
            						</div>
            					</div>
            				</div>

            			</div>
            		</div>
            	</div>
            	
            	<?php /*	<div class="col-xl-3 col-lg-6 col-md-6 col-12">
            		<div class="card gradient-green-tea">
            			<div class="card-body">
            				<div class="card-block pt-2 pb-0">
            					<div class="media">
            						<div class="media-body white text-left">
            							<h3 class="font-large-1 mb-0"><?php  echo count($drivers); ?></h3>
            							<span>Drivers</span>
            						</div>
            						<div class="media-right white text-right">
            							<i class="ft-share font-large-1"></i>
            						</div>
            					</div>
            				</div>
            				<div id="Widget-line-chart2 1" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">				
            				</div>
            			</div>
            		</div>
            	</div>
            	<div class="col-xl-3 col-lg-6 col-md-6 col-12">
            		<div class="card gradient-pomegranate">
            			<div class="card-body">
            				<div class="card-block pt-2 pb-0">
            					<div class="media">
            						<div class="media-body white text-left">
            							<h3 class="font-large-1 mb-0"><?php echo count($orders); ?></h3>
            							<span>Total Orders</span>
            						</div>
            						<div class="media-right white text-right">
            							<i class="ft-refresh-ccw font-large-1"></i>
            						</div>
            					</div>
            				</div>
            				<div id="Widget-line-chart3 1" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">					
            				</div>
            			</div>
            		</div>
            	</div> */ ?>
            </div>
            <!--Statistics cards Ends-->
            
          </div>
        </div>
<?php include('footer.php'); ?>