<?php
require_once('ftp_connect.php');
require_once('functions/functions.php');
$feedType=array('topfreeapplications','toppaidapplications','topgrossingapplications','newapplications','newfreeapplications','newpaidapplications');
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

$baseURI='http://itunes.apple.com/us/rss/';
foreach($feedType as $feed):
foreach($genreArray as $genre=>$value):

$urlToParse=($genre=='All')?$baseURI.$feed.'/limit=300/xml':$baseURI.$feed.'/limit=300/genre='.$genre.'/xml';

$remote_file=preg_replace('/[:\/.?=]/','',$urlToParse).'.xml';



ftpUpload($remote_file,$urlToParse);

endforeach;
endforeach;


?>
