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

class wc4bp_groups_woo_subscription extends wc4bp_groups_woo_base {

	/**
	 * @var array
	 */
	private $remove_status;
	/**
	 * @var array
	 */
	private $add_status;

	public function __construct() {
		add_action( 'woocommerce_subscription_status_updated', array( $this, 'woocommerce_subscription_status_updated' ), 10, 3 );
		$this->remove_status = array( 'cancelled', 'expired', 'on-hold' );
		$this->add_status    = array( 'active' );
	}

	/**
	 * @param WC_Subscription $subscription
	 * @param $new_status
	 * @param $old_status
	 */
	public function woocommerce_subscription_status_updated( $subscription, $new_status, $old_status ) {
		if ( ! empty( $subscription ) && ! empty( $new_status ) ) {
			$customer = $subscription->get_user();
			if ( false !== $customer ) {
				$add_status    = apply_filters( 'wc4bp_groups_subscription_trigger_add_to_groups', $this->add_status, $subscription, $new_status );
				$remove_status = apply_filters( 'wc4bp_groups_subscription_trigger_remove_to_groups', $this->remove_status, $subscription, $new_status );
				$items         = $subscription->get_items();
				/** @var object $item */
				foreach ( $items as $key => $item ) {
					/** @var WC_Product $product */
					$product = $item->get_product();
					if ( ! empty( $product ) ) {
						$final_groups = array();
						if ( isset( $item['wc4bp_groups'] ) ) { // Process all selected groups by the user when buy the product
							$groups = json_decode( $item['wc4bp_groups'], true );
							foreach ( $groups as $group_id => $group_name ) {
								$option_group              = $this->get_product_group( absint( $product->get_id() ), $group_id );
								$final_groups[ $group_id ] = $option_group;
							}
						}
						$not_optional_groups = $this->get_product_groups_not_optional( absint( $product->get_id() ) ); // Process the not optional groups set in the product
						if ( ! empty( $not_optional_groups ) ) {
							$final_groups = array_merge( $final_groups, $not_optional_groups );
						}
						foreach ( $final_groups as $group_id => $group ) { // Process all groups related to the current item
							if ( in_array( $new_status, $add_status ) ) {
								$is_admin = 0;
								$is_mod   = 0;
								if ( '2' === $group->member_type ) {
									$is_admin = 1;
									$is_mod   = 0;
								} elseif ( '1' === $group->member_type ) {
									$is_admin = 0;
									$is_mod   = 1;
								}
								wc4bp_groups_model::add_member_to_group( $group->group_id, $customer->ID, $is_admin, $is_mod );
							} elseif ( in_array( $new_status, $remove_status ) ) {
								wc4bp_groups_model::remove_member_from_group( $group->group_id, $customer->ID );
							}
						}
					}
				}
			}
		}
	}
}
