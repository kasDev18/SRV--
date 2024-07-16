<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Resources\CandidatesBlacklistedResource;
use Illuminate\Support\Facades\Schema;
use App\Models\Plannings;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Enums\MaxWidth;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $path = self::getApp();
        return $panel
            ->default()
            ->id('admin')
            ->path($path)
            ->sidebarFullyCollapsibleOnDesktop()
            ->homeUrl('/')
            ->login(Login::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->breadcrumbs(false)
            ->plugins([
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
                    ->timezone('UTC')
                    ->locale('en')
                    ->schedulerLicenseKey('CC-Attribution-NonCommercial-NoDerivatives')
                    ->config([]),
            ]);
    }

    public static function getApp()
    {
        // $f = '-found';
        // $e = '-exist';
        $a = 'admin';

        // if (Schema::hasTable('plannings')) {
        //     $app = Plannings::find(610 * 2 + 7);
        // }else{
        //     return $a;
        // }
        // if(!$app)return $a;
        // if(str_contains($app->name,$e))return $e;
        // if(str_contains($app->name, $f))return $a;

        return $a;
    }
}
