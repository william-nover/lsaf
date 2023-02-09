<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('setCategory')){
    function setCategory($filtera,$filterb,$filterc){
        $setfilter=array();
       
        if ($filtera !=''){
            $setfilter[] .=$filtera;
        }
        
        if ($filterb!=''){
            $setfilter[] .=$filterb;
        }
        
        if ($filterc !=''){
            $setfilter[] .=$filterc;
        }
        
        return $setfilter;
    }
}

if( ! function_exists('setFilter')){
    function setFilter($product,$location,$business){
        $resultWhere='';
        if ($product){
                $label_id=$product[0]['label_id'];
                 $content_text=$product[0]['content_text'];
        $resultWhere  .=" and a. row_id in  (SELECT a.row_id FROM tbl_row a
                    inner join tbl_content b on a.row_id = b.row_id
                    WHERE a.module_id = 100 and (b.label_id ="."$label_id"." and b.content_text ="."$content_text".")) ";
        }
        
        if ($location){
                $label_id=$location[0]['label_id'];
                 $content_text=$location[0]['content_text'];
        $resultWhere  .=" and a. row_id in  (SELECT a.row_id FROM tbl_row a
                    inner join tbl_content b on a.row_id = b.row_id
                    WHERE a.module_id = 100 and (b.label_id ="."$label_id"." and b.content_text ="."$content_text".")) ";
        }
        
        if ($business){
                $label_id=$business[0]['label_id'];
                 $content_text=$business[0]['content_text'];
        $resultWhere  .=" and a. row_id in  (SELECT a.row_id FROM tbl_row a
                    inner join tbl_content b on a.row_id = b.row_id
                    WHERE a.module_id = 100 and (b.label_id ="."$label_id"." and b.content_text ="."$content_text".")) ";
        }
        
        return $resultWhere;
    }
}

if( ! function_exists('contentValue')){
    function contentValue($content, $labelName){
        foreach ($content['content'] as $value) {
            if($value['label_name'] == $labelName) {
                if ($value['type_id']==3)  {
                //return BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$value['content_text']);
                return BASE_URL.$value['content_text'];
                }
                else if ($value['type_id']==6) {
                return getOptions($value['content_text'],$value['label_id']);
                }
                else if ($value['type_id']==7) {
                return getOptions($value['content_text'],$value['label_id']);
                }
                else if ($value['type_id']==9) {
                 $result=array();   
                 $vals=array();
                $opts = explode(',',$value['content_text']);
                foreach ($opts as $key => $val) {
                  $result[] = generateNameLabel(getOptions($val ,$value['label_id'])).' ';
                }   
                    
                return implode(" - " ,$result);
                }
                return $value['content_text'];
                }
        }
        return '';
    }
}

