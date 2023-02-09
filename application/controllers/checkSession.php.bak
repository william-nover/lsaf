<?php
 $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';           
        if($session!=""){
        $pecah = explode("|",$session);
        $this->data["signup_id"]=$pecah[0];
        $this->data["full_name"]=$pecah[1];
        $this->data["email"]=$pecah[2]; 
        $this->data["step"]=$pecah[3];
        $this->data["status"]=$pecah[4];   

        }
        else
        {
        $this->data["signup_id"]='';
        $this->data["full_name"]='';
        $this->data["email"]=''; 
        $this->data["step"]='';
        $this->data["status"]='';
        $this->data["step"]=0;
        }
      