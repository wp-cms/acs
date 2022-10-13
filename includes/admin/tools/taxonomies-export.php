<?php 

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_dynamic_taxonomies_export')):

class acs_dynamic_taxonomies_export extends acs_module_export{
    
    function initialize(){
        
        // vars
        $this->name = 'acs_dynamic_taxonomies_export';
        $this->title = __('Export Taxonomies');
        $this->description = __('Export Taxonomies');
        $this->select = __('Select Taxonomies');
        $this->default_action = 'json';
        $this->allowed_actions = array('json', 'php');
        $this->instance = acs_get_instance('acs_dynamic_taxonomies');
        $this->file = 'taxonomy';
        $this->files = 'taxonomies';
        $this->messages = array(
            'not_found'         => __('No taxonomy available.'),
            'not_selected'      => __('No taxonomies selected'),
            'success_single'    => '1 taxonomy exported',
            'success_multiple'  => '%s taxonomies exported',
        );
        
    }
    
}

acs_register_admin_tool('acs_dynamic_taxonomies_export');

endif;