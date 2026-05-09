<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;



class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('slug', \Illuminate\Support\Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0)
                    ->step(0.01),

                TextInput::make('stock')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->default(true),

                RichEditor::make('description')
                    ->columnSpanFull(),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->preload(),

                FileUpload::make('image')
                    ->image()
                    ->directory('products'),

                FileUpload::make('gallery')
                    ->disk('public')
                    ->multiple()
                    ->image()
                    ->directory('products/gallery')
                    ->reorderable(),
            ]);
    }
}
