<?php

return array(

    'name' => 'widget/dinamicmodelos',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'dinamicmodelos',
        'label' => 'dinamicmodelos',
        'core'  => true,
        'icon'  => 'plugins/widgets/dinamicmodelos/widget.svg',
        'view'  => 'plugins/widgets/dinamicmodelos/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'settings' => array(
            'grid'              => 'default',
            'gutter'            => 'default',
            'gutter_dynamic'    => '20',
            'gutter_v_dynamic'  => '',
            'filter'            => 'none',
            'filter_align'      => 'left',
            'filter_all'        => true,
            'columns'           => '1',
            'columns_small'     => 0,
            'columns_medium'    => 0,
            'columns_large'     => 0,
            'columns_xlarge'    => 0,
            'panel'             => 'blank',
            'panel_link'        => false,
            'animation'         => 'none',

            'media'             => true,
            'image_width'       => 'auto',
            'image_height'      => 'auto',
            'media_align'       => 'teaser',
            'media_width'       => '1-2',
            'media_breakpoint'  => 'medium',
            'content_align'     => true,
            'media_border'      => 'none',
            'media_overlay'     => 'icon',
            'overlay_animation' => 'fade',
            'media_animation'   => 'scale',

            'title'             => true,
            'content'           => true,
            'social_buttons'    => true,
            'title_size'        => 'panel',
            'text_align'        => 'left',
            'link'              => true,
            'link_style'        => 'button',
            'link_text'         => 'Read more',
            'badge'             => true,
            'badge_style'       => 'badge',
            'badge_position'    => 'panel',

            'link_target'       => false,
            'class'             => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {
            $app['scripts']->add('uikit-grid', 'vendor/assets/uikit/js/components/grid.min.js', array('uikit'));
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('dinamicmodelos.edit', 'plugins/widgets/dinamicmodelos/views/edit.php', true);
        }

    )

);
