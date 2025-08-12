<?php
namespace Zero;

include_once __DIR__ . "/../conf/config.php";
include_once __DIR__ . "/Log.php"; // 加载日志类

// 初始化日志系统
Log::getInstance()->config([
    'log_level' => DEBUG ? 'debug' : 'info',
]);

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
			// 使用配置的路由
			$routeConfig = $route[$now_route];
			$class = $routeConfig[0] . 'Controller';
			$method = $routeConfig[1] . 'Zero';
		} else {
			// 自动路由机制
			// 解析URL路径，如 /controller/method
			$pathParts = explode('/', trim($now_route, '/'));
			
			// 默认控制器为Index，默认方法为index
			$controllerName = isset($pathParts[0]) && $pathParts[0] ? ucfirst($pathParts[0]) : 'Index';
			$methodName = isset($pathParts[1]) && $pathParts[1] ? $pathParts[1] : 'index';
			
			$class = $controllerName . 'Controller';
			$method = $methodName . 'Zero';
		}

		// 检查控制器文件是否存在
		$controllerFile = dirname(__FILE__) . "/../app/Controller/{$class}.php";
		if(file_exists($controllerFile)) {
			//@TODO class not autoload
			include_once $controllerFile;
			
			// 检查控制器类是否存在
			if(class_exists($class)) {
				$controller = new $class;
				
				// 检查方法是否存在
					if(method_exists($controller, $method)) {
						$routefile = [$controller, $method];
						$parameter = []; // 可以根据需要从URL中解析参数
						$result = call_user_func_array($routefile, $parameter);

						// 判断返回值类型，实现API模式
						if (is_array($result)) {
							// 如果返回数组，以JSON格式输出
							$response = new Response();
							$response->dataPrint($result);
						} elseif (is_string($result) && !empty($result)) {
							// 如果返回非空字符串，直接输出
							$response = new Response($result);
							$response->send();
						} else {
							// 默认行为
							$response = new Response();
						}
					} else {
					// 方法不存在
					if(isset($route['404'])) {
						$routeConfig = $route['404'];
						$errorClass = $routeConfig[0] . 'Controller';
						include_once dirname(__FILE__) . "/../app/Controller/{$errorClass}.php";
						$errorController = new $errorClass;
						$errorMethod = $routeConfig[1] . 'Zero';
						$response = call_user_func_array([$errorController, $errorMethod], []);
					} else {
						$response = new Response('<center><h1>404 Method not found!</h1></center>');
					}
				}
			} else {
				// 控制器不存在
				if(isset($route['404'])) {
					$routeConfig = $route['404'];
					$errorClass = $routeConfig[0] . 'Controller';
					include_once dirname(__FILE__) . "/../app/Controller/{$errorClass}.php";
					$errorController = new $errorClass;
					$errorMethod = $routeConfig[1] . 'Zero';
					$response = call_user_func_array([$errorController, $errorMethod], []);
				} else {
					$response = new Response('<center><h1>404 Controller not found!</h1></center>');
				}
			}
		} else {
			// 控制器文件不存在
			if(isset($route['404'])) {
				$routeConfig = $route['404'];
				$errorClass = $routeConfig[0] . 'Controller';
				include_once dirname(__FILE__) . "/../app/Controller/{$errorClass}.php";
				$errorController = new $errorClass;
				$errorMethod = $routeConfig[1] . 'Zero';
				$response = call_user_func_array([$errorController, $errorMethod], []);
			} else {
				$response = new Response('<center><h1>404 Controller file not found!</h1></center>');
			}
		}
		$response->send();
	}
}