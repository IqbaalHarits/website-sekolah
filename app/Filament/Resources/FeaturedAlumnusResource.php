<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedAlumnusResource\Pages;
use App\Models\FeaturedAlumnus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeaturedAlumnusResource extends Resource
{
    protected static ?string $model = FeaturedAlumnus::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Alumni Pilihan';
    protected static ?string $modelLabel = 'Alumni';
    protected static ?string $pluralModelLabel = 'Alumni Pilihan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nama')->required()->maxLength(255),
            Forms\Components\TextInput::make('graduation_year')->label('Tahun Lulus')->required()->numeric()
                ->minValue(1950)->maxValue((int) date('Y'))->default((int) date('Y') - 5),
            Forms\Components\TextInput::make('current_position')->label('Posisi / Profesi Saat Ini')->maxLength(255)->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')->label('Foto')->image()->avatar()->imageEditor()
                ->directory('alumni')->maxSize(2048)->columnSpanFull(),
            Forms\Components\Textarea::make('testimonial')->label('Testimoni')->required()->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('success_story')->label('Kisah Sukses (opsional)')->rows(4)->columnSpanFull(),
            Forms\Components\TextInput::make('order')->label('Urutan')->numeric()->default(0),
            Forms\Components\Toggle::make('is_featured')->label('Tampilkan di website')->default(true)->inline(false),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->label('Foto')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->weight('semibold'),
                Tables\Columns\TextColumn::make('graduation_year')->label('Lulus')->sortable(),
                Tables\Columns\TextColumn::make('current_position')->label('Posisi')->limit(40)->toggleable(),
                Tables\Columns\TextColumn::make('order')->label('Urutan')->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured')->label('Tampil'),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([Tables\Filters\TernaryFilter::make('is_featured')->label('Tampil')])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageFeaturedAlumni::route('/')];
    }
}
