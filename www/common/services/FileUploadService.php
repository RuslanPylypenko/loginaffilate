<?php


namespace common\services;


use yii\web\UploadedFile;

class FileUploadService implements IFileUpload
{
    public function upload(UploadedFile $file, string $path): void
    {
        $file->saveAs($path);
    }
}