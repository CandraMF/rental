<?php

namespace App\Charts;

use App\Models\Penyewaan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PenyewaanCart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {

        return $this->chart->donutChart()
            ->setTitle('Penyewaan')
            ->setSubtitle('Berlangsung / Selesai')
            ->addData([
                Penyewaan::where('status', 1)->count(),
                Penyewaan::where('status', 2)->count(),
            ])
            ->setLabels(['Berlangsung', 'Selesai']);
    }
}
