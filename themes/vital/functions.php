<?php

	if (!class_exists('Timber')){
		add_action( 'admin_notices', function(){
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url('plugins.php#timber') . '">' . admin_url('plugins.php') . '</a></p></div>';
		});
		return;
	}

	class StarterSite extends TimberSite {

		function __construct(){
			add_theme_support('post-formats');
			add_theme_support('post-thumbnails');
			add_theme_support('menus');
			add_theme_support('widgets');
			add_filter('timber_context', array($this, 'add_to_context'));
			add_action('init', array($this, 'register_post_types'));
			add_action('init', array($this, 'register_taxonomies'));
			add_action('init', array($this, 'mysiwyg_additions'));
			add_action('widgets_init', array($this, 'register_widgets'));

            Timber::$locations = array(
                __DIR__ . '/views/partials',
                __DIR__ . '/views/partials/informatic-rows',
            );

            if( function_exists('acf_add_options_page') )
            {
                acf_add_options_page();
            }

			parent::__construct();
		}

		function register_post_types(){
			//this is where you can register custom post types
            register_post_type( 'work',
                array(
                    'labels' => array(
                        'name' => __( 'Work' ),
                        'singular_name' => __( 'work' )
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'rewrite' => array(
                        'slug' => 'work',
                        'with_front' => false
                    ),
                    'supports' => array(
                        'title'
                    )
                )
            );
            flush_rewrite_rules( false );

            register_post_type( 'team',
                array(
                    'labels' => array(
                        'name' => __( 'Team' ),
                        'singular_name' => __( 'team' )
                    ),
                    'public' => true,
                    'has_archive' => false,
                    'exclude_from_search' => true,
                    'rewrite' => array(
                        'slug' => 'team',
                        'with_front' => false
                    ),
                    'supports' => array(
                        'title'
                    )
                )
            );
            flush_rewrite_rules( false );

            register_post_type( 'partners',
                array(
                    'labels' => array(
                        'name' => __( 'Partners' ),
                        'singular_name' => __( 'partner' )
                    ),
                    'public' => true,
                    'has_archive' => false,
                    'rewrite' => array(
                        'slug' => 'partners',
                        'with_front' => false
                    ),
                    'supports' => array(
                        'title'
                    )
                )
            );
            flush_rewrite_rules( false );

            register_post_type( 'services',
                array(
                    'labels' => array(
                        'name' => __( 'Services' ),
                        'singular_name' => __( 'service' )
                    ),
                    'public' => true,
                    'has_archive' => false,
                    'exclude_from_search' => true,
                    'rewrite' => array(
                        'slug' => 'service',
                        'with_front' => false
                    ),
                    'supports' => array(
                        'title'
                    )
                )
            );
            flush_rewrite_rules( false );
		}

		function register_taxonomies(){
			//this is where you can register custom taxonomies
            register_taxonomy(
                'type',
                'services',
                array(
                    'label' => __( 'Type' ),
                    'rewrite' => array( 'slug' => 'type' ),
                    'hierarchical' => true,
                )
            );
		}

        function register_widgets(){
            register_sidebar( array(
                    'name' => 'Footer widget area',
                    'id' => 'footer-widget',
                    'before_widget' => '<div>',
                    'after_widget' => '</div>',
                    'before_title' => '<h2>',
                    'after_title' => '</h2>',
                )
            );
        }

		function add_to_context($context){
            global $post;
            $context['acf'] = get_field_objects($post->id);

			$context['menu'] = new TimberMenu();
			$context['site'] = $this;
            $context['options'] = get_fields('options');

            $args = 'post_type=post&numberposts=3';
            $context['latestPosts'] = Timber::get_posts($args);

            $context['footerWidget'] = Timber::get_widgets('footer-widget');

			return $context;
		}

        function mysiwyg_additions(){
            // Callback function to insert 'styleselect' into the $buttons array
            function my_mce_buttons_2( $buttons ) {
                array_unshift( $buttons, 'styleselect' );
                return $buttons;
            }
            // Register our callback to the appropriate filter
            add_filter('mce_buttons_2', 'my_mce_buttons_2');

            // Callback function to filter the MCE settings
            function my_mce_before_init_insert_formats( $init_array ) {
                // Define the style_formats array
                $style_formats = array(
                    array(
                        'title' => '.type-larger',
                        'selector' => 'p',
                        'classes' => 'type-larger',
                        'wrapper' => true,
                    )
                );
                // Insert the array, JSON ENCODED, into 'style_formats'
                $init_array['style_formats'] = json_encode( $style_formats );

                return $init_array;

            }
            // Attach callback to 'tiny_mce_before_init'
            add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
        }

	}

	new StarterSite();