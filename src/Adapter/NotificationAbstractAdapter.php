<?php

namespace UserNotify\Adapter;

# CAKEPHP

use Cake\Core\InstanceConfigTrait;
use Cake\Cache\InvalidArgumentException;
# PLUGIN
use UserNotify\Adapter\NotificationAdapterInterface;

abstract class NotificationAbstractAdapter implements NotificationAdapterInterface {

    use InstanceConfigTrait;

    /**
     * Response of the request
     *
     * @var mixed \Psr\Http\Message\ResponseInterface|\Cake\Model\Entity
     */
    protected $response;

    /**
     * AbstractAdapter constructor.
     *
     * @param string|array $config The Adapter configuration
     *
     * @throws \Cake\Cache\InvalidArgumentException
     */
    public function __construct($config) {
        $this->setConfig($config);
    }

    /**
     * @inheritdoc
     */
    abstract public function send();

    /**
     * @inheritdoc
     */
    public function response() {
        return $this->response;
    }

}
