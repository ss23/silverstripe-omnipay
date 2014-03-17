<?php

class PaymentServiceTest extends PaymentTest{

	public function testRedirectUrl() {
		$service = PurchaseService::create(new Payment())
					->setSuccessUrl("abc/123")
					->setFailureUrl("xyz/blah/2345235?andstuff=124124#hash");
		$this->assertEquals("abc/123",$service->getSuccessUrl());
		$this->assertEquals("xyz/blah/2345235?andstuff=124124#hash",$service->getFailureUrl());
	}

}
