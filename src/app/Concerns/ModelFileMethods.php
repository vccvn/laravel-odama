<?php

namespace Odama\Concerns;

trait ModelFileMethods
{
    public function getSecretPath($path = null): string
    {
        return config('odama.file_storage_path', 'storage/app') . ($path ? '/' . ltrim($path, '/') : '');
    }
}