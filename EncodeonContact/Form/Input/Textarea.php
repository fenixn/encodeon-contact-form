<?php
namespace EncodeonContact\Form\Input;
class Textarea
{
    public function __construct( $input_name, $input_placeholder, $is_required )
    {
        ?>
        <div class="row double">
            <div class="label-container">
                <label for="<?php echo $input_name; ?>">
                    <?php echo $input_name; ?><?php if ( $is_required ): ?>
                        <span class="required">*</span>
                    <?php endif; ?>
                </label>
            </div><div class="input-container">
                <textarea id="<?php echo $input_name; ?>" class='block' 
                    name="<?php echo $input_name; ?>"
                    placeholder="<?php echo $input_placeholder; ?>"
                ></textarea>
            </div>
        </div>
        <?php
    }
}
