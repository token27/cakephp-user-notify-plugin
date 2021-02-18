<?php

declare(strict_types=1);

namespace UserNotify\Controller\Component;

# CAKEPHP

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
# PLUGIN
use UserNotify\Notification\Config;
# DEPENDENCIES
use Twilio\Rest\Client as TwilioClient;
use Twilio\Exceptions\RestException as TwilioRestException;
use Twilio\Exceptions\TwilioException;

/**
 * Twilio component
 */
class TwilioComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     *
     * @var \Twilio\Rest\Clien as TwilioClientt;
     */
    public $TwilioClient;

    /**
     * Your Acount SID
     * 
     * @var type string
     */
    protected $accountSid = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

    /**
     *
     * @var type  Your Acount Auth Token
     */
    protected $authToken = "Your_account_auth_token";

    /**
     *
     * @var type  Your Notify Service SID
     */
    protected $serviceSid = "ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

    /**
     * Constructor hook method.
     *
     * Implement this method to avoid having to overwrite
     * the constructor and call parent.
     *
     * @param array $config The configuration settings provided to this component.
     * @return void
     */
    public function initialize(array $config): void {
        if (Config::twilioAccountSid() !== null && Config::twilioAuthToken() !== null) {
            $this->setAccountSid(Config::twilioAccountSid());
            $this->setAuthToken(Config::twilioAuthToken());
            $this->initializeTwilio();
        }
    }

    /**
     * Twilio api initialize
     * 
     * @return boolean
     */
    public function initializeTwilio() {
        $this->TwilioClient = null;
        $config = $this->getConfig();
        if (isset($config['accountSid']) && !empty($config['accountSid'])) {
            if (isset($config['authToken']) && !empty($config['authToken'])) {
                $this->TwilioClient = new TwilioClient($config['accountSid'], $config['authToken']);
            } else {
                throw new TwilioException('Twilio.authToken is missing. Please set Twilio.authToken in app/config/app_users_notifications.php');
            }
        } else {
            throw new TwilioException('Twilio.accountSid is missing. Please set Twilio.accountSid in app/config/app_users_notifications.php');
        }
    }

    /**
     * Set the Twilio account sid
     * 
     * @param string $accountSid
     */
    public function setAccountSid(string $accountSid) {
        $config = $this->getConfig();
        $config['accountSid'] = $accountSid;
        $this->setConfig($config);
    }

    /**
     * Set the Twilio auth token
     * 
     * @param string $authToken
     */
    public function setAuthToken(string $authToken) {
        $config = $this->getConfig();
        $config['authToken'] = $authToken;
        $this->setConfig($config);
    }

    /**
     * Twilio - Send SMS 
     *
     * @param $from a Twilio number in your account
     * @param $to any number
     * @param $message
     * @return integer sms id 
     * 
     */
    public function sendSMS(string $from, string $to, string $message) {
        if ($this->TwilioClient === null) {
            $this->initializeTwilio();
        }
        try {
            $twilioMessage = $this->TwilioClient->messages->create(
                    // the number you'd like to send the message to
                    $to,
                    [
                        // A Twilio phone number you purchased at twilio.com/console
                        'from' => $from,
                        'body' => $message
                    ]
            );
            if ($twilioMessage) {
                
            }
        } catch (TwilioRestException $ex) {
            return $ex->getDetails();
        }
    }

}
