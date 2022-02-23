<?php
/**
** A base module for the following types of tags:
** 	[time and [time*]		# Time
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'twx_add_form_tag_time' );

function twx_add_form_tag_time() {
    wpcf7_add_form_tag( array( 'time', 'time*' ),
        'twx_time_form_tag_handler', array( 'name-attr' => true ) );
}

function twx_time_form_tag_handler( $tag ) {
    
    
    $tag = new WPCF7_FormTag( $tag );

    if ( empty( $tag->name ) ) {
        return '';
    }

    $validation_error = wpcf7_get_validation_error( $tag->name );
    
    $class = wpcf7_form_controls_class( $tag->type, 'time_twx' );

    $class .= ' wpcf7-validates-as-time';

    if ( $validation_error ) {
            $class .= ' wpcf7-not-valid';
    }

    $atts = array();

    $atts['class'] = $tag->get_class_option( $class );
    $atts['id'] = $tag->get_id_option();
    
    $min = $tag->get_option( 'min' );
    if ($min) $atts['min'] = $min[0];
    
    $max = $tag->get_option( 'max' );
    if ($max) $atts['max'] = $max[0];

    $atts['name'] = $tag->name;

    if ( $tag->is_required() ) {
            $atts['aria-required'] = 'true';
    }

    if ( $validation_error ) {
            $atts['aria-invalid'] = 'true';
    } else {
            $atts['aria-invalid'] = 'false';
    }

    if ( wpcf7_support_html5() ) {
            $atts['type'] = $tag->basetype;
    } else {
            $atts['type'] = 'text';
    }

    $atts = wpcf7_format_atts( $atts );

    $html = sprintf(
            '<span class="wpcf7-form-control-wrap %1$s"><input %2$s />%3$s</span>',
            sanitize_html_class( $tag->name ), $atts, $validation_error
    );
    
    return $html;
}


/* Validation filter */

add_filter( 'wpcf7_validate_time', 'validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_time*', 'validation_filter', 10, 2 );

function validation_filter( $result, $tag ) {
    
        $name = $tag->name;

	$min = $tag->get_option( 'min' );
	$max = $tag->get_option( 'max' );

        $value = trim($_POST[$name]);

        if ( $tag->is_required() and '' === $value ) {
                $result->invalidate($tag, wpcf7_get_message('invalid_required'));
        } elseif ( '' !== $value and ! twx_is_time( $value ) ) {
		$result->invalidate( $tag, __( "The time format is incorrect.", 'twx-woo-cf7' ) );
	} elseif ( '' !== $value and ! empty( $min ) and $value < $min) {
		$result->invalidate( $tag, __( "The time is before the earliest one allowed.", 'twx-woo-cf7' ) );
	} elseif ( '' !== $value and ! empty( $max ) and $max < $value ) {
		$result->invalidate( $tag, __( "The time is after the latest one allowed.", 'twx-woo-cf7' ) );
	}
        
	return $result;
}

function twx_is_time($value) {
    $valid = strtotime($value) ? true : false;
    return apply_filters( 'twx_is_time', $valid, $value );
}

/* Tag generator */

add_action( 'wpcf7_admin_init', 'twx_add_tag_generator_time', 19, 0 );

function twx_add_tag_generator_time() {
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add( 'time', __( 'time' ),
		'twx_tag_generator_time' );
}

function twx_tag_generator_time( $contact_form, $args = '' ) {
	$args = wp_parse_args( $args, array() );
	$type = 'time';

	$description = __( 'Generate a form-tag for a time field.', 'twx-woo-cf7' );
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
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Default value', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>" /><br />
	</tr>

	<tr>
	<th scope="row"><?php echo esc_html( __( 'Range', 'contact-form-7' ) ); ?></th>
	<td>
		<fieldset>
		<legend class="screen-reader-text"><?php echo esc_html( __( 'Range', 'contact-form-7' ) ); ?></legend>
		<label>
		<?php echo esc_html( __( 'Min', 'contact-form-7' ) ); ?>
		<input type="time" name="min" class="time option" />
		</label>
		&ndash;
		<label>
		<?php echo esc_html( __( 'Max', 'contact-form-7' ) ); ?>
		<input type="time" name="max" class="time option" />
		</label>
		</fieldset>
	</td>
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