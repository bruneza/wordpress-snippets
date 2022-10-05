<?php
// namespace MTN_FEATURES\Controls;

// use ElementorPro\Modules\QueryControl\Controls\Group_Control_Query;

namespace ElementorPro\Modules\QueryControl\Controls;

use Elementor\Controls_Manager;
use ElementorPro\Core\Utils;
use ElementorPro\Modules\QueryControl\Module as Query_Module;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Group_MTN_Query extends Group_Control_Query
{

    public static function get_type()
    {
        return 'mtn-query';
    }

    /**
     * Build the group-controls array
     * Note: this method completely overrides any settings done in Group_Control_Posts
     * @param string $name
     *
     * @return array
     */
    protected function init_fields_by_name($name)
    {
        $fields = parent::init_fields_by_name($name);

        $tabs_wrapper = $name . '_query_args';
        $include_wrapper = $name . '_query_include';

        $fields['post_type']['options']['related'] = esc_html__('Related', 'mtn');
        $fields['include_term_ids']['condition']['post_type!'][] = 'related';
        $fields['related_taxonomies']['condition']['post_type'][] = 'related';
        $fields['include_authors']['condition']['post_type!'][] = 'related';
        $fields['exclude_authors']['condition']['post_type!'][] = 'related';
        $fields['avoid_duplicates']['condition']['post_type!'][] = 'related';
        $fields['offset']['condition']['post_type!'][] = 'related';

        // TAXONOMY
        $fields['include_term_ids']['condition']['post_type!'][] = 'mtn-taxonomy';
        // $fields['related_taxonomies']['condition']['post_type'][] = 'mtn-taxonomy';
        $fields['include_authors']['condition']['post_type!'][] = 'mtn-taxonomy';
        $fields['include_term_ids']['condition']['post_type!'][] = 'mtn-taxonomy';
        $fields['exclude_authors']['condition']['post_type!'][] = 'mtn-taxonomy';
        $fields['avoid_duplicates']['condition']['post_type!'][] = 'mtn-taxonomy';

        $fields['post_type']['options']['mtn-taxonomy'] = esc_html__('MTN Taxonomy', 'mtn');
        $fields['include']['options']['include_taxonomies'] = esc_html__('Taxonomy', 'mtn');

        $related_taxonomies = [
            'label' => esc_html__('Term', 'mtn'),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->get_supported_taxonomies(),
            'label_block' => true,
            'multiple' => true,
            'condition' => [
                'include' => 'terms',
                'post_type' => [
                    'related',
                ],
            ],
            'tabs_wrapper' => $tabs_wrapper,
            'inner_tab' => $include_wrapper,
        ];

        $related_fallback = [
            'label' => esc_html__('Fallback', 'mtn'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'fallback_none' => esc_html__('None', 'mtn'),
                'fallback_by_id' => esc_html__('Manual Selection', 'mtn'),
                'fallback_recent' => esc_html__('Recent Posts', 'mtn'),
            ],
            'default' => 'fallback_none',
            'description' => esc_html__('Displayed if no relevant results are found. Manual selection display order is random', 'mtn'),
            'condition' => [
                'post_type' => 'related',
            ],
            'separator' => 'before',
        ];

        $fallback_ids = [
            'label' => esc_html__('Search & Select', 'mtn'),
            'type' => Query_Module::QUERY_CONTROL_ID,
            'options' => [],
            'label_block' => true,
            'multiple' => true,
            'autocomplete' => [
                'object' => Query_Module::QUERY_OBJECT_POST,
            ],
            'condition' => [
                'post_type' => 'related',
                'related_fallback' => 'fallback_by_id',
            ],
            'export' => false,
        ];

        $mtn_cpt = [
            'label' => esc_html__('Post Type', 'mtn'),
            'type' => Controls_Manager::SELECT,
            'options' => Utils::get_public_post_types(),
            'condition' => [
                'include' => 'include_taxonomies',
                'post_type' => [
                    'mtn-taxonomy'
            ],
            ],
            'separator' => 'before',
        ];

        $mtn_taxonomies = [
            'label' => esc_html__('Taxonomy', 'mtn'),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->get_supported_taxonomies($mtn_cpt),
            'label_block' => true,
            'multiple' => true,
            'condition' => [
                'include' => 'include_taxonomies',
                'post_type' => [
                    'mtn-taxonomy'
                ],
            ],
            'tabs_wrapper' => $tabs_wrapper,
            'inner_tab' => $include_wrapper,
        ];

        $fields = \Elementor\Utils::array_inject($fields, 'include_term_ids', ['related_taxonomies' => $related_taxonomies]);
        $fields = \Elementor\Utils::array_inject($fields, 'include_term_ids', ['selected_cpt' => $mtn_cpt]);
        $fields = \Elementor\Utils::array_inject($fields, 'include_term_ids', ['include_taxonomy_slugs' => $mtn_taxonomies]);
        $fields = \Elementor\Utils::array_inject($fields, 'offset', ['related_fallback' => $related_fallback]);
        $fields = \Elementor\Utils::array_inject($fields, 'related_fallback', ['fallback_ids' => $fallback_ids]);

        return $fields;
    }

    protected function get_supported_taxonomies($post_type = null)
    {
        $supported_taxonomies = [];

        if(!isset($post_type))
        $public_types = $post_type;
        else
        $public_types = Utils::get_public_post_types();

        if(is_array($public_types)){
        foreach ($public_types as $type => $title) {
            $taxonomies = get_object_taxonomies($type, 'objects');

            foreach ($taxonomies as $key => $tax) {
                if (!array_key_exists($key, $supported_taxonomies)) {
                    $label = $tax->label;

                    if (in_array($tax->label, $supported_taxonomies)) {
                        $label = $tax->label . ' (' . $tax->name . ')';
                    }
                    $supported_taxonomies[$key] = $label;
                }
            }
        }
    }else{
        $taxonomies = mtn_get_taxonomies($post_type);

        foreach ($taxonomies as $key => $tax) {
            if (!array_key_exists($key, $supported_taxonomies)) {
                $label = $tax->label;

                if (in_array($tax->label, $supported_taxonomies)) {
                    $label = $tax->label . ' (' . $tax->name . ')';
                }
                $supported_taxonomies[$key] = $label;
            }
        }
    }
        return $supported_taxonomies;
    }

    protected static function init_presets()
    {
        parent::init_presets();
        static::$presets['related'] = [
            'related_fallback',
            'fallback_ids',
        ];
    }
}
