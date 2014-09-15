<?php
/**
 * Tracker interface.
 *
 * Trackers must implement this interface.
 * Provides common functions to track events and pageviews.
 *
 * @author    Mike Farrow <contact@mikefarrow.co.uk>
 * @license   Proprietary/Closed Source
 * @copyright Mike Farrow
 */

namespace Weyforth\Tracker;

interface TrackerInterface
{


    /**
     * Track an event.
     *
     * Track an event using metadata submitted, 
     * which will be used to identify it later on.
     *
     * @param string $category Event category eg. admin.
     * @param string $action   Event action eg. login attempt.
     * @param string $label    Event label.
     *
     * @return void
     */
    public function trackEvent(
        $category,
        $action,
        $label = null,
        $value = null
    );


}
