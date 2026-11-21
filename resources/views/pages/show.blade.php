@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->excerpt)

@section('content')
    <x-page-header :title="$page->title" :intro="$page->excerpt" :eyebrow="ucfirst($page->group)" :crumbs="[ucfirst($page->group), $page->title]" />

    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-3xl">
                @if ($page->image)
                    <div class="mb-10 aspect-[16/9] overflow-hidden rounded-card shadow-card"><x-photo :src="$page->image" :alt="$page->title" /></div>
                @endif
                <article class="prose prose-lg max-w-none prose-headings:mt-10">
                    {!! \App\Support\Html::clean($page->content) !!}
                </article>
            </div>
        </div>
    </section>
@endsection
