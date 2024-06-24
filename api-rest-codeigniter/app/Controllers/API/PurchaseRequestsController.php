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
        //
    }
}
