<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Support\Enums\FontWeight;
use Filament\Support\RawJs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-m-archive-box';
    protected static ?string $navigationGroup = 'Productos del sistema';
    
    protected static ?string $navigationLabel = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Product Info')
                ->columns(3)
                ->schema([
                    Hidden::make('oldNumber')
                    ->default(99999999),
                    Forms\Components\TextInput::make('code')
                        ->required()
                        ->unique()
                        ->hiddenOn('edit')
                        ->placeholder('codigo del producto')
                        ->numeric(),
                    Forms\Components\TextInput::make('name')
                        ->placeholder('nombre del producto')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('price')
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefix('$'),
                    Forms\Components\Toggle::make('product_status')
                        ->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->weight(FontWeight::Bold)
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('product_status')
                ->boolean()
                ->wrap(),
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
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Crear producto')
                    ->url('products/create')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->reorderable('name');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
