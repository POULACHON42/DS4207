<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="app_security")
     */
    public function index(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
   

    /**
	* @Route("/traitement", name="traitement")
	*/

    public function forget(Request $request) : Response
	{
        $nom = $request->request->get("username");
        $mdp = $request->request->get("password");

        if($nom=="root" && $mdp=="toor")
        $message="Vos identifiants sont corrects !";
        if($nom==NULL)
          $message="Utilisateur inconnu";
        else
            $message="Il ne s'agit pas du bon identifiant ou mot de passe";
        
        return $this->render('security/verification.html.twig', [
            'titre' => 'confirmation',
            'login' => $nom,
            'pass' => $mdp,
            'ms' => $message,
        ]);
    }

    /**
	* @Route("/deco", name="deco")
	*/
    public function deconnexion(Request $request, EntityManagerInterface $manager, SessionInterface $session): Response
    {
        $session -> set('numero', 0);
        $session -> clear();

    return $this->render('security/login.html.twig');
    
    }
}