<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * PayU purchase request
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class PurchaseRequest extends AbstractRequest {
	
	/**
	 * Get data
	 * 
	 * @return array
	 */
	public function getData(): array {
		return $this->getParameters();
	}

	
	/**
	 * Send data
	 * 
	 * @param array $data Parameters
	 * @return ResponseInterface
	 */
	public function sendData($data): ResponseInterface {
		$endpoint = $this->getEndpoint('orders');
		$headers = $this->getHeaders();
		$body = json_encode($this->getBody($data));
		
		$request = $this->httpClient->request('post', $endpoint, $headers, $body);
		$response = $request->getBody()->getContents();
		
		return new PurchaseResponse($this, json_decode($response, true));
	}
	
	
	/**
	 * Get purchase body
	 * 
	 * @param array $data
	 * @return array
	 */
	public function getBody(): array {
		$output = [
			'totalAmount' => $this->getTotal(),
			'notifyUrl' => $this->getParameter('notifyUrl'),
			'customerIp' => $this->getParameter('customerIp'),
			'merchantPosId' => $this->getParameter('accountId'),
			'currencyCode' => $this->getParameter('currency'),
			'description' => $this->getParameter('description'),
			'settings' => [
				'invoiceDisabled' => true
			],
			'products' => $this->getProducts()
		];
		
		$buyer = $this->getParameter('buyer');
		
		if($buyer){
			$output['buyer'] = [
				'email' => $buyer->getEmail(),
				'phone' => $buyer->getPhone(),
				'firstName' => $buyer->getFirstName(),
				'lastName' => $buyer->getLastName(),
				'language' => $buyer->getLanguage()
			];
		}
		
		return $output;
	}
	
	
	/**
	 * Get total price
	 * 
	 * @return int
	 */
	public function getTotal(): int {
		$total = 0;
		$items = $this->getParameter('items')->all();
		
		array_walk($items, function($item) use(&$total) {
			$total += $item->getPrice() * $item->getQuantity();
		});
		
		return $total;
	}
	
	
	/**
	 * Get products items
	 * 
	 * @return array
	 */
	public function getProducts(): array {
		$products = [];
		$items = $this->getParameter('items')->all();
		
		foreach($items as $item){
			$products[] = [
				'name' => $item->getName(),
				'unitPrice' => $item->getPrice(),
				'quantity' => $item->getQuantity()
			];
		}
		
		return $products;
	}
	
	
	/**
	 * Get headers
	 * 
	 * @return array
	 */
	public function getHeaders(): array {
		return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->getParameter('accessToken')
        ];
	}
	
}
