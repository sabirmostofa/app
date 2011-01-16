<?php 
require_once('connect.php');
require_once('functions/functions.php');
set_time_limit(30*60);
$time=new DateTime();
$unique_timestamp=$time->getTimeStamp();	
$counter=0;


//Data in Url
$feedType=array('topfreeapplications','toppaidapplications','topgrossingapplications','topfreeipadapplications','toppaidipadapplications','topgrossingipadapplications','newapplications','newfreeapplications','newpaidapplications');

foreach($feedType as $feed):
if(!in_table('feedtype','feeds',$feed)):
$query="insert into  feeds(feedtype) values('$feed')";
mysql_query($query) or die(mysql_error());
endif;
endforeach;

$genreArray=array(
'0'=>'All',
'6018'=>'Books',
'6000'=>'Business',
'6017'=>'Education',
'6016'=>'Entertainment',
'6015'=>'Finance',
'6014'=>'Games',
'6013'=>'Healthcare & Fitness',
'6012'=>'Lifestyle',
'6020'=>'Medical',
'6011'=>'Music',
'6010'=>'Navigation',
'6009'=>'News',
'6008'=>'Photography',
'6007'=>'Productivity',
'6006'=>'Reference',
'6005'=>'Social Networking',
'6004'=>'Sports',
'6003'=>'Travel',
'6002'=>'Utilities',
'6001'=>'Weather'
);

foreach($genreArray as $genre_id=>$genre_name):
if(!in_table('genre_id','genres',$genre_id)):
$query="insert into  genres(genre_id,genre_name) values('$genre_id','$genre_name')";
mysql_query($query) or die(mysql_error());
endif;
endforeach;



//Starting the main loop*******************
$baseURI='http://itunes.apple.com/us/rss/';
$feedCounter=0;
$postCounter=0;

foreach($feedType as $feed):
$feedCounter++;
$genreCounter=0;
foreach($genreArray as $genre=>$value):
$genreCounter++;

echo $urlToParse=($genre=='All')?$baseURI.$feed.'/limit=300/xml':$baseURI.$feed.'/limit=300/genre='.$genre.'/xml';

$parser=new DOMDocument();
$parser->load('top.xml');
if(preg_match('/<feed+[^>]+>/',$parser->saveXML(),$a))$feedString=$a[0];

$parser->documentURI;
$nURI=$parser->getElementsByTagName('feed')->item(0)->getAttribute('xmlns:im');
echo '<br/>';

$entryNumber=$parser->getElementsByTagName('entry')->length;
$sep='<div style="height:30px"></div>';




//fetching the Data
$rankCounter=0;
foreach($parser->getElementsByTagName('entry') as $entry):
$rankCounter++;
  $eString=$parser->saveXML($entry); 
   
  //creating sudo xml like the parent
  $eString=$feedString.$eString.'</feed>';
  
  $eParser=new DOMDocument();
  @$eParser->loadXML($eString);
  
 $appLink=preg_replace('/\?+.*/','',$eParser->getElementsByTagName('id')->item(0)->nodeValue); 
  //$appTitle=$eParser->getElementsByTagName('title')->item(0)->nodeValue; 
  //$appTitle=reform_title($appTitle);
  $appSummary=$eParser->getElementsByTagName('summary')->item(0)->nodeValue;
  reform_title($appSummary);
  $sep;
  $appSummary=mysql_real_escape_string($appSummary); 
 $appContent=$eParser->getElementsByTagName('content')->item(0)->nodeValue;  
 
 //getting the namespaced elements
$data=array('name','artist','image','price');
foreach($data as $single):
 foreach($eParser->getElementsByTagNameNS($nURI,$single) as $tracker):
 $$single=($single=='image')?mysql_real_escape_string($tracker->nodeValue):mysql_real_escape_string(reform_title($tracker->nodeValue));
 
 endforeach;
 endforeach;



 
 $query="insert into apps(post_title,post_content,app_image,app_price,app_artist) 
 values('$name','$appSummary','$image','$price','$artist')";
 
if(!in_table('post_title','apps',$name))
mysql_query($query) or die(mysql_error());


//populating the ranks table
 $query="select ID from apps where post_title='$name'";
 $app_id=mysql_result(mysql_query($query),0);

if(in_table_multiple('ranks',array(
                            'feed_id'=>$feedCounter,
                             'genre_id'=>$genreCounter,
                             'app_id'=>$app_id                             
                              )
                              )):
 $query="select ranks from ranks where app_id='$app_id' and genre_id='$genreCounter' and feed_id='$feedCounter'";
 $result=mysql_query($query) or die(mysql_error());
    $query="update ranks set current_rank='$rankCounter' where app_id='$app_id' and genre_id='$genreCounter' and feed_id='$feedCounter'";
	mysql_query($query) or die(mysql_error());
 
	 if(mysql_num_rows($result)!=0):
	 $ranks=mysql_result($result,0);
	 $newRank=$rankCounter.','.gmdate('Y-m-d H:i:s');
	 $ranks=$ranks.';'.$newRank;
	 $query="update ranks set ranks='$ranks',update_timestamp='$unique_timestamp' where app_id='$app_id' and genre_id='$genreCounter' and feed_id='$feedCounter'";
	 mysql_query($query) or die(mysql_error());    endif;
 
else:
$newRank=$rankCounter.','.gmdate('Y-m-d H:i:s');
$query="insert into ranks(feed_id,genre_id,app_id,ranks,current_rank,update_timestamp) values('$feedCounter','$genreCounter','$app_id','$newRank','$rankCounter','$unique_timestamp')";
mysql_query($query) or die(mysql_error());

endif;




endforeach;//end of each 'entry' foreach
endforeach;// end of genre foreach
endforeach;// end of feedtype


$query="update ranks set current_rank=-1 where update_timestamp!='$unique_timestamp'";
mysql_query($query) or die(mysql_error());


