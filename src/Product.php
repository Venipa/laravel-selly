<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Product extends RestApi
{
    /**
     * The title of the product.
     *
     * @var string
     */
    protected $title;

    /**
     * The raw markdown description of the product.
     *
     * @var string
     */
    protected $description;

    /**
     * The current stock count. Will return ∞ unless product_type is 2.
     *
     * @var string
     */
    protected $stock;

    /**
     * The price of the product for 1 quantity.
     *
     * @var float
     */
    protected $price;

    /**
     * The ISO 4217 currency code used.
     *
     * @var string
     */
    protected $currency;

    /**
     * The product type. Determines the stock.
     *
     * @var int
     */
    protected $product_type;

    /**
     * Array containing the snake case name of the gateways enabled for this
     * product.
     *
     * @var array
     */
    protected $gateways;

    /**
     * The actual product serials for product_type 2 and 4.
     *
     * @var string
     */
    protected $info;

    /**
     * The delimiter used to derive stock for the info attribute. Defaults to a
     * comma.
     *
     * @var string
     */
    protected $stock_delimiter;

    /**
     * The webhook URL that will be called for each each order it has and the
     * subsequent order status change.
     *
     * @var string
     */
    protected $webhook_url;

    /**
     * The custom inputs that the customer can input. The keys represent the
     * index.
     *
     * @var object
     */
    protected $custom;

    /**
     * Initialise a product.
     *
     * @param $product The raw product object.
     */
    public function __construct(object $product = null)
    {
        parent::__construct('/products', $product);
    }

    /**
     * Gets the title of the product.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTitle();
    }

    /**
     * Get all of the products.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($product) {
            return new self($product);
        });
    }

    /**
     * Get the product for the given id.
     *
     * @param $id The product id.
     * @return \McCaulay\Selly\Product
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Create a product.
     *
     * @param $title The title of the product.
     * @param $description The raw markdown description of the product.
     * @param $price The price of the product for 1 quantity.
     * @param $currency The ISO 4217 currency code used.
     * @param $productType The product type. Determines the stock.
     * @param $info The actual product serials for product_type 2 and 4.
     * @return \McCaulay\Selly\Product
     */
    protected function create(string $title, string $description, float $price, string $currency, int $productType, string $info): self
    {
        return $this->save([
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'currency' => $currency,
            'product_type' => $productType,
            'info' => $info,
        ]);
    }

    /**
     * Save the product.
     *
     * @return \McCaulay\Selly\Product
     */
    public function save(): object
    {
        return new self(parent::save());
    }

    /**
     * Update the product.
     *
     * @return \McCaulay\Selly\Product
     */
    public function update(): object
    {
        return new self(parent::update());
    }

    /**
     * Set the title of the product.
     *
     * @param  string  $title  The title of the product.
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the title of the product.
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the raw markdown description of the product.
     *
     * @param  string  $description  The raw markdown description of the product.
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the raw markdown description of the product.
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the current stock count. Will return ∞ unless product_type is 2.
     *
     * @param  string  $stock  The current stock count.
     * @return  self
     */
    public function setStock(string $stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * Get the current stock count. Will return ∞ unless product_type is 2.
     *
     * @return  string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the price of the product for 1 quantity.
     *
     * @param  float  $price  The price of the product for 1 quantity.
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the price of the product for 1 quantity.
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the ISO 4217 currency code used.
     *
     * @param  string  $currency  The ISO 4217 currency code used.
     * @return  self
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get the ISO 4217 currency code used.
     *
     * @return  string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the product type. Determines the stock.
     *
     * @param  int  $product_type  The product type. Determines the stock.
     * @return  self
     */
    public function setProductType(int $product_type)
    {
        $this->product_type = $product_type;
        return $this;
    }

    /**
     * Get the product type. Determines the stock.
     *
     * @return  int
     */
    public function getProductType()
    {
        return $this->product_type;
    }

    /**
     * Array containing the snake case name of the gateways enabled for this
     * product.
     *
     * @param  array  $gateways  Array containing the snake case name of the
     * gateways enabled for this product.
     * @return  self
     */
    public function setGateways(array $gateways)
    {
        $this->gateways = $gateways;
        return $this;
    }

    /**
     * Get array containing the snake case name of the gateways enabled for this
     * product.
     *
     * @return  array
     */
    public function getGateways()
    {
        return $this->gateways;
    }

    /**
     * Set the actual product serials for product_type 2 and 4.
     *
     * @param  string  $info  The actual product serials for product_type 2 and 4.
     * @return  self
     */
    public function setInfo(string $info)
    {
        $this->info = $info;
        return $this;
    }

    /**
     * Get the actual product serials for product_type 2 and 4.
     *
     * @return  string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set The delimiter used to derive stock for the info attribute.
     *
     * @param  string  $stock_delimiter  comma.
     * @return  self
     */
    public function setStockDelimiter(string $stock_delimiter)
    {
        $this->stock_delimiter = $stock_delimiter;
        return $this;
    }

    /**
     * Get the delimiter used to derive stock for the info attribute. Defaults to a
     * comma.
     *
     * @return  string
     */
    public function getStockDelimiter()
    {
        return $this->stock_delimiter;
    }

    /**
     * Set the webhook URL that will be called for each each order it has and the
     * subsequent order status change.
     *
     * @param  string  $webhook_url   The webhook URL that will be called for
     * each each order it has and the subsequent order status change.
     * @return  self
     */
    public function setWebhookUrl(string $webhook_url)
    {
        $this->webhook_url = $webhook_url;
        return $this;
    }

    /**
     * Get the webhook URL that will be called for each each order it has and the
     * subsequent order status change.
     *
     * @return  string
     */
    public function getWebhookUrl()
    {
        return $this->webhook_url;
    }

    /**
     * Set the custom inputs that the customer can input. The keys represent the
     * index.
     *
     * @param  object  $custom  The custom inputs that the customer can input.
     * @return  self
     */
    public function setCustom(object $custom)
    {
        $this->custom = $custom;
        return $this;
    }

    /**
     * Get the custom inputs that the customer can input. The keys represent the
     * index.
     *
     * @return  object
     */
    public function getCustom()
    {
        return $this->custom;
    }
}
