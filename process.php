<?php
require_once('connect.php');
require_once('functions/functions.php');
require_once('paginate.php');
if(isset($_GET)):
$feed_text=mysql_real_escape_string($_GET['feed']);
$genre_text=mysql_real_escape_string($_GET['genre']);

//$limit = mysql_real_escape_string($_GET['number']);
$limit=2;
if(isset($_GET['page'])){
	$page=mysql_real_escape_string($_GET['page']);
	$page--;
	}
else $page=0;

$page=$page*$limit;



$query="select id from feeds where feedtype='$feed_text'";
$feed_id=mysql_result(mysql_query($query),0);

$query="select id from genres where genre_name='$genre_text'";
$genre_id=mysql_result(mysql_query($query),0);

$query="select apps.post_title,apps.post_content,apps.app_price,apps.app_image,apps.app_artist,ranks.ranks,ranks.app_id from apps inner join ranks on ranks.app_id=apps.id  where ranks.feed_id='$feed_id' and ranks.genre_id='$genre_id' and ranks.current_rank!=-1 order by ranks.current_rank limit $page,$limit";


$result=mysql_query($query) or die(mysql_error());
$query="select apps.post_title,apps.post_content,apps.app_price,apps.app_image,apps.app_artist,ranks.ranks,ranks.app_id from apps inner join ranks on ranks.app_id=apps.id  where ranks.feed_id='$feed_id' and ranks.genre_id='$genre_id' and ranks.current_rank!=-1";

$result1=mysql_query($query) or die(mysql_error());
$num_rows=mysql_num_rows($result1);

$maker = array('post_title','post_content','app_image','app_artist','app_price');
?>
<ol id="ajax-content" class='<?php echo $num_rows?>'>

<?php
while($array=mysql_fetch_assoc($result)):
	foreach($array as $key => $value):
         //getting the values from database
		 foreach($maker as $makeSome):
		 if($makeSome == $key)$$makeSome = $value;
		 endforeach;
		 
		 if(isset($post_content)):		 
		 $post_excerpt=substr($post_content,0,400);
		 $read_more=substr($post_content,400);
		 else:
		 $post_content='';
		 $post_excerpt='';
		 $read_more='';
		 endif;
		 	 
		if($key == 'ranks'):
			if(preg_match('/;/',$value)):			
			$test_array = explode(';',$value);
			$last_rank=array_pop($test_array);
			$last_rank1=array_pop($test_array);
			$rank_array = explode(',',$last_rank);
			$rank_array1 = explode(',',$last_rank1);
			$rank_diff=$rank_array1[0]-$rank_array[0];
			 if($rank_diff>0):			 
			 $rank_diff = '+' . $rank_diff;
			 endif;
			else:
			$rank_array = explode(',',$value);
			$current_rank = $rank_array[0];
			$rank_diff=0;
			endif;
		endif;
		

		
	endforeach;
			//publishing now
	
        include('theme.php');
endwhile;
echo '</ol>';

/*
$pages = new Paginator;  
$pages->items_total = $num_rows;  
$pages->mid_range = 9;  
 $pages->paginate();  
 echo $pages->display_pages();  
*/
endif;
