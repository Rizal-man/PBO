<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\fileUpload;
use Filament\Schemas\Schema;

class ItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_item')
                    ->required(),
                TextInput::make('kode_item')
                    ->required(),
                TextInput::make('jumlah_item')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_item')
                    ->required()
                    ->numeric(),
                FileUpload::make('images')
                    ->image()
                    ->directory('item-images')
                    ->maxSize(1024),
            ]);
    }
}
