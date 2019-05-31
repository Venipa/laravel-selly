<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Query extends RestApi
{
    /**
     * Unique token for the query.
     *
     * @var string
     */
    protected $secret;

    /**
     * Status of the query.
     *
     * @var integer
     */
    protected $status;

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
     * Two letter country code of the customer that initiated the query.
     *
     * @var string
     */
    protected $country_code;

    /**
     * The url of the avatar.
     *
     * @var string
     */
    protected $avatar_url;

    /**
     * Initialise a query.
     *
     * @param $payment The raw query object.
     */
    public function __construct(object $query = null)
    {
        parent::__construct('/queries', $query);
    }

    /**
     * Get all of the queries.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return parent::all()->map(function ($query) {
            return new self($query);
        });
    }

    /**
     * Get the query for the given id.
     *
     * @param $id The query id.
     * @return \McCaulay\Selly\Query
     */
    protected function find(string $id): object
    {
        return new self(parent::find($id));
    }

    /**
     * Save the query.
     *
     * @param $attributes The object attributes. If null, then it gets the
     * instances attributes.
     * @return \McCaulay\Selly\Query
     */
    public function save(array $attributes = null): object
    {
        return new self(parent::save($attributes));
    }

    /**
     * Update the query.
     *
     * @return \McCaulay\Selly\Query
     */
    public function update(): object
    {
        return new self(parent::update());
    }
}
