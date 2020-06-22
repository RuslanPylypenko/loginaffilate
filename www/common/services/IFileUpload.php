<?php


namespace common\services;

use yii\web\UploadedFile;

interface IFileUpload
{
    public function upload(UploadedFile $file, string $path): void ;
}