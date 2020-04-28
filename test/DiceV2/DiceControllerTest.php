<?php

namespace Hepa19\DiceV2;

use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceControllerTest extends TestCase
{
    private $controller;
    private $app;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        $this->controller = new DiceController();
        $this->controller->setApp($app);

        $dicegame = new DiceGame(100, "Heidi", 2, 2);
        $this->app->session->set("dicegame", $dicegame);
    }

    /**
     * Test initAction
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Test newRoundActionGet
     */
    public function testNewRoundActionGet()
    {
        $res = $this->controller->newRoundActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Test endActionGet
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test rollActionGet
     */
    public function testRollActionGet()
    {
        $res = $this->controller->rollActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test initActionPost
     */
    public function testInitActionPost()
    {

        $this->app->request->setGlobals([
            "post" => [
                "name" => "Heidi",
                "dices" => 2,
                "players" => 1,
            ]
        ]);

        $res = $this->controller->initActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test playActionPost
     */
    public function testPlayActionPost()
    {

        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $dicegame = $this->app->session->get("dicegame");

        $dicegame->goToNextRound();

        $this->app->request->setGlobals([
            "post" => [
                "playcomputer" => "playcomputer",
            ]
        ]);

        $res2 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res2);

        $this->app->request->setGlobals([
            "post" => [
                "init" => "init",
            ]
        ]);

        $res3 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res3);

        $this->app->request->setGlobals([
            "post" => [
                "newround" => "newround",
            ]
        ]);

        $res4 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res4);

        $this->app->request->setGlobals([
            "post" => [
                "save" => "save",
            ]
        ]);

        $res5 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res5);

        $this->app->request->setGlobals([
            "post" => [
                "roll" => "roll",
            ]
        ]);

        $res6 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res6);
    }


    /**
     * Test saveActionGet
     */
    public function testSaveActionGet()
    {
        $dicegame = $this->app->session->get("dicegame");
        $dicegame->roll();
        $this->app->session->set("dicegame", $dicegame);

        $res = $this->controller->saveActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $player = $dicegame->getCurrentPlayer();
        $player->setScore(101);

        $res = $this->controller->saveActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test playActionGet
     */
    public function testPlayActionGet()
    {
        $dicegame = $this->app->session->get("dicegame");
        $dicegame->goToNextRound();

        $res = $this->controller->playActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test endActionGet
     */
    public function testEndActionGet()
    {
        $res = $this->controller->endActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
