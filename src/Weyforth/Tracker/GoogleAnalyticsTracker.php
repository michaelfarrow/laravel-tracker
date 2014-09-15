<?php
/**
 * Email notifier.
 *
 * @author    Mike Farrow <contact@mikefarrow.co.uk>
 * @license   Proprietary/Closed Source
 * @copyright Mike Farrow
 */

namespace Weyforth\Tracker;

use UnitedPrototype\GoogleAnalytics;
use Config;

class GoogleAnalyticsTracker implements TrackerInterface
{

    /**
     * Reference to the global Google Tracker.
     * 
     * @var GoogleAnalytics\Tracker
     */
    protected $tracker;

    /**
     * Reference to the global Google Visitor.
     * 
     * @var GoogleAnalytics\Visitor
     */
    protected $visitor;

    /**
     * Reference to the global Google Session.
     * 
     * @var GoogleAnalytics\Session
     */
    protected $session;


    public function __construct(){
        $this->tracker = new GoogleAnalytics\Tracker($this->getId(), $this->getDomain());

        $this->visitor = new GoogleAnalytics\Visitor();
        $this->visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
        $this->visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);

        $this->session = new GoogleAnalytics\Session();
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
        $event = new GoogleAnalytics\Event($category, $action, $label, $value);

        $this->tracker->trackEvent($event, $this->session, $this->visitor);
    }

    protected function getId(){
        return Config::get('tracker::config.id');
    }

    protected function getDomain(){
        return Config::get('tracker::config.domain');
    }


}
