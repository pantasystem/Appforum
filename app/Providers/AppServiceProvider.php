<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Markdown;
use App\View\Components\PostView;
use App\View\Components\PostEditorForm;
use App\View\Components\AppHeader;
use App\View\Components\AppDetail;

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
        Blade::component('app-header', AppHeader::class);
        Blade::component('app-detail', AppDetail::class);
    }
}
