<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
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
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
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
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$module_name = 'SharedSecurityRules';
$viewdefs [$module_name] = array(
            'DetailView' =>
            array(
                'templateMeta' =>
                array(
                    'form' =>
                    array(
                        'buttons' =>
                        array(
                            0 => 'EDIT',
                            1 => 'DUPLICATE',
                            2 => 'DELETE',
                            3 => 'FIND_DUPLICATES',
                        ),
                    ),
                    'maxColumns' => '2',
                    'widths' =>
                    array(
                        0 =>
                        array(
                            'label' => '10',
                            'field' => '30',
                        ),
                        1 =>
                        array(
                            'label' => '10',
                            'field' => '30',
                        ),
                    ),
                    'useTabs' => false,
                    'tabDefs' =>
                    array(
                        'DEFAULT' =>
                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                        ),
                        'LBL_EDITVIEW_PANEL2' =>
                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                        ),
                        'LBL_EDITVIEW_PANEL1' =>
                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                        ),
                    ),
                ),
                'panels' =>
                array(
                    'default' =>
                    array(
                        0 =>
                        array(
                            0 => 'name',
                            1 => 'assigned_user_name',
                        ),
                        1 =>
                        array(
                            0 =>
                            array(
                                'name' => 'flow_module',
                                'studio' => 'visible',
                                'label' => 'LBL_FLOW_MODULE',
                            ),
                            1 =>
                            array(
                                'name' => 'status',
                                'studio' => 'visible',
                                'label' => 'LBL_STATUS',
                            ),
                        ),
                        2 =>
                        array(
                            0 => 'description',
                        ),
                    ),
                    'lbl_editview_panel2' =>
                    array(
                        0 =>
                        array(
                            0 =>
                            array(
                                'name' => 'condition_lines',
                                'label' => 'LBL_CONDITION_LINES',
                            ),
                        ),
                    ),
                    'lbl_editview_panel1' =>
                    array(
                        0 =>
                        array(
                            0 =>
                            array(
                                'name' => 'action_lines',
                                'label' => 'LBL_ACTION_LINES',
                            ),
                        ),
                    ),
                ),
            ),
);