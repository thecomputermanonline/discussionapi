<?php


namespace  App\GraphQL\Schema\Type;
use App\GraphQL\Schema\Type\UserType;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

class MessageInputType extends AbstractInputObjectType
{

    public function build($config)
    {
        $config
            ->addField('date', new NonNullType(new StringType()))
            ->addField('content', new NonNullType(new StringType()))
            ->addField('user', new NonNullType(new StringType()))
            ->addField('thread', new NonNullType(new StringType()));
    }


}
