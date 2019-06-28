<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/23/17 11:05 PM
 */

namespace  App\GraphQL\Schema\Type;

use App\Entity\User;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Field\Message\CountUnreadMessageField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

class UserType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id'        => new NonNullType(new IdType()),
            'email' => new StringType(),
            'firstName' => new StringType(),
            'lastName'  => new StringType(),
            'threads' => new NonNullType(new ListType(new NonNullType(new ThreadType()))),
            'messages' => new NonNullType(new ListType(new NonNullType(new MessageType()))),
            //'countUnreadMessages' => new CountUnreadMessageField(),
            "countUnreadMessages" => [
                "type" => new NonNullType(new IntType()),
                'resolve' => function(User $user, array $args, ResolveInfo $info) {
                                    $dp = new DataProvider($info);
                                    return $dp->countUnreadMessages($user);
                            },
            ]
        ]);
    }
}

