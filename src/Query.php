<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Query extends RestApi
{
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
     * Create a query.
     *
     * @return \McCaulay\Selly\Query
     */
    protected function create(): self
    {
        // TODO
        return new self(parent::save([
        ]));
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
