<?php

use Illuminate\Support\Str;

function link_active($text, $active = "c-active", $just_that = FALSE)
{
    if($text == '')
    {
        //echo var_dump($_SERVER["REQUEST_URI"]);exit;
        if(str_replace('admin', '', $_SERVER["REQUEST_URI"]) == '/')
        {
            echo $active;
        }
    } else {
      if($just_that == TRUE)
      {
        if($_SERVER["REQUEST_URI"] == $text){echo $active;}
      } else {
        if (strstr($_SERVER["REQUEST_URI"], $text))
        {
            echo $active;
        }
      }
    }
}

if(!function_exists('make_page_url'))
{
    function make_page_url($get_data, $field, $new_number)
    {
        $url = '?';
        foreach($get_data as $key => $value)
        {
            if($key != $field)
            {
                if(!is_array($value))
                {
                    $url .= $key . '=' . $value . '&';
                } else {
                    foreach($value as $val){$url .= $key . '[]=' . $val . '&';}
                }
            }
        }
        return $url.'&'.$field.'='.$new_number;
    }
}


if ( ! function_exists('encrypt_sha'))
{
    function encrypt_sha($str)
    {
        $sessionKey = "Secr3t_Sess1on!Key_4t6ydv98uuuuu";
        return (openssl_encrypt($str,"AES-128-ECB",$sessionKey));

    }
}

if ( ! function_exists('encrypt_sha_for_url'))
{
    function encrypt_sha_for_url($str)
    {
        if(isset($str))
        {
            return str_replace(',', '', base64_url_encode(encrypt_sha($str)));
        } else {
            return NULL;
        }

    }
}
if ( ! function_exists('decrypt_sha_for_url'))
{
    function decrypt_sha_for_url($str)
    {
        if(isset($str) && strlen($str)>20)
        {
            return decrypt_sha(base64_url_decode($str));
        } else {
            return NULL;
        }
    }
}



if ( ! function_exists('decrypt_sha'))
{
    function decrypt_sha($str)
    {
        $sessionKey = "Secr3t_Sess1on!Key_4t6ydv98uuuuu";
        // Decode data


        return openssl_decrypt($str,"AES-128-ECB",$sessionKey);

    }
}
if ( ! function_exists('base64_url_encode'))
{
        function base64_url_encode($input)
        {
             return strtr($input, '+/=', '-_,');
        }
}
if ( ! function_exists('base64_url_decode'))
{
        function base64_url_decode($input)
        {
         return (strtr($input, '-_,', '+/='));
        }
}
if(!function_exists('multi_array_search_with_condition'))
{
    function multi_array_search_with_condition($array, $condition)
    {
        $foundItems = array();

        foreach($array as $item)
        {
            $find = TRUE;
            foreach($condition as $key => $value)
            {
                if(isset($item[$key]) && $item[$key] == $value)
                {
                    $find = TRUE;
                } else {
                    $find = FALSE;
                    break;
                }
            }
            if($find)
            {
                array_push($foundItems, $item);
            }
        }
        return $foundItems;
    }
}
if(!function_exists('postStatus'))
{
  function postStatus($status = NULL)
  {
      $Statuses = [
        ['value'=>'draft', 'name' => __('Draft'), 'class'=> 'warning', 'color'=> 'orange'],
        ['value'=> 'publish', 'name' => __('Published'), 'class'=> 'success', 'color'=> 'green'],
      
    ];

    if(isset($status) && !empty($status))
    {
      $Founds =  multi_array_search_with_condition($Statuses, ['value'=>$status]);
      if(count($Founds) > 0)
      {
          return $Founds[0];
      } else {
          return ['value'=>$status, 'name' => __($status), 'class'=> 'warning'];
      }
    }
    return $Statuses;
  }
}
?>