<?php

class WorldPay_CardDetails
{
	public $token;
	public $masked_card_number;
	public function __construct( $card_details, $token )
	{
		$this->token = $token;
		$this->masked_card_number = $card_details['maskedCardNumber'];
	}

	public static function get_by_user( $user, Worldpay $worldpay_client )
	{
		if ( $user == null ) {
			return null;
		}

		$token = WorldPay_Token::get_by_user($user);

		if ( $token == null ) {
			return null;
		}

		try{
			return new WorldPay_CardDetails($worldpay_client->getStoredCardDetails($token), $token);
		}
		catch ( Exception $e )
		{
			return null;
		}
	}
} 