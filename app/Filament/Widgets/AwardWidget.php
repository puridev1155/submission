<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Prize;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AwardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('전체 참여수', Prize::count())
            ->description('이벤트 참여자 수 현황')
            ->chart([1,3,5,10,20,40])
            ->color('success'),
            Stat::make('전체 성공수', Prize::where('award', '스타벅스')->count())
            ->description('이벤트 참여자 "성공" 현황')
            ->chart([1,3,5,10,20,40])
            ->color('success'),
            Stat::make('전체 실패수', Prize::where('award', '꽝')->count())
            ->description('이벤트 참여자 "꽝" 현황')
            ->chart([1,3,5,10,20,40])
            ->color('danger'),
            
        ];
    }
}
