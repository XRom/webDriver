<?php
use Page\Acceptance\Weather as WeatherPage;

class OOPtestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // Проверяем заполняемость строки поиска
    /**
    * @group find
    */
    public function fillSearchStringTest(AcceptanceTester $I)
    {
        $inputString = 'ulsk';
        $I->wantTo('fill search string test');

        $weatherPage = new WeatherPage($I);
        $I->amOnPage(WeatherPage::route());
        $weatherPage->setSearchString($inputString);
        \PHPUnit_Framework_Assert::assertEquals($weatherPage->checkSearchString(), $inputString, 'search request damage');
    }
    
    // Проверяем функционал очистки строки поиска
    /**
    * @group find
    */
    public function clearSearchStringTest(AcceptanceTester $I)
    {
        $inputString = 'ulsk';

        $weatherPage = new WeatherPage($I);
        $I->amOnPage(WeatherPage::route());
        $weatherPage->setSearchString($inputString);
        $weatherPage->clearSearchString();

        \PHPUnit_Framework_Assert::assertEquals($weatherPage->checkSearchString(), '', 'search sting not empty');
//        if ($weatherPage->checkSearchString() != '') {
//            \PHPUnit_Framework_Assert::fail('search sting not empty');
//        }
    }

    // Проверяем стандартный кейс поиска
    /**
    * @group find
    */
    public function findTest(AcceptanceTester $I)
    {
        $shortString = 'Москва';
        $expectedURL = '~\/pogoda\/search\?request=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0~';

        $weatherPage = new WeatherPage($I);
        $I->amOnPage(WeatherPage::route());
        $weatherPage->setSearchString($shortString);
        $I->wait(1);
        $weatherPage->clickFindButton();
        $I->wait(1);
        $I->seeCurrentUrlMatches($expectedURL);
    }

    // Проверяем автодополнение ввода строки поиска
    /**
    * @group find
    */
    public function autoCompliteTest(AcceptanceTester $I)
    {
        $shortString = 'Мо';
        $expectedLocation = '/pogoda/moscow';
        
        $weatherPage = new WeatherPage($I);
        $I->amOnPage(WeatherPage::route());
        $weatherPage->setSearchString($shortString);
        $I->wait(1);
        $weatherPage->clickAutoCompliteString();
        $I->wait(1);
        $I->seeCurrentUrlEquals($expectedLocation);
    }
    
    // tests
    /**
    * @group safe
    */
    public function safeSQLTest(AcceptanceTester $I)
    {
        $I->wantTo('safe OK');
        $I->wait(1);
    }

    // tests
    /**
    * @group safe
    */
    public function safeXSSTest(AcceptanceTester $I)
    {
        
        //\PHPUnit_Framework_Assert::fail('search sting not empty');
    }

    // tests
    /**
    * @group safe
    */
    public function inputOverFlowTest(AcceptanceTester $I)
    {
      //  \PHPUnit_Framework_Assert::fail('search sting not empty');
    }
}
