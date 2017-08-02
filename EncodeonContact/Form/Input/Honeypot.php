<?php
namespace EncodeonContact\Form\Input;
class Honeypot
{
    public function __construct()
    {
        ?>
        <div class="field hidden">
            <label for="Verification">
                This field is hidden for human verification. If you can see it, leave it blank.
            </label>
            <input type="text" id="Verification" name="Verification">
        </div>
        <?php
    }
}
