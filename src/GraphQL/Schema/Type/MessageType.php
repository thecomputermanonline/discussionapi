<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/24/17 11:40 PM
 */

namespace  App\GraphQL\Schema\Type;


use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class MessageType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id'      => new IdType(),
            'from'   => new UserType(),
            'content'   => new StringType(),
            'date'   => new StringType(),
            'metadatas' => new ListType(new MetadataType()),
            'thread' => new ThreadType(),
        ]);
    }
}
