<?php

use Faker\Generator;

class AccountsCest
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
     * @param \Step\Acceptance\AccountsTester $accounts
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As an administrator I want to view the accounts module.
     */
    public function testScenarioViewAccountsModule(
        \AcceptanceTester $I,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\AccountsTester $accounts,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('View the accounts module for testing');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        // Navigate to accounts list-view
        $I->loginAsAdmin();
        $accounts->gotoAccounts();
        $listView->waitForListViewVisible();

        $I->see('Accounts', '.module-title-text');
    }

    /**
     * @param \AcceptanceTester $I
     * @param \Step\Acceptance\DetailView $detailView
     * @param \Step\Acceptance\ListView $listView
     * @param \Step\Acceptance\AccountsTester $accounts
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As administrative user I want to create a report with the reports module so that I can test
     * the standard fields.
     */
    public function testScenarioCreateAccount(
        \AcceptanceTester $I,
        \Step\Acceptance\DetailView $detailView,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\AccountsTester $accounts,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('Create an Account');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        // Navigate to accounts list-view
        $I->loginAsAdmin();
        $accounts->gotoAccounts();
        $listView->waitForListViewVisible();

        // Create account
        $this->fakeData->seed($this->fakeDataSeed);
        $accounts->createAccount('Test_'. $this->fakeData->company());

        // Delete account
        $detailView->clickActionMenuItem('Delete');
        $detailView->acceptPopup();
        $listView->waitForListViewVisible();
    }

    /**
     * @param \AcceptanceTester $I
     * @param \Step\Acceptance\ListView $listView
     * @param \Step\Acceptance\AccountsTester $accounts
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As administrative user I want to inline edit a field on the list-view
     */
    public function testScenarioInlineEditListView(
        \AcceptanceTester $I,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\AccountsTester $accounts,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('Inline edit an account on the list-view');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        // Navigate to accounts list-view
        $I->loginAsAdmin();
        $accounts->gotoAccounts();
        $listView->waitForListViewVisible();

        // Create account
        $this->fakeData->seed($this->fakeDataSeed);
        $account_name = 'Test_'. $this->fakeData->company();
        $accounts->createAccount($account_name);

        // Inline edit
        $accounts->gotoAccounts();
        $listView->waitForListViewVisible();
        $I->doubleClick('.inlineEditIcon');
        $I->fillField('#name', 'InlineAccountNameEdit');
        $I->clickWithLeftButton('.suitepicon-action-confirm');
        $I->see('InlineAccountNameEdit');
    }

    public function testScenarioCreateAccountChild(
        \AcceptanceTester $I,
        \Step\Acceptance\DetailView $detailView,
        \Step\Acceptance\EditView $editView,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\AccountsTester $accounts,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        echo('+ dbg line at: ' . __LINE__);
        $I->wantTo('Create an Account');

        echo('+ dbg line at: ' . __LINE__);
        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        echo('+ dbg line at: ' . __LINE__);
        // Navigate to accounts list-view
        $I->loginAsAdmin();
        echo('+ dbg line at: ' . __LINE__);
        $accounts->gotoAccounts();
        echo('+ dbg line at: ' . __LINE__);
        $listView->waitForListViewVisible();

        echo('+ dbg line at: ' . __LINE__);
        // Create account
        $this->fakeData->seed($this->fakeDataSeed);
        echo('+ dbg line at: ' . __LINE__);
        $parentAccountName = 'Test_' . $this->fakeData->company();
        echo('+ dbg line at: ' . __LINE__);
        $accounts->createAccount($parentAccountName);
        echo('+ dbg line at: ' . __LINE__);

        // Click on Member Organizations subpanel
        echo('+ dbg line at: ' . __LINE__);
        $I->click(['id' => 'subpanel_title_accounts']);
        echo('+ dbg line at: ' . __LINE__);
        $I->waitForElementVisible('#member_accounts_create_button', 60);
        echo('+ dbg line at: ' . __LINE__);

        // Add child account
        echo('+ dbg line at: ' . __LINE__);
        $accountName = 'Test_' . $this->fakeData->company();
        echo('+ dbg line at: ' . __LINE__);
        $I->click('#member_accounts_create_button');
        echo('+ dbg line at: ' . __LINE__);
        $I->click('#Accounts_subpanel_full_form_button');
        echo('+ dbg line at: ' . __LINE__);
        $editView->waitForEditViewVisible();
        echo('+ dbg line at: ' . __LINE__);
        $I->fillfield('#name', $accountName);
        echo('+ dbg line at: ' . __LINE__);
        $editView->clickSaveButton();
        echo('+ dbg line at: ' . __LINE__);

        // View child account in parent account subpanel
        echo('+ dbg line at: ' . __LINE__);
        $detailView->waitForDetailViewVisible();
        echo('+ dbg line at: ' . __LINE__);
        $I->see($accountName, '//*[@id="list_subpanel_accounts"]/table/tbody/tr/td[2]/a');
        echo('+ dbg line at: ' . __LINE__);

        // Delete account
        echo('+ dbg line at: ' . __LINE__);
        $detailView->clickActionMenuItem('Delete');
        echo('+ dbg line at: ' . __LINE__);
        $detailView->acceptPopup();
        echo('+ dbg line at: ' . __LINE__);
        $listView->waitForListViewVisible();
        echo('+ dbg line at: ' . __LINE__);

        // Select record from list view
        echo('+ dbg line at: ' . __LINE__);
        $listView->clickFilterButton();
        echo('+ dbg line at: ' . __LINE__);
        $listView->click('Quick Filter');
        echo('+ dbg line at: ' . __LINE__);
        $listView->fillField('#name_basic', $accountName);
        echo('+ dbg line at: ' . __LINE__);
        $listView->click('Search', '.submitButtons');
        echo('+ dbg line at: ' . __LINE__);
        $listView->waitForListViewVisible();
        echo('+ dbg line at: ' . __LINE__);
        $listView->clickNameLink($accountName);
        echo('+ dbg line at: ' . __LINE__);
        $detailView->waitForDetailViewVisible();
        echo('+ dbg line at: ' . __LINE__);

        echo('+ dbg line at: ' . __LINE__);
        // Delete account
        $detailView->clickActionMenuItem('Delete');
        echo('+ dbg line at: ' . __LINE__);
        $detailView->acceptPopup();
        echo('+ dbg line at: ' . __LINE__);
        $listView->waitForListViewVisible();
        echo('+ dbg line at: ' . __LINE__);
    }
}
