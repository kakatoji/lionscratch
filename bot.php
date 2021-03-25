<?php

class Lion{
  
  public function __construct(){
    $this->url="http://earnlion.rewardedlinks.com:5005";
    $this->api=[
      "login"   => "/api/Login/SignUpWithGoogle",
      "reff"    => "/api/Ref/EnterRef",
      "user"    => "/api/User/GetUserInfo",
      "scratch" => "/api/Scratch/StartScratching",
      "daily"   => "/api/Video/DailyLoginVideo",
      "horly"   => "/api/Video/HourlyVideo",
      "wd"      => "/api/Payout/PayPal"
      ];
  }
public function head(){
  $head=[
      "Content-Type"=>"application/json; charset=utf-8",
      "User-Agent"=>"Dalvik/2.1.0 (Linux; U; Android 7.0; Redmi Note 4 MIUI/V11.0.2.0.NCFMIXM)"
      ];
  foreach($head as $body =>$uy){
    $mhn[]=$body.": ".$uy;
  }
  return $mhn;
}
private function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }
  public function google(){
    $h=array();
    $h[]="device: 34723510569654a9";
    $h[]="app: com.earner.lionearn";
    $h[]="User-Agent: GoogleAuth/1.4 (mido NRD90M); gzip";
    $h[]="content-type: application/x-www-form-urlencoded";
    $url="https://android.googleapis.com/auth";
    $data='androidId=34723510569654a9&lang=id-ID&google_play_services_version=210214021&sdk_version=24&device_country=id&request_visible_actions=&client_sig=2d653c4ccd8d2416c5b52780daa774f1bcf5ed81&oauth2_include_email=1&callerSig=38918a453d07199354f8b19af05ec6562ced5788&Email=kakatoji1%40gmail.com&oauth2_include_profile=1&service=audience%3Aserver%3Aclient_id%3A48799781846-hhbbl67877fdvsilapkgdjvg1ahmsos4.apps.googleusercontent.com&app=com.earner.lionearn&check_email=1&token_request_options=CAA4AVADWhZrLWlKcWVHTF9FbGJCQVEtOWliY2VB&system_partition=1&callerPkg=com.google.android.gms&Token=aas_et%2FAKppINajmqJfCV82f7wLDBKA_jbqMT6RCOupEC1AXITuuKnMrjd-lHjJKqeiaJw6_KJxB53LqlwgchCv7fYRoa9bQvMks2nX59Hu1b6m5Spf1EU1iHaA1YztV-1Q3uAHwO7_WMjCMBTf1LVT_6ZDQDV6WAjkOyX1XS3EdltqKO8P85YXjxBr9VXYlzSPQ9zbqbULW1sqEKlXKeR1jfAkbvQ%3D';
    return self::curl($url,$data,$h);
  }
public function sign($id,$token){
  $url=$this->url.$this->api['login'];
  $data=json_encode(["AppId"=>$id,
                "FirebaseToken"=>"dePbZyKWSS6YBo03pMaZtt:APA91bFk-FzH1BadmbeZkK7x2CgK10eC8DeBEuaysj7u93qVi_3pOpDCeBaV9_HnnpIX4jE4t9b-9NSgeaC4Yy1Ih5WmwnQf0L6ffgYxcwsHoh98uInesyytKSJ77WxcwbxjX7sO19Dt",
                "Token"=>$token]);
  return self::curl($url,$data,self::head());
}
public function invit($api,$id,$refcode){
  $url=$this->url.$this->api['reff'];
  $data=json_encode(["API_Key"=>$api,"ID"=>$id,"RefCode"=>$refcode]);
  return self::curl($url,$data,self::
    head());
}
public function info($api,$id){
  $url=$this->url.$this->api['user'];
  $data=json_encode(["API_Key"=>$api,"ID"=>$id]);
  return self::curl($url,$data,self::head());
}
public function daily($val,$api,$id){
  $url=$this->url.$this->api['daily'];
  $data=json_encode([
    "Validation"=>$val,
    "API_Key"=>$api,
    "ID"=>$id]);
  return self::curl($url,$data,self::head());
}
public function horly($val,$api,$id){
  $url=$this->url.$this->api['horly'];
  $data=json_encode([
    "Validation"=>$val,
    "API_Key"=>$api,
    "ID"=>$id]);
  return self::curl($url,$data,self::head());
}
public function scratch($val1,$api,$id,$val2){
  $url=$this->url.$this->api['scratch'];
  $data=json_encode([
    "Validation"=>$val1,
    "API_Key"=>$api,
    "ID"=>$id,
    "Validation2"=>$val2]);
  return self::curl($url,$data,self::head());
}
public function wd($mail,$api,$id,$amount){
  $url=$this->url.$this->api['wd'];
  $data=json_encode(["EMail"=>$mail,"API_Key"=>$api,"ID"=>$id,"Amount"=>$amount]);
  return self::curl($url,$data,self::head());
}
public function timer($tmr){ 
     $timr=time()+$tmr; 
      while(true): 
      echo "\r                       \r"; 
      $res=$timr-time(); 
      if($res < 1){break;} 
      echo date('H:i:s',$res); 
      sleep(1); 
      endwhile;
  }
