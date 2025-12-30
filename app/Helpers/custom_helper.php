<?php 

use App\Models\admin\system\SystemConfigModel;





/**
 *
 * redirect to warehouse
 *
 */
function initWarehouse()
{
  if (session()->has('loggedIn')) {
      if (empty(session('warehouse_access'))) {
        return true;
      }else{
        return false;
      }
  } 
}

/**
 *
 * make active menu
 *
 */
 function activeMenu($segment, $position)
{
    $uri = current_url(true); 
    $urlSegment = $uri->getSegment($position);
    if ( is_array($segment)) {
      if (in_array($urlSegment, $segment)) {
        return 'active';
      }
    }else{
      if (strcasecmp($urlSegment, $segment)===0) {
        return 'active';
      }
    }
    


}




function _date($data)
{
	return date('d-m-Y H:i:s', strtotime($data));
}

function _dateOnly($data)
{
  return date('d-m-Y', strtotime($data));
}



function cssClass($value)
{
  $value = strtolower($value);
  $data['initial'] = 'info';
  $data['under process'] = 'warning';
  $data['completed'] = 'success';

  $data['created'] = 'info';
  $data['pending'] = 'warning';
  $data['processing'] = 'warning';
  $data['shipped'] = 'warning';
  $data['completed'] = 'success';
  $data['delivered'] = 'success';
  $data['cancelled'] = 'danger';
  $data['returned'] = 'danger';


  $data['assigned'] = 'info';
  $data['returned'] = 'success';
  $data['lost'] = 'danger';

  $data['active'] = 'success';
  $data['inactive'] = 'danger';


  return isset($data[$value])? $data[$value] : 'info';
}



/**
 *
 * set checkbox for user access
 *
 */

function set_checkbox_ua($val, $dataset, $type='module')
{  
  if (isset($dataset)) {
    if ($type==='module') {
      if ($dataset->module===$val) {
        return 'checked';
      }else{
        return '';
      }
    }else{
      if (!empty($dataset->operation)) {
        if ($val===$dataset->operation) {
          return 'checked';
        }else{
          return '';
        }
      }

    }
  }
    
}




/**
 *
 * set option
 *
 */

function set_selected_option($val1, $val2)
{  
  if (strcasecmp($val1, $val2)===0) {
     return 'selected';
  }else{
    return '';
  }
    
}

function set_checkbox_opt_arr($val1, $val2)
{  
   
     $arr = explode(',', $val2);
     if (in_array($val1, $arr)) {
       return 'checked';
     }else{
        return '';
     }
  

}

function set_checkbox_opt($val1, $val2)
{  
  if (strcasecmp($val1, $val2)===0) {
     return 'checked';
  }else{
    return '';
  }
    
}


/**
 *
 * pagination link
 *
 */

