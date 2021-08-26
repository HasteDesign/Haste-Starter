<?php
/**
 * Haste_Starter_Bootstrap_Nav_Walker class.
 *
 * A custom WordPress nav walker to implement the Bootstrap 3 dropdown navigation using the WordPress built in menu manager.
 * Inspired by the class twitter_bootstrap_nav_walker <https://github.com/twittem/wp-bootstrap-navwalker>,
 * created by Edward McIntyre and with the licence GPLv2.
 *
 * @package  Haste Starter
 * @category Bootstrap
 * @author   Haste
 * @version  1.0.0
 */
class Bootstrap_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param int    $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$class_names = '';
		$value       = '';
		$indent      = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if ( $this->item_menu_el( $item, $depth, $indent ) ) {
			return $output .= $this->item_menu_el( $item, $depth, $indent );

		}
		$class_names = $this->item_menu_classes( $item, $args, $depth );

		$id = $this->item_menu_id( $item, $args );

		$output .= $indent . '<li' . $id . $value . $class_names . '>';

		$atts = $this->item_menu_atts( $item, $args, $depth );

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		$item_output .= $this->item_menu_glyphicons( $item, $item_output, $attributes, $args );

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	protected function item_menu_id( $item, $args ) {
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		return $id ? ' id="' . esc_attr( $id ) . '"' : '';
	}

	protected function item_menu_atts( $item, $args, $depth ) {
		$atts = array(
			'title'  => ! empty( $item->title ) ? strip_tags( $item->title ) : '',
			'target' => ! empty( $item->target ) ? $item->target : '',
			'rel'    => ! empty( $item->xfn ) ? $item->xfn : '',
			'class'  => 'nav-link',
		);
		// If item has_children add atts to a.
		if ( $args->has_children && 0 === $depth ) {
			$atts['href']        = '#';
			$atts['data-toggle'] = 'dropdown';
			$atts['class']      .= ' dropdown-toggle';
		} else {
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
		}
		return $atts;
	}

	protected function item_menu_classes( $item, $args, $depth ) {
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav-item menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		if ( $args->has_children ) {
			$class_names .= ' dropdown';
		}

		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$class_names .= ' active';
		}

		if ( $depth > 0 ) {
			$class_names .= ' dropdown-item';
		}

		return $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	}
				/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
	protected function item_menu_glyphicons( $item, $item_output, $attributes, $args ) {
		if ( ! empty( $item->attr_title ) ) {
			$item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
		} else {
			$item_output .= '<a' . $attributes . '>';
		}

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		return $item_output;
	}
	/**
	 * Check if the item is divider, header or disabled
	 *
	 * Dividers, Headers or Disabled
	 * =============================
	 * Determine whether the item is a Divider, Header, Disabled or regular
	 * menu item. To prevent errors we use the strcasecmp() function to so a
	 * comparison that is not case sensitive. The strcasecmp() function returns
	 * a 0 if the strings are equal.
	 *
	 * @param mixed $item
	 * @param mixed $depth
	 * @param mixed $indent
	 *
	 * @return HTML
	 */
	protected function item_menu_el( $item, $depth, $indent ) {
		$output = '';
		if ( strcasecmp( $item->attr_title, 'divider' ) === 0 && 1 === $depth ) {
			return $output .= $indent . '<li role="presentation" class="dropdown-divider">';
		}
		if ( strcasecmp( $item->attr_title, 'dropdown-header' ) === 0 && 1 === $depth ) {
			return $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		}
		if ( strcasecmp( $item->attr_title, 'disabled' ) === 0 ) {
			return $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		}
		return false;
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 *
	 * @param object $element Data object.
	 * @param array  $children_elements List of elements to continue traversing.
	 * @param int    $max_depth Max depth to traverse.
	 * @param int    $depth Depth of current element.
	 * @param array  $args
	 * @param string $output Passed by reference. Used to append additional content.
	 *
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			$args = (object) $args;

			$fb_output = null;
			if ( $args->container ) {
				$fb_output .= self::haste_starter_fb_container( $args, $fb_output );
			}

			$fb_output .= '<ul';

			$fb_output .= self::haste_starter_fb_attributes( $args, $fb_output );

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Add a menu', 'haste-starter' ) . '</a></li>';
			$fb_output .= '</ul>';

			if ( $args->container ) {
				$fb_output .= '</' . $args->container . '>';
			}

			echo $fb_output;
		}
	}

	/**
	 * Create fallback list (ul) with id and classes
	 *
	 * @param mixed $args
	 * @param mixed $fb_output
	 *
	 * @return [type]
	 */
	private static function haste_starter_fb_attributes( $args, $fb_output ) {
		if ( $args->menu_id ) {
			$fb_output .= ' id="' . $args->menu_id . '"';
		}

		if ( $args->menu_class ) {
			$fb_output .= ' class="' . $args->menu_class . '"';
		}
		return $fb_output;
	}

	/**
	 * Create fallback container with id and classes
	 *
	 * @param mixed $args
	 * @param mixed $fb_output
	 *
	 * @return [type]
	 */
	private static function haste_starter_fb_container( $args, $fb_output ) {
		$fb_output = '<' . $args->container;
		if ( $args->container_id ) {
			$fb_output .= ' id="' . $args->container_id . '"';
		}
		if ( $args->container_class ) {
			$fb_output .= ' class="' . $args->container_class . '"';
		}
		$fb_output .= '>';
		return $fb_output;
	}
}
