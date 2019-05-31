<?php
namespace McCaulay\Selly;

use Illuminate\Http\Request;
use McCaulay\Selly\Order;

class Webhook
{
    /**
     * The webhook request.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Initialise the webhook object.
     *
     * @param $request The webhook request.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the webhook order.
     *
     * @return \McCaulay\Selly\Order
     */
    public function getOrder(): Order
    {
        return new Order((object) $this->request->all());
    }

    /**
     * Checks the webhook signature.
     *
     * @return bool
     */
    public function valid(): bool
    {
        // If no secret is set, then don't validate it.
        if (config('selly.webhook.secret') == null) {
            return true;
        }

        // Invalid if signature is missing
        $headerSignature = $this->request->header(config('selly.webhook.header'));
        if (empty($headerSignature)) {
            return false;
        }

        $signature = hash_hmac('sha512', $this->request->getContent(), config('selly.webhook.secret'));
        return hash_equals($signature, $headerSignature);
    }
}
