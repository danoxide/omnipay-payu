<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * PayU purchase response
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class PurchaseResponse extends AbstractResponse {
	
	/**
	 * Is token received successfuly
	 * 
	 * @return boolean
	 */
	public function isSuccessful(): bool {
		return empty($data['error']);
	}
	
	
	/**
	 * Get order ID
	 * 
	 * @return string
	 */
	public function getTransactionId(): string {
		return $this->getData()['orderId'];
	}
	
	
	/**
	 * Get redirect URL
	 * 
	 * @return string
	 */
	public function getRedirectUrl(): string {
		return $this->getData()['redirectUri'];
	}
	
}