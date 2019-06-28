<?php

namespace App\GraphQL\Schema;

use App\GraphQL\Schema\Mutation\AddMetadataField;
use App\GraphQL\Schema\Mutation\CreateThreadField;
use App\GraphQL\Schema\Mutation\CreateUserField;
use App\GraphQL\Schema\Field\Thread\RecentThreadField;
use App\GraphQL\Schema\Field\Message\RecentMessageField;
use App\GraphQL\Schema\Field\MetaData\MetadatasField;
use App\GraphQL\Schema\Field\User\UserField;
use App\GraphQL\Schema\Field\User\UserFields;
use App\GraphQL\Schema\Mutation\PostMessageField;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;


class DiscussionSchema extends AbstractSchema
{
    public function build(SchemaConfig $config )
    {


        $config->getQuery()->addFields([

            new UserField(),
            new UserFields(),
            new RecentMessageField(),
            new RecentThreadField(),
            new MetadatasField(),
        ]);


        $config->getMutation()->addFields([
            new PostMessageField(),
            new CreateUserField(),
            new CreateThreadField(),
            new AddMetadataField()

        ]);
    }
}