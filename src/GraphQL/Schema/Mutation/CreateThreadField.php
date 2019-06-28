<?php


namespace App\GraphQL\Schema\Mutation;



use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\ThreadInputType;
use App\GraphQL\Schema\Type\ThreadType;
use App\GraphQL\Schema\Type\UserType;
use App\GraphQL\Schema\Type\UserInputType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;


class CreateThreadField extends AbstractField
{


    public function build(FieldConfig $config)
    {
        $config->addArgument('thread' , new NonNullType(new ThreadInputType()));
    }
    public function getType()
    {
        return new ThreadType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {


        $dp =  new DataProvider( $info);

       $user =  $dp->CreateThread($args);


        return $user;
    }


}