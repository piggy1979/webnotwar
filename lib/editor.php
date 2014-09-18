<?php

// Fix some of the annoying things about MCE
// Also includes editor-style.css
function formatTinyMCE($in)
{

	$in['remove_linebreaks']=false;
	$in['gecko_spellcheck']=false;
	$in['keep_styles']=true;
	$in['accessibility_focus']=true;
	$in['tabfocus_elements']='major-publishing-actions';
	$in['media_strict']=false;
	$in['paste_remove_styles']=false;
	$in['paste_remove_spans']=false;
	$in['paste_strip_class_attributes']='none';
	$in['paste_text_use_dialog']=true;
	$in['wpeditimage_disable_captions']=true;
	$in['plugins']='tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	$in['content_css']= "/wp-content/themes/webnotwar/assets/css/editor-style.css";
	$in['wpautop']=true;
	$in['apply_source_formatting']=false;
	$in['toolbar1']='formatselect,bold,italic,underline,|,bullist,numlist,blockquote,|,alignleft,aligncenter,alignright,|,link,unlink,|,wp_fullscreen,wp_adv';
	$in['toolbar2']='styleselect,pastetext,pasteword,removeformat,|,code,charmap,|,undo,redo';

	return $in;
}
add_filter('tiny_mce_before_init', 'formatTinyMCE' );

// Give some custom styling options in the editor
function custom_mce_styles( $init ) {
	//$init['toolbar2'] = 'styleselect';
	$classes= array(
		array(
			'title' => __('Custom Styles', 'styleselctlist'),
			'items' => array(

				array(
					'title' 	=> 'Button',
					'selector' 	=> 'a',
					'classes'	=> 'btn'
				),
				array(
					'title' 	=> 'Tool Tip (include Title)',
					'selector' 	=> 'a',
					'classes'	=> 'inlinetooltip'
				),
				array(
					'title' 	=> 'Show Code',
					'block' 	=> 'pre',
					'classes'	=> 'prettyprint linenums'
				),

			),
		),
	);
$init['style_formats_merge'] = true;
$init['style_formats'] = json_encode( $classes );	
	return $init;
}
add_filter( 'tiny_mce_before_init', 'custom_mce_styles'  );