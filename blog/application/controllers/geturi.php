<?php
if (isset($_SERVER['REQUEST_URI'])) {
    if (isset($_GET['product'])) {
        $getproduct                 = $_GET['product'];
        $filtera = 'product';
        if ($getproduct) {
            $this->data['product'] = $getproduct;
        }
        $product = $this->Model_content->getLabelText(backIdTxt($this->data['product']));
    } else {
        $this->data['product'] = '*';
        $filtera ='';
        $product='';
    }
    if (isset($_GET['location'])) {
        $getlocation             = $_GET['location'];
        $filterb = 'location';
        if ($getlocation) {
            $this->data['location'] = $getlocation;
        }
        $location = $this->Model_content->getLabelText(backIdTxt($this->data['location']));
    } else {
        $filterb ='';
        $this->data['location'] = '*';
        $location='';
    }
    if (isset($_GET['business'])) {
        $getbusiness             = $_GET['business'];
        $filterc = 'business';
        if ($getbusiness) {
            $this->data['business'] = $getbusiness;
        }
        $business = $this->Model_content->getLabelText(backIdTxt($this->data['business']));
    } else {
        $filterc ='';
        $this->data['business'] = '*';
        $business='';
    }
    
    $setfilter= setFilter($product,$location,$business);
    $_SESSION['where_in']= $setfilter;
    
    $setCategory= setCategory($filtera,$filterb,$filterc);
    $_SESSION['filter']=$setCategory;
    
   //die;
    //die;
} else {
    unset($_SESSION['where_in']);
    unset($_SESSION['filter']);
    $this->data['filter']   = '';
    $this->data["where_in"] = '';
    $_SESSION['where_in']   = '';
    $_SESSION['filter']   = '';
}