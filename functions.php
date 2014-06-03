<?php
/* ----------------------------------------------------------------------------------- */
/*  REGISTER THEME MENU
/* ----------------------------------------------------------------------------------- */
	if(function_exists('register_nav_menus')){
		register_nav_menus(array('main_menu' => 'Main Menu'));
	}

/* ----------------------------------------------------------------------------------- */
/*  ENQUEUE STYLES AND SCRIPTS
/* ----------------------------------------------------------------------------------- */
function my_init_method() {
	wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
}
add_action('init', 'my_init_method'); // 加入功能, 前台使用 wp_enqueue_script( '名称' ) 加載
	function mypassion_scripts() {

		/* ---------------------------------------------------------------------------------- */
		/* Register Scripts
		/* ---------------------------------------------------------------------------------- */
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', 'jquery', '2.1.0', false);
        wp_register_script('ratchet', get_template_directory_uri().'/framework/js/ratchet.min.js','ratchet','2.1.1',TRUE);

		/* ---------------------------------------------------------------------------------- */
		/* Enqueue Scripts 
		/* ---------------------------------------------------------------------------------- */
		wp_enqueue_script('jquery');
		wp_enqueue_script('ratchet');

	}
	
	add_action( 'wp_enqueue_scripts', 'mypassion_scripts' );
	function mypassion_styles(){
		/* ---------------------------------------------------------------------------------- */
		/* Register Stylesheets 
		/* ---------------------------------------------------------------------------------- */
        wp_register_style('rathchet',get_template_directory_uri().'/framework/css/ratchet.min.css');
        wp_register_style('detail-extend',get_template_directory_uri().'/framework/css/extend.css');
        wp_register_style('font-awesome', get_template_directory_uri().'/framework/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('rathchet');
        wp_enqueue_style('detail-extend');
	}  
	add_action( 'wp_enqueue_scripts', 'mypassion_styles', 1 ); 



	//	ADMIN PANEL STYLES & SCRIPTS
	add_action('init', 'style_and_script');
		
	function style_and_script(){ 
		//wp_register_script('metasortable', get_template_directory_uri().'/framework/meta-box/meta-sortable.js', 'jquery', '1.0');
		//wp_register_script('review', get_template_directory_uri().'/framework/meta-box/review.js', 'jquery', '1.0');
		add_action('add_meta_boxes', 'register_meta_script');
	}	
	function register_meta_script(){
		
		//wp_enqueue_script('review');
		//wp_enqueue_script('metasortable');
	} 
	
	   
/* ------------------------------------------------------------------------ */
/*  Inlcudes
/* ------------------------------------------------------------------------ */

	include_once('framework/inc/shortcodes.php'); // Load Shortcodes


/* ----------------------------------------------------------------------------------- */
/*  Add filter to hook when user press "insert into post" to include the attachment id
/* ----------------------------------------------------------------------------------- */

	add_filter('media_send_to_editor', 'add_para_media_to_editor', 20, 2);
	function add_para_media_to_editor($html, $id){
	
		$pos = strpos('<a', $html) + 2;
		$html = substr($html, 0, $pos) . ' attid="' . $id . '" ' . substr($html, $pos);
		
		return $html ;
		
	}


	function custom_excerpt_length( $length ) {
		global $admin_data;
		$length = $admin_data['excerpt_length'];
		return $length;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	function new_excerpt_more( $more ) {
		global $admin_data;
		$excerpt = $admin_data['excerpt_style'];
		
		switch($excerpt){
			
			case 'excerpt1': 	return ' [...]';
			break;
			
			case 'excerpt2': 	return ' ...';
			break;
			
			case 'excerpt3': 	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' .__('Read more', 'framework').'</a>';
			break;
			
		}
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	/*function quickchic_widgets_init() {
		register_sidebar(array(
		'name' => __( 'Sidebar 1', 'quickchic' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div class="sidebar widget">',
		'after_widget' => '</div>',
		'before_title'  => '<h5 class="line"><span>',
		'after_title'   => '</span></h5><span class="liner"></span>'
		));
	}
	add_action( 'init', 'quickchic_widgets_init' );*/
	
	
	function the_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}
	
	if ( ! isset( $content_width ) ) $content_width = 960;
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp_list_comments' );
	

/*-----------------------------------------------------------------------------------*/
/*	Register Post Thumbnails
/*-----------------------------------------------------------------------------------*/	
	if( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
		add_image_size( 'slider-thumb', 540, 372, true); // for the portfolio template
		add_image_size( 'slider-thumb-2', 380, 217, true); // for the single blog template
		add_image_size( 'slider-thumb-3', 180, 135, true); // for the single portfolio template
		add_image_size( 'main-small-thumb', 160, 86, true); // for the blog template
		add_image_size( 'main-medium-thumb', 300, 162, true); // for the portfolio template
		add_image_size( 'main-big-thumb', 620, 427, true); // for the portfolio template
	}

	
/* ----------------------------------------------------------------------------------- */
/*  Add Post Formats
/* ----------------------------------------------------------------------------------- */
	//add_theme_support( 'post-formats', array('gallery', 'video'));

	function signOffText() {  
		return 'Thank you so much for reading! And remember to subscribe to our RSS feed.';  
	}
	
	add_shortcode('signoff', 'signOffText');  

/* ----------------------------------------------------------------------------------- */
/*  Get rid of the font-size on the tagcloud widget
/* ----------------------------------------------------------------------------------- */
	
	function my_tag_cloud_args($in)
	{
		return "smallest=12&largest=12&number=40&orderby=name&unit=px";
	}
	add_filter("widget_tag_cloud_args", 'my_tag_cloud_args');
	
	
	add_filter( 'avatar_defaults', 'newgravatar' ); 
	function newgravatar ($avatar_defaults) { 
		$myavatar = get_template_directory() . '/framework/img/avatar.png'; 
		$avatar_defaults[$myavatar] = "WPBeginner"; 
		 
		return $avatar_defaults; 
  }
/*-------------------------------
 *获取相邻附件的，返回其id
--------------------------------*/
function get_adjacent_attachment($next = true){
  global $post;
  $post = get_post( get_post()->post_parent );
  $post = get_adjacent_post(false,'',$next);
  $id = $post->ID;
  wp_reset_postdata();
  return $id;
}
/*---------------------------
 * 为名片添加数据库表
----------------------------*/
function add_contact_sql(){
  /*创建表，name为唯一的数值，不可重复*/
  global $wpdb;
  $table_name = $wpdb->prefix.'ezyplus_agency';
  if($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'")!= $table_name){
    $sql = "
      CREATE TABLE $table_name(
        agency_id int(20) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL ,
        phone varchar(30),
        email varchar(255),
        description text,
        photo_url varchar(255),
        PRIMARY KEY(agency_id),
        UNIQUE(name)
      )ENGINE=MyISAM DEFAULT CHARSET=utf8;
    ";
  $wpdb->show_errors();
  $wpdb->query($sql);
  }

}
add_action('after_setup_theme','add_contact_sql');
/*---------------
 *新增联系人数据
 *传入一个数组，形式为
 array(
  'name'=>$name,
  'phone'=>$phone,
  'email'=>$email,
  'wechat'=>$wechat,
  'weibo'=>$weibo,
  'description'=>$description,
  'photo_url'=>$photo_url,
  'qr_url'=>$qr_url
 )
------------------*/
include_once(TEMPLATEPATH.'/agency_management.php');
