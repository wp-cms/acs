<?php 

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_dynamic_taxonomies_import')):

class acs_dynamic_taxonomies_import extends acs_module_import{
    
    function initialize(){
        
        // vars
        $this->hook = 'taxonomy';
        $this->name = 'acs_dynamic_taxonomies_import';
        $this->title = __('Import Taxonomies');
        $this->description = __('Import Taxonomies');
        $this->instance = acs_get_instance('acs_dynamic_taxonomies');
        $this->messages = array(
            'success_single'    => '1 taxonomy imported',
            'success_multiple'  => '%s taxonomies imported',
        );
        
    }
    
}

acs_register_admin_tool('acs_dynamic_taxonomies_import');

endif;