<?php


namespace App\GraphQL\Schema\Mutation;



use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\UserType;
use App\GraphQL\Schema\Type\UserInputType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;


class CreateUserField extends AbstractField
{

    public function build(FieldConfig $config)
    {
        $config->addArgument('user' , new UserInputType());
    }

    public function getType()
    {
        return new UserType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {


        $dp =  new DataProvider( $info);

       $user =  $dp->CreateUser($args);


        return $user;
    }


}