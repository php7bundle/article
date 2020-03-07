<?php

namespace PhpBundle\Article\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpBundle\Article\Domain\Entities\PostTagEntity;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;

class TagPostRepository extends BaseEloquentCrudRepository implements TagPostRepositoryInterface
{

    protected $tableName = 'article_tag_post';

    public function getEntityClass(): string
    {
        return PostTagEntity::class;
    }
}