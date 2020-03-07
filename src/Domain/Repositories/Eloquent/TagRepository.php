<?php

namespace PhpBundle\Article\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpBundle\Article\Domain\Entities\TagEntity;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';

    public function getEntityClass(): string
    {
        return TagEntity::class;
    }
}