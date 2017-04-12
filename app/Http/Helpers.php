<?php

/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) return $output;
}

/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function areActiveRoutes(Array $routes, $output = "active")
{
    foreach ($routes as $route)
    {
        if (Route::currentRouteName() == $route) return $output;
    }

}
function getWatermark($img)
{
	$wtm = \Image::make(public_path().'/img/logo_uniao.png')->resize(round($img->width()*8/100,0), null, function($constraint) {
	    		$constraint->aspectRatio();
		});
//	$img->insert($wtm, 'bottom-right', 10, 10);
	return $wtm;
}
