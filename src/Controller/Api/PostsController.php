<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Routing\Router;
use App\Controller\AppController;

/**
 * Api/Posts Controller
 *
 */
class PostsController extends AppController
{
    public function initialize(): void
{
    parent::initialize();
    $this->loadModel('Posts');
    $this->loadModel('Images');
}

    public function index()
    {
        $this->request->allowMethod(['get']);
        $posts = $this->Posts->find('all')->toArray();
        $this->set([
            'posts' => $posts,
            '_serialize' => ['posts']
        ]);
    }

    public function show($id = null)
    {
        $this->request->allowMethod(['get']);
        $post = $this->Posts->get($id)->toArray();

        $this->set([
            'post' => $post,
            '_serialize' => ['post']
        ]);
    }

    public function edit($id = null)
{
    $this->request->allowMethod(['put', 'post']);

    $post = $this->Posts->get($id, [
        'contain' => ['Images']
    ]);

    $data = $this->request->getData();

    $post = $this->Posts->patchEntity($post, $data, [
        'associated' => ['Images']
    ]);

    if ($this->Posts->save($post)) {
        $postId = $post->id;
        $imageUrl = null;

        if (!empty($data['images']) && $data['images'] instanceof \Psr\Http\Message\UploadedFileInterface) {
            $imageFile = $data['images'];

            $uploadPath = WWW_ROOT . 'img/uploads/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $imagePath = $uploadPath . time() . '-' . $imageFile->getClientFilename();

            $imageFile->moveTo($imagePath);

            $image = $this->Images->find('all')->where(['post_id' => $postId])->first();
            if ($image) {
                $image->path = 'img/uploads/' . basename($imagePath);
                $image->updated_at = new \DateTime();
            } else {
                $image = $this->Images->newEmptyEntity();
                $imageData = [
                    'path' => 'img/uploads/' . basename($imagePath),
                    'post_id' => $postId,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ];
                $image = $this->Images->patchEntity($image, $imageData);
            }

            if ($this->Images->save($image)) {
                $imageUrl = Router::url('/img/uploads/' . basename($imagePath), true);
            }
        }

        $response = [
            'status' => 'success',
            'data' => $post,
            'image' => [
                'path' => $imageUrl,
                'post_id' => $postId,
                'created_at' => isset($image->created_at) ? $image->created_at : null,
                'updated_at' => isset($image->updated_at) ? $image->updated_at : null,
                'id' => isset($image->id) ? $image->id : null
            ]
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Unable to update post',
            'errors' => $post->getErrors()
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
        $post = $this->Posts->get($id);

        if ($this->Posts->delete($post)) {
            $response = [
                'status' => 'success',
                'message' => 'User deleted'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to delete post'
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

        $post = $this->Posts->newEmptyEntity();

        $post = $this->Posts->patchEntity($post, $data);

        if ($this->Posts->save($post)) {

            $postId = $post->id;
            $imageUrl = null;

            if (!empty($data['images']) && $data['images'] instanceof \Psr\Http\Message\UploadedFileInterface) {
                $imageFile = $data['images'];

                $uploadPath = WWW_ROOT . 'img/uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $imagePath = $uploadPath . time() . '-' . $imageFile->getClientFilename();
                $imageFile->moveTo($imagePath);

                $image = $this->Images->newEmptyEntity();
                $imageData = [
                    'path' => 'img/uploads/' . basename($imagePath),
                    'post_id' => $postId,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ];
                $image = $this->Images->patchEntity($image, $imageData);

                if ($this->Images->save($image)) {

                    $imageUrl = Router::url('/img/uploads/' . basename($imagePath), true);
                }
            }

            $response = [
                'status' => 'success',
                'data' => $post,
                'image' => [
                'path' => $imageUrl,
                'post_id' => $postId,
                'created_at' => $image->created_at,
                'updated_at' => $image->updated_at,
                'id' => $image->id
            ]
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to add post',
                'errors' => $post->getErrors()
            ];
        }

        $this->set([
            'response' => $response,
            '_serialize' => ['response']
        ]);
    }



}
