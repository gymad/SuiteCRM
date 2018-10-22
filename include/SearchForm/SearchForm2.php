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

require_once('include/tabs.php');
require_once('include/ListView/ListViewSmarty.php');
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('include/EditView/EditView2.php');

include_once __DIR__ . '/SearchWhere.php';


class SearchForm
{
    public $seed = null;
    public $module = '';
    public $action = 'index';
    public $searchdefs = array();
    public $listViewDefs = array();
    public $lv;
    public $th;
    public $tpl;
    public $view = 'SearchForm';
    public $displayView = 'basic_search';
    public $formData;
    public $fieldDefs;
    public $customFieldDefs;
    public $tabs;
    public $parsedView = 'basic';
    //may remove
    public $searchFields;
    public $displaySavedSearch = true;
    //show the advanced tab
    public $showAdvanced = true;
    //show the basic tab
    public $showBasic = true;
    //array of custom tab to show declare in searchdefs (no custom tab if false)
    public $showCustom = false;
    // nb of tab to show
    public $nbTabs = 0;
    // hide saved searches drop and down near the search button
    public $showSavedSearchesOptions = true;

    public $displayType = 'searchView';

    /**
     * @var array
     */
    protected $options;

    /**
     * Store the Saved Search Data for listview
     * @var null
     */
    private $savedSearchData = null;

    public function __construct($seed, $module, $action = 'index', $options = array())
    {
        $this->th = new TemplateHandler();
        $this->th->loadSmarty();
        $this->seed = $seed;
        $this->module = $module;
        $this->action = $action;
        $this->tabs = array(array('title' => $GLOBALS['app_strings']['LNK_BASIC_FILTER'],
            'link' => $module . '|basic_search',
            'key' => $module . '|basic_search',
            'name' => 'basic',
            'displayDiv' => ''),
            array('title' => $GLOBALS['app_strings']['LNK_ADVANCED_FILTER'],
                'link' => $module . '|advanced_search',
                'key' => $module . '|advanced_search',
                'name' => 'advanced',
                'displayDiv' => 'display:none'),
        );
        $this->searchColumns = array();
        $this->setOptions($options);
    }

    /**
     * getter for saved search data
     * (listview use for saved search chooser)
     * @return mixed
     */
    public function getSavedSearchData()
    {
        return $this->savedSearchData;
    }

    public function setup($searchdefs, $searchFields = array(), $tpl = 'SubpanelSearchFormGeneric.tpl', $displayView = 'basic_search', $listViewDefs = array())
    {
        $this->searchdefs = isset($searchdefs[$this->module]) ? $searchdefs[$this->module] : null;
        $this->tpl = $tpl;
        //used by advanced search
        $this->listViewDefs = $listViewDefs;
        $this->displayView = $displayView;
        $this->view = $this->view . '_' . $displayView;
        $tokens = explode('_', $this->displayView);
        $this->searchFields = isset($searchFields[$this->module]) ? $searchFields[$this->module] : null;
        $this->parsedView = $tokens[0];
        if ($this->displayView != 'saved_views') {
            $this->_build_field_defs();
        }


        // Setup the tab array.
        $this->tabs = array();
        if ($this->showBasic) {
            $this->nbTabs++;
            $this->tabs[] = array('title' => $GLOBALS['app_strings']['LNK_BASIC_FILTER'],
                'link' => $this->module . '|basic_search',
                'key' => $this->module . '|basic_search',
                'name' => 'basic',
                'displayDiv' => '');
        }
        if ($this->showAdvanced) {
            $this->nbTabs++;
            $this->tabs[] = array('title' => $GLOBALS['app_strings']['LNK_ADVANCED_FILTER'],
                'link' => $this->module . '|advanced_search',
                'key' => $this->module . '|advanced_search',
                'name' => 'advanced',
                'displayDiv' => 'display:none');
        }
        if (isset($this->showCustom) && is_array($this->showCustom)) {
            foreach ($this->showCustom as $v) {
                $this->nbTabs++;
                $this->tabs[] = array('title' => $GLOBALS['app_strings']["LNK_" . strtoupper($v)],
                    'link' => $this->module . '|' . $v,
                    'key' => $this->module . '|' . $v,
                    'name' => str_replace('_search', '', $v),
                    'displayDiv' => 'display:none',);
            }
        }
    }

