<?php

namespace PhpBundle\Article\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpBundle\Article\Domain\Entities\CategoryEntity;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

}