<?php

namespace Step\Acceptance;

use \AcceptanceTester as Tester;
use Page\Design;
use SuiteCRM\Enumerator\DesignBreakPoint;

class NavigationBarTester extends Tester
{
    /**
     * Click on the home buton / navbar brand
     */
    public function clickHome()
    {        
        $I = $this;
        
        $I->wantTo('+ new Desing()...');
        $design = new Design($I);
        
        $I->wantTo('+ getBreakpointString()...');
        $breakpoint = $design->getBreakpointString();
        
        $I->wantTo('+ breakpoint is: [' . $breakpoint . ']');
        switch ($breakpoint) {
            // The home button is only available on the large desktop
            // We need to select the home module from the all menu for tablet and mobile.
            case DesignBreakPoint::lg:
                $I->wantTo(' + click on #navbar-brand');
                $I->click('#navbar-brand');
                break;
            case DesignBreakPoint::md:
                $I->wantTo(' + clickAllMenuItem(Home) (1)');
                $this->clickAllMenuItem('Home');
                break;
            case DesignBreakPoint::sm:
                $I->wantTo(' + clickAllMenuItem(Home) (2)');
                $this->clickAllMenuItem('Home');
                break;
            case DesignBreakPoint::xs:
                $I->wantTo(' + clickAllMenuItem(Home) (3)');
                $this->clickAllMenuItem('Home');
                break;
        }
        
        $I->wantTo(' + we are done here, return...');
    }

    /**
     * Selects a menu item from the users menu (global links)
     * @param $link
     *
     * <?php
     * $I->clickUserMenuItem('Admin')
     * $I->clickUserMenuItem('#admin_link')
     */
    public function clickUserMenuItem($link)
    {
        $I = $this;
        $design = new Design($I);
        $breakpoint = $design->getBreakpointString();
        switch ($breakpoint) {
            case DesignBreakPoint::lg:
                $I->moveMouseOver('.desktop-bar #toolbar .globalLinks-desktop');
                $I->click($link, '.desktop-bar #toolbar .globalLinks-desktop');
                break;
            case DesignBreakPoint::md:
                $I->click('.tablet-bar #toolbar .globalLinks-mobile');
                $I->click($link, '.tablet-bar #toolbar .globalLinks-mobile');
                break;
            case DesignBreakPoint::sm:
                $I->click('.tablet-bar #toolbar .globalLinks-mobile');
                $I->click($link, '.tablet-bar #toolbar .globalLinks-mobile');
                break;
            case DesignBreakPoint::xs:
                $I->click('.mobile-bar #toolbar .globalLinks-mobile');
                $I->click($link, '.mobile-bar #toolbar .globalLinks-mobile');
                break;
        }
    }

    /**
     * Navigates to module. Selects a menu item from the all menu (top nav)
     * @param $link
     *
     * <?php
     * $I->clickAllMenuItem('Accounts')
     *
     * Watch out - the mobile navigation employs a different structure with with tablet and desktop versions. It is
     * best to use just the module translations.
     *
     * Also:
     * the non filter navigation is not supported by this method
     */
    public function clickAllMenuItem($link)
    {
        $I = $this;
        
        $I->wantTo('+ clickAllMenuItem/Design...');
        $design = new Design($I);
        
        $I->wantTo('+ clickAllMenuItem/getBreakpointString...');
        $breakpoint = $design->getBreakpointString();
        
        $I->wantTo('+ braikpoint:' . $breakpoint);
        switch ($breakpoint) {
            case DesignBreakPoint::lg:
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenuButton = '#toolbar.desktop-toolbar  > ul.nav.navbar-nav > li.topnav.all';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenuButton, 30);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->wait(1);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click('All', $allMenuButton);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenu = $allMenuButton . ' > span.notCurrentTab > ul.dropdown-menu';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenu, 120);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($link, $allMenu);
                break;
            case DesignBreakPoint::md:
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenuButton = 'div.navbar-header > button.navbar-toggle';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenuButton, 30);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->wait(1);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($allMenuButton);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenu = 'div.navbar-header > #mobile_menu';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenu, 120);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($link, $allMenu);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                break;
            case DesignBreakPoint::sm:
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenuButton = 'div.navbar-header > button.navbar-toggle';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenuButton, 30);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->wait(1);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($allMenuButton);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenu = 'div.navbar-header > #mobile_menu';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenu, 120);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($link, $allMenu);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                break;
            case DesignBreakPoint::xs:
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenuButton = 'div.navbar-header > button.navbar-toggle';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenuButton, 30);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->wait(1);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($allMenuButton);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $allMenu = 'div.navbar-header > #mobile_menu';
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->waitForElementVisible($allMenu, 120);
                $I->wantTo('+ dbg line at: ' . __LINE__);
                $I->click($link, $allMenu);
                break;
        }
        $I->wantTo('+ dbg line at: ' . __LINE__);
    }

    /**
     * Selects a menu item from the current module menu (top nav)
     * @param $link
     *
     * <?php
     * $I->clickAllMenuItem('Accounts')
     *
     * Watch out - the mobile navigation employs a different structure with with tablet and desktop versions. It is
     * best to use just the module translations.
     *
     * Also:
     * the non filter navigation is not supported by this method
     */
    public function clickCurrentMenuItem($link)
    {
        $I = $this;
        $design = new Design($I);
        $breakpoint = $design->getBreakpointString();
        switch ($breakpoint) {
            case DesignBreakPoint::lg:
                $I->moveMouseOver('//*[@id="toolbar"]/ul/li[2]/span[2]/a');
                $I->waitForElementVisible('#toolbar.desktop-toolbar  > ul.nav.navbar-nav > li.topnav ul.dropdown-menu > li.current-module-action-links > ul', 30);
                $I->waitForText($link, 30, '#toolbar.desktop-toolbar  > ul.nav.navbar-nav > li.topnav > ul.dropdown-menu > li.current-module-action-links');
                $I->click($link, '#toolbar.desktop-toolbar  > ul.nav.navbar-nav > li.topnav > ul.dropdown-menu > li.current-module-action-links');
                break;
            case DesignBreakPoint::md:
                $I->click('div#mobileheader > div#modulelinks > .modulename > a');
                $I->waitForElementVisible('div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab', 30);
                $I->waitForText($link, 30, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab');
                $I->click($link, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab');
                break;
            case DesignBreakPoint::sm:
                $I->click('div#mobileheader > div#modulelinks > .modulename > a');
                $I->waitForElementVisible('#modulelinks > ul.dropdown-menu');
                $I->waitForText($link, 30, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab', 30);
                $I->click($link, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab');
                break;
            case DesignBreakPoint::xs:
                $I->click('div#mobileheader > div#modulelinks > .modulename > a');
                $I->waitForElementVisible('div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab', 30);
                $I->waitForText($link, 30, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab');
                $I->click($link, 'div#mobileheader > div#modulelinks > ul.dropdown-menu > li.mobile-current-actions > ul.mobileCurrentTab');
                break;
        }
    }
}
