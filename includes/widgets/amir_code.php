<?php

function amir_codes($that)
{
    

    heading_control($that, "style_settings", "Style Settings");
    padding_control($that, 'grid_padding', "Grid Padding" ,'.mtn-complex-column');

    switcher_control($that, 'show_image', 'Show Image');
    heading_control($that, "grid_img", "Grid Image Settings");
    slider_control($that, 'img_hight', 'Set Image Height', ['.mtn-complex-column-img','height'], null);


    switcher_control($that, 'show_contents_title', 'Show Title');
    heading_control($that, "content_title", "Content Title");

    select_callback_control(
        $that,
        'title-color-settings',
        'Title Color Settings',
        [
            'default_style' => 'Default',
            'custom_style' => 'Custom',

        ],
        'default_style',
    );

    typography_control($that, 'content_section_typography', '.mtn-complex-column-content');

	// slider_control($that, 'modal_title_spacing', 'Spacing', ['.modal-member-name', 'margin-bottom'], 20);



    // select_value_control($that, "grid_column_start",'Grid Column Start', ['.mtn-complex-column','grid-column-start'], 'auto');
    // select_value_control($that, "grid_column_end",'Grid Column End', ['.mtn-complex-column','grid-column-end'], 'auto');
}