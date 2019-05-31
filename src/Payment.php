<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Payment extends RestApi
{
    /**
     * Title of the product shown on the checkout page.
     *
     * @var string
     */
    protected $title;

    /**
     * The gateway used for this payment. Can be Bitcoin, PayPal, Ethereum,
     * Ripple, Litecoin, Dash, Bitcoin Cash, DigiByte, Nano, Ripple or Zcash.
     *
     * @var string
     */
    protected $gateway;

    /**
     * The email of the customer.
     *
     * @var string
     */
    protected $email;

    /**
     * The fiat value/price of the order.
     *
     * @var float
     */
    protected $value;

    /**
     * The ISO 4217 currency code used for this payment.
     *
     * @var string
     */
    protected $currency;

    /**
     * The number of confirmations required for the crypto currency payment to
     * be considered complete. Defaults to 1. Defaults to 6 for Ethereum and
     * cannot be changed.
     *
     * @var int
     */
    protected $confirmations;

    /**
     * URL displayed to the customer after the payment is completed.
     *
     * @var string
     */
    protected $return_url;

    /**
     * Webhook URL used on payment completion.
     *
     * @var string
     */
    protected $webhook_url;

    /**
     * If set to true, the payment will use the white label checkout flow and
     * return the order object rather than a redirection URL.
     *
     * @var bool
     */
    protected $white_label;

    /**
     * The customer's IP address. Only usable if `white_label` is `true`.
     * Defaults to the IP address that calls the API endpoint.
     *
     * @var string
     */
    protected $ip_address;

    /**
     * Initialise a payment.
     *
     * @param $payment The raw payment object.
     */
    public function __construct(object $payment = null)
    {
        parent::__construct('/payments', $payment);
    }

    /**
     * Get all of the payments.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($payment) {
            return new self($payment);
        });
    }

    /**
     * Get the payment for the given id.
     *
     * @param $id The payment id.
     * @return \McCaulay\Selly\Payment
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Save the payment.
     *
     * @return \McCaulay\Selly\Payment
     */
    public function save(): object
    {
        return new self(parent::save());
    }

    /**
     * Set title of the product shown on the checkout page.
     *
     * @param  string  $title  Title of the product shown on the checkout page.
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title of the product shown on the checkout page.
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the gateway used for this payment.
     *
     * @param  string  $gateway  The gateway used for this payment. Can be Bitcoin,
     * PayPal, Ethereum, Ripple, Litecoin, Dash, Bitcoin Cash, DigiByte, Nano,
     * Ripple or Zcash.
     * @return  self
     */
    public function setGateway(string $gateway)
    {
        $this->gateway = $gateway;
        return $this;
    }

    /**
     * Get the gateway used for this payment. Can be Bitcoin, PayPal, Ethereum,
     * Ripple, Litecoin, Dash, Bitcoin Cash, DigiByte, Nano, Ripple or Zcash.
     *
     * @return  string
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * Set the email of the customer.
     *
     * @param  string  $email  The email of the customer.
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the email of the customer.
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the fiat value/price of the order.
     *
     * @param  float  $value  The fiat value/price of the order.
     * @return  self
     */
    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the fiat value/price of the order.
     *
     * @return  float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the ISO 4217 currency code used for this payment.
     *
     * @param  string  $currency  The ISO 4217 currency code used for this payment.
     * @return  self
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get the ISO 4217 currency code used for this payment.
     *
     * @return  string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the number of confirmations required for the crypto currency payment
     * to be considered complete. Defaults to 1. Defaults to 6 for Ethereum and
     * cannot be changed.
     *
     * @param  int  $confirmations  The number of confirmations required for the
     * crypto currency payment to be considered complete.
     * @return  self
     */
    public function setConfirmations(int $confirmations)
    {
        $this->confirmations = $confirmations;
        return $this;
    }

    /**
     * Get the number of confirmations required for the crypto currency payment
     * to be considered complete. Defaults to 1. Defaults to 6 for Ethereum and
     * cannot be changed.
     *
     * @return  int
     */
    public function getConfirmations()
    {
        return $this->confirmations;
    }

    /**
     * Set uRL displayed to the customer after the payment is completed.
     *
     * @param  string  $return_url  URL displayed to the customer after the
     * payment is completed.
     * @return  self
     */
    public function setReturnUrl(string $return_url)
    {
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * Get uRL displayed to the customer after the payment is completed.
     *
     * @return  string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * Set webhook URL used on payment completion.
     *
     * @param  string  $webhook_url  Webhook URL used on payment completion.
     * @return  self
     */
    public function setWebhookUrl(string $webhook_url)
    {
        $this->webhook_url = $webhook_url;
        return $this;
    }

    /**
     * Get webhook URL used on payment completion.
     *
     * @return  string
     */
    public function getWebhookUrl()
    {
        return $this->webhook_url;
    }

    /**
     * Set if set to true, the payment will use the white label checkout flow
     * and return the order object rather than a redirection URL.
     *
     * @param  bool  $white_label  If set to true, the payment will use the
     * white label checkout flow and return the order object rather than a
     * redirection URL.
     * @return  self
     */
    public function setWhiteLabel(bool $white_label)
    {
        $this->white_label = $white_label;
        return $this;
    }

    /**
     * Get if set to true, the payment will use the white label checkout flow
     * and return the order object rather than a redirection URL.
     *
     * @return  bool
     */
    public function getWhiteLabel()
    {
        return $this->white_label;
    }

    /**
     * Set the customer's IP address. Only usable if `white_label` is `true`.
     *
     * @param  string  $ip_address  The customer's IP address. Only usable if
     * `white_label` is `true`. Defaults to the IP address that calls the API
     * endpoint.
     * @return  self
     */
    public function setIpAddress(string $ip_address)
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    /**
     * Get the customer's IP address. Only usable if `white_label` is `true`.
     * Defaults to the IP address that calls the API endpoint.
     *
     * @return  string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }
}
