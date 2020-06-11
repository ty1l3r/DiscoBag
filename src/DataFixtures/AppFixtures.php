<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Disk;
use App\Entity\Set;
use App\Entity\Social;
use App\Entity\Track;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)

    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker =Factory::create('fr_FR');
        $users = [];

        //Artist =======================================================================================================
        for ( $a = 0;  $a < 30; $a++) {
            $artist = New Artist();

            $artist ->setPseudo($faker->userName)
                ->setCrew($faker->word)
                ->setCountry($faker->countryCode);

            $manager->persist($artist);

        }

        //Track ========================================================================================================
        for ( $t = 0;  $t < 30; $t++) {
            $track = New Track();

            $track  ->setTitle($faker->title)
                ->setLength($faker->dateTime($max ='now'))
                ->setFace('A1')
                ->setTone('C Major')
                ->addArtiste($artist)
            ;
            $manager->persist($track);
        }
        //DISK =========================================================================================================

        for ( $d = 0;  $d < 30; $d++) {
            $disk = New Disk();

            $titleWord = $faker->numberBetween(1,4);

            $disk   ->setArtwork($faker->imageUrl($width = 400, $height = 400))
                ->setDiskTitle($faker->sentence($nbWords = $titleWord))
                ->setYear($faker->year($max = 'now'))
                ->setLabel($faker->word)
                ->addArtiste($artist)
                ->addTrack($track)
            ;

            $manager->persist($disk);
        }

        //Créeation des User ===========================================================================================
            $genreFaker = ['male','female'];

            for ($u = 0; $u < 5; $u++) {
                $user = New User();

                //password
                $hash = $this->encoder->encodePassword($user, 'password');

                //random male ou female
                $genre = $faker->randomElement($genreFaker);

                //condition pour la photo de profil homme ou femme
                $picture = 'https://randomuser.me/api/portraits/';
                $pictureId = $faker->numberBetween(1,99) .'.jpg';
                $picture .= ($genre == 'male' ? 'men/' : 'women/'). $pictureId;

                $user   ->setEmail($faker->email)
                        ->setRoles(['ROLE_USER'])
                        ->setPassword($hash)
                        ->setFirstName($faker->firstName($genre))
                        ->setLastName($faker->lastName)
                        ->setDjName($faker->domainWord)
                        ->setCrew($faker->word)
                        ->setAvatar($picture)
                        ->setBirth($faker->dateTimeBetween($startDate = '-40 years', $endDate = '-15 years', $timezone = null))
                        ->setgenre($genre);

        //SET ==========================================================================================================
                for ($s = 0; $s < mt_rand(1,3); $s++){
                    $set = New Set();
                    $setWord = $faker->numberBetween(1,4);
                    $set     ->setUser($user)
                        ->setSetName($faker->sentence($nbWords = $setWord));
                    $manager->persist($set);
                }



        //SOCIAL =======================================================================================================
                $social = New Social();
                $social ->setYoutube('http://shorturl.at/lHIX9')
                        ->setFb('https://fr-fr.facebook.com/hakha.music.maker/')
                        ->setInsta('https://www.instagram.com/h4kh4_music')
                        ->setDeezer('https://www.deezer.com/fr/album/46528592')
                        ->setTwitter('https://twitter.com/H4kh4_Music')
                        ->setUser($user);

                $manager->persist($user);
                $users[] = $user;
            }






        $manager->flush();
    }
}
