<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JooxAPIx\JooxAPIx;

class JooxAPIController extends Controller
{
    public function index($command)
    {
        switch ($command) {
            case 'searchSong':
                $kw = str_replace('%20', '', $_GET['keyword']);

                return JooxAPIx::songByKeyword($kw);


                break;

            default:
                # code...
                break;
        }
    }
}
