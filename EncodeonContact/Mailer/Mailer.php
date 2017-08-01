<?php
namespace EncodeonContact\Mailer;
class Mailer
{
    
    public function __construct()
    {
        add_action( 'phpmailer_init', array( $this, 'php_mailer_change_settings' ) );
    }
    
    public function php_mailer_change_settings( $phpmailer )
    {
        if ( get_option( 'php_mailer_is_smtp' ) )
        {
            $phpmailer->isSMTP();
            $phpmailer->Host        = get_option( 'php_mailer_smtp_host' );
            
            if ( strlen( get_option( 'php_mailer_port' ) ) > 0 ) 
            {
                $phpmailer->Port        = get_option( 'php_mailer_port' );
            }
            
            if ( get_option( 'php_mailer_smtp_auth' ) ) 
            {
                $phpmailer->SMTPAuth    = get_option( 'php_mailer_smtp_auth' );
                $phpmailer->Username    = get_option( 'php_mailer_username' );
                $phpmailer->Password    = get_option( 'php_mailer_password' );
            } else 
            {
                $phpmailer->SMTPAuth = false;
            }
            
            if ( strlen( get_option( 'php_mailer_smtp_secure' ) ) > 0 ) 
            {
                $phpmailer->SMTPSecure = get_option( 'php_mailer_smtp_secure' );
            }
            
            if ( strlen( get_option( 'php_mailer_from' ) ) > 0 ) 
            {
                $phpmailer->From = get_option( 'php_mailer_from' );
            }
            
            if ( strlen( get_option( 'php_mailer_from_name' ) ) > 0 ) 
            {
                $phpmailer->FromName = get_option( 'php_mailer_from_name' );
            }
            
            if (get_option( 'php_mailer_is_html' ) ) 
            {
                $phpmailer->isHTML(true);
            }
        }
    }
    
}