<?php

//https://www.daggerhartlab.com/create-simple-php-templating-function/
/**
 * Simple Templating function
 *
 * @param $file   - Path to the PHP file that acts as a template.
 * @param $args   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */
function template($file, $args)
{
    $file = plugin_dir_path(__FILE__) . $file;
    // ensure the file exists
    if (!file_exists($file)) {
        return false;
    }
    // Make values in the associative array easier to access by extracting them
    if (is_array($args)) {
        //$globals = new Globals();
        //$args = array_merge($args, $globals->fetch());
        extract($args);
    }
    //
    // buffer the output (including the file is "output")
    ob_start();
    require $file;
    return ob_get_clean();
}
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

        wp_enqueue_script('custom-divi-module', plugin_dir_url(__FILE__) . 'tst.js', [], false, true);
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('custom-divi-module', plugin_dir_url(__FILE__) . 'tst.css');
        });

        get_template_part('parts_templates/content', 'posts-sections', []);
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
        $arr = [
            //'style' => '<style>.posts-loop .test {color: green;}</style>',
            'content' => template('template.php', [
                'val' => 'foo',
                'args' => $args
            ])//'<h1 id="tst" class="test">h1</h1><h1>h1 2</h1>'
        ];

        return array_merge($args, $arr);
        //return $arr;
    }

    public function render($unprocessed_props, $content, $render_slug)
    {
        $return_value = $this->get_tst([
            'include_categories_posts' => $this->props['include_categories_posts'],
            'include_categories_projects' => $this->props['include_categories_projects']
        ]);

        $display_value = '';
        foreach ($return_value as $key => $value)
            $display_value .= "<span><p style=\"margin-top: 1em; font-style: italic; padding-bottom: .2em\">$key:</p> $value</span>";

        return sprintf(
            '<h1 class="posts-loop-header">%1$s</h1><pre>%2$s</pre><div>%3$s</div>',
            $this->props['heading'],
            htmlentities(json_encode($return_value, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)),
            $display_value
        );
    }
}

new PostsLoop;
