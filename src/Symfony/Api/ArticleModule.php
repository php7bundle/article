<?php

namespace PhpBundle\Article\Symfony\Api;

use Doctrine\DBAL\Connection;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostServiceInterface;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpBundle\Article\Domain\Repositories\Doctrine\PostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpBundle\Article\Domain\Services\PostService;
use PhpBundle\Article\Symfony\Api\Controllers\ArticleController;
use PhpLab\Eloquent\Db\Helpers\DoctrineHelper;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Rest\Helpers\RestApiRouteHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;

class ArticleModule
{

    public function getRouteCollection(RouteCollection $routeCollection)
    {
        RestApiRouteHelper::defineCrudRoutes('v1/article-post', ArticleController::class, $routeCollection);
    }

    public function bindContainer(ContainerInterface $container)
    {
        $container->bind(CapsuleManager::class, Manager::class);
        $container->bind(Connection::class, function () {
            return DoctrineHelper::createConnection();
        });
        $container->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $container->bind(TagRepositoryInterface::class, TagRepository::class, true);
        $container->bind(TagPostRepositoryInterface::class, TagPostRepository::class);
        $container->bind(PostRepositoryInterface::class, PostRepository::class);
        $container->bind(PostServiceInterface::class, PostService::class);
    }

}
