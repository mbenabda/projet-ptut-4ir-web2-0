<?php

require_once(realpath(dirname(__FILE__)."/../../../../commons/php/interfaces/")."/IVideoPlatform.class.php");

class YoutubeVideoPlatform implements IVideoPlatform
{
    private $url_video;
    private $clean_link;

    public function __construct($url_video)
    {
        $this->url_video = $url_video;
        $clean_link = "";
    }
    
    public static function canHandle($url_video)
    {
        return ( (bool) preg_match("~".self::getRegexp()."~i", $url_video) );
    }

    public function generateHTML()
    {
        $html = "
            <object width='560' height='315'>
                <param name = 'movie' value = '".$this->getCleanLink()."'></param>
                <param name = 'allowFullScreen' value = 'true'></param>
                <param name = 'allowscriptaccess' value = 'always'></param>
                <embed src = '".$this->getCleanLink()."'
                       type = 'application/x-shockwave-flash'
                       width = '560'
                       height = '315'
                       allowscriptaccess = 'always'
                       allowfullscreen = 'true'>
                </embed>
            </object>
        ";
    }
    public function generateJS()
    {
        return "";
    }

    // http://stackoverflow.com/questions/5830387/php-regex-find-all-youtube-video-ids-in-string
    public static function getRegexp()
    {
        $regexp = '
        # Match non-linked youtube URL in the wild. (Rev:20111012)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube\.com    # or youtube.com followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\-\s]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w]*      # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w-]*        # Consume any URL (query) remainder.
        ';

        return $regexp;
    }
    
    public function getCleanLink()
    {
        if(empty($this->clean_link))
        {
            $this->clean_link = preg_replace("~".self::getRegexp()."~ix",
                                             "http://www.youtube.com/v/$1?version=3",
                                             $$this->url_video);
        }
        return $this->clean_link;
    }
}
?>