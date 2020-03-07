<?php

namespace PhpBundle\Article\Symfony\Api;

use PhpLab\Rest\Helpers\RestApiControllerHelper;
use PhpBundle\Article\Symfony\Api\Controllers\ArticleController;
use PhpBundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\PostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpBundle\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpBundle\Article\Domain\Services\PostService;
use PhpLab\Eloquent\Db\Helpers\Manager;
use Symfony\Component\HttpFoundation\Request;

class ArticleModule
{

    private $capsule;

    public function __construct() {
        // init DB
        $this->capsule = new Manager(null, $_ENV['ELOQUENT_CONFIG_FILE']);
    }

    public function run() {
        // create service
        $categoryRepository = new CategoryRepository($this->capsule);
        $tagRepository = new TagRepository($this->capsule);
        $tagPostRepository = new TagPostRepository($this->capsule);
        $postRepository = new PostRepository($this->capsule, $categoryRepository, $tagRepository, $tagPostRepository);
        $postService = new PostService($postRepository);

        // define routes
        $routes = RestApiControllerHelper::defineCrudRoutes('v1/article-post', ArticleController::class);
        $request = Request::createFromGlobals();

        $controllers = [
            ArticleController::class => new ArticleController($postService),
        ];
        $response = RestApiControllerHelper::runAll($request, $routes, $controllers);
        $response->send();
    }

}
