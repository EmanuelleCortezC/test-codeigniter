<?php

namespace App\Controllers\API;

use App\Models\CustomersModel;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

use Exception;

class CustomersController extends ResourceController
{
    private $customersModel;

    public function __construct()
    {
        $this->customersModel = new CustomersModel();
    }

    public function index()
    {
        $customers = $this->customersModel->findAll();

        return $this->respond($customers, 200);
    }

    public function show($id = null)
    {
        $data = $this->customersModel->getWhere(['id' => $id])->getResult();

        if($data){
            return $this->respond($data);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com id '.$id);        
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if($this->customersModel->insert($data)){
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Cliente salvo com sucesso'
                ]
            ];
            return $this->respondCreated($response);
        }

        return $this->fail($this->customersModel->errors());
    }

    
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        
        if($this->customersModel->update($id, $data)){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Cliente atualizado com sucesso'
                    ]
                ];
                return $this->respond($response);
            };

        return $this->fail($this->customersModel->errors());
    }
     
    public function delete($id = null)
    {
        $data = $this->customersModel->find($id);
        
        if($data){
            $this->customersModel->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Cliente removido com sucesso'
                ]
            ];
            return $this->respondDeleted($response);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com id '.$id);        
    }

}
