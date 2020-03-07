<?php

namespace PhpBundle\Article\Domain\Services;

use PhpLab\Core\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostServiceInterface;

/**
 * Class PostService
 * @package PhpBundle\Article\Domain\Services
 *
 * @property PostRepositoryInterface | GetEntityClassInterface $repository
 */
class PostService extends BaseCrudService implements PostServiceInterface
{

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}