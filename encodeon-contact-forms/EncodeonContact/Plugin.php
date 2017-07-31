<?php
namespace EncodeonContact;
class Plugin
{
    public function __construct()
    {
        new Forms\Settings;
        new Forms\Contact;
        new Views\Contact;
    }
}
