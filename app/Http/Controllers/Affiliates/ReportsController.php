<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Models\Product;
use GuzzleHttp\Client;
use Mpdf\Mpdf;
use Log;
use Auth;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserRankHistory;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use DB;
use Carbon\Carbon;

class ReportsController extends Controller
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

    public function entireOrganizationReport()
    {
        
        $d['max_level'] = 0;
        try {
            $response = ApiHelper::request('GET', '/affiliate/reports/entire-organization-report', array());
            $response_data = json_decode($response->getBody());

            $d['viewOption']    = $response_data->data->viewOption;
            $d['levelFrom']     = $response_data->data->levelFrom;
            $d['levelTo']       = $response_data->data->levelTo;
            $d['max_level']     = $response_data->data->max_level;
        } catch (\Exception $e) {
            $d['viewOption'] = 'selected';
            $d['levelFrom'] = 0;
            $d['levelTo'] = 0;
        }

        return view('affiliates.reports.entire-organization')->with($d);
    }

    /**
     * Call API to get the data from entire organization report
     */
    public function entireOrganizationReportData(request $request)
    {
        $data = $request->all();

        try {
            $response = ApiHelper::request('POST', '/affiliate/reports/entire-organization-report-data', $data);
            $response_data = json_decode($response->getBody());
            return response()->json($response_data);
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }
    }

    public function getPearReportByUserJson(Request $request)
    {
        if ($request->history) {
            \Session::put('history', $request->history);
        }

        if (\Session::has('history')) {
            $history = \Session::get('history');
            $month = substr($history, 0, 2);
            $year = substr($history, 2, 4);
        } else {
            $month = date('m');
            $year = date('Y');
        }


        $user = $request->id ? User::where('id', $request->id)->first() : Auth::user();
        $d['rank_history'] = UserRankHistory::where('user_id', $user->id)
            ->whereMonth('period', $month)
            ->whereYear('period', $year)
            ->first();

        $d['pqv'] = User::getRootUserPQV($user->distid, $month, $year);

        return response()->json($d);
    }

    /**
     * Call API to get the data from entire organization report
     */
    public function dataTablesAPICall(request $request)
    {
        $data = $request->all();

        $request->session()->put('history', $request->history);

        //$url = config('api.host') . config('api.uri') . $data['endpoint'];

        //session()->put('token', $token);
        /*$headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session()->get('token'),
        ];*/
        try {
            /*$response = $this->client->request('POST', $url, [
                'headers' => $headers,
                'form_params' => $data
            ]);*/

            $response = ApiHelper::request('POST', $data['endpoint'], $data);
            $response_data = json_decode($response->getBody());

            return response()->json($response_data);
            // return $response;
            // return json_encode($response);
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }
    }

    public function getAllInvoices()
    {
        setlocale(LC_MONETARY, 'en_US');
        $response   = ApiHelper::request('GET', '/affiliate/reports/invoices', array());
        $data       = json_decode($response->getBody());
        try {
            return view('affiliates.reports.invoices')->with(['orders' => $data->data->orders]);
        } catch (\Exception $e) {
            redirect('affiliates');
        }
    }

    public function getAllOrders()
    {
        setlocale(LC_MONETARY, 'en_US');
        $response   = ApiHelper::request('GET', '/affiliate/reports/orders', array());
        $data       = json_decode($response->getBody());
        try {
            return view('affiliates.reports.orders')->with(['orders' => $data->data->orders]);
        } catch (\Exception $e) {
            redirect('affiliates');
        }
    }

    public function invoiceView($order_id)
    {
        return $this->buildInvoice($order_id, 'I');
    }

    public function invoiceDownload($order_id)
    {
        return $this->buildInvoice($order_id, 'D');
    }

    private function buildInvoice($order_id, $type = 'I')
    {
        $response   = ApiHelper::request('GET', '/affiliate/reports/invoice-view/' . $order_id, array());
        $data       = json_decode($response->getBody());        

        if (isset($data->data)) {

            if ($data->response_code != 200) {
                return redirect('invoice');
            }

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->SetTitle('Invoice');
            $mpdf->SetWatermarkImage(asset('assets/images/invoice/invoice_bck.png'));
            $mpdf->showWatermarkImage = true;
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->setAutoBottomMargin = 'stretch';
            $mpdf->setHTMLHeader('<div style="margin-bottom: 10px;"><img src="' . asset('assets/images/invoice/inv_logo.png') . '"/></div>');
            $mpdf->setHTMLFooter('<div><img src="' . asset('assets/images/invoice/inv_foot_line.png') . '"/></div>');

            $compiled = view('affiliates.invoice.template')
                ->with([
                    'user' => Auth::user(),
                    'order' => $data->data->order,
                    'order_items' => $data->data->order_item,
                    'address' => $data->data->address,
                    'display_ordertotal' => $data->data->display_amount,
                    'coupon' => isset($data->data->coupon) ? $data->data->coupon : null
                ])->render();
            $mpdf->WriteHTML($compiled);
            $mpdf->Output('invoice.pdf', $type);
        } else {
            return redirect('invoice');
        }
    }

    public function preOrderView($preOrder_id)
    {
        return $this->buildPreOrder($preOrder_id, 'I');
    }

    public function preOrderDownload($preOrder_id)
    {
        return $this->buildPreOrder($preOrder_id, 'D');
    }

    private function buildPreOrder($preOrder_id, $type = 'I')
    {
        $response   = ApiHelper::request('GET', '/affiliate/reports/pre-order-view/' . $preOrder_id, array());
        $data       = json_decode($response->getBody());
        Log::info("response", array($data));

        Log::info("pre-order id -> " . $data->data->order_item[0]->id);

        if ($data->response_code != 200) {
            return redirect('invoice');
        }

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->SetTitle('Invoice');
        $mpdf->SetWatermarkImage(asset('assets/images/invoice/invoice_bck.png'));
        $mpdf->showWatermarkImage = true;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->setHTMLHeader('<div style="margin-bottom: 10px;"><img src="' . asset('assets/images/invoice/inv_logo.png') . '"/></div>');
        $mpdf->setHTMLFooter('<div><img src="' . asset('assets/images/invoice/inv_foot_line.png') . '"/></div>');

        $compiled = view('affiliates.invoice.template')
            ->with([
                'user' => Auth::user(),
                'order' => $data->data->order,
                'order_items' => $data->data->order_item,
                'address' => $data->data->address,
                'coupon' => isset($data->data->coupon) ? $data->data->coupon : null,
                'display_ordertotal' => $data->data->display_amount
            ])->render();
        $mpdf->WriteHTML($compiled);
        $mpdf->Output('preOrder.pdf', $type);
    }

    public function getPearReportByUser($id = null)
    {
        $id  = (int)($id);
        if ($id) {
            $user = User::where('id', $id)->first();
            $userId  = $id;
            if (!$user) {
                throw new AccessDeniedHttpException();
            }
        } else {
            $userId = Auth::user()->id;
        }
        $d['months'] = $this->getPreviousMonths($userId);

        $d['user'] = $id ? User::where('id', $id)->first() : Auth::user();

        $month = date('m');
        $year = date('Y');
        $d['user_pqv'] = User::getMonthPQV($userId, $month, $year);

        return view('affiliates.reports.pear')->with($d);
    }

    public function commission()
    {
        $response = ApiHelper::request('GET', '/affiliate/commission', array());
        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with(['response' => $response_data->data]);
    }

    public function commissionViewer()
    {
        $found1099 = \Storage::disk('s3')->exists('1099/2019/1099_' . Auth::user()->distid . '.pdf');

        return view('affiliates.commission-viewer.index')->with(['found1099' => $found1099]);
    }

    public function commissionDetails(Request $request)
    {
        $response = ApiHelper::request('POST', '/affiliate/commission-viewer-details', $request->all());
        $response_data = json_decode($response->getBody());

        if ($request->has('week')) {
            $label_period = "Week Ending " . $request->get('week');
        } elseif ($request->has('period')) {
            $label_period = strftime('%B %G', strtotime($request->get('period')));
        }

        $type = $request->type;

        if ($request->type == "fsb") {
            $type = strtoupper($request->type);
        }

        return view('affiliates.commission-viewer.monthly')->with([
            "response" => $response_data->data,
            "type"     => $type,
            "period"   => $request->period,
            "week"     => $request->week,
            "label_period" => $label_period
        ]);
    }

    public function getCommissionDetailsLevel(Request $request)
    {
        $response = ApiHelper::request('POST', '/affiliate/commission-viewer-details-level', $request->all());
        $response_data = json_decode($response->getBody());

        return view('affiliates.commission-viewer.table_details')->with([
            'response' => $response_data->data,
            'type' => $request->type
        ])->render();
    }

    public function getWeeklyCommissionDates(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/weekly',
            [
                'unilevel_date' => $request->unilevel_date,
                'week_ending'   => $request->week_ending
            ]
        );
        $response_data = json_decode($response->getBody());

        // dd($response_data->data);
        return view('affiliates.commission.index')->with(['response' => $response_data->data, 'week_ending' => $request->week_ending]);
    }

    public function getWeeklyCommissionDetails(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/weekly/details',
            [
                'week_ending' => $request->week_ending,
                'binary_week_ending' => $request->binary_week_ending
            ]
        );

        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')
            ->with(['response' => $response_data->data, 'week_ending' => $request->week_ending]);
    }

    public function historical()
    {
        $response = ApiHelper::request('GET', '/affiliate/reports/historical', array());
        $response_data = json_decode($response->getBody());


        return view('affiliates.reports.historical')->with(['response' => $response_data->data]);
    }

    public function getUnilevelCommissionDetails(Request $request)
    {
        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/unilevel-commission-details',
            [
                'date' => $request->date
            ]
        );

        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with([
            'response' => $response_data->data,

        ]);
    }

    public function getLeadershipCommissionDetails(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/leadership-commission-details',
            [
                'date' => $request->date
            ]
        );

        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with([
            'response' => $response_data->data,
        ]);
    }

    public function getTsbCommissionDetails(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/tsb-commission-details',
            [
                'date' => $request->date
            ]
        );

        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with([
            'response' => $response_data->data,
        ]);
    }

    public function getVibeCommissionDetails(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/vibe-commission-details',
            [
                'date' => $request->date
            ]
        );
        
        
        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with([
            'response' => $response_data->data,
        ]);
    }

    public function getWeeklyEnrollmentReport(Request $request)
    {
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::MONDAY);

        $firstDayOfTheWeek = Carbon::now()->startOfWeek();
        $lastDayOfTheWeek = Carbon::now()->endOfWeek();

        // Descomentar esse código para testar o relatório
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];
        $criteria = "where date(u.created_dt) >= '$firstDayOfTheWeek' and date(u.created_dt) < '$lastDayOfTheWeek'";
        $criteria .= $search ? sprintf('AND u.distid LIKE \'%%%s%%\'', $search) : '';

        $query = sprintf("select u.id,u.firstname,u.lastname,u.distid,u.username,u.created_dt,c.countrycode,
            a.stateprov,u.current_product_id,concat(sps.firstname,' ',sps.lastname) as sponser_name,
            u.sponsorid,u.is_active
            from enrolment_tree_tsa(:distid) et
            left join users as u on u.id = et.id
            left join (select * from addresses where addrtype = '3' AND \"primary\" = 1) a on a.userid = u.id
            left join country as c on a.countrycode = c.countrycode
            left join users as sps on u.sponsorid = sps.distid
            %s
            order by date(u.created_dt) desc", $criteria);

        $users = DB::select(DB::raw($query), [":distid" => Auth::user()->distid]);

        $count = count($users);
        $userPagination = array_slice($users, $start, $length);

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $userPagination,
        );
 
        $packClasses = Product::getEnrollmentPacks();    
        $packImages = [ 
                2 => 'EOR_pack_icon_basic.png',
                3 => 'EOR_pack_icon_visionary.png'
        ];

        return view('affiliates.reports.weekly-enrollment-report')
            ->with([
                    'response' => $userPagination, 
                    'packClasses' => $packClasses,
                    'packImages' => $packImages]);
    }

    //TODO: move this function to api
    public function getUpgradeProspects()
    {
        $user = Auth::user();

        $prospects = User::select('firstname', 'lastname', 'current_product_id', 'created_dt')
            ->where('sponsorid', $user->distid)
            ->where('usertype', UserType::TYPE_DISTRIBUTOR)
            ->whereNotIn('current_product_id', [Product::ID_FIRST_CLASS])
            ->get();

        return view('affiliates.reports.upgrade-prospects', [
            'response' => $prospects
        ]);
    }

    private function getPreviousMonths($id = null): array
    {
        $current_month = Carbon::now();

        $months = [];
        $months[$current_month->format('mY')] = "Current Month";

        $m_history = UserRankHistory::where('user_id', $id)->count() - 1;
        for ($i = 0; $i < $m_history; $i++) {
            $month = $current_month->subMonth();
            $months[$month->format('mY')] = $month->format('M Y');
        }

        return $months;
    }

    public function found1099Download()
    {
        $found1099 = \Storage::disk('s3')->exists('1099/2019/1099_' . Auth::user()->distid . '.pdf');

        if ($found1099) {
            return \Storage::download('1099/2019/1099_' . Auth::user()->distid . '.pdf');
        } else {
            return redirect()->back();
        }
    }

    public function commissionHistorical()
    {
        $response = ApiHelper::request('GET', '/affiliate/reports/historical', array());
        $response_data = json_decode($response->getBody());

        $found1099 = \Storage::disk('s3')->exists('1099/2019/1099_' . Auth::user()->distid . '.pdf');

        return view('affiliates.commission.historical')->with(['response' => $response_data->data, 'found1099' => $found1099]);
    }

    public function getPromoCommissionDetails(Request $request)
    {

        $response = ApiHelper::request(
            'POST',
            '/affiliate/commission/promo-commission-details',
            [
                'date' => $request->date
            ]
        );

        $response_data = json_decode($response->getBody());

        return view('affiliates.commission.index')->with([
            'response' => $response_data->data,
        ]);
    }
}
