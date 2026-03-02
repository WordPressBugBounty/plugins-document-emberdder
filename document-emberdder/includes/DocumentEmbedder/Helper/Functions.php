<?php
namespace PPV\Helper;

class Functions{
    
    public static function meta($id, $key, $default = false){
        $meta = get_post_meta($id, 'ppv', true);
        if(isset($meta[$key])){
            return $meta[$key];
        }else {
            return $default;
        }
    }

    public static function ppv_lock_field( $field, $is_section = false ) {

        if ( de_fs()->can_use_premium_code() ) {
            return $field;
        }

        // Lock the UI
        $field['class'] = 'ppv-lock-field ' . ( $is_section ? 'section' : '' );

        // Force safe default (prevents DB pollution)
        if ( isset( $field['default'] ) ) {
            $field['value'] = $field['default'];
        }

        return $field;
    }

    public static function ppv_pro_title( $title ) {
        if ( de_fs()->can_use_premium_code() ) {
            return esc_html( $title );
        }

        return '
            <div class="ppv-field-title">
                <h4>' . esc_html( $title ) . '</h4>
                <span class="ppv-pro-badge">PRO</span>
            </div>
        ';
    }

    public static function upgrade_section() {
		return array(
            'type' => 'content',
            'content' => '<div class="bplde-metabox-upgrade-section">The Ultimate Document Embedder Plugin for WordPress, Loved by Over 10,000+ Users. <a class="button button-bplugins" href="' . admin_url('edit.php?post_type=ppt_viewer&page=document-emberdder-pricing') . '">Upgrade to PRO</a></div>'
		);
	}
}