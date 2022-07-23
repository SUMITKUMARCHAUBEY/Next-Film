<?php
require_once 'vendor/autoload.php';

$Clientid="20878488570-mns7uv14508g43d6ro7j72meuon9496j.apps.googleusercontent.com";

$Clientsectret="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";


$redirec="http://localhost/myimdb/home.php";

//creating request to google
$Client= new Google_Client();
$Client->setClientId($Clientid);
$Client->setClientSecret($Clientsectret);
$Client->setRedirectUri($redirec);
$Client->addScope('profile');
$Client->addScope('email');
if(isset($_GET['code']))
{
  // echo $_GET['code'];
$token=$Client->fetchAccessTokenWithAuthCode($_GET['code']);

$Client->setAccessToken($token['access_token']);

$gauth=new Google_Service_Oauth2($Client);
$google_info=$gauth->userinfo->get();
$email=$google_info->email;
$name=$google_info->name;
echo 'wellcome '.$name.' you are logged in with email id: '.$email;

}

else{
  echo '<a  href="'.$Client->createAuthUrl().'"> login with google</a>';
}

?>

 
