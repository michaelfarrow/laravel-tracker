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
use Config;

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
        // $event = new GoogleAnalytics\Event($category, $action, $label, $value);

        // $this->tracker->trackEvent($event, $this->session, $this->visitor);
    }

    protected function getId(){
        return Config::get('tracker::id');
    }

    protected function getCustomerId(){
        return Config::get('tracker::customer_id');
    }

    protected function getDomain(){
        return Config::get('tracker::domain');
    }


}
