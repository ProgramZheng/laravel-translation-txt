<?php

namespace ProgramZheng\LaravelTranslationTxt\Commands;

use Illuminate\Console\Command;
use ProgramZheng\LaravelTranslationTxt\TranslationTxt;

class TranslationTxtExportCommand extends Command
{
    private $TranslationTxt;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translationtxt:export {lang}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports the language files to Txt file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TranslationTxt $translationTxt)
    {
        parent::__construct();
        $this->translationTxt = $TranslationTxt;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $langArray = explode(",",$this->argument('lang'));
        $response = $this->translationTxt->exportArrayTxt($langArray);
        $this->sayFinish($response);
    }

    /**
	 * Print finish info.
	 * 
	 * @return void
	 */
    private function sayFinish($info = "")
    {
        $this->info('Finished! Txt path is' . PHP_EOL . $info);
    }
}
