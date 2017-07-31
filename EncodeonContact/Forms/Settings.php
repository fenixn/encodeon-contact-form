<?php
namespace EncodeonContact\Forms;
class Settings
{
    public $settings;
    
    public function __construct()
    {
        $this->set_settings();
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_menu', array( $this, 'register_menu' ) );
    }
    
    private function set_settings()
    {
        $this->settings = array(
            'encodeon_contact_form_to_address',
            'encodeon_contact_form_reply_to_address'
        );
    }
    
    public function register_menu()
    {
        add_menu_page(
            'Contact Forms Settings',
            'Contact Forms',
            'manage_options',
            'encodeon_contact_form_settings',
            array( $this, 'contact_forms_settings_page' ),
            'dashicons-editor-table'
        );
    }
    
    public function register_settings()
    {
        foreach ($this->settings as $setting)
        {
            register_setting(
                'encodeon_contact_form_settings_group',
                $setting
            );
        }

        add_settings_section(
            'encodeon_contact_form_setting_section', 
            'Contact Forms Setting Section', 
            array( $this, 'setting_section_page' ), 
            'encodeon_contact_form_settings'
        );
    }
    
    public function contact_forms_settings_page()
    {
        ?>
        
        <form method="post" action="options.php">
            <?php settings_fields('encodeon_contact_form_settings_group'); ?>
            <?php do_settings_sections('encodeon_contact_form_settings'); ?>
            <?php submit_button(); ?>
        </form>
        
        <?php
    }
    
    public function setting_section_page()
    {      
        ?>
        
        <h4>
            These settings will affect the Contact Forms.
        </h4>
        
        <?php 
        add_settings_field(
            'encodeon_contact_form_to_address',
            'Send Contact Form Emails To: ',
            array($this, "text_input"),
            'encodeon_contact_form_settings',
            'encodeon_contact_form_setting_section',
            array( 'setting-name' => 'encodeon_contact_form_to_address' )
        );
        
        add_settings_field(
            'encodeon_contact_form_reply_to_address',
            'Set Reply To Address: ',
            array( $this, "text_input" ),
            'encodeon_contact_form_settings',
            'encodeon_contact_form_setting_section',
            array( 'setting-name' => 'encodeon_contact_form_reply_to_address' )
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
               name='<?php echo esc_attr( $args['setting-name'] ); ?>'
               value='<?php if( !empty( get_option( $args['setting-name'] ) ) )
                echo esc_attr( get_option( $args[ 'setting-name' ] ) ); ?>' />
        <?php
        
    }
}