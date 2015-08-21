<?php

/**
 *
 * Used for invalid responses from the payment gateway, a good example would be duplicate responses for the same request.
 *
**/

class InvalidGatewayResponseException extends Exception {

}