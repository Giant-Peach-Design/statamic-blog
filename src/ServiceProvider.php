<?php

namespace Giantpeach\Blog;

use Illuminate\Support\Facades\Artisan;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    //
    public function boot()
    {
        parent::boot();

        /**
         * Register our custom YAML files, these will be moved to relevant folders
         * in the project and can then be customised further in the admin if you
         * need to add or remove fields specific to the site.
         */

        $this->publishes([
            __DIR__ . '/../resources/blueprints' => base_path('resources/blueprints'),
        ], 'giantpeach-blog');

        $this->publishes([
            __DIR__ . '/../resources/fieldsets' => base_path('resources/fieldsets'),
        ], 'giantpeach-blog');

        $this->publishes([
            __DIR__ . '/../resources/taxonomies' => base_path('resources/taxonomies'),
        ], 'giantpeach-blog');

        $this->publishes([
            __DIR__ . '/../content' => base_path('content'),
        ], 'giantpeach-blog');

        Statamic::afterInstalled(function () {
            Artisan::call('vendor:publish --tag=giantpeach-blog');
        });
    }
}
