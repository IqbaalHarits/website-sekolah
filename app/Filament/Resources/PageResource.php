<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Halaman Profil';
    protected static ?string $modelLabel = 'Halaman';
    protected static ?string $pluralModelLabel = 'Halaman Statis';
    protected static ?int $navigationSort = 2;

    public const GROUPS = ['profil' => 'Profil', 'akademik' => 'Akademik', 'kesiswaan' => 'Kesiswaan', 'ppdb' => 'PPDB'];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make([
                Forms\Components\Section::make('Konten')->schema([
                    Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state, $get) => $get('slug') ?: $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true)
                        ->helperText('Slug dipakai di kode: sejarah, sambutan, visi-misi, struktur-organisasi, kurikulum, tata-tertib.'),
                    Forms\Components\Textarea::make('excerpt')->label('Ringkasan')->rows(2)->maxLength(500),
                    Forms\Components\RichEditor::make('content')->label('Isi Halaman')
                        ->fileAttachmentsDirectory('pages')->columnSpanFull(),
                ]),
            ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make([
                Forms\Components\Section::make('Pengaturan')->schema([
                    Forms\Components\Select::make('group')->label('Kelompok')->options(self::GROUPS)
                        ->default('profil')->required()->native(false),
                    Forms\Components\Toggle::make('is_published')->label('Terbit')->default(true),
                    Forms\Components\TextInput::make('order')->label('Urutan')->numeric()->default(0),
                ]),
                Forms\Components\Section::make('Gambar & Penulis')->schema([
                    Forms\Components\FileUpload::make('image')->label('Gambar')->image()->imageEditor()
                        ->directory('pages')->maxSize(3072),
                    Forms\Components\TextInput::make('author_name')->label('Nama Penulis')
                        ->helperText('Mis. nama Kepala Sekolah untuk sambutan.'),
                    Forms\Components\TextInput::make('author_position')->label('Jabatan'),
                ]),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->weight('semibold'),
                Tables\Columns\TextColumn::make('slug')->color('gray'),
                Tables\Columns\TextColumn::make('group')->label('Kelompok')->badge()
                    ->formatStateUsing(fn (string $state) => self::GROUPS[$state] ?? $state),
                Tables\Columns\ToggleColumn::make('is_published')->label('Terbit'),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since()->toggleable(),
            ])
            ->defaultSort('order')
            ->filters([Tables\Filters\SelectFilter::make('group')->label('Kelompok')->options(self::GROUPS)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
