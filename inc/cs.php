<?php
define('CS_ACTIVE_FRAMEWORK', false);
define('CS_ACTIVE_METABOX', true);
define('CS_ACTIVE_TAXONOMY', false);
define('CS_ACTIVE_SHORTCODE', false);
define('CS_ACTIVE_CUSTOMIZE', false);


// function philosophy_csf_metabox(){
//     CSFramework_Metabox::instance(array());
// }

// add_action('init', 'philosophy_csf_metabox');



function philosophy_meta_box_options(){
    $options[] = array(
        'id' => 'page-metabox',
        'title'=>'__(page meta information', 'philosophy)',
        'post_type'=>'page',
        'context'=>'normal',
        'priority'=>'default',
        'section'=>array(
            array(
                'name'=>'page-section1',
                'title'=>'__(page setting', 'philosophy)',
                'icon'=>'fa fa-image',
                'fields'=> 
                array(
                    'id'=>'page-heading',
                    'type'=>'text',
                    'default'=>'__(page heading', 'philosophy)',
                ),
                array(
                    
                        'id'      => 'opt-textarea',
                        'type'    => 'textarea',
                        'title'   => 'Textarea',                     
                        'default' =>'__(teaser text', 'philosophy)',
                ),            
                array(
                    'id'=>'is-favorite',
                    'type'=>'switcher',
                    'default'=> 1,
                ),
            )
        )
    );

    return $options;
}
add_filter('cs_metabox_options', 'philosophy_meta_box_options');