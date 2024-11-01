<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Leaven empty tag to let automation add the path disclosure line
?>
<div id="wc4bp_item_<?php echo esc_attr( $group->group_id ); ?>" data-taxonomy="" class="woocommerce_attribute wc-metabox closed wc4bp-group-item" rel="0" group_name="<?php echo esc_attr( $group->group_name ); ?>" group_id="<?php echo esc_attr( $group->group_id ); ?>">
	<h3>
		<a group_id="<?php echo esc_attr( $group->group_id ); ?>" href="#" class="remove_row delete wc4bp-group-group-remove"><?php wc4bp_groups_manager::echo_esc_attr_translation( 'Remove' ); ?></a>
		<div class="handlediv" title="<?php wc4bp_groups_manager::echo_esc_attr_translation( 'Click to toggle' ); ?>"></div>
		<strong class="attribute_name"><?php echo esc_html( $group->group_name ); ?></strong>
	</h3>
	<div class="woocommerce_attribute_data wc-metabox-content">
		<div class="wc4bp_data_inner_content">
			<?php
			$membership_level = array(
				'id'      => '_membership_level',
				'label'   => wc4bp_groups_manager::translation( 'Membership level:' ),
				'options' => array(
					'1' => wc4bp_groups_manager::translation( 'Moderator' ),
					'2' => wc4bp_groups_manager::translation( 'Admin' ),
					'0' => wc4bp_groups_manager::translation( 'Normal' ),
				),
			);

			if ( isset( $group->member_type ) ) {
				$membership_level['value'] = $group->member_type;
			}

			woocommerce_wp_select( $membership_level );

			$is_optional = array(
				'id'      => '_membership_optional',
				'label'   => wc4bp_groups_manager::translation( 'Is optional:' ),
				'options' => array(
					'1' => wc4bp_groups_manager::translation( 'Yes' ),
					'0' => wc4bp_groups_manager::translation( 'No' ),
				),
			);
			if ( isset( $group->is_optional ) ) {
				$is_optional['value'] = $group->is_optional;
			}

			woocommerce_wp_select( $is_optional );

			$trigger = array(
				'id'      => '_trigger',
				'label'   => wc4bp_groups_manager::translation( 'Trigger on Action:' ),
				'options' => array(
					'completed'  => wc4bp_groups_manager::translation( 'Completed' ),
					'processing' => wc4bp_groups_manager::translation( 'Processing' ),
					'refunded'   => wc4bp_groups_manager::translation( 'Refunded' ),
					'on-hold'    => wc4bp_groups_manager::translation( 'On-Hold' ),
					'pending'    => wc4bp_groups_manager::translation( 'Pending' ),
					'cancelled'  => wc4bp_groups_manager::translation( 'Cancelled' ),
				),
			);

			if ( isset( $group->trigger ) ) {
				$trigger['value'] = $group->trigger;
			}

			woocommerce_wp_select( $trigger );

			if ( $post_id > 0 ) {
				$product = wc_get_product( $post_id );
				$type    = $product->get_type();
				if ( $type === 'variable' && $product instanceof WC_Product_Variable ) {
					$variations                       = $product->get_available_variations();
					$variations_options               = array();
					$wc4bp_groups_available_variation = '';
					foreach ( $variations as $variation ) {
						$wc4bp_groups_available_variation                .= $variation['variation_id'] . ',';
						$variation_attributes                             = wc_get_product( $variation['variation_id'] );
						$variations_options[ $variation['variation_id'] ] = $variation_attributes->get_name();
					}
					$variations_select = array(
						'id'                => '_variation',
						'name'              => '_variation[]',
						'custom_attributes' => array(
							'previouSel'          => '',
							'availableVariations' => rtrim( trim( $wc4bp_groups_available_variation ), ',' ),
							'groupId'             => $group->group_id,
						),
						'class'             => 'variation_list',
						'label'             => wc4bp_groups_manager::translation( 'Variation:' ),
						'options'           => $variations_options,
					);

					if ( isset( $group->variation ) ) {
						// $variations_select['id']    = '_variation_'.$group->group_id .'_' .$group->variation;
						$variations_select['value']                           = $group->variation;
						$variations_select['custom_attributes']['previouSel'] = $group->variation;


					}

					woocommerce_wp_select( $variations_select );
				}
			}

			?>
		</div>
	</div>
</div>
