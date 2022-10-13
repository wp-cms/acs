<?php

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_field_slug')):

class acs_field_slug extends acs_field{
    
    function __construct(){
        
        $this->name = 'acs_slug';
        $this->label = __('Slug', 'acs');
        $this->category = 'basic';
        $this->defaults = array(
            'default_value' => '',
            'maxlength'     => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => ''
        );
        
        parent::__construct();
        
    }
    
    function render_field($field){
        
        $field['type'] = 'text';
        
        acs_get_field_type('text')->render_field($field);
        
    }
    
    function render_field_settings($field){
        
        // default_value
        acs_render_field_setting($field, array(
            'label'         => __('Default Value','acs'),
            'instructions'  => __('Appears when creating a new post','acs'),
            'type'          => 'text',
            'name'          => 'default_value',
        ));
        
        // placeholder
        acs_render_field_setting($field, array(
            'label'         => __('Placeholder Text','acs'),
            'instructions'  => __('Appears within the input','acs'),
            'type'          => 'text',
            'name'          => 'placeholder',
        ));
        
        // prepend
        acs_render_field_setting($field, array(
            'label'         => __('Prepend','acs'),
            'instructions'  => __('Appears before the input','acs'),
            'type'          => 'text',
            'name'          => 'prepend',
        ));
        
        // append
        acs_render_field_setting($field, array(
            'label'         => __('Append','acs'),
            'instructions'  => __('Appears after the input','acs'),
            'type'          => 'text',
            'name'          => 'append',
        ));
        
        // maxlength
        acs_render_field_setting($field, array(
            'label'         => __('Character Limit','acs'),
            'instructions'  => __('Leave blank for no limit','acs'),
            'type'          => 'number',
            'name'          => 'maxlength',
        ));
        
    }
    
    function validate_value($valid, $value, $field, $input){
        
        $value = sanitize_title($value);
        
        if($field['maxlength'] && mb_strlen(wp_unslash($value)) > $field['maxlength'])
            return sprintf(__('Value must not exceed %d characters', 'acs'), $field['maxlength']);
        
        return $valid;
        
    }
    
    function update_value($value, $post_id, $field){
        
        return sanitize_title($value);
        
    }
    
}

// initialize
acs_register_field_type('acs_field_slug');

endif;