    public function display($header = true)
    {
        global $theme, $timedate, $current_user, $sugar_config;
        $header_txt = '';
        $footer_txt = '';
        $return_txt = '';

        // it's an argument
        // set search form layout option to show only the results list order by field option only
        // TODO: bring it from user preferences or config
        $orderBySelectOnly = true;

        $this->th->ss->assign('module', $this->module);
        $this->th->ss->assign('action', $this->action);
        $this->th->ss->assign('displayView', $this->displayView);
        $this->th->ss->assign('viewTab', $this->getViewTab());


        require_once('modules/MySettings/StoreQuery.php');
        $storeQuery = new StoreQuery();
        $storeQuery->loadQuery($this->module);
        $storeQuery->addToQuery('searchFormTab', $this->displayView);
        $storeQuery->SaveQuery($this->module);

        $this->th->ss->assign('APP', $GLOBALS['app_strings']);
        //Show the tabs only if there is more than one
        if ($this->nbTabs > 1) {
            $this->th->ss->assign('TABS', $this->_displayTabs($this->module . '|' . $this->displayView));
        }
        $this->th->ss->assign(
            'searchTableColumnCount',
            ((isset($this->searchdefs['templateMeta']['maxColumns']) ? $this->searchdefs['templateMeta']['maxColumns'] : 2) * 2) - 1
        );
        $this->th->ss->assign('fields', $this->fieldDefs);
        $this->th->ss->assign('customFields', $this->customFieldDefs);
        $this->th->ss->assign('formData', $this->formData);
        $time_format = $timedate->get_user_time_format();
        $this->th->ss->assign('TIME_FORMAT', $time_format);
        $this->th->ss->assign('USER_DATEFORMAT', $timedate->get_user_date_format());
        $this->th->ss->assign('CALENDAR_FDOW', $current_user->get_first_day_of_week());

        $date_format = $timedate->get_cal_date_format();
        $time_separator = ":";
        if (preg_match('/\d+([^\d])\d+([^\d]*)/s', $time_format, $match)) {
            $time_separator = $match[1];
        }
        // Create Smarty variables for the Calendar picker widget
        $t23 = strpos($time_format, '23') !== false ? '%H' : '%I';
        if (!isset($match[2]) || $match[2] == '') {
            $this->th->ss->assign('CALENDAR_FORMAT', $date_format . ' ' . $t23 . $time_separator . "%M");
        } else {
            $pm = $match[2] == "pm" ? "%P" : "%p";
            $this->th->ss->assign('CALENDAR_FORMAT', $date_format . ' ' . $t23 . $time_separator . "%M" . $pm);
        }
        $this->th->ss->assign('TIME_SEPARATOR', $time_separator);

        //Show and hide the good tab form
        foreach ($this->tabs as $tabkey => $viewtab) {
            $viewName = str_replace(array($this->module . '|', '_search'), '', $viewtab['key']);
            if (strpos($this->view, $viewName) !== false) {
                $this->tabs[$tabkey]['displayDiv'] = '';
                //if this is advanced tab, use form with saved search sub form built in
                if ($viewName == 'advanced') {
                    $this->tpl = 'SearchFormGenericAdvanced.tpl';
                    if ($this->action == 'ListView') {
                        $this->th->ss->assign('DISPLAY_SEARCH_HELP', true);
                    }
                    $this->th->ss->assign('DISPLAY_SAVED_SEARCH', $this->displaySavedSearch);
                    $this->th->ss->assign('SAVED_SEARCH', $this->displaySavedSearch($orderBySelectOnly));
                    //this determines whether the saved search subform should be rendered open or not
                    if (isset($_REQUEST['showSSDIV']) && $_REQUEST['showSSDIV'] == 'yes') {
                        $this->th->ss->assign('SHOWSSDIV', 'yes');
                        $this->th->ss->assign('DISPLAYSS', '');
                    } else {
                        $this->th->ss->assign('SHOWSSDIV', 'no');
                        $this->th->ss->assign('DISPLAYSS', 'display:none');
                    }
                }
            } else {
                $this->tabs[$tabkey]['displayDiv'] = 'display:none';
            }
        }

        $this->th->ss->assign('TAB_ARRAY', $this->tabs);

        $totalWidth = 0;
        if (isset($this->searchdefs['templateMeta']['widths'])
            && isset($this->searchdefs['templateMeta']['maxColumns'])
        ) {
            $totalWidth = ($this->searchdefs['templateMeta']['widths']['label'] +
                    $this->searchdefs['templateMeta']['widths']['field']) *
                $this->searchdefs['templateMeta']['maxColumns'];
            // redo the widths in case they are too big
            if ($totalWidth > 100) {
                $resize = 100 / $totalWidth;
                $this->searchdefs['templateMeta']['widths']['label'] =
                    $this->searchdefs['templateMeta']['widths']['label'] * $resize;
                $this->searchdefs['templateMeta']['widths']['field'] =
                    $this->searchdefs['templateMeta']['widths']['field'] * $resize;
            }
        }
        $this->th->ss->assign('templateMeta', $this->searchdefs['templateMeta']);
        $this->th->ss->assign('HAS_ADVANCED_SEARCH', !empty($this->searchdefs['layout']['advanced_search']));
        $this->th->ss->assign('displayType', $this->displayType);
        // return the form of the shown tab only
        if ($this->showSavedSearchesOptions) {
            $this->th->ss->assign('SAVED_SEARCHES_OPTIONS', $this->displaySavedSearchSelect());
            $this->th->ss->assign('savedSearchData', $this->getSavedSearchData());
        }
        if ($this->module == 'Documents') {
            $this->th->ss->assign('DOCUMENTS_MODULE', true);
        }

        if (isset($_REQUEST['columnsFilter']) && $_REQUEST['columnsFilter']) {
            return '<pre id="responseData">' . json_encode($this->getColumnsFilterData()) . '</pre>';
        }

        $this->th->ss->assign('searchInfoJson', $this->getSearchInfoJson());


        $searchFormInPopup = !in_array($this->module, isset($sugar_config['enable_legacy_search']) ? $sugar_config['enable_legacy_search'] : array());
        $this->th->ss->assign('searchFormInPopup', $searchFormInPopup);

        if (isset($this->th)) {
            $moduleDir = null;
            if (isset($this->seed->module_dir)) {
                $moduleDir = $this->seed->module_dir;
            } else {
                LoggerManager::getLogger()->warn('Trying to get property of non-object (module_dir)');
            }

            $return_txt = $this->th->displayTemplate($moduleDir, 'SearchForm_' . $this->parsedView, $this->locateFile($this->tpl));
        } else {
            $return_txt = null;
            LoggerManager::getLogger()->warn('Trying to get property of non-object for return_txt from th');
        }

        if ($header) {
            $this->th->ss->assign('return_txt', $return_txt);

            $moduleDir = null;
            if (isset($this->seed->module_dir)) {
                $moduleDir = $this->seed->module_dir;
            } else {
                LoggerManager::getLogger()->warn('Trying to get property of non-object (module_dir)');
            }

            $header_txt = $this->th->displayTemplate($moduleDir, 'SearchFormHeader', $this->locateFile('header.tpl'));
            //pass in info to render the select dropdown below the form



            $moduleDir = null;
            if (isset($this->seed->module_dir)) {
                $moduleDir = $this->seed->module_dir;
            } else {
                LoggerManager::getLogger()->warn('Trying to get property of non-object (module_dir)');
            }

            $footer_txt = $this->th->displayTemplate($moduleDir, 'SearchFormFooter', $this->locateFile('footer.tpl'));
            $return_txt = $header_txt . $footer_txt;
        }

        return $return_txt;
    }

