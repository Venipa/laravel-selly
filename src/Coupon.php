<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Coupon extends RestApi
{
    /**
     * A list of product ids this coupon applies to.
     *
     * @var array
     */
    protected $product_ids;

    /**
     * The coupon code.
     *
     * @var string
     */
    protected $code;

    /**
     * The discount as a percentage.
     *
     * @var int
     */
    protected $discount;

    /**
     * The maximum number of times this coupon can be used.
     *
     * @var int
     */
    protected $max_use;

    /**
     * The number of times this coupon has been used.
     *
     * @var int
     */
    protected $uses;

    /**
     * Initialise a coupon.
     *
     * @param $coupon The raw coupon object.
     */
    public function __construct(object $coupon = null)
    {
        parent::__construct('/coupons', $coupon);
        $this->product_ids = ['all_products'];
    }

    /**
     * Gets the code of the coupon.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCode();
    }

    /**
     * Get all of the coupons.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($coupon) {
            return new self($coupon);
        });
    }

    /**
     * Get the coupon for the given id.
     *
     * @param $id The coupon id.
     * @return \McCaulay\Selly\Coupon
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Create a coupon.
     *
     * @param $code The coupon code.
     * @param $discount The coupon discount as a percentage.
     * @param $products An array of product ids this coupon is valid for. If it
     * is null then it is valid for all products.
     * @param $maxUses The maximum number of times the coupon can be used. If it
     * is null then there is no limit.
     * @return \McCaulay\Selly\Coupon
     */
    protected function create(string $code, int $discount = 50, array $products = null, $maxUses = null): self
    {
        return new self(parent::save([
            'code' => $code,
            'discount' => $discount,
            'product_ids' => empty($products) ? ['all_products'] : $products,
            'max_uses' => $maxUses,
        ]));
    }

    /**
     * Update the coupon.
     *
     * @return \McCaulay\Selly\Coupon
     */
    public function update(): object
    {
        return new self(parent::update());
    }

    /**
     * Set a list of product ids this coupon applies to.
     *
     * @param  array  $product_ids  A list of product ids this coupon applies to.
     * @return  self
     */
    public function setProductIds(array $product_ids): self
    {
        $this->product_ids = $product_ids;
        return $this;
    }

    /**
     * Get a list of product ids this coupon applies to.
     *
     * @return  array
     */
    public function getProductIds(): array
    {
        return $this->product_ids;
    }

    /**
     * Set the coupon code.
     *
     * @param  string  $code  The coupon code.
     * @return  self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get the coupon code.
     *
     * @return  string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set the discount as a percentage.
     *
     * @param  int  $discount  The discount as a percentage.
     * @return  self
     */
    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * Get the discount as a percentage.
     *
     * @return  int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * Set the maximum number of times this coupon can be used.
     *
     * @param  int  $max_use  The maximum number of times this coupon can be used.
     * @return  self
     */
    public function setMaxUse(int $max_use): self
    {
        $this->max_use = $max_use;
        return $this;
    }

    /**
     * Get the maximum number of times this coupon can be used.
     *
     * @return  int
     */
    public function getMaxUse(): int
    {
        return $this->max_use;
    }

    /**
     * Set the number of times this coupon has been used.
     *
     * @param  int  $uses  The number of times this coupon has been used.
     * @return  self
     */
    public function setUses(int $uses): self
    {
        $this->uses = $uses;
        return $this;
    }

    /**
     * Get the number of times this coupon has been used.
     *
     * @return  int
     */
    public function getUses(): int
    {
        return $this->uses;
    }
}
