<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Galeri Foto';
    protected static ?string $modelLabel = 'Foto';
    protected static ?string $pluralModelLabel = 'Galeri Foto';
    protected static ?int $navigationSort = 4;

    public const CATEGORIES = [
        'kegiatan' => 'Kegiatan', 'akademik' => 'Akademik', 'ekstrakurikuler' => 'Ekstrakurikuler',
        'keagamaan' => 'Keagamaan', 'fasilitas' => 'Fasilitas', 'wisuda' => 'Wisuda & Acara',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255),
            Forms\Components\Select::make('category')->label('Kategori')->options(self::CATEGORIES)
                ->default('kegiatan')->required()->native(false),
            Forms\Components\FileUpload::make('image')->label('Foto')->image()->imageEditor()
                ->directory('galleries')->maxSize(4096)->required()->columnSpanFull(),
            Forms\Components\TextInput::make('caption')->label('Keterangan')->maxLength(500)->columnSpanFull(),
            Forms\Components\DatePicker::make('taken_at')->label('Tanggal Pengambilan')->native(false),
            Forms\Components\TextInput::make('order')->label('Urutan')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->label('Tampilkan')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Foto')->square()->size(64),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->weight('semibold'),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()
                    ->formatStateUsing(fn (string $state) => self::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('taken_at')->label('Tanggal')->date('d M Y')->toggleable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Tampil'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([Tables\Filters\SelectFilter::make('category')->label('Kategori')->options(self::CATEGORIES)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageGalleries::route('/')];
    }
}
