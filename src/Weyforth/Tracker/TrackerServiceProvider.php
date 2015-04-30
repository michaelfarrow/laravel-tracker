<?php
/**
 * Tracker Service Provider.
 *
 * Provides interface to operate using
 * multiple tracker services eg. Google Analytics.
 *
 * @author    Mike Farrow <contact@mikefarrow.co.uk>
 * @license   Proprietary/Closed Source
 * @copyright Mike Farrow
 */

namespace Weyforth\Tracker;

use Illuminate\Support\ServiceProvider;
use Config;

class TrackerServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/tracker.php' => config_path('tracker.php'),
        ]);
    }


    /**
     * Register the default interface to use for dependency injection.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind(
            'Weyforth\Tracker\TrackerInterface',
            'Weyforth\Tracker\GoogleAnalyticsTracker'
        );
    }

}
