<?php
/*
Plugin Name: AE System Info
Plugin URI: https://alternative.ne.jp/wordpress-plugins/ae-system-info/
Description: Displays server environment details in the WordPress admin dashboard.
Version: 1.0.0
Author: Your Name
Author URI: https://alternative.ne.jp
License: Apache License 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0
Text Domain: ae-system-info
Domain Path: /languages
*/
if (!defined('ABSPATH')) {
    exit;
}
// セッションの開始
add_action('init',function() {
    if (!session_id()) session_start();
});

// テキストドメインの読み込み
function ae_system_info_load_textdomain() {
    load_plugin_textdomain('ae-system-info', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'ae_system_info_load_textdomain');

// フックして管理画面にメニューを追加
add_action('admin_menu', 'ae_system_info_menu');

function ae_system_info_menu() {
    add_menu_page(
        __('System Info', 'ae-system-info'),
        __('System Info', 'ae-system-info'),
        'manage_options',
        'ae-system-info',
        'ae_system_info_page'
    );
}

function ae_system_info_page() {
	$php_version = phpversion();
	$latest_php_version = get_latest_php_version();
    $mysql_version = $GLOBALS['wpdb']->db_version();
    $db_name = DB_NAME;
    $wp_version = get_bloginfo('version');
    $server_software = $_SERVER['SERVER_SOFTWARE'];
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
    $cookies = $_COOKIE;
    $session = isset($_SESSION) ? $_SESSION : array();

	include(plugin_dir_path(__FILE__) . 'templates/admin-page.php');
}

function ae_system_info_enqueue_scripts($hook) {
    if ($hook != 'toplevel_page_ae-system-info') return;

    $manifest_path = plugin_dir_path(__FILE__) . 'dist/.vite/manifest.json';
    if (file_exists($manifest_path)) {
        $manifest = json_decode(file_get_contents($manifest_path), true);
        $main_js = $manifest['src/main.js']['file'];

        wp_enqueue_script(
            'ae-system-info-script',
            plugins_url('dist/' . $main_js, __FILE__),
            array(),
            null,
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'ae_system_info_enqueue_scripts');

function get_latest_php_version() {
    $url = 'https://www.php.net/releases/?json&version=7';
    $response = file_get_contents($url);
    if ($response === FALSE) {
        return __('Could not retrieve version', 'ae-system-info');
    }

    $data = json_decode($response, true);
    if (isset($data['version'])) {
        return $data['version'];
    } else {
        return __('Could not retrieve version', 'ae-system-info');
    }
}
