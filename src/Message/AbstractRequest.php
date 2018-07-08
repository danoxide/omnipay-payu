<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\AbstractRequest as AbstractOmnipayRequest;
use Omnipay\PayU\Buyer;

abstract class AbstractRequest extends AbstractOmnipayRequest {

	/**
	 * @var string API version
	 */
	protected const API_VERSION = 'v2_1';
	
	/**
	 * @var string Live / production endpoint
	 */
	protected $liveEndpoint = 'https://secure.payu.com/';
	
	/**
	 * @var string Test / development endpoint
	 */
	protected $testEndpoint = 'https://secure.snd.payu.com/';
	
	
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
			'notifyUrl' => '',
			'customerIp' => '127.0.0.1',
			'description' => ''
		];
	}
	
	
	/**
	 * Get endpoint
	 * 
	 * @return string
	 */
	public function getEndpoint(?string $path = null): string {
		$endpoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
		return $endpoint.'api/'.self::API_VERSION.'/'.$path;
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
	 * Get access token
	 * 
	 * @return string
	 */
	public function getAccessToken(): string {
		$this->getParameter('accessToken');
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
	
}