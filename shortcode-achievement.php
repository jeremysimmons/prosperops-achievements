<?php
/**
 * Achievement shortcode
 *
 * [po-achievement name="annual_compute_under_management"]
 * [po-achievement name="lifetime_savings_generated"]
 * [po-achievement name="compute_state_changes"]
 * [po-achievement name="discount_instruments_managed"]
 * 
 * @package	 POA
 * @since    1.0.0
 */

if ( ! function_exists( 'poa_achievement_shortcode' ) ) {

	add_shortcode( 'po-achievement', 'poa_achievement_shortcode' );

	/**
	 * Shortcode Function
	 *
	 * @param  Attributes $atts name NAME
	 * @return string
	 * @since  1.0.0
	 */
	function poa_achievement_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'name' => 'annual_compute_under_management'
		), $atts, 'po-achievement' );
		$name = $atts['name'];
		$achievements = ['annual_compute_under_management', 'lifetime_savings_generated', 'compute_state_changes', 'discount_instruments_managed' ];
		$search = array_search($name, $achievements);
		if($search === false) {
			return "Invalid achievement name: $name";
		}
		$option = get_option( 'prosperops_achievements' );
		$achievement_value = floatval( $option[$name] );
		return sprintf('<span class="%s">%s</span>', esc_attr($name), poa_nice_number( $achievement_value ) );
	}

	function poa_nice_number($n) {
        $n = (0+str_replace(",", "", $n));
        if (!is_numeric($n)) return false;
        if ($n > 1000000000000) return sprintf('$%.2fT', round(($n/1000000000000), 2));
        elseif ($n > 1000000000) return sprintf('$%.2fB', round(($n/1000000000), 2));
        elseif ($n > 1000000) return sprintf('$%.2fM', round(($n/1000000), 2));
        elseif ($n > 1000) return sprintf('$%.2fK', round(($n/1000), 2));
        return number_format($n);
    }
}
