<?php
/**
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

    header('Content-Type: text/css');
// config|_override.php
if (is_file('../../../config.php')) {
    require_once '../../../config.php';
}

// load up the config_override.php file.  This is used to provide default user settings
if (is_file('../../../config_override.php')) {
    require_once '../../../config_override.php';
}

if (!isset($sugar_config['theme_settings']['SuiteP'])) {
    return;
}

//set file type back to css from php
header('Content-type: text/css; charset: UTF-8');

?>

/* ---- LBL_COLOUR_SUITEP_1 ---- */

body,
.evenListRowS1 td,
table#actionLines > tr > td > table, #line_items table > tr > td > table,
div.list-view-rounded-corners > table,
tr#pagination
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_1']; ?> !important;
}


div.p_login,
div.p_login .p_login_middle,
#bootstrap-container,
.detail-view-field,
.other.view td:nth-of-type(3),
.other.view td:nth-of-type(4)
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_1']; ?> !important;
}

#actionMenuSidebar li a
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_1']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_2 ---- */

body,
a#admin_options, a#powered_by,
.detail-view-row .label, .edit-view-row .label,
.detail-view-field,
#EditView .edit tr td,
#EditView .edit input, #EditView .edit textarea, #EditView .edit select,
.label,
fieldset label,
.required a:hover, .error a:hover,
.moduleTitle h2,
.evenListRowS1 td, .oddListRowS1 td
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_2']; ?> !important;
}

div.p_login .p_login_top,
li#usermenu a
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_2']; ?> !important;
}

.navbar-inverse,
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_2']; ?> !important;
}


ul.nav li.topnav a
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_2']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_3 ---- */


div.p_login .p_login_bottom,
footer,
table#mass_update_table,
.search_form .view,
form#MassAssign_SecurityGroups
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_3']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_4 ---- */

div.p_login #loginform .input-group,
div.p_login #loginform .input-group input
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_4']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_5 ---- */

div.p_login #loginform .input-group input,
.menuItemHilite,
.other.view td:nth-of-type(1),
.other.view td:nth-of-type(2),
#scheduler .schedulerDiv table tr.schedulerAttendeeRow td.schedulerSlotCellStartTime,
.olFgClass td, #forecastsWorksheet .olBgClass td.olFgClass,
.dashletPanelMenu.wizard.import .bd .screen
.detail tr td,
.detail .edit td,
.other td,
.monthViewDayHeight td,
.monthCalBodyDayItem,
.monthCalBody td,
.subpanelTabForm,
ul.tablist li a, ul.subpanelTablist li a,
div.tab-content,
#overlay,
.button-primary .badge,
.button .badge,
select, select:focus, select::selection, .saved_search_select,
.calcell > a
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

div#pageContainer td.dashletcontainer div.hd .icon {
    fill: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

