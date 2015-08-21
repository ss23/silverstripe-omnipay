<?php

/**
 *
 * DO used as an inventory of responses from the payment gateway.
 * It has a unique index to compare responses and ensure we are not getting duplicate responses for the same request.
 * Borrows the Identifier used by GatewayMessage plus the action (notify, complete) to make sure no duplicates are processed
 *
**/
class GatewayResponseMessageInventory extends DataObject {
	
	private static $db = array(
		'ResponseIdentifier' => 'Varchar'
	);


	private static $indexes = array(
		'UniqueIdentifier' => array(
			'type' => 'unique', 
			'value' => 'ResponseIdentifier'
		)
	);
}