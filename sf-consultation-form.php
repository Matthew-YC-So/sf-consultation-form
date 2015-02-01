<?php
/**
 * Plugin Name: SF Consultation Form
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Consultation Form.  Enter [sf_consultantion_form] on any page to display the Personal Consultation form.
 * Version: 1.0.0
 * Author: Matthew So
 * Created: 2015-02-01
 * Modified: 2015-02-01 Matthew So
 * Author URI: http://www.software-force.com
 * Text Domain: sf-consultation-form-td
 * Domain Path: /locale/
 * Network: true
 * License: GPL2
 */

 function translation($params){
    $echo_information = !empty($params['echo_information']) ? $params['echo_information'] : '' ;
	
	$forms_titles = array( 'public-consultation' => __('諮詢表格'), 'private-consultation' => __('私人諮詢表格'), 'eight-diagrams' => __('八字諮詢表格')) ;
    $form_title = $forms_titles[$params['form_name']] ;

    $sex_male = isset( $_POST["ef-sex"] ) && $_POST["ef-sex"] == "male" ? "checked=\"checked\"" : "";
    $sex_female = isset( $_POST["ef-sex"] ) && $_POST["ef-sex"] == "female" ? "checked=\"checked\"" : "";
    $sex = isset( $_POST["ef-sex"] ) ? $_POST["ef-sex"] : '';

    $hint_name = __('你的名字', 'sf-consultation-form-td');
    $hint_pername = __('名字', 'sf-consultation-form-td');
    $hint_relation = __('關係', 'sf-consultation-form-td');
    $hint_tel = __('你的聯絡電話', 'sf-simple-contact-form');
    $hint_email = __('你的電郵地址', 'sf-consultation-form-td');
    $hint_tel = __('你的聯絡電話', 'sf-consultation-form-td');
    $hint_web = __('你的個人網址', 'sf-consultation-form-td');
    $hint_subject = __('今次聯絡主題', 'sf-consultation-form-td');
    $hint_message = __('今次聯絡內容', 'sf-consultation-form-td');
    $label_birthday_name_relation = __('出生日期/名字/關係', 'sf-consultation-form-td');

    $label_name = __('姓名', 'sf-consultation-form-td');
    $label_sex = __('性別', 'sf-consultation-form-td');
    $label_sex_female = __('女', 'sf-consultation-form-td');
    $label_sex_male = __('男', 'sf-consultation-form-td');
	$sex_text_value = $sex != '' ? ($sex === 'male' ? $label_sex_male : $label_sex_female) : '' ; 
    $label_tel = __('電話', 'sf-simple-contact-form');
    $label_email = __('Email 電郵', 'sf-consultation-form-td');
    $label_subject = __('主題', 'sf-consultation-form-td');
    $label_web = __('網址', 'sf-consultation-form-td');
    $label_message = __('問題', 'sf-consultation-form-td');
	$label_complementary_message = __('補充說明 (如需要)', 'sf-consultation-form-td');
	$label_complementary_message_email = __('補充說明', 'sf-consultation-form-td');
    $label_undisclose = __('不可公開', 'sf-consultation-form-td');
    $label_birthdates = $params['form_name'] === 'eight-diagrams' ? __('本人的生辰八字（西元出生年、月、日 及 時)', 'sf-consultation-form-td') : __('本人,對方及第三者(如有)的生辰八字（西元出生年、月、日 及 時)', 'sf-consultation-form-td');
    $label_mybirthdate = $params['form_name'] === 'eight-diagrams' ? '' : __('本人(*)', 'sf-consultation-form-td');
    $label_targetbirthdate = __('對方', 'sf-consultation-form-td');
    $label_intruderbirthdate = __('第三者', 'sf-consultation-form-td');
    $please_select_year = __('年', 'sf-consultation-form-td');
    $please_select_month = __('月', 'sf-consultation-form-td');
    $please_select_day = __('日', 'sf-consultation-form-td');
    $please_select_hour = __('時', 'sf-consultation-form-td');
    $unkown_select = __('不清楚', 'sf-consultation-form-td');
    $required = __('請填寫資料');
    $label_mandatory  = __('* 為必填欄位', 'sf-consultation-form-td');
    $submit = __('傳送', 'sf-consultation-form-td');
 
    $name = isset( $_POST["ef-name"] ) ? esc_attr( $_POST["ef-name"] ) : '' ;
    $targetname = isset( $_POST["ef-targetname"] ) ? esc_attr( $_POST["ef-targetname"] ) : '' ;
    $intrudername = isset( $_POST["ef-intrudername"] ) ? esc_attr( $_POST["ef-intrudername"] ) : '' ;
    $targetrelate = isset( $_POST["ef-targetrelate"] ) ? esc_attr( $_POST["ef-targetrelate"] ) : '' ;
    $intruderrelate = isset( $_POST["ef-intruderrelate"] ) ? esc_attr( $_POST["ef-intruderrelate"] ) : '' ;
    $email = isset( $_POST["ef-email"] ) ? esc_attr( $_POST["ef-email"] ) : '' ;
    $tel = isset( $_POST["ef-tel"] ) ? esc_attr( $_POST["ef-tel"] ) : '' ;
    $web = isset( $_POST["ef-web"] ) ? esc_attr( $_POST["ef-web"] ) : '' ;
    $message = isset( $_POST["ef-message"] ) ? esc_attr( $_POST["ef-message"] ) : '' ;
	$complementary_message = isset( $_POST["ef-complementary-message"] ) ? esc_attr( $_POST["ef-complementary-message"] ) : '' ;

	if ($params['form_name'] === 'eight-diagrams')  
		$subject = __('八字諮詢') ;
	else
		$subject = isset( $_POST["ef-subject"] ) ? esc_attr( $_POST["ef-subject"] ) : '' ;
    
    if($params['form_name'] != 'public-consultation') {
        $undisclose_human_text ='N/A';
        $undisclose = 'checked="checked"';
    }
    else {
        $undisclose_bool = isset( $_POST["ef-undisclose"] ) ? filter_var($_POST["ef-undisclose"], FILTER_VALIDATE_BOOLEAN) : FALSE;
        $undisclose = $undisclose_bool ? 'checked="checked"'  : '' ;
        $undisclose_human_text = $undisclose_bool ? __('不公開')  : __('可公開') ;
    }

    $channels = array('skype' => 'Skype' , 'fbmessager' => 'Facebook Messenger' ,'line' => 'Line');
    $channels_human_text = '';
    foreach ($channels as $channel => $channel_text) {
        ${'channel_'.$channel.'_bool'} = isset( $_POST['ef-channel-'.$channel] ) ? filter_var($_POST['ef-channel-'.$channel], FILTER_VALIDATE_BOOLEAN) : FALSE;
        ${'channel_'.$channel} = ${'channel_'.$channel.'_bool'} ? 'checked="checked"'  : '' ;
        $channels_human_text = $channels_human_text . (${'channel_'.$channel.'_bool'} ? ($channels_human_text === '' ? '' : '<br />' ) . $channel_text : '') ;  
    }

    $bookdays = array('1' => __('星期一', 'sf-consultation-form-td'), '2' => __('星期二', 'sf-consultation-form-td'), '3' => __('星期三', 'sf-consultation-form-td'), '4' => __('星期四', 'sf-consultation-form-td'), '5' => __('星期五', 'sf-consultation-form-td'));
    $times = array('am' => __('上午', 'sf-consultation-form-td'), 'pm' => __('下午', 'sf-consultation-form-td'));
    $bookdays_human_text = '';
    foreach ($bookdays as $dk => $dv) {
        foreach($times as $tk => $tv) {
            ${'bookd' . $dk . $tk .'_bool'} = isset( $_POST['ef-bookd'. $dk . $tk] ) ? filter_var($_POST['ef-bookd'. $dk . $tk], FILTER_VALIDATE_BOOLEAN) : FALSE;
            ${'bookd' . $dk . $tk } = ${'bookd' . $dk . $tk .'_bool'} ? 'checked="checked"'  : '' ;
            $bookdays_human_text = $bookdays_human_text . (${'bookd' . $dk . $tk .'_bool'} ?  ($bookdays_human_text === '' ? '' : '<br />' ).$dv.' '.$tv : '' );
        }
    }

    $extrademand_otherinput = isset( $_POST['ef-extrademand-otherinput'])  ? esc_attr($_POST['ef-extrademand-otherinput']) : '';
    $extrademands = array('extsession' => __('廷長每次諮詢時段'), 'voicemsg' => __('以語音訊息進行諮詢'), 'other' => __('其他') . ' ' . $extrademand_otherinput  );
    $extrademands_human_text = '';
    foreach ($extrademands as $extrademand => $extrademand_text) {
        ${'extrademand_'.$extrademand.'_bool'} = isset( $_POST['ef-extrademand-'.$extrademand] ) ? filter_var($_POST['ef-extrademand-'.$extrademand], FILTER_VALIDATE_BOOLEAN) : FALSE;
        ${'extrademand_'.$extrademand} = ${'extrademand_'.$extrademand.'_bool'} ? 'checked="checked"'  : '' ;
        $extrademands_human_text = $extrademands_human_text . (${'extrademand_'.$extrademand.'_bool'} ? ($extrademands_human_text === '' ? '' : '<br />' ) . $extrademand_text : '') ;  
    }

	$focus_otherinput = !empty($_POST['ef-focus-otherinput']) ? esc_attr($_POST['ef-focus-otherinput']) : '';
    $focuss = array('study' => __('學業') , 'health' => __('健康') ,'marriage' => __('姻緣/婚姻'), 'fortune' => __('財富'), 'fame' => __('名聲地位'), 'other' => __('其他') . ' ' . $focus_otherinput ) ;
    $focus_human_text = '';
    foreach ($focuss as $focus => $focus_text) {
        ${'focus_'.$focus.'_bool'} = isset( $_POST['ef-focus-'.$focus] ) ? filter_var($_POST['ef-focus-'.$focus], FILTER_VALIDATE_BOOLEAN) : FALSE;
        ${'focus_'.$focus} = ${'focus_'.$focus.'_bool'} ? 'checked="checked"'  : '' ;
        $focus_human_text = $focus_human_text . (${'focus_'.$focus.'_bool'} ? ($focus_human_text === '' ? '' : '<br />' ) . $focus_text : '') ;  
    }		

    // Options 
    $earliest_year = 1900;
    $people = array("my", "target", "intruder"); 
    $unkown_select_option = "<option value='999999'>$unkown_select</option>";

    foreach ($people as $who) {
        ${$who."_already_selected_year"} =  isset( $_POST["ef-{$who}birthyear"] ) ? $_POST["ef-{$who}birthyear"] : '' ;
        ${$who."_already_selected_month"} =  isset( $_POST["ef-{$who}birthmonth"] ) ? $_POST["ef-{$who}birthmonth"] : '' ;
        ${$who."_already_selected_day"} =  isset( $_POST["ef-{$who}birthday"] ) ? $_POST["ef-{$who}birthday"] : '' ;
        ${$who."_already_selected_hour"} =  !empty( $_POST["ef-{$who}birthhour"] ) ? (int)$_POST["ef-{$who}birthhour"] : '' ;

        ${$who."_year_options"} = "<option value=''>$please_select_year</option>";
        foreach (range(date('Y'), $earliest_year) as $x) {
          ${$who."_year_options"} = ${$who."_year_options"}.'<option value="'.$x.'"'.($x == ${$who."_already_selected_year"} ? ' selected="selected"' : '').'>'.$x.'</option>';
        }
        ${$who."_year_options"} = ${$who."_year_options"}.$unkown_select_option;

        ${$who."_month_options"} = "<option value=''>$please_select_month</option>";
        foreach (range(1, 12) as $x) {
          ${$who."_month_options"} = ${$who."_month_options"}.'<option value="'.$x.'"'.($x == ${$who."_already_selected_month"} ? ' selected="selected"' : '').'>'.$x.'</option>';
        }
        ${$who."_month_options"} = ${$who."_month_options"}.$unkown_select_option;

        ${$who."_day_options"} = "<option value=''>$please_select_day</option>";
        foreach (range(1, 31) as $x) {
          ${$who."_day_options"} = ${$who."_day_options"}.'<option value="'.$x.'"'.($x == ${$who."_already_selected_day"} ? ' selected="selected"' : '').'>'.$x.'</option>';
        }
        ${$who."_day_options"} = ${$who."_day_options"}.$unkown_select_option;

        ${$who."_hour_options"} = "<option value=''>$please_select_hour</option>";
        foreach (range(0, 23) as $x) {
          ${$who."_hour_options"} = ${$who."_hour_options"}.'<option value="'.$x.'"'.($x === ${$who."_already_selected_hour"} ? ' selected="selected"' : '').'>'.$x.':00</option>';
        }
        ${$who."_hour_options"} = ${$who."_hour_options"}.$unkown_select_option;
    }

    return array(
        '$form_title' => $form_title,
        '$label_name' => $label_name,
        '$label_sex' => $label_sex,
        '$label_sex_female' => $label_sex_female,
        '$label_sex_male' => $label_sex_male,
        '$label_email' => $label_email,
        '$label_tel' => $label_tel,
        '$label_subject' => $label_subject,
        '$label_web' => $label_web,
        '$label_message' => $label_message,
		'$label_complementary_message' => $label_complementary_message,
		'$label_complementary_message_email' => $label_complementary_message_email,
        '$label_undisclose' => $label_undisclose,
        '$label_birthdates' => $label_birthdates,
        '$label_mybirthdate' => $label_mybirthdate,
        '$label_targetbirthdate' => $label_targetbirthdate,
        '$label_intruderbirthdate' => $label_intruderbirthdate,
        '$email_label_mybirthdate' => __('我的出生日期'),
        '$email_label_targetbirthdate' => $label_targetbirthdate,
        '$email_label_intruderbirthdate' => $label_intruderbirthdate,

		'$label_astrology_focus' => __('關注方面'),
		
		'$label_focus_study' => __('學業'),
		'$label_focus_health' => __('健康'),
		'$label_focus_marriage' => __('姻緣/婚姻'),
		'$label_focus_fortune' => __('財富'),
		'$label_focus_fame' => __('名聲地位'),
		'$label_focus_other' => __('其他:'),
		'$hint_otherinput' => __('請註明'),
		'$focus_otherinput' => $focus_otherinput,
		
        '$my_year_options' => $my_year_options,
        '$my_month_options' => $my_month_options,
        '$my_day_options' => $my_day_options,
        '$my_hour_options' => $my_hour_options,
        '$target_year_options' => $target_year_options,
        '$target_month_options' => $target_month_options,
        '$target_day_options' => $target_day_options,
        '$target_hour_options' => $target_hour_options,
        '$intruder_year_options' => $intruder_year_options,
        '$intruder_month_options' => $intruder_month_options,
        '$intruder_day_options' => $intruder_day_options,
        '$intruder_hour_options' => $intruder_hour_options,
        '$please_select_year' => $please_select_year ,
        '$please_select_month' => $please_select_month ,
        '$please_select_day' => $please_select_day ,
        '$please_select_hour' => $please_select_hour ,
        '$name' => $name,
        '$targetname' => $targetname,
        '$intrudername' => $intrudername,
        '$targetrelate' => $targetrelate,
        '$intruderrelate' => $intruderrelate,
        '$sex_male' => $sex_male,
        '$sex_female' => $sex_female,
        '$sex' => $sex,
		'$sex_text_value' => $sex_text_value,
        '$email' => $email,
        '$tel' => $tel,
        '$subject' => $subject,
        '$web' => $web,
        '$message' => $message,
        '$undisclose' => $undisclose,
        '$undisclose_human_text' => $undisclose_human_text,
		'$complementary_message' => $complementary_message,
        '$hint_name' => $hint_name,
        '$hint_pername' => $hint_pername,
        '$hint_relation' => $hint_relation,
        '$hint_email' => $hint_email,
        '$hint_subject' => $hint_subject,
        '$hint_web' => $hint_web,
        '$hint_tel' => $hint_tel,
        '$hint_message' => $hint_message,
        '$required' => $required,
        '$label_mandatory' => $label_mandatory,
        '$action' => esc_url( $_SERVER['REQUEST_URI'] ),
        '$information' => $echo_information  != '' ?  '<div>' . $echo_information  . '</div>' : '',
        '$label_birthday_name_relation' => $label_birthday_name_relation,
        '$label_channels' => __('請選擇你偏好的線上諮詢模式'),
        '$label_channel_skype' => __('Skype'),
        '$label_channel_fbmessager' => __('Facebook Messenger'),
        '$label_channel_line' => __('Line'),
        '$label_extrademands' =>  __('特別要求'),
        '$label_extrademand_extsession' => __('延長每次諮詢時段至75分鐘(需額外支付諮詢費 HK$250)'),
        '$label_extrademand_voicemsg' => __('以語音訊息進行諮詢'),
        '$label_extrademand_other' => __('其他:'),
        '$channel_skype' => $channel_skype,
        '$channel_fbmessager' => $channel_fbmessager,
        '$channel_line' => $channel_line,
        '$channels_human_text' => $channels_human_text,
        '$bookd1am' => $bookd1am, '$bookd2am' => $bookd2am, '$bookd3am' => $bookd3am,  '$bookd4am' => $bookd4am, '$bookd5am' => $bookd5am,
        '$bookd1pm' => $bookd1pm, '$bookd2pm' => $bookd2pm, '$bookd3pm' => $bookd3pm,  '$bookd4pm' => $bookd4pm, '$bookd5pm' => $bookd5pm,
        '$bookdays_human_text' => $bookdays_human_text,
        '$label_bookingdatetime' => __('請選擇你未來一個月內, 最方便的諮詢時段 (星期六、日不設諮詢), 我們會盡量配合, 作出安排'),
        '$submit'=> $submit,
        '$email_succeeded' => $params['form_name'] === 'eight-diagrams' ? __('感謝你使用八字諮詢服務！ 我們將盡快回覆你!', 'sf-consultation-form-td') :  __('感謝你使用「感情信箱」諮詢服務！ 我們將盡快回覆你!', 'sf-consultation-form-td'),
        '$incompleted_information' => __('以下資料不齊全'),
        '$email_label_channels' => __('線上諮詢模式'),
        '$email_label_days' => __('偏好日期'),
        '$extrademand_extsession' => $extrademand_extsession,
        '$extrademand_voicemsg' => $extrademand_voicemsg,
        '$extrademand_other' => $extrademand_other,
        '$extrademand_otherinput' => $extrademand_otherinput,
        '$extrademands_human_text' => $extrademands_human_text,
		'$focus_human_text' => $focus_human_text,
        );
 }
 
