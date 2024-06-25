<?php

namespace App\Controllers\API;

use App\Models\PurchaseRequestsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PurchaseRequestsController extends ResourceController
{
    private $purchaseRequestsModel;

    public function __construct()
    {
        $this->purchaseRequestsModel = new PurchaseRequestsModel();
    }
    public function index()
    {
        $purchaseRequests = $this->purchaseRequestsModel->findAll();

        return $this->respond($purchaseRequests, 200);
    }

    public function show($id = null)
    {
        $data = $this->purchaseRequestsModel->getWhere(['id' => $id])->getResult();

        if($data){
            return $this->respond($data);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com id '.$id);        
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if($this->purchaseRequestsModel->insert($data)){
            $response = [
                'status'   => 201,
                'mensagem' => 'Pedido salvo com sucesso',
                'retorno' => $data
            ];
            return $this->respondCreated($response);
        }

        return $this->fail($this->purchaseRequestsModel->errors());
    }

    
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        
        if($this->purchaseRequestsModel->update($id, $data)){
            $response = [
                'status'   => 200,
                'mensagem' => 'Pedido atualizado com sucesso',
                'retorno' => $data
            ];
                return $this->respond($response);
            };

        return $this->fail($this->purchaseRequestsModel->errors());
    }
     
    public function delete($id = null)
    {
        $data = $this->purchaseRequestsModel->find($id);
        
        if($data){
            $this->purchaseRequestsModel->delete($id);
            $response = [
                'status'   => 201,
                'mensagem' => 'Pedido removido com sucesso',
                'retorno' => $data
            ];
            return $this->respondDeleted($response);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com id '.$id);        
    }

}
