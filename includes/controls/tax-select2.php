<?php

namespace MTN_FEATURES\Controls;

if (!defined('ABSPATH')) {
    exit;
}

class Taxo_select_Control extends \Elementor\Base_Data_Control
{
    public function get_type()
    {
        return 'select-taxonomy';
    }

    protected function get_default_settings()
    {

        return [
            'label_block' => true,
            'separator' => 'after',
            'multiple' => true,
            'cpt_field_label' => esc_html('Post Type', 'mtn'),
            'taxo_field_label' => esc_html('Taxonomies', 'mtn'),
        ];
    }

    public function enqueue()
    {
        // Styles
        // wp_register_style( 'emojionearea', 'https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css', [], '3.4.2' );
        // wp_enqueue_style( 'emojionearea' );

        // Scripts
        // wp_register_script( 'taxo-select-js',  MTN_ASSETS . 'controls/js/mtn-taxo-select.js', [ 'jquery' ], '1.0.0' );
        // wp_enqueue_script( 'taxo-select-js' );


        // wp_register_script( 'emojionearea', 'https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.js', [], '3.4.2' );
        // wp_enqueue_script( 'emojionearea-control' );
    }


    public function content_template()
    {
        $tax_uid = $this->get_control_uid('taxo');
        $cpt_uid = $this->get_control_uid('cpt');
        // print_r($control_uid);
?>
        <div>
            <h4 class="taxo-select-title" style="font-weight:700; margin-bottom:10px;">{{{data.label}}}</h4>

            <div class="cpt-field-wrapper">
                <label for="<?php echo $cpt_uid; ?>" class="cpt-select-label">{{{data.cpt_field_label}}} </label>
                <div class="elementor-control-input-wrapper elementor-control-unit-5 elementor-control-select-wrapper">
                    <select id="<?php echo $cpt_uid; ?>" class="select-cpt" style="width: 100%; margin-bottom:10px;"></select>
                </div>
            </div>
            <div class="taxo-field-wrapper">
                <label for="<?php echo $tax_uid; ?>" class="taxo-select-label">{{{data.taxo_field_label}}} </label>
                <div class="elementor-control-input-wrapper elementor-control-unit-5 elementor-control-select-wrapper">
                    <select id="<?php echo $tax_uid; ?>" type="select2" class="elementor-select2 select-taxonomy" style="width: 100%; margin-bottom:10px;" {{ multiple }} data-setting="{{ data.name }}">
                        <# _.each( data.options, function( option_title, option_value ) {
                             var value=data.controlValue; if ( typeof value=='string' ) {
                                 var selected=( option_value===value ) ? 'selected' : '' ; 
                                } else if ( null !==value ) {
                                     var value=_.values( value ); var selected=( -1 !==value.indexOf( option_value ) ) ? 'selected' : '' ; 
                                    } #>
                            <option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
                            <# } ); #>
                    </select>
                </div>
            </div>
        </div>
<?php

    }
}
