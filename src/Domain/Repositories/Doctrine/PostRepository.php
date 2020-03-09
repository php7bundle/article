<?php

namespace PhpBundle\Article\Domain\Repositories\Doctrine;

use Doctrine\DBAL\Connection;
use PhpBundle\Article\Domain\Entities\PostEntity;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpBundle\Article\Domain\Repositories\Relations\PostRelation;
use PhpLab\Eloquent\Db\Base\BaseDoctrineCrudRepository;

class PostRepository extends BaseDoctrineCrudRepository implements PostRepositoryInterface
{

    protected $tableName = 'article_post';
    private $categoryRepository;
    private $tagPostRepository;
    private $tagRepository;

    private $relation;

    public function __construct(Connection $capsule, PostRelation $postRelation)
    {
        parent::__construct($capsule);
        $this->relation = $postRelation;
    }

    public function getEntityClass(): string
    {
        return PostEntity::class;
    }

    public function relations()
    {
        return $this->relation->relations();
    }

}