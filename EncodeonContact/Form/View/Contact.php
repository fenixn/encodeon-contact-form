<?php
namespace EncodeonContact\Form\View;
class Contact extends View
{
    public function __construct() 
    {
        $this->enqueue_scripts();
        add_shortcode( "encodeon_contact_form", array( $this, "contact_form_view" ) );
    }
    
    public function contact_form_view()
    {
        ?>
        
        <div class="encodeon-form">
            <h1>Contact Form</h1>

            <form id="encodeon-ajax-contact" method="post" action="">

                <?php wp_nonce_field( "encodeon_php_mailer_send", "contact_form_nonce" ); ?>
                <input name="action" value="encodeon_php_mailer_send" type="hidden">
                
                <?php 
                    $this->honeypot(); 
        
                    $this->text_input( "Name", "Enter your name" );
                    $this->text_input( "Phone", "Enter your phone number", "tel" );
                    $this->text_input( "Email", "Enter your email address", "email" );
        
                    $this->textarea_input( "Message", "Let us know how we can help you.", false );
        
                    $this->submit_button();
                ?>

                <div class="form-response"></div>
            </form>
        </div>
        
        <?php
    }
}
