<?php

    namespace App\DataFixtures;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use App\Entity\Tables\Housing\HousingPictures;
    use Doctrine\Persistence\ObjectManager;
    use Symfony\Component\Filesystem\Filesystem;

    class HousingPicturesEntityFixture extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            $housingGeneralInfo = $manager->getRepository(HousingGeneralInfo::class)->findAll();

            $teaserPics = [
                'public/picturesForFixtures/2d0403ab0caab78216409fdabe66f1f2e6af10d66055d311517d6f2b5fe9bbda.jpeg',
                //'\wsl.localhost\\Ubuntu\\home\\emmanuel\\test-proj\\record\\public\\picturesForFixtures\\2d0403ab0caab78216409fdabe66f1f2e6af10d66055d311517d6f2b5fe9bbda.jpeg',
                'public/picturesForFixtures/9b9ae8f58805ae7fcfe79ffc6a6f22d520403d9969169697fdb9d06d5c085fa9.jpg',
                'public/picturesForFixtures/7d15a5c674ed9f89312fd8a94291e50ffe53cc6bba631dd0be047f7a10ac8007.jpeg',
                'public/picturesForFixtures/977b7cd7d2692b5ca429d24fd513bd4ea0aac28ab0394dcdc09fba2e4c691d50.jpeg',
                'public/picturesForFixtures/470524c0f804b6d13309ba1f06a205958dae5fd47baea6d27ca6ba2bb4aa1a65.jpg',
                'public/picturesForFixtures/6757913c5ad4b3135287a03486d1c0d2a36db7d62bafc7c07ed293b299881d62.jpg',
                'public/picturesForFixtures/7371367dcc114d9d5f2647accbf1374fc3f4f2a23d482fc2f98e9be9719051dc.jpg',
                'public/picturesForFixtures/84955790a021803d6ffca66ff343740620bd606c527f1e068d41dfcc8f1afa0c.jpg',
                'public/picturesForFixtures/3075826873a8a22ad529fb960bc9f7b6b085a6339551d3da3200b84f7d470e08.jpg',
                'public/picturesForFixtures/a7909d29c491c9b53a238d672aa8796da835d55d0813b2ae3a1ab1421ddd780c.jpeg',
            ];

            $fileSystem = new Filesystem();
            //TODO: revoir cette partie car cela crée un autre dossier dans l'arborescence du projet
            $targetDirectory = 'apartments/adding/pictures/';

            //create target directory if it does not exist
            if(!$fileSystem->exists($targetDirectory)) {
                $fileSystem->mkdir($targetDirectory);
            }

            foreach ($housingGeneralInfo as $hgi) {
                $pictures = new HousingPictures();
                $teaserPicPath = $teaserPics[array_rand($teaserPics)];

                //extract file name from the path
                $fileName = basename($teaserPicPath);

                //define the new path in the target directory
                $newTeaserPicPath = $targetDirectory . $fileName;

                // Copy the file to the public/apartments/adding/pictures directory
                $sourceFilePath = $teaserPicPath;
                $targetFilePath = 'public/'.$newTeaserPicPath;
                $fileSystem->copy($sourceFilePath, $targetFilePath, true);


                $pictures->setTeaserPic($newTeaserPicPath);
                $pictures->setHousingGeneralInfo($hgi);

                $manager->persist($pictures);
            }
            $manager->flush();
        }


        public static function getGroups(): array
        {
            return ['housing_pictures'];
        }

    }