<?php
if(!is_admin()) {
    return;
}
// SLUG SEARCH ON POST TYPES
function search_by_slug($search, $wp_query) {
    global $wpdb;
    if(empty($search)) {
        return $search;
    }
    $query = $wp_query->query_vars;
    $search_string = $query['s'];
    // var_dump($search_string); - remove this after checking!!!
    $like = !empty($query['exact']) ? '' : '%';
    // var_dump($like); - remove this after checking!!!
    if( 'slug:' === mb_substr( trim( $search_string ), 0, 5 ) && 'slug:' !== $search_string )  {
        $search =
        $and = '';
        foreach ((array)$query['search_terms'] as $term) {
            $term_with_slug = esc_sql($wpdb->esc_like($term));
            $term = trim( mb_substr($term_with_slug, 5)); // removing the 'slug:' from query.
            $search .= "{$and}($wpdb->posts.post_name LIKE '{$like}{$term}{$like}')";
            $and = ' AND ';
        }

        if (!empty($search)) {
            $search = " AND ({$search}) ";
        }
    }
    return $search;
}
add_filter('posts_search', 'search_by_slug', 100, 2);