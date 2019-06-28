<?php


namespace  App\GraphQL\Schema\Type;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;


class UserInputType extends AbstractInputObjectType
{


    public function build($config)
    {
        $config
            ->addField('email', new NonNullType(new StringType()))
            ->addField('firstName', new StringType())
            ->addField('lastName', new StringType())
            ->addField('password',  new NonNullType(new StringType()));
    }


}
