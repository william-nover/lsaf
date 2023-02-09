<?php if (!defined('BASEPATH')) exit('No direct script access allowed');class Model_category_frontend extends CI_Model{    function __construct()    {        parent::__construct();    }    function getListCategory($cond = null)    {        $sql = "SELECT a.category_id,a.category_type_id, a.module_id, a.category_title, a.category_image, a.category_active_status, a.category_parent, a.category_sub_parent, a.category_url, a.category_alias, a.category_order,                      DATE_FORMAT( a.category_create_date, '%d-%m-%Y %H:%i:%s' ) as category_create_date, a.category_create_by, b.module_name, c.category_type_title                      FROM tbl_category as a inner join tbl_module as b on a.module_id=b.module_id inner join tbl_category_type as c on a.category_type_id=c.category_type_id " . $cond;        $query = $this->db->query($sql)->result_array();        return $query;    }    function getListCategoryType()    {        $sql = "SELECT a.category_type_id, a.category_type_title FROM tbl_category_type as a ";        $query = $this->db->query($sql)->result_array();        return $query;    }            function getListCategoryLanguage($cond = null)    {        $query = "SELECT a.language_id, a.language_title, a.language_default, a.language_active_status,                         b.category_id, b.category_lang_id                        FROM tbl_language a                        LEFT JOIN tbl_category_lang b ON a.language_id = b.language_id                        " . $cond;        $query = $this->db->query($query)->result_array();        return $query;    }    function getCategory($id = '')    {        $where = '';        if ($id != '') {            $where = "WHERE category_id = " . $id;        }        $sql   = "SELECT category_id, module_id, category_title,category_image, category_active_status, category_parent, category_url,category_alias, category_order FROM tbl_category $where ORDER BY category_id ASC";        $query = $this->db->query($sql);        $rs    = $query->result_array();        return $rs;    }    function getCategoryLangByCategoryID($id = '', $langid = '')    {        $where = ' WHERE 1=1 ';        if ($id != '') {            $where .= " AND category_id = " . $id;        }        if ($langid != '') {            $where .= " AND language_id = " . $langid;        }        $sql   = "SELECT category_lang_id, category_id, language_id, category_lang_title FROM tbl_category_lang $where ORDER BY category_lang_id ASC";        $query = $this->db->query($sql);        $rs    = $query->result_array();        return $rs;    }    function getCategoryLang($id = '')    {        $where = '';        if ($id != '') {            $where = "WHERE category_lang_id = " . $id;        }        $sql   = "SELECT category_lang_id, category_id, language_id, category_lang_title FROM tbl_category_lang $where ORDER BY category_lang_id ASC";        $query = $this->db->query($sql);        $rs    = $query->result_array();        return $rs;    }    function activeCategory($id)    {        $sql   = "UPDATE tbl_category SET category_active_status = abs(category_active_status-1),                     category_update_date = now(),                    category_update_by = " . $_SESSION['admin_data']['user_id'] . "                   WHERE category_id = " . $id;        $query = $this->db->query($sql);        return $query;    }    function deleteCategory($id)    {        $sql   = "DELETE FROM tbl_category WHERE category_id = " . $id;        $query = $this->db->query($sql);        $str   = $this->db->last_query();        return $str;    }    function deleteCategoryLang($id)    {        $sql   = "DELETE FROM tbl_category_lang WHERE category_id = " . $id;        $query = $this->db->query($sql);        $str   = $this->db->last_query();        return $str;    }    function checkCategory($categorytitle)    {        $sql   = "SELECT * FROM tbl_category WHERE category_title = '" . $categorytitle . "'";        $query = $this->db->query($sql);        $rs    = $query->result_array();        return $rs;    }    function checkCategoryLang($categorytitlelang)    {        $sql   = "SELECT * FROM tbl_category_lang WHERE category_lang_title = '" . $categorytitlelang . "'";        $query = $this->db->query($sql);        $rs    = $query->result_array();        return $rs;    }    function insertCategory($category_type_id, $module_id, $categorytitle,$categoryimageurl, $categoryurl, $categoryalias, $categoryparent, $categorysubparent)    {        $sql     = "INSERT INTO tbl_category SET category_type_id='" . $category_type_id . "', module_id = '" . $module_id . "', category_title = '" . $categorytitle . "' , category_image = '" . $categoryimageurl . "',                    category_active_status = 0, category_url = '" . $categoryurl . "', category_alias = '" . $categoryalias . "', category_parent = " . $categoryparent . " ,category_sub_parent = " . $categorysubparent . ",                    category_order = 1,                    category_create_by = " . $_SESSION['admin_data']['user_id'] . ", category_create_date = now()";        $query   = $this->db->query($sql);        $last_id = $this->db->insert_id();        return $last_id;    }    function insertCategoryLang($categorytitle, $categoryid, $languageid)    {        $sql     = "INSERT INTO tbl_category_lang SET category_lang_title = '" . $categorytitle . "',                    category_id = " . $categoryid . ", language_id = " . $languageid . ",                    category_lang_create_by = " . $_SESSION['admin_data']['user_id'] . ", category_lang_create_date = now()";        $query   = $this->db->query($sql);        $last_id = $this->db->insert_id();        return $last_id;    }    function updateCategory($id,$category_type_id, $module_id, $categorytitle,$category_imageurl, $categoryurl, $categoryalias, $categoryparent, $categorysubparent)    {        $sql   = "UPDATE tbl_category SET                    category_type_id='" . $category_type_id . "', module_id='" . $module_id . "', category_title='" . $categorytitle . "', category_image = '" . $category_imageurl . "', category_url='" . $categoryurl . "',category_alias='" . $categoryalias . "', category_parent = " . $categoryparent . ", category_sub_parent = " . $categorysubparent . ",                    category_update_by = " . $_SESSION['admin_data']['user_id'] . ", category_update_date=now() WHERE category_id = " . $id;        $query = $this->db->query($sql);        return $query;    }    function updateCategoryDefault($id, $categorytitle)    {        $sql   = "UPDATE tbl_category SET                    category_title='" . $categorytitle . "',                    category_update_by = " . $_SESSION['admin_data']['user_id'] . ", category_update_date=now() WHERE category_id = " . $id;        $query = $this->db->query($sql);        return $query;    }    function updateCategoryLang($categorytitle, $categoryid, $languageid)    {        $sql   = "UPDATE tbl_category_lang SET                    category_lang_title='" . $categorytitle . "',                    category_lang_update_by = " . $_SESSION['admin_data']['user_id'] . ", category_lang_update_date=now()                    WHERE category_id = " . $categoryid . " AND language_id = " . $languageid;        $query = $this->db->query($sql);        return $query;    }    function updateCategoryLangID($id, $categorytitlelang)    {        $sql   = "UPDATE tbl_category_lang SET                    category_lang_title='" . $categorytitlelang . "',                    category_lang_update_by = " . $_SESSION['admin_data']['user_id'] . ", category_lang_update_date=now()                    WHERE category_lang_id = " . $id;        $query = $this->db->query($sql);        return $query;    }    function updateOrderCategory($id, $order)    {        $sql   = "UPDATE tbl_category SET                    category_order= " . $order . ",                   category_update_by = " . $_SESSION['admin_data']['user_id'] . ", category_update_date=now() WHERE category_id = " . $id;        $query = $this->db->query($sql);        return $query;    }        function getParentModule($module_id)    {        $data  = array();        $sql   = "Select * from tbl_category  where   category_sub_parent= 0 and category_parent=0 and module_id= '" . $module_id . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_parent' => $row->category_parent,                    'category_sub_parent' => $row->category_sub_parent,                    'category_title' => $row->category_title,                    'category_image' => $row->category_image                );            }            $query->free_result();            $this->db->close();            return $data;        }    }            function getParent($category_id)    {        $data  = array();        $sql   = "Select * from tbl_category  where   category_sub_parent= 0 and category_parent= '" . $category_id . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_parent' => $row->category_parent,                    'category_sub_parent' => $row->category_sub_parent,                    'category_title' => $row->category_title,                    'category_image' => $row->category_image                );            }            $query->free_result();            $this->db->close();            return $data;        }    }    function GenerateCategory()    {        $data  = array();        $sql   = "SELECT category_id, category_title, category_image, module_id, category_active_status, category_parent,category_sub_parent, category_url, category_alias, category_order,                      DATE_FORMAT( category_create_date, '%d-%m-%Y %H:%i:%s' ) as category_create_date, category_create_by                      FROM tbl_category as a where a.category_parent = 0 and a.category_active_status=1 Order By category_order ASC";        $query = $this->db->query($sql);        foreach ($query->result() as $row) {            $data[] = (object) array(                'category_id' => $row->category_id,                'module_id' => $row->module_id,                'category_title' => $row->category_title,                'category_image' => $row->category_image,                'category_parent' => $row->category_parent,                'category_sub_parent' => $row->category_sub_parent,                'category_url' => $row->category_url,                'category_alias' => $row->category_alias,                'child_first' => $this->get_sub_category_firstLeft($row->category_id)            );        }        $query->free_result();        $this->db->close();        return $data;    }    function get_sub_category_firstLeft($category_id)    {        $data  = array();        $sql   = "SELECT a.category_id,a.category_parent,a.category_sub_parent,a.category_title,a.category_image, a.category_url,a.category_alias from tbl_category as a  where   a.category_sub_parent= 0 and category_parent= '" . $category_id . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_title' => $row->category_title,                    'category_image' => $row->category_image,                    'category_parent' => $row->category_parent,                    'category_sub_parent' => $row->category_sub_parent,                    'category_url' => $row->category_url,                    'category_alias' => $row->category_alias,                    'child_second' => $this->get_sub_category_secondLeft($row->category_id, $row->category_parent)                );            }            $query->free_result();            $this->db->close();            return $data;        }    }    function get_sub_category_secondLeft($category_id, $category_parent)    {        $data  = array();        $sql   = "SELECT a.category_id,a.category_parent,a.category_sub_parent,a.category_title,a.category_image, a.category_url, a.category_alias from tbl_category as a  where  a.category_sub_parent ='" . $category_id . "' and a.category_parent= '" . $category_parent . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_title' => $row->category_title,                    'category_image' => $row->category_image,                    'category_parent' => $row->category_parent,                    'category_sub_parent' => $row->category_sub_parent,                    'category_url' => $row->category_url,                    'category_alias' => $row->category_alias                );            }            $query->free_result();            $this->db->close();            return $data;        }    }    function getCategoryContent($module_id)    {        $data  = array();        $sql   = "SELECT a.category_id, a.category_title, a.category_image, a.category_parent, a.category_sub_parent, a.category_url, b.module_id, b.module_name " . "FROM tbl_category as a " . "INNER JOIN tbl_module as b on a.module_id = b.module_id where a.category_parent = 0 and a.module_id = '" . $module_id . "'";        $query = $this->db->query($sql);        foreach ($query->result() as $row) {            $data[] = (object) array(                'category_id' => $row->category_id,                'category_title' => $row->category_title,                'category_image' => $row->category_image,                'category_url' => $row->category_url,                'child_first' => $this->getChild($row->category_id)            );        }        $query->free_result();        $this->db->close();        return $data;    }    function getChild($category_id)    {        $data  = array();        $sql   = "SELECT a.category_id,a.category_parent,a.category_sub_parent,a.category_title,a.category_url from tbl_category as a  where   a.category_sub_parent= 0 and category_parent= '" . $category_id . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_title' => $row->category_title,                    'category_url' => $row->category_url,                    'child_second' => $this->getSecond($row->category_id, $row->category_parent)                );            }            $query->free_result();            $this->db->close();            return $data;        }    }    function getSecond($category_id, $category_parent)    {        $data  = array();        $sql   = "SELECT a.category_id,a.category_parent,a.category_sub_parent,a.category_title,a.category_url from tbl_category as a  where  a.category_sub_parent ='" . $category_id . "' and a.category_parent= '" . $category_parent . "'";        $query = $this->db->query($sql);        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $data[] = (object) array(                    'category_id' => $row->category_id,                    'category_title' => $row->category_title,                    'category_url' => $row->category_url                );            }            $query->free_result();            $this->db->close();            return $data;        }    }    function updateUrlCategory($category_id, $url_category)    {        $sql   = "UPDATE tbl_category SET category_url = '" . $url_category . "' WHERE category_id =" . $category_id . " ";        $query = $this->db->query($sql);        return $query;    }    function getCategoryParent($parent)    {        $hasil = $this->db->query("select category_title as category_parent from tbl_category where category_id ='" . $parent . "'");        $data  = $hasil->row_array();        return $data['category_parent'];    }    function getCategorySubParent($parent, $subparent)    {        $hasil = $this->db->query("select category_title as sub_parent from tbl_category where category_id ='" . $subparent . "' and category_parent ='" . $parent . "' ");        $data  = $hasil->row_array();        return $data['sub_parent'];    }    function generateCategoryContent($cond = null)    {        $query = "SELECT a.category_id, a.category_title, a.category_url," . " b.module_id, b.module_name, b.module_path " . "FROM tbl_category as a " . " inner join tbl_module as b on a.module_id = b.module_id " . " inner join tbl_module_group as c on b.module_group_id = c.module_group_id " . " " . $cond;        $query = $this->db->query($query)->result_array();        return $query;    }}