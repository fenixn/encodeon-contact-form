<?php
namespace EncodeonContact\Form;
class Contact
{
    public function __construct()
    {
        add_action( 'wp_ajax_encodeon_php_mailer_send', array( $this, 'process_contact_form' ) );
        add_action( 'wp_ajax_nopriv_encodeon_php_mailer_send', array( $this, 'process_contact_form' ) );
    }
    
    public function process_contact_form()
    {
        if ( empty($_POST) || !wp_verify_nonce( $_POST[ 'contact_form_nonce' ], 'encodeon_php_mailer_send' ) ) 
        {
            ?>
                <div class='warning-message'>
                    We have detected that you may be trying to breach the security on this form.
                    If you believe this is a mistake, you can try contacting us by phone or via email.
                </div>
            <?php
            die();
        } else 
        {
            /* 
             * Keep only elements in $_POST set by the form.
             */
            $allowed_form_data = [
                'Verification',
                'Name', 
                'Phone',
                'Email',
                'Message'
            ];

            // Form Validation
            $validation_pass = true;
            
            /*
             * Verification input is a honeypot
             * Bots will tend to fill all fields on a form. The hidden 'Verification' input will
             * not be filled by a human user. So if it is filled in, the user is most likely a bot
             * and fails the validation test.
             */
            if ( !empty( $_POST[ 'Verification' ] ) ) 
            {
                $validation_pass = false;
            }

            $end_of_validation = false;
            while ( $validation_pass && !$end_of_validation ) 
            {
                // Check if Required Fields are filled
                $required_fields = [
                    'Name', 'Phone', 'Email'
                ];
                
                foreach ( $required_fields as $field ) 
                {
                    if ( empty( $_POST[ $field ] ) )
                    {
                        $validation_pass = false;
                        echo $field . ' is required and must be filled in. <br />';
                    }
                }

                // Validate Name
                $name_fields = [ 'Name' ];
                foreach ( $name_fields as $field ) 
                {
                    if ( preg_match( "\w", stripcslashes( $_POST[ $field ] ), $Inv ) ) 
                    {
                        $validation_pass = false;
                        echo $Inv[0] . ' is not allowed in the Name input. <br />'; 
                    }
                }

                // Validate Email
                if ( strpos( $_POST[ 'Email' ], '@' ) == false ) 
                {
                    $validation_pass = false;
                    echo 'Emails require a @ symbol <br />';
                }
                
                $end_of_validation = true;
            }
            
            $filtered_form_data = array_filter(
                $_POST,
                function ( $key ) use ( $allowed_form_data ) 
                {
                    return in_array( $key, $allowed_form_data );
                },
                ARRAY_FILTER_USE_KEY
            );
            unset( $filtered_form_data[ 'Verification' ] );

            if ( $validation_pass ) 
            {
                // Generate email body from $_POST data
                if (!empty(get_option('encodeon_contact_form_to_address'))) {
                    $to = esc_attr(get_option('encodeon_contact_form_to_address'));
                } else {
                    $to = get_bloginfo('admin_email');
                }
                
                $subject = 'Contact Form';
                $message = '';
                foreach( $filtered_form_data as $form_data_name => $form_data_value ) 
                {
                    $message = $message . $form_data_name . ": " . stripcslashes($form_data_value) . '<br />';
                }
                
                if (!empty(get_option('encodeon_contact_form_reply_to_address'))) {
                    $reply = esc_attr(get_option('encodeon_contact_form_reply_to_address'));
                } else {
                    $reply = get_bloginfo('admin_email');
                }
                
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'Reply-To: <' . $reply . '>'
                );

                if( !wp_mail( $to, $subject, $message, $headers ) ) 
                {
                    echo '<pre>';
                    echo 'Message could not be sent.';
                    echo "<div class='hidden' id='data-return-status' data-status='false'></div>";
                    echo '</pre>';
                } else 
                {
                    echo 'The form has been sucessfully submitted';
                    echo "<div class='hidden' id='data-return-status' data-status='true'></div>";
                }
            } else 
            {
                echo "Validation failed, please check your inputs and try again.";
                if (empty($_POST['Verification'])) 
                {
                    echo "<div class='hidden' id='data-return-status' data-status='" . $validation_pass . "'></div>";
                }
            }

            die();
        }
    }
}