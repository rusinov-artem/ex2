<?php


namespace Rusinov\Ex2\Factory;

use Symfony\Component\Routing\RequestContext;

class RouterFactory
{
    public static function getUrlMatcher(RequestContext $context)
    {
        require_once __DIR__."/../../storage/routeMatcher.php";
        return new \ProjectUrlMatcher($context);
    }

    public static function getUrlGenerator(RequestContext $context)
    {
        require_once __DIR__."/../../storage/routeGenerator.php";
        return new \ProjectUrlGenerator($context);
    }

    public static function getContext()
    {
      $rc = new RequestContext('', $_SERVER['REQUEST_METHOD'], $_SERVER["HTTP_HOST"], 'http', 80, 433,
          parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)??'',
          parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY)??''
      );
      return $rc;
    }

}