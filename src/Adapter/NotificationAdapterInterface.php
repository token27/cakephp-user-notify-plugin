<?php

namespace UserNotify\Adapter;

interface NotificationAdapterInterface {

    /**
     * Send a request
     *
     * @return bool
     */
    public function send();

    /**
     * Return the response of the request
     *
     * @return mixed \Psr\Http\Message\ResponseInterface
     */
    public function response();
}
