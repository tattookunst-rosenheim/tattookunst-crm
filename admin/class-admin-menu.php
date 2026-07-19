<?php

if (!defined('ABSPATH')) {
    exit;
}

class Tattookunst_CRM_Admin_Menu {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'register_menu']);
    }

    public static function register_menu() {

        add_menu_page(
            'Tattookunst CRM',
            'Tattookunst CRM',
            'manage_options',
            'tattookunst-crm',
            [__CLASS__, 'dashboard'],
            'dashicons-calendar-alt',
            25
        );

        add_submenu_page(
            'tattookunst-crm',
            'Kunden',
            'Kunden',
            'manage_options',
            'tattookunst-crm-kunden',
            [__CLASS__, 'customers']
        );

        add_submenu_page(
            'tattookunst-crm',
            'Neuer Kunde',
            'Neuer Kunde',
            'manage_options',
            'tattookunst-crm-neuer-kunde',
            [__CLASS__, 'customer_form']
        );

        add_submenu_page(
            'tattookunst-crm',
            'Projekte',
            'Projekte',
            'manage_options',
            'tattookunst-crm-projekte',
            [__CLASS__, 'projects']
        );

        add_submenu_page(
    'tattookunst-crm',
    'Tattoo-Anfragen',
    'Tattoo-Anfragen',
    'manage_options',
    'tattookunst-crm-requests',
    [__CLASS__, 'requests']
);

add_submenu_page(
    null,
    'Tattoo-Anfrage öffnen',
    'Tattoo-Anfrage öffnen',
    'manage_options',
    'tattookunst-crm-request-edit',
    [__CLASS__, 'request_edit']
);

        add_submenu_page(
            'tattookunst-crm',
            'Neues Projekt',
            'Neues Projekt',
            'manage_options',
            'tattookunst-crm-neues-projekt',
            [__CLASS__, 'project_form']
        );
    }

    public static function dashboard() {
        require_once dirname(__FILE__) . '/../templates/dashboard.php';
    }

    public static function customers() {
        require_once dirname(__FILE__) . '/../templates/customers.php';
    }

    public static function customer_form() {
        require_once dirname(__FILE__) . '/../templates/customer-form.php';
    }

    public static function projects() {
        require_once dirname(__FILE__) . '/../templates/projects.php';
    }

    public static function requests() {
    require_once dirname(__FILE__) . '/../templates/requests.php';
}

public static function request_edit() {
    require_once dirname(__FILE__) . '/../templates/request-edit.php';
}

    public static function project_form() {
        require_once dirname(__FILE__) . '/../templates/project-form.php';
    }
}