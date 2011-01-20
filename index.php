<?php
require_once('connect.php');
require_once('functions/functions.php');
require_once('header.php');
?>


<select name='feed_selector' id='fselector'>
<?php
$query='select feedtype from feeds';
$result=mysql_query($query) or die(mysql_error());
while($array=mysql_fetch_assoc($result)):
foreach($array as $value) echo '<option>'.$value.'</option>';
endwhile;

?>
</select>
<select name='genre_selector' id='gselector'>
<?php
$query='select genre_name from genres';
$result=mysql_query($query) or die(mysql_error());
while($array=mysql_fetch_assoc($result)):
foreach($array as $value) echo '<option>'.$value.'</option>';
endwhile;

?>
</select>

<select name='post_number' id='pselector'>
<option>20</option>
<option>25</option>
<option>30</option>
<option>50</option>
<option>100</option>
</select>
<input type='button' name='form-submit' id= 'fsubmit' value='View the apps'/>

<div class='pagination'>
<?php for($i=1;$i<16;$i++):?>
<input type='button' style='float:left;margin-left:5px;' class='paginator' id='<?php echo $i?>' value='<?php  echo $i; ?>'/>
<?php endfor; ?>
</div>
<div class='clearBoth'></div>


<?php

 





?>
<div id='ajax_return'></div>
<div class='pagination'>
<?php for($i=1;$i<16;$i++):?>
<input type='button' style='float:left;margin-left:5px;' class='paginator' id='<?php echo $i?>' value='<?php  echo $i; ?>'/>
<?php endfor; ?>
</div>

