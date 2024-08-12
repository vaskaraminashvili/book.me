<?php

namespace App\Filament\Resources\FlatResource\Pages;

use App\Filament\Resources\FlatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFlat extends CreateRecord
{
    protected static string $resource = FlatResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
