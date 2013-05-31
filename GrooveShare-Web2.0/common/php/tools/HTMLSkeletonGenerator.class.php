<?php
// TODO meta datas à vérifier sur site w3c

class HTMLSkeletonGenerator
{
    private $cssFiles;
    private $jsFiles;

    private $lang = null;
    private $title = null;
    private $author = null;
    private $description = null;
    private $keywords = null;
    private $robots = null;
    private $revisit_after = null;
    private $shortcut_icon = null;
    private $icon = null;

    public function __construct($title = "")
    {
        $this->cssFiles = array();
        $this->jsFiles  = array();

        $this->lang           = "fr";
        $this->title          = $title;
        $this->author         = "InsaWeb";
        $this->robots         = "index, follow";
        $this->revisit_after  = "3 day";
        $this->shortcut_icon  = "img/icons/favicon.ico";
        $this->icon           = "img/icons/favicon.png";
        $this->addStylesheet("http://fonts.googleapis.com/css?family=Audiowide", "", "Police");
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
        
    public function setAuthor($author)
    {
        $this->author = $author; 
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function setRobots($robots)
    {
        $this->robots = $robots;
    }

    public function setRevisitAfter($revisit_after)
    {
        $this->revisit_after = $revisit_after;
    }

    public function setShortcutIcon($shortcut_icon)
    {
        $this->shortcut_icon = $shortcut_icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function addStylesheet($cssFilePath, $media = "", $comment = "")
    {
        if(!empty($cssFilePath) && !array_key_exists($cssFilePath, $this->cssFiles))
        {
            $this->cssFiles[$cssFilePath] = array('link'    => $cssFilePath,
                                                  'media'   => $media,
                                                  'comment' => $comment);
        }
    }

    public function addScript($jsFilePath, $comment = "")
    {
        if(!empty($jsFilePath) && !array_key_exists($jsFilePath, $this->jsFiles))
        {
            $this->jsFiles[$jsFilePath] = array('link'    => $jsFilePath,
                                                'comment' => $comment);
        }
    }

    public function generateHTMLHead()
    {
        $lang = "";
        if(!empty($this->lang)) { $lang = $this->lang; }

        $title = $this->title;

        $author = "";
        if(!empty($this->author))
            $author = "<meta name = 'author' lang = '".$lang."' content = '".$this->author."' />";

        $description = "";
        if(!empty($this->description))
            $description = "<meta name = 'description' content = \"".$this->description."\"/>";

        $keywords = "";
        if(!empty($this->keywords))
            $keywords = "<meta name = 'keywords' lang = '".$lang."' content = \"".$this->keywords."\"/>";

        $robots = "";
        if(!empty($this->robots))
            $robots = "<meta name = 'robots' content = '".$this->robots."' />";

        $revisit_after = "";
        if(!empty($this->revisit_after))
            $revisit_after = "<meta name = 'revisit-after' content = '".$this->revisit_after."' />";

        $shortcut_icon = "";
        if(!empty($this->shortcut_icon))
            $shortcut_icon = "<link rel = 'shortcut icon' type = 'image/x-icon' href = '".$this->shortcut_icon."' />";

        $icon = "";
        if(!empty($this->icon))
            $icon = "<link rel = 'icon' type = 'image/png' href ='".$this->icon."' />";

        $nbCssFiles = count($this->cssFiles);
        $css = "";
        foreach($this->cssFiles as $row)
        {
            if(!empty($row['comment']))
                $css .= "
            <!-- ".$row['comment']." -->";
            
            $css .= "
            <link type = 'text/css' href = '".$row['link']."' rel = 'stylesheet'".(empty($row['media'])? "" : " media = '".$row['media']."'")." />";
        }
        $css = ($nbCssFiles > 0 ? "
        <!-- BEGIN CSS STYLESHEETS -->
        $css

        <!-- END CSS STYLESHEETS -->" : "");

        $nbJsFiles = count($this->jsFiles);
        $js = "";
        foreach($this->jsFiles as $row)
        {
            if(!empty($row['comment']))
                $js .= "
            <!-- ".$row['comment']." -->";

            $js .= "
            <script type = 'text/javascript' src = '".$row['link']."'></script>";
        }
        $js = ($nbJsFiles > 0 ? "
        <!-- BEGIN JAVASCRIPT SCRIPTS -->
        $js

        <!-- END JAVASCRIPT SCRIPTS -->" : "");

        $meta = $author."
        ".$description."
        ".$keywords;
        $meta = trim($meta);
        $meta .= "
        ".$robots."
        ".$revisit_after."
        ".$shortcut_icon."
        ".$icon."
        ".$css."
        ".$js;

        $head = "
<!DOCTYPE html>
<html lang = '".$this->lang."'>
    <head>
        <title>".$title."</title>
        <meta charset='utf-8'  />
        ".$meta."
    </head>
    <body>
<div id=\"global\"> "   
                

                
                ;

        return trim($head)."\n";
    }

    public function generateHTMLEnd()
    {
        $end = "</div>
    </body>
</html>"
            ;

        return $end;
    }
}

?>