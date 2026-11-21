<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Prestasi Siswa';
    protected static ?string $modelLabel = 'Prestasi';
    protected static ?string $pluralModelLabel = 'Prestasi Siswa';
    protected static ?int $navigationSort = 2;

    public const LEVELS = [
        'Sekolah' => 'Sekolah', 'Kecamatan' => 'Kecamatan', 'Kabupaten/Kota' => 'Kabupaten/Kota',
        'Provinsi' => 'Provinsi', 'Nasional' => 'Nasional', 'Internasional' => 'Internasional',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Nama Lomba / Prestasi')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\TextInput::make('student_name')->label('Nama Siswa / Tim')->maxLength(255),
            Forms\Components\TextInput::make('rank')->label('Peringkat')->placeholder('Juara 1')->maxLength(60),
            Forms\Components\Select::make('level')->label('Tingkat')->options(self::LEVELS)->native(false),
            Forms\Components\TextInput::make('year')->label('Tahun')->numeric()->required()->default((int) date('Y')),
            Forms\Components\Textarea::make('description')->label('Keterangan')->rows(3)->columnSpanFull(),
            Forms\Components\FileUpload::make('image')->label('Foto')->image()->imageEditor()
                ->directory('achievements')->maxSize(2048)->columnSpanFull(),
            Forms\Components\Toggle::make('is_active')->label('Tampilkan')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Foto')->square(),
                Tables\Columns\TextColumn::make('title')->label('Prestasi')->searchable()->weight('semibold')->wrap(),
                Tables\Columns\TextColumn::make('student_name')->label('Siswa')->searchable(),
                Tables\Columns\TextColumn::make('rank')->label('Peringkat')->badge(),
                Tables\Columns\TextColumn::make('level')->label('Tingkat')->toggleable(),
                Tables\Columns\TextColumn::make('year')->label('Tahun')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Tampil'),
            ])
            ->defaultSort('year', 'desc')
            ->filters([Tables\Filters\SelectFilter::make('level')->label('Tingkat')->options(self::LEVELS)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageAchievements::route('/')];
    }
}