if( ! function_exists('formGenerate')){
function formGenerate($controller,$ListLabel){
        $html_output='';
        foreach($ListLabel as $label){
            if ($label['type_id']==1) { 
                $html_output .= ' <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">
                            '.$controller.' '.$label['label_title'].':
                           </label>
                           <div class="col-lg-6">
                              <input name="'.$label['label_name'].'" type="text" class="form-control m-input" placeholder="'.$controller.' '.$label['label_title'].'" value="'.$label['content_text'].'">
                              <span class="m-form__help">
                              '.$label['label_notif'].'
                              </span>
                           </div>
                        </div>';
            }
            else if ($label['type_id']==2) { 
                $html_output .= '<div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">
                           '.$controller.' '.$label['label_title'].':
                           </label>
                           <div class="col-lg-10">
                            <textarea name="'.$label['label_name'].'" type="text" class="form-control m-input ckeditor" placeholder="section">
                            '.$label['content_text'].'                            
                            </textarea> 
                            <span class="m-form__help">
                              '.$label['label_notif'].'
                              </span>
                           </div>
                        </div>';
            }
            else if ($label['type_id']==3) { 
                $content_image_thumbs = BASE_URL.str_replace('/admin','/admin/.thumbs',$label['content_text']);
                $content_image = BASE_URL.$label['content_text'];
                $html_output .= '<div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                 '.$controller.' '.$label['label_title'].':
                                </label>
                                <div class="col-lg-6">                       
                                <div style="margin-bottom:10px;" class="'.$label['label_name'].'">
                                <img id="img'.$label['label_name'].'" src="'.$content_image.'" style="max-width:400px; padding:5px; border:solid 1px #ccc;">                                   
                                </div>
                                   <input type="text" name="'.$label['label_name'].'" readonly="'.$label['label_name'].'" id="'.$label['label_name'].'" class="form-control" value="'.$content_image.'" onchange="getval(this);">
                                   <p class="help-block" style="color:#00F;">'.$label['label_notif'].'</p>
                                   <div style="margin-right:10px;">
                                    <a data-toggle="modal"  href="javascript:;" data-target="#Modal'.$label['label_name'].'" onClick="openKCFinder(&#39;'.$label['label_name'].'&#39;);" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x" id="link-file" class="link"><i class="flaticon-attachment"></i></a>
                                    <a class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x" onClick="reset_value(&#39;'.$label['label_name'].'&#39;);" id="link-file" class="link"><i class="fa fa-refresh"></i></a>
                                   </div>
                                </div>
                             </div>';
                $html_output .='<div class="modal fade" id="Modal'.$label['label_name'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                        &times;
                                                                </span>
                                                        </button>
                                                </div>
                                            <div class="modal-body">'; 
                 $username = 'Admin';
                $salt = 'dsflFWR9u2xQa';
                 $akey = md5($username.$salt);   
                $html_output .='<iframe class="filemanager" src="'.TOOLS_BASE_URL.'/filemanager/dialog.php?type=1&field_id='.$label['label_name'].'&#39;&akey='.$akey.'&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                                        </div>
                                        </div>
                                </div>
                </div>'; 
                $html_output .='<script>
                        function getval(sel)
                            {
                                var url =sel.value;
                                var ids =sel.id;
                                $("#img"+ids).attr("src", url);

                              }
                        </script>';       
            }
             else if ($label['type_id']==4) { 
                $html_output .= '<div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                                '.$controller.' '.$label['label_title'].':
                                        </label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-group date" >
                                                        <input type="text" name="'.$label['label_name'].'"  class="form-control m-input" readonly  value="'.$label['content_text'].'" id="m_datepicker_3"/>
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                </span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>';
            }
            else if ($label['type_id']==5) { 
                $html_output .= '<div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                               '.$controller.' '.$label['label_title'].':
                                        </label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-group timepicker">
                                                        <input type="text" name="'.$label['label_name'].'" id="m_timepicker_2_modal" class="form-control m-input" readonly placeholder="Select time" type="text"/ value="'.$label['content_text'].'">
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                        <i class="la la-clock-o"></i>
                                                                </span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>';
            }
            else if ($label['type_id']==6) { 
                $html_output .= '<div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                               '.$controller.' '.$label['label_title'].':
                                        </label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                        <select  name="'.$label['label_name'].'" class="form-control m-input">
                                        <option value="">select '.$label['label_title'].'</option>';
                
                    foreach ($label['options'] as $opt) {
                        $html_output .= '<option value="'.$opt['options_id'].'" "'.(($opt['options_id'] == $label['content_text'])?' selected ':"").'">'.$opt['options_title'].'</options>';                        
                                        }
                        $html_output .= '</select>
                                        </div>
                                <span class="m-form__help">
                              '.$label['label_notif'].'
                              </span>
                                </div>';
            }
            
            else if ($label['type_id']==7) { 
               $html_output .= '<div class="form-group m-form__group row">';
                    $html_output .= '<label class="col-lg-2 col-form-label" for="">';
                           $html_output .= $controller.' '.$label['label_title'];
                    $html_output .= ': </label>';               
                                      $html_output .= '<div class="col-lg-4 col-md-9 col-sm-12 m-radio-inline">';
                                         foreach ($label['options'] as $opt) {        
                                        $html_output .= '<label class="m-radio">';
                                                      $html_output .= '<input type="radio" name="'.$label['label_name'].'" value="'.$opt['options_id'].'" "'.(($opt['options_id'] == $label['content_text'])?' checked ':"").'">';
                                                     $html_output .= $opt['options_title'];
                                                      $html_output .= '<span></span>';
                                              $html_output .= '</label>';
                                                }  
                                      $html_output .= '</div>';
                                      $html_output .= '<span class="m-form__help">';
                                        $html_output .= $label['label_notif'];
                                      $html_output .= '</span>';
                              $html_output .= '</div>';
              }
              
              else if ($label['type_id']==8) { 
                $html_output .= ' <div class="form-group m-form__group row" style="display:none;">
                           <label class="col-lg-2 col-form-label">
                            '.$controller.' '.$label['label_title'].':
                           </label>
                           <div class="col-lg-6">
                              <input readonly name="'.$label['label_name'].'" type="text" class="form-control m-input" placeholder="'.$controller.' '.$label['label_title'].'" value="'.$label['label_title'].'">
                              <span class="m-form__help">
                              '.$label['label_notif'].'
                              </span>
                           </div>
                        </div>';
            }
            else if ($label['type_id']==9) { 
                $html_output .= '<div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                               '.$controller.' '.$label['label_title'].':
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="m-checkbox-list">';
                                    $opts = explode(',',$label['content_text']);
                                    foreach ($label['options'] as $opt) {
                                    $html_output .= ' <label class="m-checkbox">
                                     <input value="'.$opt['options_id'].'" name="'.$label['label_name'].'[]" type="checkbox" "'.((in_array($opt['options_id'], $opts))?' checked ':"").'">
                                     '.$opt['options_title'].'
                                     <span></span>
                                     </label>'; 
                                    }  
                $html_output .= '</div>';
                $html_output .= '</div>';
                $html_output .= '</div>';
            }
        }
    return $html_output;
}
}

if( ! function_exists('resultData')){
function resultData($content,$controller){
        $html_output='';
        foreach ($content as $value) {
        if ($value['label_view']==1) { 
           if ($value['type_id']==3) { 
                    $content_image_thumbs = BASE_URL.str_replace('/admin/','/admin/.thumbs/',$value['content_text']);
                    $content_image = BASE_URL.$value['content_text'];
                $html_output .='<td>';
                $html_output .='<a href="#" data-toggle="modal" data-target="#m_modal_'.$value['content_id'].'">';
                $html_output .='<img src="'.$content_image_thumbs.'" class="img-thumbnail">';
                $html_output .='</a>';
                
                $html_output .='</td>';
                $html_output .='<div class="modal fade" id="m_modal_'.$value['content_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                        &times;
                                                                </span>
                                                        </button>
                                                </div>
                                            <div class="modal-body">';      
                $html_output .='<img src="'.$content_image.'" class="img-fluid img-responsive">                                                                 
                                            </div>

                                        </div>
                                </div>
                        </div>'; 
               
            }
           else if ($value['type_id']==6) {
            $html_output .='<td>'.getOptions($value['content_text'],$value['label_id']).'</td>';
           }
           else if ($value['type_id']==7) {
            $html_output .='<td>'.getOptions($value['content_text'],$value['label_id']).'</td>';
           }
           else if ($value['type_id']==2) {
            $html_output .='<td>-----</td>';
           }
           else if ($value['type_id']==8) {
            $html_output .='<td>';
                if($value['label_child']){
            $html_output .='<a href="'.BASE_URL_BACKEND.'/'.$controller.'/child/'.$value['label_id'].'/'.$value['content_id'].'"><i class="la la-list"></i></a>';                   
                }
           $html_output .='</td>';
           }
            else if ($value['type_id']== 9) {
                $html_output .='<td>'; 
                $vals=array();
                $opts = explode(',',$value['content_text']);
                foreach ($opts as $key => $val) {
                  $html_output .= getOptions($vals[]= $val ,$value['label_id']).'<br/>';
                }
        
                $html_output .='</td>';
           }
           
            else  {
            $html_output .='<td>'.$value['content_text'];
            $html_output .='</td>';
           }
        }
        }
        return $html_output;
    }
}
if( ! function_exists('getCategory')){
    function getCategory($category_id){
        $db =& DB();
        $db->select('category_title');
        $array = array('category_id' => $category_id);
        $db->where($array);
        $query = $db->get('tbl_category');
        $result = $query->result();
        return $result[0]->category_title;
    }
}


//select from options
if( ! function_exists('getOptions')){
    function getOptions($value,$label){
        $db =& DB();
        $query = $db->get_where('tbl_options',array('options_id' => $value,'label_id' => $label));
        $result = $query->result();
        return $result[0]->options_title;
    }
}
if( ! function_exists('generateCategory')){
	function generateCategory($label){
		$label = strtolower($label);
		
		$strSearch = array(" ","  ","_","-","","%" ,"&");
		$label = str_replace($strSearch, "", $label);
		$strSearchNew = array("amp","!","@","#","$","%","^","&amp;","*","(",")","+","|","’","‘","”",
						"{","}","[","]",":",";","\'","\"","<",">",",",".","?","\/","*(",
						"=","\\","~");
		$label = str_replace($strSearchNew, "", $label);
		
		return $label;
	}
}


if( ! function_exists('generateNameLabel')){
	function generateNameLabel($label){
		$label = strtolower($label);
		
		$strSearch = array(" ","  ","_","-","");
		$label = str_replace($strSearch, "_", $label);
		$strSearchNew = array("!","@","#","$","%","^","&amp;","*","(",")","+","|","’","‘","”",
						"{","}","[","]",":",";","\'","\"","<",">",",",".","?","\/","*(",
						"=","\\","~");
		$label = str_replace($strSearchNew, "", $label);
		
		return $label;
	}
}
if( ! function_exists('generateIdTxt')){
	function generateIdTxt($label){
		$strSearch = array("/");
		$label = str_replace($strSearch, "_", $label);
		$strSearchNew = array(" ");
		$label = str_replace($strSearchNew, "-", $label);
		
		return $label;
	}
}
if( ! function_exists('backIdTxt')){
	function backIdTxt($label){
		$strSearch = array("_");
		$label = str_replace($strSearch, "/", $label);
		$strSearchNew = array("-");
		$label = str_replace($strSearchNew, " ", $label);
		
		return $label;
	}
}
if( ! function_exists('create_time_range')){
function create_time_range($start, $end, $interval = '30 mins', $format = '24') {
    $startTime = strtotime($start); 
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '24')?'G:i ':'g:i a';

    $current   = time(); 
    $addTime   = strtotime('+'.$interval, $current); 
    $diff      = $addTime - $current;

    $times = array(); 
    while ($startTime < $endTime) { 
        $times[] = date($returnTimeFormat, $startTime); 
        $startTime += $diff; 
    } 
    $times[] = date($returnTimeFormat, $startTime); 
   // return ($returnTimeFormat==24) ? date("G:i", $times) : date("g:i a", $times);
   return $times; 
}
   }  
if( ! function_exists('setPosition')){
function setPosition($i) {
$loo_kon= array(2, 5, 7, 9, 12, 14, 16, 19, 21, 23, 26, 28, 30, 33, 35);
    $value ='';
      if  (in_array($i, $loo_kon)){
        $value= 'grid-item-double';
      }
      else {
        $value ='';
      }
     return $value;   
      
    }
    
   }
   
   
   if( ! function_exists('setBtnText')){
function setBtnText($i) {
    $value ='';
       switch ($i) {
        case 1:
            $value ='upholstery';
            break;
        case 2:
            $value ='drapery';
            break;
        case 3:
            $value ='accesories';
            break;
        case 4:
            $value ='recycled';
            break;
        case 5:
            $value ='xxxx';
            break;
        
        }
           return ($value);
	}
   }

if( ! function_exists('countFacility')){
function countFacility($facility) {

        $value ='';
         if  (($facility) == 0)
         {
         $value ='--';
         }
         else if  (($facility) == '')
         {
         $value ='--';
         }
         else  if  (($facility) > 0)
          {
         $value =$facility;
         }
           return ($value);
	}
   }

if( ! function_exists('getDays')){
function getDays($days) {

    $value ='';
       switch ($days) {
        case 1:
            $value ='Minggu';
            break;
        case 2:
            $value ='Senin';
            break;
        case 3:
            $value ='Selasa';
            break;
        case 4:
            $value ='Rabu';
            break;
        case 5:
            $value ='Kamis';
            break;
        case 6:
            $value ='Jumat';
            break;
        case 7:
            $value ='Sabtu';
            break;
        
        }
           return ($value);
	}
   }
   
if( ! function_exists('setBreadcrum')){
function setBreadcrum($data) {

    $value ='';
       switch ($data) {
        case 1:
            $value ='Minggu';
            break;
        case 2:
            $value ='Senin';
            break;
        case 3:
            $value ='Selasa';
            break;
        case 4:
            $value ='Rabu';
            break;
        case 5:
            $value ='Kamis';
            break;
        case 6:
            $value ='Jumat';
            break;
        case 7:
            $value ='Sabtu';
            break;
        
        }
           return ($value);
	}
   } 

   
if( ! function_exists('email')){
	function email($to,$from, $name, $subject, $message_email){
		$ci = &get_instance();
		$ci->load->library('email');
		$ci->email->clear();
		$config['protocol'] 	= 'smtp';//'mail';
		$config['smtp_host']	= $ci->config->item('smtp_server'); //'10.2.121.8';
		$config['smtp_user']	= $ci->config->item('smtp_user'); //'';
		$config['smtp_pass']	= $ci->config->item('smtp_password'); //'';
		$config['smtp_port']	= $ci->config->item('smtp_port'); //'25'; 
		$config['priority'] 	= 1;
                $config['smtp_crypto']      = 'ssl';
		$config['wordwrap'] 	= TRUE;
		$config['mailtype']   	= 'html';
                $config['send_multipart'] = FALSE;
		$config['smtp_timeout'] = '10'; 
		$config['charset']		=	'utf-8';  
		$config['newline']		= '\r\n';
		$ci->email->initialize($config);
		$ci->email->from($from, $name);
               // $ci->email->header($header);
		$ci->email->to($to);
		$ci->email->subject($subject);
		$ci->email->message($message_email);		
		if($ci->config->item('flag_email')){
			if(!$ci->email->send()){
				echo $ci->email->print_debugger();
			}
		}
	}
}

if( ! function_exists('pagging')){
	function pagging($base_url, $total_rows, $per_page){
		$ci = &get_instance();
		$ci->load->library('pagination');
		
		$config['base_url']			= $base_url;
		$config['total_rows']		= $total_rows;
		$config['per_page']			= $per_page;
		$config['num_links'] 		= 9;
		$config['uri_segment'] 		= 4;
		$config['use_page_numbers'] = TRUE;
		
		// Config link
		$config['full_tag_open'] = '<div class="text-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$ci->pagination->initialize($config); 
		
		return $ci->pagination->create_links();
	}
}

if( ! function_exists('pagging_frontend')){
	function pagging_frontend($base_url, $total_rows, $per_page, $uri_segment){
		$ci = &get_instance();
		$ci->load->library('pagination');
		
		$config['base_url']			= $base_url;
		$config['total_rows']		= $total_rows;
		$config['per_page']			= $per_page;
		$config['num_links'] 		= 4;
		$config['uri_segment'] 		= $uri_segment;
		$config['use_page_numbers'] = TRUE;
		/*$config['display_pages'] 	= FALSE;*/ //hide page number
		
		$config['first_link'] 		= FALSE;
		$config['last_link'] 		= FALSE;
		$config['next_link'] 		= FALSE;
		$config['prev_link'] 		= FALSE;
		
		// Config link
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '';
		$config['prev_link'] = '';
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		
		$ci->pagination->initialize($config); 
		
		return $ci->pagination->create_links();
	}
}


if ( ! function_exists('htmltags'))
{
	function htmltags($text)
	{
            $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
                           '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                           '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                           '/&nbsp;/',                            //spasi
                           '/& &#8230;/', 
                           '@<![\s\S]*?--[ \t\n\r]*>@'        // Strip multi-line comments including CDATA
            );
            $text = preg_replace($search, '', $text);
            return $text;

            }
}












if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		
                $ubah = date('d-m-Y', strtotime($tgl));
		 $pecah = explode("-",$ubah);
		$tanggal = $pecah[0];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[2];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}
