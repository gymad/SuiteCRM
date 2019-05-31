<?php

namespace Page;

use \AcceptanceTester as Tester;

use Codeception\Module;
use Helper\WebDriverHelper;
use SuiteCRM\Enumerator\DesignBreakPoint;

class Design extends Module
{

    /**
     * @var Tester;
     */
    protected $tester;

    /**
     * BasicModule constructor.
     * @param Tester $I
     */
    public function __construct(Tester $I)
    {
        $this->tester = $I;
    }

    /**
     * @param integer $browserWidth in pixels
     * @return string
     * @see \SuiteCRM\Enumerator\DesignBreakPoint
     */
    public function getBreakpointString()
    {
        $I->wantTo('+ dbg line at: ' . __LINE__);
        $browserWidth = $this->getBrowserWidth();
        $I->wantTo('+ dbg line at: ' . __LINE__);
        $breakpoint = null;
        $I->wantTo('+ dbg line at: ' . __LINE__);
        if ($browserWidth >= 1201) {
            $I->wantTo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::lg;
            $I->wantTo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth >= 1024 && $browserWidth <= 1200) {
            $I->wantTo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::md;
            $I->wantTo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth >= 750 && $browserWidth < 1024) {
            $I->wantTo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::sm;
            $I->wantTo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth < 750) {
            $I->wantTo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::xs;
            $I->wantTo('+ dbg line at: ' . __LINE__);
        }
        $I->wantTo('+ dbg line at: ' . __LINE__);
        return $breakpoint;
    }

    protected function getBrowserWidth()
    {
        $I->wantTo('+ dbg line at: ' . __LINE__);
        return $this->tester->executeJS('return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);');
    }

    protected function getBrowserHeight()
    {
        return $this->tester->executeJS('return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);');
    }
}
