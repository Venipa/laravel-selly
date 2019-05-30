<?php
namespace McCaulay\Selly;

use Illuminate\Support\Collection;

class Payment extends RestApi
{
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
     * Create a payment.
     *
     * @return \McCaulay\Selly\Payment
     */
    protected function create(): self
    {
        // TODO
        return new self(parent::save([
        ]));
    }
}
