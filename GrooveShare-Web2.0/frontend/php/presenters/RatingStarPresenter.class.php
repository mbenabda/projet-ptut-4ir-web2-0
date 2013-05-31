<?php

require_once(realpath(dirname(__FILE__) . "/../../../common/php/interfaces/") . "/IPresenter.class.php");

class RatingStarPresenter implements IPresenter {

    public function __construct() {
        
    }

    public function generateHTML() {
        $html = "";
        return $html;
    }

    public function generateJS() {
        $html = "<script type='text/javascript'>
                    $(function() {
                        \$(\".star\").raty({
                            starOn  : \"img/star-on.png\",
                            starOff : \"img/star-off.png\",
                            start: function() {
                                        return $(this).attr(\"data-rating\");
                                    }
                                });
                    });
                </script>";
        return $html;
    }
    
    
    public function generateImportCSS(HTMLSkeletonGenerator &$html) {
        
    }
    
    public function generateImportJS(HTMLSkeletonGenerator &$html) {

    }
}
?> 

