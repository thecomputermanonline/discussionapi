<?php


namespace App\GraphQL\Schema\Field\User;

use App\Entity\User;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\UserType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;

use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;


class UserField extends AbstractField
{
    public function build(FieldConfig $config)
    {
       $config->addArgument('id', new NonNullType(new IdType()));
    }


    public function getType()
    {
        return (new UserType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {

        $dp =  new DataProvider( $info );
        return $dp->getUser($args);

    }


}