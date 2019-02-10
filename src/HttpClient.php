<?php
namespace Santosh\Client;


use Santosh\Client\Exceptions\PayloadException;

class HttpClient
{

    protected $headers;

    protected $endPoint;

    protected $responsePayload;


    public function setUp(string $endPoint, array $headers = [])
    {
        $this->headers = $headers;

        $this->endPoint = $endPoint;

        return $this;
    }

    /**
     * @param array $payload
     * @param int $post
     * @param bool $sslVerifyPeers
     * @return $this
     */
    public function sendRequest(array $payload, int $post = 0, bool $sslVerifyPeers = false)
    {
        if (is_null($this->endPoint)) {
            throw new PayloadException('End point for the request is not set.');
        }

        if (is_null($payload) || is_array($payload) === false) {
            throw new PayloadException('sendRequest() method requires one parameter to be array, 0 passed.');
        }

        $curlConnection = curl_init($this->endPoint);

        $header = is_array($this->headers) ? 1 : 0;

        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curlConnection, CURLOPT_HEADER, $header);
        curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curlConnection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curlConnection, CURLOPT_POST, $post);
        curl_setopt($curlConnection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, $sslVerifyPeers);
        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, 1);

        $response = curl_exec($curlConnection);

        $headerSize = curl_getinfo($curlConnection, CURLINFO_HEADER_SIZE);

        $responsePayload = substr($response, $headerSize);

        $this->responsePayload = $responsePayload;

        return $this;
    }

    /**
     * @param bool $assoc
     *
     * @return mixed
     */
    public function jsonResponse(bool $assoc = false)
    {
        $responseIsXml = @simplexml_load_string($this->responsePayload);

        if($responseIsXml){
            return $this->xmlToJson($assoc);
        }

        return json_decode($this->responsePayload, $assoc);
    }

    /**
     * @param bool $assoc
     *
     * @return mixed
     */
    public function xmlToJson(bool $assoc = false)
    {
        $responseIsXml = @simplexml_load_string($this->responsePayload);

        if($responseIsXml === false){
            throw new PayloadException('Response sent from the server does not contain valid xml content.');
        }

        $response = json_encode(simplexml_load_string($this->responsePayload));

        return json_decode($response);
    }
}