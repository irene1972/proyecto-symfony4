<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Task;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public function index()
    {
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
