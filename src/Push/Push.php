<?php

namespace UserNotify\Push;

# PLUGIN

use UserNotify\Adapter\NotificationAdapterInterface;

class Push {

    /**
     * @var NotificationAdapterInterface
     */
    protected $adapter;

    /**
     * Constructor.
     *
     * @param NotificationAdapterInterface $adapter The adapter
     */
    public function __construct(NotificationAdapterInterface $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Get the Adapter.
     *
     * @return NotificationAdapterInterface adapter
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * Send a downstream message to one or more devices.
     *
     * @return bool
     */
    public function send() {
        return $this->getAdapter()->send();
    }

    /**
     * Return the response of the push.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function response() {
        return $this->getAdapter()->response();
    }

}