#globalLinks ul.user-dropdown li a,
#actionMenuSidebar ul li a:hover,
#recentlyViewedSidebar li a, #favoritesSidebar li a,
#recentlyViewedSidebar h2, #favoritesSidebar h2,
#selectLinkTop > .sugar_action_button > ul.subnav,
#selectLinkTop > .sugar_action_button > ul.subnav li,
#selectLinkTop > .sugar_action_button > ul.subnav a,
#actionLinkTop ul.clickMenu li ul.subnav,
#actionLinkTop > .sugar_action_button > ul.subnav,
#actionLinkTop > .sugar_action_button > ul.subnav li,
#actionLinkTop > .sugar_action_button > ul.subnav a
#selectLinkBottom > .sugar_action_button > ul.subnav,
#selectLinkBottom > .sugar_action_button > ul.subnav li,
#selectLinkBottom > .sugar_action_button > ul.subnav a,
#actionLinkBottom ul.clickMenu li ul.subnav,
#actionLinkBottom > .sugar_action_button > ul.subnav,
#actionLinkBottom > .sugar_action_button > ul.subnav li,
#actionLinkBottom > .sugar_action_button > ul.subnav a ,
#actionLinkTop .menuItem,
#actionLinkBottom .menuItem,
#selectLinkTop > .sugar_action_button > ul.subnav a,
#actionLinkBottom > .sugar_action_button > ul.subnav a,
ul#dashletCategories > li a,
ul#dashletCategories > li a:link,
ul#dashletCategories > li a:hover,
ul#dashletCategories > li a:visited,
ul#dashletCategories > li a:active,
ul#dashletCategories > li a:focus,
ul#dashletCategories > li.active a,
ul#dashletCategories > li.active a:link,
ul#dashletCategories > li.active a:hover,
ul#dashletCategories > li.active a:visited,
ul#dashletCategories > li.active a:active,
ul#dashletCategories > li.active a:focus,
.monthHeader,
.monthCalBody > .calSharedUser,
thead.fc-head,
.fc-day-number,
.required, .error,
.required a:link, .error a:link,
.pageNumbers,
#goto_date_trigger_div_nav_cancel,
#goto_date_trigger_div_nav_submit,
.yui-calendar a.calnav,
.yui-calendar a.calnavleft, .yui-calendar a.calnavright,
.yui-calendar td.calcell.selected,
.yui-calendar td.calcell.selected a,
.yui-calendar td.calcell a:hover,
.yui-calendar td.calcell.calcellhover,
.yui-calendar td.calcell.calcellhover a,
.yui-calendar .calweekdaycell,
#globalLinks a,
#globalLinks ul li a:hover,
.pagination button [title="Return to List"]:hover
.list tr.pagination td table td a:link,
.list tr.pagination td table td a:visited,
.reportGroupByDataChildTablelistViewThS1 a:link,
.reportGroupByDataChildTablelistViewThS1 a:visited,
.list tr th,
.list tr th a:link,
.list tr th a:visited,
.list tr td[scope=col],
.list tr td[scope=col] a:link,
.list tr td[scope=col] a:visited,
.list tr.pagination td table td span.pageNumbers,
ul.nav-tabs > li > a, ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li:first-of-type > a,
ul.nav-tabs > li:first-of-type > a:hover,
ul.nav-tabs > li > a:hover,
ul.nav-tabs > li.active > a,  ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li.active > a:hover,
li#tab-actions > a:hover,
span#selectedRecordsTop,
ul.clickMenu,
ul.clickMenu > li, ul.SugarActionMenuIESub li,
ul.SugarActionMenuIESub li a,
ul.clickMenu li a, .list tr.pagination td.buttons ul.clickMenu > li > a:link, .list tr.pagination td.buttons ul.clickMenu > li > a,
.list tr.pagination td.buttons ul.clickMenu:hover > li > a:link, .list tr.pagination td.buttons ul.clickMenu:hover > li > a,
#quickCreate ul.clickMenu li ul.subnav li a:hover, #globalLinksModule ul.clickMenu li ul.subnav li a:hover, #quickCreate ul.clickMenu li ul.subnav li.moduleMenuOverFlowMore a:hover, #quickCreate ul.clickMenu li ul.subnav li.moduleMenuOverFlowLess a:hover,
a#create_link.utilsLink,
a#delete_listview_top:hover,
#moduleDashletsList a, #basicChartDashletsList a, #toolsDashletsList a, #webDashletsList a,
.headerlinks a:link, .headerlinks a:visited,
.btn-default, .btn-default:hover, .btn-default:active, .btn-default:focus,
.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus,
.btn-info, .btn-info:hover, .btn-info:active, .btn-info:focus,
.btn-success, .btn-success:hover, .btn-success:active, .btn-success:focus,
.dropdown-menu li a,
.dropdown-menu li a:hover,
.recent_h3,
.hr,
.moremenu a,
.moremenu ul li a:hover,
.button, input[type=submit], input[type=button], input[type=reset],
.paginationTable .button, .paginationTable input[type=submit], .paginationTable input[type=button], .paginationChangeButtons button[type=submit],
.button:hover,
.button:focus,
.button.focus,
.button:active,
.button.active,
.open > .dropdown-toggle.btn-primary,
.navbar-inverse .navbar-brand,
.headerlinks a:hover,
#searchform button,
a#advanced_search_link,
a#basic_search_link,
div#search_form > div.advanced input.button,
li.recentlinks_topedit a:focus,
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus,
.dashletPanel .h3Row,
.dashletPanel .h3Row h3,
#quickcreatetop a,
#quickcreatetop ul li a:hover,
#desktop_notifications span.alert_count,
#desktop_notifications div.dropdown-menu,
.panel-default > .panel-heading > div,
.panel-default > .panel-heading > a,
.panel-default.sub-panel > .panel-heading  > a,
td.paginationChangeButtons,
.icon-btn-lst .icon-btn a,
.sugar_action_button a
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

.calendar tbody .day,
.calendar tbody .rowhilite td.wn,
.teamNoticeBox,
.x-sqs-list-inner,
.oddListRowS1 td,
ul.subpanelTablist li a.current, ul.subpanelTablist li a.current:hover,
#ajaxStatusDiv,
.tabForm
.search_form input[type=text], .search_form textarea,
.ui-widget-header,
.qtip,
#importOptions #chooser_choose_index_text, #importOptions #chooser_ignore_index
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

.calendar tfoot .ttip,
.calendar thead .title
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

.calendar thead .hilite
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

ul.subpanelTablist li a.current, ul.subpanelTablist li a.current:hover,
.yearCalBodyMonth,
ul.nav-tabs > li > a, ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li:first-of-type > a:hover,
ul.nav-tabs > li > a:hover,
ul.nav-tabs > li.active > a,  ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li.active > a:hover,
.calendar thead .hilite,
li#tab-actions > a
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

.x-sqs-list-item
{
border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
}

@media (max-width: 1560px) {
    #searchformdropdown button
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
}

@media (max-width: 1250px) {
    #mobile_menu a
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
}

@media (max-width: 340px) {
    #mobilegloballinks a,
    #userlinks_head
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
}

@media (max-width: 980px) {
    ul.navbar-nav li a, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
}

@media (max-width: 1399px) {
    #searchformdropdown button,
    #tiptip_content
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }

    #tiptip_holder.tip_top #tiptip_arrow {
        border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
    #tiptip_holder.tip_bottom #tiptip_arrow {
        border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
    #tiptip_holder.tip_right #tiptip_arrow {
        border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
    #tiptip_holder.tip_left #tiptip_arrow {
        border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_5']; ?> !important;
    }
}


/* ---- LBL_COLOUR_SUITEP_6 ---- */

