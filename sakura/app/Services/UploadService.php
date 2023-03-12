<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Exception;

class UploadService
{
    public function uploadFile(UploadedFile $file)
    {
        $renamedFile = $file->storeAs('news', $file->hashName(), 'public');
        if(!$renamedFile) {
            throw new Exception("Не удалось загрузить файл");
        }

        return $renamedFile; //вернет путь к файлу

    }
}
