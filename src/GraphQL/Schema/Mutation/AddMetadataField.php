<?php


namespace App\GraphQL\Schema\Mutation;


use App\Entity\Message;
use App\Entity\Thread;
use App\Entity\User;
use App\GraphQL\DataProvider;
use App\GraphQL\Schema\Type\MessageType;
use App\GraphQL\Schema\Type\MessageInputType;

use App\GraphQL\Schema\Type\MetadataInputType;
use App\GraphQL\Schema\Type\MetadataType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class AddMetadataField extends AbstractField
{

    public function build(FieldConfig $config)
    {
        $config->addArgument('metadata' , new MetadataInputType());
    }

    public function getType()
    {
        return new MetadataType();
    }

    public function resolve($value, array $args, ResolveInfo $info )
    {


        $dp =  new DataProvider( $info );

       $metadata =  $dp->AddMetadata($args);


        return $metadata;
    }


}