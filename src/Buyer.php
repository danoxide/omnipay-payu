<?php
namespace Omnipay\PayU;

/**
 * PayU buyer structure
 * 
 * @author Piotr Filipek <piotrek290@gmail.com>
 * @version 0.1.0
 */
class Buyer {
	
	private $email;
	private $phone;
	private $firstName;
	private $lastName;
	private $language = 'pl';
	
	
	/**
	 * Set email address
	 * 
	 * @param string $email Email address
	 * @return void
	 */
	public function setEmail(string $email): void {
		$this->email = $email;
	}
	
	
	/**
	 * Set phone number
	 * 
	 * @param int|string $phone Phone number
	 * @return void
	 */
	public function setPhone($phone): void {
		$this->phone = $phone;
	}
	
	
	/**
	 * Set first name
	 * 
	 * @param string $firstName First name
	 * @return void
	 */
	public function setFirstName(string $firstName): void {
		$this->firstName = $firstName;
	}
	
	
	/**
	 * Set last name
	 * 
	 * @param string $lastName Last name
	 * @return void
	 */
	public function setLastName(string $lastName): void {
		$this->lastName = $lastName;
	}
	
	
	/**
	 * Set language
	 * 
	 * @param string $language Language code (pl, en, etc.)
	 * @return void
	 */
	public function setLanguage(string $language): void {
		$this->language = $language;
	}
	
	
	/**
	 * Get email address
	 * 
	 * @return string|null
	 */
	public function getEmail(): ?string {
		return $this->email;
	}

	
	/**
	 * Get phone number
	 * 
	 * @return string|int|null
	 */
	public function getPhone() {
		return $this->phone;
	}

	
	/**
	 * Get first name
	 * 
	 * @return string|null
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	
	/**
	 * Get last name
	 * 
	 * @return string|null
	 */
	public function getLastName() {
		return $this->lastName;
	}

	
	/**
	 * Get language
	 * 
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}
	
}