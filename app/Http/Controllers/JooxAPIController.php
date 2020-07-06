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
            case 'search':

                if (!isset($_GET['keyword'])) {
                    return response([
                        'success' => false,
                        'msg' => 'Please provide keyword parameter , and read docs!'
                    ]);
                }
                $kw = str_replace('%20', '', $_GET['keyword']);
                $data = JooxAPIx::songByKeyword($kw);
                return response([
                    'success' => true,
                    'data' => $data
                ]);

                break;
            case 'details':

                if (!isset($_GET['id'])) {
                    return response([
                        'success' => false,
                        'msg' => 'Please provide keyword parameter , and read docs!'
                    ]);
                }
                $songId = $_GET['id'];
                $data = JooxAPIx::songById($songId);
                if(is_iterable($data)){
                    $data = $data[0];
                }
                return response([
                    'success' => true,
                    'data' => $data
                ]);


                break;
            case 'album':
                if (!isset($_GET['id'])) {
                    return response([
                        'success' => false,
                        'msg' => 'Please provide keyword parameter , and read docs!'
                    ]);
                }

                $albumId = $_GET['id'];
                $data =  JooxAPIx::songByAlbum($albumId);
                return response([
                    'success' => true,
                    'data' => $data
                ]);

                break;
            case 'downloadSong':

                if (!isset($_GET['id'])) {
                    return response([
                        'success' => false,
                        'msg' => 'Please provide keyword parameter , and read docs!'
                    ]);
                }
                $id = $_GET['id'];
                $type = (!isset($_GET['type'])) ? 'mp3' : $_GET['type'];

                return JooxAPIx::downloadSong($id, $type);



                break;

            default:
                # code...
                break;
        }
    }
}