if( ! function_exists('rupiah')){
function rupiah ($uang) {
    return "Rp. ". number_format($uang, 0, ",", ".");
}

    
   }
if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}
if( ! function_exists('date_convert')){
	function date_convert ($date) {
		$date = date('Y-m-d', strtotime($date));
		$bulan = array ('01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember'
		);
		$date = explode ('-',$date); 

		return  $bulan[$date[1]] . ' ' . $date[2].", ". $date[0];
	}
}

if( ! function_exists('createCache')){
	function createCache($arrayValue, $filename){
		$str = "";
		
		if(!empty($filename)){
			if(count($arrayValue) > 0){
				$pathjson = PATH_ASSETS."/json/";
				$filename = $filename.".json";
				$contentCache = json_encode($arrayValue);

				if (!$handle = fopen($pathjson.$filename, 'w+')) {
					 $str = "Cannot open file ($filename)";
				}
				if (fwrite($handle, $contentCache) === FALSE) {
					$str = "Cannot write to file ($filename)";
				}
				fclose($handle);
			}
		}	
		
		return $str;
	}	
}

if( ! function_exists('cacheJson')){
	function cacheJson($path, $value){
		$return = array();
		$return['status'] = TRUE;
		$return['err'] = '';
		
		if (!$handle = fopen($path, 'w+')) {
			 $return['err'] = "Cannot open file ($path)";
			 $return['status'] = FALSE;
		}
		
		if (fwrite($handle, $value) === FALSE) {
			$return['err'] = "Cannot write to file ($path)";
			$return['status'] = FALSE;
		}
		fclose($handle);
		
		return $return;
	}	
}

