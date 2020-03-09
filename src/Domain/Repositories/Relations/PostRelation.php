<?php

namespace PhpBundle\Article\Domain\Repositories\Relations;

use Illuminate\Support\Collection;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Interfaces\Repository\RelationConfigInterface;
use PhpLab\Core\Domain\Libs\Relation\ManyToMany;
use PhpLab\Core\Domain\Libs\Relation\OneToOne;

class PostRelation implements RelationConfigInterface
{

    private $categoryRepository;
    private $tagPostRepository;
    private $tagRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository, TagPostRepositoryInterface $tagPostRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tagPostRepository = $tagPostRepository;
        $this->tagRepository = $tagRepository;
    }

    public function primaryKey() {
        return ['id'];
    }

    public function relations()
    {
        return [
            'category' => [
                /*'type' => RelationEnum::ONE,
                'field' => 'categoryId',
                'foreign' => [
                    'model' => $this->categoryRepository,
                    'field' => 'id',
                ],*/
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new OneToOne;
                    //$m2m->selfModel = $this;

                    $m2m->foreignModel = $this->categoryRepository;
                    $m2m->foreignField = 'categoryId';
                    $m2m->foreignContainerField = 'category';

                    $m2m->run($collection);
                },
            ],
            'tags' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new ManyToMany;
                    $m2m->selfModel = $this;
                    $m2m->selfField = 'postId';

                    $m2m->viaModel = $this->tagPostRepository;

                    $m2m->foreignModel = $this->tagRepository;
                    $m2m->foreignField = 'tagId';
                    $m2m->foreignContainerField = 'tags';

                    $m2m->run($collection);
                },
            ],
        ];
    }

}