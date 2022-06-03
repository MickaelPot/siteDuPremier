<?php

namespace App\DTO;



use App\Entity\Formation;
use App\Repository\FormationRepository;
use App\Repository\LangageRepository;
use function Sodium\add;

class SearchDto
{
    public function getSearch(string $search, LangageRepository $langRep, FormationRepository $formRep)
    {
        $qbl = $langRep->createQueryBuilder('o');
        $qbf = $formRep->createQueryBuilder('y');
        $l = null;
        $f=null;
        

        $results = $qbl ->select('l')
            ->from('App\Entity\Langage', 'l')
            ->where($qbl->expr()->like('l.nom',':search'))
            ->setParameter('search', '%' .$search.'%')
            ->getQuery()
            ->getResult();

            $i=0;


        foreach($results as $result){

            $l[$i]['nomLangage'] = $result->getNom();
            $l[$i]['idLangage'] = $result->getId();
            $i++; 
        }

        /*SELECT formation.titre, langage.nom
        FROM formation, langage
        WHERE langage.id=formation.langage_id AND
        formation.titre  LIKE :rechercheFormation OR
        langage.nom  LIKE :rechercheFormation";*/

        $results = $qbf ->select('f')
            ->from('App\Entity\Formation', 'f')
            ->join('App\Entity\Langage', 'c')
            ->where($qbf->expr()->andX("c.id = f.langage"),
                $qbf->expr()->orX($qbf->expr()->like('f.titre',':search'),$qbf->expr()->like('c.nom',':search')))
            ->setParameter('search', $search.'%')
            ->getQuery()
            ->getResult();


        $j=0;
        foreach($results as $result){
            $f[$j]['idFormation'] = $result->getId();
            $f[$j]['titreFormation'] = $result->getTitre();
            $j++;
        }
        return [$l,$f];
    }
}