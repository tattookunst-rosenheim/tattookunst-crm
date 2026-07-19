<?php

if (!defined('ABSPATH')) {
    exit;
}

class Tattookunst_CRM_Loader {

    public static function init() {

        require_once dirname(__FILE__) . '/../admin/class-admin-menu.php';
        require_once dirname(__FILE__) . '/class-tattoo-request.php';
        require_once dirname(__FILE__) . '/class-piercing-booking.php';

        Tattookunst_CRM_Admin_Menu::init();
        TattooRequest::init();
        PiercingBooking::init();
    }
}
