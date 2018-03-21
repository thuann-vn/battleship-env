<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Config;

class BBGameIndex extends Controller
{
    //
    public function index() {

        $gameAIs = Config::get('hackathon.game_logic.presenter.ais');
        if ($gameAIs != null && count($gameAIs) > 0) {
            return $this->renderGameInitForm($gameAIs);
        }
        return "Config error, no AIs";
    }

    private function renderGameInitForm($gameAIs) {
        return view('bb_presenter_entry', ['ais' => $gameAIs]);
    }

}
