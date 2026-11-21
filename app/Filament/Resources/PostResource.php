<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Berita & Informasi';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita & Informasi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state, $get) => $get('slug') ?: $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('excerpt')->label('Ringkasan')->rows(2)->maxLength(500)
                        ->helperText('Kosongkan untuk dibuat otomatis dari isi berita.'),
                    Forms\Components\RichEditor::make('content')->label('Isi Berita')->required()
                        ->fileAttachmentsDirectory('posts')->columnSpanFull(),
                ]),
            ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make([
                Forms\Components\Section::make('Publikasi')->schema([
                    Forms\Components\Toggle::make('is_published')->label('Terbitkan')->default(false),
                    Forms\Components\DateTimePicker::make('published_at')->label('Tanggal Terbit')
                        ->native(false)->default(now()),
                    Forms\Components\Select::make('author_id')->label('Penulis')->relationship('author', 'name')
                        ->default(fn () => auth()->id())->native(false)->required(),
                    Forms\Components\Select::make('post_category_id')->label('Kategori')
                        ->relationship('category', 'name')->native(false)->searchable()->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Nama')->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                            Forms\Components\TextInput::make('slug')->required()->unique('post_categories', 'slug'),
                        ]),
                ]),
                Forms\Components\Section::make('Gambar Utama')->schema([
                    Forms\Components\FileUpload::make('featured_image')->label(' ')->image()->imageEditor()
                        ->directory('posts')->maxSize(3072),
                ]),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->label('Gambar')->width(80)->height(52),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->limit(60)->weight('semibold'),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->badge(),
                Tables\Columns\TextColumn::make('author.name')->label('Penulis')->toggleable(),
                Tables\Columns\IconColumn::make('is_published')->label('Terbit')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Tanggal')->dateTime('d M Y H:i')->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('post_category_id')->label('Kategori')->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_published')->label('Status Terbit'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
