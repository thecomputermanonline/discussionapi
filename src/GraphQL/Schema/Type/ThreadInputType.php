<?php


namespace  App\GraphQL\Schema\Type;
use App\GraphQL\Schema\Type\UserType;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

class ThreadInputType extends AbstractInputObjectType
{

    public function build($config)
    {
        $config
            ->addField('subject', new NonNullType(new StringType()))
            ->addField('user', new StringType());
            //->addField('messages', new StringType())
            //->addField('participants', new StringType());
    }


}
