<?php
namespace EncodeonContact;
class Plugin
{
    public function __construct()
    {
        add_action( 'activate_encodeon-contact-form/autoloader.php', array( $this, 'on_plugin_activate' ) );
        add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue_scripts' ) );
        
        new Admin\ContactForm;
        new Admin\Mailer;
        new Forms\Contact;
        new Forms\Views\Contact;
        new Mailer\Mailer;
    }
    
    public function on_plugin_activate()
    {
        // Write dynamic js
        $this->write_ajax_request_js();
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
    
    /*
     * Write form-ajax-request.js to file
     */
    public function write_ajax_request_js() {
        /* Turn on output buffering and write output to string */
        ob_start();
            echo $this->ajax_request_js_output();
            $dynamic_js_string = ob_get_contents();
        ob_end_clean();

        $dynamic_js_filename = plugin_dir_path( __DIR__ ) . 'js/form-ajax-request.js';
        file_put_contents( $dynamic_js_filename, $dynamic_js_string );
    }
    
    /*
     * Generate form-ajax-request.js
     */
    private function ajax_request_js_output() 
    { ?>

        ( function( $ ) {
            $( document ).ready( function() {         
                var form = $( "#encodeon-ajax-contact" );
                var wait_message = "Please wait while we validate and send your message..."

                $( function() {
                    $( form ).on( "submit", function( e )
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
                                    if ( data_return_status == true ) 
                                    {
                                        /*
                                         * $( form )[0] converts jquery element back to
                                         * javascript object to use the native reset method
                                         */
                                        $( form )[0].reset();
                                    }
                                }
                            },
                            error: function ( xhr, desc, err ) 
                            {
                                console.log( xhr );
                                console.log( "Details: " + desc + "\nError:" + err );
                            }
                        } ); 
                    });
                });
            });
        }( jQuery ) );

    <?php }
}
