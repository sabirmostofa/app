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
$result = mysql_query("SELECT $column FROM $table") or die(mysql_error());
$trigger=0;
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
if(in_array($data,$row))$trigger=1;
}
if($trigger==0)return 0;
else return 1;
}

function in_table_multiple($table,array $array){
$result = mysql_query("SELECT * FROM $table") or die(mysql_error());
$trigger=0;
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
array_pop($row);
array_pop($row);
array_pop($row);
array_shift($row);
if($array==$row)$trigger=1;
}
if($trigger==0)return 0;
else return 1;
}
