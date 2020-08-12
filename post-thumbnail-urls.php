<?php
/*
 * @desc Add thumbnail, medium, large, and full post thumbnail URLs object to API Response
 * @link https://developer.wordpress.org/rest-api/extending-the-rest-api/modifying-responses/
 */
add_action('rest_api_init', function () {
    // Change your type, this could be core type like post, terms, meta, user or comments
    $object_type = 'post';
    // The name of the new field that will be added to the API response
    $attribute = 'featured_media_urls';
    $schema = array(
        'schema' => array(
            'description' => __('Featured image URLs'),
            'type' => 'object'
        )
    );
    $get_callback = array(
        'get_callback' => function ($arr) {
            $urls['thumbnail'] = get_the_post_thumbnail_url($arr['id'], 'thumbnail');
            $urls['medium'] = get_the_post_thumbnail_url($arr['id'], 'medium');
            $urls['large'] = get_the_post_thumbnail_url($arr['id'], 'large');
            $urls['full'] = get_the_post_thumbnail_url($arr['id'], 'full');
            return (object) $urls;
        },
    );
    register_rest_field(
        $object_type,
        $attribute,
        $get_callback,
        $schema
    );
});