div.p_login #loginform span.error,
li#usermenu a:hover,
#globalLinks ul.user-dropdown li a:hover,
.yui-calendar .calbody td, .yui-calendar td.calcell a,
#globalLinks ul li a,
#globalLinksModule ul.clickMenu.SugarActionMenu li a:hover,
#globalLinksModule ul.clickMenu li:hover span,
ul.SugarActionMenuIESub li a:hover, ul.clickMenu.SugarActionMenu li a:hover, ul.clickMenu.SugarActionMenu li span.subhover:hover,
ul#globalLinksSubnav li a:hover, ul#quickCreateULSubnav li a:hover,
ul.clickMenu li ul.subnav li a:hover, ul.clickMenu li ul.subnav li input:hover, ul.clickMenu.subpanel.records li ul.subnav li a:hover, ul.clickMenu ul.subnav-sub li a:hover,
.button-primary .badge,
.dropdown-menu em a,
ul.nav li.topnav span.currentTab a,
li.topnav a:hover,
.moremenu ul li a,
.button .badge,
.ui-widget-content a,
#dashletbuttons,
.inlineEditIcon,
.sugar_action_button a:hover
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

.required, .error,
#goto_date_trigger_div_nav_cancel,
#goto_date_trigger_div_nav_submit,
li#tab-actions > a,
li#tab-actions > a:hover,
li#tab-actions > ul.dropdown-menu,
li#tab-actions > ul.dropdown-menu li,
li#tab-actions > ul.dropdown-menu a,
li#tab-actions > ul.dropdown-menu .button,
li#tab-actions > ul.dropdown-menu .button:hover,
li#tab-actions > ul.dropdown-menu .button:focus,
li#tab-actions > ul.dropdown-menu .button:active,
li#tab-actions > ul.dropdown-menu .open > .dropdown-toggle.btn-primary,
li#tab-actions > ul.dropdown-menu li:last-of-type a,
a#create_link.utilsLink,
#EditView_tabs .edit .button,
#ConvertLead .edit .button,
#EditView_tabs .id-ff-remove,
#ConvertLead .id-ff-remove,
#EditView_tabs .edit [type="button"],
#conditionLines [type="button"],
#actionLines [type="button"],
#deleteGroup img,
.btn-danger, .btn-danger:hover, .btn-danger:active, .btn-danger:focus,
.emailaddresses > tbody:nth-child(1) > tr > td:nth-child(1) button,
.button, input[type=submit], input[type=button], input[type=reset],
div#search_form > div.advanced input.button,
#desktop_notifications span.alert_count,
#desktop_notifications div.dropdown-menu,
.qtip-tipped .qtip-titlebar,
.icon-btn-lst .icon-btn,
#wizform .icon-btn-lst .icon-btn,
#wizform .progression-container .progression .nav-steps
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

.yui-calendar td.calcell.selected,
.yui-calendar td.calcell.selected a,
.yui-calendar td.calcell a:hover,
.yui-calendar td.calcell.calcellhover,
.yui-calendar td.calcell.calcellhover a,
ul.yui-nav li.selected,
.moremenu ul li a:hover,
.btn-success,
.yui-calendar td.calcell.selected,
.yui-calendar td.calcell.selected a,
.yui-calendar td.calcell a:hover,
.yui-calendar td.calcell.calcellhover,
.yui-calendar td.calcell.calcellhover a
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

.yearCalBodyMonth,
ul.nav li.topnav a:hover,
ul.nav li.topnav span.currentTab a,
li.topnav:hover > a
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

ul.tablist, ul.subpanelTablist {
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

#wizform .progression li::after {
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?>;
}

.subpanelTabForm,
ul.tablist li a:hover, ul.subpanelTablist li a:hover,
li#tab-actions > a,
select:focus,
#EditView_tabs .edit .button,
#ConvertLead .edit .button,
#EditView_tabs .id-ff-remove,
#ConvertLead .id-ff-remove,
#EditView_tabs .edit [type="button"],
#conditionLines [type="button"],
#actionLines [type="button"],
#deleteGroup img,
.btn-danger, .btn-danger:hover, .btn-danger:active, .btn-danger:focus
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

.icon,
.inlineEditIcon svg,
#inlineEditSaveButton svg,
#inlineEditSaveButton svg:hover
{
    fill: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
}

.qtip-tipped .qtip-titlebar
{
    background-image: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?>), to(#4286AD)); /* TODO !!! */
}

.qtip-tipped .qtip-titlebar
{
    background-image: -webkit-linear-gradient(top, #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?>, #4286AD); /* TODO !!! */
}


@media (max-width: 1250px) {
    #mobile_menu a:hover
    {
        color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
    }
}

@media (max-width: 480px) {
    #searchmobile #query_string
    {
        background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
    }
}

@media (min-width: 480px) and (max-width: 680px) {
    #searchmobile #query_string
    {
        background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_6']; ?> !important;
    }
}



/* ---- LBL_COLOUR_SUITEP_7 ---- */

div.p_login #loginform #bigbutton:hover,
td.listViewButtons input.button:hover,
.emailaddresses > tbody:nth-child(1) > tr > td:nth-child(1) button:hover,
td.submitButtons .button:hover,
div#search_form > div.advanced input.button:hover,
span.id-ff button:hover
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_7']; ?> !important;
}

a#admin_options:hover, a#powered_by:hover,
.footer_right a:hover,
.list tr.oddListRowS1 td.inlineEdit a:hover, .list tr.evenListRowS1 td.inlineEdit a:hover
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_7']; ?> !important;
}

.list tr.oddListRowS1 td.inlineEdit a:hover, .list tr.evenListRowS1 td.inlineEdit a:hover
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_7']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_8 ---- */

div#pageContainer td.dashletcontainer div.hd,
.dashletPanel .h3Row,
.panel-default > .panel-heading > div,
.panel-default > .panel-heading > a,
.panel-default.sub-panel > .panel-heading  > a
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_8']; ?> !important;
}

.yui-module .hd, .yui-panel .hd,
.yui-calendar .calhead,
.panel-default > .panel-heading
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_8']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_9 ---- */

