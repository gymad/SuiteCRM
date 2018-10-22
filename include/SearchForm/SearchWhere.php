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


/**
 * SearchWhere
 *
 * @author gyula
 */
class SearchWhere
{
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
    public function generateSearchWhere(SearchForm $form, $add_custom_fields = false, $module = '')
    {
        global $timedate;

        $db = $form->seed->db;
        $form->searchColumns = array();
        $values = $form->searchFields;

        $where_clauses = array();
        $like_char = '%';
        $table_name = $form->seed->object_name;
        $form->seed->fill_in_additional_detail_fields();

        //rrs check for team_id

        foreach ((array)$form->searchFields as $field => $parms) {
            $customField = false;
            // Jenny - Bug 7462: We need a type check here to avoid database errors
            // when searching for numeric fields. This is a temporary fix until we have
            // a generic search form validation mechanism.
            $type = (!empty($form->seed->field_name_map[$field]['type'])) ? $form->seed->field_name_map[$field]['type'] : '';

            //If range search is enabled for the field, we first check if this is the starting range
            if (!empty($parms['enable_range_search']) && empty($type)) {
                if (preg_match('/^start_range_(.*?)$/', $field, $match)) {
                    $real_field = $match[1];
                    $start_field = 'start_range_' . $real_field;
                    $end_field = 'end_range_' . $real_field;

                    if ($this->isSearchFieldHasStartEndValue($form->searchFields, $start_field, $end_field)) {
                        $form->searchFields = $this->updateFormSearchFields($form->searchFields, $real_field, $start_field, $end_field);
                        $parms = $this->updateParamsValueAndOperator($parms, $form->searchFields, $real_field);
                        $type = $this->updateTypeIfDateTime($type, $form->seed->field_name_map, $real_field);
                        $field = $real_field;
                        unset($form->searchFields[$end_field]['value']);
                    } else {
                        //if both start and end ranges have not been defined, skip this filter.
                        continue;
                    }
                } elseif (preg_match('/^range_(.*?)$/', $field, $match) && isset($form->searchFields[$field]['value'])) {
                    $real_field = $match[1];

                    //Special case for datetime and datetimecombo fields.  By setting the type here we allow an actual between search
                    if (in_array($parms['operator'], array('=', 'between', "not_equal", 'less_than', 'greater_than', 'less_than_equals', 'greater_than_equals'))) {
                        $field_type = isset($form->seed->field_name_map[$real_field]['type']) ? $form->seed->field_name_map[$real_field]['type'] : '';
                        if (strtolower($field_type) == 'readonly' && isset($form->seed->field_name_map[$real_field]['dbType'])) {
                            $field_type = $form->seed->field_name_map[$real_field]['dbType'];
                        }
                        if ($field_type == 'datetimecombo' || $field_type == 'datetime' || $field_type == 'int') {
                            $type = $field_type;
                        }
                    }

                    $form->searchFields[$real_field]['value'] = $form->searchFields[$field]['value'];
                    $form->searchFields[$real_field]['operator'] = $form->searchFields[$field]['operator'];
                    $params['value'] = $form->searchFields[$field]['value'];
                    $params['operator'] = $form->searchFields[$field]['operator'];
                    unset($form->searchFields[$field]['value']);
                    $field = $real_field;
                } else {
                    //Skip this range search field, it is the end field THIS IS NEEDED or the end range date will break the query
                    continue;
                }
            }

            //Test to mark whether or not the field is a custom field
            if (!empty($form->seed->field_name_map[$field]['source'])
                && ($form->seed->field_name_map[$field]['source'] == 'custom_fields' ||
                    //Non-db custom fields, such as custom relates
                    ($form->seed->field_name_map[$field]['source'] == 'non-db'
                        && (!empty($form->seed->field_name_map[$field]['custom_module']) ||
                            isset($form->seed->field_name_map[$field]['ext2']))))
            ) {
                $customField = true;
            }

            if ($type == 'int' && isset($parms['value']) && !empty($parms['value'])) {
                require_once('include/SugarFields/SugarFieldHandler.php');
                $intField = SugarFieldHandler::getSugarField('int');
                $newVal = $intField->getSearchWhereValue($parms['value']);
                $parms['value'] = $newVal;
            } elseif ($type == 'html' && $customField) {
                continue;
            }


            if (isset($parms['value']) && $parms['value'] != "") {
                $operator = $db->isNumericType($type) ? '=' : 'like';
                if (!empty($parms['operator'])) {
                    $operator = strtolower($parms['operator']);
                }

                if (is_array($parms['value'])) {
                    $field_value = '';

                    // always construct the where clause for multiselects using the 'like' form to handle combinations of multiple $vals and multiple $parms
                    if ($this->isFieldNameMapMultiSelectAtField($form->seed->field_name_map, $field)) {
                        // construct the query for multenums
                        // use the 'like' query as both custom and OOB multienums are implemented with types that cannot be used with an 'in'
                        $operator = 'custom_enum';
                        // Relationshipfields get their field name directly from the field name map,
                        // this alias-name is automatically replaced by the join table and rname through sugarbean::create_new_list_query
                        $db_field = $this->getDbField($form->seed->field_name_map, $field, $form->seed->table_name, $customField);
                        
                        $field_value = $this->updateFieldValueByParamsValue($db, $field_value, $params['value'], $db_field);
                    } else {
                        $operator = $operator != 'subquery' ? 'in' : $operator;
                        foreach ($parms['value'] as $val) {
                            if ($val != ' ' && $val != '') {
                                if (!empty($field_value)) {
                                    $field_value .= ',';
                                }
                                if ($operator == 'subquery') {
                                    $field_value .= $val;
                                } else {
                                    $field_value .= $db->quoteType($type, $val);
                                }
                            }
                            // Bug 41209: adding a new operator "isnull" here
                            // to handle the case when blank is selected from dropdown.
                            // In that case, $val is empty.
                            // When $val is empty, we need to use "IS NULL",
                            // as "in (null)" won't work
                            elseif ($operator == 'in') {
                                $operator = 'isnull';
                            }
                        }
                    }
                } else {
                    $field_value = $parms['value'];
                }

                //set db_fields array.
                if (!isset($parms['db_field'])) {
                    $parms['db_field'] = array($field);
                }

                //This if-else block handles the shortcut checkbox selections for "My Items" and "Closed Only"
                if (!empty($parms['my_items'])) {
                    if ($parms['value'] == false) {
                        continue;
                    }
                    //my items is checked.
                    global $current_user;
                    $field_value = $db->quote($current_user->id);
                    $operator = '=';
                } elseif (!empty($parms['closed_values']) && is_array($parms['closed_values'])) {
                    if ($parms['value'] == false) {
                        continue;
                    }
                    $field_value = '';
                    foreach ($parms['closed_values'] as $closed_value) {
                        $field_value .= "," . $db->quoted($closed_value);
                    }
                    $field_value = substr($field_value, 1);
                } elseif (!empty($parms['checked_only']) && $parms['value'] == false) {
                    continue;
                }

                $where = '';
                $itr = 0;

                if ($field_value != '' || $operator == 'isnull') {
                    $form->searchColumns [strtoupper($field)] = $field;

                    foreach ($parms['db_field'] as $db_field) {
                        if (strstr($db_field, '.') === false) {
                            //Try to get the table for relate fields from link defs
                            if ($type == 'relate' && !empty($form->seed->field_name_map[$field]['link'])
                                && !empty($form->seed->field_name_map[$field]['rname'])
                            ) {
                                $link = $form->seed->field_name_map[$field]['link'];
                                if (($form->seed->load_relationship($link))) {
                                    //Martin fix #27494
                                    $db_field = $form->seed->field_name_map[$field]['name'];
                                } else {
                                    //Best Guess for table name
                                    $db_field = strtolower($link['module']) . '.' . $db_field;
                                }
                            } elseif ($type == 'parent') {
                                if (!empty($form->searchFields['parent_type'])) {
                                    $parentType = $form->searchFields['parent_type'];
                                    $rel_module = $parentType['value'];
                                    global $beanFiles, $beanList;
                                    if (!empty($beanFiles[$beanList[$rel_module]])) {
                                        require_once($beanFiles[$beanList[$rel_module]]);
                                        $rel_seed = new $beanList[$rel_module]();
                                        $db_field = 'parent_' . $rel_module . '_' . $rel_seed->table_name . '.name';
                                    }
                                }
                            } // Relate fields in custom modules and custom relate fields
                            elseif ($type == 'relate' && $customField && !empty($form->seed->field_name_map[$field]['module'])) {
                                $db_field = !empty($form->seed->field_name_map[$field]['name']) ? $form->seed->field_name_map[$field]['name'] : 'name';
                            } elseif (!$customField) {
                                if (!empty($form->seed->field_name_map[$field]['db_concat_fields'])) {
                                    $db_field = $db->concat($form->seed->table_name, $form->seed->field_name_map[$db_field]['db_concat_fields']);
                                }
                                // Relationship fields get the name directly from the field_name_map
                                elseif (!(isset($form->seed->field_name_map[$db_field]) && isset($form->seed->field_name_map[$db_field]['source']) && $form->seed->field_name_map[$db_field]['source'] == 'non-db')) {
                                    $db_field = $form->seed->table_name . "." . $db_field;
                                }
                            } else {
                                if (!empty($form->seed->field_name_map[$field]['db_concat_fields'])) {
                                    $db_field = $db->concat($form->seed->table_name . "_cstm.", $form->seed->field_name_map[$db_field]['db_concat_fields']);
                                } else {
                                    $db_field = $form->seed->table_name . "_cstm." . $db_field;
                                }
                            }
                        }

                        if ($type == 'date') {
                            // The regular expression check is to circumvent special case YYYY-MM
                            $operator = '=';
                            if (preg_match('/^\d{4}.\d{1,2}$/', $field_value) != 0) { // preg_match returns number of matches
                                $db_field = $form->seed->db->convert($db_field, "date_format", array("%Y-%m"));
                            } else {
                                $field_value = $timedate->to_db_date($field_value, false);
                                $db_field = $form->seed->db->convert($db_field, "date_format", array("%Y-%m-%d"));
                            }
                        }

                        if ($type == 'datetime' || $type == 'datetimecombo') {
                            try {
                                if ($operator == '=' || $operator == 'between') {
                                    // FG - bug45287 - If User asked for a range, takes edges from it.
                                    $placeholderPos = strpos($field_value, "<>");
                                    if ($placeholderPos !== false && $placeholderPos > 0) {
                                        $datesLimit = explode("<>", $field_value);
                                        $dateStart = $timedate->getDayStartEndGMT($datesLimit[0]);
                                        $dateEnd = $timedate->getDayStartEndGMT($datesLimit[1]);
                                        $dates = $dateStart;
                                        $dates['end'] = $dateEnd['end'];
                                        $dates['enddate'] = $dateEnd['enddate'];
                                        $dates['endtime'] = $dateEnd['endtime'];
                                    } else {
                                        $dates = $timedate->getDayStartEndGMT($field_value);
                                    }
                                    // FG - bug45287 - Note "start" and "end" are the correct interval at GMT timezone
                                    $field_value = array($dates["start"], $dates["end"]);
                                    $operator = 'between';
                                } elseif ($operator == 'not_equal') {
                                    $dates = $timedate->getDayStartEndGMT($field_value);
                                    $field_value = array($dates["start"], $dates["end"]);
                                    $operator = 'date_not_equal';
                                } elseif ($operator == 'greater_than') {
                                    $dates = $timedate->getDayStartEndGMT($field_value);
                                    $field_value = $dates["end"];
                                } elseif ($operator == 'less_than') {
                                    $dates = $timedate->getDayStartEndGMT($field_value);
                                    $field_value = $dates["start"];
                                } elseif ($operator == 'greater_than_equals') {
                                    $dates = $timedate->getDayStartEndGMT($field_value);
                                    $field_value = $dates["start"];
                                } elseif ($operator == 'less_than_equals') {
                                    $dates = $timedate->getDayStartEndGMT($field_value);
                                    $field_value = $dates["end"];
                                }
                            } catch (Exception $timeException) {
                                //In the event that a date value is given that cannot be correctly processed by getDayStartEndGMT method,
                                //just skip searching on this field and continue.  This may occur if user switches locale date formats
                                //in another browser screen, but re-runs a search with the previous format on another screen
                                $GLOBALS['log']->error($timeException->getMessage());
                                continue;
                            }
                        }

                        if ($type == 'decimal' || $type == 'float' || $type == 'currency' || (!empty($parms['enable_range_search']) && empty($parms['is_date_field']))) {
                            require_once('modules/Currencies/Currency.php');

                            //we need to handle formatting either a single value or 2 values in case the 'between' search option is set
                            //start by splitting the string if the between operator exists
                            $fieldARR = explode('<>', $field_value);
                            //set the first pass through boolean
                            $values = array();
                            foreach ($fieldARR as $fv) {
                                //reset the field value, it will be rebuild in the foreach loop below
                                $tmpfield_value = unformat_number($fv);

                                if ($type == 'currency' && stripos($field, '_usdollar') !== false) {
                                    // It's a US Dollar field, we need to do some conversions from the user's local currency
                                    $currency_id = $GLOBALS['current_user']->getPreference('currency');
                                    if (empty($currency_id)) {
                                        $currency_id = -99;
                                    }
                                    if ($currency_id != -99) {
                                        $currency = new Currency();
                                        $currency->retrieve($currency_id);
                                        $tmpfield_value = $currency->convertToDollar($tmpfield_value);
                                    }
                                }
                                $values[] = $tmpfield_value;
                            }

                            $field_value = join('<>', $values);

                            if (!empty($parms['enable_range_search']) && $parms['operator'] == '=' && $type != 'int') {
                                // Databases can't really search for floating point numbers, because they can't be accurately described in binary,
                                // So we have to fuzz out the math a little bit
                                $field_value = array(($field_value - 0.01), ($field_value + 0.01));
                                $operator = 'between';
                            }
                        }


                        if ($db->supports("case_sensitive") && isset($parms['query_type']) && $parms['query_type'] == 'case_insensitive') {
                            $db_field = 'upper(' . $db_field . ")";
                            $field_value = strtoupper($field_value);
                        }

                        $itr++;
                        if (!empty($where)) {
                            $where .= " OR ";
                        }

                        //Here we make a last attempt to determine the field type if possible
                        if (empty($type) && isset($parms['db_field']) && isset($parms['db_field'][0]) && isset($form->seed->field_defs[$parms['db_field'][0]]['type'])) {
                            $type = $form->seed->field_defs[$parms['db_field'][0]]['type'];
                        }

                        switch (strtolower($operator)) {
                            case 'subquery':
                                $in = 'IN';
                                if (isset($parms['subquery_in_clause'])) {
                                    if (!is_array($parms['subquery_in_clause'])) {
                                        $in = $parms['subquery_in_clause'];
                                    } elseif (isset($parms['subquery_in_clause'][$field_value])) {
                                        $in = $parms['subquery_in_clause'][$field_value];
                                    }
                                }
                                $sq = $parms['subquery'];
                                if (is_array($sq)) {
                                    $and_or = ' AND ';
                                    if (isset($sq['OR'])) {
                                        $and_or = ' OR ';
                                    }
                                    $first = true;
                                    foreach ($sq as $q) {
                                        if (empty($q) || strlen($q) < 2) {
                                            continue;
                                        }
                                        if (!$first) {
                                            $where .= $and_or;
                                        }
                                        $where .= " {$db_field} $in ({$q} " . $form->seed->db->quoted($field_value . '%') . ") ";
                                        $first = false;
                                    }
                                } elseif (!empty($parms['query_type']) && $parms['query_type'] == 'format') {
                                    $stringFormatParams = array(0 => $field_value, 1 => $GLOBALS['current_user']->id);
                                    $where .= "{$db_field} $in (" . string_format($parms['subquery'], $stringFormatParams) . ")";
                                } else {
                                    //Bug#37087: Re-write our sub-query to it is executed first and contents stored in a derived table to avoid mysql executing the query
                                    //outside in. Additional details: http://bugs.mysql.com/bug.php?id=9021
                                    $selectCol = ' * ';
                                    //use the select column in the subquery if it exists
                                    if (!empty($parms['subquery'])) {
                                        $selectCol = $form->getSelectCol($parms['subquery']);
                                    }
                                    $where .= "{$db_field} $in (select $selectCol from ({$parms['subquery']} " . $form->seed->db->quoted($field_value . '%') . ") {$field}_derived)";
                                }

                                break;

                            case 'like':
                                if ($type == 'bool' && $field_value == 0) {
                                    // Bug 43452 - FG - Added parenthesis surrounding the OR (without them the WHERE clause would be broken)
                                    $where .= "( " . $db_field . " = '0' OR " . $db_field . " IS NULL )";
                                } else {
                                    // check to see if this is coming from unified search or not
                                    $UnifiedSearch = !empty($parms['force_unifiedsearch']);
                                    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'UnifiedSearch') {
                                        $UnifiedSearch = true;
                                    }

                                    // If it is a unified search and if the search contains more then 1 word (contains space)
                                    // and if it's the last element from db_field (so we do the concat only once, not for every db_field element)
                                    // we concat the db_field array() (both original, and in reverse order) and search for the whole string in it
                                    if ($UnifiedSearch && strpos($field_value, ' ') !== false && strpos($db_field, $parms['db_field'][count($parms['db_field']) - 1]) !== false) {
                                        // Get the table name used for concat
                                        $concat_table = explode('.', $db_field);
                                        $concat_table = $concat_table[0];
                                        // Get the fields for concatenating
                                        $concat_fields = $parms['db_field'];

                                        // If db_fields (e.g. contacts.first_name) contain table name, need to remove it
                                        for ($i = 0; $i < count($concat_fields); $i++) {
                                            if (strpos($concat_fields[$i], $concat_table) !== false) {
                                                $concat_fields[$i] = substr($concat_fields[$i], strlen($concat_table) + 1);
                                            }
                                        }

                                        // Concat the fields and search for the value
                                        $where .= $form->seed->db->concat($concat_table, $concat_fields) . " LIKE " . $form->seed->db->quoted($field_value . $like_char);
                                        $where .= ' OR ' . $form->seed->db->concat($concat_table, array_reverse($concat_fields)) . " LIKE " . $form->seed->db->quoted($field_value . $like_char);
                                    } else {
                                        //Check if this is a first_name, last_name search
                                        if (isset($form->seed->field_name_map) && isset($form->seed->field_name_map[$db_field])) {
                                            $field_value = $this->updateFieldValueByVardefEntry($field_value, $form->seed->field_name_map[$db_field]);
                                        }
                                        //field is not last name or this is not from global unified search, so do normal where clause
                                        $where .= $db_field . " like " . $form->seed->db->quoted(sql_like_string($field_value, $like_char));
                                    }
                                }
                                break;
                            case 'not in':
                                $where .= $db_field . ' not in (' . $field_value . ')';
                                break;
                            case 'in':
                                $where .= $db_field . ' in (' . $field_value . ')';
                                break;
                            case '=':
                                if ($type == 'bool' && $field_value == 0) {
                                    $where .= "($db_field = 0 OR $db_field IS NULL)";
                                } else {
                                    $where .= $db_field . " = " . $db->quoteType($type, $field_value);
                                }
                                break;
                            // tyoung bug 15971 - need to add these special cases into the $where query
                            case 'custom_enum':
                                $where .= $field_value;
                                break;
                            case 'between':
                                if (!is_array($field_value)) {
                                    $field_value = explode('<>', $field_value);
                                }
                                $field_value[0] = $db->quoteType($type, $field_value[0]);
                                $field_value[1] = $db->quoteType($type, $field_value[1]);
                                $where .= "($db_field >= {$field_value[0]} AND $db_field <= {$field_value[1]})";
                                break;
                            case 'date_not_equal':
                                if (!is_array($field_value)) {
                                    $field_value = explode('<>', $field_value);
                                }
                                $field_value[0] = $db->quoteType($type, $field_value[0]);
                                $field_value[1] = $db->quoteType($type, $field_value[1]);
                                $where .= "($db_field IS NULL OR $db_field < {$field_value[0]} OR $db_field > {$field_value[1]})";
                                break;
                            case 'innerjoin':
                                $form->seed->listview_inner_join[] = $parms['innerjoin'] . " '" . $parms['value'] . "%')";
                                break;
                            case 'not_equal':
                                $field_value = $db->quoteType($type, $field_value);
                                $where .= "($db_field IS NULL OR $db_field != $field_value)";
                                break;
                            case 'greater_than':
                                $field_value = $db->quoteType($type, $field_value);
                                $where .= "$db_field > $field_value";
                                break;
                            case 'greater_than_equals':
                                $field_value = $db->quoteType($type, $field_value);
                                $where .= "$db_field >= $field_value";
                                break;
                            case 'less_than':
                                $field_value = $db->quoteType($type, $field_value);
                                $where .= "$db_field < $field_value";
                                break;
                            case 'less_than_equals':
                                $field_value = $db->quoteType($type, $field_value);
                                $where .= "$db_field <= $field_value";
                                break;
                            case 'next_7_days':
                            case 'last_7_days':
                            case 'last_month':
                            case 'this_month':
                            case 'next_month':
                            case 'last_30_days':
                            case 'next_30_days':
                            case 'this_year':
                            case 'last_year':
                            case 'next_year':
                                if (!empty($field) && !empty($form->seed->field_name_map[$field]['type'])) {
                                    $where .= $form->parseDateExpression(strtolower($operator), $db_field, $form->seed->field_name_map[$field]['type']);
                                } else {
                                    $where .= $form->parseDateExpression(strtolower($operator), $db_field);
                                }
                                break;
                            case 'isnull':
                                $where .= "($db_field IS NULL OR $db_field = '')";
                                if ($field_value != '') {
                                    $where .= ' OR ' . $db_field . " in (" . $field_value . ')';
                                }
                                break;
                        }
                    }
                }

                if (!empty($where)) {
                    if ($itr > 1) {
                        array_push($where_clauses, '( ' . $where . ' )');
                    } else {
                        array_push($where_clauses, $where);
                    }
                }
            }
        }