    private function getViewTab()
    {
        $ret = 'basic';
        if (preg_match('/^(basic|advanced)_search$/', $this->displayView, $matches)) {
            $ret = $matches[1];
        }

        return $ret;
    }

    /**
     * All user defined search parameters
     * @return array search parameters
     */
    private function getSearchInfo()
    {
        global $app_strings, $mod_strings;
        $data = array();
        $fields = array_merge($this->fieldDefs, (array)$this->customFieldDefs);

        if (!is_array($this->searchFields)) {
            LoggerManager::getLogger()->warn('search fields is not an array');
        }

        $fields = array_merge($fields, (array)$this->searchFields);
        foreach ($fields as $name => $defs) {
            if (preg_match('/(.*)_basic$/', $name, $match)) {
                if (isset($fields[$match[1]]['value']) && $fields[$match[1]]['value'] && (!isset($defs['value']) || !$defs['value'])) {
                    $fields[$name] = array_merge((array)$fields[$name], (array)$fields[$match[1]]);
                }
            }
            if (preg_match('/(.*)_advanced$/', $name, $match)) {
                if (isset($fields[$match[1]]['value']) && $fields[$match[1]]['value'] && (!isset($defs['value']) || !$defs['value'])) {
                    $fields[$name] = array_merge((array)$fields[$name], (array)$fields[$match[1]]);
                }
            }
        }

        if (!is_array($this->searchFields)) {
            LoggerManager::getLogger()->warn('search fields is not an array');
        }

        $searchFieldsKeys = array_keys((array)$this->searchFields);
        foreach ($fields as $name => $defs) {
            $searchTypeKey = false;
            if (preg_match('/(.*)_basic$/', $name, $match)) {
                $searchTypeKey = $match[1];
            }
            if (preg_match('/(.*)_advanced$/', $name, $match)) {
                $searchTypeKey = $match[1];
            }
            if (in_array($name, $searchFieldsKeys) || ($searchTypeKey && in_array($searchTypeKey, $searchFieldsKeys))) {
                $vname = isset($defs['vname']) ? $defs['vname'] : null;
                $label = isset($defs['label']) ? $defs['label'] : null;
                $value = isset($defs['value']) ? $defs['value'] : null;
                if (($vname || $label) && $value) {
                    $type = isset($defs['type']) ? $defs['type'] : null;
                    if (isset($app_strings[$vname ? $vname : $label])) {
                        $labelText = $app_strings[$vname ? $vname : $label];
                    } elseif (isset($mod_strings[$vname ? $vname : $label])) {
                        $labelText = $mod_strings[$vname ? $vname : $label];
                    } else {
                        $labelText = $vname ? $vname : $label;
                    }
                    if (!preg_match('/\:\s*/', $labelText)) {
                        $labelText .= ':';
                    }
                    if (is_array($value)) {
                        $values = array();
                        foreach ($value as $key) {
                            if (isset($defs['options'][$key]) && $defs['options'][$key]) {
                                $values[$key] = $defs['options'][$key];
                            } else {
                                if (in_array($key, $value)) {
                                    try {
                                        $values[$key] = $this->findFieldOptionValue($fields, $key);
                                    } catch (Exception $e) {
                                        $values[$key] = $key;
                                    }
                                } elseif (isset($value[$key])) {
                                    $values[$key] = $value[$key];
                                } else {
                                    $values[$key] = '?';
                                }
                            }
                        }
                        $value = implode(', ', $values);
                    }
                    $data[$labelText] = $type == 'bool' ? '&#10004' : $value;
                }
            }
        }

        return $data;
    }