div#pageContainer td.dashletcontainer tr.pagination td,
.list tr#pagination td table.paginationTable td.paginationActionButtons,
.list tr#pagination td table.paginationTable td.paginationChangeButtons,
ul#dashletCategories > li a,
ul#dashletCategories > li a:link,
ul#dashletCategories > li a:hover,
ul#dashletCategories > li a:visited,
ul#dashletCategories > li a:active,
ul#dashletCategories > li a:focus,
td.fc-widget-header,
td.fc-widget-header table > thead,
td.fc-widget-header table > thead > tr > th,
.list tr.pagination td table td,
div.monthFooter,
ul.nav-tabs > li > a, ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li:first-of-type > a,
ul.nav-tabs > li:first-of-type > a:hover,
ul.nav-tabs > li > a:hover,
.converted_account td,
div.panel-heading a.collapsed
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_9']; ?> !important;
}

table#goto_date_trigger_div_t thead,
.panel-default > .panel-heading-collapse
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_9']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_10 ---- */

div#pageContainer td.dashletcontainer tr.pagination td button,
#actionMenuSidebar li a,
.selectActionsDisabled,
.btn-default, .btn-default:hover, .btn-default:active, .btn-default:focus,
.paginationTable .button, .paginationTable input[type=submit], .paginationTable input[type=button], .paginationChangeButtons button[type=submit],
.paginationTable button[disabled], .paginationTable input[type="submit"][disabled], .paginationTable input[type="reset"][disabled], .paginationTable input[type="button"][disabled],.paginationChangeButtons button[type=submit][disabled],
#quickcreatetop a,
table.subpanel-table ul.subpanel > a,
.single  a,
.single > a,
#actionLinkTop li.sugar_action_button,
table.subpanel-table li.sugar_action_button,
#selectLinkTop li.sugar_action_button,
table.subpanel-table .pagination .sugar_action_button,
table.subpanel-table .pagination li.sugar_action_button > form > a,
table.subpanel-table .pagination .sugar_action_button > form > a,
table.subpanel-table .pagination .sugar_action_button > form > a
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_10']; ?> !important;
}

.btn-default, .btn-default:hover, .btn-default:active, .btn-default:focus
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_10']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_11 ---- */

.sidebar,
thead,
table#dashletPanel thead,
ul#dashletCategories > li.active a,
ul#dashletCategories > li.active a:link,
ul#dashletCategories > li.active a:hover,
ul#dashletCategories > li.active a:visited,
ul#dashletCategories > li.active a:active,
ul#dashletCategories > li.active a:focus,
a.first-tab-xs,
#first-tab-menu-xs.dropdown-menu,
#first-tab-menu-xs.dropdown-menu > li,
#first-tab-menu-xs.dropdown-menu > li > a,
ul.nav-tabs > li.active > a,  ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li.active > a:hover,
.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_11']; ?> !important;
}


.button-toggle-collapsed,
.button-toggle-expanded,
.monthHeader,
thead.fc-head,
#moduleDashletsList, #basicChartDashletsList, #toolsDashletsList, #webDashletsList
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_11']; ?> !important;
}


ul#dashletCategories,
.popupBody .list.view > thead > tr > th
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_11']; ?> !important;
}

.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_11']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_12 ---- */


#actionMenuSidebar ul li a:hover
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_12']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_13 ---- */

#recentlyViewedSidebar li:hover, #favoritesSidebar li:hover
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_13']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_14 ---- */


.footer_right a {
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_14']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_15 ---- */


.menuItem, .menuItemHilite, .menuItemX, .menuItemHiliteX,
.menuItem:visited, .menuItemHilite:visited, .menuItem:hover, .menuItemHilite:hover,
.menuItem:active, .menuItemHilite:active, .menuItem:link, .menuItemHilite:link,
.menuItemX:visited, .menuItemHiliteX:visited, .menuItemX:hover, .menuItemHiliteX:hover,
.menuItemX:active, .menuItemHiliteX:active, .menuItemX:link, .menuItemHiliteX:link,
#scheduler .schedulerDiv,
.calendar tfoot .ttip,
.calendar thead .title,
.calendar thead .weekend,
.aclOwner,
.x-dlg-btns button.x-btn-text:hover,
.x-dlg-btns .x-btn-focus button.x-btn-text,
ul.tablist li a.activeSubTab:hover,
ul.subpanelTablist li a.activeSubTab:hover,
.detail tr td[scope="row"],
.other td[scope=row],
.other td.edit,
.monthCalBody th a,
.yearCalBodyMonth > a,
.subpanelTabForm,
.detail508 tr td[scope="col"],
button[disabled]:hover, input[type=submit][disabled]:hover, input[type=reset][disabled]:hover, input[type=button][disabled]:hover,
#copyright_data a,
table.subpanel-table th,
table.subpanel-table th a:link
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_15']; ?> !important;
}

.wrapper
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_15']; ?> !important;
}


@media (max-width: 1399px) {
    #tiptip_content {
        text-shadow: 0 0 2px #<?php echo $sugar_config['theme_settings']['SuiteP']['color_15']; ?>;
        background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(transparent), to(#<?php echo $sugar_config['theme_settings']['SuiteP']['color_15']; ?>));
    }
}



/* ---- LBL_COLOUR_SUITEP_16 ---- */

