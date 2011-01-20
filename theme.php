<li class='round'> 

<image style="float:left" src="<?php echo $app_image; ?>"/>
<div class='holder'>
<h4 style='text-align:center;'><?php echo $post_title;?></h4>

<div class='content'><?php echo $post_excerpt;?></div>
<?php if($read_more!=''):?>
<div class='more'>Read more</div>
<?php endif;?>
<div class='read-more'><?php echo $read_more;?></div>

<div style="clear:both;"></div>
</div>

</li>
