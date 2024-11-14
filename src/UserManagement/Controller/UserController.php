<?php
namespace App\UserManagement\Controller;

use App\UserManagement\Service\UserService;
use App\UserManagement\DTO\SaveUserDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $userDTO = new SaveUserDto($data['name'], $data['role'], $data['companyId']);

        try {
            $user = $this->userService->createUser($userDTO);
            return new JsonResponse(['id' => $user->getId()], 201);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
