<?php

include("config_jira.php");

function create_ticket()
{
  $jira["url"] = "enter jira url";
  $data = array(
  'fields' => array('project' => array('key' => 'SRE',),
  'summary' => 'Please delete user'.$delete_users.'from PagerDuty: ',
  'description' => 'Delete '.$delete_users.' from PagerDuty:',
  'issuetype' => array("name" => "Request"),
  'priority' => array("name" => "P3"),
  ),);
  $ch = curl_init();
  $headers = array('Accept: application/json', 'Content-Type: application/json');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_URL, $jira["url"]);
  curl_setopt($ch, CURLOPT_USERPWD, $acc["ldap"] . ":" . $acc["pass"]);
  $result = curl_exec($ch);
  curl_close($ch);
  $ticket = json_decode($result, true);
  //print_r($ticket);
  echo $ticket["key"];
}
?>
