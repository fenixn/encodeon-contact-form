# encodeon-contact-form
A simple responsive contact form plugin for WordPress. Plugin also includes option to set SMTP settings for PHP Mailer.

## INSTALLATION
To install, clone to /plugins directory, and then activate the plugin in WordPress admin. 

## WordPress Pages
Use the shortcode [encodeon_contact_form] to add the form to a page. 

## Template Files
To add the form to a template file, use the contact_form_view method in the Views\Contact object. 

Example:
`<?php \EncodeonContact\Views\Contact::contact_form_view(); ?>`
