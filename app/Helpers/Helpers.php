<?php


use Illuminate\Support\Facades\Redirect;

function responce ($http, $message=null ,$route)
    {
        session()->flash($http, $message);
        return redirect($route);
    }


