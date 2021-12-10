<?php

namespace App\Controller;

use App\Entity\Accident;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Detailaccident;
use App\Form\AccidentType;
use App\Form\DetailaccidentType;
use App\Repository\AccidentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator

use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * @Route("/accident")
 */
class AccidentController extends AbstractController
{
    /**
     * @Route("/", name="accident_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Accident::class)->findAll();

        $accidentRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4// Nombre de résultats par page
        );
        return $this->render('accident/index.html.twig', [
            'accident' => $accidentRepository,
/*
            ImageField::new('imageFile')
                ->onlyOnIndex()
                ->setBasePath($this->getParameter("app.path.accident_images"))
*/

        ]);
    }



    /**
     * @Route("/newDetailaccident", name="new_detail")
     * Method({"GET", "POST"})
     */
    public function newDetailaccident(Request $request) {
        $detail = new Detailaccident();
        $form = $this->createForm(DetailaccidentType::class,$detail);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detail);
            $entityManager->flush();
        }
        return $this->render('accident/newdetail.html.twig',['form'=>
            $form->createView()]);
    }
    /**
     * @Route("/new", name="accident_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accident = new Accident();
        $form = $this->createForm(AccidentType::class, $accident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accident);
            $entityManager->flush();

            return $this->redirectToRoute('accident_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accident/new.html.twig', [
            'accident' => $accident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accident_show", methods={"GET"})
     */

    public function show(Detailaccident  $accident): Response
    {
        return $this->render('accident/showdetail.html.twig', [
            'detailaccident' => $accident,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accident_edit", methods={"GET", "POST"})

     */
    public function edit(Request $request, Accident $accident, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccidentType::class, $accident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('accident_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accident/edit.html.twig', [
            'accident' => $accident,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("detailaccident/{}/editdet", name="accident_editdet", methods={"GET", "POST"})
      *@ParamConverter("id",class="Detailaccident",options={"id": "id"})
     */
    public function editdet(Request $request, Detailaccident $detailaccident, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailaccidentType::class, $detailaccident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('accident_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accident/editdetail.html.twig', [
            'detailaccident' => $detailaccident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accident_delete", methods={"POST"})
     */
    public function delete(Request $request, Accident $accident, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accident->getId(), $request->request->get('_token'))) {
            $entityManager->remove($accident);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accident_index', [], Response::HTTP_SEE_OTHER);
    }
    /*
    public function configureFields(string $pageName):iterable{
        return [

            DateField::new('Date_accident'),
            NumberField::new('Cin_assureur1'),
            TextField::new('Cin_assureur2'),
            TextFiled::new('Emplacement'),
            TextFiled::new('Matricule'),
            ImageField::new('image')
            ->onlyOnIndex()
            ->setBasePath($this->getParameter("app.path.accident_images")),


            ];
    }*/

    /**
     * @Route("/recherche ", name="recherche",methods={"GET","POST"} )
     */
    public function recherche(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $accident=$em->getRepository(Accident::class)->findAll();
        if ($request->isMethod("POST"))
        {
         $cin2=$request->get('cin_assureur2');
         $accident=$em->getRepository("AccidentController:Accident")->findBy(array('cin_assureur2'=>cin_assureur2));

        }
        return $this->render('accident/recherche.html.twig',array('cin_assureur2'=>cin_assureur2)
            );

    }


}
