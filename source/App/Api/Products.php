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
        } catch (\Exception $e) {
            $this->back(['error' => $e->getMessage()], Code::$INTERNAL_SERVER_ERROR);
        }
    }

    public function getProduct(int $id): void
    {
        try {
            $product = (new Product())->selectById($id);
            if (!$product) {
                $this->back(["message" => "Product with id $id not found."], Code::$NOT_FOUND);
                return;
            }
            $this->back($product, Code::$OK);
        } catch (\Exception $e) {
            $this->back(['error' => $e->getMessage()], Code::$INTERNAL_SERVER_ERROR);
        }
    }

    public function insertProduct(): void
    {

        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $product = new Product(
                name: $data["name"],
                description: $data["description"],
                color: $data["color"],
                size: $data["size"],
                price_brl: $data["price_brl"],
                res_path: $data["res_path"],
            );
            
            $this->back($product->get_attributes_array(), Code::$CREATED);
        } catch (Exception $e) {
            $this->back(['error' => "Erro"], Code::$INTERNAL_SERVER_ERROR);
        }
    }

    public function updateProduct(int $id, array $data): void
    {

    }

    public function deleteProduct(int $id): void
    {

    }
}