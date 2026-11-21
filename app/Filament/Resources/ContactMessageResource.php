<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Pesan Masuk';
    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $modelLabel = 'Pesan';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';

    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::unread()->count();

        return $count ?: null;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make()->schema([
                Infolists\Components\TextEntry::make('name')->label('Nama'),
                Infolists\Components\TextEntry::make('email')->label('Email')->copyable(),
                Infolists\Components\TextEntry::make('phone')->label('Telepon')->placeholder('—'),
                Infolists\Components\TextEntry::make('created_at')->label('Dikirim')->dateTime('d M Y H:i'),
                Infolists\Components\TextEntry::make('subject')->label('Subjek')->columnSpanFull()->weight('bold'),
                Infolists\Components\TextEntry::make('message')->label('Pesan')->columnSpanFull()->prose(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('read_at')->label('')->icon(fn ($state) => $state ? 'heroicon-o-envelope-open' : 'heroicon-s-envelope')
                    ->color(fn ($state) => $state ? 'gray' : 'primary'),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->weight('semibold'),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Subjek')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Diterima')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('read_at')->label('Status Baca')->nullable()
                    ->trueLabel('Sudah dibaca')->falseLabel('Belum dibaca'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->after(fn (ContactMessage $record) => $record->update(['read_at' => $record->read_at ?? now()])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markRead')->label('Tandai dibaca')->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['read_at' => now()])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListContactMessages::route('/')];
    }
}
