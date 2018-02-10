<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appInstallUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appInstallUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        'backend' => array (  0 =>   array (    0 => '_locale',    1 => 'module',    2 => 'action',  ),  1 =>   array (    '_controller' => 'ApplicationRouting::backendController',    '_locale' => NULL,    'module' => NULL,    'action' => NULL,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'action',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'module',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => '_locale',    ),    3 =>     array (      0 => 'text',      1 => '/private',    ),  ),  4 =>   array (  ),),
        'backend_ajax' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'ApplicationRouting::backendAjaxController',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/backend/ajax',    ),  ),  4 =>   array (  ),),
        'backend_cronjob' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'ApplicationRouting::backendCronjobController',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/backend/cronjob',    ),  ),  4 =>   array (  ),),
        'frontend_ajax' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'ApplicationRouting::frontendAjaxController',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/frontend/ajax',    ),  ),  4 =>   array (  ),),
        'install' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'ApplicationRouting::installController',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/install',    ),  ),  4 =>   array (  ),),
        'api' => array (  0 =>   array (    0 => 'version',    1 => 'client',  ),  1 =>   array (    '_controller' => 'ApplicationRouting::apiController',    'version' => NULL,    'client' => NULL,  ),  2 =>   array (    'client' => '(|client)',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '(|client)',      3 => 'client',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'version',    ),    2 =>     array (      0 => 'text',      1 => '/api',    ),  ),  4 =>   array (  ),),
        'frontend' => array (  0 =>   array (    0 => 'route',  ),  1 =>   array (    '_controller' => 'ApplicationRouting::frontendController',    'route' => NULL,  ),  2 =>   array (    'route' => '(.*)',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '(.*)',      3 => 'route',    ),  ),  4 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens);
    }
}
