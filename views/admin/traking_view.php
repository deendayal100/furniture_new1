  <?php include("header.php") ; ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
      .nav-tabs .nav-link {

    height: 100%;
    font-size: 15px;
    padding: 0.5rem 10px;
}

.nav-tabs .nav-item {

    min-width: 40%;
    text-align: center;
    min-width: 32% !important;
    width: 32% !important;

}
  </style>
   <style>
     
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
        <div class="content-header">Order Tracking
		<a href="<?php echo base_url('admin/Tracking') ?>" >
             
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

 
 <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#sec1" aria-expanded="false">
                            Customer Details
                        </a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#sec2" aria-expanded="false">
                            Call/SMS Details
                        </a>
                    </li>
                    
                     <li class="nav-item">
                        <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#sec3" aria-expanded="false">
                            Track Order
                        </a>
                    </li>
                </ul>
                
                
                
                <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="sec1" aria-expanded="false" aria-labelledby="base-tab1">
             <section id="about">
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header padding-set">
                                <h5>Customer Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                              
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->name?></span>
                                                </li>
                                                 
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Address  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->txtAddress?></span>
                                                
                                                
                                                </li>
                                                 
                                                 
                                               
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                 
                                             <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Mobile :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->mobile?></span>
                                                    </li>
                                                     
                                                    
                                                
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                               
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Customer Phone :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->phone?></span>
                                                </li>
                                                
                                                    
                                                
                                              
                                            </ul>
                                        </div>
                                      
                                    </div>

                                   
                                    
                                </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-header padding-set">
                                <h5>Other Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                              
                                                
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Expected delivery date :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->expected_del_date?></span>
                                                </li>
                                                 
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Cim approved :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->cim_approved?></span>
                                                    </li>
                                                
                                               
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                    <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Date received :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->recieved_date?></span>
                                                </li>
                                            
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Reserved :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->reserved?></span>
                                                    </li>  
                                                   
                                                
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                                <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>RT / PL :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $view->Combo68?></span>
                                                </li>
                                                
                                                  <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Status :</a></span>
                                                    <span class="display-block overflow-hidden"><?php if($view->status==1){ echo "On order"; }
                                                      elseif($view->status==2){ echo "On delivery"; }
                                                      elseif($view->status==3){ echo "Payment Pending"; }
                                                      elseif($view->status==4){ echo "Not ready to Del"; }
                                                      elseif($view->status==5){ echo "Void"; }
                                                      elseif($view->status==6){ echo "Back to Office"; }
                                                      elseif($view->status==7){ echo "Change of Item"; }
                                                      ?></span>
                                                    </li>
                                                  
                                                   
                                                
                                              
                                            </ul>
                                        </div>
                                      
                                    </div>

                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="booking">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Orders</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Order Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Oder No.</th>
                          <th>Order Date</th>
                          <th>Quantity Sold</th>
                          <th>Quantity To Deliver</th>
                          <th>Due Amount</th>
                          <th>Paid Amount</th>
                          <th>Detail </th>
                          <th>Order Note</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($orders!=null){ foreach ($orders as $ord) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $ord->orderno; ?></td>
                        <td><?php echo $ord->order_date;  ?></td>
                        <td><?php echo $ord->txt_Quantity ; ?></td>
                        <td><?php echo $ord->txt_Qty_Delivered ; ?></td>
                        <td><?php echo $ord->due_amount; ?></td>
                        <td><?php echo $ord->amount_paid; ?></td>
                        <td><?php echo $ord->Description  ; ?></td>
                        <td><?php echo $ord->order_note ; ?></td>
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>S No.</th>
                          <th>Oder No.</th>
                          <th>Order Date</th>
                          <th>Quantity Sold</th>
                          <th>Quantity To Deliver</th>
                          <th>Due Amount</th>
                          <th>Paid Amount</th>
                          <th>RT / PL </th>
                          <th>Order Note</th>
                      </tr>
                  </tfoot>
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="sec2" aria-labelledby="base-tab2" aria-expanded="false">
             <section id="call">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Calls</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Call Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Call Date</th>
                          <th>Call Time</th>
                          <th>Remark</th>
                          <th>Recording File</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($calls!=null){ foreach ($calls as $cal) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cal->date; ?></td>
                        <td><?php echo $cal->time;  ?></td>
                        <td><?php echo $cal->remark ; ?></td>
                        <td><?php echo $cal->file ; ?></td>
                       
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <section id="sms">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">SMS</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                SMS Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>SMS Date</th>
                          <th>SMS Time</th>
                          <th>Message</th>
                          
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($SMS!=null){ foreach ($SMS as $sms) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sms->date; ?></td>
                        <td><?php echo $sms->time;  ?></td>
                        <td><?php echo $sms->remark ; ?></td>
                        
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>       
            <section id="comment">
                <div class="row">
                    <div class="col-12">
                        <div class="content-header">Comment</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                Comment Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                     <div class="card-body">
                          <div class="card-block">
                              <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>S No.</th>
                          <th>Comment Date</th>
                          <th>Comment Time</th>
                          <th>Comment</th>
                          
                    </tr>
                  </thead>
                  <tbody>
                     
                    <?php $i=1;  if($comments!=null){ foreach ($comments as $cm) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date('Y-m-d',strtotime($cm->created_on)); ?></td>
                        <td><?php echo date('H:i',strtotime($cm->created_on)); ?></td>
                        <td><?php echo $cm->comment ; ?></td>
                        
                    </tr>
                  <?php $i++; }  } ?>
                  </tbody>
                 
              </table>
                          </div>
                      </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  
                    </div>
                  
                    <div role="tabpanel" class="tab-pane" id="sec3" aria-labelledby="base-tab3" aria-expanDriver not assign yetded="false">
                        
                       <div class="card">
	<div class="card-body">
		<div class="card-block">
			<section class="cd-horizontal-timeline123">
			
            
                        <div class="main_steps">
    <div class="container">
        <ul>
            <?php
            if(!empty($status)){
              foreach($status as $st){    
            ?>
            <li>
                <span> <?php echo date('d/m/Y',strtotime($st->created_on));?> </span>
                <strong> <?php echo $st->status?> </strong>
            </li>
            <?php }} ?>
        </ul>
    </div>
</div>
			
			
			</section>
		</div>
	</div>
</div>
                       
                    </div>
                </div>


            
            

  </div>
</div>
<?php include('footer.php'); ?>