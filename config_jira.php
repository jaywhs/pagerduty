<?php
date_default_timezone_set("America/Los_Angeles");
error_reporting(E_ERROR | E_PARSE);

//roll account
$acc["ldap"] = "ldap username";
$acc["pass"] = 'ldap pass';

$TEAMS = array(
"PMUR2M9", //team name id
"PCKVE61", //team name id
);

$API = (object)array(
'limit'    => 100, //Hard set from PD server
'total'    => 800, //total number records to pull for 1 week - warning! setting this any higher may result in a long query time
'token'    => "enter token",
'timezone' => "UTC",
'version'  => 2,
'url'      => "https://api.pagerduty.com/incidents",
);

/* ======== AURORA / MySQL ========= */
function AuroraDB()
{
  $config = (object)array(
  'host' => 'enter hostname',
  'user' => 'root',
  'pass' => 'root pass',
  'main' => 'songbird',
  );

  $aurora = new mysqli($config->host, $config->user, $config->pass, $config->main);
  if ($aurora->connect_error){
    die("<br><center>There was a problem connecting to the database!<br>" . $aurora->connect_error);
  }
  return $aurora;
}

?>