// form display
function sf_html_consultation_form_code($params) {
    
    $translations = translation($params);

    $html = file_get_contents(plugins_url( 'consultation.html' , __FILE__ ));
    
    // get anything between <body> and </body> where <body can="have_as many" attributes="as required">
    if (preg_match('/(?:<body[^>]*>)(.*)<\/body>/isU', $html, $matches)) {
        $html = $matches[1];
        
		foreach($params['form_names'] as $each_form) {
			// Remove other form's divs 
			if ($each_form === $params['form_name']) {
				$exlcuded_div_class = 'x-' . $each_form ;
				$html = preg_replace('/(?:<div[^>]+class=\"[^"]*' . $exlcuded_div_class .'[^"]*\"[^>]*>)(.*)<\/div>/isU', '', $html);
			}
		}
    }

    echo strtr($html, $translations);
}

/*  Send email */
function sf_html_consultation_form_deliver_mail(&$params) {
 
    if (isset( $_POST['ef-submitted'] )) {
        $mandatory_fields = $params['mandatory_fields']; 
        $missing_fields = [];
        $all_entered = TRUE;
        foreach($mandatory_fields as $key=>$value) {
            if (empty($_POST[$key]) ){
              $missing_fields[$key] = $value;
              $all_entered = FALSE;
            }
        }

        // if the submit button is clicked, send the email
        if ($all_entered) {
            $translations = translation($params);
            $date_format = '%1$04d-%2$02d-%3$02d %4$02d:00';
            $people = $params['form_name'] === 'eight-diagrams' ? array("my") : array("my", "target", "intruder"); 
            foreach ($people as $who) {
                ${$who."birthyear"} =  $_POST["ef-{$who}birthyear"] ;
                ${$who."birthmonth"} =  $_POST["ef-{$who}birthmonth"] ;
                ${$who."birthday"} =  $_POST["ef-{$who}birthday"] ;
                ${$who."birthhour"} =  $_POST["ef-{$who}birthhour"] ;
                ${$who."birth_date"} = sprintf($date_format , ${$who."birthyear"}, ${$who."birthmonth"}, ${$who."birthday"}, ${$who."birthhour"});
                ${$who."birth_date"} = str_replace("999999:00", "", ${$who."birth_date"});
                ${$who."birth_date"} = str_replace("999999", "", ${$who."birth_date"});
                ${$who."birth_date"} = str_replace("0000-00-00", "", ${$who."birth_date"});
                ${$who."birth_date"} = str_replace("00:00", "", ${$who."birth_date"});

                // Prfix with $ character
                $translations['$' . $who."birth_date"] = ${$who."birth_date"}; // Add to array 
            }

            $html = file_get_contents(plugins_url( 'email_template.html' , __FILE__ ));
    
            // get anything between <body> and </body> where <body can="have_as many" attributes="as required">
            if (preg_match('/(?:<body[^>]*>)(.*)<\/body>/isU', $html, $matches)) {
                $html = $matches[1];
				
				foreach($params['form_names'] as $each_form) {
					// Remove other form's divs 
					if ($each_form === $params['form_name']) {
						$exlcuded_div_class = 'x-' . $each_form ;
						$html = preg_replace('/(?:<tr[^>]+class=\"[^"]*' . $exlcuded_div_class .'[^"]*\"[^>]*>)(.*)<\/tr>/isU', '', $html);
					}
				}				
            }

            $body = strtr($html, $translations);
 
            // get the blog administrator's email address
            $to = get_option( 'admin_email' );
 
            $name = sanitize_text_field($translations['$name']);
            $email = sanitize_email($translations['$email']);
            $subject = sanitize_text_field($translations['$subject']);

            $headers = "From: $name <$email>" . "\r\n";
 
            // HTML body
            add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

            //var_dump($body);

            // If email has been process for sending, display a success message
            if ( wp_mail( $to, $subject, $body, $headers ) ) {
                
				$params['echo_information'] = $translations['$email_succeeded'] ;

                // Clear data
                foreach($_POST as $key=>$value)
                {
                    if (substr($key, 0, 3) === "ef-" ) {
                       $_POST[$key] = "";
                      //var_dump($key, $_POST[$key]) ;
                    }
                }
                
            } else {
                echo 'An unexpected error occurred ' . $GLOBALS['phpmailer']->ErrorInfo;
            }
        }
        else{
            $missing_fieldnames = '';
            foreach ($missing_fields as $key=>$value) {
              $missing_fieldnames = $missing_fieldnames.'<li>'.$value.'</li>' ;
            }
            $params['echo_information']  = "<div class='error'>" . $translations['$incompleted_information']  . "<ul>$missing_fieldnames</ul></div>";
        }
    }
}

