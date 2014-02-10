<?php

function get_custom_excerpt($text, $length)
{
    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', $length);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text);
}

// change the default WordPress excerpt
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');