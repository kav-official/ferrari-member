<?php
class CustomFunctions{

  function getIncomeType(){
    $arr = [
        1=>"ຈາກເດີນບານ ເຟີຣາຣີ",
        2=>"ຈາກປ້ຳນ້ຳມັນ",
        3=>"ຈາກວັງວຽງ"
    ];
    return $arr;
  }

  function uploadFile($path){
    $f3 = Base::instance();
    $f3->set('UPLOADS',$path); // don't forget to set an Upload directory, and make it writable!
    $web = Web::instance();
    $overwrite = true; // set to true, to overwrite an existing file; Default: false
    $slug = true; // rename file to filesystem-friendly version
    $files = $web->receive(function($file,$formFieldName)
    {
      $arrAceptFile = array('jpeg','jpg','png','gif','docx','doc','xlsx','xls','pdf','mp4');
      $arrFileName = explode("/",$file['type']);
      $file_name = strtolower($arrFileName[1]);
      if(in_array($file_name,$arrAceptFile))
      {
        return true;
      } else {
        return false;
      }
    },
    $overwrite,
    function($fileBaseName, $formFieldName){
      $arrName = explode(".",$fileBaseName);
      return substr(sha1(mt_rand().time()), 0, 17).'.'.end($arrName);
    });
    return $files;
  }

  function removeFile($file){
    $f3 = Base::instance();
    if($file != ''){
      $file_path = str_replace($f3->get('SITE_DOMAIN'),'',$file);
      if (file_exists(getcwd().'/'.$file_path)){
        unlink(getcwd().'/'.$file_path);
      }
    }
    return true;
  }

  function UR_exists($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode == 200 ? true : false;
  }

  function image_exists($url)
	{
    if(!empty($url))
    {
      if (@getimagesize($url))
      {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
	}

  function checkaccess($role,$access)
  {
    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
    $domainLink=$protocol.'://'.$_SERVER['HTTP_HOST'];
    if (!in_array($role, $access)) {
      header("location: ".$domainLink."/home?error=You do not have sufficient rights to access this.");
    }
  }

  static function get_real_ip()
  {
    $ip = false;
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
      if($ip)
      {
        array_unshift($ips, $ip);
        $ip = false;
      }
      for($i = 0; $i < count($ips); $i++)
      {
        if(!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i]))
        {
          if(version_compare(phpversion(), "5.0.0", ">="))
          {
            if(ip2long($ips[$i]) != false)
            {
              $ip = $ips[$i];
              break;
            }
          }
          else
          {
            if(ip2long($ips[$i]) != - 1)
            {
              $ip = $ips[$i];
              break;
            }
          }
        }
      }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
  }

  public function renderArraySelect($arrayObj, $selectedItem)
  {
    foreach (array_keys($arrayObj) as $fields)
    {
      if (is_array($selectedItem) && $selectedItem != 0)
      {
        if (in_array($fields, $selectedItem))
        {
          print "<option selected value=\"".$fields."\">".$arrayObj[$fields]."</option>";
        }
        else
        {
          print "<option value=\"".$fields."\">".$arrayObj[$fields]."</option>";
        }
      }
      else
      {
        if ($selectedItem == $fields)
        {
          print "<option selected value=\"".$fields."\">".$arrayObj[$fields]."</option>";
        }
        else
        {
          print "<option value=\"".$fields."\">".$arrayObj[$fields]."</option>";
        }
      }
    }
  }

  function renderArrayValue($arrayObj, $selectedItem)
  {
    foreach ($arrayObj as $fields => $val)
    {
      if ($selectedItem == $fields)
      {
        print "<option selected value=\"".$fields."\">".$val."</option>";
      }
      else
      {
        print "<option value=\"".$fields."\">".$val."</option>";
      }
    }
  }

  function truncate($text, $limit = 25, $ending = '...')
  {
    $text = strip_tags($text);
    if(strlen($text) > $limit)
    {
      $text = substr($text, 0, $limit);
      $text = substr($text, 0, -(strlen(strrchr($text, ' '))));
      $text = $text . $ending;
    }
    return $text;
  }

  function friendlyURL($string)
	{
		$string = preg_replace("`\[.*\]`U", "", $string);
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string);
		$string = preg_replace(array("`[^a-z0-9]`i", "`[-]+`"), "-", $string);
		return strtolower(trim($string, '-'));
	}

}