.menuItem, .menuItemHilite, .menuItemX, .menuItemHiliteX,
.menuItem:visited, .menuItemHilite:visited, .menuItem:hover, .menuItemHilite:hover,
.menuItem:active, .menuItemHilite:active, .menuItem:link, .menuItemHilite:link,
.menuItemX:visited, .menuItemHiliteX:visited, .menuItemX:hover, .menuItemHiliteX:hover,
.menuItemX:active, .menuItemHiliteX:active, .menuItemX:link, .menuItemHiliteX:link
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_16']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_17 ---- */

.menuItem,
.menu,
.calendar tbody .rowhilite td, .calendar tbody .rowhilite td.weekend,
.olCgClass td, #forecastsWorksheet .olBgClass td.olCgClass,
.detail tr td[scope="row"],
.edit,
.other td.edit,
.monthViewDayHeight td[class=weekEnd],
.detail508 tr td[scope="col"],
.wizard-box
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_17']; ?> !important;
}

ul.tablist li a.current:link, ul.tablist li a.current:visited, ul.tablist li a.current:hover
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_17']; ?> !important;
}


.x-sqs-list .x-sqs-selected
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_17']; ?> !important;
}

ul.tablist li a.current, ul.tablist li a.current:hover,
ul.tablist li a.current:link, ul.tablist li a.current:visited, ul.tablist li a.current:hover
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_17']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_18 ---- */

hr,
#colorPicker span
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

.menuItemX,
hr,
td.inlineEditActive
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

.calendar table .wn,
ul.tablist li a, ul.subpanelTablist li a,
ul.subpanelTablist li a.current, ul.subpanelTablist li a.current:hover
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

.calendar tfoot .ttip,
.calendar thead .title,
.mceToolbarTop,
#suggestion_box table tr
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

.calendar thead .name,
ul.clickMenu.subpanel.records,
select, textarea,
#caseStyleUser,
#caseStyleContact,
#caseStyleInternal,
.View,
#suggestion_box table,
.qtip
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

hr
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
}

@media (max-width: 768px) {
    .View
    {
        border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }
}

@media only screen and (max-width: 480px) {
    .detail h4
    {
        border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }
}

@media (max-width: 480px) {
    #searchmobile #query_string
    {
        border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }
}

@media (min-width: 480px) and (max-width: 680px) {
    #searchmobile #query_string
    {
        border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }
}

@media (max-width: 640px) {
    .edit h4
    {
        border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }

    .edit tr
    {
        border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }

    #suggestion_box table tbody tr
    {
        border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }

}

@media only screen and (min-device-width: 480px) and (max-device-width: 980px) {
    .detail h4
    {
        border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }

    .detail tr
    {
        border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_18']; ?> !important;
    }
}



/* ---- LBL_COLOUR_SUITEP_19 ---- */

#quickCreateULSubnav li.moduleMenuOverFlowLess a, #quickCreateULSubnav li.moduleMenuOverFlowMore a,
#quickCreate ul.clickMenu li ul.subnav li.moduleMenuOverFlowMore a, #quickCreate ul.clickMenu li ul.subnav li.moduleMenuOverFlowLess a
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}

.menuItemHiliteX
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}

.menu,
.calendar,
ul#globalLinksSubnav, ul#quickCreateULSubnav,
#quickCreate ul.clickMenu li ul.subnav, #globalLinksModule ul.clickMenu li ul.subnav
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}

#scheduler .schedulerDiv
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}

.calendar .combo
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}

.calendar .combo
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_19']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_20 ---- */

input[type=text]:disabled ,
:disabled
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_20']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_21 ---- */

input[type=text]:disabled,
:disabled
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_21']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_22 ---- */

.sqsSelectedSmartInputItem
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_22']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_23 ---- */

.search td span,
#themepickerLinkSpan a,
#colorPicker #themepickerLinkSpan,
.teamNoticeBox,
#newRecord form a:hover,
.detail h4,
.detail tr td,
.other td,
a.tabFormAdvLink:link, a.tabFormAdvLink:visited,
.monthCalBodyTH th,
.monthViewDayHeight td,
.monthCalBody td,
h5.calSharedUser,
ul.tablist li a:link, ul.tablist li a:visited, ul.subpanelTablist li a:link, ul.subpanelTablist li a:visited
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_23']; ?> !important;
}

.listViewCalCurrentApptLgnd,
.listViewCalOtherApptLgnd,
.listViewCalConflictApptLgnd
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_23']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_24 ---- */

#massassign_form h3,
table#mass_update_table,
.edit td[scope=row],
#search_form label
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_24']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_25 ---- */

#selectLinkTop > .sugar_action_button > ul.subnav,
#selectLinkTop > .sugar_action_button > ul.subnav li,
#selectLinkTop > .sugar_action_button > ul.subnav a,
#actionLinkTop ul.clickMenu li ul.subnav,
#actionLinkTop > .sugar_action_button > ul.subnav,
#actionLinkTop > .sugar_action_button > ul.subnav li,
#actionLinkTop > .sugar_action_button > ul.subnav a
#selectLinkBottom > .sugar_action_button > ul.subnav,
#selectLinkBottom > .sugar_action_button > ul.subnav li,
#selectLinkBottom > .sugar_action_button > ul.subnav a,
#actionLinkBottom ul.clickMenu li ul.subnav,
#actionLinkBottom > .sugar_action_button > ul.subnav,
#actionLinkBottom > .sugar_action_button > ul.subnav li,
#actionLinkBottom > .sugar_action_button > ul.subnav a ,
#actionLinkTop .menuItem,
#actionLinkBottom .menuItem,
#actionLinkTop li.sugar_action_button,
#selectLinkTop > .sugar_action_button > ul.subnav a:hover,
#actionLinkBottom > .sugar_action_button > ul.subnav a:hover,
#actionLinkTop .menuItemHilite,
#actionLinkBottom .menuItemHilite,
table.subpanel-table ul.subpanel a:hover,
table.subpanel-table li.sugar_action_button:hover,
table.subpanel-table .pagination .sugar_action_button:hover,
table.subpanel-table .pagination li.sugar_action_button:hover > form > a,
table.subpanel-table .pagination .sugar_action_button:hover > form > a,
table.subpanel-table .pagination .sugar_action_button:hover > form > a,
table.subpanel-table .pagination a,
.subpanel-table ul.subnav
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_25']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_26 ---- */

