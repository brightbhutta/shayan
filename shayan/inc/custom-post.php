<?php 

add_action('init', function() {
	register_post_type('project', [
		'label' => __('Projects', 'txtdomain'),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-cloud',
		'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments'],
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'project'],
		'taxonomies' => ['project_taxonomy'],
		'labels' => [
			'singular_name' => __('project', 'txtdomain'),
			'add_new_item' => __('Add new project', 'txtdomain'),
			'new_item' => __('New project', 'txtdomain'),
			'edit_item' => __('Edit project', 'txtdomain'),
			'view_item' => __('View project', 'txtdomain'),
			'search_items' => __('Search project', 'txtdomain'),
			'not_found' => __('No projects found', 'txtdomain'),
			'not_found_in_trash' => __('No projects found in trash', 'txtdomain'),
			'all_items' => __('All projects', 'txtdomain'),
			'insert_into_item' => __('Insert into project', 'txtdomain')
		],		
	]);
 
	register_taxonomy('project_taxonomy', ['project'], [
		'label' => __('Project Category', 'txtdomain'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'project_taxonomy'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Project Category', 'txtdomain'),
			'all_items' => __('All Project Categories', 'txtdomain'),
			'edit_item' => __('Add New Project Category', 'txtdomain'),
			'view_item' => __('View Category', 'txtdomain'),
			'update_item' => __('Update Category', 'txtdomain'),
			'add_new_item' => __('Add New Category', 'txtdomain'),
			'new_item_name' => __('New Category Name', 'txtdomain'),
			'search_items' => __('Search Category', 'txtdomain'),
			'parent_item' => __('Parent Category', 'txtdomain'),
			'parent_item_colon' => __('Parent Category:', 'txtdomain'),
			'not_found' => __('No Category found', 'txtdomain'),
		]
	]);
	register_taxonomy_for_object_type('project_taxonomy', 'project');

});