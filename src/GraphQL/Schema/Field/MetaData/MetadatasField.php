<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/24/17 11:42 PM
 */

namespace  App\GraphQL\Schema\Field\MetaData;


use App\Entity\Metadata;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\MetadataType;
use Youshido\GraphQL\Execution\DeferredResolver;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;

class MetadatasField extends AbstractField
{
    public function getType()
    {
        return new ListType(new MetadataType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {

        $dp =  new DataProvider( $info );
        return $dp->getMetadatas();


    }

}