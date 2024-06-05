<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Planet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AppFixtures extends Fixture
{
    private function loadData($file)
    {
        $filename = __DIR__ . '/' . $file;
        echo $filename;

        //echo $filename;
        // Check if the file exists
        if (!file_exists($filename)) {
            echo "Erreur : le fichier n'existe pas.";
            return null; // Return early to avoid further processing
        }

        // Attempt to read the file contents
        $fileContents = file_get_contents($filename);
        if ($fileContents === false) {
            echo "Erreur : impossible de lire le fichier.";
            return null;
        }

        // Decode the JSON data
        $data = json_decode($fileContents, true);
        if ($data === null) {
            echo "Erreur : échec du décodage JSON.";
            return null;
        }

        return $data;

    }
    public function load(ObjectManager $manager): void
    {
        $data = $this->loadData('planet.json');

        foreach ($data as $value) {
            $planet = new Planet();
            $planet->setName($value['name']);
            $planet->setDestroyed($value['isDestroyed']);
            $planet->setDescription($value['description']);
            $planet->setImage($value['image']);
            $planet->setDeletedAt($value['deletedAt']);
            $manager->persist($planet);
        }

        $manager->flush();
        echo "Planets created\n";
        $data = $this->loadData('character.json');
        foreach ($data as $value) {
            $character = new Character();
            $character->setName($value['name']);
            $character->setKi($value['ki']);
            $character->setmaxKi($value['maxki']);
            $character->setRace($value['race']);
            $character->setGender($value['gender']);
            $character->setDescription($value['description']);
            $character->setImage($value['image']);
            $character->setAffiliation($value['affiliation']);
            $character->setDeletedAt($value['deletedAt']);
            $idPlanet = $value['originPlanet']['id'];
            $character->setPlanet($value['originPlanet']);
            $character->setTransformation($value['transformations']);
            $manager->persist($character);

        }
        $manager->flush();
        echo "Characters created\n";

    }
}