    /**
     * Find search value in fields options by ID
     * @param $fields field definitions
     * @param $key key or ID of value
     * @return mixed value for key
     * @throws Exception value not found
     */
    private function findFieldOptionValue($fields, $key)
    {
        foreach ($fields as $fkey => $fvalue) {
            if (isset($fvalue['options']) && is_array($fvalue['options'])) {
                foreach ($fvalue['options'] as $okey => $ovalue) {
                    if ($okey == $key) {
                        return $ovalue;
                    }
                }
            }
        }
        throw new Exception('Find Field Option Value: Not found');
    }

    /**
     * All user defined search parameters in a JSON encoded string
     * @return string search parameters
     */
    private function getSearchInfoJson()
    {
        return json_encode($this->getSearchInfo());
    }

    /**
     * @return mixed Columns Filter info
     */
    private function getColumnsFilterData()
    {
        if (!isset($this->lastTemplateGroupChooser)) {
            $this->displaySavedSearch();
        }

        return $this->lastTemplateGroupChooser;
    }

    /**
     * Set options
     * @param array $options
     * @return SearchForm2
     */
    public function setOptions($options = null)
    {
        $defaults = array(
            'locator_class' => 'FileLocator',
            'locator_class_params' => array(
                array(
                    'custom/modules/' . $this->module . '/tpls/SearchForm',
                    'modules/' . $this->module . '/tpls/SearchForm',
                    'custom/include/SearchForm/tpls',
                    'include/SearchForm/tpls'
                )
            )
        );

        $this->options = empty($options) ? $defaults : $options;

        return $this;
    }

    /**
     * Get Options
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }


    /**
     * Locate a file in the custom or stock folders.  Look in the custom folders first.
     *
     * @param string $file The file we are looking for
     * @return bool|string         If the file is found return the path, False if not
     */
    protected function locateFile($file)
    {
        $paths = isset($this->options['locator_class_params']) ? $this->options['locator_class_params'][0] : array();
        foreach ($paths as $path) {
            if (is_file($path . '/' . $file)) {
                return $path . '/' . $file;
            }
        }

        return false;
    }

    public function displaySavedSearch($orderBySelectOnly = false)
    {
        $savedSearch = new SavedSearch($this->listViewDefs[$this->module], $this->lv->data['pageData']['ordering']['orderBy'], $this->lv->data['pageData']['ordering']['sortOrder']);
        $ret = $savedSearch->getForm($this->module, false, $orderBySelectOnly);
        $this->lastTemplateGroupChooser = $savedSearch->lastTemplateGroupChooser;

        return $ret;
    }


