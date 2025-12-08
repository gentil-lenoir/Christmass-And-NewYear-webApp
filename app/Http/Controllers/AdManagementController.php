<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdManagementController extends Controller
{
    public function index()
    {
        $adSettings = Cache::get('ad_settings', [
            'smartlink' => [
                'enabled' => true,
                'key' => env('ADSTERRA_SMARTLINK_KEY', ''),
            ],
            'native_banner' => [
                'enabled' => true,
                'key' => env('ADSTERRA_NATIVE_KEY', ''),
            ],
            'popunder' => [
                'enabled' => true,
                'key' => env('ADSTERRA_POPUNDER_KEY', ''),
            ],
            'social_bar' => [
                'enabled' => true,
                'key' => env('ADSTERRA_SOCIAL_KEY', ''),
            ],
        ]);

        return view('admin.ads-management', compact('adSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'smartlink.enabled' => 'boolean',
            'smartlink.key' => 'nullable|string',
            'native_banner.enabled' => 'boolean',
            'native_banner.key' => 'nullable|string',
            'popunder.enabled' => 'boolean',
            'popunder.key' => 'nullable|string',
            'social_bar.enabled' => 'boolean',
            'social_bar.key' => 'nullable|string',
        ]);

        Cache::put('ad_settings', $validated, now()->addDays(30));

        return redirect()->back()->with('success', 'Paramètres des publicités mis à jour avec succès.');
    }

    public static function isAdEnabled($adType)
    {
        $settings = Cache::get('ad_settings', []);
        return $settings[$adType]['enabled'] ?? true;
    }

    public static function getAdKey($adType)
    {
        $settings = Cache::get('ad_settings', []);
        return $settings[$adType]['key'] ?? env('ADSTERRA_' . strtoupper($adType) . '_KEY', '');
    }
}