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


$test_array = array(
	array('Unknown','123456789012345'),
	array('American Express','123456789012345'), //wrong start - fail
	array('American Express','345678901234512'), //pass
	array('American Express','375678901234512'), //pass	
	array('American Express','3756789012345126'), //wrong length - fail	
	array('Diners Club','36567890123451'), //pass	
	array('Diners Club','30567890123451'), //pass	
	array('Carte Blanche','38567890123451'), //pass
	array('Carte Blanche','3856789012345'), //wrong length - fail		
	array('Discover','6011789012345145'), //pass	
	array('EnRoute','201478901234514'), //pass	
	array('EnRoute','214978901234514'), //pass
	array('JCB','3149789012345147'), //pass
	array('JCB','213178901234514'), //pass
	array('JCB','180078901234514'), //pass
	array('Master Card','5149789012345147'), //pass
	array('Visa','4149789012345147'), //pass
	array('Visa','4149789012345'), //pass
	
		
);


foreach ($test_array as $test)
{
		assert( "credit_card_determiner('$test[1]') == '$test[0]'" );

}

