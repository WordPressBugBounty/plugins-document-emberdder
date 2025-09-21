<?php

function bplDeIsPremium() {
	return de_fs()->can_use_premium_code() || false;
}

if (!class_exists('BPLDEPlugin')) {

    class BPLDEPlugin {

    public function __construct() {
        add_action('init', [__CLASS__, 'init']);
        add_action( "enqueue_block_assets", [$this, "bplDeBlockAssets"]);

        add_action('wp_ajax_bplDePipeChecker', [$this, 'bplDePipeChecker']);
        add_action('wp_ajax_nopriv_bplDePipeChecker', [$this, 'bplDePipeChecker']);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('rest_api_init', [$this, 'registerSettings']);
    }

    public function bplDeBlockAssets() {
        wp_localize_script(
            "bpldl-document-library-editor-script",
            'bpldlData',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('bplde_nonce')
            ]
        );
        wp_localize_script(
            "bpldl-document-library-view-script",
            'bpldlData',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('bplde_nonce')
            ]
        );
    }

    function bplDePipeChecker() {
        $nonce = $_POST['_wpnonce'] ?? null;
        
        if (!wp_verify_nonce($nonce, 'wp_ajax')) {
            wp_send_json_error('Invalid Request');
        }

        wp_send_json_success([
            'isPipe' => bplDeIsPremium()
        ]);
	}

    function registerSettings() {
        register_setting('bplDeUtils', 'bplDeUtils', [
            'show_in_rest' => [
                'name' => 'bplDeUtils',
                'schema' => ['type' => 'string']
            ],
            'type' => 'string',
            'default' => wp_json_encode(['nonce' => wp_create_nonce('wp_ajax')]),
            'sanitize_callback' => 'sanitize_text_field'
        ]);
    }

    public static function init() {
        register_block_type(__DIR__ . '/build/blocks/document-library');
        wp_set_script_translations('document-embedder', 'document-library', plugin_dir_path(__FILE__) . 'languages');
    }
    }
    new BPLDEPlugin();
}