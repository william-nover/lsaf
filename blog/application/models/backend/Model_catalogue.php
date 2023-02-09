<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_catalogue extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
            function getModule($module_name){
            $data = array();
            
            $sql="select module_id , module_group_id from tbl_module where module_path='".$module_name."' ";         
		 $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
     
            }
            function getListCatalogue($cond = null){
		$query		= "SELECT a.catalogue_id,  a.catalogue_title, a.catalogue_type, "
                                    . " a.catalogue_file,  a.catalogue_order, a.catalogue_active_status,"
                                    . "DATE_FORMAT( a.catalogue_create_date, '%d-%m-%Y %H:%i:%s' ) as catalogue_create_date, a.catalogue_create_by "
                                    . "FROM tbl_catalogue as a "
                                    . " ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	
	
	function getCatalogue($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE catalogue_id = ".$id;
		}
		$sql	= "SELECT a.catalogue_id,a.catalogue_title,a.catalogue_type,"
                                    . " a.catalogue_file, a.catalogue_active_status,"
                                    . "DATE_FORMAT( a.catalogue_create_date, '%d-%m-%Y %H:%i:%s' ) as catalogue_create_date, a.catalogue_create_by "
                                    . "FROM tbl_catalogue as a "
                                    . " $where "
                                    . " ORDER BY catalogue_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function activeCatalogue($id)
	{
		$sql	= "UPDATE tbl_catalogue SET catalogue_active_status = abs(catalogue_active_status-1),  
				   catalogue_update_date = now(), 
				   catalogue_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE catalogue_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteCatalogue($id = '')
	{
		$sql	= "DELETE FROM tbl_catalogue WHERE catalogue_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkCatalogue($catalogue_title){
		$sql	= "SELECT catalogue_title FROM tbl_catalogue WHERE catalogue_title = '".$catalogue_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertCatalogue($catalogue_title,$catalogue_fileurl,$catalogue_type)
	{

		$sql	= "INSERT INTO tbl_catalogue SET 
                            catalogue_title='".$catalogue_title."', 
                            catalogue_file='".$catalogue_fileurl."',
                            catalogue_type=".$catalogue_type.", 
                            catalogue_active_status = 0, 
                            catalogue_create_by = ".$_SESSION['admin_data']['user_id'].", catalogue_create_date = now()";	
		
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateCatalogue($id,$catalogue_title,$catalogue_fileurl,$catalogue_type)
	{
		$sql	= "UPDATE tbl_catalogue SET 
                            catalogue_title='".$catalogue_title."', 
                            catalogue_file='".$catalogue_fileurl."',
                            catalogue_type=".$catalogue_type.", 
                            catalogue_update_by = ".$_SESSION['admin_data']['user_id'].", 
                            catalogue_update_date=now() WHERE catalogue_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
         function updateOrderCatalogue($id,$order)
	{
		$sql	= "UPDATE tbl_catalogue SET 
				   catalogue_order= ".$order.",
				   catalogue_update_by = ".$_SESSION['admin_data']['user_id'].", catalogue_update_date=now() WHERE catalogue_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
        
        function insertCategory($category_title)
	{

		$sql	= "INSERT INTO tbl_catalogue_category SET  category_title='".$category_title."' ";		
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
        
         function getCatalogueCategory(){
         $data = array();
         $sql="select * from tbl_catalogue_category order by category_id asc";         
         $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
         
     }
       function getServices(){
         $data = array();
         $sql="select services_id, services_title from tbl_services order by services_id asc";         
         $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
         
     }
     
         function GenerateCatalogue($cond = null){
		$query		= "SELECT a.catalogue_id, a.catalogue_title,"
                                    . " a.catalogue_file, a.catalogue_order, a.catalogue_active_status "
                                    . "FROM tbl_catalogue as a "
                                    . " ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
     
        function CountCatalogue(){
             $sql="SELECT COUNT(a.catalogue_id) as total FROM `tbl_catalogue` as a ";	
                $hasil =   $this->db->query($sql);
                $data = $hasil->row_array(); 
                return $data['total']; 
        } 
}