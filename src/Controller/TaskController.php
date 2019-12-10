<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Task;
use App\Form\TaskType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\User\UserInterface;

class TaskController extends AbstractController
{
    public function index()
    {
        // Listado de todas las tareas
        $doctrine = $this->getDoctrine();
        $task_repository = $doctrine->getRepository(Task::class);
        //$tasks = $task_repository->findAll();
        $tasks = $task_repository->findBy( [], ['id' => 'DESC'] );

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    // Seems that not works but IT WORKS!!
    public function detail( Task $task ){
        if( !$task ){
            return $this->redirectToRoute('tasks');
        }

        return $this->render( 'task/detail.html.twig', [
            'task' => $task
        ]);
    }

    // Another solution
    // public function detail( $id ){

    //     $doctrine = $this->getDoctrine();
    //     $task_repository = $doctrine->getRepository(Task::class);
    //     $task = $task_repository->find($id);
        
    //     if( !$task ){
    //         return $this->redirectToRoute('tasks');
    //     }

    //     return $this->render( 'task/detail.html.twig', [
    //         'id' => $id,
    //         'task' => $task,
    //         'user_' => $task->getUser(),
    //         'email_' => $task->getUser()->getEmail()
    //     ]);
    // }

    public function creation( Request $request, UserInterface $user_loged ){

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ){

            $task->setCreatedAt(new \DateTime('now'));
            $task->setUser($user_loged);
            
            //var_dump($task);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            // $session = new Session();
            // $session->getFlashBag()->add('message', 'Tarea creada');

            return $this->redirect( 
                $this->generateUrl('task_detail', [
                    'id' => $task->getId()
                ]) 
            );

        }

        return $this->render('task/creation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function myTasks( UserInterface $user_loged ){
        $tasks = $user_loged->getTasks();

        return $this->render('task/my-tasks.html.twig', [
            'tasks' => $tasks
        ]);
    }

    public function edit( Request $request, UserInterface $user_loged, Task $task ){

        //var_dump($task);
        if( !$user_loged || $user_loged->getId() != $task->getUser()->getId() )
            return $this->redirectToRoute('tasks');

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ){

            //$task->setCreatedAt(new \DateTime('now'));
            //$task->setUser($user_loged);
            
            //var_dump($task);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect( 
                $this->generateUrl('task_detail', [
                    'id' => $task->getId()
                ]) 
            );

        }

        return $this->render('task/creation.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    public function delete( UserInterface $user_loged, Task $task ){

        if( !$user_loged || $user_loged->getId() != $task->getUser()->getId() )
            return $this->redirectToRoute('tasks');
        
        if( !$task )
            return $this->redirectToRoute('tasks');

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('tasks');
        
    }

    public function irene_test_relation_user_task(){

                // Prueba de Entidades y Relaciones (mostramos todas las tareas)
                $doctrine = $this->getDoctrine();
                $task_repository = $doctrine->getRepository(Task::class);
                $tasks = $task_repository->findAll();
        
                foreach( $tasks as $task ){
                    echo $task->getUser()->getEmail() . ': ' . $task->getTitle() . '<br>';
                }
        
                return $this->render('task/index.html.twig', [
                    'controller_name' => 'TaskController',
                    'tasks' => $tasks
                ]);
    }

    public function irene_test2_relation_user_task(){

        // Prueba de Entidades y Relaciones (mostramos todos los usuarios y las tareas de cada uno)
        $doctrine = $this->getDoctrine();
        $user_repository = $doctrine->getRepository(User::class);
        $users = $user_repository->findAll();

        foreach( $users as $user ){
            //echo $user->getName() . ' - ' . $user->getSurname() . '<br>';
            echo "<h1>{$user->getName()}{$user->getSurname()}</h1>";

            foreach( $user->getTasks() as $task ){
                echo $task->getUser()->getEmail() . ': ' . $task->getTitle() . '<br>';
            }
        }

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController'
        ]);
}
}
