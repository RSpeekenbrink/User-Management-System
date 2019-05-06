<?php

namespace App\Http;

use App\Contracts\Http\RequestInterface;

class Request implements RequestInterface
{
    /**
     * Requested URL
     *
     * @var string
     */
    protected $url;

    /**
     * Method used for the Request
     *
     * @var string
     */
    protected $method;

    /**
     * Constructor
     */
    public function __construct($url, $method)
    {
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * Create a new Request based on input from client.
     *
     * @return self
     */
    public static function capture()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $request = new self($url, $method);

        return $request;
    }

    /**
     * Get the URL for the request.
     *
     * @return string
     */
    public function url()
    {
        return strtok($this->url, '?');
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }
}
