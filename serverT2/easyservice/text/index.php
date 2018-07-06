<?php

/*

this file will be changed when a proper framework to manage rest apis will be added
it redirects and manages the call to the right service
now we will assume the service is STATIC and the only operation available is /text

*/

//the services will in future be discovered from a discovery server.
session_start();

class service {
	
	public $service_name;
	public $service_urls;

}

$easyservice = new service();
$easyservice->service_name = "easyservice";
$easyservice->service_urls = array();
array_push($easyservice->service_urls, "http://localhost/hybridloadbalancer/instancesM/microM1");
array_push($easyservice->service_urls, "http://localhost/hybridloadbalancer/instancesM/microM2");
array_push($easyservice->service_urls, "http://localhost/hybridloadbalancer/instancesM/microM3");


$services = array();
array_push($services, $easyservice);

//the method now will be only "text", so i skip checks and other... will be done by a framework

//those data will be "standardized" from the installation script
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "serverT2";

$db = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
mysql_select_db($dbname);

$ip = $_SERVER['REMOTE_ADDR'];
$sessionid = session_id();

$query = mysql_query("SELECT * FROM easyservice WHERE sessionid = '".$sessionid."' AND ip = '".$ip."' ORDER BY id DESC LIMIT 1") or die("Error in query");
$row = mysql_fetch_array($query);

$idcalled = 0;

if(!isset($row['id'])) {//is the first time visiting the service or is passed a lot of time
	$idcalled = rand(0, count($easyservice->service_urls)-1);//random, is the best choice for the first time

	mysql_query("INSERT INTO easyservice(sessionid, ip, idcalled) VALUES('".$sessionid."', '".$ip."', '".$idcalled."')");
}
else {//i've already requested the service before, is not passed a lot of time
	$idcalled = $row["idcalled"];
	$idcalled = ($idcalled+1)%(count($easyservice->service_urls));//round robin, but is possible to implement own algorithm
	
	mysql_query("INSERT INTO easyservice(sessionid, ip, idcalled) VALUES('".$sessionid."', '".$ip."', '".$idcalled."')");
}


//now i will send only the request with the content "text", in future this will be changed, for testing purposes is not needed more
//and will need the CURL, as above. When the CURL will be used, there will be no more the 301 and 302 codes on the browser network inspector

header("location: ".$easyservice->service_urls[$idcalled]."/".$easyservice->service_name."/"."text");

/*

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $easyservice->service_urls[$idcalled]."/".$easyservice->service_name."/"."text",
    CURLOPT_USERAGENT => 'Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
echo($resp);
*/





?>