        return $where_clauses;
    }
    
    protected function isSearchFieldHasStartEndValue($searchFields, $startField, $endField)
    {
        $ret = isset($searchFields[$startField]['value']) && isset($searchFields[$endField]['value']);
        return $ret;
    }
                            
    protected function updateFormSearchFields($searchFields, $realField, $startField, $endField)
    {
        $searchFields[$realField]['value'] = $searchFields[$startField]['value'] . '<>' . $searchFields[$endField]['value'];
        $searchFields[$realField]['operator'] = 'between';
        return $searchFields;
    }
    
    protected function updateParamsValueAndOperator($paramsArray, $searchFields, $realFields)
    {
        $paramsArray['value'] = $searchFields[$realFields]['value'];
        $paramsArray['operator'] = 'between';
        return $paramsArray;
    }
                        
    protected function updateTypeIfDateTime($type, $fieldNameMap, $realField)
    {
        $fieldType = $this->getFieldType($fieldNameMap, $realField);
        if ($fieldType == 'datetimecombo' || $fieldType == 'datetime') {
            $type = $fieldType;
        }
        return $type;
    }
                        
    protected function getFieldType($fieldNameMap, $realField)
    {
        $fieldType = isset($fieldNameMap[$realField]['type']) ? $fieldNameMap[$realField]['type'] : '';
        return $fieldType;
    }
    
    protected function isFieldNameMapMultiSelectAtField($fieldNameMap, $field)
    {
        $ret = !empty($fieldNameMap[$field]['isMultiSelect']) && $fieldNameMap[$field]['isMultiSelect'];
        return $ret;
    }
                    
    protected function getDbField($fieldNameMap, $field, $tableName, $customField)
    {
        if ($this->isFieldNameMapNonDbAtField($fieldNameMap, $field)) {
            $dbField = $fieldNameMap[$field]['name'];
        } else {
            $tableName = $this->updateTableName($tableName, $customField);
            $dbField = $tableName . "." . $field;
        }
        return $dbField;
    }
       
    protected function isFieldNameMapNonDbAtField($fieldNameMap, $field)
    {
        $ret = isset($fieldNameMap[$field]) &&
            isset($fieldNameMap[$field]['source']) &&
            $fieldNameMap[$field]['source'] == 'non-db';
        return $ret;
    }
                            
    protected function updateTableName($tableName, $customField)
    {
        if ($customField) {
            $tableName .= "_cstm";
        }
        return $tableName;
    }
    
    protected function updateFieldValueByParamsValue($db, $fieldValue, $paramsValue, $dbField)
    {
        foreach ($paramsValue as $val) {
            if ($val != ' ' and $val != '') {
                $qVal = $db->quote($val);
                if (!empty($fieldValue)) {
                    $fieldValue .= ' or ';
                }
                $fieldValue .= "$dbField like '%^$qVal^%'";
            } else {
                $fieldValue .= '(' . $dbField . ' IS NULL or ' . $dbField . "='^^' or " . $dbField . "='')";
            }
        }
                            
        return $fieldValue;
    }
                        
    protected function updateFieldValueByVardefEntry($fieldValue, $vardefEntry)
    {
        if (!empty($vardefEntry['db_concat_fields']) && in_array('first_name', $vardefEntry['db_concat_fields']) && in_array('last_name', $vardefEntry['db_concat_fields'])) {
            if (!empty($GLOBALS['app_list_strings']['salutation_dom']) && is_array($GLOBALS['app_list_strings']['salutation_dom'])) {
                $fieldValue = $this->updateFieldValueBySalutationDom($fieldValue, $GLOBALS['app_list_strings']['salutation_dom']);
            }
        }
        return $fieldValue;
    }
                                            
    protected function updateFieldValueBySalutationDom($fieldValue, $salutationDom)
    {
        foreach ($salutationDom as $salutation) {
            if ($this->isSalutationInFieldValue($salutation, $fieldValue)) {
                $fieldValue = trim(substr($fieldValue, strlen($salutation)));
                break;
            }
        }
        return $fieldValue;
    }
    
    protected function isSalutationInFieldValue($salutation, $fieldValue)
    {
        $ret = !empty($salutation) && strpos($fieldValue, $salutation) === 0;
        return $ret;
    }
}
