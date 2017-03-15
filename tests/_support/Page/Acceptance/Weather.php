<?php
namespace Page\Acceptance;

class Weather
{
    // include url of current page
    public static $URL = '/pogoda/ulyanovsk';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    CONST FULL_INFO_BUTTON = "//*[@id='forecasts-tab-1']";
    CONST SHORT_INFO_BUTTON = "//*[@id='forecasts-tab-0']";
    CONST SEARCH_STRING = "//*[@id='header2input']";
    CONST CLEAR_SEARCH_STRING = ".input__clear";
    CONST FIND_BUTTON = '.button_side_right';
    CONST FIRST_AUTO_COMPLITE = '//div[6]/div/div/div/ul/li[1]';
 
    CONST LOCATORS = array(
        'FULL_INFO_BUTTON'      => "//*[@id='forecasts-tab-1']",
        'SHORT_INFO_BUTTON'     => "//*[@id='forecasts-tab-0']",

        'FIRST_AUTO_COMPLITE'   => '//li[1]/a[@class="suggest2-item__link"]',   //'//div[6]/div/div/div/ul/li[1]',
        'PLACE_TITLE'           => '.title_level_1'
    );


    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param = '')
    {
        return static::$URL.$param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
//        $I->amOnUrl('http://yandex.ru');
    }

    public function setFullInfoMod()
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->click(self::FULL_INFO_BUTTON);
    }

    public function setShortInfoMod()
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->click(self::SHORT_INFO_BUTTON);
    }

    public function setSearchString(string $value)
    {
        $I = $this->acceptanceTester;

        $I->fillField(self::SEARCH_STRING, $value);
    }

    public function checkSearchString()
    {
        $I = $this->acceptanceTester;

        $text = $I->grabValueFrom(self::SEARCH_STRING);
        return $text;
    }

    public function clearSearchString()
    {
        $I = $this->acceptanceTester;

        $I->click(self::CLEAR_SEARCH_STRING);
    }

    public function clickFindButton()
    {
        $I = $this->acceptanceTester;

        $I->click(self::FIND_BUTTON);
    }
    
    public function clickAutoCompliteString()
    {
        $I = $this->acceptanceTester;

        $I->click(self::LOCATORS['FIRST_AUTO_COMPLITE']);
    }


    public function checkPlaceTitle()
    {
        $I = $this->acceptanceTester;

        $text = $I->grabTextFrom(self::LOCATORS['PLACE_TITLE']);
        return $text;
    }

}
