<?php 

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_dynamic_post_types_export')):

class acs_dynamic_post_types_export extends acs_module_export{
    
    function initialize(){
    
        // vars
        $this->name = 'acs_dynamic_post_types_export';
        $this->title = __('Export Post Types');
        $this->description = __('Export Post Types');
        $this->select = __('Select Post Types');
        $this->default_action = 'json';
        $this->allowed_actions = array('json', 'php');
        $this->instance = acs_get_instance('acs_dynamic_post_types');
        $this->file = 'post-type';
        $this->files = 'post-types';
        $this->messages = array(
            'not_found'         => __('No post type available.'),
            'not_selected'      => __('No post types selected'),
            'success_single'    => '1 post type exported',
            'success_multiple'  => '%s post types exported',
        );
        
    }
    
}

acs_register_admin_tool('acs_dynamic_post_types_export');

endif;