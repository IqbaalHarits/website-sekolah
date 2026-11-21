<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

/**
 * @property Form $form
 */
class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $title = 'Pengaturan Website';
    protected static ?string $slug = 'pengaturan-website';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = SiteSetting::query()->first() ?? new SiteSetting(['site_name' => config('app.name')]);
        $this->form->fill($setting->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Forms\Components\Tabs::make()->tabs([
                    Forms\Components\Tabs\Tab::make('Identitas')->icon('heroicon-o-building-library')->schema([
                        Forms\Components\TextInput::make('site_name')->label('Nama Sekolah / Pesantren')->required()->maxLength(255),
                        Forms\Components\TextInput::make('tagline')->label('Tagline')->maxLength(255),
                        Forms\Components\Textarea::make('about_summary')->label('Ringkasan Profil (Beranda)')->rows(4)->columnSpanFull(),
                        Forms\Components\Textarea::make('meta_description')->label('Meta Description (SEO)')->rows(2)->maxLength(300)->columnSpanFull(),
                        Forms\Components\FileUpload::make('logo')->label('Logo')->image()->directory('settings')->maxSize(1024),
                        Forms\Components\FileUpload::make('favicon')->label('Favicon')->image()->directory('settings')->maxSize(512),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('Kontak')->icon('heroicon-o-phone')->schema([
                        Forms\Components\TextInput::make('phone')->label('Telepon')->tel()->maxLength(30),
                        Forms\Components\TextInput::make('whatsapp')->label('WhatsApp (format 628xxx)')->maxLength(30),
                        Forms\Components\TextInput::make('email')->label('Email')->email()->maxLength(255)->columnSpanFull(),
                        Forms\Components\Textarea::make('address')->label('Alamat')->rows(3)->columnSpanFull(),
                        Forms\Components\Textarea::make('map_embed_url')->label('URL Embed Google Maps')->rows(2)
                            ->helperText('Google Maps → Bagikan → Sematkan peta → salin nilai src="..." saja.')->columnSpanFull(),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('Media Sosial')->icon('heroicon-o-share')->schema([
                        Forms\Components\TextInput::make('facebook_url')->label('Facebook')->url(),
                        Forms\Components\TextInput::make('instagram_url')->label('Instagram')->url(),
                        Forms\Components\TextInput::make('youtube_url')->label('YouTube')->url(),
                        Forms\Components\TextInput::make('tiktok_url')->label('TikTok')->url(),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('PPDB')->icon('heroicon-o-user-plus')->schema([
                        Forms\Components\Toggle::make('ppdb_is_open')->label('Pendaftaran sedang dibuka')->columnSpanFull(),
                        Forms\Components\TextInput::make('ppdb_headline')->label('Judul PPDB')->maxLength(255),
                        Forms\Components\DatePicker::make('ppdb_deadline')->label('Batas Pendaftaran')->native(false),
                        Forms\Components\TextInput::make('ppdb_url')->label('URL Formulir Pendaftaran')->helperText('Link eksternal (Google Form, dll.). Kosongkan untuk memakai WhatsApp.')->columnSpanFull(),
                        Forms\Components\Textarea::make('ppdb_description')->label('Deskripsi / Persyaratan Singkat')->rows(4)->columnSpanFull(),
                    ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Simpan Perubahan')->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = SiteSetting::query()->first() ?? new SiteSetting();
        $setting->fill($data)->save();

        Notification::make()->title('Pengaturan tersimpan')->success()->send();
    }
}
