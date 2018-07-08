<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\ResponseInterface;
use GuzzleHttp\Client;

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
	public function getBody(array $data): array {
		$total = 0;
		$products = [];
		
		foreach($data['items'] as $item){
			/* @var $item \Omnipay\Common\Item */
			$total += $item->getPrice() * $item->getQuantity();
			
			$products[] = [
				'name' => $item->getName(),
				'unitPrice' => $item->getPrice(),
				'quantity' => $item->getQuantity()
			];
		}
		
		return [
			'totalAmount' => $total,
			'notifyUrl' => 'https://piotrfilipek.com.pl/',
			'customerIp' => '127.0.0.1',
			'merchantPosId' => $this->getParameter('accountId'),
			'currencyCode' => 'PLN',
			'description' => 'Opis zamówienia',
			'settings' => [
				'invoiceDisabled' => true
			],
			'products' => $products,
			'buyer' => [
				'email' => 'piotrek290@gmail.com',
				'phone' => 555666999,
				'firstName' => 'Piotr',
				'lastName' => 'Filipek',
				'language' => 'pl'
			]
		];
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
