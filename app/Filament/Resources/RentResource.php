<?php

namespace App\Filament\Resources;

use App\Enums\Rent\PaymentStatus;
use App\Enums\Rent\RentStatus;
use App\Filament\Resources\RentResource\Pages;
use App\Filament\Resources\RentResource\RelationManagers;
use App\Models\Rent;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Filament\Forms;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;

class RentResource extends Resource
{

    public static $rent_history;

    protected static ?string $model = Rent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Old Records')
                    ->schema([
                        ViewField::make('rent_history')
                            ->view('filament.components.rent_history_table'),
                    ]),
                Forms\Components\Section::make('Main')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('flat_id')
                            ->relationship('flat', 'title')
                            ->required(),
                        Forms\Components\TextInput::make('lessee')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mobile')
                            ->afterStateUpdated(function (Set $set, $state) {
                                self::$rent_history
                                    = self::$model::query()
                                    ->where('mobile', 'like',
                                        '%'.$state.'%')
                                    ->limit(5)
                                    ->get();
                                $set('rent_history', self::$rent_history);
                                dump(self::$rent_history);
                            })
                            ->debounce(200),

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
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('comment')
                            ->columnSpan(1)
                            ->placeholder('3 bavshvit da katit')
                            ->helperText(
                                'comment to remind lesser in the future like nickname'
                            )
                            ->maxLength(255),
                        RatingStar::make('rating')
                            ->hint('rate lessee from 1 to 5 ')
                            ->columnSpan(1)
                            ->label('Rating'),
                        Forms\Components\RichEditor::make('lessee_comment')
                            ->columnSpanFull()
                            ->hint('Here you can comment about lessee if they were good/bad'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lessee')
                    ->description(function (Rent $rent) {
                        return 'Flat :'.$rent->flat->title;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('range')
                    ->label('Rent range'),
                //                    ->state(function (Rent $record) {
                //                        return $record['date_from'];
                //                    }),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric()
                    ->sortable()
                    ->description(function (Rent $rent) {
                        if ($rent->payment_status == PaymentStatus::BPaid) {
                            return 'Left to pay '.intval($rent->rate
                                    - $rent->paid);
                        }
                    }),
                //                Tables\Columns\TextColumn::make('daily_rate')
                //                    ->numeric()
                //                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->options(RentStatus::class)
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColors();
                    })
                    ->searchable(),
                //                Tables\Columns\TextColumn::make('flat.title')
                //                    ->sortable(),
                RatingStarColumn::make('rating')
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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

    protected static function existingRentsTable(
        string $mobile,
        HasTable $livewire
    ): Tables\Table {
        return Tables\Table::make($livewire)
            ->query(Rent::query()->where('id', 1))
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->date(),
                Tables\Columns\TextColumn::make('rate')
                    ->money('USD'),
                // Add other columns as needed
            ])
            ->query(Rent::query()->where('id', 1))
            ->paginated(false);
    }

    public function mount()
    {
        self::$rent_history = collect();
    }

}
