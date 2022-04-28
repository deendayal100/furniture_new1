<?php include("header.php") ; ?>
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
<div class="content-wrapper">
         
<div class="row">
    <div class="col-12">
        <div class="content-header">Replied Invoices
            <a href="<?php echo base_url('admin/Custmers/repliedInvoices')?>" >
				<button class="btn btn-success pull-right"  >Back</button> 
			</a>
			   <a   href="<?php echo base_url('admin/Custmers/customerInvoice/') .$ticket[0]->order_number; ?>" >
				<button style="margin-right:20px;" class="btn btn-success pull-right"  >View</button> 
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
				<h5 style="font-size: 25px;margin-bottom: 0;margin-top: 14px;padding: 3px 15px;border-bottom: 1px solid #d4d4d4;"><b>Order No : <span style="color:red">#<?php echo $ticket[0]->order_number; ?></span></b></h5>
				<div class="card-header padding-set">
					<h5>Assign To Driver</h5>
				</div>
				<div class="card-body">
					<div class="card-block">
						<div class="row">
							<div class="col-md-7">
								<form id="assignsame" method="post">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Drivers</label><br>
													<?php
           											 $assign = $this->db->get_where(TBL_ASSIGN,['order_no'=> $ticket[0]->order_number,
           											 	'status'=>'Assigned'])->row();
           											 ?>
													<select class="form-control" name="driver" id="driver">
														<option value="">--Select--</option>
														<?php if($drivers){ foreach($drivers as $driver){
															if($assign->driver_id == $driver->id){
																$selected = 'selected';
															}else{
																$selected = '';
															}
														 ?>
														<option value="<?php echo $driver->id; ?>" <?php echo $selected;?>><?php echo $driver->name; ?></option>
														<?php }} ?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Status</label><br>
													<?php
           											 $invoice = $this->db->get_where(TBL_INVOICE,['orderno'=> $ticket[0]->order_number])->row();
           											 ?>
													<select class="form-control" name="status" id="status">
													  <option value="">--Select--</option>    
													  <option value="WITH DRIVER"  <?php if(isset($invoice) && $invoice->status == 'WITH DRIVER'){echo 'selected';}?>>WITH DRIVER</option>
													  <option value="FROM DRIVER"  <?php if(isset($invoice) && $invoice->status == 'FROM DRIVER'){echo 'selected';}?> >FROM DRIVER</option>
													</select>
												  
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-actions left">
													<input type="hidden" name="order_number" value="<?php echo $ticket[0]->order_number; ?>">
													<input type="submit" name="updatedriver" class="btn btn-raised btn-primary" value="Submit">
													 
												</div>
											</div>
										
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			 <?php
            $assign = $this->db->get_where(TBL_ASSIGN,['order_no'=>$ticket[0]->order_number,'status'=>'Assigned'])->row();
            if(empty($assign)){ 
				
			}else{
				$assignwerb = $this->db->query("select * from assign where order_no='".$ticket[0]->order_number."'  ORDER BY `id` DESC ")->result();
				$drdata = $this->db->get_where(TBL_DRIVER,['id'=>$assign->driver_id])->row(); 
            
            ?> 
            <div class="card">
                           
                            <div class="card-header padding-set">
                                <h5>Driver Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <hr style="margin-top: 0;">
                                    	
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                              
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->name : '';?></span>
                                                </li>
                                                 
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Contact  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->mobile : '';?></span>
                                                
                                                
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                           <ul class="no-list-style">
                                                
                                                  
                                                 
                                             <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Email :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->email : '';?></span>
                                                    </li>
                                                     <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Truck Plate No  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo isset($drdata) ? $drdata->truck_plate_no : '';?></span>
                                                </li>
                                                     
                                                    
                                                
                                            </ul>
                                        </div>
                                    </div>

                                   
                                    
                                </div>
                              
                            </div>
							<div class="card-header padding-set">
                                <h5>Not Delevered By Driver</h5>
                            </div>
							<div class="card-body">
                                <div class="card-block">
                                    <div class="row">
										<?php if($assignwerb){ 
										foreach($assignwerb as $key=>$val){
										if($assign->driver_id!=$val->driver_id){
										$ddata = $this->db->get_where(TBL_DRIVER,['id'=>$val->driver_id])->row();
										?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <ul class="no-list-style">
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Name :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->name?></span>
                                                </li>
                                                 <li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Contact  :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->mobile?></span>
                                                </li>
												<li class="mb-2">
                                                    <span class="text-bold-500 primary"><a>Driver Email :</a></span>
                                                    <span class="display-block overflow-hidden"><?php echo $ddata->email?></span>
												</li>
                                            </ul>
                                        </div>
										<?php }}} ?>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <?php } ?>
		</div>
	</div>
</section>
		</div>
	</div>
</div>
            

  </div>
</div>

        
<?php include("footer.php") ; ?> 