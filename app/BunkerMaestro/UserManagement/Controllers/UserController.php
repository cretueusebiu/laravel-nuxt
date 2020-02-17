<?php


namespace App\BunkerMaestro\UserManagement\Controllers;


use App\BunkerMaestro\UserManagement\Actions\GetUsersList;
use App\BunkerMaestro\UserManagement\Transformers\UserTransformer;
use App\Http\Controllers\Controller;
use App\User;
use Dingo\Api\Routing\Helpers;
use Dingo\Blueprint\Annotation\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @package App\BunkerMaestro\UserManagement\Controllers
 *
 * User resource representation.
 * @Resource("Users")
 */
class UserController extends Controller
{

    use Helpers;
    /**
     * Gets the list of all the users
     * @return JsonResponse
     */
    public function index(GetUsersList $getUsersAction): Response
    {
        $page = (int)request()->input('page', 1);
        $users = $getUsersAction->handle($page);
        return $this->response->paginator($users, new UserTransformer(), ['key' => 'users']);
    }
}