div#responseTime {
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_26']; ?> !important;
}





/* ---- LBL_COLOUR_SUITEP_27 ---- */

#scheduler .schedulerDiv,
.other td[scope=row],
.monthCalBodyTH th
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_27']; ?> !important;
}

ul.tablist li a:hover, ul.subpanelTablist li a:hover,
table tr#delegates_search
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_27']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_28 ---- */

.olBgClass
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}

#scheduler .schedulerDiv table tr td
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}

.contentBox,
.subpanelTabForm .h3Row
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;;
}

#scheduler .schedulerDiv table tr.schedulerTimeRow th[scope=col],
#scheduler .schedulerDiv table tr.schedulerAttendeeRow td.schedulerAttendeeDeleteCell
{
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}

#colorPicker
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}

.olCgClass td, #forecastsWorksheet .olBgClass td.olCgClass,
.contentBox,
ul.tablist li a.activeSubTab:hover,
.monthCalBodyDayItem,
.edit h4,
table.subpanel-table th
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}

.calendar thead .name,
ul.tablist li a, ul.subpanelTablist li a,
.quickcreate,
.detail table, .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th,
[id^=list_subpanel_]
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_28']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_29 ---- */

#scheduler .schedulerDiv table tr.schedulerAttendeeRow td,
.calendar .button,
ul.clickMenu.subpanel.records,
#toolbox .le_panel, #toolbox .le_row, .le_field
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
}

.calendar .combo,
.calendar .combo .active,
.calendar table,
.calendar table .wn,
.calendar tbody td.selected,
.sqsNoMatch,
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
}

ul.nav-tabs > li > a, ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li:first-of-type > a:hover,
ul.nav-tabs > li > a:hover,
ul.nav-tabs > li.active > a,  ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li.active > a:hover
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
}

ul.nav-tabs > li > a, ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li:first-of-type > a:hover,
ul.nav-tabs > li > a:hover,
ul.nav-tabs > li.active > a,  ul.nav-tabs > li.active > a:focus,
ul.nav-tabs > li.active > a:hover
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
}

.sub-header
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
}

@media only screen and (max-width: 480px) {
    .detail h4
    {
        background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
    }
}

@media (max-width: 640px) {
    .detail h4
    {
        background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
    }
}

@media only screen and (min-device-width: 480px) and (max-device-width: 980px) {
    .detail h4
    {
        background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_29']; ?> !important;
    }
}





/* ---- LBL_COLOUR_SUITEP_30 ---- */

.listViewCalCurrentAppt,
.listViewCalCurrentApptLgnd
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_30']; ?> !important;
}

#scheduler .schedulerDiv table tr.schedulerAttendeeRow td.schedulerSlotCellStartTime
{
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_30']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_31 ---- */

.aclNone,
.aclDisabled,
.overdueTask
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_31']; ?> !important;
}

#scheduler .schedulerDiv table tr.schedulerAttendeeRow td.schedulerSlotCellEndTime
{
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_31']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_32 ---- */

.calendar .combo
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_32']; ?> !important;
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_32']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_33 ---- */

.calendar .combo .hilite,
.calendar tbody td.hilite,
.calendar tbody td.weekend.hilite,
.calendar thead .title
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_33']; ?> !important;
}





/* ---- LBL_COLOUR_SUITEP_34 ---- */

.calendar .combo .hilite,
.calendar tbody td.hilite,
.calendar tbody td.weekend.hilite
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_34']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_35 ---- */

.calendar tbody .day.othermonth.oweekend,
.calendar tbody td.today,
.calendar tbody td.weekend,
.rssItemDate,
.list tr.pagination td table td,
#newRecord form a:link, #newRecord form a:visited,
#globalLinksSubnav li a, #quickCreateULSubnav li a,
#quickCreate ul.clickMenu li ul.subnav li a, #globalLinksModule ul.clickMenu li ul.subnav li a
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_35']; ?> !important;
}

.calendar tbody td.selected
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_35']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_36 ---- */

.calendar tbody td.weekend {
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_36']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_37 ---- */

.calendar thead .hilite
{
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_37']; ?> !important;
}

.calendar thead .hilite
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_37']; ?> !important;
}

#ajaxStatusDiv
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_37']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_38 ---- */

.olCapFontClass A
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_38']; ?> !important;
}

.olCapFontClass,
.olCloseFontClass
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_38']; ?> !important;
}

.calendar tfoot .ttip
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_38']; ?> !important;
}

.other td
{
    border-left-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_38']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_39 ---- */

.listViewCalOtherAppt,
.listViewCalOtherApptLgnd
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_39']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_40 ---- */

.listViewCalConflictAppt,
.listViewCalConflictApptLgnd
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_40']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_41 ---- */

.aclAll,
.aclEnabled,
.aclNormal
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_41']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_42 ---- */

.sqsNoMatch
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_42']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_43 ---- */

.todaysTask
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_43']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_44 ---- */

.success
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_44']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_45 ---- */

.x-sqs-list,
.x-sqs-list .x-sqs-selected
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_45']; ?> !important;
}

