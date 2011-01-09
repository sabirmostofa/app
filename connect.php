<?php 
$connect=mysql_connect('localhost','root','11235813') or die(mysql_error());
$selected=mysql_select_db('app',$connect);
if(!$selected)echo 'Error in database selection.Create a database and edit the settings';