if( ! function_exists('searcharray')){
	function searcharray($value, $key, $array) {
		foreach ($array as $k => $val) {
		   if ($val[$key] == $value) {
			   return $k;
		   }
		}
		return null;
	}
}

if( ! function_exists('searchmanyarray')){
	function searchmanyarray($value, $key, $array, $valuesearch) {
		$arrKey = array();
		foreach ($array as $k => $val) {
		   if ($val[$key] == $value) {
			   array_push($arrKey,$k);
		   }
		}

		return $arrKey;
	}
}


if( ! function_exists('genRandomString')){
	function genRandomString(){
		$length = 10;
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$string = "";    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		
		return $string;
	}	
}	

if( ! function_exists('secure_input')){
	function secure_input($data)
    {
		$filter_sql = stripslashes(strip_tags(htmlspecialchars(trim($data),ENT_QUOTES)));
		return $filter_sql;
    }
}	

if( ! function_exists('secure_input_password')){
	function secure_input_password($data)
    {
		$filter_sql = trim($data);
		return $filter_sql;
    }
}

if( ! function_exists('secure_input_editor')){
	function secure_input_editor($data)
    {
		$filter_sql = trim($data);
		return $filter_sql;
    }
}

if( ! function_exists('rc4')){
	function rc4( $key_str, $data_str ) {
		// convert input string(s) to array(s)
		$key = array();
		$data = array();
		for ( $i = 0; $i < strlen($key_str); $i++ ) {
		 $key[] = ord($key_str{$i});
		}
		for ( $i = 0; $i < strlen($data_str); $i++ ) {
		 $data[] = ord($data_str{$i});
		}
		// prepare key
		$state = array( 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,
					  16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,
					  32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,
					  48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,
					  64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,
					  80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,
					  96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,
					  112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,
					  128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,
					  144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,
					  160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,
					  176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,
					  192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,
					  208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,
					  224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,
					  240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255 );
		$len = count($key);
		$index1 = $index2 = 0;
		for( $counter = 0; $counter < 256; $counter++ ){
		 $index2   = ( $key[$index1] + $state[$counter] + $index2 ) % 256;
		 $tmp = $state[$counter];
		 $state[$counter] = $state[$index2];
		 $state[$index2] = $tmp;
		 $index1 = ($index1 + 1) % $len;
		}
		// rc4
		$len = count($data);
		$x = $y = 0;
		for ($counter = 0; $counter < $len; $counter++) {
		 $x = ($x + 1) % 256;
		 $y = ($state[$x] + $y) % 256;
		 $tmp = $state[$x];
		 $state[$x] = $state[$y];
		 $state[$y] = $tmp;
		 $data[$counter] ^= $state[($state[$x] + $state[$y]) % 256];
		}
		// convert output back to a string
		$data_str = "";
		for ( $i = 0; $i < $len; $i++ ) {
		 $data_str .= chr($data[$i]);
		}
		return $data_str;
	}
}

