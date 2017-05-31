<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MillionLiveMarketFilter\Repositories\BazaarRepository;
use MillionLiveMarketFilter\Services\BazaarService;

class MarketController extends Controller
{
    private $bazaarRepository;
    private $bazaarService;

    public function __construct( BazaarRepository $bazaarRepository , BazaarService $bazaarService ){
        $this->bazaarRepository = $bazaarRepository;
        $this->bazaarService = $bazaarService;
    }

    /** api **/

    public function listCreate( Request $request ){

        $data = json_decode( $request->get("data") );

        $this->bazaarService->insertPack( $data );

        $response = [
            'status' => 'success'
        ];
        return response( )->json( $response , 200);

    }

    /** web **/
    public function showIndex(){

        $cardList = $this->bazaarService->getIndexList();

        return view('bazaar.index')->with('data', $cardList);

    }
}
