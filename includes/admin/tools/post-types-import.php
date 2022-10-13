<?php 

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_dynamic_post_types_import')):

class acs_dynamic_post_types_import extends acs_module_import{

    function initialize(){
        
        // vars
        $this->hook = 'post_type';
        $this->name = 'acs_dynamic_post_types_import';
        $this->title = __('Import Post Types');
        $this->description = __('Import Post Types');
        $this->instance = acs_get_instance('acs_dynamic_post_types');
        $this->messages = array(
            'success_single'    => '1 post type imported',
            'success_multiple'  => '%s post types imported',
        );
        
    }
    
}

acs_register_admin_tool('acs_dynamic_post_types_import');

endif;