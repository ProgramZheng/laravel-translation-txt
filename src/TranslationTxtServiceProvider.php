<?php

namespace ProgramZheng\LaravelTranslationTxt;

use Illuminate\Support\ServiceProvider;
use ProgramZheng\LaravelTranslationTxt\TranslationTxtService;
use ProgramZheng\LaravelTranslationTxt\Console\TranslationTxtExportCommand;

class TranslationTxtServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton('laravel-translation-export.txt', function($app)	{
			return new TranslationTxtExportCommand();
		});
		$this->commands('laravel-translation-export.txt');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('LangImportExportLangListService', function() {
			return new LangListService;
		});
    }
}
