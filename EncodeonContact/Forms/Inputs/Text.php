<?php
namespace EncodeonContact\Forms\Inputs;
class Text
{
    public function __construct( $input_name, $input_placeholder, $input_type = "text", $is_required = true )
    {
        ?>
        <div class="row">
            <div class="label-container">
                <label for="<?php echo $input_name; ?>">
                    <?php echo $input_name; ?><?php if ( $is_required ): ?>
                        <span class="required">*</span>
                    <?php endif; ?>
                </label>
            </div><div class="input-container">
                <input type="<?php echo $input_type; ?>" 
                    id="<?php echo $input_name; ?>" 
                    name="<?php echo $input_name; ?>" 
                    <?php if ( $is_required ) echo "required"; ?>
                    placeholder="<?php echo $input_placeholder; ?>">
            </div>
        </div>
        <?php
    }
}
