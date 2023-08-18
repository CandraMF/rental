<?php

namespace App\Charts;

use App\Models\Kendaraan;
use App\Models\Member;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Ketersediaan Kendaraan')
            ->addData([
                Kendaraan::where('status', 1)->count(),
                Kendaraan::where('status', 0)->orWhere('status', 2)->count()
            ])
            ->setLabels(['Tersedia', 'Sedang Dipinjam']);
    }
}
