<?php
class DataValidator
{
    public static function isValidDate($theDate, $format = "yyyy-mm-dd")
    {
        if(strlen($theDate) >= 8 && strlen($theDate) <= 10)
        {
                $theDate = mb_strtolower($theDate,'UTF-8');
                $separator_only = str_replace(array('m','d','y'),'', $format);
                $separator = $separator_only[0];
                if($separator)
                {
                        $regexp = str_replace($separator, "\\" . $separator, $format);
                        $regexp = str_replace('mm', '(0[1-9]|1[0-2])', $regexp);
                        $regexp = str_replace('m', '(0?[1-9]|1[0-2])', $regexp);
                        $regexp = str_replace('dd', '(0[1-9]|[1-2][0-9]|3[0-1])', $regexp);
                        $regexp = str_replace('d', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
                        $regexp = str_replace('yyyy', '\d{4}', $regexp);
                        $regexp = str_replace('yy', '\d{2}', $regexp);
                        if($regexp != $theDate && preg_match('/'.$regexp.'$/', $theDate))
                        {
                                foreach (array_combine(explode($separator,$format), explode($separator,$theDate)) as $key=>$value)
                                {
                                        if ($key == 'yy') $year = '20'.$value;
                                        if ($key == 'yyyy') $year = $value;
                                        if ($key[0] == 'm') $month = $value;
                                        if ($key[0] == 'd') $day = $value;
                                }
                                if (checkdate($month,$day,$year))
                                        return true;
                        }
                }
        }
        return false;
    }
}
?>