<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2016 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$themedef = array(
    'name' => 'Suite P',
    'description' => 'SuiteCRM Responsive Theme',
    'version' => array(
        'regex_matches' => array('6\.*.*'),
    ),
    'group_tabs' => true,
    'classic' => true,
    'configurable' => true,
    'config_options' => array(

        'display_sidebar' => array(
            'vname' => 'LBL_DISPLAY_SIDEBAR',
            'type' => 'bool',
            'default' => true,
        ),

        'color_1' => array(
            'vname' => 'LBL_COLOUR_SUITEP_1',
            'type' => 'colour',
            'default' => 'f5f5f5'
        ),

        'color_2' => array(
            'vname' => 'LBL_COLOUR_SUITEP_2',
            'type' => 'colour',
            'default' => '#534D64'
        ),

        'color_3' => array(
            'vname' => 'LBL_COLOUR_SUITEP_3',
            'type' => 'colour',
            'default' => '#E6E6E6'
        ),


        'color_4' => array(
            'vname' => 'LBL_COLOUR_SUITEP_4',
            'type' => 'colour',
            'default' => '#C4C3C7'
        ),


        'color_5' => array(
            'vname' => 'LBL_COLOUR_SUITEP_5',
            'type' => 'colour',
            'default' => '#ffffff'
        ),


        'color_6' => array(
            'vname' => 'LBL_COLOUR_SUITEP_6',
            'type' => 'colour',
            'default' => '#f08377'
        ),


        'color_7' => array(
            'vname' => 'LBL_COLOUR_SUITEP_7',
            'type' => 'colour',
            'default' => '#D66C60'
        ),


        'color_8' => array(
            'vname' => 'LBL_COLOUR_SUITEP_8',
            'type' => 'colour',
            'default' => '#66727d'
        ),


        'color_9' => array(
            'vname' => 'LBL_COLOUR_SUITEP_9',
            'type' => 'colour',
            'default' => '#BFCAD3'
        ),


        'color_10' => array(
            'vname' => 'LBL_COLOUR_SUITEP_10',
            'type' => 'colour',
            'default' => '#94A6B5'
        ),


        'color_11' => array(
            'vname' => 'LBL_COLOUR_SUITEP_11',
            'type' => 'colour',
            'default' => '#778591'
        ),


        'color_12' => array(
            'vname' => 'LBL_COLOUR_SUITEP_12',
            'type' => 'colour',
            'default' => '#8499AB'
        ),


        'color_13' => array(
            'vname' => 'LBL_COLOUR_SUITEP_13',
            'type' => 'colour',
            'default' => '#677785'
        ),


        'color_14' => array(
            'vname' => 'LBL_COLOUR_SUITEP_14',
            'type' => 'colour',
            'default' => '#4D4D4D'
        ),


        'color_15' => array(
            'vname' => 'LBL_COLOUR_SUITEP_15',
            'type' => 'colour',
            'default' => '#000000'
        ),


        'color_16' => array(
            'vname' => 'LBL_COLOUR_SUITEP_16',
            'type' => 'colour',
            'default' => '#c0c0c0'
        ),


        'color_17' => array(
            'vname' => 'LBL_COLOUR_SUITEP_17',
            'type' => 'colour',
            'default' => '#f6f6f6'
        ),


        'color_18' => array(
            'vname' => 'LBL_COLOUR_SUITEP_18',
            'type' => 'colour',
            'default' => '#CCCCCC'
        ),


        'color_19' => array(
            'vname' => 'LBL_COLOUR_SUITEP_19',
            'type' => 'colour',
            'default' => '#999999'
        ),


        'color_20' => array(
            'vname' => 'LBL_COLOUR_SUITEP_20',
            'type' => 'colour',
            'default' => '#e2e7eb'
        ),


        'color_21' => array(
            'vname' => 'LBL_COLOUR_SUITEP_21',
            'type' => 'colour',
            'default' => '#f8f8f8'
        ),


        'color_22' => array(
            'vname' => 'LBL_COLOUR_SUITEP_22',
            'type' => 'colour',
            'default' => '#DEEFFF'
        ),


        'color_23' => array(
            'vname' => 'LBL_COLOUR_SUITEP_23',
            'type' => 'colour',
            'default' => '#444444'
        ),


        'color_24' => array(
            'vname' => 'LBL_COLOUR_SUITEP_24',
            'type' => 'colour',
            'default' => '#817d8d'
        ),


        'color_25' => array(
            'vname' => 'LBL_COLOUR_SUITEP_25',
            'type' => 'colour',
            'default' => '#7b8a96'
        ),


        'color_26' => array(
            'vname' => 'LBL_COLOUR_SUITEP_26',
            'type' => 'colour',
            'default' => '#888888'
        ),


        'color_27' => array(
            'vname' => 'LBL_COLOUR_SUITEP_27',
            'type' => 'colour',
            'default' => '#FAFAFA'
        ),


        'color_28' => array(
            'vname' => 'LBL_COLOUR_SUITEP_28',
            'type' => 'colour',
            'default' => '#dddddd'
        ),


        'color_29' => array(
            'vname' => 'LBL_COLOUR_SUITEP_29',
            'type' => 'colour',
            'default' => '#eeeeee'
        ),


        'color_30' => array(
            'vname' => 'LBL_COLOUR_SUITEP_30',
            'type' => 'colour',
            'default' => '#75AF4F'
        ),


        'color_31' => array(
            'vname' => 'LBL_COLOUR_SUITEP_31',
            'type' => 'colour',
            'default' => '#ff0000'
        ),


        'color_32' => array(
            'vname' => 'LBL_COLOUR_SUITEP_32',
            'type' => 'colour',
            'default' => '#f1f1f1'
        ),


        'color_33' => array(
            'vname' => 'LBL_COLOUR_SUITEP_33',
            'type' => 'colour',
            'default' => '#f8f7f7'
        ),


        'color_34' => array(
            'vname' => 'LBL_COLOUR_SUITEP_34',
            'type' => 'colour',
            'default' => '#9e9e9e'
        ),


        'color_35' => array(
            'vname' => 'LBL_COLOUR_SUITEP_35',
            'type' => 'colour',
            'default' => '#666666'
        ),


        'color_36' => array(
            'vname' => 'LBL_COLOUR_SUITEP_36',
            'type' => 'colour',
            'default' => '#f9f9f9'
        ),


        'color_37' => array(
            'vname' => 'LBL_COLOUR_SUITEP_37',
            'type' => 'colour',
            'default' => '#aaaaaa'
        ),


        'color_38' => array(
            'vname' => 'LBL_COLOUR_SUITEP_38',
            'type' => 'colour',
            'default' => '#dfdfdf'
        ),


        'color_39' => array(
            'vname' => 'LBL_COLOUR_SUITEP_39',
            'type' => 'colour',
            'default' => '#4D5EAA'
        ),


        'color_40' => array(
            'vname' => 'LBL_COLOUR_SUITEP_40',
            'type' => 'colour',
            'default' => '#AA4D4D'
        ),


        'color_41' => array(
            'vname' => 'LBL_COLOUR_SUITEP_41',
            'type' => 'colour',
            'default' => '#008000'
        ),


        'color_42' => array(
            'vname' => 'LBL_COLOUR_SUITEP_42',
            'type' => 'colour',
            'default' => '#980000'
        ),


        'color_43' => array(
            'vname' => 'LBL_COLOUR_SUITEP_43',
            'type' => 'colour',
            'default' => '#FF7800'
        ),


        'color_44' => array(
            'vname' => 'LBL_COLOUR_SUITEP_44',
            'type' => 'colour',
            'default' => '#00ee00'
        ),


        'color_45' => array(
            'vname' => 'LBL_COLOUR_SUITEP_45',
            'type' => 'colour',
            'default' => '#d0d0d0'
        ),


        'color_46' => array(
            'vname' => 'LBL_COLOUR_SUITEP_46',
            'type' => 'colour',
            'default' => '#AA9DCC'
        ),


        'color_47' => array(
            'vname' => 'LBL_COLOUR_SUITEP_47',
            'type' => 'colour',
            'default' => '#c1c1c1'
        ),


        'color_48' => array(
            'vname' => 'LBL_COLOUR_SUITEP_48',
            'type' => 'colour',
            'default' => '#f7f7f7'
        ),


        'color_49' => array(
            'vname' => 'LBL_COLOUR_SUITEP_49',
            'type' => 'colour',
            'default' => '#333333'
        ),


        'color_50' => array(
            'vname' => 'LBL_COLOUR_SUITEP_50',
            'type' => 'colour',
            'default' => '#0B578F'
        ),


        'color_51' => array(
            'vname' => 'LBL_COLOUR_SUITEP_51',
            'type' => 'colour',
            'default' => '#abc3d7'
        ),


        'color_52' => array(
            'vname' => 'LBL_COLOUR_SUITEP_52',
            'type' => 'colour',
            'default' => '#6fb0e4'
        ),


        'color_53' => array(
            'vname' => 'LBL_COLOUR_SUITEP_53',
            'type' => 'colour',
            'default' => '#f6fafd'
        ),


        'color_54' => array(
            'vname' => 'LBL_COLOUR_SUITEP_54',
            'type' => 'colour',
            'default' => '#FAF7CF'
        ),


        'color_55' => array(
            'vname' => 'LBL_COLOUR_SUITEP_55',
            'type' => 'colour',
            'default' => '#cbdae6'
        ),


        'color_56' => array(
            'vname' => 'LBL_COLOUR_SUITEP_56',
            'type' => 'colour',
            'default' => '#ebebeb'
        ),


        'color_57' => array(
            'vname' => 'LBL_COLOUR_SUITEP_57',
            'type' => 'colour',
            'default' => '#efefef'
        ),


        'color_58' => array(
            'vname' => 'LBL_COLOUR_SUITEP_58',
            'type' => 'colour',
            'default' => '#4f4f4f'
        ),


        'color_59' => array(
            'vname' => 'LBL_COLOUR_SUITEP_59',
            'type' => 'colour',
            'default' => '#93A0AB'
        ),


        'color_60' => array(
            'vname' => 'LBL_COLOUR_SUITEP_60',
            'type' => 'colour',
            'default' => '#93A0AB'
        ),











        /*
        'navbar' => array(
            'vname' => 'LBL_COLOUR_ADMIN_BASE',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),
        'navbar_hover' => array(
            'vname' => 'LBL_COLOUR_ADMIN_MENUHOVER',
            'type' => 'colour',
            'default' => '#597dbc',
        ),
        'navbar_font' => array(
            'vname' => 'LBL_COLOUR_ADMIN_MENUFONT',
            'type' => 'colour',
            'default' => '#ffffff',
        ),
        'navbar_link_hover' => array(
            'vname' => 'LBL_COLOUR_ADMIN_MENULNKHVR',
            'type' => 'colour',
            'default' => '#ffffff',
        ),
        'dropdown_menu' => array(
            'vname' => 'LBL_COLOUR_ADMIN_DDMENU',
            'type' => 'colour',
            'default' => '#f7f7f7',
        ),
        'dropdown_menu_link' => array(
            'vname' => 'LBL_COLOUR_ADMIN_DDLINK',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),

        'dropdown_menu_link_hover' => array(
            'vname' => 'LBL_COLOUR_ADMIN_DDLINK_HOVER',
            'type' => 'colour',
            'default' => '#ffffff',
        ),

        'action_menu_button' => array(
            'vname' => 'LBL_ACTION_MENU_BUTTON',
            'type' => 'colour',
            'default' => '#eeeeee',
        ),

        'action_menu_background' => array(
            'vname' => 'LBL_ACTION_MENU_BACKGROUND',
            'type' => 'colour',
            'default' => '#F7F7F7',
        ),

        'action_menu_background_hover' => array(
            'vname' => 'LBL_ACTION_MENU_BACKGROUND_HOVER',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),

        'button' => array(
            'vname' => 'LBL_COLOUR_ADMIN_BTNTOP',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),
        'button_hover' => array(
            'vname' => 'LBL_COLOUR_ADMIN_BTNHOVER',
            'type' => 'colour',
            'default' => '#597dbc',
        ),
        'button_link' => array(
            'vname' => 'LBL_COLOUR_ADMIN_BTNLNK',
            'type' => 'colour',
            'default' => '#ffffff',
        ),
        'button_link_hover' => array(
            'vname' => 'LBL_COLOUR_ADMIN_BTNLNKHOVER',
            'type' => 'colour',
            'default' => '#ffffff',
        ),

        'page_header' => array(
            'vname' => 'LBL_COLOUR_ADMIN_PAGEHEADER',
            'type' => 'colour',
            'default' => '#333333',
        ),
        'page_link' => array(
            'vname' => 'LBL_COLOUR_ADMIN_PAGELINK',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),

        'dashlet' => array(
            'vname' => 'LBL_COLOUR_ADMIN_DASHHEAD',
            'type' => 'colour',
            'default' => '#ffffff',
        ),
        'dashlet_headertext' => array(
            'vname' => 'LBL_COLOUR_ADMIN_DASHHEADTEXT',
            'type' => 'colour',
            'default' => '#3C8DBC',
        ),
        'icon' => array(
            'vname' => 'LBL_COLOUR_ADMIN_ICON',
            'type' => 'colour',
            'default' => '#ffffff',
        ),
        'suggestion_popup_from' => array(
            'vname' => 'LBL_SUGGESTION_POPUP_FROM',
            'type' => 'colour',
            'default' => '#3c8dbc',
        ),
        'suggestion_popup_to' => array(
            'vname' => 'LBL_SUGGESTION_POPUP_TO',
            'type' => 'colour',
            'default' => '#4286AD',
        ),
        */

    ),
);
