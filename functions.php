<?php 

require_once(get_theme_file_path('inc/tgm.php'));
require_once(get_theme_file_path('inc/attachment.php'));
require_once(get_theme_file_path('inc/cmb2-attached-posts.php'));
require_once(get_theme_file_path('widgets/social-icons-widget.php'));
require_once(get_theme_file_path('lib/csf/codestar-framework.php'));
require_once(get_theme_file_path('lib/csf/samples/admin-options.php'));
require_once(get_theme_file_path('lib/csf/samples/philosophy-theme-options.php'));
require_once(get_theme_file_path('inc/cs.php'));

if(site_url()=="http://localhost/philosopy"){
    define('VERSION', time());
}else{
    define('VERSION', wp_get_theme()->get('VERSION'));
}



function philosophy_theme_setup(){
    load_theme_textdomain('philosophy');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-list'));
    add_theme_support('post-formats', array ('audio', 'video', 'image', 'quote', 'link', 'gallery'));
    add_editor_style('assets/css/editor-style.css');

     //register menu
     register_nav_menus(array(
        'main-menu'=> __('Main Menu', 'philosophy'),
        'footer-left' =>__('Footer Left','philosophy'),
        'footer-middle' =>__('Footer Middle','philosophy'),
        'footer-right' =>__('Footer Right','philosophy'),
    ));
}
add_action('after_setup_theme', 'philosophy_theme_setup');

function philosophy_assets(){
    wp_enqueue_style('fontawesome-css', get_theme_file_uri('assets/css/font-awesome/css/font-awesome.css'),null);
    wp_enqueue_style('font-min-css', get_theme_file_uri('assets/css/font-awesome/css/font-awesome.min.css'),null);
    wp_enqueue_style('font-css', get_theme_file_uri('assets/css/font.css'),null);
    wp_enqueue_style('base-css', get_theme_file_uri('assets/css/base.css'),null);
    wp_enqueue_style('vendor-css', get_theme_file_uri('assets/css/vendor.css'),null);
    wp_enqueue_style('main-css', get_theme_file_uri('assets/css/main.css'),null);
    wp_enqueue_style('philosopy-css', get_stylesheet_uri(), null, VERSION);


    wp_enqueue_script('modanizer-js', get_theme_file_uri('assets/js/modernizr.js', null));
    wp_enqueue_script('pace-min-js', get_theme_file_uri('assets/js/pace.min.js', null));
    wp_enqueue_script('plugins-js', get_theme_file_uri('assets/js/plugins.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri('assets/js/main.js'), array('jquery'),'1.0', true);
}
add_action('wp_enqueue_scripts', 'philosophy_assets');

function philosophy_pagination(){
    global $wp_query;
    $link = paginate_links(array(
        'current' => max(1, get_query_var('paged')),
        'total'   => $wp_query->max_num_pages,
        'type'    => 'list',
        'mid_size'=> 3

    ));

    $link = str_replace('page-numbers', 'pgn__num', $link);
    $link = str_replace("<ul class='pgn__num'>", '<ul>', $link);
    $link = str_replace("next pgn__num", 'pgn__next', $link);
    $link = str_replace("prev pgn__num", 'pgn__prev', $link);
    echo $link;
}

remove_action("term_description","wpautop");

function philosophy_widgets(){
    register_sidebar( array(
        'name' => __( 'About Us Page', 'philosophy' ),
        'id' => 'about-us',
        'description' => __( 'Widgets in this area will be shown on about us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>'
    ) );
    register_sidebar( array(
        'name' => __( 'Contact Page Maps Section', 'philosophy' ),
        'id' => 'contact-maps',
        'description' => __( 'Widgets in this area will be shown on contact page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => ''
    ) );
    register_sidebar( array(
        'name' => __( 'Contact Page Information Section', 'philosophy' ),
        'id' => 'contact-info',
        'description' => __( 'Widgets in this area will be shown on contact page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>'
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Right Section', 'philosophy' ),
        'id' => 'footer-right',
        'description' => __( 'Footer Right information and Details.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Right Two Section', 'philosophy' ),
        'id' => 'footer-right-two',
        'description' => __( 'Footer Right two.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Bottom Section', 'philosophy' ),
        'id' => 'footer-bottom',
        'description' => __( 'Footer Bottom.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => ''
    ) );
    register_sidebar( array(
        'name' => __( 'Header Section', 'philosophy' ),
        'id' => 'header-section',
        'description' => __( 'Widgets in this area will be shown on Header section.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ) );
}
add_action("widgets_init","philosophy_widgets");

function philosophy_search_form($form){
    $home_dir = home_url("/");
    $lebel = __("Search for:","philosophy");
    $button_lebel = __("Search","philosophy");
    $post_type = <<<PT
     <input type= "hidden" name = "post_type" value = "post">
    PT;

    if(is_post_type_archive('book')){
        $post_type = <<<PT
        <input type= "hidden" name = "post_type" value = "book">
       PT;

    }

    $newform = <<<FORM
        <form role="search" method="get" class="header__search-form" action="{$home_dir}">
            <label>
                <span class="hide-content">{$lebel}</span>
                <input type="search" class="" placeholder="Type Keywords" value="" name="s" title="{$lebel}" autocomplete="off">
            </label>
            {$post_type}
            <input type="submit" class="search-submit" value="{$button_lebel}">
        </form>

    FORM;

}
add_filter("get_search_form", "philosophy_search_form");


function before_title_category(){
    echo "<h2>Before title change</h2>";

}
add_action('philosophy_before_category_title', 'before_title_category');


function after_title_category(){
    echo "<h2>After title change</h2>";

}
add_action('philosophy_after_category_title', 'after_title_category');

function philosophy_cptr_slug_fix($post_link, $id){
    $post = get_post($id);
    if(is_object($post) && 'chaptar'== get_post_type($id)){
        $parent_post_id = get_field('parent_book');
        $parent_post = get_post($parent_post_id);
        if($parent_post){
            $post_link = str_replace('%book%', $parent_post->post_name, $post_link);
        };        
    }
    return $post_link;
}
add_filter('post_type_link', 'philosophy_cptr_slug_fix',1, 2);

function philosophy_footer_language_heading($title){
    if(is_post_type_archive('book') || is_tax('language')){
        $title = __('Languages', 'philosophy');
    }
    return $title;
}
add_filter('philosophy_footer_tag_heading','philosophy_footer_language_heading');



function philosophy_footer_tag_heading($tags){
    if(is_post_type_archive('book') || is_tax('language')){
        $tags = get_terms(array(
            'taxonomy' => 'language',
            'hide_empty' =>true
        ));
    }
    return $tags;
}
add_filter('philosophy_footer_tag_items','philosophy_footer_tag_heading');





































