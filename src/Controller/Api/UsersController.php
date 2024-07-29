<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{

    public function index()
    {
        $this->request->allowMethod(['get']);
        $users = $this->Users->find('all')->toArray();
        $this->set([
            'users' => $users,
            '_serialize' => ['users']
        ]);
    }

    public function show($id = null)
    {
        $this->request->allowMethod(['get']);
        $user = $this->Users->get($id)->toArray();

        $this->set([
            'user' => $user,
            '_serialize' => ['user']
        ]);
    }

    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'put']);
        $user = $this->Users->get($id);
        $data = $this->request->getData();


        Log::info('Data received for update:', $data);
        $user = $this->Users->patchEntity($user, $data);
        Log::info('User entity after patch:', $user->toArray());

        if ($this->Users->save($user)) {
            $response = [
                'status' => 'success',
                'data' => $user
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to update user',
                'errors' => $user->getErrors()
            ];
        }

        $this->set([
            'response' => $response,
            '_serialize' => ['response']
        ]);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $response = [
                'status' => 'success',
                'message' => 'User deleted'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to delete user'
            ];
        }

        $this->set([
            'response' => $response,
            '_serialize' => ['response']
        ]);
    }

    public function store()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        $user = $this->Users->newEmptyEntity();
        $user = $this->Users->patchEntity($user, $data);
        if ($this->Users->save($user)) {
            $response = [
                'status' => 'success',
                'data' => $user
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to add user',
                'errors' => $user->getErrors()
            ];
        }

        $this->set([
            'response' => $response,
            '_serialize' => ['response']
        ]);
    }
}
