<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class DailyPrizesLineChart extends ChartWidget
{
    protected static ?string $heading = '일별 가입자 수';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $prizes = DB::table('prizes')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $prizes->pluck('date')->toArray();
        $data = $prizes->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => '일별 가입자 수',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected int | string | array $columnSpan = 'full';

    

}
