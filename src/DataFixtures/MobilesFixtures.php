<?php

namespace App\DataFixtures;

use App\Entity\Mobile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class MobilesFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $mobiles = [
            [
                'name' => 'OnePlus 7',
                'screen' => 'AMOLED de 6,41 pouces Définition de lécran    2340 x 1080 px',
                'design' => 'Largeur    7.48 cm Hauteur 15.77 cm Epaisseur   0.82
                cm Volume (cm3)    96.72 cm3 Poids   182 g',
                'colour' => 'Blanc, noir et gris',
                'android' => 'Android 9',
                'processor' => 'processeur Snapdragon 855 et 2.84 GHz',
                'ram' => '8 Go de mémoire vive ',
                'camera' => ' Il dispose d’un double module caméra (48 et 5 Mpix).',
                'storage' => '256 Go de stockage',
                'drums' => 'Batterie amovible   Non
                Capacité de la batterie 3700 mAh Recharge sans-fil   Non',
                'simCard' => 'Oui double sim',
                'compatibility' => '3G, 4G et 4G+',
                'sav' => 'Très compétent.'
            ],
            [
                'name' => 'Samsung Galaxy S10',
                'screen' => 'Taille de l écran 6.1 pouces. Définition 3040 x 1440 pixels. .. AMOLED.',
                'design' => 'Largeur 7.04 cm Hauteur 14.99 cm Epaisseur 0.78 cmVolume (cm3) 82.31 cm3 Poids 158 g',
                'colour' => 'blanc ou noir',
                'android' => 'Système d exploitation Android. Système d exploitation (OS) ',
                'processor' => 'Processeur Exynos 9820.',
                'ram' => 'RAM 8 Go.',
                'camera' => 'Caméra 12 Mp',
                'storage' => 'Mémoire 128 Go, 512 Go.',
                'drums' => 'Capacité 3400 mAh. Capacité de la batterie.',
                'simCard' => 'double sim',
                'compatibility' => '3G, 4G et 4G+',
                'sav' => 'Traite les demandes rapidement'
            ],
            [
                'name' => 'iPhone 11 pro',
                'screen' => 'Taille (diagonale) 5.8 Technologie de l écran  OLED
                Définition de l écran   2436 x 1125 px
                Résolution de l écran   463 ppp',
                'design' => 'Dimensions et poids2, Largeur:75,7 mm, Hauteur:150,9 mm Épaisseur :8,3 mm, Poids : 194 g',
                'colour' => 'Noir, vert, jaune, mauve, (PRODUCT)RED et blanc',
                'android' => 'iOS 13',
                'processor' => 'Apple A13 Bionic',
                'ram' => '8',
                'camera' => 'Capteur photo principal 12 Mpx
                Deuxième capteur photo  12 Mpx
                Troisième capteur photo 12 Mpx',
                'storage' => '64 Go, 128 Go, 256 Go',
                'drums' => 'Jusqu’à 1 heure d’autonomie de plus que l’iPhone XR Lecture vidéo :Jusqu’à 17 heures Streaming vidéo',
                'simCard' => 'Puce A13 Bionic Neural Engine troisième génération, Double SIM (nano‑SIM et eSIM)11
                    L’iPhone 11 n’est pas compatible avec les cartes micro-SIM existantes.',
                'compatibility' => '3G ou 4G',
                'sav' => 'Impeccable'
            ],
            [
                'name' => 'Huawei P30 Lite',
                'screen' => 'Taille (diagonale) 6.15 Technologie de l écran  LTPS Définition de l écran   2312 x 1080 px Résolution de l écran  415 ppp',
                'design' => 'Largeur 7.27 cm Hauteur 15.29 cm Epaisseur   0.74 cm Volume (cm3)    82.25 cm3 Poids   162 g',
                'colour' => 'Blanc ou gris',
                'android' => 'Android 9',
                'processor' => 'Kirin 710 Fréquence processeur  2.2 GHz',
                'ram' => '4 Go de RAM ',
                'camera' => 'Capteur photo principal 48 Mpx Deuxième capteur photo  8 Mpx Troisième capteur photo 2 Mpx Capteur ToF Non Flash   Oui
                 Enregistrement vidéo (principal)',
                'storage' => '128 Go de stockage interne extensible par Micro SD',
                'drums' => 'Batterie amovible Non Capacité de la batterie 3340 mAh
                 Recharge sans-fil   Non',
                'simCard' => 'Type de cartes supportées    microSD, microSDHC, microSDXC, Double SIM   Oui',
                'compatibility' => 'Compatible réseau 4G (LTE)  Oui',
                'sav' => 'moyen'
            ],
            [
                'name' => 'Samsung Galaxy A50',
                'screen' => 'Taille (diagonale) 6.4 Technologie de l écran  Super AMOLED Définition de l écran   2340 x 1080 pxRésolution de l écran   403 ppp',
                'design' => 'Largeur 7.47 cm, Hauteur 15.85 cm, Epaisseur 0.77 cm Volume (cm3) 91.22 cm3 Poids 166 g',
                'colour' => 'Pink Floyd',
                'android' => 'Android 9',
                'processor' => 'Samsung Exynos 9610, fréquence 2.3 GHz',
                'ram' => '4 Go',
                'camera' => 'Capteur photo principal 25 Mpx Deuxième capteur photo  5 Mpx Troisième capteur photo 8 Mpx Capteur ToF Non Flash Oui Enregistrement vidéo (principal) 2336 x 1080 px Capteur en façade',
                'storage' => 'Capacité  128 Go, Mémoire flash Libre 107 Go',
                'drums' => 'Batterie amovible Non Capacité de la batterie 4000 mAh Recharge sans-fil Non',
                'simCard' => 'Type de cartes supportées microSD, microSDHC, microSDXC, Double SIM Oui',
                'compatibility' => 'SCompatible réseau 4G (LTE) Oui',
                'sav' => 'correcte'
            ],
            [
                'name' => 'Motorola Moto G7 Plus',
                'screen' => 'Taille (diagonale) 6.2 Technologie de l écran  LCD Définition de l écran 2270 x 1080 px Résolution de l écran 405 ppp',
                'design' => 'Largeur 7.55 cm Hauteur 15.7 cm Epaisseur 0.82 cm Volume (cm3) 97.19 cm3 Poids 178 g',
                'colour' => 'Blanc ou gris',
                'android' => 'Android 9',
                'processor' => 'Qualcomm Snapdragon 636 Fréquence processeur 1.8 GHz',
                'ram' => '4 Go',
                'camera' => 'Capteur photo principal 16 Mpx Deuxième capteur photo  5 Mpx Flash Oui Enregistrement vidéo (principal)',
                'storage' => 'Capacité 64 Go Mémoire flash Libre 48.7 Go',
                'drums' => 'Batterie amovible Non Capacité de la batterie 3000 mAh',
                'simCard' => 'Double SIM Non',
                'compatibility' => 'Bandes GSM  850 MHz, 900 MHz, 1800 MHz, 1900 MHz Mhz Débit max. en réception 3G  42 Mbit/s Compatible réseau 4G (LTE)  Oui',
                'sav' => 'moyen'
            ],
        ];

        foreach ($mobiles as $data) {
            $mobile = new Mobile();
            $mobile ->setName($data['name'])
                    ->setScreen($data['screen'])
                    ->setDesign($data['design'])
                    ->setColour($data['colour'])
                    ->setAndroid($data['android'])
                    ->setProcessor($data['processor'])
                    ->setRam($data['ram'])
                    ->setCamera($data['camera'])
                    ->setStorage($data['storage'])
                    ->setDrums($data['drums'])
                    ->setSimCard($data['simCard'])
                    ->setCompatibility($data['compatibility'])
                    ->setSav($data['sav']);

            $manager->persist($mobile);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['mobiles'];
    }
}