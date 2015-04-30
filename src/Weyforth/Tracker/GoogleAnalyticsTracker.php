<?php
/**
 * Email notifier.
 *
 * @author    Mike Farrow <contact@mikefarrow.co.uk>
 * @license   Proprietary/Closed Source
 * @copyright Mike Farrow
 */

namespace Weyforth\Tracker;

use Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient;

class GoogleAnalyticsTracker implements TrackerInterface
{

    /**
     * Reference to the global Google Tracker.
     * 
     * @var Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient
     */
    protected $client;

    public function __construct(){
        $this->client = MeasurementProtocolClient::factory();
    }

    /**
     * {@inheritdoc}
     */
    public function trackEvent(
        $category,
        $action,
        $label = null,
        $value = null
    ) {

        $this->client->event(array(
            'tid' => $this->getId(),
            'cid' => $this->getCustomerId(),
            'ec'  => $category,
            'ea'  => $action,
            'el'  => $label,
            'ev'  => $value,
        ));

    }

    protected function getId(){
        return config('tracker.google.id');
    }

    protected function getCustomerId(){
        return config('tracker.google.customer_id');
    }

    protected function getDomain(){
        return config('tracker.google.domain');
    }


}
