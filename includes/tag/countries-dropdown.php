<?php
/**
** A base module for the following types of tags:
** 	[country_twx] and [country_twx*]		# Countries
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'twx_add_form_tag_country' );

function twx_add_form_tag_country() {
    wpcf7_add_form_tag( array( 'country_twx', 'country_twx*' ),
        'twx_country_return_form_tag_handler', array( 'name-attr' => true ) );
}

function twx_country_return_form_tag_handler( $tag ) {
    $tag = new WPCF7_FormTag( $tag );

    if ( empty( $tag->name ) ) {
        return '';
    }

    $atts = array();

    $class = wpcf7_form_controls_class( $tag->type, 'country_twx' );
    $atts['class'] = $tag->get_class_option( $class );
    $atts['id'] = $tag->get_id_option();

    $atts['name'] = $tag->name;
    $atts = wpcf7_format_atts( $atts );

    $countries = WC()->countries->get_allowed_countries();

    $field = '<select %s>'
            .'<option value="">' . esc_html__( 'Country / Region', 'twx-woo-cf7' ) . '</option>';
    foreach ( $countries as $ckey => $cvalue ) {
            $field .= '<option value="' . esc_attr( $ckey ) . '">' . esc_html( $cvalue ) . '</option>';
    }
    $field .= '</select>';

    $html = sprintf( $field, $atts );
    return $html;
}

/* Tag generator */

add_action( 'wpcf7_admin_init', 'twx_add_tag_generator_country_twx', 19, 0 );

function twx_add_tag_generator_country_twx() {
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add( 'country_twx', __( 'WC Countries Dropdown', 'twx-woo-cf7' ),
		'twx_tag_generator_country_twx' );
}

function twx_tag_generator_country_twx( $contact_form, $args = '' ) {
	$args = wp_parse_args( $args, array() );
	$type = 'country_twx';

	$description = __( 'Generate a form-tag for WC countries dropdown.', 'twx-woo-cf7' );
?>
<div class="control-box">
<fieldset>
<legend><?php echo sprintf( esc_html( $description ) ); ?></legend>

<table class="form-table">
<tbody>
	<tr>
	<th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
	<td>
		<fieldset>
		<legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
		<label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
		</fieldset>
	</td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
	</tr>
</tbody>
</table>
    
        <div style="font-size: 13px;border: 1px solid;padding: 5px 8px 8px;border-radius: 3px;background: #f2f2f2;"><b>
        <?php echo sprintf( __( "Countries can influence ZIP code & city fields. If you want to update labels or placeholders depending on country :<br>-- Please add 'city_container' class on city field container,<br>-- Please add have added 'zip_container' class on zip code field container.", 'twx-woo-cf7' ) ); ?>
        </b></div>
    
</fieldset>
</div>

<div class="insert-box">
	<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

	<div class="submitbox">
	<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
	</div>

	<br class="clear" />

	<p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
        
</div>
<?php
}