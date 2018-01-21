<?php
namespace Zero;

include_once __DIR__ . "/../conf/config.php";

class Zero
{
	public function __construct()
	{

	}

	public function inlet(Request $request)
	{
		include_once dirname(__FILE__) . "/../conf/route.php";
		$server = $request->getServer();
		$now_route = preg_replace('/\?.*/', '', $server['REQUEST_URI']);

		if(isset($route[$now_route])) {
			$routeConfig = $route[$now_route];
			$class = $routeConfig[0] . 'Controller';
			//@TODO class not autoload
			include_once dirname(__FILE__) . "/../app/Controller/{$class}.php";
			$class = new $class;
			$routefile = [new $class, $routeConfig[1].'Zero'];
			$parameter = isset($routeConfig[2]) ? $routeConfig[2] : [];
			$response = call_user_func_array($routefile, $parameter);
			$response = new Response();
		} else {
			$response = new Response('<center><h1>404 page not found!</h1></center>');
		}
		$response->send();
	}
}