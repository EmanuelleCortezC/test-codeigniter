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
                'mensagem' => 'Cliente salvo com sucesso',
                'retorno' => $data
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
                'mensagem' => 'Cliente atualizado com sucesso',
                'retorno' => $data
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
                'mensagem' => 'Cliente removido com sucesso',
                'retorno' => $data
            ];
            return $this->respondDeleted($response);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com id '.$id);        
    }

}
