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
use Filament\FontProviders\GoogleFontProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->renderHook(
                \Filament\View\PanelsRenderHook::STYLES_AFTER,
                function (): \Illuminate\Support\HtmlString {
                    if (! request()->is('*/login')) {
                        return new \Illuminate\Support\HtmlString('');
                    }
                    return new \Illuminate\Support\HtmlString('
                    <style>
                        /* Isolasi Gaya CSS khusus halaman Simple/Auth (Login) */
                        .fi-simple-layout {
                            position: fixed !important;
                            top: 0 !important;
                            left: 0 !important;
                            width: 100vw !important;
                            height: 100vh !important;
                            margin: 0 !important;
                            padding: 1rem !important;
                            box-sizing: border-box !important;
                            background-color: #06080e !important;
                            background-image: 
                                radial-gradient(circle at 15% 25%, rgba(29, 78, 216, 0.15) 0%, transparent 50%),
                                radial-gradient(circle at 85% 75%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px) !important;
                            background-size: 100% 100%, 100% 100%, 30px 30px, 30px 30px !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            overflow: hidden !important;
                            font-family: "Poppins", sans-serif !important;
                            z-index: 99999 !important;
                        }
                        
                        /* Animasi fade-in saat kartu dimuat */
                        @keyframes fadeIn {
                            from { opacity: 0; transform: translateY(15px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                        
                        /* Wrapper kartu login */
                        .fi-simple-layout .fi-simple-main-ctn {
                            background: transparent !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            padding: 0 !important;
                            min-height: auto !important;
                            width: 100% !important;
                            box-shadow: none !important;
                        }
                        
                        /* Kartu Glassmorphism gelap */
                        .fi-simple-layout .fi-simple-main {
                            background: rgba(17, 24, 39, 0.8) !important;
                            backdrop-filter: blur(24px) !important;
                            -webkit-backdrop-filter: blur(24px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.08) !important;
                            border-radius: 24px !important;
                            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6) !important;
                            padding: 2rem 1.5rem 1.5rem 1.5rem !important;
                            width: 100% !important;
                            max-width: 380px !important;
                            box-sizing: border-box !important;
                            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
                        }
                        
                        .fi-simple-layout .fi-simple-page {
                            background: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            padding: 0 !important;
                            width: 100% !important;
                            transform: none !important;
                        }
                        
                        .fi-simple-layout .fi-simple-page::before,
                        .fi-simple-layout .fi-simple-page::after {
                            display: none !important;
                        }
                        
                        /* Sembunyikan logo & header bawaan Filament */
                        .fi-simple-layout .fi-simple-header {
                            display: none !important;
                        }
                        
                        /* Kustomisasi label dengan Bahasa Indonesia */
                        .fi-simple-layout label {
                            display: flex !important;
                            justify-content: space-between !important;
                            align-items: center !important;
                            margin-bottom: 0.5rem !important;
                        }
                        
                        /* Sembunyikan teks label bawaan (span) agar tidak ganda */
                        .fi-simple-layout label[for*="email"] span,
                        .fi-simple-layout label[for*="login"] span,
                        .fi-simple-layout label[for*="password"] span {
                            display: none !important;
                        }
                        
                        .fi-simple-layout label[for*="email"]::before,
                        .fi-simple-layout label[for*="login"]::before {
                            content: "EMAIL" !important;
                            font-size: 0.75rem !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.05em !important;
                            font-weight: 700 !important;
                            color: #94a3b8 !important;
                        }
                        
                        .fi-simple-layout label[for*="password"]::before {
                            content: "SANDI" !important;
                            font-size: 0.75rem !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.05em !important;
                            font-weight: 700 !important;
                            color: #94a3b8 !important;
                        }
                        
                        /* Kustomisasi Wrapper Input */
                        .fi-simple-layout .fi-input-wrp {
                            background-color: #0b0f19 !important;
                            border: 1px solid #334155 !important;
                            border-radius: 10px !important;
                            transition: all 0.2s ease !important;
                            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.2) !important;
                            height: 48px !important;
                            box-sizing: border-box !important;
                        }
                        
                        .fi-simple-layout .fi-input-wrp:focus-within {
                            border-color: #1a56db !important;
                            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.25) !important;
                        }
                        
                        /* Wrapper Input Invalid */
                        .fi-simple-layout .fi-input-wrp.ring-danger-600,
                        .fi-simple-layout .fi-input-wrp.ring-danger-500 {
                            border-color: #ef4444 !important;
                            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
                        }
                        
                        /* Elemen Input di dalam Wrapper */
                        .fi-simple-layout .fi-input-wrp input {
                            background: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            color: #ffffff !important;
                            padding: 0.75rem 1rem 0.75rem 3rem !important;
                            font-size: 0.9rem !important;
                            height: 46px !important;
                            box-sizing: border-box !important;
                        }
                        
                        .fi-simple-layout .fi-input-wrp input:focus {
                            ring: none !important;
                            outline: none !important;
                        }
                        
                        .fi-simple-layout .fi-input-wrp.ring-1 {
                            --tw-ring-color: transparent !important;
                            ring: none !important;
                        }
                        
                        /* Ikon Input menggunakan selektor ID persisten */
                        .fi-simple-layout input[id*="email"],
                        .fi-simple-layout input[id*="login"],
                        .fi-simple-layout input[name*="email"],
                        .fi-simple-layout input[name*="login"] {
                            background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%2394a3b8" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>\') !important;
                            background-repeat: no-repeat !important;
                            background-position: 14px center !important;
                            background-size: 20px 20px !important;
                        }
                        
                        .fi-simple-layout input[id*="password"],
                        .fi-simple-layout input[name*="password"] {
                            background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%2394a3b8" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m-3.418 3.84a6 6 0 111.414-1.414M6.556 9h.008M15 13l-3-3m0 0l-1.5 1.5M12 10l-1.5-1.5" /></svg>\') !important;
                            background-repeat: no-repeat !important;
                            background-position: 14px center !important;
                            background-size: 20px 20px !important;
                        }
                        
                        /* Penyelarasan Tombol Mata */
                        .fi-simple-layout .fi-input-wrp button {
                            background: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            color: #94a3b8 !important;
                            padding-right: 14px !important;
                            padding-left: 8px !important;
                            height: 100% !important;
                            transition: color 0.2s ease !important;
                        }
                        
                        .fi-simple-layout .fi-input-wrp button:hover {
                            color: #ffffff !important;
                        }
                        
                        /* Sembunyikan salah satu ikon mata */
                        .fi-simple-layout .fi-input-wrp button svg.hidden,
                        .fi-simple-layout .fi-input-wrp button svg[class*="hidden"],
                        .fi-simple-layout .fi-input-wrp button svg[style*="display: none"],
                        .fi-simple-layout .fi-input-wrp button [style*="display: none"] {
                            display: none !important;
                        }
                        
                        /* Sembunyikan garis pemisah tombol mata default */
                        .fi-simple-layout .fi-input-wrp > div {
                            border: none !important;
                            box-shadow: none !important;
                            background: transparent !important;
                        }
                        
                        .fi-simple-layout input::placeholder {
                            color: #475569 !important;
                        }
                        
                        /* Tombol login gradasi biru premium */
                        .fi-simple-layout button[type="submit"] {
                            background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 50%, #0284c7 100%) !important;
                            border-radius: 10px !important;
                            padding: 0.8rem 1.5rem !important;
                            font-weight: 700 !important;
                            font-size: 0.9rem !important;
                            color: #ffffff !important;
                            border: none !important;
                            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3) !important;
                            transition: all 0.2s ease !important;
                            width: 100% !important;
                            margin-top: 1rem !important;
                        }
                        
                        .fi-simple-layout button[type="submit"]:hover {
                            transform: translateY(-1px) !important;
                            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.45) !important;
                            opacity: 0.95 !important;
                        }
                        
                        .fi-simple-layout button[type="submit"]:active {
                            transform: translateY(0.5px) !important;
                        }
                        
                        /* Mengganti teks tombol dengan "MASUK" */
                        .fi-simple-layout button[type="submit"] span {
                            font-size: 0 !important;
                        }
                        .fi-simple-layout button[type="submit"] span::before {
                            content: "MASUK" !important;
                            font-size: 0.9rem !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.05em !important;
                        }
                        .fi-simple-layout button[type="submit"] span::after {
                            content: " \2192" !important;
                            font-weight: bold !important;
                            margin-left: 4px !important;
                        }
                        
                        /* Checkbox "Ingat Saya" */
                        .fi-simple-layout label:has(input[type="checkbox"]) span {
                            font-size: 0 !important;
                        }
                        .fi-simple-layout label:has(input[type="checkbox"]) span::before {
                            content: "INGAT SAYA" !important;
                            font-size: 0.75rem !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.05em !important;
                            font-weight: 700 !important;
                            color: #94a3b8 !important;
                        }
                        
                        .fi-simple-layout input[type="checkbox"] {
                            border: 1px solid #475569 !important;
                            background-color: #0b0f19 !important;
                            border-radius: 4px !important;
                            color: #1a56db !important;
                            width: 15px !important;
                            height: 15px !important;
                            transition: all 0.2s ease !important;
                        }
                        
                        .fi-simple-layout input[type="checkbox"]:focus {
                            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.2) !important;
                            border-color: #1a56db !important;
                        }
                        
                        .fi-simple-layout input[type="checkbox"]:checked {
                            background-color: #1a56db !important;
                            border-color: #1a56db !important;
                        }
                        
                        /* Lupa Kata Sandi */
                        .fi-simple-layout form a[href*="password-reset"] {
                            font-size: 0 !important;
                        }
                        .fi-simple-layout form a[href*="password-reset"]::before {
                            content: "LUPA SANDI?" !important;
                            font-size: 0.75rem !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.05em !important;
                            color: #64748b !important;
                            transition: color 0.2s ease !important;
                        }
                        .fi-simple-layout form a[href*="password-reset"]:hover::before {
                            color: #ffffff !important;
                        }
                        
                        /* Pesan Kesalahan Form */
                        .fi-simple-layout .fi-fo-field-wrp-error-message,
                        .fi-simple-layout .text-danger-600 {
                            color: #f87171 !important;
                            font-size: 0.75rem !important;
                            margin-top: 0.35rem !important;
                            font-weight: 600 !important;
                        }
                    </style>
                    ');
                }
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn (): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString('
                    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px; text-align: center; width: 100%;">
                        <!-- Blue/Cyan Glowing Badge Logo FJ -->
                        <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #1d4ed8 0%, #06b6d4 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; box-shadow: 0 8px 16px rgba(29, 78, 216, 0.25); border: 1px solid rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to top right, rgba(255, 255, 255, 0.1), transparent);"></div>
                            <svg width="28" height="28" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #ffffff;">
                                <path d="M16 16H38V22H24V29H36V35H24V48H16V16Z" fill="currentColor"/>
                                <path d="M42 16H50V38C50 44 46 48 40 48H32V42H40C41 42 42 41 42 40V16Z" fill="currentColor"/>
                            </svg>
                        </div>
                        
                        <h2 style="font-size: 16px; font-weight: 800; color: #ffffff; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 2px 0; line-height: 1.2;">
                            AKSES ADMIN
                        </h2>
                        <p style="font-size: 11px; color: #38bdf8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 6px 0; line-height: 1.2;">
                            Fajar Jaya Aluminium
                        </p>
                        <p style="font-size: 11px; color: #94a3b8; font-weight: 500; margin: 0; line-height: 1.4;">
                            Masuk untuk mengelola konten website.
                        </p>
                    </div>
                ')
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString('
                    <div style="margin-top: 24px; text-align: center; width: 100%;">
                        <a href="/" style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: #94a3b8; text-decoration: none; transition: all 0.2s ease; margin-bottom: 16px;" onmouseover="this.style.color=\'#ffffff\'" onmouseout="this.style.color=\'#94a3b8\'">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 2px;"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Kembali ke Website
                        </a>
                        <div style="font-size: 10px; color: #475569; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; border-top: 1px solid rgba(255, 255, 255, 0.04); padding-top: 12px;">
                            &copy; 2026 Fajar Jaya Aluminium &bull; Version 1.0
                        </div>
                    </div>
                ')
            )
            ->colors([
                'primary' => '#1A56DB',
                'gray' => Color::Slate,
                'info' => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('Poppins', provider: GoogleFontProvider::class)
            ->sidebarCollapsibleOnDesktop()
            ->spa()
            ->brandName('Fajar Jaya CMS')
            ->favicon(\App\Models\Setting::first()?->site_logo ? \Illuminate\Support\Facades\Storage::url(\App\Models\Setting::first()?->site_logo) : null)
            ->profile()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\DashboardChart::class,
                \App\Filament\Widgets\PopularPostsChart::class,
                \App\Filament\Widgets\ProductCategoryChart::class,
                \App\Filament\Widgets\LatestMessages::class,
                \App\Filament\Widgets\LatestProducts::class,
                \App\Filament\Widgets\LatestProjects::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
