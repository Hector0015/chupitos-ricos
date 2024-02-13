<?php

namespace App\Controller;
use App\Entity\Combinaciones2;
use App\Form\Combinaciones2FormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'chupitos')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/chupitos/add', name:'add_chupito')]
    public function nuevo(ManagerRegistry $doctrine, Request $request){
        $combinacion = new Combinaciones2();

        $formulario = $this->createForm(Combinaciones2FormType::class, $combinacion);

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $pokemon = $formulario->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($pokemon);
            $entityManager->flush();
            return $this->redirectToRoute('chupitos');
        }
        return $this->render('nuevo.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }


    #[Route('/chupitos/edit/{nombre}', name:'edit_chupito')]
    public function editar(ManagerRegistry $doctrine, Request $request, $nombre) {
        $repositorio = $doctrine->getRepository(Combinaciones2::class);

        $combinacion = $repositorio->findOneBy(["nombre" => $nombre]);

        if($combinacion){
            $formulario = $this->createForm(Combinaciones2FormType::class, $combinacion);

            $formulario->handleRequest($request);

            if($formulario->isSubmitted() && $formulario->isValid()) {
                $combinacion = $formulario->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($combinacion);
                $entityManager->flush();
                return $this->redirectToRoute('chupitos');

            }
            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
            ));
        }else{
            return $this->redirectToRoute('chupitos');

        }
    }

    #[Route('/chupitos/delete/{nombre}', name:'delete_chupitos')]
    public function delete(ManagerRegistry $doctrine, $nombre): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Combinaciones2::class);
        $combinacion = $repositorio->findOneBy(["nombre" => $nombre]);
        if($combinacion){
            try{
                $entityManager->remove($combinacion);
                $entityManager->flush();
                return new Response("Chupito eliminado");
            return $this->redirectToRoute('chupitos');

            }catch (\Exception $e) {
                return new Response("Error eliminando objeto");
            return $this->redirectToRoute('chupitos');

            }
        }else
        return $this->redirectToRoute('chupitos');

    }

    #[Route('/chupitos/{nombre}', name:"ficha_chupitos")]
    public function ficha(ManagerRegistry $doctrine, $nombre): Response{
        $repositorio = $doctrine->getRepository(Combinaciones2::class);
        $resultado = $repositorio->findOneBy(["nombre" => $nombre]);
 
        return $this->render('ficha_chupitos.html.twig', [
        'chupitos' => $resultado
        ]);
        
    }
}
