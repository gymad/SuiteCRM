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


namespace SuiteCRM;

use PHPUnit_Framework_TestCase;

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
 * Description of StateChecker_PHPUnit_Framework_TestCase
 *
 * @author SalesAgility
 */
abstract class StateChecker_PHPUnit_Framework_TestCase extends PHPUnit_Framework_TestCase
{
   
    /**
     *
     * @var StateChecker
     */
    protected static $stateChecker = null;
    
    protected function saveStates() {
        if (StateCheckerConfig::get('testsUseStateChecker')) {
            if(null === self::$stateChecker) {
                self::$stateChecker = new StateChecker();
            }
        }
    }
    
    protected function checkStates() {
        if (StateCheckerConfig::get('testsUseStateChecker') && self::$stateChecker) {
            try {
                self::$stateChecker->getStateHash();
            } catch (StateCheckerException $e) {
                $message = 'Incorrect state hash: ' . $e->getMessage() . (StateCheckerConfig::get('saveTraces') ? "\nTrace:\n" . $e->getTraceAsString() . "\n" : '');
                if (StateCheckerConfig::get('testsUseAssertionFailureOnError')) {
                    self::assertFalse(true, $message);
                } else {
                    echo $message;
                }
            }
        }
    }
    
    public static function setUpBeforeClass()
    {
        if(StateCheckerConfig::get('testStateCheckMode') == StateCheckerConfig::RUN_PER_CLASSES) {
            self::saveStates();
        }
        
        parent::setUpBeforeClass();
    }
    
    public static function tearDownAfterClass()
    {        
        parent::tearDownAfterClass();
           
        if(StateCheckerConfig::get('testStateCheckMode') == StateCheckerConfig::RUN_PER_CLASSES) {
            self::checkStates();
        }
    }
    
    /**
     * Collect state information and storing a hash
     */
    public function setUp()
    {
        if(StateCheckerConfig::get('testStateCheckMode') == StateCheckerConfig::RUN_PER_TESTS) {
            self::saveStates();
        }
        
        parent::setUp();
    }
    
    /**
     * Collect state information and comparing hash
     */
    public function tearDown()
    {        
        parent::tearDown();
           
        if(StateCheckerConfig::get('testStateCheckMode') == StateCheckerConfig::RUN_PER_TESTS) {
            self::checkStates();
        }
    }
}