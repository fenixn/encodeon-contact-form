<?php
namespace EncodeonContact\Forms\Inputs;
class Submit
{
    public function __construct( $label = "Send message" )
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
