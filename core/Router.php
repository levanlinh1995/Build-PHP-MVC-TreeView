<?php 

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\NoConfigurationException;

class Router
{
    public function __invoke(RouteCollection $routes)
    {
        $request = Request::createFromGlobals();
        $context = new RequestContext();
        $context->fromRequest($request);

        // Routing can match routes with incoming requests
        $matcher = new UrlMatcher($routes, $context);

        try {
            $matcher = $matcher->match($request->getPathInfo(), EXTR_SKIP);
    
            // Cast params to int if numeric
            array_walk($matcher, function(&$param)
            {
                if(is_numeric($param)) 
                {
                    $param = (int) $param;
                }
            });
    
            $className = '\\App\\Controllers\\' . $matcher['controller'];
            $classInstance = new $className();
    
            // Add routes as paramaters to the next class
            $params = array_merge(array_slice($matcher, 2, -1), ['request' => $request], ['routes' => $routes]);

            call_user_func_array(array($classInstance, $matcher['method']), $params);
            
        } catch (MethodNotAllowedException $e) {
            echo 'Route method is not allowed.';
        } catch (ResourceNotFoundException $e) {
            echo 'Route does not exists.';
        } catch (NoConfigurationException $e) {
            echo 'Configuration does not exists.';
        }
    }
}
