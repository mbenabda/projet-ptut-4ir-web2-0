<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IVideoPlatform.class.php");
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");


class VideoPresenter implements IPresenter
{
    private $url_video;
    private $subPresenterReflexionClass;
    private $subPresenterClassName;
    private $subPresenterInstance;

    public function __construct($url_video)
    {
        $this->url_video = $url_video;
        $this->subPresenterReflexionClass = null;
        $this->subPresenterClassName = null;
        $this->subPresenterInstance = null;

        // inclusion de touts les fichiers php du répertoire ConcreteVideoPlatforms
        $this->includeAllPHPFromDir(realpath(dirname(__FILE__)."/../ConcreteVideoPlatforms/"));

        $allClasses = get_declared_classes();
        /* recherche de la 1ere classe implémentant IVideoPlatform pour laquelle l'appel
         * de la méthode canHandle($url_video) retourne vrai */
        $i = 0;
        $classes_count = count($allClasses);
        $found = false;
        $currClassName = "";
        $currReflexionClass = "";
        while($i < $classes_count && $found == false) {
            try {
                $currClassName = $allClasses[$i];
                $currReflexionClass = new ReflectionClass($currClassName);
                // si la classe courrante implémente IVideoPlatform
                if($currReflexionClass->implementsInterface("IVideoPlatform")) {
                    //appel de la méthode static canHandle($url_video)
                    $canHandleMethod = new ReflectionMethod($currClassName, "canHandle");
                    $found = (bool) $canHandleMethod->invoke(NULL,$url_video);
                    /* si on a trouvé le presenter qui correspond à la plateforme de la vidéo
                       on le mémorise */
                    if($found) {
                        $this->subPresenterClassName = $currClassName;
                        $this->subPresenterReflexionClass = $currReflexionClass;
                        $this->subPresenterInstance = new $currClassName($url_video);
                    }
                }
            }catch(Exception $e) {}
            $i++;
        }
    }
    public function generateHTML()
    {
        if( $this->subPresenterReflexionClass == null )
            return "";
            
        $generateHTMLMethod = new ReflectionMethod($this->subPresenterClassName, "generateHTML");
        return " ".( $generateHTMLMethod->invoke($this->subPresenterInstance, $url_video) );
    }
    public function generateJS()
    {
        if( $this->subPresenterReflexionClass == null )
            return "";

        $generateJSMethod = new ReflectionMethod($this->subPresenterClassName, "generateJS");
        return " ".( $generateJSMethod->invoke($this->subPresenterInstance, $url_video) );
    }

    private function includeAllPHPFromDir($folder)
    {
        $folder = realpath($folder);
        foreach(glob($folder."/*.php") as $filename)
        {
            include_once($filename);
        }
        /*
        $tmpDir = opendir($dir) or die('Erreur');

	while($fich = @readdir($tmpDir))
        {
            if( is_dir($dir."/".$fich) && !in_array($fich, array(".", "..")) )
            {
                if($recursive)
                {
                    includeAllPHPFromDir($dir."/".$fich);
                }
            } else
            {
                $path_parts = pathinfo($dir."/".$fich);

                if( $path_parts['extension'] == "php" )
                {
                    require_once($dir."/".$fich);
                }
            }
        }
        closedir($MyDirectory);
        */
    }
}
?>
