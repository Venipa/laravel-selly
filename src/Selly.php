<?php
namespace McCaulay\Selly;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use McCaulay\Selly\Coupon;
use McCaulay\Selly\Order;
use McCaulay\Selly\Payment;
use McCaulay\Selly\Product;
use McCaulay\Selly\ProductGroup;
use McCaulay\Selly\Query;
use McCaulay\Selly\Webhook;

class Selly
{
    /**
     * Get the coupon for the given id.
     *
     * @param string $id The coupon id.
     * @return \McCaulay\Selly\Coupon
     */
    public function coupon(string $id): Coupon
    {
        return Coupon::find($id);
    }

    /**
     * Get all of the coupons.
     *
     * @return \Illuminate\Support\Collection
     */
    public function coupons(): Collection
    {
        return Coupon::all();
    }

    /**
     * Get the order for the given id.
     *
     * @param string $id The order id.
     * @return \McCaulay\Selly\Order
     */
    public function order(string $id): Order
    {
        return Order::find($id);
    }

    /**
     * Get all of the orders.
     *
     * @return \Illuminate\Support\Collection
     */
    public function orders(): Collection
    {
        return Order::all();
    }

    /**
     * Get the payment for the given id.
     *
     * @param string $id The payment id.
     * @return \McCaulay\Selly\Payment
     */
    public function payment(string $id): Payment
    {
        return Payment::find($id);
    }

    /**
     * Get all of the payments.
     *
     * @return \Illuminate\Support\Collection
     */
    public function payments(): Collection
    {
        return Payment::all();
    }

    /**
     * Get the product for the given id.
     *
     * @param string $id The product id.
     * @return \McCaulay\Selly\Product
     */
    public function product(string $id): Product
    {
        return Product::find($id);
    }

    /**
     * Get all of the products.
     *
     * @return \Illuminate\Support\Collection
     */
    public function products(): Collection
    {
        return Product::all();
    }

    /**
     * Get the product group for the given id.
     *
     * @param string $id The product group id.
     * @return \McCaulay\Selly\ProductGroup
     */
    public function productGroup(string $id): ProductGroup
    {
        return ProductGroup::find($id);
    }

    /**
     * Get all of the product groups.
     *
     * @return \Illuminate\Support\Collection
     */
    public function productGroups(): Collection
    {
        return ProductGroup::all();
    }

    /**
     * Get the query for the given id.
     *
     * @param string $id The query id.
     * @return \McCaulay\Selly\Query
     */
    public function query(string $id): Query
    {
        return Query::find($id);
    }

    /**
     * Get all of the queries.
     *
     * @return \Illuminate\Support\Collection
     */
    public function queries(): Collection
    {
        return Query::all();
    }

    /**
     * Validate the integrity then get the order from the webhook.
     * Returns null when the webhook request validation fails.
     *
     * @param \Illuminate\Http\Request $request
     * @return \McCaulay\Selly\Order
     */
    public function webhook(Request $request): Order
    {
        $webhook = new Webhook($request);

        if (!$webhook->valid()) {
            return null;
        }
        return $webhook->getOrder();
    }
}