    public function displaySavedSearchSelect()
    {
        if (!isset($this->listViewDefs[$this->module])) {
            LoggerManager::getLogger()->warn('Undefined index (displaySavedSearchSelect)');
            $listViewDefsModule = null;
        } else {
            $listViewDefsModule = $this->listViewDefs[$this->module];
        }

        $orderBy = null;
        if (isset($this->lv->data['pageData']['ordering']['orderBy'])) {
            $orderBy = $this->lv->data['pageData']['ordering']['orderBy'];
        } else {
            LoggerManager::getLogger()->warn('Trying to get property of non-object: list view data "order by" is not defined');
        }

        $sortOrder = null;
        if (isset($this->lv->data['pageData']['ordering']['sortOrder'])) {
            $sortOrder = $this->lv->data['pageData']['ordering']['sortOrder'];
        } else {
            LoggerManager::getLogger()->warn('Trying to get property of non-object: list view data "sort order" is not defined');
        }

        $savedSearch = new SavedSearch($listViewDefsModule, $orderBy, $sortOrder);
        $savedSearchSelect = $savedSearch->getSelect($this->module, $savedSearchData);
        $this->savedSearchData = $savedSearchData;

        return $savedSearchSelect;
    }


    /**
     * displays the tabs (top of the search form)
     *
     * @param string $currentKey key in $this->tabs to show as the current tab
     *
     * @return string html
     */
    public function _displayTabs($currentKey)
    {
        if (isset($_REQUEST['saved_search_select']) && $_REQUEST['saved_search_select'] != '_none') {
            $saved_search = loadBean('SavedSearch');
            $saved_search->retrieveSavedSearch($_REQUEST['saved_search_select']);
        }

        $str = '<script>';
        if (!empty($_REQUEST['displayColumns'])) {
            $str .= 'SUGAR.savedViews.displayColumns = "' . $_REQUEST['displayColumns'] . '";';
        } elseif (isset($saved_search->contents['displayColumns']) && !empty($saved_search->contents['displayColumns'])) {
            $str .= 'SUGAR.savedViews.displayColumns = "' . $saved_search->contents['displayColumns'] . '";';
        }
        if (!empty($_REQUEST['hideTabs'])) {
            $str .= 'SUGAR.savedViews.hideTabs = "' . $_REQUEST['hideTabs'] . '";';
        } elseif (isset($saved_search->contents['hideTabs']) && !empty($saved_search->contents['hideTabs'])) {
            $str .= 'SUGAR.savedViews.hideTabs = "' . $saved_search->contents['hideTabs'] . '";';
        }
        if (!empty($_REQUEST['orderBy'])) {
            $str .= 'SUGAR.savedViews.selectedOrderBy = "' . $_REQUEST['orderBy'] . '";';
        } elseif (isset($saved_search->contents['orderBy']) && !empty($saved_search->contents['orderBy'])) {
            $str .= 'SUGAR.savedViews.selectedOrderBy = "' . $saved_search->contents['orderBy'] . '";';
        }
        if (!empty($_REQUEST['sortOrder'])) {
            $str .= 'SUGAR.savedViews.selectedSortOrder = "' . $_REQUEST['sortOrder'] . '";';
        } elseif (isset($saved_search->contents['sortOrder']) && !empty($saved_search->contents['sortOrder'])) {
            $str .= 'SUGAR.savedViews.selectedSortOrder = "' . $saved_search->contents['sortOrder'] . '";';
        }

        $str .= '</script>';

        return $str;
    }

