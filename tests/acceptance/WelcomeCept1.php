<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('test message');
  $I->amOnPage('/');
  $I->seeElement('.home-logo__default');
  $I->see('Погода');
  $I->seeElement('a', ['href' => 'https://yandex.ru/pogoda/ulyanovsk']);        //по атрибуту
  $I->seeElement('//h1/a[@href="https://yandex.ru/pogoda/ulyanovsk"][1]');      //по хпаф
  $I->seeElement(['css' => '.link.link_blue_yes']);                             //по css
  $I->click('//body/div[1]/div[3]//div[2]/button');
  $I->wait(3);