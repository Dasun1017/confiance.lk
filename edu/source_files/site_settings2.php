<?php
//site settings
$actual_domain_without_http = "edu.confiance.lk";
$site_owner_name = 'Yamuna Chandrika';
$site_website_name = 'CONFIANCE Language Institute PVT LTD';
$site_whatsapp = '074 063 3337';
$site_mobile = ' 074 063 3337';

$site_host = 'localhost';
$site_user = 'shimo';
$site_pass = 'shimoNEW1';
$site_db = 'shimo';


$site_facebook = 'https://www.facebook.com/share/1CVMU62rHj/?mibextid=wwXIfr';
if ($site_facebook == '') {
        $site_facebook = '#';
}
$site_youtube = 'https://www.youtube.com/@ShimoGlobalpvt';
if ($site_youtube == '') {
        $site_youtube = '#';
}
$site_instagram = 'https://www.instagram.com/confiance.lk?igsh=MjN3Z2R3ZjcxMmk%3D&utm_source=qr';
if ($site_instagram == '') {
        $site_instagram = '#';
}
$site_whatsapp_call = 'https://wa.me/94760407677';
if ($site_whatsapp_call == '') {
        $site_whatsapp_call = '#';
}
$site_tiktok = 'https://www.tiktok.com/@confiancelk?_r=1&_t=ZS-982s8CiXqCb';
if ($site_tiktok == '') {
        $site_tiktok = '#';
}

$site_payhere = '';
if ($site_payhere == '') {
        $site_payhere = 'display:none';
} else {
        $site_payhere = '';
}
$site_payhere_merchant_id = '';
$site_payhere_hash = '';

$site_textit_username = '9420233008';
$site_textit_password = '4729';

$nav_bg_color = 'white';  //Navbar background color
$footer_bg_color = '#f9f9f9'; // footer background color
$login_body_color = 'white';  // login page body color 
$common_body_color = 'white'; // other pages login body color 
$btn_common_bg_color = '#d32727'; // main btn-common background color 
$btn_common_text_color = 'white'; // main btn-common text color 
$btn_common_hover_bg_color = "#dbdbdb"; // main-btn-common text hover color 
//   $html_background_color = "white"; html background color 
$drop_down_bg_color = "#d32727";  // drop down background for select_your_teacher and lecture.php  
$drop_down_sub_color = "#d32727";  // drop down text color for select_your_teacher and lecture.php 






$site_grades = '

                        <option>Sinhala</option> 
                        <option>Literture</option>';
//site settings

$site_additional_text = " - $site_website_name - $site_owner_name";
$site_meta_description = $site_title = "$actual_domain_without_http$site_additional_text";
$site_keywords = str_replace(' - ', ', ', $site_meta_description);
$site_info_mail_address = '' . $actual_domain_without_http;

echo '<style>
            .header-area { background-color: #eeddc1; } /*menu color*/
        </style>';


// header and footer 
$header_footer_colour = '#707a83';

$site_lecture_page_drop_down = '1';
$site_lecture_page_drop_down_opened = '';
