<?php

function controllers_autoload($clase){
    include('controllers/'.$clase.'.php');
}

spl_autoload_register("controllers_autoload");