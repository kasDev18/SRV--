<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Candidate;
use App\Models\Customers;
use App\Models\Orders;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class CandidatesCount extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make(__('admin_dashboard.candidates'), Candidate::count())
                ->color(Color::Cyan)
                ->description(new HtmlString(__("admin_dashboard.to_create_candidate") . ', <a href="/admin/candidates/create"><u>' . __("admin_dashboard.click_here") . '</u></a>')),
            Stat::make(__("admin_dashboard.working_candidates"), Candidate::where('is_working', Candidate::STATUS_WORKING)->count())
                ->url('/admin/candidates-working'),
            Stat::make(__("admin_dashboard.active_orders"), Orders::where('is_active', Orders::STATUS_ACTIVE)->count())
                ->description(new HtmlString(__("admin_dashboard.to_create_order") . ', <a href="/admin/orders/create"><u>' . __("admin_dashboard.click_here") . '</u></a>'))
                ->color(Color::Teal),
            Stat::make(__("admin_dashboard.active_clients"), Customers::where('status', Customers::STATUS_ACTIVE)->count())
                ->description(new HtmlString(__("admin_dashboard.to_create_client") .', <a href="/admin/customers/create"><u>' . __("admin_dashboard.click_here") . '</u></a>'))
                ->color(Color::Cyan)

        ];
    }
}
