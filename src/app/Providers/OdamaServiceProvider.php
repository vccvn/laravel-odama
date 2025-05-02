<?php
namespace Odama\Providers;

use Illuminate\Support\ServiceProvider;

class OdamaServiceProvider extends ServiceProvider
{
    /**
     * Đăng ký service, helper và repository nếu môi trường cho phép.
     */
    public function register()
    {
        if (!$this->app) {
            return;
        }

        // Chỉ load helpers nếu tồn tại thư mục
        $helperPath = base_path('helpers');
        if (is_dir($helperPath)) {
            foreach (glob($helperPath . '/*.php') as $filename) {
                require_once $filename;
            }
        }

        // Bind repository vào container (nếu Laravel đang chạy)
        if ($this->app->bound('config')) {
            $this->app->bind(
                \Odama\Contracts\UserRepositoryInterface::class,
                \Odama\Repositories\UserRepository::class
            );
        }
    }

    /**
     * Boot các thành phần của Odama.
     */
    public function boot()
    {
        if (!$this->app || !$this->app->runningInConsole()) {
            return;
        }

        // Load migrations nếu có
        if (is_dir(base_path('database/migrations'))) {
            $this->loadMigrationsFrom(base_path('database/migrations'));
        }

        // Load translations nếu có
        if (is_dir(base_path('resources/lang'))) {
            $this->loadTranslationsFrom(base_path('resources/lang'), 'odama');
        }

        // Load views nếu có
        if (is_dir(base_path('resources/views'))) {
            $this->loadViewsFrom(base_path('resources/views'), 'odama');
        }
    }
}