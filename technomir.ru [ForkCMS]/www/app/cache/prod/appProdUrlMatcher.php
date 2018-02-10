<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // backend
        if (0 === strpos($pathinfo, '/private') && preg_match('#^/private(?:/(?P<_locale>[^/]++)(?:/(?P<module>[^/]++)(?:/(?P<action>[^/]++))?)?)?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'backend')), array (  '_controller' => 'ApplicationRouting::backendController',  '_locale' => NULL,  'module' => NULL,  'action' => NULL,));
        }

        if (0 === strpos($pathinfo, '/backend')) {
            // backend_ajax
            if ($pathinfo === '/backend/ajax') {
                return array (  '_controller' => 'ApplicationRouting::backendAjaxController',  '_route' => 'backend_ajax',);
            }

            // backend_cronjob
            if ($pathinfo === '/backend/cronjob') {
                return array (  '_controller' => 'ApplicationRouting::backendCronjobController',  '_route' => 'backend_cronjob',);
            }

        }

        // frontend_ajax
        if ($pathinfo === '/frontend/ajax') {
            return array (  '_controller' => 'ApplicationRouting::frontendAjaxController',  '_route' => 'frontend_ajax',);
        }

        // install
        if ($pathinfo === '/install') {
            return array (  '_controller' => 'ApplicationRouting::installController',  '_route' => 'install',);
        }

        // api
        if (0 === strpos($pathinfo, '/api') && preg_match('#^/api(?:/(?P<version>[^/]++)(?:/(?P<client>(|client)))?)?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api')), array (  '_controller' => 'ApplicationRouting::apiController',  'version' => NULL,  'client' => NULL,));
        }

        // frontend
        if (preg_match('#^/(?P<route>(.*))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'frontend')), array (  '_controller' => 'ApplicationRouting::frontendController',  'route' => NULL,));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