function paginationLinkAndOffset(  $total_data, $content_per_page, $current_page, $link, $get_para='' )
  {
     $stop_link = 0;
     $return_page_link = '';
      
     $total_pages = ceil($total_data / $content_per_page);
     $offset = (($current_page-1) * $content_per_page) ;
     $return_page_link .= '<ul class="pagination pagination-sm">';
     for ($i=1; $i <= $total_pages ; $i++) { 
      $active ='';
      if ($current_page == $i) {
         $active = 'style="background: #6db651; color: #000000;"';
      }
      if( $i === 1 ){ 
        $return_page_link .= '<li class="page-item" ><a class="page-link"  href="'.$link.$i.$get_para.'" ><i class="fa fa-angle-double-left"></i> First</a></li>'; 
      }

      //first 4 link
      if ( $i< ($current_page-4) ) {
         continue;
      }elseif ( ( $i > ($current_page+4) ) and ( $i < ($current_page+8) ) ) {
        //...
         $return_page_link .= '<li class="page-item disabled" ><a class="page-link" href="javascript:void(0)">...</a></li>'; 
         $stop_link = 1;
         
         
      }else{

        //next 4 link
        if ( $stop_link === 0 ) {
           $return_page_link .= '<li class="page-item" ><a '.$active.' class="page-link" href="'.$link.$i.$get_para.'">'.$i.'</a></li>'; 
        }
      }

      //create last link
      if( $i === (int) ( $total_pages ) ){ 
        if( $i !== $current_page and $stop_link === 1 ){
          $return_page_link .= '<li class="page-item" ><a class="page-link" href="'.$link.$i.$get_para.'">'.$i.'</a></li>';
        }
        
        $return_page_link .= '<li class="page-item" ><a class="page-link"  href="'.$link.$i.$get_para.'">Last <i class="fa fa-angle-double-right"></i></a></li>'; 
      }
     }
      $return_page_link .='</ul>';
      if($total_pages == 1){ $return_page_link='';}
      return array('link' => $return_page_link, 'offset' => $offset); 
  }



  /**
   *
   * sat dates
   *
   */
  function _getDates($sDate, $eDate,  $type='full')
  {
    
    if ($type==='full') {
      $s_date = '1990-01-01 12:12:12';
      $e_date = date('Y-m-d').' 23:59:59';

      if( $sDate != '' ){
        $s_date = date('Y-m-d', strtotime( $sDate ) ).' 00:00::01';
      }
      if(  $eDate != '' ){
        $e_date = date('Y-m-d', strtotime( $eDate ) ).' 23:59:59';
      }
      return ['s_date' => $s_date, 'e_date' => $e_date];
    }else{
      $s_date = '1990-01-01';
      $e_date = date('Y-m-d');
      if( $sDate != '' ){
        $s_date = date('Y-m-d', strtotime( $sDate ) );
      }
      if(  $eDate != '' ){
        $e_date = date('Y-m-d', strtotime( $eDate ) );
      }
      return ['s_date' => $s_date, 'e_date' => $e_date];
    }
  
  }


  function readCsv($filepath)
  {
      $data = [];
      if (($handle = fopen($filepath, "r")) !== FALSE) {
          while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
              $data[] = $row; // Each row is an array of values
          }
          fclose($handle);
      }
      return $data;
  }



  /**
   *
   * calculate tax for price incl. tax
   *
   */
  function taxCal($taxRate, $totalPrice)
  {
    $taxRate = ((float)$taxRate/100);
    // Calculate the original price (excluding tax)
    $originalPrice = (float)$totalPrice / (1 + $taxRate);
    
    // Calculate the tax amount
    $taxAmount = (float)$totalPrice - $originalPrice;
    
    return ['taxAmt' => round($taxAmount, 2), 'originalPrice' => round($originalPrice, 2)];
  }




function _in_word(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " . " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
    return ($Rupees ? $Rupees . 'rupees ' : '') . $paise;
}
  
/*==================================
=            csv helper            =
==================================*/





  function array2csv(array &$array)
  {
     if (count($array) == 0) {
       return null;
     }
     ob_start();
     $df = fopen("php://output", 'w');
     
     foreach ($array as $row) {
        fputcsv($df, $row);
     }
     fclose($df);
     return ob_get_clean();
  }

  function download_send_headers($filename) {
      // disable caching
      $now = gmdate("D, d M Y H:i:s");
      header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
      header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
      header("Last-Modified: {$now} GMT");

      // force download  
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");

      // disposition / encoding on response body
      header("Content-Disposition: attachment;filename={$filename}");
      header("Content-Transfer-Encoding: binary");
  }

  /*=====  End of csv helper  ======*/


  function checkAccess($access, $check, int $isAdmin)
  {

     if (!$isAdmin) {
        if (!empty($access)) {
           $accessArr = explode(',', $access);

           if (!in_array($check, $accessArr)) {
              return false;
           }else{
            return true;
           }

        }else{
           return false;
        }
     }else{
      return true;
     }
  }
  



?>