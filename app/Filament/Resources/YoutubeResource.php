<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\YoutubeResource\Pages;
use App\Models\Youtube;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class YoutubeResource extends Resource
{
    protected static ?string $model = Youtube::class;

    protected static ?string $navigationIcon = 'untitledui-youtube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->required(),
                Forms\Components\TextInput::make('hashtag')
                    ->label('Hashtag')
                    ->required(),
                    Select::make('jam_post')
                    ->label('Time Post')
                    ->options(function () {
                        $times = [];
                        foreach (range(0, 23) as $hour) {
                            foreach (['00', '30'] as $minute) {
                                $formattedTime = \Carbon\Carbon::createFromTime($hour, $minute)->format('h:i A');
                                $value = \Carbon\Carbon::createFromTime($hour, $minute)->format('H:i');
                                $times[$value] = $formattedTime;
                            }
                        }
                        return $times;
                    })
                    ->required()
                    ->placeholder('Select Time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('hashtag')
                    ->label('Hashtag'),
                    TextColumn::make('jam_post')
                    ->label('Time Post')
                    ->formatStateUsing(function ($state) {
                        return \Carbon\Carbon::parse($state)->format('h:i A'); // Format 12 jam dengan AM/PM
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListYoutubes::route('/'),
            'create' => Pages\CreateYoutube::route('/create'),
            'edit' => Pages\EditYoutube::route('/{record}/edit'),
        ];
    }
}
