<?php
namespace EncodeonContact\Form\Input;
class Submit
{
    public function __construct( $label )
    {
        ?>
        <div class="row submit">
            <button type="submit">
                <?php echo $label; ?>
            </button>
        </div>
        <?php
    }
}
