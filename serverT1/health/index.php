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
$dbname = "serverT1";

$db = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
mysql_select_db($dbname);


$query = mysql_query("SELECT COUNT(*) as count, AVG(serverload) as meanload FROM health WHERE datetime >= NOW() - INTERVAL 1 MINUTE");
$only1minute = mysql_fetch_array($query);

$query = mysql_query("SELECT COUNT(*) as count, AVG(serverload) as meanload FROM health WHERE datetime >= NOW() - INTERVAL 10 MINUTE");
$only10minute = mysql_fetch_array($query);

if($only1minute['count'] == null)
	$only1minute['count'] = 0;
if($only1minute['meanload'] == null)
	$only1minute['meanload'] = 0;
if($only10minute['count'] == null)
	$only10minute['count'] = 0;
if($only10minute['meanload'] == null)
	$only10minute['meanload'] = 0;


$fullhealth = new stdClass();
$fullhealth->last_minute = $only1minute['count'];
$fullhealth->last_ten_minutes = $only10minute['count'];
$fullhealth->server_load_last_minute = $only1minute['meanload'];
$fullhealth->server_load_last_ten_minutes = $only10minute['meanload'];


echo(json_encode($fullhealth));

$load = get_server_load();
$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO health(ip, serverload) VALUES('".$ip."', '".$load."')");





?>