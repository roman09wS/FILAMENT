<?php

namespace App\Filament\Resources;
use App\Models\Product;
use App\Models\InventoryDetail;
use App\Filament\Resources\InventoryDetailResource\Pages;
use App\Filament\Resources\InventoryDetailResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryDetailResource extends Resource
{
    protected static ?string $model = InventoryDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Inventory Entry';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inventory entry')
                ->columns(3)
                ->schema([
                    Select::make('product_id')
                        ->label('Products')
                        ->hiddenOn('edit')
                        ->searchable()
                        ->native(false)
                        ->options(fn (): array => Product::whereDoesntHave('inventoryDetails')->where('product_status',1)->pluck('name', 'id')->toArray() )
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
                Tables\Columns\TextColumn::make('unit_cost')
                ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                ->searchable(),
                Tables\Columns\TextColumn::make('product.name')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
