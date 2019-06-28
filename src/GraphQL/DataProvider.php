<?php

namespace App\GraphQL;

use App\Entity\Message;
use App\Entity\Metadata;
use App\Entity\Thread;
use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Youshido\GraphQL\Execution\ResolveInfo;


class DataProvider
{

    protected $info;
    protected $em;
   // protected $passwordencoder;

    public function __construct(ResolveInfo $info)
    {
        $this->info = $info;
        $this->em = $this->info->getContainer()->get('doctrine.orm.default_entity_manager');
        //$this->passwordencoder = $this->info->getContainer()->get('security.user_password_encoder.generic');
    }

    public function postMessage($args)
    {
        $user = $this->em->getRepository(User::class);
        $thread = $this->em->getRepository(Thread::class);
        /** @var User $messageUser */
        $messageUser = $user->findOneById($args['message']['user']);
        /** @var Thread $messageThread */
        $messageThread = $thread->findOneById($args['message']['thread']);
        $message = new Message();
        $message->setContent($args['message']['content']);
        $message->setUser($messageUser);
        $message->setThread($messageThread);
        $message->setDate($args['message']['date']);
        $this->em->persist($message);
        $this->em->flush();
        return $message;

    }
    public function getMessage($args)
    {
        $repo =  $this->em->getRepository(Message::class);
        $results = $repo->find($args['id']);
        return $results;

    }
    public function getMessages()
    {
        $repo = $this->em->getRepository(Message::class);
        $results = $repo->findAll();
        return $results;
    }
    public function createUser($args){
        //$user = $info->getContainer()->get('security.token_storage')->getToken()->getUser();
        //if (!empty($args['message']['date'])) $message['date'] = $args['message']['date'];
       //public  $passwordEncoder = new UserPasswordEncoderInterface() ;
        $user = new User();
        $user->setEmail($args['user']['email']);
        $user->setLastName($args['user']['lastName']);
        $user->setFirstName($args['user']['firstName']);
        $user->setPassword($args['user']['password']);
        $user->setRoles(['ROLE_USER']);
        $this->em->persist($user);
        $this->em->flush();
        return $user;

    }
    Public function getUser($args){


        $repo = $this->em->getRepository(User::class);

        //$results = $repo->findAll();
        $results = $repo->find($args['id']);
        return $results;

    }
    Public function getUsers(){

        $repo = $this->em->getRepository(User::class);

        //$results = $repo->findAll();
        $results = $repo->findAll();
        return $results;

    }
    public function createThread($args){



        $user = $this->em->getRepository(User::class);

        /** @var User $ThreadUser */
        $ThreadUser = $user->findOneById($args['thread']['user']);
        $thread = new Thread();
        $thread->setSubject($args['thread']['subject']);
        $thread->addParticipant($ThreadUser);
        $this->em->persist($thread);
        $this->em->flush();
        return $thread;

    }
    public function getThreads(){

        $repo = $this->em->getRepository(Thread::class);
        $results = $repo->findAll();
        return $results;

    }
    public function getThread($args){

        $repo =  $this->em->getRepository(Thread::class);
        $results = $repo->find($args['id']);
        return $results;

    }
    public function countUnreadMessages($value){


        $counter = 0;
        foreach ($value->getMessages() as $message){
             $count = $message->getMetadatas()->count();
             if(empty($count)) {
                $counter++;
             }
        }
        return $counter;


    }
    public function addMetadata($args)
    {

        $user = $this->em->getRepository(User::class);
        $message = $this->em->getRepository(Message::class);
        /** @var User $metadaUser */
        $metadataUser = $user->findOneById($args['metadata']['user']);
        /** @var Thread $messageThread */
        $metadataMessage = $message->findOneById($args['metadata']['message']);
        $metadata = new Metadata();
        $metadata->setReaddate($args['metadata']['readDate']);
        $metadata->setUser($metadataUser);
        $metadata->setMessage($metadataMessage);
        $this->em->persist($metadata);
        $this->em->flush();
        return $metadata;


    }



}