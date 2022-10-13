<?php 

if(!defined('ABSPATH'))
    exit;

if(!class_exists('acs_module_import')):

class acs_module_import extends ACS_Admin_Tool{
    
    public $hook;
    public $description;
    public $instance;
    public $messages = array();
    
    function html(){
        
        ?>
        <p><?php echo $this->description; ?></p>
        
        <div class="acs-fields">
            <?php 
            
            acs_render_field_wrap(array(
                'label'     => __('Select File', 'acs'),
                'type'      => 'file',
                'name'      => 'acs_import_file',
                'value'     => false,
                'uploader'  => 'basic',
            ));
            
            ?>
        </div>
        
        <p class="acs-submit">
            <button type="submit" name="action" class="button button-primary"><?php _e('Import File'); ?></button>
        </p>
        <?php
        
    }
    
    function submit(){
    
        // Validate
        $json = $this->validate_file();
        
        if(!$json)
            return;
        
        $ids = array();
        
        // Loop over json
        foreach($json as $name => $args){
        
            // Import
            $post_id = $this->instance->import($name, $args);
            
            // Insert error
            if(is_wp_error($post_id)){
            
                acs_add_admin_notice($post_id->get_error_message(), 'warning');
                continue;
            
            }
            
            // append message
            $ids[] = $post_id;
            
        }
        
        if(empty($ids))
            return;
        
        // Count total
        $total = count($ids);
        
        // Generate text
        $text = sprintf(_n($this->messages['success_single'], $this->messages['success_multiple'], $total, 'acs'), $total);
        
        // Add links to text
        $links = array();
        foreach($ids as $id){
            $links[] = '<a href="' . get_edit_post_link($id) . '">' . get_the_title($id) . '</a>';
        }
        
        $text .= ': ' . implode(', ', $links);
        
        // Add notice
        acs_add_admin_notice($text, 'success');
        
        // Do Action
        do_action("acs/{$this->hook}/import", $ids, $json);
        
    }
    
    function validate_file(){
        
        // Check file size.
        if(empty($_FILES['acs_import_file']['size'])){
            
            acs_add_admin_notice(__("No file selected", 'acs'), 'warning');
            return false;
            
        }
        
        // Get file data.
        $file = $_FILES['acs_import_file'];
        
        // Check errors.
        if($file['error']){
            
            acs_add_admin_notice(__("Error uploading file. Please try again", 'acs'), 'warning');
            return false;
            
        }
        
        // Check file type.
        if(pathinfo($file['name'], PATHINFO_EXTENSION) !== 'json'){
            
            acs_add_admin_notice(__("Incorrect file type", 'acs'), 'warning');
            return false;
            
        }
        
        // Read JSON.
        $json = file_get_contents($file['tmp_name']);
        $json = json_decode($json, true);
        
        // Check if empty.
        if(!$json || !is_array($json)){
            
            acs_add_admin_notice(__("Import file empty", 'acs'), 'warning');
            return false;
            
        }
        
        return $json;
        
    }
    
}

endif;