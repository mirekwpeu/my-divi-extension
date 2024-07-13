<?php

class PostsLoop extends ET_Builder_Module
{

    public $slug = 'posts-loop';
    public $vb_support = 'on';

    protected $module_credits = [
        'author' => 'Mirek'
    ];
    public function init()
    {
        $this->name = esc_html__('Posts loop', 'posts-loop-extension');
    }

    public function get_fields()
    {
        return [
            'heading' => [
                'label' => esc_html__('Tytuł', 'posts-loop-extension'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input your desired heading here.', 'posts-loop-extension'),
                'toggle_slug' => 'main_content',
            ],
            'include_categories_posts' => [
                'label' => 'Posty. ' . esc_html__('Included Categories', 'et_builder'),
                'type' => 'categories',
                'option_category' => 'basic_option',
                'description' => esc_html__('Select the categories that you would like to include in the feed.', 'et_builder'),
                'computed_affects' => [
                    'all_terms'
                ],
                'taxonomy_name' => 'category',
                'toggle_slug' => 'main_content',
            ],
            'include_categories_projects' => [
                'label' => 'Projekty. ' . esc_html__('Included Categories', 'et_builder'),
                'type' => 'categories',
                'option_category' => 'basic_option',
                'description' => esc_html__('Select the categories that you would like to include in the feed.', 'et_builder'),
                'computed_affects' => [
                    'all_terms'
                ],
                'taxonomy_name' => ['project_category'],
                'toggle_slug' => 'main_content',
            ],
            '__all_terms' => [
                'type' => 'computed',
                'computed_callback' => ['PostsLoop', 'get_tst'],
                'computed_depends_on' => [
                    'include_categories_posts',
                    'include_categories_projects',
                ],
            ],
        ];
    }

    static function get_tst($args = [], $conditional_tags = [], $current_page = [])
    {
        return $args;
    }

    public function render($unprocessed_props, $content, $render_slug)
    {
        return sprintf(
            '<h1>%2$s</h1><pre>%1$s</pre>',
            json_encode($this->get_tst([
                'include_categories_posts' => $this->props['include_categories_posts'],
                'include_categories_projects' => $this->props['include_categories_projects']
            ]), JSON_PRETTY_PRINT),
            $this->props['heading']
        );
    }
}

new PostsLoop;
