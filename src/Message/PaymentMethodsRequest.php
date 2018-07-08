<?php
namespace Omnipay\PayU\Message;

/**
 * PayU purchase request
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class PaymentMethodsRequest extends AbstractRequest {
	
	/**
	 * Send data
	 * 
	 * @param array $data Data
	 * @return \Omnipay\Common\Message\ResponseInterface
	 */
	public function sendData($data): \Omnipay\Common\Message\ResponseInterface {
		$endpoint = $this->getEndpoint('paymethods');
		$headers = $this->getHeaders();
		
		$request = $this->httpClient->request('get', $endpoint, $headers);
		$response = $request->getBody()->getContents();

		return new PaymentMethodsResponse($this, $response);
	}
	
	
	/**
	 * Get headers
	 * 
	 * @return array
	 */
	public function getHeaders(): array {
		return [
            'Authorization' => 'Bearer '.$this->getParameter('accessToken')
        ];
	}
	
	
	/**
	 * Get data
	 * 
	 * @return array
	 */
	public function getData(){
		return [];
	}
	
}