<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Routing\Router;

/**
 * Home Controller
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Posts');
        $this->loadModel('Images');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->request->allowMethod(['get']);


        $posts = $this->Posts->find('all')
            ->contain('Images')
            ->toArray();

        $this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [
                'Images',
            ],
        ]);

        $this->set(compact('post'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $post = $this->Posts->newEmptyEntity();
    if ($this->request->is('post')) {
        $data = $this->request->getData();
        $post = $this->Posts->patchEntity($post, $data, ['validate' => true]);

        $post->updated_at = new \DateTime();

        if ($this->Posts->save($post)) {
            $postId = $post->id;
            $imageUrl = null;


            if (!empty($data['image']) && $data['image'] instanceof \Psr\Http\Message\UploadedFileInterface) {
                $imageFile = $data['image'];


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
                    'created_at' => $image->created_at ?? null,
                    'updated_at' => $image->updated_at ?? null,
                    'id' => $image->id ?? null
                ]
            ];

            $this->Flash->success(__('The post has been saved.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to add post',
                'errors' => $post->getErrors()
            ];

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $this->set([
            'response' => $response,
            '_serialize' => ['response']
        ]);
    }

    $this->set(compact('post'));
}


    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