/*  Hook up function */
function sf_cform_shortcode($atts) {

    // default to public enquiry 
    extract(shortcode_atts(array(
      'form_name' => 'public-consultation'
   ), $atts));
   
   $form_name = strtolower($form_name);
   
   $params = array( 'form_name' =>  $form_name, 'echo_information' => '', 'form_names' => array( 'public-consultation', 'private-consultation', 'eight-diagrams') );
   
	if ($form_name === 'eight-diagrams')
		$params['mandatory_fields'] = array('ef-name' => __('姓名'), 'ef-sex' => __('性別'), 'ef-email' => __('電郵')); 
	else
		$params['mandatory_fields'] = array('ef-name' => __('姓名'), 'ef-sex' => __('性別'), 'ef-email' => __('電郵'), 'ef-subject' => __('主題'), 'ef-message' => __('問題')); 

    ob_start();

    sf_html_consultation_form_deliver_mail($params);
	
    sf_html_consultation_form_code($params);
 
    return ob_get_clean();
}

/* Use [sf_consultantion_form] as hook up string */
add_shortcode( 'sf_consultantion_form', 'sf_cform_shortcode' );

/**
 * Register style sheet.
 */
function sf_html_consultation_form_register_plugin_styles() {
	wp_register_style( 'sf-consultation-form', plugins_url( 'stylesheets/style.css',  __FILE__) );
	wp_enqueue_style( 'sf-consultation-form' );
}
add_action( 'wp_enqueue_scripts', 'sf_html_consultation_form_register_plugin_styles' );

/**
 * Javascript
 */
function sf_html_consultation_form_scripts_method() {
	wp_enqueue_script(
		'sf-consultation-form-script',	plugins_url( 'js/sf-consultation-form.js' , __FILE__ ),
		array( 'jquery' ), false, true
	);  // $ver  = false, $in_footer = true
}
add_action( 'wp_enqueue_scripts', 'sf_html_consultation_form_scripts_method');

// Init plugin
function myplugin_init() {
 $plugin_dir = basename(dirname(__FILE__));
 // Load text domain
 load_plugin_textdomain( 'sf-consultation-form-td', false, $plugin_dir );
}
add_action('plugins_loaded', 'myplugin_init');


?>
