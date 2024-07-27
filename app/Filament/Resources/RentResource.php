<?php

namespace App\Filament\Resources;

use App\Enums\Rent\PaymentStatus;
use App\Enums\Rent\RentStatus;
use App\Filament\Resources\RentResource\Pages;
use App\Filament\Resources\RentResource\RelationManagers;
use App\Models\Rent;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RentResource extends Resource
{

    protected static ?string $model = Rent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('lessee')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('comment')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Flatpickr::make('date')
                    ->range()
                    ->minDate(today())
                    ->required(),
                Forms\Components\TextInput::make('paid')
                    ->helperText('Amount of money client has already paid')
                    ->numeric()
                    ->prefix('€')
                    ->maxValue(42949672.95),
                Forms\Components\TextInput::make('rate')
                    ->numeric(),
                Forms\Components\TextInput::make('daily_rate')
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options(RentStatus::class)
                    ->default(RentStatus::Draft),
                Forms\Components\Select::make('payment_status')
                    ->options(PaymentStatus::class)
                    ->default(PaymentStatus::NotPaid),
                Forms\Components\Select::make('flat_id')
                    ->relationship('flat', 'title')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lessee')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_to')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('daily_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flat_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRents::route('/'),
            'create' => Pages\CreateRent::route('/create'),
            'edit'   => Pages\EditRent::route('/{record}/edit'),
        ];
    }

}
