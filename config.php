<?php
$ldapserver = 'ldap server name';
$ldapport = '636';
$access = array('username', 'password', 'ou=People,dc=enterdc,dc=com', 'ou=Group,dc=enterdc,dc=com');
$attributes = array('cn', 'uid', 'uidNumber', 'loginShell', 'userPassword', 'sshPublicKey', 'pwdChangedTime', 'KeyPassword', 'groups', 'gidNumber', 'memberUid');

$config = array(
'server' => 'ldap server name',
'port' => 636,
'rollaccnt' => 'user',
'rollaccntpw' => 'password',
'DN' => 'dc=enterdc,dc=com',
'OUPeople' => 'People',
'OUService' => 'service accounts',
'OUGroup' => 'Group',
'OULocked' => 'locked',
'attributes' => array('cn', 'mail', 'uid', 'uidNumber', 'loginShell', 'userPassword', 'sshPublicKey', 'pwdChangedTime', 'KeyPassword', 'groups', 'gidNumber', 'memberUid'),
);

?>
