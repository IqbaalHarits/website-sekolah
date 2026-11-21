<?php

namespace App\Filament\Resources\AcademicScheduleResource\Pages;

use App\Filament\Resources\AcademicScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAcademicSchedules extends ManageRecords
{
    protected static string $resource = AcademicScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
