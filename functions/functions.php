<?php 
function sanitize_title($title) {
	$title = strip_tags($title);
	// Preserve escaped octets.
	$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	// Remove percent signs that are not part of an octet.
	$title = str_replace('%', '', $title);
	// Restore octets.
	$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
	$title = strtolower($title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	$title = str_replace('.', '-', $title);
	$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');
	return $title;
}

function reform_title($title) {
	$title = strip_tags($title);
	// Preserve escaped octets.
	$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	// Remove percent signs that are not part of an octet.
	$title = str_replace('%', '', $title);
	// Restore octets.
	$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
    //$title = strtolower($title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	//$title = str_replace('.', '-', $title);
	$title = preg_replace('/[^%a-zA-Z0-9\'"; $%^&*()<>_\-+=`~\]\\\|.,@#!\?\[:]/', '', $title);
	//$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');
	$title = trim($title, '.');
	return $title;
}

function escape_quote($string)
{
$string=preg_replace('/\'/','\\\'',$string);
return $string;
}

function in_table($column,$table,$data){
$result = mysql_query("SELECT count(*) FROM $table where $column='$data'") or die(mysql_error());
$row=mysql_fetch_row($result);
if($row[0]>0)return 1;
return 0;
}

function in_table_multiple($table,$feed,$genre,$app){	
$query="SELECT count(*) FROM $table where feed_id='$feed' and genre_id='$genre' and app_id='$app'";
$result = mysql_query($query) or die(mysql_error());
$row=mysql_fetch_row($result);
if($row[0]>0)return 1;
return 0;
}


function ftpUpload($file,$url){
global $conn_id;
global $xml_dir;
$file=$xml_dir.$file;
// upload a file
ftp_put($conn_id, $file, $url,FTP_BINARY);
}
