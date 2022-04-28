 <?php 
class Home_model extends CI_Model
{
 public function selectdata($tablename)
  {
  	$this->load->database();
  	$this->db->select('*');
  	$this->db->from($tablename);
	$this->db->order_by('id','desc');
  	$query=$this->db->get();
  	return $query->result();
  }
  
    public function wheredata($tablename,$where,$id)
  {
  	$this->load->database();
  	$this->db->select('*');
  	$this->db->from($tablename);
	//$where = "'".$where."' = ".$id ;
	$this->db->where($where,$id);
  	$query=$this->db->get();
  	return $query->result();
  }
  
  
   public function detail($tablename,$id)
  {
  	$this->load->database();
  	$this->db->select('*');
  	$this->db->from($tablename);
	$this->db->where('id',$id);
  	$query=$this->db->get();
  	return $query->row();
  }
  
  public function wheredetail($tablename,$where,$id)
  {
  	$this->load->database();
  	$this->db->select('*');
  	$this->db->from($tablename);
	//$where = "'".$where."' = ".$id ;
	$this->db->where($where,$id);
  	$query=$this->db->get();
  	return $query->row();
  }
  
  
  public function insert($tablename,$data)
       {
        
        $insert = $this->db->insert($tablename,$data);
        if($insert)
		{
            return $this->db->insert_id();
        }else{
            return false;    
        }
    }  
	
//update query
  public function update($tablename,$id,$data)
  {
    $this->db->where('id',$id);
    $this->db->update($tablename,$data);
	return true;
  }	
  
  public function updatewhere($tablename,$where,$id,$data)
  {
    $this->db->where($where,$id);
    $this->db->update($tablename,$data);
  }	
  
  
   public function delete($tablename,$where,$services_id) 
  { 
	 if ($this->db->delete($tablename, $where."= ".$services_id)) 
	 { 
		return true; 
	 } 
  }
   public function delete_where($tablename,$wh=array()) 
  { 
	 $this->db->where($wh);
	 $this->db->delete($tablename) ;
	 return true; 
	 
  }
   public function get_tbl_data($tbl='',$wh=array()){ 

		$this->db->where($wh);
		$query = $this->db->get($tbl);
				
		return $query->result();
	
	}// get_tbl_data function end here!
	  
/*
* Function Name: get_single_row
* Desc.: This function get single row in table.
*/
	public function get_single_row($tbl='',$wh=array()){ 

		$this->db->where($wh);
		$query = $this->db->get($tbl);
				
		return $query->row();
	
	}// get_single_row function end here!
public function deleteall() 
      { 
		$this->db->empty_table('assign');
		$this->db->empty_table('calls');
		$this->db->empty_table('call_sms');
		$this->db->empty_table('comment');
		$this->db->empty_table('invoice');
		$this->db->empty_table('orders');
		$this->db->empty_table('status_txn');
		return true; 
      }
	  
	   public function insert_images($data = array())
   {
	$insert = $this->db->insert_batch('home_gallery_img',$data);
	return $insert?true:false;
    
  }	
  
  	 public function get_tbl_data_inorder($tbl='',$wh=array()){ 

		$this->db->where($wh);
		$this->db->order_by("id", "desc");
		$query = $this->db->get($tbl);
				
		return $query->result();
	
	}// get_tbl_data function end here!	 
	
	 public function update_where($tbl='',$wh=array(),$data)
  {
    $this->db->where($wh);
    $this->db->update($tbl,$data);
    return true;
  }	
  
  public function searchrequest($vehical_type,$lat,$lon,$km)
  {
  	
    $us_current_lat = $lat ;
	$us_current_lon = $lon ; 
	
	$r = $km ; ///In kilometer
	$R = 6371;  //radius
	$max_lat = $us_current_lat + rad2deg($r/$R); 
	$min_lat = $us_current_lat - rad2deg($r/$R); 
	
	$max_lon = $us_current_lon + rad2deg($r/$R/cos(deg2rad($lat))); 
	$min_lon = $us_current_lon - rad2deg($r/$R/cos(deg2rad($lat))); 
	$lat = deg2rad($us_current_lat); 
	$lon = deg2rad($us_current_lon); 
  
  	$this->db->select('*');
  	$this->db->from(TBL_JOB_REQUEST);
  	$where = "status=1 AND vehical_type=$vehical_type AND (( latiutde < '".$max_lat."' AND latiutde > '". $min_lat."' ) or  ( longitude < '". $max_lon."' AND longitude >'". $min_lon."' ))" ;
  	
	$this->db->where($where);
	$this->db->order_by("id","desc");
	$this->db->limit(1);
  	$query=$this->db->get();
  	return $query->row();
  }
  
   public function searchdrivers($vehical_type,$lat,$lon,$km)
  {
  	
    $us_current_lat = $lat ;
	$us_current_lon = $lon ; 
	
	$r = $km ; ///In kilometer
	$R = 6371;  //radius
	$max_lat = $us_current_lat + rad2deg($r/$R); 
	$min_lat = $us_current_lat - rad2deg($r/$R); 
	
	$max_lon = $us_current_lon + rad2deg($r/$R/cos(deg2rad($lat))); 
	$min_lon = $us_current_lon - rad2deg($r/$R/cos(deg2rad($lat))); 
	$lat = deg2rad($us_current_lat); 
	$lon = deg2rad($us_current_lon); 
  
  	$this->db->select('*');
  	$this->db->from(TBL_DRIVER);
  	$where = "status=1 AND vehical_typ=$vehical_type AND is_online='Online' AND (( current_lat  '".$max_lat."' AND current_lat > '". $min_lat."' ) or  ( current_lon < '". $max_lon."' AND current_lon >'". $min_lon."' ))" ;
	$this->db->where($where);
	$this->db->order_by("id","desc");
	//$this->db->limit(1);
  	$query=$this->db->get();
  	return $query->result();
  }
	  
  
  
}

