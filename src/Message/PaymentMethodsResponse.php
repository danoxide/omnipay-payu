<?php
namespace Omnipay\PayU\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * PayU access token response
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class PaymentMethodsResponse extends AbstractResponse {
	
	private const STATUS_SUCCESS = 'SUCCESS';
	
	
	/**
	 * Is token received successfuly
	 * 
	 * @return boolean
	 */
	public function isSuccessful(): bool {
		$data = json_decode($this->getData(), true);
		
		if(isset($data['status']['statusCode']) && $data['status']['statusCode'] === self::STATUS_SUCCESS){
			return true;
		}
		
		return false;
	}
	
}