.x-sqs-list
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_45']; ?> !important;
}





/* ---- LBL_COLOUR_SUITEP_46 ---- */

.yui-calendar a.calnav,
.yui-calendar a.calnavleft, .yui-calendar a.calnavright,
.buttons input#btn_view_change_log,
.btn-info, .btn-info:hover, .btn-info:active, .btn-info:focus,
a#advanced_search_link,
a#basic_search_link
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_46']; ?> !important;
}

.yui-calendar a.calnav,
.yui-calendar a.calnavleft, .yui-calendar a.calnavright,
.btn-info, .btn-info:hover, .btn-info:active, .btn-info:focus
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_46']; ?> !important;
}





/* ---- LBL_COLOUR_SUITEP_47 ---- */

.pagination button
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_47']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_48 ---- */

.pagination button
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_48']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_49 ---- */

.pagination button,
.edit,
#globalinks ul li a,
.chartContainer .label,
#suggestion_box table tr th,
.wizard-box
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_49']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_50 ---- */

#colorPicker #themepickerLinkSpan:hover,
.detail tr td a:link, .detail tr td a:visited, .detail tr td a:hover,
.monthHeader a:hover, .monthViewDayHeight a:hover
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_50']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_51 ---- */

.monthCalBody,
.olBgClass
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_51']; ?> !important;
}

.monthCalBodyDayItem,
.yearCalBodyMonth #daily_cal_table,
ul.tablist li a.current:link, ul.tablist li a.current:visited, ul.tablist li a.current:hover
{
    border-top-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_51']; ?> !important;
}

ul.tablist li a.current:link, ul.tablist li a.current:visited, ul.tablist li a.current:hover
{
    border-right-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_51']; ?> !important;
}

.olCgClass td,
.yui-navset .yui-nav, .yui-navset .yui-navset-top .yui-nav, .yui-layout .yui-layout-hd
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_51']; ?> !important;
}

.teamNoticeBox,
#EditView hr,
.other,
.monthCalBodyTH th,
.monthViewDayHeight td,
.yearCalBodyMonth #daily_cal_table .monthCalBodyTHDay,
.yui-layout .yui-layout-unit div.yui-layout-bd, .yui-navset .yui-content, .yui-navset .yui-navset-top .yui-content,
.yui-navset .yui-nav .selected a, .yui-navset .yui-nav .selected a em, .yui-navset .yui-nav a, .yui-navset .yui-nav a em, .yui-navset .yui-nav a, .yui-navset .yui-navset-top .yui-nav a
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_51']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_52 ---- */

#search input[name=query_string]
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_52']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_53 ---- */

#search input[name=query_string]
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_53']; ?> !important;
}


/* ---- LBL_COLOUR_SUITEP_54 ---- */

.evenListRowS1:hover td,
.oddListRowS1:hover td
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_54']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_55 ---- */

.detail table, table.detail,
.other
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_55']; ?> !important;
}

