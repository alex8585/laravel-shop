<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\ViewEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextEntry::make('name')
                    ->label('Name'),

                TextEntry::make('slug')
                    ->label('Slug'),

                TextEntry::make('price')
                    ->label('Price')
                    ->money('USD'),

                TextEntry::make('stock')
                    ->label('Stock'),

                TextEntry::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state ? 'Active' : 'Inactive'
                    ),

                TextEntry::make('category.name')
                    ->label('Category'),

                TextEntry::make('tags.name')
                    ->label('Tags')
                    ->formatStateUsing(
                        fn($record) =>
                        $record->tags->pluck('name')->join(', ')
                    ),

                TextEntry::make('description')
                    ->label('Description')
                    ->html()
                    ->columnSpanFull(),


                ImageEntry::make('image')
                    ->label('Main image')
                    ->columnSpan(1),
                ViewEntry::make('gallery')
                    ->label('Gallery')
                    ->columnSpan(1)
                    ->view('filament.infolists.gallery'),

            ]);
    }
}

