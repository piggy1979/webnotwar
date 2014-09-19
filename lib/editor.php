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
//	$in['plugins']='tabfocus,paste,table,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	$in['content_css']= "/wp-content/themes/webnotwar/assets/css/editor-style.css";
	$in['wpautop']=true;
	$in['apply_source_formatting']=false;
	$in['toolbar1']='formatselect,bold,italic,underline,|,bullist,numlist,blockquote,|,alignleft,aligncenter,alignright,|,link,unlink,|,wp_fullscreen,wp_adv';
	$in['toolbar2']='styleselect,tablecontrols,pastetext,removeformat,|,code,charmap,|,undo,redo';

	return $in;
}
//add_filter('tiny_mce_before_init', 'formatTinyMCE' );
function myplugin_tinymce_buttons($buttons){

		$buttons = array(
			'styleselect',
			'formatselect',
			'pastetext',
			'table',
			'undo'
			);
      return $buttons;
}

function myplugin_tinymce_main($buttons){

	$remove = array(
		'strikethrough',
		'spellchecker'
		);

	return array_diff($buttons,$remove);

	return $buttons;
}

add_filter('mce_buttons','myplugin_tinymce_main');
add_filter('mce_buttons_2','myplugin_tinymce_buttons');

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
				array(
					'title' 	=> 'Responsive Image',
					'selector' 	=> 'img',
					'classes'	=> 'respondimg'
				),
				array(
					'title' 	=> 'Max Image Width: 500',
					'selector' 	=> 'img',
					'classes'	=> 'img500'
				),
				array(
					'title' 	=> 'Max Image Width: 300',
					'selector' 	=> 'img',
					'classes'	=> 'img300'
				),
				array(
					'title' 	=> 'Max Image Width: 100',
					'selector' 	=> 'img',
					'classes'	=> 'img100'
				),
				array(
					'title' 	=> 'Responsive Vid',
					'block' 	=> 'div',
					'classes'	=> 'respondvid',
					'wrapper'	=> true
				),

			),
		),
	);
$init['style_formats_merge'] = true;
$init['style_formats'] = json_encode( $classes );	
	return $init;
}
add_filter( 'tiny_mce_before_init', 'custom_mce_styles'  );

function custom_mce_plugin($plugin_array){
   $plugin_array['table'] = '/wp-content/themes/webnotwar/lib/table/plugin.min.js';
   return $plugin_array;
}

add_filter('mce_external_plugins', 'custom_mce_plugin');

add_filter('mce_buttons', 'myplugin_register_buttons');

function myplugin_register_buttons($buttons) {
   array_push($buttons, 'separator', 'table');
   return $buttons;
}