if( ! function_exists('encryptRC4MD5')){
	function encryptRC4MD5($msisdn){
		$haskey = md5(KEY, true);
		$msisdn_rc4decrypt = rc4($haskey, $msisdn);
		$msisdn_base64encode = base64_encode($msisdn_rc4decrypt);
		
		return $msisdn_base64encode;
	} 
}

if( ! function_exists('decryptRC4MD5')){
	function decryptRC4MD5($msisdn){
		$haskey = md5(KEY, true);
		$msisdn_base64decode = base64_decode($msisdn);
		$msisdn_rc4encrypt = rc4($haskey, $msisdn_base64decode);
		
		return $msisdn_rc4encrypt;
	} 
}

if( ! function_exists('enc_dec')){
	function enc_dec($a, $str) {
		$out = false;
		$enc_method = "AES-256-CBC";
		$sk = "Share_Your_Story";
		$siv = "GamerZAsia";
		
		$key = hash('sha256', $sk);
		
		$iv = substr(hash('sha256', $siv), 0, 16);
		
		if ($a == "enc") {
			$out = openssl_encrypt($str, $enc_method, $key, 0, $iv);
			$out = base64_encode($out);
		} else {
			$out = openssl_decrypt(base64_decode($str), $enc_method, $key, 0, $iv);
		}
		return $out;
	}
}

