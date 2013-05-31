<?php
//TODO DataPurifier à compléter (pas urgent)
require_once(realpath(dirname(__FILE__)."/")."/DataValidator.class.php");

class DataPurifier
{
    public static function purifyInt($val)
    {
        $val = filter_var($val, FILTER_SANITIZE_NUMBER_INT);
        return filter_var($val, FILTER_VALIDATE_INT);
    }

    public static function purifyString($str)
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    public static function purifyAlphaString($str)
    {
        return $str;
    }
    
    public static function purifyURL($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }

    public static function purifyDate($theDate, $format = "yyyy-mm-dd")
    {
        if(DataValidator::isValidDate($theDate, $format))
            return $theDate;
        return null;
    }

    public static function purifyDateTime($theDateTime)
    {
        return $theDateTime;
    }

    public static function purifyBoolean($theBool)
    {
        return $theBool;
    }

    public static function purifyEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function cropString($str, $len = 300)
    {
        if ( strlen($str) <= $len )
            return $str;

        // find the longest possible match
        $pos = 0;
        foreach ( array('. ', '? ', '! ') as $punct )
        {
            $npos = strpos($str, $punct);

            if ( $npos > $pos && $npos < $len )
                $pos = $npos;
        }

        if ( !$pos )
            return substr($str, 0, $len-3) . ' ...'; // substr $len-3, because the ellipsis adds 3 chars

        // $pos+1 to grab punctuation mark
        return substr($str, 0, $pos+1) . ' ...';
    }

}
?>
