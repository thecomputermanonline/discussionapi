<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/23/17 11:09 PM
 */

namespace  App\GraphQL\Schema\Field\Message;


use App\Entity\Message;

use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\MessageType;

use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;

class RecentMessageField extends AbstractField
{


    public function getType()
    {
        return new ListType(new MessageType());
    }

    public function resolve($value, array $args, ResolveInfo $info )
    {
       $dp =  new DataProvider( $info );
       return $dp->getMessages();
    }


}