<?php
namespace BingNewsSearch;

use BingNewsSearch\Structs\NewsAnswer;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use BingNewsSearch\Exceptions;
use BingNewsSearch\Requests;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    private GuzzleClient $_client;
    private bool $verifySsl = true;
    private bool $enableExceptions = false;


    public function __construct(
        private readonly string $token,
        protected string $endpoint='https://api.bing.microsoft.com/',
        private readonly string $version = 'v7.0',
    )
    {
    }

    public function setEndpoint(string $endpoint): static
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function request(Requests\Request $request): Requests\Request
    {
        if (empty($this->_client)) $this->_client = new GuzzleClient(['verify' => $this->verifySsl]);

            $exception = $request->onBeforeRequest();
            if ($exception) {
                $request->setError($exception);
                if ($this->enableExceptions) throw $exception;
            }
            $response = $this->_client->request((string)$request->getMethod()->value, $this->getUrl($request->getPath()), [
                RequestOptions::QUERY => $request->getQuery(),
                RequestOptions::FORM_PARAMS => $request->getFormData(),
                RequestOptions::HEADERS => [ 'Ocp-Apim-Subscription-Key' => $this->token ],
            ]);
        try {
        } catch (\Throwable $th) {
            $request->setError($th);
            if ($this->enableExceptions) {
                if (preg_match('/Could not resolve host:/', $th->getMessage())) {
                    throw new Exceptions\ConnectionException("Could not resolve endpoint. Check your network connection.");
                }
                throw new Exceptions\Exception($th->getMessage());
            }
            return $request;
        }
        $request = $request->setResponse($response);
        return $request;
    }

    public function xxrequest(Requests\Request $request): NewsAnswer
    {
        if (empty($this->_client)) {
            $this->_client = new GuzzleClient(['verify' => $this->verifySsl]);
        }

            $exception = $request->onBeforeRequest();
            if ($exception) {
                $request->setError($exception);
                if ($this->enableExceptions) throw $exception;
            }



                $response = $this->_client->request('GET', $apiUrl = $this->getUrl($request->getPath()), [
                    RequestOptions::QUERY => $request->getQuery(),
                    RequestOptions::FORM_PARAMS => $request->getFormData(),
                    RequestOptions::HEADERS => [ 'Ocp-Apim-Subscription-Key' => $this->token ],
                ]);

                $statusCode = $response->getStatusCode();
                if ($statusCode < 200 || $statusCode > 299) {
                    //
                }
                $content = $response->getBody()->getContents();
                $response = json_decode($content, true);
                dd($response);
                $returnValue =  match($response['_type']) {
                    'News' => new NewsAnswer(...$response),
                    default => assert(false, "Missing " . $response['_type'])
                };

//                dd($returnValue, $response, $apiUrl);
                $data = $returnValue;
//                dd($data);
                return $data;
//                return $returnValue;
//            });

        try {

        } catch (\Throwable $th) {
            $request->setError($th);
            if ($this->enableExceptions) {
                if (preg_match('/Could not resolve host:/', $th->getMessage())) {
                    throw new Exceptions\ConnectionException("Could not resolve endpoint. Check your network connection.");
                }
                throw new Exceptions\Exception($th->getMessage());
            }
            return $request;
        }
//        return $data;
        $request->setResponse($response);
        return $request;
    }

    public function factory(string $request, ...$args)
    {
        $request = "BingNewsSearch\Requests\\".ucfirst($request);
        if (!class_exists($request)) throw new \BadMethodCallException("Request $request not exists");
        return new $request($this, ...$args);
    }

    public function enableExceptions(bool $data = true): self
    {
        $this->enableExceptions = $data;
        return $this;
    }

    public function disableSsl(bool $data = true): self
    {
        $this->verifySsl = !$data;
        return $this;
    }

    public function getUrl(?string $path = null): string
    {
        $this->endpoint = preg_replace('/\/$/', '', $this->endpoint);
        if ($path) $path = preg_replace('/^\//', '', $path);
        return $this->getEndpoint()."/".$this->getVersion()."/".$path;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function trending(): Requests\Trending
    {
        return $this->factory('trending');
    }

    public function search(): Requests\Search
    {
        return $this->factory('search');
    }

    public function category(): Requests\Category
    {
        return $this->factory('category');
    }
}
