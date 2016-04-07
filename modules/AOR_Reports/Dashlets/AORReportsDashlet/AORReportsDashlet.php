<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

require_once('include/Dashlets/Dashlet.php');
require_once 'modules/AOR_Reports/aor_utils.php';

class AORReportsDashlet extends Dashlet {
    var $def;
    var $report;
    var $charts;
    var $onlyCharts;

    function AORReportsDashlet($id, $def = array()) {
		global $current_user, $app_strings;

        parent::Dashlet($id);
        $this->isConfigurable = true;
        $this->def = $def;
        if(empty($def['dashletTitle'])) {
            $this->title = translate('LBL_AOR_REPORTS_DASHLET', 'AOR_Reports');
        } else{
            $this->title = $def['dashletTitle'];
        }

        $this->params = array();
        if(!empty($def['parameter_id'])) {
            foreach ($def['parameter_id'] as $key => $parameterId) {
                $this->params[$parameterId] = array(
                    'id' => $parameterId,
                    'operator' => $def['parameter_operator'][$key],
                    'type' => $def['parameter_type'][$key],
                    'value' => $def['parameter_value'][$key]);
            }
        }
        if(!empty($def['aor_report_id'])) {
            $this->report = BeanFactory::getBean('AOR_Reports', $def['aor_report_id']);
            $this->report->user_parameters = $this->params;
        }
        $this->onlyCharts = !empty($def['onlyCharts']);
        $this->charts = !empty($def['charts']) ? $def['charts'] : array();
    }

    public function display() {
        global $current_language;
        $mod_strings = return_module_language($current_language, 'AOR_Reports');
        $dashletSmarty = new Sugar_Smarty();
        $dashletTemplate = get_custom_file_if_exists('modules/AOR_Reports/Dashlets/AORReportsDashlet/dashlet.tpl');
        $dashletSmarty->assign('MOD',$mod_strings);
        $dashletSmarty->assign('dashlet_id',$this->id);
        $dashletSmarty->assign('report_id',$this->report->id);
        $dashletSmarty->assign('chartHTML',$this->getChartHTML());
        $dashletSmarty->assign('onlyCharts', $this->onlyCharts);
        $dashletSmarty->assign('parameters',json_encode(array(
                                            'ids' => isset($this->def['parameter_id']) ? $this->def['parameter_id'] : null,
                                            'operators' => isset($this->def['parameter_operator']) ? $this->def['parameter_operator'] : null,
                                            'types' => isset($this->def['parameter_type']) ? $this->def['parameter_type'] : null,
                                            'values' => isset($this->def['parameter_value']) ? $this->def['parameter_value'] : null)));
        return $dashletSmarty->fetch($dashletTemplate);
    }

    function getChartHTML(){
        if(!empty($this->report->id)) {
            //return $this->report->build_report_chart($this->charts, AOR_Report::CHART_TYPE_CHARTJS);
            return $this->report->build_report_chart($this->charts, AOR_Report::CHART_TYPE_RGRAPH);
        }else{
            return '';
        }
    }

	function process() {
    }

    public function displayOptions() {
        ob_start();
        global $current_language, $app_list_strings, $datetime;
        $mod_strings = return_module_language($current_language, 'AOR_Reports');
        $optionsSmarty = new Sugar_Smarty();
        $optionsSmarty->assign('MOD',$mod_strings);
        $optionsSmarty->assign('id', $this->id);
        $optionsSmarty->assign('dashletTitle', $this->title);
        $optionsSmarty->assign('aor_report_id', $this->report->id);
        $optionsSmarty->assign('aor_report_name', $this->report->name);
        $optionsSmarty->assign('onlyCharts', $this->onlyCharts);
        $optionsSmarty->assign('aor_date_options', $app_list_strings['aor_date_options']);
        $optionsSmarty->assign('aor_condition_type_list', $app_list_strings['aor_condition_type_list']);
        $optionsSmarty->assign('aor_date_operator', $app_list_strings['aor_date_operator']);
        $optionsSmarty->assign('aor_date_type_list', $app_list_strings['aor_date_type_list']);
        $optionsSmarty->assign('date_time_period_list', $app_list_strings['date_time_period_list']);

        $charts = array();
        if(!empty($this->report->id)){
            foreach($this->report->get_linked_beans('aor_charts','AOR_Charts') as $chart){
                $charts[$chart->id] = $chart->name;
            }
        }
        $conditions = getConditionsAsParameters($this->report, $this->params);
        $i = 0;
        foreach($conditions as $condition) {
            if($condition["value_type"] == "Date"){
                if($condition["additionalConditions"][0] == "now") {
                    $conditions[$i]["value"] = date("d/m/Y");
                }
            }

            $i++;
        }
        $optionsSmarty->assign('parameters', $conditions);
        $chartOptions = get_select_options_with_id($charts,$this->charts);
        $optionsSmarty->assign('chartOptions', $chartOptions);
        $optionsTemplate = get_custom_file_if_exists('modules/AOR_Reports/Dashlets/AORReportsDashlet/dashletConfigure.tpl');
        ob_clean();
        return $optionsSmarty->fetch($optionsTemplate);
    }
    public function saveOptions($req) {
//        if(count($req['parameter_value']) == 2) {
//            $firstValue = $req['parameter_value'][0];
//            $secondValue = $req['parameter_value'][1];
//            $req['parameter_value'][0] = $secondValue;
//            $req['parameter_value'][1] = $firstValue;
//        }
        $allowedKeys = array_flip(array('aor_report_id','dashletTitle','charts','onlyCharts','parameter_id','parameter_value','parameter_type','parameter_operator'));
        $intersected = array_intersect_key($req,$allowedKeys);
        return $intersected;
    }

    public function hasAccess() {
        return true;
    }
}
