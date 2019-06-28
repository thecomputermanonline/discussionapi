<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 4/24/17 11:40 PM
 */

namespace  App\GraphQL\Schema\Type;

use App\GraphQL\Schema\Field\MetadatasField;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class MetadataType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id'      => new IdType(),
            'readdate'   => new StringType(),
            'user' => new ListType(new UserType()),
            'message'=> new MessageType()
            //new MetadatasField(),
        ]);
    }
}
