<?php 


function credit_card_determiner($cardno)
{

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

	$cardname = 'Unknown';
	
	$cardno = str_replace(array("-"," "), array("",""),$cardno);

	$cardno_len = strlen($cardno);
			
	if ($cardno_len < 13 OR $cardno_len > 16 OR !is_numeric($cardno))
	{
		return $cardname;
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