<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @package        WordPress
 * @subpackage     BuddyPress, Woocommerce, WC4BP
 * @author         ThemKraft Dev Team
 * @copyright      2017, Themekraft
 * @link           http://themekraft.com/store/woocommerce-buddypress-integration-wordpress-plugin/
 * @license        http://www.opensource.org/licenses/gpl-2.0.php GPL License
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class wc4bp_groups_woo_base {
	/**
	 * Get the groups configured associated to a product
	 *
	 * @param $product_id
	 *
	 * @return array
	 */
	protected function get_product_groups( $product_id ) {
		$product = wc_get_product( $product_id );
		if ( empty( $product ) ) {
			return array();
		}
		$type   = $product->get_type();
		$groups = array();
		if ( $type === 'variable' && $product instanceof WC_Product_Variable ) {
			$variations = $product->get_available_variations();
			foreach ( $variations as $variation ) {
				$variation_id = $variation['variation_id'];
				$groups_json  = get_post_meta( $variation_id, '_wc4bp_groups_json', true );

				if ( ! empty( $groups_json ) ) {
					$groups[] = json_decode( html_entity_decode( $groups_json ) );
				}
			}
		} else {
			$groups_json = get_post_meta( $product_id, '_wc4bp_groups_json', true );
			$groups_json = html_entity_decode( $groups_json );
			if ( ! empty( $groups_json ) ) {
				$groups = json_decode( $groups_json );
			}

		}

		$result = array();

		if ( is_array( $groups ) ) {
			$result = $groups;
		}


		return $result;
	}

	/**
	 * Get the groups configured to a product not optionals
	 *
	 * @param $product_id
	 *
	 * @return array
	 */
	protected function get_product_groups_not_optional( $product_id ) {
		$groups_json = get_post_meta( $product_id, '_wc4bp_groups_json', true );
		$groups_json = html_entity_decode( $groups_json );
		$result      = array();
		if ( ! empty( $groups_json ) ) {
			$groups = json_decode( $groups_json );
			if ( is_array( $groups ) ) {
				foreach ( $groups as $group ) {
					if ( ! isset( $group->is_optional ) || $group->is_optional == '0' ) {
						$result[ $group->group_id ] = $group;
					}
				}
			}
		}

		return $result;
	}

	/**
	 * Get group save in the configuration by his id belong to product
	 *
	 * @param $product_id
	 * @param $group_id
	 *
	 * @return bool|stdClass
	 */
	protected function get_product_group( $product_id, $group_id ) {
		$option_groups = $this->get_product_groups( $product_id );
		foreach ( $option_groups as $option_group ) {
			if ( intval( $option_group->group_id ) === intval( $group_id ) ) {
				return $option_group;
			}
		}

		return false;
	}
}