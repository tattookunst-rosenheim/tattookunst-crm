<?php
/**
 * Plugin Name: Tattookunst CRM
 * Plugin URI: https://tattoo-rosenheim.de
 * Description: CRM- und Terminverwaltung für Tattookunst Chris.
 * Version: 0.1.0
 * Author: Chris Häusler
 * License: GPL2
 */

require_once plugin_dir_path(__FILE__) . 'includes/class-loader.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-database.php';

register_activation_hook(
    __FILE__,
    ['Tattookunst_CRM_Database', 'create_tables']
);

Tattookunst_CRM_Loader::init();