.detail tr td[scope="row"],
.detail tr th,
.detail508 tr td[scope="col"]
{
    border-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_55']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_56 ---- */

.monthCalBodyTH th[scope=row], .monthViewDayHeight td[scope=row]
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_56']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_57 ---- */

.yearCalBodyMonth
{
    background-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_57']; ?> !important;
}

.evenListRowS1
{
    background: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_57']; ?> !important;
}




/* ---- LBL_COLOUR_SUITEP_58 ---- */

ul.subpanelTablist li a.current, ul.subpanelTablist li a.current:hover
{
    color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_58']; ?> !important;
}



/* ---- LBL_COLOUR_SUITEP_60 ---- */

#first-tab-menu-xs.dropdown-menu > li > a
{
    border-bottom-color: #<?php echo $sugar_config['theme_settings']['SuiteP']['color_60']; ?> !important;
}











<?php
///* Header CSS */
//
//h1, h2, h3, h4 {
//color: #<?php echo $sugar_config['theme_settings']['SuiteP']['page_header']; ?><!--;-->
<!---->
<!--}-->
<!---->
<!--/* Pagelink CSS */-->
<!---->
<!--a, a:link, a:visited, #dashletbuttons, .detail tr td a:link, .detail tr td a:visited, .detail tr td a:hover{-->
<!--color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['page_link']; ?><!--;-->
<!--}-->
<!---->
<!--/* Dashlet CSS */-->
<!---->
<!--.dashletPanel .h3Row{-->
<!--background: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['dashlet']; ?><!--;-->
<!--}-->
<!---->
<!--.dashletPanel .h3Row h3{-->
<!--color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['dashlet_headertext']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.dashletPanel .h3Row .dashletToolSet .icon{-->
<!--fill: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['dashlet_headertext']; ?><!-- !important;-->
<!--}-->
<!---->
<!--/* Top navigation bar CSS */-->
<!---->
<!--.navbar-inverse {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.headerlinks a:link, .headerlinks a:visited, .navbar-inverse .navbar-brand, .moremenu a,  a[id^=grouptab], a[id^=moduleTab] {-->
<!--background:none;-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar_font']; ?><!--;-->
<!--}-->
<!---->
<!--@media(max-width:979px){-->
<!--ul.navbar-nav li a,.navbar-inverse .navbar-nav .open .dropdown-menu > li > a, .moremenu ul li a {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar_font']; ?><!--; !important;-->
<!--}-->
<!--}-->
<!---->
<!--ul.topnav li:hover, .dropdown-menu li a:hover, li#usermenu:hover, .moremenu ul li a:hover,ul.navbar-nav li:hover {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.headerlinks a:hover, .navbar-inverse .navbar-brand:hover {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#desktop_notifications .btn {-->
<!--background: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#searchform .btn-->
<!--{-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar']; ?><!-- !important;-->
<!--color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['icon']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#usermenu a{-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['navbar_font']; ?><!--; !important;-->
<!--}-->
<!---->
<!--/* Drop down menu CSS */-->
<!---->
<!--.dropdown-menu {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.dropdown-menu li a, .dropdown-menu em a, .moremenu ul li a , #globalLinks ul li a, #quickcreatetop ul li a{-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.moremenu li a:hover, .dropdown-menu li a:hover, #globalLinks ul li a:hover, #quickcreatetop ul li a:hover{-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--/* Drop down menu CSS */-->
<!---->
<!--#mobile_menu {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#mobile_menu li a, #mobile_menu em a {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#mobile_menu li a:hover {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#mobilegloballinks ul li a {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['dropdown_menu_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--#mobilegloballinks ul li a:hover {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!---->
<!--/* Icon CSS */-->
<!---->
<!--.icon{-->
<!--fill: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['icon']; ?><!-- !important;-->
<!--}-->
<!---->
<!--/* Button and action menu CSS */-->
<!---->
<!--button, .button, input[type="button"], input[type="reset"], input[type="submit"], a#create_link.utilsLink, .btn, .btn-success, .btn-primary, .button, input[type=submit], input[type=button], a#create_link.utilsLink, .btn-group a {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button']; ?><!-- !important;-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.btn:hover, .btn-success:hover, .btn-primary:hover, .button:hover, input[type=submit]:hover, input[type=button]:hover, a#create_link.utilsLink:hover, .btn-group a:hover, #globalLinksModule ul.clickMenu.SugarActionMenu li a:hover,-->
<!--#globalLinksModule ul.clickMenu li:hover span, ul#globalLinksSubnav li a:hover, ul#quickCreateULSubnav li a:hover {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_hover']; ?><!-- !important;-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--/* Action Menu CSS */-->
<!---->
<!--ul.clickMenu li ul.subnav, ul.clickMenu ul.subnav-sub, ul.SugarActionMenuIESub, ul.clickMenu li ul.subnav li a, ul.clickMenu li ul.subnav li input, ul.subnav-sub li a, ul.SugarActionMenuIESub li a, ul.clickMenu li ul.subnav li a, ul.clickMenu li ul.subnav li input, ul.subnav-sub li a, ul.SugarActionMenuIESub li a, ul.clickMenu li ul.subnav, ul.clickMenu ul.subnav-sub, ul.SugarActionMenuIESub, ul.clickMenu li ul.subnav li a, ul.clickMenu li ul.subnav li input, ul.subnav-sub li a, ul.SugarActionMenuIESub li a{-->
<!--color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['page_link']; ?><!-- !important;-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['action_menu_background']; ?><!-- !important;-->
<!--}-->
<!---->
<!--ul.clickMenu li ul.subnav li a:hover,ul.clickMenu li ul.subnav li input:hover, ul.clickMenu.subpanel.records li ul.subnav li a:hover, ul.clickMenu ul.subnav-sub li a:hover, ul.clickMenu ul.subnav-sub li a:hover{-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['action_menu_background_hover']; ?><!-- !important;-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--ul.clickMenu>li, ul.SugarActionMenuIESub li, ul.SugarActionMenuIESub li a,-->
<!--ul.clickMenu li a, .list tr.pagination td.buttons ul.clickMenu > li > a:link, .list tr.pagination td.buttons ul.clickMenu > li > a {-->
<!--background:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['action_menu_button']; ?><!-- !important;-->
<!--}-->
<!---->
<!--ul.SugarActionMenuIESub li a:hover, ul.clickMenu.SugarActionMenu li a:hover, ul.clickMenu.SugarActionMenu li span.subhover:hover {-->
<!--/*Leave Blank */-->
<!--}-->
<!---->
<!--ul.clickMenu.SugarActionMenu li a:hover {-->
<!--color:#--><?php //echo $sugar_config['theme_settings']['SuiteP']['button_link_hover']; ?><!-- !important;-->
<!--}-->
<!---->
<!--ul.clickMenu li span.subhover:hover {-->
<!--background-position: 6px 0;-->
<!--}-->
<!---->
<!---->
<!--/* popup colors */-->
<!---->
<!--.yui-module .hd, .yui-panel .hd {-->
<!--background-color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_from']; ?><!--;-->
<!--background: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_from']; ?><!-- none repeat scroll 0 0;-->
<!--}-->
<!---->
<!--/* suggestion box and popup */-->
<!---->
<!---->
<!--#suggestion_box table {-->
<!--color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['page_link']; ?><!-- !important;-->
<!--}-->
<!---->
<!--.qtip-tipped .qtip-titlebar {-->
<!--background-color: #--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_from']; ?><!--;-->
<!--background-image: -webkit-gradient(linear,left top,left bottom,from(#--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_from']; ?><!--),to(#--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_to']; ?><!--));-->
<!--background-image: -webkit-linear-gradient(top,#--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_from']; ?><!--,#--><?php //echo $sugar_config['theme_settings']['SuiteP']['suggestion_popup_to']; ?><!--);-->
<!--}-->
?>