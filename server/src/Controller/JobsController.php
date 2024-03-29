<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 *
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(["queryJobs"]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['JobCategories']
        ];
        $jobs = $this->paginate($this->Jobs);

        $this->set(compact('jobs'));
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['JobCategories', 'Skills', 'Applies', 'Favorites', 'JobDetails']
        ]);

        $this->set('job', $job);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $job = $this->Jobs->newEntity();
        if ($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $jobCategories = $this->Jobs->JobCategories->find('list', ['limit' => 200]);
        $skills = $this->Jobs->Skills->find('list', ['limit' => 200]);
        $this->set(compact('job', 'jobCategories', 'skills'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Skills']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $jobCategories = $this->Jobs->JobCategories->find('list', ['limit' => 200]);
        $skills = $this->Jobs->Skills->find('list', ['limit' => 200]);
        $this->set(compact('job', 'jobCategories', 'skills'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);
        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function queryJobs() {
        $this->autoRender = false;
        $params = $this->request->getQueryParams();
        $arg = [];

        $user = $this->Auth->user();

        // skill parameters
        $skills = [];
        foreach (["language", "role", "skill", "condition", "design", "sales"] as $key) {
            if (!isset($params[$key])) continue;
            $skills[$key] = explode(",", $params[$key]);
        }
        if (count($skills) > 0) $arg["skill"] = $skills;

        // area parameters
        if (isset($params["area"])) $arg["area"] = $params["area"];

        // salary parameter
        if (isset($params["salary"])) $arg["salary"] = $params["salary"];

        // free word
        if (isset($params["word"])) {
            $arg["word"] = preg_split("/\s/", mb_convert_kana($params["word"], "s"), null, PREG_SPLIT_NO_EMPTY);
        }

        return $this->response
            ->withType("application/json")
            ->withStringBody(json_encode($this->Jobs->queryJobs($arg, $user), JSON_UNESCAPED_UNICODE));
    }
}
