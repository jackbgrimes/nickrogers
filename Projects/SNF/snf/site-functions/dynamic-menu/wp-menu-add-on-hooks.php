<?php


add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function submenu_limit( $items, $args ) {
    if ( empty( $args->submenu ) ) {
        return $items;
    }
    $ids       = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
    $parent_id = array_pop( $ids );
    $children  = submenu_get_children_ids( $parent_id, $items );
    foreach ( $items as $key => $item ) {
        if ( ! in_array( $item->ID, $children ) ) {
            unset( $items[$key] );
        }
    }
    return $items;
}

function submenu_get_children_ids( $id, $items ) {
    $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );
    foreach ( $ids as $id ) {

        $ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
    }
    return $ids;
}
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);