<?php

namespace App\Charts;

use App\Models\Member;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TopMembers
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PolarAreaChart
    {

        $member = Member::withCount('penyewaans')
            ->orderBy('penyewaans_count', 'desc')
            ->take(5);

        $total_penyewaans = $member->pluck('penyewaans_count')->toArray();
        $members = $member->pluck('nama')->toArray();

        return $this->chart
            ->polarAreaChart()
            ->setTitle('Top 5 Member')
            ->addData($total_penyewaans)
            ->setLabels($members);
    }
}
