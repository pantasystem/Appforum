<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Markdown;
use App\View\Components\PostView;
use App\View\Components\PostEditorForm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('markdown', Markdown::class);
        Blade::component('post-view', PostView::class);
        Blade::component('post-editor-form', PostEditorForm::class);
    }
}
