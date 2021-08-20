<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ManagerController extends AbstractController
{
    /**
     * @Route("/register", name="manager.registrar")
     */
    public function Register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createFormBuilder()
            ->add('Nombre',TextType::class,['attr'=> [

                'class'=>'form-control placeholder-no-fix'],
                'label'=>'Nombre de registro'

            ])
            ->add('Apellidos',TextType::class)
            ->add('username',TextType::class)
            ->add('Password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'required'=>true,
                'first_options'=>['label'=>'Contraseña'],
                'second_options'=>['label'=>'Repetir contraseña']
            ])
            ->add('enviar',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $user->setUsername($data['username']);
            $user->setPassword($passwordEncoder->encodePassword($user,$data['Password']));
            //creando un cliente
            $client = new ShopClient();
            $client->setName($data['Nombre']);
            $client->setLastName($data['Apellidos']);

            $em->persist($user);
            $em->persist($client);
            $em->flush();
        }

        return $this->render('manager/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/Users",name="usuarios.index")
     * @param UserRepository $userRepository
     * @return Response
     */
    function UserIndex(UserRepository $userRepository){

        $userList = $userRepository->findAll();
        return $this->render('manager/IndexUser.html.twig',[
         'usuarios'=>$userList,

        ]);
    }
}
