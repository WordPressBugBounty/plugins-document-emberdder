<?php

use PPV\Helper\Functions;

if (class_exists('CSF')) {

    // Set a unique slug-like ID
    $prefix = 'ppv';
    $is_pro = false;
  

    // Create a metabox
    CSF::createMetabox($prefix, array(
      'title'     => __('Document Configuration', 'ppv'),
      'post_type' => 'ppt_viewer',
    ));



    // Create a section
    CSF::createSection($prefix, array(
      'title'  => '',
      'fields' => array(
        [
            'id'    => 'doc',
            'type'  => 'upload',
            'title' => esc_html__('Document File', 'ppv'),
            'attributes' => array('id' => 'picker_field'),
            'desc' => '<p style="margin-top:8px; font-size:13px; color:#6b7280; line-height:1.6;">
                <strong style="color:#111827;">Supported Files:</strong> 
                pdf, doc, docx, ppt, pptx, txt, rtf, csv, odt, ods, odp.
            </p>',
        ],
        // Functions::ppv_lock_field([
        //     'id' => 'googleDrive',
        //     'type' => 'switcher',
        //     'title' => Functions::ppv_pro_title(esc_html__("I want to use Google Drive File", 'ppv')),
        // ]), 
        [
            'id' => 'width',
            'type' => 'dimensions',
            'title' => esc_html__('Width', 'ppv'),
            'height' => false,
            'default' => ['width' => '100', 'unit' => '%']
        ],
        [
          'id' => 'height',
          'type' => 'dimensions',
          'title' => esc_html__('Height', 'ppv'),
          'width' => false,
          'default' => ['height' => 600, 'unit' => 'px']
        ],
        [
          'id' => 'showName',
          'type' => 'switcher',
          'title' => esc_html__('Display File Name at the Top', 'ppv'),       
          'desc' => 'Not available for Google Drive and Dropbox',
          'default' => 0
        ],
        [     
          'id' => 'download',
          'type' => 'switcher',
          'title' => esc_html__('Show Download Button', 'ppv'),
          'desc' => esc_html__('Not available for Google Drive and Dropbox', 'ppv'),
          'default' => false
        ],
            Functions::ppv_lock_field([     
                'id' => 'downloadButtonText',
                'type' => 'text',
                'title' => Functions::ppv_pro_title(esc_html__("Download Button Text", "ppv")),
                'default' => "Download File",
                'dependency' => ['download', '==', 'true'],
            ]),
            Functions::ppv_lock_field([     
                'id' => 'disablePopout',
                'type' => 'switcher',
                'title' => Functions::ppv_pro_title(esc_html__('Disable Popout', 'ppv')),
                'desc' => esc_html__('Only available for google drive', 'ppv'),
                'default' => false
            ]),
            Functions::ppv_lock_field([     
                'id' => 'loading_icon',
                'type' => 'switcher',
                'title' => Functions::ppv_pro_title(esc_html__("Enable Loading Icon", "ppv")),    
                'default' => false
            ]),
            Functions::ppv_lock_field([     
                'id' => 'lightbox',
                'type' => 'switcher',
                'title' => Functions::ppv_pro_title(esc_html__("Enable Lightbox", "ppv")),
            ]),
            Functions::ppv_lock_field([         
                'id' => 'lightbox_btn_text',
                'type' => 'text',
                'title' => Functions::ppv_pro_title(esc_html__("Button Text", "ppv")),          
                'default' => 'View Document',
                'dependency' => ['lightbox', '==', '1']
            ]),
            Functions::ppv_lock_field([         
                'id' => 'lightbox_btn_color',
                'type' => 'color',
                'title' => Functions::ppv_pro_title(esc_html__("Button Text Color", "ppv")),
                'default' => '#fff',
                'dependency' => ['lightbox', '==', 1]
    
            ]),
            Functions::ppv_lock_field([         
                'id' => 'lightbox_btn_background',
                'type' => 'color',
                'title' => Functions::ppv_pro_title(esc_html__("Lightbox Button Background", "ppv")),
                'default' => '#333',
                'dependency' => ['lightbox', '==', 1]
            ]),
            Functions::ppv_lock_field([           
                'id' => 'lightbox_btn_size',
                'type' => 'button_set',
                'title' => Functions::ppv_pro_title(esc_html__("Button Size", "ppv")),
                'options' => [
                    'small' => esc_html__('Small', 'ppv'),
                    'medium' => esc_html__('Medium', 'ppv'),
                    'large' => esc_html__('Large', 'ppv'),
                    'extra-large' => esc_html__('Extra Large', 'ppv')
                ],
                'dependency' => ['lightbox', '==', 1],
                'default' => 'medium'
            ]),

      )
    ));
}
