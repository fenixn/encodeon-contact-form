<?php
namespace EncodeonContact\Admin;
class Mailer
{
    protected $settings;
    
    public function __construct()
    {
        $this->set_settings();
        add_action( 'admin_menu', array( $this, 'register_submenu' ) );
        add_action( 'admin_init', array( $this, 'register_settings') );
    }
    
    private function set_settings()
    {
        $this->settings = array(
            'php_mailer_is_smtp',
            'php_mailer_smtp_host',
            'php_mailer_smtp_auth',
            'php_mailer_username',
            'php_mailer_password',
            'php_mailer_smtp_secure',
            'php_mailer_port',
            'php_mailer_from',
            'php_mailer_from_name',
            'php_mailer_is_html'
        );
    }
    
    public function register_submenu()
    {
        add_submenu_page(
            'encodeon_contact_form_settings',
            'PHP Mailer',
            'PHP Mailer',
            'manage_options',
            'php_mailer_settings',
            array( $this, 'php_mailer_settings_page' )
        );
    }
    
    public function php_mailer_settings_page()
    {
        ?>
        
        <form method="post" action="options.php">
            <?php settings_fields('php_mailer_settings_group'); ?>
            <?php do_settings_sections('php_mailer_settings'); ?>
            <?php submit_button(); ?>
        </form>
        
        <?php
    }
    
    public function register_settings()
    {
        foreach ($this->settings as $setting)
        {
            register_setting(
                'php_mailer_settings_group',
                $setting
            );
        }
        
        add_settings_section(
            'php_mailer_setting_section', 
            'PHP Mailer Setting Section', 
            array($this, 'php_mailer_setting_section_page'), 
            'php_mailer_settings'
        ); 
        
    }
    
    public function php_mailer_setting_section_page()
    {      
        ?>
        
        <h4>
            These settings will affect the arguments passed into the PHP Mailer class. PHP Mailer is an open source SMTP class that is used by WordPress to send emails. Set 'Use SMTP' to false to turn SMTP off and it will ignore all other settings and use the default WordPress mailer. Keep the 'Use SMTP' option to false if you are using another plugin that already sets up the SMTP settings.
        </h4>
        
        <h4>
            To learn more about PHP Mailer, visit here:
            <a target="_blank" href='https://github.com/PHPMailer/PHPMailer'>
                https://github.com/PHPMailer/PHPMailer
            </a>
        </h4>
        
        <?php
        add_settings_field(
            'php_mailer_is_smtp',
            'Use SMTP',
            array( $this, "bool_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_is_smtp'
            )
        );
        
        add_settings_field(
            'php_mailer_smtp_host',
            'SMTP Host',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_smtp_host'
            )
        ); 
        
        add_settings_field(
            'php_mailer_smtp_auth',
            'SMTP Auth',
            array( $this, "bool_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_smtp_auth'
            )
        ); 
        
        add_settings_field(
            'php_mailer_username',
            'Username',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_username'
            )
        );
        
        add_settings_field(
            'php_mailer_password',
            'Password',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_password',
                'is-password'  => true
            )
        );
        
        add_settings_field(
            'php_mailer_smtp_secure',
            'SMTP Secure',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_smtp_secure'
            )
        );
        
        add_settings_field(
            'php_mailer_port',
            'Port',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_port'
            )
        );
        
        add_settings_field(
            'php_mailer_from',
            'From Address',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_from'
            )
        );
            
        add_settings_field(
            'php_mailer_from_name',
            'From Name',
            array( $this, "text_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_from_name'
            )
        );
        
        add_settings_field(
            'php_mailer_is_html',
            'Use HTML in Emails',
            array( $this, "bool_input"),
            'php_mailer_settings',
            'php_mailer_setting_section',
            array(
                'setting-name' => 'php_mailer_is_html'
            )
        );
    }
    
    public function text_input($args) {
        
        if (isset($args['is-password'])) {
            $type = 'password';
        } else {
            $type = 'text';
        }
        
        ?>
        <input class='regular-text'
               type='<?php echo $type; ?>'
               name='<?php echo esc_attr($args['setting-name']); ?>'
               value='<?php if(!empty(get_option($args['setting-name'])))
                echo esc_attr(get_option($args['setting-name'])); ?>' />
        <?php
        
    }
    
    public function bool_input($args) {
        ?>
              
        <select name='<?php echo esc_attr($args['setting-name']); ?>'>
            <?php if (get_option($args['setting-name'])): ?>
            <option selected value=1>True</option>
            <option value=0>False</option>
            <?php else: ?>
            <option value=1>True</option>
            <option selected value=0>False</option>
            <?php endif; ?>
        </select>
                  
        <?php
    }
}