<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\ResponseInterface;
use GuzzleHttp\Client;

/**
 * PayU access token request
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class AccessTokenRequest extends AbstractRequest {
	
	/**
	 * 
	 * @param type $data
	 * @return \Omnipay\Common\Message\ResponseInterface
	 */
	public function sendData($data): ResponseInterface {
		$http = new Client();
		
		$request = $http->request('post', $this->getEndpoint(), [
			'form_params' => $data
		]);

		$response = json_decode($request->getBody()->getContents(), true);
		
		return new AccessTokenResponse($this, $response);
	}
	
	
	/**
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
	
}