    /*
    * Generate the data
    */
    public function _build_field_defs()
    {
        $this->formData = array();
        $this->fieldDefs = array();
        foreach ((array)$this->searchdefs['layout'][$this->displayView] as $data) {
            if (is_array($data)) {
                //Fields may be listed but disabled so that when they are enabled, they have the correct custom display data.
                if (isset($data['enabled']) && $data['enabled'] == false) {
                    continue;
                }
                $data['name'] = $data['name'] . '_' . $this->parsedView;
                $this->formData[] = array('field' => $data);
                $this->fieldDefs[$data['name']] = $data;
            } else {
                $this->formData[] = array('field' => array('name' => $data . '_' . $this->parsedView));
            }
        }

        if ($this->seed) {
            $this->seed->fill_in_additional_detail_fields();
            // hack to make the employee status field for the Users/Employees module display correctly
            if ($this->seed->object_name == 'Employee' || $this->seed->object_name == 'User') {
                $this->seed->field_defs['employee_status']['type'] = 'enum';
                $this->seed->field_defs['employee_status']['massupdate'] = true;
                $this->seed->field_defs['employee_status']['options'] = 'employee_status_dom';
                unset($this->seed->field_defs['employee_status']['function']);
            }

            foreach ($this->seed->toArray() as $name => $value) {
                $fvName = $name . '_' . $this->parsedView;
                if (!empty($this->fieldDefs[$fvName])) {
                    $this->fieldDefs[$fvName] = array_merge($this->seed->field_defs[$name], $this->fieldDefs[$fvName]);
                } else {
                    $this->fieldDefs[$fvName] = $this->seed->field_defs[$name];
                    $this->fieldDefs[$fvName]['name'] = (isset($this->fieldDefs[$fvName]['name']) ? $this->fieldDefs[$fvName]['name'] : null) . '_' . $this->parsedView;
                }

                if (isset($this->fieldDefs[$fvName]['type']) && $this->fieldDefs[$fvName]['type'] == 'relate') {
                    if (isset($this->fieldDefs[$fvName]['id_name'])) {
                        $this->fieldDefs[$fvName]['id_name'] .= '_' . $this->parsedView;
                    }
                }

                if (isset($this->fieldDefs[$fvName]['options']) && isset($GLOBALS['app_list_strings'][$this->fieldDefs[$fvName]['options']])) {
                    // fill in enums
                    $this->fieldDefs[$fvName]['options'] = $GLOBALS['app_list_strings'][$this->fieldDefs[$fvName]['options']];
                    //Hack to add blanks for parent types on search views
                    //53131 - add blank option for SearchField options with def 'options_add_blank' set to true
                    if ($this->fieldDefs[$fvName]['type'] == "parent_type" || $this->fieldDefs[$fvName]['type'] == "parent" || (isset($this->searchFields[$name]['options_add_blank']) && $this->searchFields[$name]['options_add_blank'])) {
                        if (!array_key_exists('', $this->fieldDefs[$fvName]['options'])) {
                            $this->fieldDefs[$fvName]['options'] =
                                array('' => '') + $this->fieldDefs[$fvName]['options'];
                        }
                    }
                }

                if (isset($this->fieldDefs[$fvName]['function'])) {
                    $this->fieldDefs[$fvName]['type'] = 'multienum';

                    if (is_array($this->fieldDefs[$fvName]['function'])) {
                        $this->fieldDefs[$fvName]['function']['preserveFunctionValue'] = true;
                    }

                    $function = $this->fieldDefs[$fvName]['function'];

                    if (is_array($function) && isset($function['name'])) {
                        $function_name = $this->fieldDefs[$fvName]['function']['name'];
                    } else {
                        $function_name = $this->fieldDefs[$fvName]['function'];
                    }

                    if (!empty($this->fieldDefs[$fvName]['function']['returns']) && $this->fieldDefs[$fvName]['function']['returns'] == 'html') {
                        if (!empty($this->fieldDefs[$fvName]['function']['include'])) {
                            require_once($this->fieldDefs[$fvName]['function']['include']);
                        }
                        $value = call_user_func($function_name, $this->seed, $name, $value, $this->view);
                        $this->fieldDefs[$fvName]['value'] = $value;
                    } else {
                        if (!isset($function['params']) || !is_array($function['params'])) {
                            $this->fieldDefs[$fvName]['options'] = call_user_func($function_name, $this->seed, $name, $value, $this->view);
                        } else {
                            $this->fieldDefs[$fvName]['options'] = call_user_func_array($function_name, $function['params']);
                        }
                    }
                }
                if (isset($this->fieldDefs[$name]['type']) && $this->fieldDefs[$fvName]['type'] == 'function'
                    && isset($this->fieldDefs[$fvName]['function_name'])
                ) {
                    $value = $this->callFunction($this->fieldDefs[$fvName]);
                    $this->fieldDefs[$fvName]['value'] = $value;
                }

                $this->fieldDefs[$name]['value'] = $value;


                if ((!empty($_REQUEST[$fvName]) || (isset($_REQUEST[$fvName]) && $_REQUEST[$fvName] == '0'))
                    && empty($this->fieldDefs[$fvName]['function']['preserveFunctionValue'])
                ) {
                    $value = $_REQUEST[$fvName];
                    $this->fieldDefs[$fvName]['value'] = $value;
                }
            } //foreach
        }
    }

