<?php
//use Page\Acceptance\Weather as WeatherPage;
/*
$I = new AcceptanceTester($scenario);
$I->wantTo('test full info mod');
$weatherPage = new WeatherPage($I);
$I->amOnPage(WeatherPage::route());
$I->see('сегодня');
$weatherPage->setFullInfoMod();
$I->see('сегодня');
*/

class TestYandexWeather extends \Codeception\Module
{
    public $webdriver;
  protected $I;

  function __construct(AcceptanceTester $I)
  {
      $this->I = $I;
  }
    protected function _inject($acceptance)
    {
        $this->webdriver = $this->getWebDriver();
    }

    /**
     *  @return \Codeception\Module\WebDriver
     */
    public function getWebDriver()
    {
        return $this->getModule('WebDriver');
    }

    public function checkAchangeInfo(\AcceptanceTester $I)
    {
        
        $I->wait(1);
        $I->wait(1);
        $loginPage->login('bill evans', 'debby');
        $I->amOnPage('/profile');
        $I->see('Bill Evans Profile', 'h1');
    }

    public function another()
    {
       
        $I->wantTo('est nothing');
    
    }
}