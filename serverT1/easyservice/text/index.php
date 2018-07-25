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
$dbname = "serverT1";

$db = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
mysql_select_db($dbname);

$ip = $_SERVER['REMOTE_ADDR'];
$sessionid = session_id();

$callableids = array();
$cc = 0;

$query=mysql_query("SELECT idcalled, COUNT(idcalled) as count FROM easyservice WHERE datetime >= NOW() - INTERVAL 10 MINUTE GROUP BY idcalled ") or die("Error in query");
while($row = mysql_fetch_array($query)) {
	$callableids[$cc]['idcalled'] = $row['idcalled'];
	$callableids[$cc]['counter'] = $row['count'];
	$cc++;
}

$idcalled = 0;
$maxvalue = -1;

$maxidcalled = count($easyservice->service_urls);

for($i = 0; $i<count($callableids); $i++) {
	if($callableids[$i]['counter']>$maxvalue) {
		$maxvalue = $callableids[$i]['counter'];
		$idcalled = $callableids[$i]['idcalled'];		
	}
}

if($maxvalue == -1) {//is the first time that an user in 10 minutes access to a service, pick the first value
	$idcalled = 0;
}
else {
	$idcalled = ($idcalled+1)%($maxidcalled);
}

mysql_query("INSERT INTO easyservice(sessionid, ip, idcalled) VALUES('".$sessionid."', '".$ip."', '".$idcalled."')");


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