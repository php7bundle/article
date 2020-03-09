<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;
use PhpLab\Eloquent\Migration\Enums\ForeignActionEnum;

class m_2014_10_15_200000_create_tag_post_table extends BaseCreateTableMigration
{

    protected $tableName = 'article_tag_post';
    protected $tableComment = 'Тэги статей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('tag_id')->comment('ID тэга');
            $table->integer('post_id')->comment('ID поста');
            $table
                ->foreign('tag_id')
                ->references('id')
                ->on($this->encodeTableName('article_tag'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
            $table
                ->foreign('post_id')
                ->references('id')
                ->on($this->encodeTableName('article_post'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }

}
