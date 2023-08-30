<?php

namespace Michalsn\CodeIgniterHtmx\HTTP;

use CodeIgniter\HTTP\Response as BaseResponse;
use InvalidArgumentException;

class Response extends BaseResponse
{
    use HtmxTrait;

    /**
     * Pushes a new url into the history stack.
     *
     * @return Response;
     */
    public function setPushUrl(?string $url = null): Response
    {
        $this->setHeader('HX-Push-Url', $url ?? 'false');

        return $this;
    }

    /**
     * Replaces the current URL in the location bar.
     *
     * @return Response;
     */
    public function setReplaceUrl(?string $url = null): Response
    {
        $this->setHeader('HX-Replace-Url', $url ?? 'false');

        return $this;
    }

    /**
     * Allows you to specify how the response will be swapped.
     *
     * @return Response;
     */
    public function setReswap(string $method): Response
    {
        $this->validateSwap($method, 'HX-Reswap');

        $this->setHeader('HX-Reswap', $method);

        return $this;
    }

    /**
     * A CSS selector that updates the target of the content
     * update to a different element on the page.
     *
     * @return Response;
     */
    public function setRetarget(string $selector): Response
    {
        $this->setHeader('HX-Retarget', $selector);

        return $this;
    }

    /**
     * Allows you to trigger client side events.
     *
     * @param array|string $params // downgrade to php 7.4
     *
     * @return Response;
     */
    public function triggerClientEvent(string $name, $params = '', string $after = 'receive'): Response
    {
        // downgrade to php 7.4: start
        // $header = match ($after) {
        //     'receive' => 'HX-Trigger',
        //     'settle'  => 'HX-Trigger-After-Settle',
        //     'swap'    => 'HX-Trigger-After-Swap',
        //     default   => throw new InvalidArgumentException('A value for "after" argument must be one of: "receive", "settle", or "swap".'),
        // };
        // replacement for match defined as a private method below

        $header = $this->match74($after);
        // downgrade to php 7.4: end

        if ($this->hasHeader($header)) {
            $data = json_decode($this->header($header)->getValue(), true);
            if ($data === null) {
                throw new InvalidArgumentException(sprintf('%s header value should be a valid JSON.', $header));
            }
            $data[$name] = $params;
        } else {
            $data = [$name => $params];
        }

        $this->setHeader($header, json_encode($data));

        return $this;
    }

    // downgrade to php 7.4: define the function to replace php8's match
    private function match74($value)
    {
        if ($value === 'receive') {
            return 'HX-Trigger';
        }
        if ($value === 'settle') {
            return 'HX-Trigger-After-Settle';
        }
        if ($value === 'swap') {
            return 'HX-Trigger-After-Swap';
        }

        throw new InvalidArgumentException('A value for "after" argument must be one of: "receive", "settle", or "swap".');
    }
    // downgrade to php 7.4: end
}
