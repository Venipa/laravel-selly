<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Product extends RestApi
{
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
     * @return \McCaulay\Selly\Product
     */
    protected function create(): self
    {
        // TODO
        return new self(parent::save([
        ]));
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
}
