<?php
   /*
   Plugin Name: JET TOC Builder
   Plugin URI: http://trianglewebtech.com
   Description: Builds a table of contents based on h2/h3 tags in post content
   Version: 1.0
   Author: Jonathan Tweedy
   Author URI: http://trianglewebtech.com
   License: GPL2
   */
   

function jet_toc_builder( $atts ){
	$id = $atts["id"];
	$content_post = get_post($id);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	
	$html = $content;
	$html = preg_replace("/<a id='jet_toc_[0-9]+'><\/a>/s", "", $html);
	$hpattern = "/<h([2|3|4]).*?>(.*?)<\/h\\1>/si";
	$menuHTML = "";
	if (preg_match_all($hpattern, $html, $matches)) {
		for ($m=0;$m<count($matches[0]);$m++) {
			$matches[1][$m] = strtoupper($matches[1][$m]);
			$anc = "jet_toc_".$m;
			$menuHTML .= "<a href='#".$anc."' style='display:block;";
			if ($matches[1][$m]=="3") {
				$menuHTML .= " margin-left:1em;";
			}
			if ($matches[1][$m]=="4") {
				$menuHTML .= " margin-left:2em;";
			}
			$linkText = strip_tags($matches[2][$m]);
			$menuHTML .= "'>".$linkText."</a>\n";
			$html = preg_replace("/<[h|H]".$matches[1][$m]."/", "<a id='jet_toc_".$m."'></a><##h".$matches[1][$m], $html, 1);
		}
		$html = str_replace("<##h", "<h", $html);
	}
	$new_post = array(
		'ID'           => $id,
		'post_title'   => $content_post->post_title,
		'post_content' => $html,
	);
	wp_update_post($new_post, true);
	return $menuHTML;
}
add_shortcode( 'jet_toc_builder', 'jet_toc_builder' );
   
   
?>