    /**
     * Populate the searchFields from an array
     *
     * @param array $array array to search through
     * @param string $switchVar variable to use in switch statement
     * @param bool $addAllBeanFields true to process at all bean fields
     */
    public function populateFromArray(&$array, $switchVar = null, $addAllBeanFields = true)
    {
        if ((!empty($array['searchFormTab']) || !empty($switchVar)) && !empty($this->searchFields)) {
            $arrayKeys = array_keys($array);
            $searchFieldsKeys = array_keys($this->searchFields);
            if (empty($switchVar)) {
                $switchVar = $array['searchFormTab'];
            }
            //name of  the search tab
            $SearchName = str_replace('_search', '', $switchVar);
            if ($switchVar == 'saved_views') {
                foreach ($this->searchFields as $name => $params) {
                    foreach ($this->tabs as $tabName) {
                        if (!empty($array[$name . '_' . $tabName['name']])) {
                            $this->searchFields[$name]['value'] = $array[$name . '_' . $tabName['name']];
                            if (empty($this->fieldDefs[$name . '_' . $tabName['name']]['value'])) {
                                $this->fieldDefs[$name . '_' . $tabName['name']]['value'] = $array[$name . '_' . $tabName['name']];
                            }
                        }
                    }
                }
                if ($addAllBeanFields) {
                    foreach ($this->seed->field_name_map as $key => $params) {
                        if (!in_array($key, $searchFieldsKeys)) {
                            foreach ($this->tabs->name as $tabName) {
                                if (in_array($key . '_' . $tabName['name'], $arrayKeys)) {
                                    $this->searchFields[$key] = array('query_type' => 'default',
                                        'value' => $array[$key . '_' . $tabName['name']]);
                                }
                            }
                        }
                    }
                }
            } else {
                $fromMergeRecords = isset($array['merge_module']);

                foreach ($this->searchFields as $name => $params) {
                    $long_name = $name . '_' . $SearchName;
                    /*nsingh 21648: Add additional check for bool values=0. empty() considers 0 to be empty Only repopulates if value is 0 or 1:( */
                    if (isset($array[$long_name]) && ($array[$long_name] !== '' || (isset($this->fieldDefs[$long_name]['type']) && $this->fieldDefs[$long_name]['type'] == 'bool' && ($array[$long_name] == '0' || $array[$long_name] == '1')))) {
                        $this->searchFields[$name]['value'] = $array[$long_name];
                        if (empty($this->fieldDefs[$long_name]['value'])) {
                            $this->fieldDefs[$long_name]['value'] = $array[$long_name];
                        }
                    } elseif (!empty($array[$name]) && !$fromMergeRecords) { // basic
                        $this->searchFields[$name]['value'] = $array[$name];
                        if (empty($this->fieldDefs[$long_name]['value'])) {
                            $this->fieldDefs[$long_name]['value'] = $array[$name];
                        }
                    }

                    if (!empty($params['enable_range_search']) && isset($this->searchFields[$name]['value'])) {
                        if (preg_match('/^range_(.*?)$/', $long_name, $match) && isset($array[$match[1] . '_range_choice'])) {
                            $this->searchFields[$name]['operator'] = $array[$match[1] . '_range_choice'];
                        }
                    }

                    if (!empty($params['is_date_field']) && isset($this->searchFields[$name]['value'])) {
                        global $timedate;
                        // FG - bug 45287 - to db conversion is ok, but don't adjust timezone (not now), otherwise you'll jump to the day before (if at GMT-xx)
                        $date_value = $timedate->to_db_date($this->searchFields[$name]['value'], false);
                        $this->searchFields[$name]['value'] = $date_value == '' ? $this->searchFields[$name]['value'] : $date_value;
                    }
                }

                if ((empty($array['massupdate']) || $array['massupdate'] == 'false') && $addAllBeanFields) {
                    foreach ($this->seed->field_name_map as $key => $params) {
                        if ($key != 'assigned_user_name' && $key != 'modified_by_name') {
                            $long_name = $key . '_' . $SearchName;

                            if (in_array($key . '_' . $SearchName, $arrayKeys) && !in_array($key, $searchFieldsKeys)) {
                                $this->searchFields[$key] = array('query_type' => 'default', 'value' => $array[$long_name]);

                                if (!empty($params['type']) && $params['type'] == 'parent'
                                    && !empty($params['type_name']) && !empty($this->searchFields[$key]['value'])
                                ) {
                                    require_once('include/SugarFields/SugarFieldHandler.php');
                                    $sfh = new SugarFieldHandler();
                                    $sf = $sfh::getSugarField('Parent');

                                    $this->searchFields[$params['type_name']] = array('query_type' => 'default',
                                        'value' => $sf->getSearchInput($params['type_name'], $array));
                                }

                                if (empty($this->fieldDefs[$long_name]['value'])) {
                                    $this->fieldDefs[$long_name]['value'] = $array[$long_name];
                                }
                            }
                        }
                    }
                }
            }
        }


        if (is_array($this->searchFields)) {
            foreach ($this->searchFields as $fieldName => $field) {
                if (!empty($field['value']) && is_string($field['value'])) {
                    $this->searchFields[$fieldName]['value'] = trim($field['value']);
                }
            }
        }
    }

