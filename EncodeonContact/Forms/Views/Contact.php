<?php
namespace EncodeonContact\Forms\Views;
class Contact
{
    public function __construct() 
    {
        add_shortcode( "encodeon_contact_form", array( $this, "contact_form_view" ) );
        
        wp_enqueue_script(
            'form-ajax-request',
            plugin_dir_url( __DIR__ ) . '../../js/form-ajax-request.js',
            array( 'jquery' ), 
            '1.00', 
            true
        );
    }
    
    public function contact_form_view()
    {
        ?>
        
        <div class="encodeon-form">
            <h1>Contact Form</h1>

            <form id="encodeon-ajax-contact" method="post" action="">

                <?php wp_nonce_field( "encodeon_php_mailer_send", "contact_form_nonce" ); ?>
                <input name="action" value="encodeon_php_mailer_send" type="hidden">
                <input name="form-name" value="Contact Form" type="hidden">
                
                <?php 
                    new \EncodeonContact\Forms\Inputs\Honeypot(); 
        
                    new \EncodeonContact\Forms\Inputs\Text( "Name", "Enter your name" ); 
                    new \EncodeonContact\Forms\Inputs\Text( "Phone", "Enter your phone number", "tel" ); 
                    new \EncodeonContact\Forms\Inputs\Text( "Email", "Enter your email address", "email");
        
                    new \EncodeonContact\Forms\Inputs\Textarea( "Message", "Let us know how we can help you.", false ); 
        
                    new \EncodeonContact\Forms\Inputs\Submit();
                ?>

                <div class="form-response"></div>
            </form>
        </div>
        
        <?php
    }
}
