<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_accordion extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getListAccordion($content_id,$cond = null){
		 $query		= "SELECT a.accordion_id, a.accordion_title,"
                                    . " a.accordion_desc, a.accordion_active_status,"
                                    . "a.accordion_order,"
                                    . "DATE_FORMAT( a.accordion_create_date, '%d-%m-%Y %H:%i:%s' ) as accordion_create_date, a.accordion_create_by, "
                                    . " b.content_id "
                                    . "FROM tbl_accordion as a "
                                    . " inner join tbl_content as b on a.content_id = b.content_id "
                                    . " where a.content_id=".$content_id." "
                                    . " ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	

	
	function getAccordion($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE accordion_id = ".$id;
		}
		$sql	= "SELECT a.accordion_id, a.accordion_title,"
                                    . "  a.accordion_desc, a.accordion_active_status,"
                                    . "a.accordion_order,"
                                    . "DATE_FORMAT( a.accordion_create_date, '%d-%m-%Y %H:%i:%s' ) as accordion_create_date, a.accordion_create_by, "
                                    . " b.content_id "
                                    . "FROM tbl_accordion as a "
                                    . " inner join tbl_content as b on a.content_id = b.content_id "
                                    . " $where "
                                    . " ORDER BY accordion_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function activeAccordion($id)
	{
		$sql	= "UPDATE tbl_accordion SET accordion_active_status = abs(accordion_active_status-1),  
				   accordion_update_date = now(), 
				   accordion_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE accordion_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteAccordion($id = '')
	{
		$sql	= "DELETE FROM tbl_accordion WHERE accordion_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	function deleteAccordionby($id = '')
	{
		$sql	= "DELETE FROM tbl_accordion WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	function checkAccordion($accordion_title){
		$sql	= "SELECT accordion_title FROM tbl_accordion WHERE accordion_title = '".$accordion_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
            function insertAccordion($data){
               
                
                foreach ($data as $value) {
                  $this->db->insert('tbl_accordion', $value);   
                }
                
//                echo'<pre>';
//                print_r($data);
//                die;
                              
		
                $this->db->close();
	}
        
	function saveAccordion($accordion_title,$accordion_desc,$accordion_id){ 
         $today= date("Y-m-d H:i:s");
          $data = array(
                        'accordion_title'=>$accordion_title,
                        'accordion_desc'=>$accordion_desc,
                        'accordion_update_by'=> $_SESSION['admin_data']['user_id'], 
                        'accordion_update_date'=> $today
                        );

            $this->db->where('accordion_id', $accordion_id);
            $this->db->update('tbl_accordion', $data);
            $this->db->close();	
         
        }
     function updateOrderAccordion($id,$order)
	{
		$sql	= "UPDATE tbl_accordion SET 
				   accordion_order= ".$order.",
				   accordion_update_by = ".$_SESSION['admin_data']['user_id'].", accordion_update_date=now() WHERE accordion_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
     
        
}