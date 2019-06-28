<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/23/17 11:05 PM
 */

namespace  App\GraphQL\Schema\Type;

use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;

use Youshido\GraphQL\Type\Scalar\StringType;

class UsersType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id'        => new NonNullType(new IdType()),
            'email' => new StringType(),
            'firstName' => new StringType(),
            'lastName'  => new StringType(),
            //'threads' => new NonNullType(new ListType(new NonNullType(new ThreadType()))),
            //'messages' => new NonNullType(new ListType(new NonNullType(new MessageType()))),
//            "countMessages" => [
//                "type" => new NonNullType(new IntType()),
                //'resolve' => function(User $user, array $args, ResolveInfo $context) {
//                    return $user->getMessages()->count();
//               },
//            ]
        ]);
    }
}