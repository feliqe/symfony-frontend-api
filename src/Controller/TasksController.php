<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Form\TaskType; // Si tienes un formulario
use App\Form\TasksFormType;

final class TasksController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    #[Route('/', name: 'crud_show')]
    public function show(): Response
    {
        // Obtener datos desde la API
        $data = file_get_contents('http://127.0.0.1:8000/tasks/view');
        $tasks = json_decode($data, true);

        // Renderizar la vista con los datos obtenidos
        return $this->render('tasks/show.html.twig', [
            'tasks' => $tasks,
        ]);

        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/edit/{id}', name: 'crud_edit')]
    public function edit($id): Response
    {
        // Realizar la solicitud a la API
        $response = $this->client->request('GET', 'http://127.0.0.1:8000/tasks/view/' . $id);
        $taskData = $response->toArray();

        // Convertir fechaexpiracion a texto si es un array
        if (isset($taskData['fechaexpiracion']) && is_array($taskData['fechaexpiracion'])) {
            $taskData['fechaexpiracion'] = $taskData['fechaexpiracion']['date'];
        }

        // Crear el formulario con los datos obtenidos
        $form = $this->createForm(TaskType::class, $taskData);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar los cambios en la base de datos o enviar a la API
            // ...

            return $this->redirectToRoute('crud_show');
        }

        // Renderizar la vista con el formulario
        return $this->render('tasks/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/tasks/delete/{id}', name: 'crud_delete', methods: ['DELETE', 'GET'])]
    public function delete(int $id): Response
    {
        try {
            $response = $this->client->request('DELETE', 'http://127.0.0.1:8000/tasks/delete/' . $id);

            if ($response->getStatusCode() === 200) {
                $this->addFlash('success', 'Registro eliminado correctamente.');
            } else {
                $this->addFlash('error', 'Error al eliminar el registro.');
            }
        } catch (\Exception $e) {
            $this->addFlash('error', 'Ocurrió un error al conectar con la API.');
        }

        return $this->redirectToRoute('crud_show');
    }



    #[Route('/tasks/register', name: 'crud_register')]
    public function showRegisterForm(): Response
    {
        $form = $this->createForm(TasksFormType::class);

        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tasks/add1', name: 'crud_add', methods: ['POST'])]
    public function addTask(Request $request, HttpClientInterface $httpClient): Response
    {
        $form = $this->createForm(TasksFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskData = $form->getData();

            try {
                $response = $httpClient->request('POST', 'http://127.0.0.1:8000/tasks/crear', [
                    'json' => $taskData,
                ]);

                if ($response->getStatusCode() === 201) {
                    $this->addFlash('success', 'Tarea creada con éxito');
                    return $this->redirectToRoute('crud_show');
                } else {
                    $this->addFlash('error', 'Error al crear la tarea');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error de conexión con la API: ' . $e->getMessage());
            }
        } else {
            $this->addFlash('error', 'Formulario inválido.');
        }

        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tasks/update/{id}', name: 'crud_update')]
    public function update(int $id, Request $request): Response
    {
        $form = $this->createForm(TaskType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();

            try {
                $response = $this->client->request('PUT', 'http://127.0.0.1:8000/tasks/update/' . $id, [
                    'json' => $userData,
                ]);

                if ($response->getStatusCode() === 200) {
                    $this->addFlash('success', 'Usuario actualizado correctamente.');
                    return $this->redirectToRoute('crud_show');
                } else {
                    $this->addFlash('error', 'Ocurrió un error al actualizar el usuario.');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ocurrió un error al actualizar el usuario.');
            }
        }

        return $this->render('tasks/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
