<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryDetailResource\Pages;
use App\Filament\Resources\InventoryDetailResource\RelationManagers;
use App\Models\InventoryDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryDetailResource extends Resource
{
    protected static ?string $model = InventoryDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inventory entry')
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('product_id')
                        ->relationship('products', 'name')
                        ->required(),
                    Forms\Components\TextInput::make('unit_cost')
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->required()
                        ->prefix('$'),
                    Forms\Components\TextInput::make('quantity')
                        ->required()
                        ->numeric(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInventoryDetails::route('/'),
            'create' => Pages\CreateInventoryDetail::route('/create'),
            'edit' => Pages\EditInventoryDetail::route('/{record}/edit'),
        ];
    }
}
