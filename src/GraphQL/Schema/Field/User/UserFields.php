<?php


namespace App\GraphQL\Schema\Field\User;

use App\Entity\User;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\UsersType;

use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;


class UserFields extends AbstractField
{



    public function getType()
    {
        return new ListType(new UsersType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {


        $dp =  new DataProvider( $info );
        return $dp->getUsers();



    }


}