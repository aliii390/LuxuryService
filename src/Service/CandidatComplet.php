<?php

namespace App\Service;


use App\Attribute\ProfileCompletion;
use App\Entity\Candidat;
use ReflectionClass;


class CandidatComplet {

    public function calculateCompletion(Candidat $candidat) : int {

        // On crée un réflecteur de la classe $candidat, qui reflète, cad il permet de voir ce qu'il y a dans la classe sans vrm la toucher.
        $reflection = new ReflectionClass($candidat);

        // On récupère toutes les propriétés de la classe 
        $properties = $reflection->getProperties();

        $totalFields = 0;
        $filledCount = 0;


        foreach ($properties as $property) {

            // On récupère l'attribut #[ProfileCompletion]
            $attributes = $property->getAttributes(ProfileCompletion::class);

            // Si la propriété ProfileCompletion existe bien dans notre propriété
            if (!empty($attributes)) {
                $totalFields++;

                // On rend la propriété accessible pour voir ce qui'l y a a l'intérieur
                $property->setAccessible(true);
                $value = $property->getValue($candidat);

                // Si la propriété a quelquechose a l'intérieur. On incrémente filledCount
                if ($value != null) {
                    $filledCount++;
                }
            }
        }

        $completionPercentage = $totalFields > 0 ? round($filledCount / $totalFields * 100) : 0;

        return $completionPercentage;


    }


}






?>