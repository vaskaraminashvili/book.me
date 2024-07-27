<?php

namespace App\Filament\Resources\RentResource\Pages;

use App\Filament\Resources\RentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRent extends CreateRecord
{

    protected static string $resource = RentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['date_from'] = $data['date'][0];
        $data['date_to'] = $data['date'][1];
        return $data;
    }

}
