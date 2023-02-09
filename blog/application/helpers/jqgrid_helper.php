<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('getStringForGroup')){
	function getStringForGroup( $group )
	{
		$i_='';
		$sopt = array('eq' => "=",'ne' => "<>",'lt' => "<",'le' => "<=",'gt' => ">",'ge' => ">=",'bw'=>" {$i_}LIKE ",'bn'=>" NOT {$i_}LIKE ",'in'=>' IN ','ni'=> ' NOT IN','ew'=>" {$i_}LIKE ",'en'=>" NOT {$i_}LIKE ",'cn'=>" {$i_}LIKE ",'nc'=>" NOT {$i_}LIKE ", 'nu'=>'IS NULL', 'nn'=>'IS NOT NULL');
		$s = "(";
		if( isset ($group['groups']) && is_array($group['groups']) && count($group['groups']) >0 )
		{
			for($j=0; $j<count($group['groups']);$j++ )
			{
				if(strlen($s) > 1 ) {
					$s .= " ".$group['groupOp']." ";
				}
				try {
					$dat = $this->getStringForGroup($group['groups'][$j]);
					$s .= $dat;
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}
		if (isset($group['rules']) && count($group['rules'])>0 ) {
			try{
				foreach($group['rules'] as $key=>$val) {
					if (strlen($s) > 1) {
						$s .= " ".$group['groupOp']." ";
					}
					$field = $val['field'];
					$op = $val['op'];
					$v = $val['data'];
					if( $op ) {
						switch ($op)
						{
							case 'bw':
							case 'bn':
								$s .= $field.' '.$sopt[$op]."'$v%'";
								break;
							case 'ew':
							case 'en':
								$s .= $field.' '.$sopt[$op]."'%$v'";
								break;
							case 'cn':
							case 'nc':
								$s .= $field.' '.$sopt[$op]."'%$v%'";
								break;
							case 'in':
							case 'ni':
								$s .= $field.' '.$sopt[$op]."( '$v' )";
								break;
							case 'nu':
							case 'nn':
								$s .= $field.' '.$sopt[$op]." ";
								break;
							default :
								$s .= $field.' '.$sopt[$op]." '$v' ";
								break;
						}
					}
				}
			} catch (Exception $e) 	{
				echo $e->getMessage();
			}
		}
		$s .= ")";
		if ($s == "()") {
			//return array("",$prm); // ignore groups that don't have rules
			return " 1=1 ";
		} else {
			return $s;;
		}
	}
}

if( ! function_exists('Strip')){
	function Strip($value)
	{
		if(get_magic_quotes_gpc() != 0)
		{
			if(is_array($value))  
				if ( array_is_associative($value) )
				{
					foreach( $value as $k=>$v)
						$tmp_val[$k] = stripslashes($v);
					$value = $tmp_val; 
				}				
				else  
					for($j = 0; $j < sizeof($value); $j++)
						$value[$j] = stripslashes($value[$j]);
			else
				$value = stripslashes($value);
		}
		return $value;
	}
}	
?>
