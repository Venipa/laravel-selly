<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class ProductGroup extends RestApi
{
    /**
     * Initialise a product group.
     *
     * @param $payment The raw product group object.
     */
    public function __construct(object $productGroup = null)
    {
        parent::__construct('/product_groups', $productGroup);
    }

    /**
     * Get all of the product groups.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($productGroup) {
            return new self($productGroup);
        });
    }

    /**
     * Get the product group for the given id.
     *
     * @param $id The product group id.
     * @return \McCaulay\Selly\ProductGroup
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Create a product group.
     *
     * @return \McCaulay\Selly\ProductGroup
     */
    protected function create(): self
    {
        // TODO
        return new self(parent::save([
        ]));
    }

    /**
     * Update the product group.
     *
     * @return \McCaulay\Selly\ProductGroup
     */
    public function update(): object
    {
        return new self(parent::update());
    }
}
