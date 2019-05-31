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
        echo('+ dbg line at: ' . __LINE__);
        $browserWidth = $this->getBrowserWidth();
        echo('+ dbg line at: ' . __LINE__);
        $breakpoint = null;
        echo('+ dbg line at: ' . __LINE__);
        if ($browserWidth >= 1201) {
            echo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::lg;
            echo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth >= 1024 && $browserWidth <= 1200) {
            echo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::md;
            echo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth >= 750 && $browserWidth < 1024) {
            echo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::sm;
            echo('+ dbg line at: ' . __LINE__);
        } elseif ($browserWidth < 750) {
            echo('+ dbg line at: ' . __LINE__);
            $breakpoint = DesignBreakPoint::xs;
            echo('+ dbg line at: ' . __LINE__);
        }
        echo('+ dbg line at: ' . __LINE__);
        return $breakpoint;
    }

    protected function getBrowserWidth()
    {
        echo('+ dbg line at: ' . __LINE__);
        return $this->tester->executeJS('return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);');
    }

    protected function getBrowserHeight()
    {
        return $this->tester->executeJS('return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);');
    }
}
