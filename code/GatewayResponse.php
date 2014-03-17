<?php

/**
 * Wrapper for omnipay responses, which allow us to customise functionality
 *
 * @package payment
 */
class GatewayResponse{

	private $response;
	
	private $payment;
	
	private $message;
	
	/**
	 * @var String URL to an endpoint within SilverStripe that can process
	 * the response, usually {@link PaymentGatewayController}.
	 * This controller might further redirect the user, based on the
	 * $SuccessURL and $FailureURL messages in {@link GatewayRequestMessage}.
	 */
	private $redirect;

	public function __construct(Payment $payment) {
		$this->payment = $payment;
	}

	/**
	 * Check if the response indicates a successful gateway action
	 * @return boolean
	 */
	public function isSuccessful() {
		return $this->response && $this->response->isSuccessful();
	}

	/**
	 * Check if a redirect is required
	 * @return boolean
	 */
	public function isRedirect() {
		return $this->response && $this->response->isRedirect();
	}

	public function setOmnipayResponse(Omnipay\Common\Message\AbstractResponse $response) {
		$this->response = $response;

		return $this;
	}

	public function getOmnipayResponse() {
		return $this->response;
	}

	public function setMessage($message) {
		$this->message = $message;

		return $this;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setRedirectURL($url) {
		$this->redirect = $url;

		return $this;
	}

	/**
	 * Get the appropriate redirect url
	 */
	public function getRedirectURL() {
		return $this->redirect;
	}

	/**
	 * Do a redirect, using the current controller
	 */
	public function redirect() {
		$redirectOmnipayResponse = $this->response->getRedirectResponse();
		if($redirectOmnipayResponse instanceof Symfony\Component\HttpFoundation\RedirectResponse) {
			return Controller::curr()->redirect($redirectOmnipayResponse->getTargetUrl());	
		} else {
			return (string)$redirectOmnipayResponse->getContent();
		}		
	}

}