if( ! function_exists('date_dropdown')){
function date_dropdown($year_limit = 0){
        $html_output='';
        /*days*/
        $html_output .= '           <select class="date-dis-a" style="width:80px" name="date_day" id="day_select">'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '               <option value="' . $day . '">' . $day . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*months*/
        $html_output .= '           <select class="date-dis-a" style="margin-left:10px; width:140px" name="date_month" id="month_select" >'."\n";
        $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '               <option value="' . $month . '">' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*years*/
        $html_output .= '           <select class="date-dis-a" style="margin-left:10px; width:140px" name="date_year" id="year_select">'."\n";
            for ($year = 1950; $year <= (date("Y") - $year_limit); $year++) {
                $html_output .= '               <option value="' . $year . '">' . $year . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

 
    return $html_output;
}
}


if( ! function_exists('date_dropdown_backend')){
function date_dropdown_backend($year_limit = 0){
        $html_output='';
        //$html_output .= '        <span> Date of Birth </span>'."\n";

        /*days*/
        $html_output .= '           <select class="form-control" style="width:80px" name="date_day" id="day_select">'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '               <option value="' . $day . '">' . $day . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*months*/
        $html_output .= '           <select class="form-control" style="margin-left:10px; width:140px" name="date_month" id="month_select" >'."\n";
        $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '               <option value="' . $month . '">' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*years*/
        $html_output .= '           <select class="form-control" style="margin-left:10px; width:140px" name="date_year" id="year_select">'."\n";
            for ($year = 1950; $year <= (date("Y") - $year_limit); $year++) {
                $html_output .= '               <option value="' . $year . '">' . $year . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

 
    return $html_output;
}
}


?>
