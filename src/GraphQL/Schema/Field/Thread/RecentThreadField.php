<?php


namespace  App\GraphQL\Schema\Field\Thread;


use App\Entity\Message;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\ThreadType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;

class RecentThreadField extends AbstractField
{
    public function getType()
    {
        return new ListType(new ThreadType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {

        $dp =  new DataProvider( $info );
        return $dp->getThreads();
    }


}