<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Icon_List  extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve test widget name.
	 *
	 * @since 1.0.0
	 * @access public 
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'MTN Icons';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve test widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('MTN Icons', 'mtn');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve test widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-code';
	}

	public function get_categories()
	{
		return ['basic'];
	}


	private function postType()
	{
		return 'post';
	}
	protected function register_controls()
	{

		$this->start_controls_section(
			'mtn_icon_lists',
			[
				'label' => esc_html__('Icon Lists', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'mtn_icons_Title',
			[
				'label' => esc_html__( 'Text', 'mtn' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Item', 'mtn' ),
				'default' => esc_html__( 'Item', 'mtn' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
        $repeater->add_control(
			'mtn_selected_icon',
			[
				'label' => esc_html__( 'Icon', 'mtn' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'mtn_icon_link',
			[
				'label' => esc_html__( 'Link', 'mtn' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'mtn' ),
			]
		);

        $this->add_control(
			'mtn_icons',
			[
				'label' => esc_html__( 'Items', 'mtn' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'mtn_icons_Title' => esc_html__( 'List Item', 'mtn' ),
						'mtn_selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ mtn_icons_Title }}}',
			]
		);
        
		$this->end_controls_section();

        $this->start_controls_section(
			'icon_grid_style',
			[
				'label' => esc_html__( 'Icon Grid Style', 'mtn' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'mtn' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 10
                ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtn-icon-list-items .mtn-icon-list-item:not(:last-child)' => 'margin-right: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .mtn-icon-list-items .mtn-icon-list-item:not(:first-child)' => 'margin-left: calc({{SIZE}}{{UNIT}}/2)',
				],
			]
		);

       $this->add_responsive_control(
			'icon_horizontal_align',
			[
				'label' => esc_html__('Horizontal Align', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => 'Left',
					'center' => 'center',
					'flex-end' => 'Right',
                    'space-between' => 'Space Between',
                    'space-around'=> 'Space Around',
                    'space-evenly' => 'Space Evenly',

				],
				'selectors' => [
					'{{WRAPPER}} .mtn-icon-list-items' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'mtn' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('icon Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-wrapper i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => esc_html__('Icon Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mtn-icon-wrapper',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => esc_html__('Icon Border', 'mtn'),
                'selector' => '{{WRAPPER}} .mtn-icon-wrapper',
            ]
        );

        $this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Icon Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '10px',
				'selector' => [
                    '{{WRAPPER}} .mtn-icon-wrapper' => 'border-radius: {{VALUE}}',
                ],
            ],
		);

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__('Icon Height', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('Icon Width', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'mtn'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mtn'),
                'label_off' => esc_html__('Hide', 'mtn'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


		$this->end_controls_section();

        $this->start_controls_section(
			'Title_style',
			[
				'label' => esc_html__( 'Title Style', 'mtn' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                    ]
            ],
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mtn-icon-list-item h3',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-list-item h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );
        
		$this->end_controls_section();

        $this->start_controls_section(
			'icon_container_style',
			[
				'label' => esc_html__( 'Icon Container Style', 'mtn' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Container Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mtn-icon-list-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => esc_html__('Container Border', 'mtn'),
                'selector' => '{{WRAPPER}} .mtn-icon-list-item',
            ]
        );

        $this->add_control(
			'container_border_radius',
			[
				'label' => esc_html__( 'Container Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '10px',
				'selector' => [
                    '{{WRAPPER}} .mtn-icon-list-item' => 'border-radius: {{VALUE}}',
                ],
            ],
		);

        $this->add_responsive_control(
            'container_height',
            [
                'label' => esc_html__('Container Height', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-list-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'container_width',
            [
                'label' => esc_html__('Container Width', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-icon-list-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		/*** Start Content Section ***/
		echo '<div class="mtn-deals-carousel-section">';
        echo '<div class="mtn-icon-list-items d-flex">';
        foreach($settings['mtn_icons'] as $item){
        echo '<div class="mtn-icon-list-item">';
            $icon = $item['mtn_selected_icon'];
            $showTitle = $settings['show_title'];
            $title = $item['mtn_icons_Title'];
            ?>
            <div class="mtn-icon-wrapper">
			<?php \Elementor\Icons_Manager::render_icon( $icon  , [ 'aria-hidden' => 'true' ] ); ?>
		    </div>
        <?php
        if ( $showTitle == 'yes') 
        echo ' <h3 class="icon-title">'.$title.'</h3>';
        echo '</div>';
        }
		
		echo '</div></div>';
		/*** End Content Section ***/
	}
}
