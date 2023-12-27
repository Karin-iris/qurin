<?php

namespace App\Providers;

use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class GoogleCloudStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Storage::extend('gcs', function ($app, $config) {
            $storageClient = new StorageClient([
                'projectId' => $config['project_id'],
                'keyFilePath' => $config['key_file'],
            ]);

            $bucket = $storageClient->bucket($config['bucket']);
            $adapter = new GoogleCloudStorageAdapter($bucket);

            // FilesystemAdapter インスタンスを返す
            return new FilesystemAdapter(
                new Filesystem($adapter, $config), $adapter, $config
            );
        });
    }
}
