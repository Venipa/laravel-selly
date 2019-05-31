<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class ProductGroup extends RestApi
{
    /**
     * The title of the product group.
     *
     * @var string
     */
    protected $title;

    /**
     * The product ids that this group is made up of.
     *
     * @var array
     */
    protected $product_ids;

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
     * Save the product group.
     *
     * @param $attributes The object attributes. If null, then it gets the
     * instances attributes.
     * @return \McCaulay\Selly\ProductGroup
     */
    public function save(array $attributes = null): object
    {
        return new self(parent::save($attributes));
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

    /**
     * Set the title of the product group.
     *
     * @param  string  $title  The title of the product group.
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the title of the product group.
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the product ids that this group is made up of.
     *
     * @param  array  $product_ids  The product ids that this group is made up of.
     * @return  self
     */
    public function setProductIds(array $product_ids)
    {
        $this->product_ids = $product_ids;
        return $this;
    }

    /**
     * Get the product ids that this group is made up of.
     *
     * @return  array
     */
    public function getProductIds()
    {
        return $this->product_ids;
    }
}
