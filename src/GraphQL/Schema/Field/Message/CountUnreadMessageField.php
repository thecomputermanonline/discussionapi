<?php


namespace  App\GraphQL\Schema\Field\Message;



use App\GraphQL\DataProvider;

use App\GraphQL\Schema\Type\UserType;

use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;

use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IntType;


class CountUnreadMessageField extends AbstractField
{

    public function getType()
    {
        return (new IntType());
    }

    public function resolve( $value, array $args, ResolveInfo $info )
    {

        $dp =  new DataProvider( $info );

       return $dp->countUnreadMessages($value);

    }



}