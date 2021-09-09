<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Markdown;
use App\View\Components\PostView;
use App\View\Components\PostEditorForm;
use App\View\Components\AppHeader;
use App\View\Components\AppDetail;
use App\View\Components\Checkbox;
use App\View\Components\PublicBadge;
use App\View\Components\RequiredBadge;

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
        Blade::component('checkbox', Checkbox::class);
        Blade::component('public-badge', PublicBadge::class);
        Blade::component('required-badge', RequiredBadge::class);
    }
}
