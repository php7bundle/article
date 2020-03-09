<?php

namespace PhpBundle\Article\Symfony\Api;

use Doctrine\DBAL\Connection;
use Illuminate\Container\Container;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostServiceInterface;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpBundle\Article\Domain\Repositories\Relations\PostRelation;
use PhpLab\Eloquent\Db\Helpers\DoctrineHelper;
use PhpLab\Rest\Helpers\RestApiControllerHelper;
use PhpBundle\Article\Symfony\Api\Controllers\ArticleController;
use PhpBundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpBundle\Article\Domain\Repositories\Doctrine\PostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpBundle\Article\Domain\Services\PostService;
use PhpLab\Eloquent\Db\Helpers\Manager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleModule
{

    public function __construct() {
        // init DB
        //$this->capsule = new Manager(null, $_ENV['ELOQUENT_CONFIG_FILE']);
        //$this->doctrineConnection = DoctrineHelper::createConnection();
    }

    public function run() {
        $container = $this->makeContainer();
        $postService = $container->get(PostService::class);

        // define routes
        $routes = RestApiControllerHelper::defineCrudRoutes('v1/article-post', ArticleController::class);
        $request = Request::createFromGlobals();

        $response = RestApiControllerHelper::runAll($request, $routes, $container);
        $response->send();
    }

    private function makeContainer(): ContainerInterface
    {
        $container = Container::getInstance();
        $container->bind(Manager::class, Manager::class, true);
        $container->bind(Connection::class, function() {
            return DoctrineHelper::createConnection();
        }, true);
        $container->bind(Manager::class, \PhpLab\Eloquent\Db\Helpers\Manager::class, true);
        $container->bind(CategoryRepositoryInterface::class, CategoryRepository::class, true);
        $container->bind(TagRepositoryInterface::class, TagRepository::class, true);
        $container->bind(TagPostRepositoryInterface::class, TagPostRepository::class, true);
        $container->bind(PostRepositoryInterface::class, PostRepository::class, true);
        $container->bind(PostServiceInterface::class, PostService::class, true);
        return $container;
    }

}