    /**
     * Populate the searchFields from $_REQUEST
     *
     * @param string $switchVar variable to use in switch statement
     * @param bool $addAllBeanFields true to process at all bean fields
     */
    public function populateFromRequest($switchVar = null, $addAllBeanFields = true)
    {
        $this->populateFromArray($_REQUEST, $switchVar, $addAllBeanFields);
    }


    /**
     * Parse date expression and return WHERE clause
     * @param string $operator Date expression operator
     * @param string DB field name
     * @param string DB field type
     */
    protected function parseDateExpression($operator, $db_field, $field_type = '')
    {
        if ($field_type == "date") {
            $type = "date";
            $adjForTZ = false;
        } else {
            $type = "datetime";
            $adjForTZ = true;
        }
        $dates = TimeDate::getInstance()->parseDateRange($operator, null, $adjForTZ);
        if (empty($dates)) {
            return '';
        }
        $start = $this->seed->db->convert($this->seed->db->quoted($dates[0]->asDb()), $type);
        $end = $this->seed->db->convert($this->seed->db->quoted($dates[1]->asDb()), $type);

        return "($db_field >= $start AND $db_field <= $end)";
    }

    /**
     * generateSearchWhere
     *
     * This function serves as the central piece of SearchForm2.php
     * It is responsible for creating the WHERE clause for a given search operation
     *
     * @param bool $add_custom_fields boolean indicating whether or not custom fields should be added
     * @param string $module Module to search against
     *
     * @return string the SQL WHERE clause based on the arguments supplied in SearchForm2 instance
     */
    public function generateSearchWhere($add_custom_fields = false, $module = '')
    {
        $searchWhere = new SearchWhere();
        $whereClause = $searchWhere->generateSearchWhere($this, $add_custom_fields, $module);
        return $whereClause;
    }


    /**
     * isEmptyDropdownField
     *
     * This function checks to see if a blank dropdown field was supplied.  This scenario will occur where
     * a dropdown select is in single selection mode
     *
     * @param $value Mixed dropdown value
     */
    private function isEmptyDropdownField($name = '', $value = array())
    {
        $result = is_array($value) && isset($value[0]) && $value[0] == '';
        $GLOBALS['log']->debug("Found empty value for {$name} dropdown search key");

        return $result;
    }

    /**
     * Return the search defs for a particular module.
     *
     * @static
     * @param $module
     */
    public static function retrieveSearchDefs($module)
    {
        $searchdefs = array();
        $searchFields = array();

        if (file_exists('custom/modules/' . $module . '/metadata/metafiles.php')) {
            require('custom/modules/' . $module . '/metadata/metafiles.php');
        } elseif (file_exists('modules/' . $module . '/metadata/metafiles.php')) {
            require('modules/' . $module . '/metadata/metafiles.php');
        }

        if (file_exists('custom/modules/' . $module . '/metadata/searchdefs.php')) {
            require('custom/modules/' . $module . '/metadata/searchdefs.php');
        } elseif (!empty($metafiles[$module]['searchdefs'])) {
            require($metafiles[$module]['searchdefs']);
        } elseif (file_exists('modules/' . $module . '/metadata/searchdefs.php')) {
            require('modules/' . $module . '/metadata/searchdefs.php');
        }


        if (!empty($metafiles[$module]['searchfields'])) {
            require($metafiles[$module]['searchfields']);
        } elseif (file_exists('modules/' . $module . '/metadata/SearchFields.php')) {
            require('modules/' . $module . '/metadata/SearchFields.php');
        }
        if (file_exists('custom/modules/' . $module . '/metadata/SearchFields.php')) {
            require('custom/modules/' . $module . '/metadata/SearchFields.php');
        }

        return array('searchdefs' => $searchdefs, 'searchFields' => $searchFields);
    }

    /**
     * this function will take the subquery string and return the columns to be used in the select of the derived table
     *
     * @param string $subquery the subquery string to parse through
     * @return string the retrieved column list
     */
    protected function getSelectCol($subquery)
    {
        $selectCol = '';

        if (empty($subquery)) {
            return $selectCol;
        }
        $subquery = strtolower($subquery);
        //grab the values between the select and from
        $select = stripos($subquery, 'select');
        $from = stripos($subquery, 'from');
        if ($select !== false && $from !== false && $select + 6 < $from) {
            $selectCol = substr($subquery, $select + 6, $from - $select - 6);
        }
        //remove table names if they exist
        $columns = explode(',', $selectCol);
        $i = 0;
        foreach ($columns as $column) {
            $dot = strpos($column, '.');
            if ($dot > 0) {
                $columns[$i] = substr($column, $dot + 1);
            }
            $i++;
        }
        $selectCol = implode(',', $columns);

        return $selectCol;
    }
}
