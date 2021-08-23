<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;
use App\Models\UserDownload;

class ToolsController extends Controller
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * ApiHelper constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function tools()
    {
        return view('affiliates.tools.index');
    }

    public function presentations()
    {
        $response = ApiHelper::request('GET', '/affiliate/media/all-media', array());
        $response_data = json_decode($response->getBody());

        return view('affiliates.tools.presentations')->with(['response' => $response_data->data]);
    }

    public function documents()
    {
        $response = ApiHelper::request('GET', '/affiliate/media/all-media', array());
        $response_data = json_decode($response->getBody());

        return view('affiliates.tools.documents')->with(['response' => $response_data->data]);
    }

    public function social()
    {
        $response = ApiHelper::request('GET', '/affiliate/media/all-media', array());
        
        $response_data = json_decode($response->getBody());

        return view('affiliates.tools.social')->with(['response' => $response_data->data]);
    }

    public function medias()
    {
        $response = ApiHelper::request('GET', '/affiliate/media/all-media', array());
        $response_data = json_decode($response->getBody());

        return view('affiliates.tools.medias')->with(['response' => $response_data->data]);
    }

    // public function amountConvert(request $request){

    //     $form_params = [
    //         'amount' => str_replace('.', '', $request()->price),
    //         'currency' => Auth::user()->getConversionCountry(),
    //         'locale' => str_replace('-', '_', $request()->language)
    //     ];

    //     $url = '/affiliate/currency/convert?amount='.str_replace('.', '', request()->price).'&country=BR&locale=pt_BR&type=country';
    //     $res = ApiHelper::request(
    //         'GET',
    //         $url
    //     );


    //     return $res;
    // }
    
    public function training()
    {
        $order = (Auth::user()->current_product_id == 3) || (Auth::user()->current_product_id == 10)  ? true : false;
        if(!$order){
            return redirect()->back();
        }
        $response = ApiHelper::request('GET', '/affiliate/media/training', array());
        $response_data = json_decode($response->getBody());
        $data = $response_data->data;

        // $order = (Auth::user()->current_product_id == 4) || (Auth::user()->current_product_id == 12)  ? true : false;
        $promo = $data->promo;
        $videos = $this->getVideos();

        
        // if ($promo && $promo->side_banner_is_active == 1) {
        //     return view('affiliates.tools.training')->with(['order' => $order, 'promo' => $promo,'videos'=> $videos]);
        // }else{
        return view('affiliates.tools.training')->with(['order' => $order,'videos'=> $videos]);
        // }

        // return redirect('/');
    }

    public function downloads()
    {
        $user = auth()->user();
        
        $response = ApiHelper::request('GET', '/affiliate/media/downloads', array());
        $response_data = json_decode($response->getBody());
        $data = $response_data->data;

        $downloads = $data->downloads[0]->count;
        $performed = isset($user->download) ? $user->download->performed : 0 ;

        $remaining = $downloads - $performed;

        return view('affiliates.tools.downloads')->with(['remaining' => $remaining]);
    }

    public function downloadPerformed()
    {
        $user = auth()->user();
        
        $response = ApiHelper::request('GET', '/affiliate/media/downloads', array());
        $response_data = json_decode($response->getBody());

        $downloads = $response_data->data->downloads[0]->count;
        $userDownload = $user->download;

        if (!$userDownload) {
            $userDownload = UserDownload::create([
                'user_id'   => auth()->user()->id,
                'performed' => 0
            ]);
        }
        
        if ($downloads > $userDownload->performed) {
            $userDownload->performed += 1;
            // $userDownload->save();

            $data['route'] = route('download.signed');
            $data['remaining'] = $downloads - $userDownload->performed;

            return response()->json($data);
        } else {
            return redirect('/');
        }
    }

    public function downloadSigned()
    {
        $user = auth()->user();

        $response = ApiHelper::request('GET', '/affiliate/media/downloads', array());
        $response_data = json_decode($response->getBody());

        $downloads = $response_data->data->downloads[0]->count;
        $userDownload = $user->download;

        if ($downloads > $userDownload->performed) {
            $userDownload->performed += 1;
            $userDownload->save();

            return \Storage::download('media_files/2020_digital_photo_album_april_21_optimized.pdf');
            // return \Storage::download('media_files/TBF-how to donate Sept 20.pdf');
        } else {
            return 'you dont have remaining downloads';
        }
    }

    public function liveSession($session = 'new-york')
    {
        $order = (Auth::user()->current_product_id == 3) || (Auth::user()->current_product_id == 10)  ? true : false;
        
        if(!$order){
            return redirect()->back();
        }
        
        $session = $this->getLiveSessions()[$session];
        
        return view('affiliates.tools.live_sessions')->with(['order' => $order,'session'=> $session]);
    }

    private function getLiveSessions()
    {
        return [
            'new-york' => [
                'session' => 'https://vimeo.com/event/615974/embed/5b2c0fb4c9',
                'chat' => 'https://vimeo.com/event/615974/chat/5b2c0fb4c9'
            ],
            'london' => [
                'session' => 'https://vimeo.com/event/615912/embed/5c6f360ea9',
                'chat' => 'https://vimeo.com/event/615912/chat/5c6f360ea9'
            ],
            'hfx' => [
                'session' => 'https://vimeo.com/event/615980/embed/84500bce9f',
                'chat' => 'https://vimeo.com/event/615980/chat/84500bce9f'
            ],
            'sidney' => [
                'session' => 'https://vimeo.com/event/615978/embed/fd1160cba6',
                'chat'=>'https://vimeo.com/event/615978/chat/fd1160cba6'
            ]
        ];
    }
    
    private function getVideos()
    {
        return [
            'beginner' => [
                    [
                        'url' => "https://player.vimeo.com/video/501885652",
                        'title' => "Welcome beginning (Welcome to NCREASEU)"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501888739",
                        'title' => "What is Forex"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501888888",
                        'title' => "Why Trade Forex"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501889406",
                        'title' => " Market Participants"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501890327",
                        'title' => "Forex Trading Sessions"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501890939", 
                        'title' => "Currency Pairs"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501892496",
                        'title' => "Forex Brokers"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501892989",
                        'title' => "What is a PIP"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501893319",
                        'title' => "What Is a Lot "
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501893434",
                        'title' => "Order Types"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501894277",
                        'title' => "Order Types Pt. 2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501895163",
                        'title' => "Trading Checklist"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501896922",
                        'title' => "Forex Time Frames & Trading Styles"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501897576",
                        'title' => "Analysis"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501898050",
                        'title' => "Tradingview Tutorial"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501898807",
                        'title' => "Compound Interest"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501899276",
                        'title' => "Tour Guide (what's next)"
                    ]               
                    
                ],
                'intermediate' => [
                    [
                        'url' => "https://player.vimeo.com/video/501930735",
                        'title' => "Market Structure"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501930933",
                        'title' => "Market Structure Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501931342",
                        'title' => "Support & Resistance"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501931443",
                        'title' => "Support & Resistance Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501931936",
                        'title' => "Trendlines"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501944085",
                        'title' => "Trendlines Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501932043",
                        'title' => "Candle Stick Patterns (Candle sticks & price action)"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501932249",
                        'title' => "Candle Stick Patterns Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501932349",
                        'title' => "Candle Stick Patterns Pt.3"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501932433",
                        'title' => "Candle Stick Patterns Pt.4"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501934600",
                        'title' => "Price Channels"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501933922",
                        'title' => "Price Channels Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501933807",
                        'title' => "Currency Correlation"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501933602",
                        'title' => "Currency Correlation Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501933443",
                        'title' => "Twin Trading"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501933012",
                        'title' => "Twin Trading Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501932568",
                        'title' => "Tour Guide 2 (what's next)"
                    ],

                ],
                'advanced' => [
                    [
                        'url' => "https://player.vimeo.com/video/501944865",
                        'title' => "Fibs (Fibonacci Sequence)"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501944191",
                        'title' => "Fibonacci Sequence Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501943615",
                        'title' => "Fibonacci Sequence Pt.3"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501943237",
                        'title' => "Risk to Reward Proper Risk (Risk to Reward)"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501943332",
                        'title' => "Risk to Reward Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501943135",
                        'title' => "Confluence"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501942784",
                        'title' => "Confluence Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501942379",
                        'title' => "Institutional Levels"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501942038",
                        'title' => "Intro to Indicators"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501941338",
                        'title' => "Intro to Indicators Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501940974",
                        'title' => "Trading Psychology"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501940607",
                        'title' => "Trading Psychology Pt.2"
                    ],
                    [
                        'url' => "https://player.vimeo.com/video/501940092",
                        'title' => "Final Video"
                    ]
                ]
            ];
    }
}
