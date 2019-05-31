<?php

use Faker\Generator;

class jjwg_Address_CacheCest
{
    /**
     * @var Generator $fakeData
     */
    protected $fakeData;

    /**
     * @var integer $fakeDataSeed
     */
    protected $fakeDataSeed;

    /**
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I)
    {
        if (!$this->fakeData) {
            $this->fakeData = Faker\Factory::create();
        }

        $this->fakeDataSeed = rand(0, 2048);
        $this->fakeData->seed($this->fakeDataSeed);
    }

    /**
     * @param \AcceptanceTester $I
     * @param \Step\Acceptance\ListView $listView
     * @param \Step\Acceptance\MapsAddressCache $mapsAddressCache
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As an administrator I want to view the mapsAddressCache module.
     */
    public function testScenarioViewMapsAddressCacheModule(
        \AcceptanceTester $I,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\MapsAddressCache $mapsAddressCache,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('View the mapsAddressCache module for testing');

        $I->wantTo('+ going to instance URL...');
        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        $I->wantTo('+ Log in as Admin...');
        // Navigate to mapsAddressCache list-view
        $I->loginAsAdmin();
        
        $I->wantTo('+ going to MapsAddressCache()...');
        $mapsAddressCache->gotoMapsAddressCache();
        
        
        $I->wantTo('+ going to wait for list view visible...');
        $listView->waitForListViewVisible();

        $I->see('Maps - Address Cache', '.module-title-text');
    }

    /**
     * @param \AcceptanceTester $I
     * @param \Step\Acceptance\DetailView $detailView
     * @param \Step\Acceptance\ListView $listView
     * @param \Step\Acceptance\MapsAddressCache $mapsAddressCache
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As administrative user I want to create a maps address cache so that I can test
     * the standard fields.
     */
    public function testScenarioCreateMapsAddressCache(
        \AcceptanceTester $I,
        \Step\Acceptance\DetailView $detailView,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\MapsAddressCache $mapsAddressCache,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('Create maps address cache');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        // Navigate to maps address cache list-view
        $I->loginAsAdmin();
        $mapsAddressCache->gotoMapsAddressCache();
        $listView->waitForListViewVisible();

        // Create maps address cache
        $this->fakeData->seed($this->fakeDataSeed);
        $mapsAddressCache->createMapsAddressCache('Test_'. $this->fakeData->company());

        // Delete maps address cache
        $detailView->clickActionMenuItem('Delete');
        $detailView->acceptPopup();
        $listView->waitForListViewVisible();
    }
}
