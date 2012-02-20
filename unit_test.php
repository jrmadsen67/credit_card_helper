<?php

include('credit_card_helper.php');

error_reporting(E_NONE);

assert_options(ASSERT_ACTIVE, 1);

function my_assert_handler($file, $line, $code)
{
    echo "<hr>Assertion Failed:
        Code '$code'<br /><hr />";
}

assert_options(ASSERT_CALLBACK, 'my_assert_handler');


/* -----------------------------------------------  */


// more Luhn-valid number here:
// http://www.darkcoding.net/credit-card-numbers/

$test_array = array(
	array('Unknown','123456789012345'),
	array('American Express','123456789012345'), //wrong start - fail
	array('American Express','375685299351549'), //pass
	array('American Express','379319313296201'), //pass	
	array('American Express','3756789012345126'), //wrong length - fail	
	array('Carte Blanche','38654740675913'), //fail	
	array('Diners Club','30334518576175'), //pass	
	array('Carte Blanche','38000000000006'), //pass		
	array('Discover','6011345439026801'), //pass	
	array('EnRoute','214944056463533'), //pass	
	array('EnRoute','201417211902252'), //pass
	array('JCB','210078642273355'), //fail
	array('JCB','3337018565925625'), //pass
	array('JCB','180074596070406'), //pass
	array('Master Card','5436537001548696'), //pass
	array('Visa','4929595409092649'), //pass
	array('Visa','4716628069244'), //pass
	
		
);






foreach ($test_array as $test)
{
		assert( "credit_card_determiner('$test[1]') == '$test[0]'" );

}

