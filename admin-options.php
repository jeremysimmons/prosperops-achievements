<?php
class ProsperOpsAchievementOptions {
	private $prosperops_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'prosperops_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'prosperops_page_init' ) );
	}

	public function prosperops_add_plugin_page() {
		add_menu_page(
			'ProsperOps', // page_title
			'ProsperOps', // menu_title
			'manage_options', // capability
			'prosperops', // menu_slug
			array( $this, 'prosperops_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			2 // position
		);
	}

	public function prosperops_create_admin_page() {
		$this->prosperops_options = get_option( 'prosperops_achievements' ); ?>

		<div class="wrap">
			<h2>ProsperOps</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'prosperops_option_group' );
					do_settings_sections( 'prosperops-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function prosperops_page_init() {
		register_setting(
			'prosperops_option_group', // option_group
			'prosperops_achievements', // option_name
			array( $this, 'prosperops_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'prosperops_setting_section', // id
			'Achievements', // title
			array( $this, 'prosperops_section_info' ), // callback
			'prosperops-admin' // page
		);

		add_settings_field(
			'annual_compute_under_management', // id
			'Annual Compute Under Management', // title
			array( $this, 'annual_compute_under_management_callback' ), // callback
			'prosperops-admin', // page
			'prosperops_setting_section' // section
		);

		add_settings_field(
			'lifetime_savings_generated', // id
			'Lifetime Savings Generated', // title
			array( $this, 'lifetime_savings_generated_callback' ), // callback
			'prosperops-admin', // page
			'prosperops_setting_section' // section
		);

		add_settings_field(
			'compute_state_changes', // id
			'Compute State Changes', // title
			array( $this, 'compute_state_changes_callback' ), // callback
			'prosperops-admin', // page
			'prosperops_setting_section' // section
		);

		add_settings_field(
			'discount_instruments_managed', // id
			'Discount Instruments Managed', // title
			array( $this, 'discount_instruments_managed_callback' ), // callback
			'prosperops-admin', // page
			'prosperops_setting_section' // section
		);
	}

	public function prosperops_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['annual_compute_under_management'] ) ) {
			$sanitary_values['annual_compute_under_management'] = sanitize_text_field( $input['annual_compute_under_management'] );
		}

		if ( isset( $input['lifetime_savings_generated'] ) ) {
			$sanitary_values['lifetime_savings_generated'] = sanitize_text_field( $input['lifetime_savings_generated'] );
		}

		if ( isset( $input['compute_state_changes'] ) ) {
			$sanitary_values['compute_state_changes'] = sanitize_text_field( $input['compute_state_changes'] );
		}

		if ( isset( $input['discount_instruments_managed'] ) ) {
			$sanitary_values['discount_instruments_managed'] = sanitize_text_field( $input['discount_instruments_managed'] );
		}

		return $sanitary_values;
	}

	public function prosperops_section_info() {
		
	}

	public function annual_compute_under_management_callback() {
		printf(
			'<input class="regular-text" type="number" name="prosperops_achievements[annual_compute_under_management]" id="annual_compute_under_management" value="%s">
			<small>[po-achivement name="annual_compute_under_management"]</small>',
			isset( $this->prosperops_options['annual_compute_under_management'] ) ? esc_attr( $this->prosperops_options['annual_compute_under_management']) : ''
		);
	}

	public function lifetime_savings_generated_callback() {
		printf(
			'<input class="regular-text" type="number" name="prosperops_achievements[lifetime_savings_generated]" id="lifetime_savings_generated" value="%s">
			<small>[po-achivement name="lifetime_savings_generated"]</small>',
			isset( $this->prosperops_options['lifetime_savings_generated'] ) ? esc_attr( $this->prosperops_options['lifetime_savings_generated']) : ''
		);
	}

	public function compute_state_changes_callback() {
		printf(
			'<input class="regular-text" type="number" name="prosperops_achievements[compute_state_changes]" id="compute_state_changes" value="%s">
			<small>[po-achivement name="compute_state_changes"]</small>',
			isset( $this->prosperops_options['compute_state_changes'] ) ? esc_attr( $this->prosperops_options['compute_state_changes']) : ''
		);
	}

	public function discount_instruments_managed_callback() {
		printf(
			'<input class="regular-text" type="number" name="prosperops_achievements[discount_instruments_managed]" id="discount_instruments_managed" value="%s">
			<small>[po-achivement name="discount_instruments_managed"]</small>',
			isset( $this->prosperops_options['discount_instruments_managed'] ) ? esc_attr( $this->prosperops_options['discount_instruments_managed']) : ''
		);
	}

}
if ( is_admin() )
	$prosperops_achievement_options = new ProsperOpsAchievementOptions();

/* 
 * Retrieve this value with:
 * $prosperops_options = get_option( 'prosperops_achievements' ); // Array of All Options
 * $annual_compute_under_management = $prosperops_options['annual_compute_under_management']; // Annual Compute Under Management
 * $lifetime_savings_generated = $prosperops_options['lifetime_savings_generated']; // Lifetime Savings Generated
 * $compute_state_changes = $prosperops_options['compute_state_changes']; // Compute State Changes
 * $discount_instruments_managed = $prosperops_options['discount_instruments_managed']; // Discount Instruments Managed
 */