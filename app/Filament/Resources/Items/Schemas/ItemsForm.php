<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\fileUpload;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Schema;

class ItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_item')
                    ->required(),
                TextInput::make('jumlah_item')
                    ->numeric(),
                TextInput::make('harga_item')
                    ->required()
                    ->numeric(),
                Radio::make('kode_item')
                    ->options([
                        'fishit' => 'Fishit',
                        'bloxfruit' => 'Blox Fruit',
                        'sailor Piece' => 'Sailor Piece',
                        'grow a garden' => 'Grow a Garden',
                    ]),
                FileUpload::make('images')
                    ->image()
                    ->disk('public')
                    ->directory('item-images')
                    ->maxSize(1024),
            ]);
    }
}