public function save($data,$data_post){
    if(!file_get_contents($data)){
      file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));
  }
public function md6($int){
$randomness = array("3","4","7","12","75","23","12","4","7","54","32","23","54","3","12","3","4","7","12","75","23","12","4","7","54","32","25","54","3","12","34","3","23","4","22","12","3");
$numbI = $int*3+6;
$int = ($int*2)+17;
$rnds[] = ":R";
for ($i3=0;$i3<15;$i3+=2){
	$rnds[] = $randomness[$i3]*$int;
    }
return implode($rnds);
  }
public function xcl(){
  $x=exec('tput cols');
  echo str_repeat("~",$x)."\n";
  }
}
class kakatoji extends Lion{
  public function newuser(){
    $tes=self::google();
    preg_match('/Auth=(.*)/i',$tes[1],$token);
    $rn=rand(0,999);
    $sig=self::sign($rn,$token[1]);
    print_r($sig);
  }
  public function ban(){
    system('clear');
    echo "\e[1;32mSory teman-teman apabila setelah ini\nsaya tidak aktif di dumay\nbukan berarti vakum\ntetapi libur sementara\nkarena saya dimutasi di hutan yang jauh dari signal\nsave me \e[1;31mkakatoji\e[0m\n";
    self::xcl();
  }
  public function input(){
  if(!file_exists("config.json")){
    $api=stripslashes(str_replace("\u003d","=",trim(readline("Apikey: "))));
    $id=intval(trim(readline("ID: ")));
    $mail=trim(readline("Email: "));
    $data=["API_Key"=>$api,"ID"=>$id,"Email"=>$mail];
    self::save('config.json',$data);
   }
  }
  public function _run(){
    error_reporting(0);
    self::ban()."\n";
    if(!file_exists("config.json")){
      self::input();
    }
    while(1):
    $data=json_decode(file_get_contents('config.json'),1);
    $info=json_decode(self::info($data['API_Key'],$data["ID"])[1],1);
    //print_r($info);die();
    $val1=md5($data['ID']+$info['diamonds']+10);
    $val2=self::md6($info['diamonds']);
    $daily=json_decode(self::daily($val1,$data['API_Key'],$data['ID'])[1],1);
    if($daily['amount'] != 0){
      echo "\e[1;31m~>\e[1;32m sukccess Daily cek in \e[0m\n";
      self::xcl();
      continue;
    }
    $horly=json_decode(self::horly($val1,$data['API_Key'],$data['ID'])[1],1);
    if($horly['amount'] != 0){
      echo "\e[1;31m~>\e[1;32m Sukcess HourlyVideo \e[0m\n";
      self::xcl();
      continue;
    }
    $gis=json_decode(self::scratch($val1,$data['API_Key'],$data['ID'],$val2)[1],1);
    $jl=$gis['slot1']+$gis['slot2']+$gis['slot3'];
    if($info['scratches'] != 0){
      echo "\e[1;35m Diamond\e[1;31m: \e[1;36m{$info['diamonds']} \e[1;37m|\e[1;35m Gosokan\e[1;31m:\e[1;36m {$jl} \e[1;37m|\e[1;35m scratch\e[1;31m: \e[1;36m{$info['scratches']}\e[0m\n";
      self::xcl();
      continue;
    }
    $wd=json_decode(self::wd($data['Email'],$data['API_Key'],$data['ID'],$info['diamonds'])[1],1);
    if($info['diamonds'] >= 1999){
     if($wd['success'] != 0){
       echo $wd['additonalText']."\n";
       self::xcl();
       continue;
     }
    }
    self::timer(3600);
    endwhile;
  }
}
$obj=new kakatoji();
$obj->_run();

