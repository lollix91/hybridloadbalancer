<?php


/*

this file will manage the server status

returning the number of request in the last minute,
the number of requests in the last 10 minutes,
the server % of load in the last minute,
the server % of load in the last 10 minutes
and others if needed

*/

function get_server_load() {
    $load = '';
    if (stristr(PHP_OS, 'win')) {
        $cmd = 'wmic cpu get loadpercentage /all';
        @exec($cmd, $output);
        if ($output) {
            foreach($output as $line) {
                if ($line && preg_match('/^[0-9]+$/', $line)) {
                    $load = $line;
                    break;
                }
            }
        }

    } else {
        $sys_load = sys_getloadavg();
        $load = $sys_load[0];
    }
    return $load;
}


//those data will be "standardized" from the installation script
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "serverT2";

$db = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
mysql_select_db($dbname);

//in the future the servicename will be passed using GET
$query = mysql_query("SELECT COUNT(*) as count FROM easyservice WHERE datetime >= NOW() - INTERVAL 1 MINUTE");
$only1minute = mysql_fetch_array($query);

$query = mysql_query("SELECT COUNT(*) as count FROM easyservice WHERE datetime >= NOW() - INTERVAL 10 MINUTE");
$only10minute = mysql_fetch_array($query);

$query = mysql_query("SELECT AVG(serverload) as meanload FROM health WHERE datetime >= NOW() - INTERVAL 1 MINUTE");
$only1minuteload = mysql_fetch_array($query);

$query = mysql_query("SELECT AVG(serverload) as meanload FROM health WHERE datetime >= NOW() - INTERVAL 10 MINUTE");
$only10minuteload = mysql_fetch_array($query);

if($only1minute['count'] == null)
	$only1minute['count'] = 0;
if($only1minuteload['meanload'] == null)
	$only1minuteload['meanload'] = 0;
if($only10minute['count'] == null)
	$only10minute['count'] = 0;
if($only10minuteload['meanload'] == null)
	$only10minuteload['meanload'] = 0;


$fullhealth = new stdClass();
$fullhealth->last_minute = intval($only1minute['count']);
$fullhealth->last_ten_minutes = intval($only10minute['count']);
$fullhealth->server_load_last_minute = floatval($only1minuteload['meanload']);
$fullhealth->server_load_last_ten_minutes = floatval($only10minuteload['meanload']);


echo(json_encode($fullhealth));

$load = get_server_load();
$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO health(ip, serverload) VALUES('".$ip."', '".$load."')");





?>