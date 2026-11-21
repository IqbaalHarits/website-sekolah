<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicScheduleResource\Pages;
use App\Models\AcademicSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AcademicScheduleResource extends Resource
{
    protected static ?string $model = AcademicSchedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Jadwal & Kalender';
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $pluralModelLabel = 'Jadwal & Kalender Akademik';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Judul Kegiatan')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\Select::make('category')->label('Kategori')
                ->options(AcademicSchedule::CATEGORIES)->default('tahunan')->required()->native(false),
            Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true)->inline(false),
            Forms\Components\DatePicker::make('start_date')->label('Tanggal Mulai')->required()->native(false)->displayFormat('d M Y'),
            Forms\Components\DatePicker::make('end_date')->label('Tanggal Selesai')->native(false)->displayFormat('d M Y')
                ->afterOrEqual('start_date')->helperText('Kosongkan jika kegiatan satu hari.'),
            Forms\Components\Textarea::make('description')->label('Keterangan')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Kegiatan')->searchable()->weight('semibold')->wrap(),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()
                    ->formatStateUsing(fn (string $state) => AcademicSchedule::CATEGORIES[$state] ?? $state)
                    ->color(fn (string $state) => $state === 'tahunan' ? 'primary' : 'warning'),
                Tables\Columns\TextColumn::make('start_date')->label('Mulai')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('end_date')->label('Selesai')->date('d M Y')->placeholder('—'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('start_date')
            ->filters([
                Tables\Filters\SelectFilter::make('category')->label('Kategori')->options(AcademicSchedule::CATEGORIES),
                Tables\Filters\TernaryFilter::make('is_active')->label('Status'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageAcademicSchedules::route('/')];
    }
}
