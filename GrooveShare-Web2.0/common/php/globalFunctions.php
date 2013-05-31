<?php
    function isDebugMode() {
        return ((bool) defined("__DEBUG_MODE_ON__"));
    }

    function globalUncaughtExceptionHandler(Exception $e)
    {
        echo "<b>Exception:</b> " , $e->getMessage();
    }

?>
