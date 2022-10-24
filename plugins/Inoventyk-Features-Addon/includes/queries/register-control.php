<?php


if (!function_exists('INO_query_control')) {
	function INO_query_control($thisControl,$prefix){
        //ANCHOR : Control - Query section
		$thisControl->start_controls_section(
			'Query',
			[
				'label' => esc_html__('INO Query', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$thisControl->add_group_control(
			\ElementorPro\Modules\QueryControl\Controls\Group_INO_Query::get_type(),
			[
				'name' => $prefix.'_query',
			]
		);

		$thisControl->add_control(
			'grid_fields_heading',
			[
				'label' => esc_html__('Choose Fields', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$thisControl->add_control(
			'choose_grid_fields',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => processOutput()['fields'],
				'default' => ['thumbnail', 'post-link']
			]
		);

		$thisControl->end_controls_section();

    }
}