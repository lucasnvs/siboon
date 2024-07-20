<?php

namespace Source\App\Api;

use Exception;
use Source\Models\Product;

class Products extends Api
{
    public function listProducts(): void
    {
        try {
            $products = (new Product())->find()->fetch(true);
            if(!$products) {
                $this->back(["type" => "success", "message" => "Nenhum produto encontrado."], Code::$NO_CONTENT);
                return;
            }

            $response = [];
            foreach ($products as $product) {
                $response[] = $product->data();
            }

            $this->back($response, Code::$OK);
        } catch (Exception $e) {
            $this->back([
                "type" => "error",
                "message" => $e->getMessage()
            ], Code::$INTERNAL_SERVER_ERROR);
        }
    }

    public function getProduct(array $data): void
    {
        $id = $data['id'];
        try {
            $product = (new Product())->findById($id);
            if (!$product) {
                $this->back(["message" => "Produto com id $id não encontrado."], Code::$NOT_FOUND);
                return;
            }
            $this->back((array) $product, Code::$OK);

        } catch (Exception $e) {
            if($e->getCode()) {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], $e->getCode());
            } else {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], Code::$INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function insertProduct(array $data): void
    {
        $REQUIRED_FIELDS = ["name", "description", "color", "size", "price_brl", "res_path"];

        try {
            $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

            $product = new Product();

            $product->name = $request_body["name"];
            $product->description = $request_body["description"];
            $product->color = $request_body["color"];
            $product->size = $request_body["size"];
            $product->price_brl = $request_body["price_brl"];
            $product->res_path = $request_body["res_path"];

            $product->save();

            $this->back([
                "type" => "success",
                "message" => $product->getMessage(),
            ], Code::$CREATED);

        } catch (Exception $e) {
            if($e->getCode()) {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], $e->getCode());
            } else {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], Code::$INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function updateProduct(array $data): void
    {

    }

    public function deleteProduct(int $id): void
    {

    }
}