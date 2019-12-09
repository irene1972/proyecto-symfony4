<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegisterType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    public function register( Request $request, UserPasswordEncoderInterface $encoder )
    {
        //Creamos el form
        $user = new User();
        $form = $this->createForm( RegisterType::class, $user );
        
        //viculamos el formulario con el objeto. Rellenamos el objeto con los datos del form
        $form->handleRequest( $request );
        
        //Comprobar si el form se ha enviado
        if( $form->isSubmitted() && $form->isValid() ){

            //Modificamos el objeto para guardarlo
            $user->setRole('ROLE_USER');

            //Ciframos la contraseña
            $encoded = $encoder->encodePassword( $user, $user->getPassword() );
            $user->setPassword( $encoded );

            var_dump($user);

        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
