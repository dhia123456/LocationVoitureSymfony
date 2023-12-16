<?php

namespace App\Controller;
use App\Form\VoitureType;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class VoitureController extends AbstractController
{
    #[Route('/listvoiture', name: 'listv')]
    public function listvoiture(VoitureRepository $vr)
    {

        $voitures = $vr->findAll();

        return $this->render("voiture/listVoiture.html.twig", ["listvoiture" => $voitures]);

    }

    #[Route('/addVoiture', name: 'addVoiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em)
    {

        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute(route: "listv");
        }


        return $this->render("voiture/addVoiture.html.twig", ["FormVoiture" => $form->createView()]);

    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete(VoitureRepository $vr, EntityManagerInterface $em, $id): Response
    {

        $voiture = $vr->find($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute(route: "listv");

    }

    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function updateVoiture(Request $request, EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {

        $voiture = $vr->find($id);
        $editform = $this->createForm(VoitureType::class, $voiture);
        $editform->handleRequest($request);
        if ($editform->isSubmitted() and $editform->isValid()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute(route: "listv");
        }


        return $this->render("voiture/updateVoiture.html.twig", ["editFormVoiture" => $editform->createView()]);

    }

    #[Route('/searchVoiture', name: 'voitureSearch')]
    public function searchVoiture(Request $request, EntityManagerInterface $em): Response
    {
        $voitures = null;
        if ($request->isMethod(method: 'POST')) {
            $serie = $request->request->get(key: "input_serie");
            $query = $em->createQuery(
                dql: "SELECT v FROM App\Entity\Voiture v
                  where v.serie LIKE '" . $serie . "'");
            $voitures = $query->getResult();
        }
        return $this->render( "voiture/rechercheVoiture.html.twig",
            ["voitures" => $voitures]);
    }
}


