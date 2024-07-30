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
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                Forms\Components\Section::make('Main')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('flat_id')
                            ->relationship('flat', 'title')
                            ->required(),
                        Forms\Components\TextInput::make('lessee')
                            ->required()
                            ->maxLength(255),

                    ]),
                Forms\Components\Section::make('Finance')
                    ->columns(2)
                    ->schema([
                        Flatpickr::make('date')
                            ->reactive()
                            ->range()
                            ->minDate(today())
                            ->required()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                Rent::setRates($get, $set);
                            }),
                        Forms\Components\TextInput::make('paid')
                            ->debounce(500)
                            ->helperText(
                                'Amount of money client has already paid'
                            )
                            ->numeric()
                            ->suffix('.00')
                            ->prefix('₾')
                            ->maxValue(42949672.95)
                            ->afterStateUpdated(function (
                                Set $set,
                                Get $get
                            ) {
                                if ($get('rate')) {
                                    $left_to_pay = intval($get('rate'))
                                        - intval($get('paid'));
                                    $set('left_to_pay', $left_to_pay);
                                }
                            }),

                        Forms\Components\TextInput::make('daily_rate')
                            ->live(debounce: 500)
                            ->numeric()
                            ->suffix('.00')
                            ->prefix('₾')
                            ->maxValue(42949672.95)
                            ->afterStateUpdated(function (
                                Set $set,
                                Get $get,
                            ) {
                                $number_of_days
                                    = Rent::calculateDaysDiff($get('date'));
                                if ($number_of_days > 1) {
                                    $full_rate = $number_of_days
                                        * $get('daily_rate');
                                    $set('rate', $full_rate);
                                }
                                if ($get('rate')) {
                                    $left_to_pay = intval($get('rate'))
                                        - intval($get('paid'));
                                    $set('left_to_pay', $left_to_pay);
                                }
                            }),
                        Forms\Components\TextInput::make('rate')
                            ->live(debounce: 500)
                            ->numeric()
                            ->suffix('.00')
                            ->prefix('₾')
                            ->maxValue(42949672.95)
                            ->afterStateUpdated(function (Set $set, Get $get,) {
                                $number_of_days
                                    = Rent::calculateDaysDiff($get('date'));
                                if ($number_of_days > 1) {
                                    $daily_rate = intval($get('rate')
                                        / $number_of_days);
                                    $set('daily_rate', $daily_rate);
                                }
                                if ($get('rate')) {
                                    $left_to_pay = intval($get('rate'))
                                        - intval($get('paid'));
                                    $set('left_to_pay', $left_to_pay);
                                }
                            }),
                        Forms\Components\TextInput::make('left_to_pay')
                            ->columnSpanFull()
                            ->default(1)
                            ->readOnly()
                            ->helperText(
                                'Amount of money client has already paid'
                            )
                            ->numeric()
                            ->suffix('.00')
                            ->prefix('₾')
                            ->maxValue(42949672.95)
                            ->extraAttributes(function ($state) {
                                $bgColor
                                    = '#3067e754'; // your logic to fetch the right color using the Enum here
                                // dd($state) // you can use $state to access the current state of the field
                                return ['style' => "background-color: {$bgColor}"];
                            })
                        ,

                    ]),
                Forms\Components\Section::make('Status')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options(RentStatus::class)
                            ->default(RentStatus::Draft),
                        Forms\Components\Select::make('payment_status')
                            ->options(PaymentStatus::class)
                            ->default(PaymentStatus::NotPaid),
                    ]),
                Forms\Components\Section::make('Additional information')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('comment')
                            ->placeholder('3 bavshvit da katit')
                            ->helperText(
                                'comment to remind lesser in the future like nickname'
                            )
                            ->maxLength(255),

                    ]),

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
                Tables\Actions\DeleteAction::make(),
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
