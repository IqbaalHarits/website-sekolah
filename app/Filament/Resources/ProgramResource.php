<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Program & Ekstrakurikuler';
    protected static ?string $modelLabel = 'Program';
    protected static ?string $pluralModelLabel = 'Program & Ekstrakurikuler';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($set, $state, $get) => $get('slug') ?: $set('slug', \Illuminate\Support\Str::slug($state))),
            Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Forms\Components\Select::make('type')->label('Tipe')->options(Program::TYPES)
                ->default(Program::TYPE_UNGGULAN)->required()->native(false),
            Forms\Components\TextInput::make('schedule_info')->label('Jadwal (opsional)')->maxLength(255)
                ->placeholder('Setiap Sabtu, 15.30 WIB'),
            Forms\Components\Textarea::make('description')->label('Deskripsi')->rows(4)->columnSpanFull(),
            Forms\Components\FileUpload::make('image')->label('Gambar')->image()->imageEditor()
                ->directory('programs')->maxSize(2048)->columnSpanFull(),
            Forms\Components\TextInput::make('icon')->label('Ikon Heroicon (opsional)')->maxLength(60)
                ->placeholder('heroicon-o-book-open'),
            Forms\Components\TextInput::make('order')->label('Urutan')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Gambar')->square(),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->weight('semibold'),
                Tables\Columns\TextColumn::make('type')->label('Tipe')->badge()
                    ->formatStateUsing(fn (string $state) => Program::TYPES[$state] ?? $state)
                    ->color(fn (string $state) => $state === Program::TYPE_UNGGULAN ? 'primary' : 'warning'),
                Tables\Columns\TextColumn::make('order')->label('Urutan')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([Tables\Filters\SelectFilter::make('type')->label('Tipe')->options(Program::TYPES)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePrograms::route('/')];
    }
}
