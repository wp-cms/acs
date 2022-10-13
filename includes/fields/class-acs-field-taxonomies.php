<?php

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_field_taxonomies')):

class acs_field_taxonomies extends acs_field{
    
    function __construct(){
        
        $this->name = 'acs_taxonomies';
        $this->label = __('Taxonomies', 'acs');
        $this->category = 'WP';
        $this->defaults = array(
            'taxonomy'              => array(),
            'field_type'            => 'checkbox',
            'multiple'              => 0,
            'allow_null'            => 0,
            'choices'               => array(),
            'default_value'         => '',
            'ui'                    => 0,
            'ajax'                  => 0,
            'placeholder'           => '',
            'search_placeholder'    => '',
            'layout'                => '',
            'toggle'                => 0,
            'allow_custom'          => 0,
            'return_format'         => 'object',
        );
        
        parent::__construct();
        
    }
    
    function render_field_settings($field){
        
        if(isset($field['default_value']))
            $field['default_value'] = acs_encode_choices($field['default_value'], false);
        
        // Allow Taxonomy
        acs_render_field_setting($field, array(
            'label'         => __('Allow Taxonomy','acs'),
            'instructions'  => '',
            'type'          => 'select',
            'name'          => 'taxonomy',
            'choices'       => acs_get_taxonomy_labels(),
            'multiple'      => 1,
            'ui'            => 1,
            'allow_null'    => 1,
            'placeholder'   => __("All taxonomies",'acs'),
        ));
        
        // field_type
        acs_render_field_setting($field, array(
            'label'         => __('Appearance','acs'),
            'instructions'  => __('Select the appearance of this field', 'acs'),
            'type'          => 'select',
            'name'          => 'field_type',
            'optgroup'      => true,
            'choices'       => array(
                'checkbox'      => __('Checkbox', 'acs'),
                'radio'         => __('Radio Buttons', 'acs'),
                'select'        => _x('Select', 'noun', 'acs')
            )
        ));
        
        // default_value
        acs_render_field_setting($field, array(
            'label'         => __('Default Value','acs'),
            'instructions'  => __('Enter each default value on a new line','acs'),
            'name'          => 'default_value',
            'type'          => 'textarea',
        ));
        
        // return_format
        acs_render_field_setting($field, array(
            'label'         => __('Return Value', 'acs'),
            'instructions'  => '',
            'type'          => 'radio',
            'name'          => 'return_format',
            'choices'       => array(
                'object'        => __('Taxonomy object', 'acs'),
                'name'          => __('Taxonomy name', 'acs')
            ),
            'layout'        => 'horizontal',
        ));
        
        // Select + Radio: allow_null
        acs_render_field_setting($field, array(
            'label'         => __('Allow Null?','acs'),
            'instructions'  => '',
            'name'          => 'allow_null',
            'type'          => 'true_false',
            'ui'            => 1,
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                ),
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'radio',
                    ),
                ),
            )
        ));
        
        // Select: multiple
        acs_render_field_setting($field, array(
            'label'         => __('Select multiple values?','acs'),
            'instructions'  => '',
            'name'          => 'multiple',
            'type'          => 'true_false',
            'ui'            => 1,
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                ),
            )
        ));
        
        // Select: ui
        acs_render_field_setting($field, array(
            'label'         => __('Stylised UI','acs'),
            'instructions'  => '',
            'name'          => 'ui',
            'type'          => 'true_false',
            'ui'            => 1,
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                ),
            )
        ));
                
        
        // Select: ajax
        acs_render_field_setting($field, array(
            'label'         => __('Use AJAX to lazy load choices?','acs'),
            'instructions'  => '',
            'name'          => 'ajax',
            'type'          => 'true_false',
            'ui'            => 1,
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => 1,
                    ),
                ),
            )
        ));
    
        // Select: Placeholder
        acs_render_field_setting($field, array(
            'label'             => __('Placeholder','acs'),
            'instructions'      => __('Appears within the input','acs'),
            'type'              => 'text',
            'name'              => 'placeholder',
            'placeholder'       => _x('Select', 'verb', 'acs'),
            'conditional_logic' => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => '0',
                    ),
                    array(
                        'field'     => 'allow_null',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                    array(
                        'field'     => 'multiple',
                        'operator'  => '==',
                        'value'     => '0',
                    ),
                ),
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                    array(
                        'field'     => 'allow_null',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                ),
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                    array(
                        'field'     => 'multiple',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                ),
            )
        ));
    
        // Select: Search Placeholder
        acs_render_field_setting($field, array(
            'label'             => __('Search Input Placeholder','acs'),
            'instructions'      => __('Appears within the search input','acs'),
            'type'              => 'text',
            'name'              => 'search_placeholder',
            'placeholder'       => '',
            'conditional_logic' => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                    array(
                        'field'     => 'multiple',
                        'operator'  => '==',
                        'value'     => '0',
                    ),
                ),
            )
        ));
        
        // Radio: other_choice
        acs_render_field_setting($field, array(
            'label'         => __('Other','acs'),
            'instructions'  => '',
            'name'          => 'other_choice',
            'type'          => 'true_false',
            'ui'            => 1,
            'message'       => __("Add 'other' choice to allow for custom values", 'acs'),
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'radio',
                    ),
                ),
            )
        ));
        
        // Checkbox: layout
        acs_render_field_setting($field, array(
            'label'         => __('Layout','acs'),
            'instructions'  => '',
            'type'          => 'radio',
            'name'          => 'layout',
            'layout'        => 'horizontal', 
            'choices'       => array(
                'vertical'      => __("Vertical",'acs'),
                'horizontal'    => __("Horizontal",'acs')
            ),
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'checkbox',
                    ),
                ),
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'radio',
                    ),
                ),
            )
        ));
        
        // Checkbox: toggle
        acs_render_field_setting($field, array(
            'label'         => __('Toggle','acs'),
            'instructions'  => __('Prepend an extra checkbox to toggle all choices','acs'),
            'name'          => 'toggle',
            'type'          => 'true_false',
            'ui'            => 1,
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'checkbox',
                    ),
                ),
            )
        ));
        
        // Checkbox: other_choice
        acs_render_field_setting($field, array(
            'label'         => __('Allow Custom','acs'),
            'instructions'  => '',
            'name'          => 'allow_custom',
            'type'          => 'true_false',
            'ui'            => 1,
            'message'       => __("Allow 'custom' values to be added", 'acs'),
            'conditions'    => array(
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'checkbox',
                    ),
                ),
                array(
                    array(
                        'field'     => 'field_type',
                        'operator'  => '==',
                        'value'     => 'select',
                    ),
                    array(
                        'field'     => 'ui',
                        'operator'  => '==',
                        'value'     => '1',
                    ),
                )
            )
        ));
        
    }
    
    function update_field($field){
        
        $field['default_value'] = acs_decode_choices($field['default_value'], true);
        
        if($field['field_type'] === 'radio')
            $field['default_value'] = acs_unarray($field['default_value']);
        
        return $field;
        
    }
    
    function prepare_field($field){
        
        // Set Field Type
        $field['type'] = $field['field_type'];
        
        // Choices
        $field['choices'] = acs_get_taxonomy_labels($field['taxonomy']);
        
        // Allow Custom
        if(acs_maybe_get($field, 'allow_custom')){
            
            if($value = acs_maybe_get($field, 'value')){
                
                $value = acs_get_array($value);
                
                foreach($value as $v){
                    
                    if(isset($field['choices'][$v]))
                        continue;
                    
                    $field['choices'][$v] = $v;
                    
                }
                
            }
            
        }
        
        return $field;
        
    }
    
    function format_value($value, $post_id, $field){
    
        // Bail early
        if(empty($value))
            return $value;
    
        // Vars
        $is_array = is_array($value);
        $value = acs_get_array($value);
    
        // Loop
        foreach($value as &$v){
        
            // Retrieve Object
            $object = get_taxonomy($v);
        
            if(!$object || is_wp_error($object))
                continue;
        
            // Return: Object
            if($field['return_format'] === 'object'){
            
                $v = $object;
            
            }
        
        }
    
        // Do not return array
        if(!$is_array){
            $value = acs_unarray($value);
        }
    
        // Return
        return $value;
        
    }

}

// initialize
acs_register_field_type('acs_field_taxonomies');

endif;