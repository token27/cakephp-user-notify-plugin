<?php

declare(strict_types=1);

namespace UserNotify\Notification;

interface NotificationInterface {

    /**
     * Do the Notification now
     *
     * @return bool
     */
    public function send();

    /**
     * Push the Notification into the queue
     *
     * @return bool
     */
    public function queue();

    /**
     * Get locale used for the notification
     *
     * @return string|null
     */
    public function getLocale(): ?string;

    /**
     * Set locale used for the notification
     *
     * @param string $locale The name of the locale to set
     * @return self
     */
    public function setLocale(string $locale = null);

    /**
     * Get before send callback.
     *
     * @return array
     */
    public function getBeforeSendCallback(): array;

    /**
     * Set before send callback.
     *
     * @param string|array|null $class Name of the class and method
     * - Pass a string in the class::method format to call a static method
     * - Pass an array in the [class => method] format to call a non static method
     * @param array $args the method parameters you want to pass to the called method
     * @return self
     */
    public function setBeforeSendCallback($class = null, array $args = []): NotificationInterface;

    /**
     * Get after send callback.
     *
     * @return array
     */
    public function getAfterSendCallback(): array;

    /**
     * Set after send callback.
     *
     * @param string|array|null $class Name of the class and method
     * - Pass a string in the class::method format to call a static method
     * - Pass an array in the [class => method] format to call a non static method
     * @param array $args the method parameters you want to pass to the called method
     * @return self
     */
    public function setAfterSendCallback($class = null, array $args = []): NotificationInterface;
}
