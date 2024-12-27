<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Resources\Pages\Page;

class Settings extends Page
{
    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.settings';
}
