<?php

namespace BingNewsSearch\Requests;

use BingNewsSearch\Enum;
use BingNewsSearch\Client;
use BingNewsSearch\Structs\NewsAnswer;
use GuzzleHttp\Psr7;

abstract class Request implements \JsonSerializable
{
    protected Psr7\Response $response;
    protected Psr7\Response $requestResponse;
    protected ?bool $status = null;
    protected ?string $message = null;
    protected ?string $statusCode = null;
    protected ?\Exception $error = null;
    protected array $formData = [];
    protected array $query = [];
    protected string $webUrl = '';
    protected ?array $data= null; // the json response

    abstract public function getMethod(): Enum\RequestMethod;
    abstract public function getPath(): string;
    abstract public function toArray(): array;
    abstract public function onBeforeRequest(): ?\Exception;

    public function __construct(private readonly Client $_client, ...$args)
    {
        if (method_exists($this, "initialize")) call_user_func_array([$this, "initialize"], $args);
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function setError(\Exception $data): self
    {
        if ($data) $this->error = $data;
        return $this;
    }


    public function setResponse(Psr7\Response $requestResponse): self
    {
        $this->requestResponse = $requestResponse;
        $jsonData = json_decode($requestResponse->getBody()->getContents(), true);
        $this->data = $jsonData;
        $this->status = ($requestResponse->getStatusCode() === 200);
        $this->webUrl = $jsonData['webSearchUrl'] ?? '';
        $this->message = $requestResponse->getReasonPhrase() ?? '';
        if (isset($jsonData["value"])) $this->setResponseData($jsonData["value"]);
        return $this;
    }

    public function getResponseData(): ?array
    {
        return $this->data;
    }

    public function setResponsexx(Psr7\Response $requestResponse): self
    {
        $this->requestResponse = $requestResponse;
        $response = json_decode($requestResponse->getBody()->getContents(), true);

//        $newsAnswer = new NewsAnswer(...$response);
//        dd($response, $newsAnswer);
//        dd($response);
        $this->status = ($requestResponse->getStatusCode() === 200);
        $this->webUrl = $response['webSearchUrl'] ?? '';
        $this->message = $requestResponse->getReasonPhrase() ?? '';
        if (isset($response["value"])) $this->setResponseData($response["value"]);
        return $this;
    }

    public function getResponse(): Psr7\Response
    {
        return $this->requestResponse;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->statusCode;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getFormData(): array
    {
        return $this->formData;
    }

    public function request(): Request
    {
        $this->_client->request($this);
        return $this;
    }

    public function getError(): ?\Exception
    {
        return $this->error;
    }

    public function getApiClient(): Client
    {
        return $this->_client;
    }
}
