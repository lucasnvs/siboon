<?php

namespace Source\Controller\Api;

use CoffeeCode\DataLayer\DataLayer;
use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product\Product;
use Source\Models\Inventory;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class InventoryController extends ApiController
{
    public function listInventory($data)
    {
        $inventory = (new Inventory())->find()->fetch(true);

        if (empty($inventory)) {
            return Response::success([], "Nenhum item no estoque encontrado.", Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($inventory as $item) {
            $response[] = [
                "product_id" => $item->product_id,
                "amount" => $item->amount,
                "size" => $item->size,
            ];
        }
        return Response::success($response, code: Code::$OK);
    }

    public function getProductInventory($data)
    {
        $product_id = $data['id'];
        $productInventory = (new Inventory())->findProductById($product_id);

        if (!$productInventory) {
            return Response::success(message: "Questão não existe.", code: Code::$NO_CONTENT);
        }

        $response = array_map(function ($item) {return $item->data();}, $productInventory);

        return Response::success(
            $response,
            code: Code::$OK
        );
    }

    public function addToInventory($data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $requiredFields = [
            "product_id" => [FieldValidator::required],
            "size" => [FieldValidator::required, FieldValidator::size], // This just works for cloths
        ];

        $request_body = parent::validate($data, $requiredFields);

        $product = (new Product())->findById($request_body['product_id']);
        if (!$product) {
            throw new InvalidArgumentException("Produto não encontrado.", Code::$BAD_REQUEST);
        }

        $existingItem = (new Inventory())->find("product_id = :product_id AND size = :size", "product_id={$request_body['product_id']}&size={$request_body['size']}")->fetch();
        if ($existingItem) {
            throw new InvalidArgumentException("Item já existe no estoque com o mesmo tamanho.", Code::$BAD_REQUEST);
        }

        $inventory = new Inventory();
        $inventory->product_id = $product->id;
        $inventory->size = $request_body['size'];
        $inventory->amount = 0;

        if (!$inventory->save()) {
            throw new PDOException("Erro ao adicionar item ao estoque: " . $inventory->fail(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success("Item adicionado ao estoque com sucesso.", code: Code::$CREATED);
    }

    public function removeFromInventory($data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $requiredFields = [
            "product_id" => [FieldValidator::required],
            "size" => [FieldValidator::required]
        ];
        $request_body = parent::validate($data, $requiredFields);

        $inventory = (new Inventory())->find("product_id = :product_id AND size = :size", "product_id={$request_body['product_id']}&size={$request_body['size']}")->fetch();
        if (!$inventory) {
            throw new InvalidArgumentException("Item não encontrado no estoque.", Code::$BAD_REQUEST);
        }

        if (!$inventory->destroy()) {
            throw new PDOException("Erro ao remover item do estoque: " . $inventory->fail(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success("Item removido do estoque com sucesso.", code: Code::$OK);
    }
//    public function updateItemAmount($data)
//    {
//        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
//
//        $requiredFields = [
//            "product_id" => [FieldValidator::required],
//            "size" => [FieldValidator::required],
//            "amount" => [FieldValidator::required]
//        ];
//        $request_body = parent::validate($data, $requiredFields);
//
//        $inventory = (new Inventory())->find("product_id = :product_id AND size = :size", "product_id={$request_body['product_id']}&size={$request_body['size']}")->fetch();
//        if (!$inventory) {
//            throw new InvalidArgumentException("Item não encontrado no estoque.", Code::$BAD_REQUEST);
//        }
//
//        if ($request_body['amount'] < 0 && $inventory->amount < abs($request_body['amount'])) {
//            throw new InvalidArgumentException("Quantidade insuficiente no estoque.", Code::$BAD_REQUEST);
//        }
//
//        $inventory->amount += $request_body['amount'];
//
//        if (!$inventory->save()) {
//            throw new PDOException("Erro ao atualizar a quantidade do item: " . $inventory->fail(), Code::$INTERNAL_SERVER_ERROR);
//        }
//
//        return Response::success("Quantidade do item atualizada com sucesso.", code: Code::$OK);
//    }

    public function updateStockBySize($data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $requiredFields = [
            "product_id" => [FieldValidator::required],
            "sizes" => [FieldValidator::required]
        ];
        $request_body = parent::validate($data, $requiredFields);

        $product = (new Product())->findById($request_body['product_id']);
        if (!$product) {
            throw new InvalidArgumentException("Produto não encontrado.", Code::$BAD_REQUEST);
        }

        foreach ($request_body['sizes'] as $sizeData) {
            if (!isset($sizeData['size']) || !isset($sizeData['amount'])) {
                throw new InvalidArgumentException("Os campos 'size' e 'amount' são obrigatórios para cada item.", Code::$BAD_REQUEST);
            }

            $size = $sizeData['size'];
            $amount = $sizeData['amount'];

            $inventory = (new Inventory())->find("product_id = :product_id AND size = :size", "product_id={$request_body['product_id']}&size={$size}")->fetch();

            if ($inventory) {
                $inventory->amount = $amount;
            } else {
                $inventory = new Inventory();
                $inventory->product_id = $product->id;
                $inventory->size = $size;
                $inventory->amount = $amount;
            }

            if (!$inventory->save()) {
                throw new PDOException("Erro ao atualizar o estoque para o tamanho {$size}: " . $inventory->fail(), Code::$INTERNAL_SERVER_ERROR);
            }
        }

        return Response::success("Estoque atualizado com sucesso para todos os tamanhos.", code: Code::$OK);
    }


}
