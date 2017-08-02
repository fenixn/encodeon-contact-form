<?php
namespace EncodeonContact\Form;
class Form extends \EncodeonContact\Plugin
{
    public function __construct()
    {
        
    }
    
    protected function honeypot()
    {
        new Input\Honeypot;
    }
    
    protected function text_input( $input_name, $input_placeholder, $input_type = "text", $is_required = true )
    {
        new Input\Text( $input_name, $input_placeholder, $input_type, $is_required ); 
    }
    
    protected function textarea_input( $input_name, $input_placeholder, $is_required = true )
    {
        new Input\Textarea( $input_name, $input_placeholder, $is_required );
    }
    
    protected function submit_button( $label = "Send message" )
    {
        new Input\Submit( $label );
    }
}
