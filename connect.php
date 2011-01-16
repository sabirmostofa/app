<?php 
require_once('config.php');
//connecting to the database
$p=mysql_connect(DB_HOST,DB_USERNAME,DB_PASS);
if (!$p) {
    die('Could not connect: ' . mysql_error());
}



$selected=mysql_select_db(DB_NAME,$p);
if (!$selected) {
    die ('Can\'t use database check the config file : ' . mysql_error());
}

//$conn_id = ftp_connect($ftp_server);
//$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass)
