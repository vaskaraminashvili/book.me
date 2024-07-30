<?php

namespace App\Filament\Resources\RentResource\Pages;

use App\Filament\Resources\RentResource;
use Carbon\Carbon;
use Filament\Resources\Pages\EditRecord;

class EditRent extends EditRecord
{

    protected static string $resource = RentResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['date'] = Carbon::parse($data['date_from'])->format('Y-m-d')
            .' to '
            .Carbon::parse($data['date_to'])->format('Y-m-d');
        $data['left_to_pay'] = $data['rate'] - $data['paid'];
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['date_from'] = $data['date'][0];
        $data['date_to'] = $data['date'][1];
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            //            Actions\DeleteAction::make(),
        ];
    }

}
