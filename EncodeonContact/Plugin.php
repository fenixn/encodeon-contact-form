<?php
namespace EncodeonContact;
class Plugin
{
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue_scripts' ) );
        
        new Forms\Settings;
        new Forms\Contact;
        new Views\Contact;
    }
    
    public function enqueue_scripts()
    {
        wp_enqueue_style(
            'contact-form',
            plugin_dir_url( __DIR__ ) . 'css/stylesheets/contact-form.css',
            array(), 
            '1.00', 
            'all'
        );
    }
}
