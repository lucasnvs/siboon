<?php

namespace Source\App\Api;

use Exception;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product;
use Source\Response\Code;
use Source\Response\Response;

class Products extends ApiController
{
    public function listProducts()
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $products = (new Product())->find()->fetch(true);
        if (!$products) {
            return Response::success(message: "Nenhum produto encontrado.", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($products as $product) {
            $response[] = $product->data();
        }

        return Response::success($response, code: Code::$OK);
    }

    public function getProduct(array $data)
    {
        $id = $data['id'];
        $product = (new Product())->findById($id);

        if (!$product) {
            return Response::success(message: "Produto não existe.", code: Code::$NO_CONTENT);
        }

        return Response::success($product->data(), code: Code::$OK);
    }

    public function insertProduct(array $data)
    {
        $REQUIRED_FIELDS = ["name", "description", "color", "size", "price_brl", "res_path"];

        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

        $product = new Product();

        $product->name = $request_body["name"];
        $product->description = $request_body["description"];
        $product->color = $request_body["color"];
        $product->size = $request_body["size"];
        $product->price_brl = $request_body["price_brl"];
        $product->res_path = $request_body["res_path"];

        $isCreated = $product->save();

        if(!$isCreated) {
            throw new PDOException($product->fail(), Code::$BAD_REQUEST);
        }

        return Response::success( message: "Produto criado com sucesso.", code: Code::$CREATED);
    }

    public function updateProduct(array $data): void
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $request_body = $this->validateRequestData($data);

        $product = (new Product())->findById($id);
        // todo: issets check
    }


    public function deleteProduct(array $data)
    {
        $id = $data['id'];

        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $product = new Product();

        $isDestroyed = $product->findById($id)->destroy();

        if(!$isDestroyed) {
            throw new PDOException($product->fail(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Produto deletado com sucesso.", code: Code::$NO_CONTENT);
    }
}