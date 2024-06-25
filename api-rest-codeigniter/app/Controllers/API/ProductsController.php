<?php

namespace App\Controllers\API;

use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ProductsController extends ResourceController
{
    private $productsModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
    }
    public function index()
    {
        $products = $this->productsModel->findAll();

        return $this->respond($products, 200);
    }

    public function show($id = null)
    {
        $data = $this->productsModel->getWhere(['id' => $id])->getResult();

        if($data){
            return $this->respond($data);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com este id '.$id);        
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if($this->productsModel->insert($data)){
            $response = [
                'status'   => 201,
                'mensagem' => 'Produto salvo com sucesso',
                'retorno' => $data
            ];
            return $this->respondCreated($response);
        }

        return $this->fail($this->productsModel->errors());
    }

    
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        
        if($this->productsModel->update($id, $data)){
            $response = [
                'status'   => 200,
                'mensagem' => 'Produto atualizado com sucesso',
                'retorno' => $data
            ];
                return $this->respond($response);
            };

        return $this->fail($this->productsModel->errors());
    }
     
    public function delete($id = null)
    {
        $data = $this->productsModel->find($id);
        
        if($data){
            $this->productsModel->delete($id);
            $response = [
                'status'   => 200,
                'mensagem' => 'Produto removido com sucesso',
                'retorno' => $data
            ];
            return $this->respondDeleted($response);
        }
        
        return $this->failNotFound('Nenhum dado encontrado com este id '.$id);        
    }
}