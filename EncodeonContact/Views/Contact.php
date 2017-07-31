<?php
namespace EncodeonContact\Views;
class Contact
{
    public function __construct() 
    {
        add_shortcode( 'main_contact_form', array( $this, 'contact_form_view' ) );
    }
    
    public function contact_form_view($atts, $content = null)
    {
        ob_start();
        ?>
        
        <h1>Contact Renter Warrior</h1>
        
        <form id="ajax-contact" class='contact-form' method="post" action="">
           
            <?php wp_nonce_field( 'encodeon_php_mailer_send', 'contact_form_nonce' ); ?>
            <input name="action" value="encodeon_php_mailer_send" type="hidden">
            <input name="form-name" value="Contact Form" type="hidden">
           
            <div class="field hidden">
                <label for="Verification">
                    This field is hidden for human verification. If you can see it, leave it blank.
                </label>
                <input type="text" id="Verification" name="Verification">
            </div>
           
            <div class='divide3full'>
                <div class="field first">
                    <label for="Name">
                        <span class='warning-message'>*</span>
                        Name
                    </label>
                    <input type="text" id="Name" name="Name" required
                        placeholder='Enter your name'>
                </div><div class="field even">
                    <label for="Phone">
                        <span class='warning-message'>*</span>
                        Phone
                    </label>
                    <input type="tel" id="Phone" name="Phone"
                        onkeydown="javascript:backspacerDOWN(this,event);"
                        onkeyup="javascript:backspacerUP(this,event);"
                        placeholder='Enter your phone number'>
                </div><div class="field odd">
                    <label for="Email">
                        <span class='warning-message'>*</span>
                        Email
                    </label>
                    <input type="email" id="Email" name="Email" required
                        placeholder='Enter your email address'>
                </div>
            </div>
            
            <div class="field">
                <label class='block' for="Message">Message</label>
                <textarea id="Message" class='block' name="Message"
                    placeholder='Let us know how we can help you.'
                ></textarea>
            </div>

            <div class="field submit-row">
                <button type='submit' id='contact-form-submit' class='big-button'>
                    Send message
                </button>
            </div>
            
            <div class='form-response'></div>
        </form>
        
        <script type='text/javascript'>
        jQuery(document).ready(function ($) {         
            var form = $('#ajax-contact');
            var wait_message = 'Please wait while we validate and send your message...'
            
            $(function () {
                $(form).on('submit', function (e)
                {
                    e.preventDefault();
                    
                    $('.form-response').html(wait_message);
                    
                    var formData = $(form).serialize();

                    $.ajax({
                      url: "<?php echo admin_url('admin-ajax.php'); ?>",
                      type: 'post',
                      data: formData,
                      success: function (data, status) {
                        if(data) {
                            $('.form-response').html(data);
                            var data_return_status = $('#data-return-status').data('status');
                            if (data_return_status == false) {
                                $('#contact-form-submit').prop('disabled', false);
                            }
                        }
                      },
                      error: function (xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                      }
                    }); 
                    
                    $('#contact-form-submit').prop('disabled', true);
                });
            });
        });
        </script>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
