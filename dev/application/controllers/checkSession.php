<?php
 $session_login = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';           
        if($session_login!=""){
        $pecah = explode("|",$session_login);
        $this->data["signup_id"]=$pecah[0];
        $this->data["full_name"]=$pecah[1];
        $this->data["email"]=$pecah[2]; 
        $this->data["step"]=$pecah[3];
        $this->data["status"]=$pecah[4];   
        $this->data["entry_group_id"]=$pecah[5];   

        }
        else
        {
        $this->data["signup_id"]='';
        $this->data["full_name"]='';
        $this->data["email"]=''; 
        $this->data["step"]='';
        $this->data["status"]='';
        $this->data["step"]=0;
        $this->data["entry_group_id"]=0;
        }
  $session_student = isset($_SESSION['ses_student']) ? $_SESSION['ses_student']:'';           
        if($session_student!=""){
        $pecah = explode("|",$session_student);
        $this->data["student_id"]=$pecah[0];
        $this->data["student_pid"]=$pecah[1];
        $this->data["module_level_id"]=$pecah[2];   

        }
        else
        {
        $this->data["student_id"]='';
        $this->data["student_pid"]='';
        $this->data["email"]=''; 
        $this->data["module_level_id"]='';
        }  
        
       