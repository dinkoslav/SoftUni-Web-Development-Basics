<?php


namespace FRAMEWORK\Routers;
class DefaultRouter {
    public function parse(){
        echo '<pre>' . print_r($_SERVER, true).'</pre>';
    }
}