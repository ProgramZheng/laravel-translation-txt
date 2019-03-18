<?php
namespace ProgramZheng\LaravelTranslationTxt;

use File;
use Storage;

class TranslationTxt
{

    public function exporJsonTxt($langArray = [])
    {
        $response = [];
        foreach($langArray as $lang){
            $resource_path = resource_path("lang\\${lang}");
            $files = $this->getAllFile($resource_path);
            $text_path = "lang\\${lang}.txt";
            $this->resetFile($text_path);
            foreach ($files as $key => $file) {
                $last = count($files) - 1;
                $fileName = $file->getBasename('.php');
                $text = var_export_json_txt(trans($fileName,[],$lang));
                $content = "{" . "'" . $fileName . "'" . " :". PHP_EOL . $text . PHP_EOL . "}" . ( $key == $last ? "" : "," ) . PHP_EOL;

                Storage::append($text_path, $content);
            }
            $response[$key] = storage_path($text_path);
        }
        return implode(PHP_EOL, $response);
    }

    public function exportArrayTxt($langArray = [])
    {
        $response = [];
        foreach($langArray as $key => $lang){
            $resource_path = resource_path("lang\\${lang}");
            $files = $this->getAllFile($resource_path);
            $text_path = "lang\\${lang}.txt";
            $this->resetFile($text_path);
            foreach ($files as $file) {
                $fileName = $file->getBasename('.php');
                $text = var_export_array_txt(trans($fileName,[],$lang));
                $content = "${fileName} =>". PHP_EOL . $text . PHP_EOL . PHP_EOL;

                Storage::prepend($text_path, $content);
            }
            $response[$key] = storage_path($text_path);
        }
        return implode(PHP_EOL, $response);
    }

    private function getAllFile($path)
    {
        return File::allFiles($path);
    }

    private function resetFile($path)
    {
        //Check directory exists.
        if ( ! file_exists(dirname($path)))
        {
            mkdir(dirname($path), 0777, true);
        }
        //Clear .txt content.
        Storage::put($path, '');
    }
}