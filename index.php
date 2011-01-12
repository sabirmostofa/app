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

if(isset($_POST['form-submit'])):
$query="select id from feeds where feedtype='$_POST[feed_selector]'";
$feed_id=mysql_result(mysql_query($query),0);

$query="select id from genres where genre_name='$_POST[genre_selector]'";
$genre_id=mysql_result(mysql_query($query),0);



$query="select apps.post_title,ranks.ranks,ranks.app_id from apps inner join ranks on ranks.app_id=apps.id  where ranks.feed_id='$feed_id' and ranks.genre_id='$genre_id' and ranks.current_rank!=-1 order by ranks.current_rank";

$result=mysql_query($query) or die(mysql_error());

while($array=mysql_fetch_assoc($result)):
	foreach($array as $key=>$value):
		if($key=='ranks'):
			if(preg_match('/;/',$value):
			$test_array=explode(';',$value);
			echo '<br/>';
			print_r($test_array);
			echo '<br/>';
			endif;
		endif;


	endforeach;
endwhile;
endif;






?>
