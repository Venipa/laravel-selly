<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;
use McCaulay\Selly\Product;

class Order extends RestApi
{
    /**
     * Unique identifier of the product that the order belongs to.
     *
     * @var string
     */
    protected $product_id;

    /**
     * Email address of the customer that initiated the order.
     *
     * @var string
     */
    protected $email;

    /**
     * IP address of the customer that initiated the order.
     *
     * @var string
     */
    protected $ip_address;

    /**
     * 2 letter country code of the customer that initiated the order.
     *
     * @var string
     */
    protected $country_code;

    /**
     * Browser user agent of the customer that initiated the order.
     *
     * @var string
     */
    protected $user_agent;

    /**
     * The value of the order in the specified currency.
     *
     * @var float
     */
    protected $value;

    /**
     * The ISO 4217 currency code used for this order.
     *
     * @var string
     */
    protected $currency;

    /**
     * The gateway used for this order. Bitcoin, PayPal, Ethereum, etc.
     *
     * @var string
     */
    protected $gateway;

    /**
     * The calculated risk of this level from 0-100 with 100 being extremely
     * risky/fraudulent.
     *
     * @var int
     */
    protected $risk_level;

    /**
     * Status of the order.
     *
     * @var int
     */
    protected $status;

    /**
     * The purchased product that is delivered to the seller. Will be null if
     * the status is not 100.
     *
     * @var string
     */
    protected $delivered;

    /**
     * The crypto currency address presented to the customer. Will be null if
     * the currency is not a crypto currency.
     *
     * @var string
     */
    protected $crypto_address;

    /**
     * The crypto value in satoshis that the customer is required to send. Will
     * be null if the currency is not a crypto currency.
     *
     * @var int
     */
    protected $crypto_value;

    /**
     * The crypto value in satoshis that the customer has sent.
     *
     * @var int
     */
    protected $crypto_received;

    /**
     * The number of confirmations the customer's transaction(s) has received.
     * If multiple transactions, it will be the lowest confirmation number of
     * the transactions.
     *
     * @var int
     */
    protected $crypto_confirmations;

    /**
     * Extra crypto currency paramaters such as Ripple destination tag,
     * Lightning network channel, Monero payment id.
     *
     * @var string
     */
    protected $crypto_channel;

    /**
     * The number of confirmations required before the order is completed.
     *
     * @var int
     */
    protected $confirmations_needed;

    /**
     * The order quantity.
     *
     * @var int
     */
    protected $quantity;

    /**
     * The HTTP referrer for the product page. Will be null if the HTTP referrer
     * was not present/valid.
     *
     * @var string
     */
    protected $referral;

    /**
     * The value of the order in USD.
     *
     * @var float
     */
    protected $usd_value;

    /**
     * The exchange rate from currency to USD.
     *
     * @var float
     */
    protected $exchange_rate;

    /**
     * The url to redirect to for payment.
     *
     * @var string
     */
    protected $url;

    /**
     * The custom inputs that the customer inputted. The keys represent the
     * index of the custom input specified in the product.
     *
     * @var object
     */
    protected $custom;

    /**
     * The order statuses lookup this order can be.
     *
     * @var array
     */
    private $orderStatuses;

    /**
     * Initialise a order.
     *
     * @param $order The raw order object.
     */
    public function __construct(object $order = null)
    {
        parent::__construct('/orders', $order);

        $this->orderStatuses = [
            0 => 'No payment has been received',
            51 => 'PayPal dispute/reversal',
            52 => 'Order blocked due to risk level exceeding the maximum for the product',
            53 => 'Partial payment. When crypto currency orders do not receive the full amount required due to fees, etc.',
            54 => 'Crypto currency transaction confirming',
            55 => 'Payment pending on PayPal. Most commonly due to e-checks.',
            56 => 'Refunded',
            100 => 'Payment complete',
        ];
    }

    /**
     * Get all of the orders.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($order) {
            return new self($order);
        });
    }

    /**
     * Get the order for the given id.
     *
     * @param $id The order id.
     * @return \McCaulay\Selly\Order
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Get the product from the id.
     *
     * @return  \McCaulay\Selly\Product
     */
    public function getProduct()
    {
        return Product::find($this->getProductId());
    }

    /**
     * Get the order status message.
     *
     * @return  string
     */
    public function getStatusMessage(): string
    {
        return $this->orderStatuses[$this->getStatus()];
    }

    /**
     * Get unique identifier of the product that the order belongs to.
     *
     * @return  string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Get email address of the customer that initiated the order.
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get iP address of the customer that initiated the order.
     *
     * @return  string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Get 2 letter country code of the customer that initiated the order.
     *
     * @return  string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Get browser user agent of the customer that initiated the order.
     *
     * @return  string
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }

    /**
     * Get the value of the order in the specified currency.
     *
     * @return  float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the ISO 4217 currency code used for this order.
     *
     * @return  string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Get the gateway used for this order. Bitcoin, PayPal, Ethereum, etc.
     *
     * @return  string
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * Get risky/fraudulent.
     *
     * @return  int
     */
    public function getRiskLevel()
    {
        return $this->risk_level;
    }

    /**
     * Get status of the order.
     *
     * @return  int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the status is not 100.
     *
     * @return  string
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Get the currency is not a crypto currency.
     *
     * @return  string
     */
    public function getCryptoAddress()
    {
        return $this->crypto_address;
    }

    /**
     * Get be null if the currency is not a crypto currency.
     *
     * @return  int
     */
    public function getCryptoValue()
    {
        return $this->crypto_value;
    }

    /**
     * Get the crypto value in satoshis that the customer has sent.
     *
     * @return  int
     */
    public function getCryptoReceived()
    {
        return $this->crypto_received;
    }

    /**
     * Get the transactions.
     *
     * @return  int
     */
    public function getCryptoConfirmations()
    {
        return $this->crypto_confirmations;
    }

    /**
     * Get lightning network channel, Monero payment id.
     *
     * @return  string
     */
    public function getCryptoChannel()
    {
        return $this->crypto_channel;
    }

    /**
     * Get the value of the order in USD.
     *
     * @return  float
     */
    public function getUsdValue()
    {
        return $this->usd_value;
    }

    /**
     * Get the exchange rate from currency to USD.
     *
     * @return  float
     */
    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    /**
     * Get the url to redirect to for payment.
     *
     * @return  string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get index of the custom input specified in the product.
     *
     * @return  object
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * Get the number of confirmations required before the order is completed.
     *
     * @return  int
     */
    public function getConfirmationsNeeded()
    {
        return $this->confirmations_needed;
    }

    /**
     * Get the order quantity.
     *
     * @return  int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
