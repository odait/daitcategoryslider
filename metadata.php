<?php

/**
 *    This file is part of the module daitcategoryslider for OXID.
 *
 *    The module daitcategoryslider is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module daitcategoryslider is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 * 
 *    @link        https://www.dalley-it.com
 *    @author      Oliver Dalley - Dalley IT, September 2017
 *    @version     V 1.0
 *
 *    @license     http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *    @copyright   (C) Oliver Dalley - Dalley IT 2017
 *
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';

/**
 * Module information
 */
$aModule = array(
    'id'            => 'daitcategoryslider',
    'title'         => 'DAIT - Slider für Kategorien',
    'description'   => 'Das Module erweitert die Aktionen Verwaltung um das Element Kategorienslide. Das neue Element entspricht den Bannerelementen, kann aber zusätzlich einer Kategorie zugeordnet werden. Sind Kategorienslides einer Kategorie zugeordnet, so werden diese oberhalb des Kategorienbildes als Slider angezeigt. Von Funktion und Layout entspricht der Kategorienslider dem Slider der Startseite des OXID Flow Themes.',
    'thumbnail'     => 'dait.png',
    'version'       => '1.0',
    'author'        => 'Dalley IT',
    'url'           => 'http://www.dalley-it.com',
    'email'         => 'info@dalley-it.com',
    'extend'        => array(
                        'oxviewconfig'                      => 'dait/daitcategoryslider/extend/core/dait_catslideroxviewconfig',
                        'actions_main'                      => 'dait/daitcategoryslider/extend/application/controllers/admin/dait_actions_main',
                        'oxactions'                         => 'dait/daitcategoryslider/extend/application/models/dait_oxactions',
                        'oxactionlist'                      => 'dait/daitcategoryslider/extend/application/models/dait_oxactionlist',
	),
    'files'         => array(
                        'dait_action_category_ajax'         => 'dait/daitcategoryslider/application/controllers/admin/dait_action_category_ajax.php',
                        'dait_categoryslider_event'         => 'dait/daitcategoryslider/core/dait_categoryslider_event.php',
	),
    'blocks'        => array(
                        array(
                                'template'                  => 'page/list/list.tpl',
                                'block'                     => 'page_list_listhead',
                                'file'                      => 'application/views/blocks/page/list/dait_category_slider_list.tpl'
                        ),
                        array(
                                'template'                  => 'actions_list.tpl',
                                'block'                     => 'admin_actions_list_item',
                                'file'                      => 'application/views/admin/blocks/dait_actions_list.tpl'
                        ),
	),
    'templates'     => array(
                        // admin
                        'dait_actions_main.tpl'             => 'dait/daitcategoryslider/application/views/admin/tpl/dait_actions_main.tpl',
                        'dait_action_category.tpl'          => 'dait/daitcategoryslider/application/views/admin/tpl/popups/dait_action_category.tpl',
                        // widget
                        'dait_category_slider.tpl'          => 'dait/daitcategoryslider/application/views/tpl/widget/dait_category_slider.tpl',
    ),  
    
    'events'      => array(
                        'onActivate'                        => 'dait_categoryslider_event::onActivate',
    ),
);
