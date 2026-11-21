<?php

namespace App\Filament\Resources\FeaturedAlumnusResource\Pages;

use App\Filament\Resources\FeaturedAlumnusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeaturedAlumni extends ManageRecords
{
    protected static string $resource = FeaturedAlumnusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
