<?php

namespace PhpBundle\Article\Domain\Repositories\Eloquent;

use PhpBundle\Article\Domain\Entities\CategoryEntity;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

}