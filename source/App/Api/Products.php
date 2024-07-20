<?php

namespace Source\App\Api;

use Exception;
use Source\Models\Product;

class Products extends Api
{
    public function listProducts(): void
    {
        try {
            $products = (new Product())->selectAll();
            $this->back($products, Code::$OK);
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
            $product = (new Product())->selectById($id);
            if (!$product) {
                $this->back(["message" => "Product with id $id not found."], Code::$NOT_FOUND);
                return;
            }
            $this->back($product, Code::$OK);

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

    public function insertProduct(): void
    {
        $REQUIRED_FIELDS = ["name", "description", "color", "size", "price_brl", "res_path"];

        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);

            $product = new Product(
                name: $request_body["name"],
                description: $request_body["description"],
                color: $request_body["color"],
                size: $request_body["size"],
                price_brl: $request_body["price_brl"],
                res_path: $request_body["res_path"],
            );
            
            $this->back([
                "type" => "success",
                "message" => $product->getMessage(),
                "product" => $product->get_attributes_array()
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