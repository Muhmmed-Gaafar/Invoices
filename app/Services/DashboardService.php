<?php

namespace App\Services;

use App\Models\Invoice;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardService
{
    /**
     * Generate the data for the bar chart.
     *
     * @return \ConsoleTVs\Charts\Classes\Chartjs\Chart
     */
    public function getBarChart()
    {
        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('Value_Status', 1)->count();
        $count_invoices2 = Invoice::where('Value_Status', 2)->count();
        $count_invoices3 = Invoice::where('Value_Status', 3)->count();

        $nspainvoices2 = $count_all ? $count_invoices2 / $count_all * 100 : 0;
        $nspainvoices1 = $count_all ? $count_invoices1 / $count_all * 100 : 0;
        $nspainvoices3 = $count_all ? $count_invoices3 / $count_all * 100 : 0;

        return app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspainvoices2]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspainvoices1]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspainvoices3]
                ],
            ])
            ->options([]);
    }

    /**
     * Generate the data for the pie chart.
     *
     * @return \ConsoleTVs\Charts\Classes\Chartjs\Chart
     */
    public function getPieChart()
    {
        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('Value_Status', 1)->count();
        $count_invoices2 = Invoice::where('Value_Status', 2)->count();
        $count_invoices3 = Invoice::where('Value_Status', 3)->count();

        $nspainvoices2 = $count_all ? $count_invoices2 / $count_all * 100 : 0;
        $nspainvoices1 = $count_all ? $count_invoices1 / $count_all * 100 : 0;
        $nspainvoices3 = $count_all ? $count_invoices3 / $count_all * 100 : 0;

        return app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3]
                ]
            ])
            ->options([]);
    }
}
