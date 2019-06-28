<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/23/17 11:08 PM
 */

namespace  App\GraphQL\Schema\Type;

use App\Entity\Thread;
use App\Entity\User;
use App\GraphQL\DataProvider;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

class ThreadType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id'     => new IdType(),
            'subject'  => new StringType(),
            'participants' => new ListType(new UserType()),
            'messages' => new ListType(new MessageType()),
            "countUnreadMessages" => [
                "type" => new NonNullType(new IntType()),
                'resolve' => function(Thread $thread, array $args, ResolveInfo $Info) {
            $dp = new DataProvider($Info);
            return $dp->countUnreadMessages($thread);

                },
            ]

        ]);
    }

}