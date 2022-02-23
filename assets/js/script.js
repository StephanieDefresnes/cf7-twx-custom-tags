function setState($, country_code) {
    
    var data = {
        action: 'twx_get_states',
        nonce_ajax : twx_auto_ajax.nonce,
        country_code: country_code
    }

    $.ajax({  
        url : twx_auto_ajax.ajax_url,
        type: 'POST', 
        dataType: 'json',
        data: data,  
        success: function(response){

            // Save & data field
            let form            = $('.wpcf7[role="form"]'),
                state           = form.find('.state_twx'),
                state_name      = state.attr('name'),
                state_id        = state.attr('id'),
                state_class     = state.attr('class'),
                zip_container   = form.find('.zip_container'),
                city_container  = form.find('.city_container'),
                isStateSelect2  = (state.is('select') && state.hasClass('select2'))
                                    ? true : false

            let select = $('<select></select>'),
                input = $('<input>'),
                required = '<abbr class="required">*</abbr>'

            if (response.success) {
                let states = response.states,
                    state_data = response.state_data
                    optional = state_data.optional

                // If states add options
                if (states.length !== 0) {

                    // Reset options if current is select
                    if (isStateSelect2) state.select2('destroy')

                    if (typeof state_name !== 'undefined' && state_name !== false)
                        select.attr('name', state_name)
                    if (typeof state_id !== 'undefined' && state_id !== false)
                        select.attr('id', state_id)
                    if (typeof state_class !== 'undefined' && state_class !== false)
                        select.attr('class', state_class)

                    select.append('<option value="">'+ state_data.state_placeholder +'</option>')
                    $.each(response.states, function(k, v) {
                        let option = '<option value="'+ k +'">'+ v +'</option>'
                        select.append(option)
                    })
                    
                    state.replaceWith(select)

                    if (isStateSelect2) select.select2()

                    if ($('.state_twx').parents('.state_container').length > 0)
                        $('.state_twx').parents('.state_container').css({display: 'initial'})

                }
                // If no option
                else {
                    // -- Admin must have added 'state_container' class on field container 
                    if ($('.state_twx').parents('.state_container').length > 0) {
                        let state_container = $('.state_twx').parents('.state_container')

                        // If country doesn't need state field
                        if (state_data.state_title === 'none')
                            state_container.css({display: 'none'})
                        else state_container.css({display: 'initial'})
                    }

                    // If country return is empty but gives state text field as option
                    if (state_data.state_tag === 'text') {

                        if (typeof state_name !== 'undefined' && state_name !== false)
                            input.attr('name', state_name)
                        if (typeof state_id !== 'undefined' && state_id !== false)
                            input.attr('id', state_id)
                        if (typeof state_class !== 'undefined' && state_class !== false)
                            input.attr('class', state_class)

                        state.replaceWith(input)

                        // -- Admin must have added 'state_container' class on field container 
                        if ($('.state_twx').parents('.state_container').length > 0)
                            $('.state_twx').parents('.state_container').css({display: 'initial'})
                    }
                }

                // State requirement management
                if (state_data.state_opt === 'required') $('.state_twx').attr('required', true)
                else $('.state_twx').attr('required', false)

                /**
                 * Countries influence on State title and ZIP code & city fields
                 * -- Admin must have added 'state_container' class on state field container
                 * -- Admin must have added 'city_container' class on city field container
                 * -- Admin must have added 'zip_container' class on zip code field container 
                 */                
                // Replace label and placeholder depending on state data on each request
                if ($('.state_twx').parents('.state_container').length > 0) {
                    let state_container = $('.state_twx').parents('.state_container')
                    
                    // If label, replace label
                    if (state_container.find('label').length > 0) {
                        let label_state
                        if (state_data.state_opt === 'required')
                            label_state = state_data.state_title +' '+ required
                        else label_state = state_data.state_title +' '+ optional
                        state_container.find('label').html(label_state)

                        if ($('.state_twx').is('select'))
                            $('.state_twx').attr('placeholder', state_data.state_placeholder)

                    }
                    // Else replace placeholder
                    else {
                        let placeholder_state
                        if (state_data.state_opt === 'required')
                            placeholder_state = state_data.state_title + ' *'
                        else placeholder_state = state_data.state_title + ' ' + optional

                        $('.state_twx').attr('placeholder', placeholder_state)
                    }
                }

                // Case city
                if (typeof city_container !== 'undefined' && city_container !== false) {

                    // If city field is optional or unused
                    if (state_data.city_opt === 'option')
                        city_container.find('input').attr('required', false)
                    else city_container.find('input').attr('required', true)

                    // City field title can be different than default
                    // Just overwrite ZIP code field title on each request

                    // If label, replace label
                    if (city_container.find('label').length) {
                        let label_city
                        if (city_container.find('label')) label_city = state_data.city +' '+ required
                        else label_city = state_data.city +' '+ optional
                        city_container.find('label').html(label_city)

                        city_container.find('input').attr('placeholder', '')
                    }
                    // Else replace placeholder
                    else {
                        let placeholder_city
                        if (city_container.find('input').prop('required'))
                            placeholder_city = state_data.city + ' *'
                        else placeholder_city = state_data.city + ' ' + optional

                        city_container.find('input').attr('placeholder', placeholder_city)
                    }
                }

                // Case ZIP
                if (typeof zip_container !== 'undefined' && zip_container !== false) {

                    // If ZIP code is optional or unused
                    if (state_data.zip_opt === 'none') {
                        zip_container.css({display: 'none'}).find('input').attr('required', false)
                        zip_container.find('label .required').css({display: 'none'})
                    } else if (state_data.zip_opt === 'option') {
                        zip_container.css({display: 'initial'}).find('input').attr('required', false)
                        zip_container.find('label .required').css({display: 'none'})
                    } else {
                        zip_container.css({display: 'initial'}).find('input').attr('required', true)
                        zip_container.find('label .required').css({display: 'initial'})
                    }

                    // ZIP code field title can be different than default
                    // Just overwrite ZIP code field title on each request

                    // If label, replace label
                    if (zip_container.find('label').length > 0) {                                
                        let label_zip

                        if (zip_container.find('input').prop('required'))
                            label_zip = state_data.zip_title +' '+ required
                        else label_zip = state_data.zip_title +' '+ optional
                        zip_container.find('label').html(label_zip)

                        zip_container.find('input').attr('placeholder', '')
                    }
                    // Else replace placeholder
                    else {                                
                        let placeholder_zip

                        if (zip_container.find('input').prop('required'))
                            placeholder_zip = state_data.zip_title + ' *'
                        else placeholder_zip = state_data.zip_title + ' ' + optional

                        zip_container.find('input').attr('placeholder', placeholder_zip)
                    }
                }

            }
        }
    })
}

jQuery(function($){
    
    // If state_twx form-tag is used
    if ($('.wpcf7[role="form"] .state_twx').length > 0 ) {
        
        $('select.country_twx').change(function(){
            setState($, $(this).val())
        })        
    }
    
})
