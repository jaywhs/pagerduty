#!/usr/bin/php

<?php
#-----------------------------------------------------------------------------------------------------------
#Written by Jay Ramirez for Zynga, Inc.
#December 5, 2017
#This script will pull a fresh list of users in pagerduty and compare the usernames to our uid in ldap
#if the account is locked in ldap SRE will recieve an SRE ticket stating which user to remove from PagerDuty
#This run on a daily cron on SREs Netops dev server
#-----------------------------------------------------------------------------------------------------------

include("ldap_pull.php");
include("config.php");
//curling the first 100 accounts in pagerduty
$get1 = shell_exec('curl -ss -H -X GET --header "Accept: application/vnd.pagerduty+json;version=2" --header "Authorization: Token token=entertoken" "https://api.pagerduty.com/users?limit=100"');

$curl_result = json_decode($get1, true);//grabs the curl output and turns it into a php var
$num_users = count ($curl_result['users']);//assigns a count for the numer of users from the curl result

   for ($i=0; $i<$num_users; $i++) {
     $uid = $curl_result['users'][$i]['email'];
     $ldap = preg_replace("^@zynga.com^","",$uid);
     usleep (20000);
     ldap_user($config, $attributes, $ldap, 'Locked'); //shows users that email matches ldap tha are in a locked state
    }

//pulling the rest of the account by setting the curl offset to 100
$get2 = shell_exec('curl -ss -H -X GET --header "Accept: application/vnd.pagerduty+json;version=2" --header "Authorization: Token token=enter token" "https://api.pagerduty.com/users?limit=100&offset=100"');

$curl_result = json_decode($get2, true);
$num_users = count ($curl_result['users']);

  for ($i=0; $i<$num_users; $i++) {
    $uid = $curl_result['users'][$i]['email'];
    $ldap = preg_replace("^@zynga.com^","",$uid);
    usleep(20000);
    ldap_user($config, $attributes, $ldap, 'Locked');
  }

//pulling the rest of the account by setting the curl offset to 200

$get3 = shell_exec('curl -ss -H -X GET --header "Accept: application/vnd.pagerduty+json;version=2" --header "Authorization: Token token=enter token" "https://api.pagerduty.com/users?limit=100&offset=200"');
$curl_result = json_decode($get3, true);
$num_users = count ($curl_result['users']);

  for ($i=0; $i<$num_users; $i++) {
    $uid = $curl_result['users'][$i]['email'];
    $ldap = preg_replace("^@zynga.com^","",$uid);
    usleep(20000);
    ldap_user($config, $attributes, $ldap, 'Locked');
  }
?>
