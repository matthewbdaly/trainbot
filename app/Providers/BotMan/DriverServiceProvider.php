<?php

namespace App\Providers\BotMan;

use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Studio\Providers\DriverServiceProvider as ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    /**
     * The drivers that should be loaded to
     * use with BotMan
     *
     * @var array
     */
    protected $drivers = [
        'BotMan\Drivers\AmazonAlexa\AmazonAlexaDriver',
        'BotMan\Drivers\Web\WebDriver',
    ];

    /**
     * @return void
     */
    public function boot()
    {
        parent::boot();

        foreach ($this->drivers as $driver) {
            DriverManager::loadDriver($driver);
        }
    }
}
