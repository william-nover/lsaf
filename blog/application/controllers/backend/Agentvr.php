<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Agentvr extends CI_Controller
{
    public $arrMenu = array();
    public $data;
    public $privilege = array();
    public $alias_category = "Agentvr";
    public function __construct()
    {
        parent::__construct();
        if (!$_SESSION) {
            session_start();
        }
        date_default_timezone_set('UTC');
        if (empty($_SESSION['admin_data'])) {
            session_destroy();
            redirect(BASE_URL_BACKEND . "/signin");
            exit();
        }
        $this->load->model(array(
            'backend/Model_menu_frontend',
            'backend/Model_agent',
            'web/Model_register',
            'backend/Model_alias',
            'backend/Model_logcms'
        ));
        $this->load->helper(array(
            'funcglobal',
            'menu',
            'accessprivilege',
            'alias'
        ));
        $module_name = $this->uri->segment(2);
        $getmodule   = $this->Model_agent->getModule($module_name);
        foreach ($getmodule as $gm) {
            $this->module_id       = $gm->module_id;
            $this->section         = $gm->module_group_id;
            $_SESSION['module_id'] = $this->module_id;
        }
        //get menu from helper menu
        $this->arrMenu            = menu();
        $this->data               = array();
        $this->data['ListMenu']   = $this->arrMenu;
        $this->data['CountMenu']  = count($this->arrMenu);
        $this->data['controller'] = $module_name;
        //  $this->data['MenuAgent'] = $this->Model_menu_frontend->getMenuContent($_SESSION['module_id']);
        // $this->data['Agentcategory'] = $this->Model_agent->getAgentCategory();
        //check privilege module
        $this->privilege          = accessprivilegeuserlevel($_SESSION['admin_data']['user_level_id'], $_SESSION['module_id']);
        $this->breadcrump         = breadCrump($_SESSION['module_id']);
    }
    public function index()
    {
        $this->view();
    }
    function view()
    {
        $admin_data               = $_SESSION['admin_data'];
        $this->data['admin_data'] = $admin_data;
        $this->data['section']    = $this->section;
        $this->data['modul_id']   = $_SESSION['module_id'];
        $this->data['breadcrump'] = $this->breadcrump;
       
        $where                    = " where a.agent_group = 1 ";
        $orderBy                  = " ORDER BY a.agent_id Desc";
        $cond                     = $where . " " . $orderBy;
        $ListAgent                = $this->Model_agent->getListAgent($cond);
        $this->data["ListAgent"]  = $ListAgent;
    
        //                die;
        //extract privilege
        $this->data["list"]    = $this->privilege[0];
        $this->data["view"]    = $this->privilege[1];
        $this->data["add"]     = $this->privilege[2];
        $this->data["edit"]    = $this->privilege[3];
        $this->data["publish"] = $this->privilege[4];
        $this->data["approve"] = $this->privilege[5];
        $this->data["delete"]  = $this->privilege[6];
        $this->data["order"]   = $this->privilege[7];
        if ($this->data["list"] == 0) {
            echo "<script>alert('Can\'t Access Module');window.location.href='" . BASE_URL_BACKEND . "/home';</script>";
            die;
        }
       
        $this->load->view('backend/header', $this->data);
        $this->load->view('backend/agent/list');
    }
    function active($id)
    {
        if (empty($id)) {
            redirect(BASE_URL_BACKEND . '/' . $this->data['controller']);
            exit();
        }
        //extract privilege
        $this->data["approve"] = $this->privilege[5];
        if ($this->data["approve"] == 0) {
            echo "<script>alert('Can\'t Access Module');window.location.href='" . BASE_URL_BACKEND . "/home';</script>";
            die;
        }
        $rsAgent       = $this->Model_agent->getAgent($id);
        $name         = $rsAgent[0]['first_name'];
        $email         = $rsAgent[0]['email'];
        $active_status = abs($rsAgent[0]['status'] - 1);
        $active        = $this->Model_agent->activeAgent($id);
        if ($active_status == 1) {
            $passgenerate = random_string('alnum', 6);
            $password = md5($passgenerate);
            $update                   = $this->Model_agent->updateAgent($id, $password);
            $this->sendmailConf($name, $email, $passgenerate);
            $log_module = "Active " . $this->module;
            
        } else {
            $log_module = "Inactive " . $this->module;
        }
        $log_value = $id . " | " . $name . " | " . $active_status;
        $insertlog = $this->Model_logcms->insertLogCMS($log_module, $log_value);
        redirect(BASE_URL_BACKEND . '/' . $this->data['controller']);
    }
    function delete($id)
    {
        if (empty($id)) {
            redirect(BASE_URL_BACKEND . '/' . $this->data['controller']);
            exit();
        }
        //extract privilege
        $this->data["delete"] = $this->privilege[6];
        if ($this->data["delete"] == 0) {
            echo "<script>alert('Can\'t Access Module');window.location.href='" . BASE_URL_BACKEND . "/home';</script>";
            die;
        }
        $rsAgent    = $this->Model_agent->getAgent($id);
        $name         = $rsAgent[0]['first_name'];
        $delete     = $this->Model_agent->deleteAgent($id);
        $log_module = "Delete " . $this->module;
        $log_value  = $id . " | " . $name;
        $insertlog  = $this->Model_logcms->insertLogCMS($log_module, $log_value);
        redirect(BASE_URL_BACKEND . '/' . $this->data['controller']);
    }
   
    function sendmailConf($name, $email, $passgenerate)
    {
       
        $subject       = "Panomatic.com - Password Confirmation ";
        $message_email = "Dear, <br>";
        $message_email .= "" . $name . "<br>";
        $message_email .= "Please use email & password below to login <br>";
        $message_email .= "Email : " . $email . "<br>";
        $message_email .= "Password : " . $passgenerate . "<br>";
        $message_email .= "Website<br>";
        $message_email .= "<a href=" . BASE_URL . "/home/>";
        $message_email .= BASE_URL . "/home/";
        $message_email .= "</a> <br>";
        $this->load->library('email');
        $config['useragent'] = "CodeIgniter";
        $config['mailpath']  = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']  = "mail";
        $config['smtp_host'] = "localhost";
        $config['newline']   = "\r\n";
        $config['mailtype']  = 'html';
        $config['charset']   = 'iso-8859-1';
        $config['wordwrap']  = TRUE;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->from('admin@panomatic.com'); // change it to yours
        $this->email->to($email); // change it to yours
        $this->email->subject($subject);
        $this->email->message($message_email);
        if ($this->email->send()) {
            //unlink(FILE_PATH_ASSETS.$attach);
            // redirect($session_url);     
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
}