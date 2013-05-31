<?php

class MediumUnreachableException extends Exception
{
    protected $message = "";
    protected $code;
    // Redéfinition de l'exception: ainsi le message est obligatoire
    public function __construct($message, $code = 0)
    {
        // traitement personnalisé ...

        $this->message = $message;
        $this->code = $code;
        // on s'assurez que tout a été assigné proprement
        //parent::__construct($message, $code);
    }

    // chaîne personnalisée représentant l'objet
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
?>