<?php 

/*

'*CARD TYPES            *PREFIX           *WIDTH
'American Express       34, 37            15
'Diners Club            300 to 305, 36    14
'Carte Blanche          38                14
'Discover               6011              16
'EnRoute                2014, 2149        15
'JCB                    3                 16
'JCB                    2131, 1800        15
'Master Card            51 to 55          16
'Visa                   4                 13, 16

*/

function credit_card_determiner($cardno)
{


	$cardname = 'Unknown';
	
	$cardno = str_replace(array("-"," "), array("",""),$cardno);

	$cardno_len = strlen($cardno);
			
	if ($cardno_len < 13 OR $cardno_len > 16 OR !is_numeric($cardno))
	{
		return 'Invalid card number';
	}
	
	//Luhn check
	if (!validLuhn($cardno))
	{
		return 'Invalid card number';
	}
	
	// what kind of card?
	
	switch ($cardno_len)
	{
		case 13:
			if (substr($cardno,0, 1) == 4){
				return $cardname = 'Visa';				
			}
			break;
		case 16:
			$card_1 = substr($cardno,0,1);
			if ($card_1 == 4){
				return $cardname = 'Visa';				
			}
			
			if ($card_1 == 3){
				return $cardname = 'JCB';				
			}	

			$card_2 = substr($cardno,0,2);
			if (in_array($card_2, array(50,51,52,53,54,55)))
			{
				return $cardname = 'Master Card';
			}

			$card_4 = substr($cardno,0,4);
			if ($card_4 == 6011){
				return $cardname = 'Discover';				
			}						
			break;
						
		case 14:
			$card_2 = substr($cardno,0,2);
			$card_3 = substr($cardno,0,3);
		
			if ($card_2 == 36 OR in_array($card_3, array(300,301,302,303,304,305)))
			{
				return $cardname = 'Diners Club';
			}
			
			if ($card_2 == 38){
				return $cardname = 'Carte Blanche';				
			}
			break;
				
		case 15:
			$card_2 = substr($cardno,0,2);			
			if (in_array($card_2, array(34,37))){
				return $cardname = 'American Express';				
			}

			$card_4 = substr($cardno,0,4);
		
			if (in_array($card_4, array(2131, 1800))){
				return $cardname = 'JCB';				
			}

			if (in_array($card_4, array(2014, 2149))){
				return $cardname = 'EnRoute';				
			}								
			break;
			

	}
	

	return $cardname;
}



/*
Copyright (c) 2008, reusablecode.blogspot.com; some rights reserved.

This work is licensed under the Creative Commons Attribution License. To view
a copy of this license, visit http://creativecommons.org/licenses/by/3.0/ or
send a letter to Creative Commons, 559 Nathan Abbott Way, Stanford, California
94305, USA.
*/

// Luhn (mod 10) algorithm

function _validLuhn($input)
{
   $sum = 0;
   $odd = strlen($input) % 2;
    
   // Remove any non-numeric characters.
   if (!is_numeric($input))
   {
       eregi_replace("D", "", $input);
   }
    
   // Calculate sum of digits.
   for($i = 0; $i < strlen($input); $i++)
   {
       $sum += $odd ? $input[$i] : (($input[$i] * 2 > 9) ? $input[$i] * 2 - 9 : $input[$i] * 2);
       $odd = !$odd;
   }
    
   // Check validity.
   return ($sum % 10 == 0) ? true : false;
}
