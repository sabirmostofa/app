<?php
require_once('connect.php');
require_once('functions/functions.php');
require_once('header.php');
?>
<form action="" method='post'>
<select name='feed_selector' id='selector'>
<?php
$query='select feedtype from feeds';
$result=mysql_query($query) or die(mysql_error());
while($array=mysql_fetch_assoc($result)):
foreach($array as $value) echo '<option>'.$value.'</option>';
endwhile;

?>
</select>
<select name='genre_selector' id='selector'>
<?php
$query='select genre_name from genres';
$result=mysql_query($query) or die(mysql_error());
while($array=mysql_fetch_assoc($result)):
foreach($array as $value) echo '<option>'.$value.'</option>';
endwhile;

?>
</select>
<input type='submit' name='form-submit' value='View the apps'></input>
</form>

<?php

$query="select apps.post_title,ranks.ranks from apps inner join ranks on ranks.app_id=apps.id where ranks.feed_id=1";
$result=mysql_query($query) or die(mysql_error());

while($array=mysql_fetch_assoc($result)):
foreach($array as $value) echo $value.'<br/>';
endwhile;


if(isset($_POST['form-submit'])):
echo 'posted';
var_dump($_POST);
endif;

$a= array('key'=>1,2,3);
$b=array(1,2,3);
if($a==$b)echo 'matched';
?>
