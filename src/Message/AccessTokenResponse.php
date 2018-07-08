<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * PayU access token response
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class AccessTokenResponse extends AbstractResponse {
	
	/**
	 * Is token received successfuly
	 * 
	 * @return boolean
	 */
	public function isSuccessful(): bool {
		return empty($data['error']);
	}
	
	
	/**
	 * Get access token
	 * 
	 * @return string|null
	 */
	public function getToken(): ?string {
		return $this->getData()['access_token'] ?? null;
	}
	
}