<?php
include("config.php");
include("create_jira_ticket.php");

function ldap_user($config, $attributes, $uid, $status)
{
  global $search_deactive;

  $ldapconn = ldap_connect('ldap server name', 636) or die("Could not connect to LDAP server.");

  if($ldapconn) {
    $ldapbind = ldap_bind($ldapconn, 'uid='.'enter roll acount name'.',ou='.'service accounts'.','.'dc=enterdc,dc=com'.'', 'enter roll account pw') or die ("Error trying to bind: ".ldap_error($ldapconn));

    if ($ldapbind) {
      if ($status == "Active") {
        $result = ldap_search($ldapconn, 'ou='.'People'.','.'dc=enterdc,dc=com'.'', "uid=$uid"/*, $config[attributes]*/) or die ("Error in search query: ".ldap_error($ldapconn));
      }
      else {
        $result = ldap_search($ldapconn, 'ou='.'locked'.','.'dc=enterdcn,dc=com'.'', "uid=$uid"/*, $config[attributes]*/) or die ("Error in search query: ".ldap_error($ldapconn));
      }
      $data = ldap_get_entries($ldapconn, $result);

      if ($uid)
      {
       for ($r=0; $r<$data["count"]; $r++)
        {
          //echo $data[$r]["uid"][0];
          $delete_users = $data[$r]["uid"][0];
          //echo "\r\n";
          //echo $delete_users;
          create_ticket();
          //mail("email@domain.com","**Delete User from PagerDuty","**Please delete the following user from PagerDuty:\r\n".$delete_users,"From: DONOTREPLY" . "\r\n"  );
        }
      }
     }
   }


  ldap_close($ldapconn);
}
?>
