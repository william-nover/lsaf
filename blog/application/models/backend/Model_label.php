<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Model_label extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getType()
    {
        $sql   = "SELECT  a.* from tbl_label_type as a order by a.type_id ASC ";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }
    function getListLabel($id, $parent, $cond = null)
    {
        $where = '';
        if ($id != '') {
            $where = "WHERE a.label_parent = $parent and a.module_id = " . $id;
        }
        $sql   = "SELECT a.label_id ,a.module_id, 
                                a.label_title,a.label_name, a.type_id, a.label_view,a.label_page, a.label_notif, 
                                a.label_order, a.label_active_status, b.type_title
                                FROM tbl_label as a 
                                inner join tbl_label_type as b on a.type_id =b.type_id
                                " . $where . $cond;
        $query = $this->db->query($sql)->result_array();
        $data  = array();
                 foreach ($query as $row) {                    
                         $data[] = array(
                                'label_id' => $row['label_id'],
                                'module_id' => $row['module_id'],
                                'label_title' => $row['label_title'],
                                'label_name' => $row['label_name'],
                                'type_id' => $row['type_id'],
                                'label_view' => $row['label_view'],
                                'label_order' => $row['label_order'],
                                'label_active_status' => $row['label_active_status'],
                                'type_title' => $row['type_title'],
                                'label_page' => $row['label_page'],
                                'label_notif' => $row['label_notif'],
                                'content_text' => '',
                                'label_child' =>$this->getChildLabel($row['label_id']),
                                'options' =>$this->getOptions($row['label_id'],$row['type_id'])
                            );                        
                      }
		return $data;

      
    }
     function getChildLabel($label_parent)
    {
        $where = '';
        if ($label_parent != '') {
            $where = "WHERE a.label_parent = " . $label_parent;
        }
        $sql   = "SELECT a.label_id,a.label_parent ,a.module_id, 
                                a.label_title,a.label_name, a.type_id, a.label_view,a.label_notif, 
                                a.label_order, a.label_active_status, b.type_title
                                FROM tbl_label as a 
                                inner join tbl_label_type as b on a.type_id =b.type_id
                                " . $where. " order by a.label_order ASC" ;
        $query = $this->db->query($sql)->result_array();
        $data  = array();
                 foreach ($query as $row) {                    
                         $data[] = array(
                                'label_id' => $row['label_id'],
                                'label_parent' => $row['label_parent'],
                                'module_id' => $row['module_id'],
                                'label_title' => $row['label_title'],
                                'label_name' => $row['label_name'],
                                'type_id' => $row['type_id'],
                                'label_view' => $row['label_view'],
                                'label_order' => $row['label_order'],
                                'label_active_status' => $row['label_active_status'],
                                'type_title' => $row['type_title'],
                                'label_notif' => $row['label_notif'],
                                'content_text' => ''
                            );                        
                      }
		return $data;

      
    }
    
    
    function getlabel($id = '')
    {
        $where = '';
        if ($id != '') {
            $where = "WHERE a.label_id = " . $id;
        }
        $sql   = "SELECT a.label_id,a.label_parent ,a.module_id, 
                a.label_title,a.label_name, a.type_id, a.label_view,a.label_page, a.label_notif, 
                a.label_order, a.label_active_status, b.type_title
                FROM tbl_label as a 
                inner join tbl_label_type as b on a.type_id =b.type_id " . " $where " . " ORDER BY a.label_id ASC";
        $query = $this->db->query($sql);
        $rs    = $query->result_array();
        return $rs;
    }
    function checkLabel($label_title,$module_id)
    {
        $sql   = "SELECT label_title FROM tbl_label WHERE label_title = '" . $label_title . "' and module_id = $module_id";
        $query = $this->db->query($sql);
        $rs    = $query->result_array();
        return $rs;
    }
   
    function insertLabel($label_parent,$module_id, $label_title, $label_name, $type_id, $label_view,$label_page,$label_notif)
    {
        $sql     = "INSERT INTO tbl_label SET
                    label_parent='$label_parent',
                    module_id='$module_id',
                    label_title='" . $label_title . "',
                    label_name='" . $label_name . "',
                    type_id='$type_id',
                    label_view='$label_view',
                    label_page='$label_page',
                    label_notif='" . $label_notif . "' ";
        $query   = $this->db->query($sql);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    function updateLabel($id,$label_parent, $module_id, $label_title, $label_name, $type_id, $label_view,$label_page,$label_order,$label_notif)
    {
        $sql   = "UPDATE tbl_label SET 
                        label_parent='$label_parent',
                        module_id='$module_id',
                        label_title='" . $label_title . "',
                        label_name='" . $label_name . "',
                        type_id='$type_id',
                        label_view='$label_view',
                        label_page='$label_page',
                        label_order='$label_order',
                        label_notif='" . $label_notif . "'    
                        WHERE label_id = " . $id;
        $query = $this->db->query($sql);
        return $query;
    }
     function activeLabel($id)
    {
        $sql   = "UPDATE tbl_label SET label_active_status = abs(label_active_status-1)
                   WHERE label_id = " . $id;
        $query = $this->db->query($sql);
        return $query;
    }
    function deleteLabel($id = '')
    {
        $sql   = "DELETE FROM tbl_label  WHERE  label_id = $id";
        $query = $this->db->query($sql);
        $str   = $this->db->last_query();
        return $str;
    }
    
     function deleteContent($id = '')
    {
        $sql   = "DELETE FROM tbl_content WHERE  label_id = " . $id;
        $query = $this->db->query($sql);
        $str   = $this->db->last_query();
        return $str;
    }
    function deleteChild($id = '')
    {
        $sql   = "DELETE FROM tbl_label WHERE  label_parent = $id";
        $query = $this->db->query($sql);
        $str   = $this->db->last_query();
        return $str;
    }
    function updateOrderLabel($id, $order)
    {
        $sql   = "UPDATE tbl_label SET 
                          label_order= " . $order . "" . " WHERE label_id = " . $id;
        $query = $this->db->query($sql);
        return $query;
    }
    
     function getOptions($label_id,$type_id)
    {
        $where = '';
        if ($label_id != '' && $type_id != '') {
            $where = "WHERE a.label_id = ".$label_id." and a.type_id = " . $type_id;
        }
        $sql   = "SELECT a.options_id,a.label_id,a.type_id,a.options_title
                                FROM tbl_options as a " 
                            . " $where " . " ORDER BY a.label_id ASC";
        $query = $this->db->query($sql)->result_array();
        $data  = array();
                 foreach ($query as $row) {                    
                         $data[] = array(
                                'options_id' => $row['options_id'],
                                'label_id' => $row['label_id'],
                                'type_id' => $row['type_id'],
                                'options_title' => $row['options_title']
                            );
                        
                      }
		return $data;
    }
    function insertOptions($data){    
        foreach ($data as $value) {
          $this->db->insert('tbl_options', $value);   
        }
        $this->db->close();
    }
            
    function updateOptions($options_id,$options_title){
        $sql   = "UPDATE tbl_options SET 
                        options_title ='".$options_title."'
                        WHERE options_id = ".$options_id;
        $query = $this->db->query($sql);
        return $query;
    }
    function deleteOptions($id){
        $sql   = "DELETE FROM tbl_options WHERE options_id = " . $id;
        $query = $this->db->query($sql);
        $str   = $this->db->last_query();
        return $str;
    }
}