<?php
/**************************************
 TienTN: We don't need Model extension
 **************************************/
namespace App\Entities;

use App\Entities\BBTeamInfo;
use App\Entities\BBShipInfo;
use App\Entities\BBPosInfo;
use App\Entities\BBGameInfo;

use \Config;

//use PHP 5.4+ abstract
use \JsonSerializable;

class BBBoardInfo implements JsonSerializable 
{
    //
    private $objSession;
    private $objGameInfo;
    private $objGameRound;
    
    private $arrRedShips = [];
    private $arrBlueShips = [];
    
    private $arrRedHitPos = [];
    private $arrBlueHitPos = [];
    private $arrRedExplodePos = [];
    private $arrBlueExplodePos = [];
    private $arrRedWaterExplodePos = [];
    private $arrBlueWaterExplodePos = [];
    private $arrRedShipSinkPos = [];
    private $arrBlueShipSinkPos = [];
    
    private $infoRedTeam = null;
    private $infoBlueTeam = null;
    
    function __construct($sid, $token) {
        $this->infoRedTeam = new BBTeamInfo();
        $this->infoRedTeam->fillData("THANH_RANDOM", $this->randBetween(0, 100), $this->randBetween(0, 100), $this->randBetween(0, 100), 
                            $this->randBetween(0, 100), $this->randBetween(0, 100), $this->randBetween(0, 100));
        $this->infoBlueTeam = new BBTeamInfo();
        $this->infoBlueTeam->fillData("AI_BUA", $this->randBetween(0, 100), $this->randBetween(0, 100), $this->randBetween(0, 100), 
                            $this->randBetween(0, 100), $this->randBetween(0, 100), $this->randBetween(0, 100));

        $sessionID = $sid;
        
        $this->objSession = new BBSessionInfo($sessionID, "reqno_1", "dena", 0);
        $this->objGameInfo = new BBGameInfo("AI1vs_AI2", 20, 8, 0, 0, 0);

        $flgGameEnd = 0;
        //forced ending
        if ($token >= 3) {
            $flgGameEnd = 1;
        }
        $this->objGameRound = new BBGameRound($flgGameEnd, 0, 1, 0, 'Initializing ...', 'Wait');
        
        $iTest1Type = 0;
        $iTest2Type = 0;
        $iTest3Type = 0;
        $iTest4Type = 0;
        /*
        //TienTN: rotate types, but now we are rendering just one time
        //so disabled by now
        $iRangeTypeFrom = $token - ((int)floor($token/6) * 6);
        $iTest1Type = $iRangeTypeFrom;
        $iTest2Type = ($iTest1Type + 1)<6?$iTest1Type + 1:0;
        $iTest3Type = ($iTest2Type + 1)<6?$iTest2Type + 1:0;
        $iTest4Type = ($iTest3Type + 1)<6?$iTest3Type + 1:0;
        */

        //type: 0 BB
        //dir: 0 vertical
        //x, y, type, direction, length
        $iTest1Type = 0;
        $iTest2Type = 1;
        $iTest3Type = 2;
        $iTest4Type = 3;
        $objShip = new BBShipInfo(0, 0, $iTest1Type, 1, 2);
        $this->arrRedShips[] = $objShip;
        $objShip = new BBShipInfo(0, 7, $iTest2Type, 1, 2);
        $this->arrRedShips[] = $objShip;
        $objShip = new BBShipInfo(17, 0, $iTest3Type, 1, 2);
        $this->arrRedShips[] = $objShip;
        $objShip = new BBShipInfo(19, 7, $iTest4Type, 1, 2);
        $this->arrRedShips[] = $objShip;

        //type: 0 BB
        //dir: 0 vertical
        //x, y, type, direction, length
        $objShip = new BBShipInfo(2, 1, 0, 0, 2);
        $this->arrRedShips[] = $objShip;
        $objShip = new BBShipInfo(10, 2, 0, 1, 4);
        $this->arrRedShips[] = $objShip;
        //dd
        $objShip = new BBShipInfo(1, 1, 1, 0, 2);
        $this->arrRedShips[] = $objShip;
        //ca
        $objShip = new BBShipInfo(3, 3, 2, 0, 2);
        $this->arrRedShips[] = $objShip;
        //pt
        $objShip = new BBShipInfo(15, 6, 3, 0, 2);
        $this->arrRedShips[] = $objShip;
        //cv
        $objShip = new BBShipInfo(12, 4, 4, 0, 4);
        $this->arrRedShips[] = $objShip;
        //or
        $objShip = new BBShipInfo(5, 4, 5, 0, 2);
        $this->arrRedShips[] = $objShip;


        $iTest1Type = 4;
        $iTest2Type = 5;
        $iTest3Type = 0;
        $iTest4Type = 1;
        $objShip = new BBShipInfo(0, 0, $iTest1Type, 0, 2);
        $this->arrBlueShips[] = $objShip;
        $objShip = new BBShipInfo(0, 6, $iTest2Type, 0, 2);
        $this->arrBlueShips[] = $objShip;
        $objShip = new BBShipInfo(19, 0, $iTest3Type, 0, 2);
        $this->arrBlueShips[] = $objShip;
        $objShip = new BBShipInfo(19, 6, $iTest4Type, 0, 2);
        $this->arrBlueShips[] = $objShip;

        //blue ships
        $objShip = new BBShipInfo(5, 4, 0, 0, 4);
        $this->arrBlueShips[] = $objShip;
        $objShip = new BBShipInfo(2, 2, 0, 0, 4);
        $this->arrBlueShips[] = $objShip;
        //dd
        $objShip = new BBShipInfo(3, 3, 1, 1, 2);
        $this->arrBlueShips[] = $objShip;
        //ca
        $objShip = new BBShipInfo(1, 1, 2, 1, 2);
        $this->arrBlueShips[] = $objShip;
        //pt
        $objShip = new BBShipInfo(10, 10, 3, 1, 2);
        $this->arrBlueShips[] = $objShip;
        //cv
        $objShip = new BBShipInfo(12, 4, 4, 1, 4);
        $this->arrBlueShips[] = $objShip;
        
        for ($i = 0; $i < $token; $i++) {
            $yPos = (int)floor($i / 20);
            $xPos = ($i - ($yPos * 20));
            $objPos = new BBPosInfo($xPos, $yPos);
            $this->arrRedHitPos[] = $objPos;
        }
        
        for ($i = 0; $i < $token; $i++) {
            $yPos = (int)floor($i / 20);
            $xPos = ($i - ($yPos * 20));
            $objPos = new BBPosInfo($xPos, $yPos);
            $this->arrBlueHitPos[] = $objPos;
        }

        $objPos = new BBPosInfo($this->randBetween(0, 19), $this->randBetween(0, 8));
        $this->arrRedExplodePos[] = $objPos;
        $objPos = new BBPosInfo($this->randBetween(0, 19), $this->randBetween(0, 8));
        $this->arrBlueExplodePos[] = $objPos;
        
        $objPos = new BBPosInfo($this->randBetween(0, 19), $this->randBetween(0, 8));
        $this->arrRedWaterExplodePos[] = $objPos;
        $objPos = new BBPosInfo($this->randBetween(0, 19), $this->randBetween(0, 8));
        $this->arrBlueWaterExplodePos[] = $objPos;

        $objPos = new BBPosInfo(0, 0);
        $this->arrRedShipSinkPos[] = $objPos;
        $objPos = new BBPosInfo(0, 6);
        $this->arrBlueShipSinkPos[] = $objPos;

    }
    
    function randBetween($iFrom, $iTo) {
        return rand($iFrom, $iTo);
    }

    function jsonSerialize() {
        return [
            'session_info' => $this->objSession,
            'game_info' => $this->objGameInfo,
            'game_round' => $this->objGameRound,
            'red_board' => [
                            'ships' => $this->arrRedShips,
                            'hitpos' => $this->arrRedHitPos,
                            'events' => [
                                        'explode' => $this->arrRedExplodePos,
                                        'waterhit' => $this->arrRedWaterExplodePos,
                                        'shipsink' => $this->arrRedShipSinkPos,
                                        ],
                           ],
            'blue_board' => [
                            'ships' => $this->arrBlueShips,
                            'hitpos' => $this->arrBlueHitPos,
                            'events' => [
                                        'explode' => $this->arrBlueExplodePos,
                                        'waterhit' => $this->arrBlueWaterExplodePos,
                                        'shipsink' => $this->arrBlueShipSinkPos,
                                        ],
                           ],
            'red_team' => $this->infoRedTeam,
            'blue_team' => $this->infoBlueTeam
        ];
    }
}
