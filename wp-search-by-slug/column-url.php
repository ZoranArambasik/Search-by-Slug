<?php
// // Get current post type on edit.php
function current_post_type() {
    global $pagenow, $post, $typenow, $current_screen;
    if ($pagenow !== 'edit.php') {
        return;
    } 
    if ($post && $post->post_type) return $post->post_type;
    elseif($typenow) return $typenow;
    elseif($current_screen && $current_screen->post_type) return $current_screen->post_type;
    elseif(isset($_REQUEST['post_type'])) return sanitize_key($_REQUEST['post_type']);
    return 'post'; // just return post since on edit.php that is the only type that doesn't show the its type in the url.
}

    
//var_dump(current_post_type()); //- remove this after checking!!!
add_filter('manage_'.current_post_type().'_posts_columns', 'url_column', 10);
add_action('manage_'.current_post_type().'_posts_custom_column', 'add_url_column', 10, 2);


function url_column($column_url_name) {
    $column_url_name['url'] = 'Url Path';
    return $column_url_name;
}

function add_url_column($column_name, $post_id) {
    if ($column_name == 'url') {
        $post = get_post($post_id); 
        $slug = $post->post_name;
        echo  '/' . $slug . '/';
    }
}