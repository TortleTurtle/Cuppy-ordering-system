<?php

/**
 * @param string $permission The permission you want to check the user has.
 * @param $req The request variable in the controller.
 */
function checkPermission($permission, $req){
    //If the user doesn't have the mission abort.
    if (!(in_array($permission, $req->get('permissions')))) {
        return abort(403, "You do not have the right permissions");
    }
    
}