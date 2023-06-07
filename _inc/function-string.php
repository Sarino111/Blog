<?php


function plain( $str )
{
    $result =  htmlspecialchars( $str, ENT_QUOTES);
    
    return $result;    
}


/**
	 * Slugify
	 * 
	 * Create slug from string
	 * 
	 * @param $text
	 * @retur mixed|string
	 */
	function slugify($text)
	{
		// replace non letter or digits by
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate (change žš... to zs...)
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if ( empty($text) ) {
			return 'n-a';
		}

		return $text;
	}











?>