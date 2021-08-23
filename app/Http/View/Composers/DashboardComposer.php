<?php

namespace App\Http\View\Composers;

use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\UserRankHistory;
use App\Models\User;
use Auth;

class DashboardComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('dashboard', $this->getDashboardData());
    }

    /**
     * @return object
     */
    private function getDashboardDetailsData(): object
    {
        $res = ApiHelper::request(
            'GET',
            '/affiliate/dashboard/details',
            []
        );

        return json_decode($res->getBody())->data;
    }

    /**
     * @return object
     */
    private function getSubscriptionData(): object
    {
        $res = ApiHelper::request(
            'GET',
            '/affiliate/subscription',
            []
        );

        return json_decode($res->getBody())->data;
    }

    /**
     * @return array
     */
    private function getDashboardData(): array
    {
        // Dashboard Details
        $details = $this->getDashboardDetailsData();

        $data['bucket_volumes'] = $details->bucket_volumes;
        $data['bucket_volumes_current_week'] = $details->bucket_current_week;
        // Business Snapshot (widget data)
        $data['business_snapshot'] = [
            'pv' => $details->pv,
            'is_active' => $details->is_active,
            'binary_qualified' => [
                'left' => $details->binaryQualified->left,
                'right' => $details->binaryQualified->right
            ],
            'binary_volume' => [
                'left' => $details->total_left,
                'right' => $details->total_right
            ]
        ];

        // Monthly Team Performance (widget data)
        $data['mtp'] = [
            'ambassadors' => [
                'arrow' => $this->getArrowType($details->monthly_performance_ambassadors),
                'value' => $this->formatPercentNumber((float) $details->monthly_performance_ambassadors)
            ],
            'customers' => [
                'arrow' => $this->getArrowType($details->monthly_performance_customers),
                'value' => $this->formatPercentNumber((float) $details->monthly_performance_customers)
            ]
        ];

        // Rank Insights (widget data)
        $data['rank_insights'] = [
            'achieved' => $details->achieved_rank_desc,
            'monthly' => $details->monthly_rank_desc,
            'monthly_qv' => $this->formatCurrencyValue($details->monthly_qv),
            'qv' => $this->formatCurrencyValue($details->qv),
            'next_rank' => $details->rank_matric->nextlevel_rankdesc,
            'next_qv' => $this->formatCurrencyValue($details->rank_matric->nextlevel_qv),
            'binary_limit' => $details->rank_matric->binary_limit,
            'team' => $details->contributors,
            'has_tsa' => $details->tsaRank,
            'next_qc_percentage' => $details->rank_matric->next_qc_percentage,
            'paid_rank' => $details->paidRank,
            'activeQC' => $details->activeQC
        ];

        // Get the previous months
        $data['rank_insights']['history'] = $this->getPreviousMonths();

        // Rank types (dropdown data)
        $rank_list = array();
        foreach ($details->upper_ranks as $ranks) {
            $rank_list[] = ['id' => $ranks->rankval, 'type' => $ranks->rankdesc];
        }
        $data['rank_insights']['rank_types'] = $rank_list;
        /*$data['rank_insights']['rank_types'] = [
            ['id' => 20, 'type' => 'Director'],
            ['id' => 30, 'type' => 'Senior Director'],
            ['id' => 40, 'type' => 'Executive Director'],
            ['id' => 50, 'type' => 'Sapphire'],
            ['id' => 60, 'type' => 'Ruby'],
            ['id' => 70, 'type' => 'Emerald'],
            ['id' => 80, 'type' => 'Diamond'],
            ['id' => 90, 'type' => 'Blue Diamond'],
            ['id' => 100, 'type' => 'Black Diamond'],
            ['id' => 110, 'type' => 'Presidential Diamond'],
            ['id' => 120, 'type' => 'Crown Diamond'],
            ['id' => 130, 'type' => 'Double Crown Diamond'],
            ['id' => 140, 'type' => 'Triple Crown Diamond']
        ];*/

        // Upgrades (widget data)
        $data['upgrades'] = [
            'showUpgradeBtn' => $details->showUpgradeBtn,
            'packages' => $details->productsUpgrade,

        ];



        // Comissions (widget data)
        $data['comissions'] = [
            'week' => $details->commission_this_week,
            'month' => $details->commission_this_month,
            'year' => $details->commission_this_year,
            'ewallet_balance' => $details->ewallet_balance
        ];

        // Projected Monthly Volume (widget data)
        $monthlyVolume = $this->getProjectedMonthlyVolume();
        #$total_volume_processed = $monthlyVolume->totals[0]->total_qv ? ($monthlyVolume->paid->qv_processed * 100) / $monthlyVolume->totals[0]->total_qv : 100;
        #$total_credits_processed = $monthlyVolume->totals[0]->total_qc ? ($monthlyVolume->paid->qc_processed * 100) / $monthlyVolume->totals[0]->total_qc : 100;

        # FIX IT
        $total_volume_processed = 0;
        $total_credits_processed = 0;

        $data['pmv'] = [
            'volume' => [
                #'projected_volume' => $this->formatCurrencyValue($monthlyVolume->totals[0]->total_qv),
                'projected_volume' => 0,
                'failed_transactions' => $this->formatCurrencyValue($monthlyVolume->paid->qv_fail),
                'processed' => $this->formatCurrencyValue($monthlyVolume->paid->qv_processed),
                'total_volume_processed' => $this->formatCurrencyValue($total_volume_processed)
            ],
            'credits' => [
                #'projected_volume' => $this->formatCurrencyValue($monthlyVolume->totals[0]->total_qc),
                'projected_volume' => 0,
                'failed_transactions' => $this->formatCurrencyValue($monthlyVolume->paid->qc_fail),
                'processed' => $this->formatCurrencyValue($monthlyVolume->paid->qc_processed),
                'total_credits_processed' => $this->formatCurrencyValue($total_credits_processed)
            ],
            'charts' => [
                'volume' => [
                    #'projected_volume' => $monthlyVolume->totals[0]->total_qv,
                    'projected_volume' => 0,
                    #'processed' => $monthlyVolume->paid->qv_processed
                    'processed' => 0
                ],
                'credits' => [
                    #'projected_volume' => $monthlyVolume->totals[0]->total_qc,
                    'projected_volume' => 0,
                    'processed' => $monthlyVolume->paid->qc_processed
                ]
            ]
        ];

        // Build Zone Widget
        $data['build_zone'] = $this->getBuildZoneData();

        //work series

        $data['world_series'] = $this->getWorldSeries();

        $data['distributor_counts'] = $details->distributor_counts;

        return $data;
    }

    /**
     * @param float $number
     * @return string
     */
    private function formatPercentNumber($number): string
    {
        return sprintf('%s%%', number_format($number, 0, '.', ','));
    }

    /**
     * @param $value
     * @return string
     */
    private function getArrowType($value): string
    {
        return $value >= 0 ? 'arrow-up' : 'arrow-down';
    }

    /**
     * @return array
     */
    private function getPreviousMonths(): array
    {
        $current_month = Carbon::now();

        $months = [];
        $months[$current_month->format('mY')] = "Current Month";

        $m_history = UserRankHistory::where('user_id', Auth::user()->id)->count() - 1;
        for ($i = 0; $i < $m_history; $i++) {
            $month = $current_month->subMonth();
            $months[$month->format('mY')] = $month->format('M Y');
        }

        return $months;
    }

    /**
     * @param $value
     * @return string
     */
    private function formatCurrencyValue($value): string
    {
        return number_format($value, '0', '.', ',');
    }

    /**
     * @return object
     */
    private function getProjectedMonthlyVolume(): object
    {
        $res = ApiHelper::request(
            'GET',
            '/affiliate/dashboard/monthly-projected-totals',
            []
        );

        return json_decode($res->getBody())->data;
    }

    /**
     * @return array
     */
    private function getBuildZoneData(): array
    {
        $day = date('d');

        if ($day <= 10) {
            $build_zone = [
                'zone' => "The White Zone",
                'class' => 'white-zone',
                'activity' => 'Massive Exposure',
                'range' => '1ST - 10TH of the month',
                'body' => 'Personally expose the business and use the system to expose the business.'
            ];

            return $build_zone;
        }

        if ($day >= 11 && $day <= 20) {
            $build_zone = [
                'zone' => "The Blue Zone",
                'class' => 'blue-zone',
                'activity' => 'Massive Sponsoring',
                'range' => '11TH - 20TH of the month',
                'body' => 'Time to get prospects started.  Use 3way calls to launch new team members.'
            ];

            return $build_zone;
        }

        if ($day >= 21 && $day <= 31) {
            $build_zone = [
                'zone' => "The Gold Zone",
                'class' => 'gold-zone',
                'activity' => 'Massive Volume',
                'range' => '21ST - end of the month',
                'body' => 'Time for massive follow-up & upgrades.  Help everyone get their first 2 and achieve their new ranks.'
            ];

            return $build_zone;
        }
    }

    public function getWorldSeries()
    {
        /*$response_woner = ApiHelper::request('POST', '/join/resume-owner-world-series',
            [
                'sponsorId' => Auth::user()->id,
            ]);
            $response_data_owner = json_decode($response_woner->getBody());
            $owner = $response_data_owner->data;
            $sponsor = User::where('distid', Auth::user()->sponsorid)->first();
        $response_player = ApiHelper::request('POST', '/join/resume-owner-world-series',
            [
                'sponsorId' => $sponsor->id,
            ]);
            $response_data_player = json_decode($response_player->getBody());
            $player = $response_data_player->data;

            $world_series = [
                'owner' => $owner->resume,
                'player' => $player->resume,
                'sponsor_player' => $sponsor->id
                ];
            return $world_series;*/
    }
}
