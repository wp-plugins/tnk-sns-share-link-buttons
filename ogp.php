<?php
function onWpHead(){

if (have_posts()){
	if(is_single()) the_post();
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<?php
	if (has_post_thumbnail()){
		$image_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image_src($image_id, "full");
		$img = $image[0];
	}else{
		global $setting;
		$img = $setting["default_thumb"];
	}
	if(is_single()){
		$type = "article";
		$desc = get_the_excerpt();
		if(empty($desc)) $txt = get_the_content();
		$len = strlen($desc);
		$desc = mb_substr($desc, 0, 100);
		if(strlen($desc) < $len) $desc .= "...";
	}else{
		$type = "website";
		$desc = get_bloginfo("description");
	}
?>
<meta property="og:image" content="<?php echo $img; ?>" />
<meta property="og:type" content="<?php echo $type; ?>" />
<meta property="og:description" content="<?php echo $desc; ?>" />
<meta property="twitter:card" content="summary" />
<?php
	if(is_single()) rewind_posts();
}

}
?>