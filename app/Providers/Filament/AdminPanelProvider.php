<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\HtmlString;
use Filament\Navigation\MenuItem;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->spa() // agar mengurangi reload delay
            ->login()
            ->emailVerification()
            ->profile()
            ->favicon(asset('logo-prov-jatim.png'))
            ->colors([
                'primary' => [
                    50 => '#FFF9E6',
                    100 => '#FFF3CC',
                    200 => '#FFE799',
                    300 => '#FFDB66',
                    400 => '#FFCF33',
                    500 => '#FFC107',
                    600 => '#E6AD06',
                    700 => '#CC9A05',
                    800 => '#B38604',
                    900 => '#997303',
                    950 => '#805F02',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            ->font('Poppins')
            ->brandName(new HtmlString('
                <div style="line-height: 1.3;">
                    <div style="
                        font-family: \'Poppins\', sans-serif;
                        font-size: 1.125rem;
                        font-weight: 800;
                        letter-spacing: 0.05em;
                        background: linear-gradient(135deg, #FFC107 0%, #FFD54F 30%, #1A8EC4 70%, #0D6EAD 100%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        background-clip: text;
                        margin-bottom: 0.125rem;
                    ">SIMAGANG</div>
                    <div style="
                        font-family: \'Poppins\', sans-serif;
                        font-size: 0.7rem;
                        font-weight: 600;
                        letter-spacing: 0.025em;
                        color: #64748b;
                    ">Bakorwil III Malang</div>
                </div>
            '))
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                'panels::head.end',
                fn () => view('filament.admin.styles')
            )
            ->userMenuItems([
                MenuItem::make()
                    ->label('Buku Panduan')
                    ->url(fn (): string => asset('buku-panduan-simagang-admin.pdf')) // Sesuaikan linknya
                    ->icon('heroicon-o-book-open')
                    ->openUrlInNewTab(), // Agar tidak menutup dashboard saat dibuka
            ])
            ->databaseNotifications();
     

    }
}
