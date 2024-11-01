<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Leaven empty tag to let automation add the path disclosure line
?>
<p class="form-field">
	<span class="expand-close">
		<a href="#" class="expand_all"><?php wc4bp_groups_manager::echo_translation( 'Expand' ); ?></a> / <a href="#" class="close_all"><?php wc4bp_groups_manager::echo_translation( 'Close' ); ?></a>
	</span>
	<label for="wc4bp-group-ids"><?php wc4bp_groups_manager::echo_translation( 'Select groups to add' ); ?></label>
	<select multiple class="select2-hidden-accessible wc4bp-group-search" style="width: 50%;" id="wc4bp-group-ids" name="wc4bp-group-ids"
		   data-placeholder="<?php wc4bp_groups_manager::echo_esc_attr_translation( 'Search for a group' ); ?>" data-action="wc4bp_group_search"
		   data-multiple="true" data-exclude="<?php echo intval( $post->ID ); ?>"
			avalibaleProductVariations="
			<?php

			$product = wc_get_product( $post->ID );
			$type    = $product->get_type();
			if ( $type === 'variable' && $product instanceof WC_Product_Variable ) {
				$variations                       = $product->get_available_variations();
				$wc4bp_groups_available_variation = '';
				foreach ( $variations as $variation ) {
					$wc4bp_groups_available_variation .= $variation['variation_id'] . ',';
				}
				echo esc_attr( rtrim( trim( $wc4bp_groups_available_variation ), ',' ) );
			}
			?>
			"
			data-isvariation="
			<?php
			$product = wc_get_product( $post->ID );
			$type    = $product->get_type();
			if ( $type === 'variable' && $product instanceof WC_Product_Variable ) {
				echo ( 'true' );
			} else {
				echo ( 'false' );
			}

			?>
			"
		   data-selected="
		   <?php

			$group_ids = array_filter( array_map( 'absint', (array) get_post_meta( $post->ID, '_wc4bp-group-ids', true ) ) );
			$json_ids  = array();

			foreach ( $group_ids as $group_id ) {
				$product = wc_get_product( $group_id );
				if ( is_object( $product ) ) {
					$json_ids[ $group_id ] = wp_kses_post( html_entity_decode( $product->get_formatted_name(), ENT_QUOTES, get_bloginfo( 'charset' ) ) );
				}
			}

			echo esc_attr( json_encode( $json_ids ) );
			?>
		   " value="<?php echo esc_attr( implode( ',', array_keys( $json_ids ) ) ); ?>"></select>
	<button type="button" class="button wc4bp add_groups"><?php wc4bp_groups_manager::echo_translation( 'Add Group' ); ?></button>
	<span class="wc4bp-group-loading"></span>
</p>
