<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * PayU access token request
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class AccessTokenRequest extends AbstractRequest {
	
	/**
	 * Send data
	 * 
	 * @param array $data
	 * @return \Omnipay\Common\Message\ResponseInterface
	 */
	public function sendData($data): ResponseInterface {
		$endpoint = $this->getEndpoint();
		$headers = $this->getHeaders();
		$body = http_build_query($data);
		
		$request = $this->httpClient->request('post', $endpoint, $headers, $body);
		$response = json_decode($request->getBody()->getContents(), true);
		
		return new AccessTokenResponse($this, $response);
	}
	
	
	/**
	 * Get data
	 * 
	 * @return array
	 */
	public function getData(): array {
		return [
			'grant_type' => 'client_credentials',
			'client_id' => $this->getParameter('clientId'),
			'client_secret' => $this->getParameter('clientSecret'),
		];
	}
	
	
	/**
	 * Get endpoint
	 * 
	 * @return string
	 */
	public function getEndpoint(?string $path = null): string {
		$endpoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
		return $endpoint.'pl/standard/user/oauth/authorize';
	}
	
	
	/**
	 * Get headers
	 * 
	 * @return array
	 */
	public function getHeaders(): array {
		return [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];
	}
	
}