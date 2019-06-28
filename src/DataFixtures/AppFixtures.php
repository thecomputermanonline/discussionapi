<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Message;
use App\Entity\Thread;
use App\Entity\Metadata;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);

        $this->loadThread($manager);
        $this->loadMessage($manager);
       $this->loadMetadata($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$firstname, $lastname, $password, $email, $roles]) {
            $user = new User();
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);

            $manager->persist($user);

           $this->addReference($email, $user);


        }

        $manager->flush();

    }





    private function loadThread(ObjectManager $manager): void
    {
        foreach ($this->getThreadData() as [$subject, $user]) {

            $thread = new Thread();
            $thread->setSubject($subject);
            $thread->addParticipant($user);
            $manager->persist($thread);
            $this->setReference("t1", $thread);
        }
        $manager->flush();
    }
    private function loadMessage(ObjectManager $manager): void
    {


        for ($n = 1; $n<=3; $n++) {

            $message = new Message();
            $message->setUser($this->getReference('roger@me.com'));
            $message->setContent($this->getRandomText(random_int(255, 512)));
            $message->setdate('10/10/2019');
            $message->setThread($this->getReference("t1"));
            $this->setReference('m-'.$n, $message);


            $manager->persist($message);
        }


        $manager->flush();
    }
    private function loadMetadata(ObjectManager $manager): void
    {

                foreach (range(1, 2) as $i) {
                    $metadata = new Metadata();
                    $metadata->setUser($this->getReference('roger@me.com'));
                    $metadata->setMessage($this->getReference('m-1'));
                    $metadata->setReaddate('10/10/2019');
                    $manager->persist($metadata);
                }


        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['Roger', 'Miller', 'mur=1234', 'roger@me.com', ['ROLE_ADMIN']],
            ['Bruce', 'Lee', 'mur=1234', 'bruce@me.com', ['ROLE_USER']],
            ['Jackie', 'Chan', 'mur=1234', 'jackie@me.com', ['ROLE_USER']],
        ];
    }



    private function getThreadData()
    {
        $threads = [];
        foreach ($this->getPhrases() as $i => $subject) {

            $threads[] = [
                $subject,
                $this->getReference('roger@me.com')

                ];
        }

        return $threads;
    }

    private function getPhrases(): array
    {
        return [
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',

        ];
    }

    private function getRandomText(int $maxLength = 255): string
    {
        $phrases = $this->getPhrases();
        shuffle($phrases);

        while (mb_strlen($text = implode('. ', $phrases) . '.') > $maxLength) {
            array_pop($phrases);
        }

        return $text;
    }



}
