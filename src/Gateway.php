<?php
namespace Omnipay\PayU;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PayU\Message\{
	AccessTokenRequest,
	PurchaseRequest,
	PurchaseResponse,
	PaymentMethodsRequest,
	PaymentMethodsResponse
};

/**
 * PayU Gateway
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class Gateway extends AbstractGateway {
	
	/**
	 * Get gateway name
	 * 
	 * @return string
	 */
	public function getName(): string {
		return 'PayU';
	}
	

	/**
	 * Get default parameters
	 * 
	 * @retun array
	 */
	public function getDefaultParameters(): array {
		return [
			'accountId' => null,
			'secondKey' => null,
			'clientId' => null,
			'clientSecret' => null,
			'buyer' => null,
			'notifyUrl' => null,
			'description' => '',
			'currency' => 'PLN',
			'customerIp' => '127.0.0.1'
		];
	}
	
	
	/**
	 * Get account ID
	 * 
	 * @return string|null
	 */
	public function getAccountId(): ?string {
		return $this->getParameter('accountId');
	}
	
	
	/**
	 * Get second key
	 * 
	 * @return string|null
	 */
	public function getSecondKey(): ?string {
		return $this->getParameter('secondKey');
	}
	
	
	/**
	 * Get client ID
	 * 
	 * @return string|null
	 */
	public function getClientId(): ?string {
		return $this->getParameter('clientId');
	}
	
	
	/**
	 * Get client secret key
	 * 
	 * @return string|null
	 */
	public function getClientSecret(): ?string {
		return $this->getParameter('clientSecret');
	}
	
	
	/**
	 * Set account ID
	 * 
	 * @param int $value Account ID value
	 * @return void
	 */
	public function setAccountId(int $value): void {
		$this->setParameter('accountId', $value);
	}
	
	
	/**
	 * Set second key
	 * 
	 * @param string $value Key value
	 * @return void
	 */
	public function setSecondKey(string $value): void {
		$this->setParameter('secondKey', $value);
	}
	
	
	/**
	 * Set client ID
	 * 
	 * @param int $value Client ID
	 * @return void
	 */
	public function setClientId(int $value): void {
		$this->setParameter('clientId', $value);
	}
	
	
	/**
	 * Setclient secret key
	 * 
	 * @param string $value Client secret
	 * @return void
	 */
	public function setClientSecret(string $value): void {
		$this->setParameter('clientSecret', $value);
	}
	
	
	/**
	 * Set access token
	 * 
	 * @param string $value Access token
	 * @return void
	 */
	public function setAccessToken(string $value): void {
		$this->setParameter('accessToken', $value);
	}
	
	
	/**
	 * Set buyer
	 * 
	 * @param \Omnipay\PayU\Buyer|null $buyer Buyer data
	 * @return void
	 */
	public function setBuyer(?Buyer $buyer): void {
		$this->setParameter('buyer', $buyer);
	}
	
	
	/**
	 * Get buyer data
	 * 
	 * @return \Omnipay\PayU\Buyer|null
	 */
	public function getBuyer(): ?Buyer {
		return $this->getParameter('buyer');
	}
	
	
	/**
	 * Get access token
	 * 
	 * @return string|null
	 */
	public function getAccessToken(): ?string {
		$request = parent::createRequest(AccessTokenRequest::class, $this->getParameters());
		$response = $request->send();
		
		return $response->getToken();
	}
	
	
	/**
	 * URL that receive notifications
	 * 
	 * @param string $value Notify URL
	 * @return void
	 */
	public function setNotifyUrl(string $value): void {
		$this->setParameter('notifyUrl', $value);
	}
	
	
	/**
	 * Get notify URL
	 * 
	 * @return string
	 */
	public function getNotifyUrl(): string {
		return $this->getParameter('notifyUrl');
	}
	
	
	/**
	 * Set order description
	 * 
	 * @param string $value Description
	 * @return void
	 */
	public function setDescription(string $value): void {
		$this->setParameter('description', $value);
	}
	
	
	/**
	 * Get order description
	 * 
	 * @return string
	 */
	public function getDescription(): string {
		return $this->getParameter('description');
	}
	
	
	/**
	 * Set customer IP
	 * 
	 * @param string $customerIp Customer IP
	 * @return void
	 */
	public function setCustomerIp(string $customerIp): void {
		$this->setParameter('customerIp', $customerIp);
	}
	
	
	/**
	 * Get customer IP
	 * 
	 * @return string
	 */
	public function getCustomerIp(): string {
		return $this->getParameter('customerIp');
	}

	
	/**
	 * Purchase realization
	 * 
	 * @param array $items Items list
	 * @return ResponseInterface
	 */
	public function purchase(...$items): PurchaseResponse {
		$token = $this->getAccessToken();
		$this->setParameter('accessToken', $token);
		
		$request = parent::createRequest(PurchaseRequest::class, [
			'parameters' => $this->getParameters(),
			'items' => $items
		]);
		
		$response = $request->send();
		
		return $response;
	}
	
	
	/**
	 * Get payment methods
	 * 
	 * @return type
	 */
	public function getPaymentsMethods(): PaymentMethodsResponse {
		$token = $this->getAccessToken();
		$this->setParameter('accessToken', $token);

		$request = parent::createRequest(PaymentMethodsRequest::class, $this->getParameters());
		
		$response = $request->send();
		
		return $response;
	}
	
}