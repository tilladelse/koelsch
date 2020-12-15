<?php

if ( ! class_exists( 'BaseACFLinkHelper' ) ) {

	/**
	 * BaseACFLinkHelper
	 *
	 * Helper class for ACF link field.
	 * Code example:
	 * if ( BaseACFLinkHelper::isLink( $link ) ) BaseACFLinkHelper::theLink( $link, array( 'btn', 'btn-primary' ) );
	 */
	class BaseACFLinkHelper {

		/**
		 * Determines if a variable is an link array.
		 * @param array $link
		 * @return boolean
		 */
		public static function isLink( $link ) {
			if ( is_array( $link ) && ! empty( $link['url'] ) && ! empty( $link['title'] ) ) {
				return true;
			}
			return false;
		}

		/**
		 * Returns link HTML code.
		 * @param array $link
		 * @param array $classes
		 * @return string
		 */
		public static function getLink( $link, $classes = array(), $title = '' ) {
			$_url = $link['url'];
			$_title = !empty($title) ? $title : $link['title'];
			$_target = ! empty( $link['target'] ) ? $link['target'] : '_self';
			$_class = ! empty( $classes ) ? implode( ' ', $classes ) : '';
			$output = '<a' . ( $_class ? ' class="' . $_class . '"' : '' ) . ' href="' . esc_url( $_url ) . '" target="' . $_target . '">' . esc_html( $_title ) . '</a>';
			return $output;
		}

		/**
		 * Print link HTML code.
		 * @param array $link
		 * @param array $classes
		 */
		public static function theLink( $link, $classes = array(), $title = '' ) {
			echo self::getLink( $link, $classes, $title );
		}

	}

}
