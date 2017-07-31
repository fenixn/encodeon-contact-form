<?php
namespace EncodeonContact\Views;
class Contact
{
    public function __construct() 
    {
        add_shortcode( "main_contact_form", array( $this, "contact_form_view" ) );
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

                <div class="field hidden">
                    <label for="Verification">
                        This field is hidden for human verification. If you can see it, leave it blank.
                    </label>
                    <input type="text" id="Verification" name="Verification">
                </div>

                <div class="row">
                    <div class="label-container">
                        <label for="Name">
                            <span class="required">*</span>
                            Name
                        </label>
                    </div><div class="input-container">
                        <input type="text" id="Name" name="Name" required
                        placeholder="Enter your name">
                    </div>
                </div>

                <div class="row">
                    <div class="label-container">
                        <label for="Phone">
                            <span class="required">*</span>
                            Phone
                        </label>
                    </div><div class="input-container">
                        <input type="tel" id="Phone" name="Phone" required
                        placeholder="Enter your phone number">
                    </div>
                </div>

                <div class="row">  
                    <div class="label-container">
                        <label for="Email">
                            <span class="required">*</span>
                            Email
                        </label>
                    </div><div class="input-container">
                        <input type="email" id="Email" name="Email" required
                        placeholder="Enter your email address">
                    </div>
                </div>

                <div class="row double">
                    <div class="label-container">
                        <label for="Message">Message</label>
                    </div><div class="input-container">
                        <textarea id="Message" class='block' name="Message"
                        placeholder="Let us know how we can help you."
                    ></textarea>
                    </div>
                </div>

                <div class="row submit">
                    <button type="submit" id="contact-form-submit">
                        Send message
                    </button>
                </div>

                <div class="form-response"></div>
            </form>
        </div>
        
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {         
            var form = $( "#encodeon-ajax-contact" );
            var wait_message = "Please wait while we validate and send your message..."
            
            $(function() {
                $(form).on( "submit", function( e )
                {
                    e.preventDefault();
                    
                    $( ".form-response" ).html( wait_message );
                    
                    var formData = $( form ).serialize();

                    $.ajax( {
                        url: "<?php echo admin_url( "admin-ajax.php" ); ?>",
                        type: "post",
                        data: formData,
                        success: function ( data, status ) 
                        {
                            if(data) 
                            {
                                $( ".form-response" ).html( data );
                                var data_return_status = $( "#data-return-status" ).data( "status" );
                                if ( data_return_status == false ) 
                                {
                                    $( "#contact-form-submit" ).prop( "disabled", false );
                                }
                            }
                        },
                        error: function ( xhr, desc, err ) 
                        {
                            console.log( xhr );
                            console.log( "Details: " + desc + "\nError:" + err );
                        }
                    } ); 
                    
                    $( "#contact-form-submit" ).prop( "disabled", true );
                });
            });
        });
        </script>
        
        <?php
    }
}
