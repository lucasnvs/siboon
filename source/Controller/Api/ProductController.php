<?php

namespace Source\Controller\Api;

use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product\Product;
use Source\Models\Product\ProductImage;
use Source\Models\Product\ProductSizeType;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class ProductController extends ApiController
{
    public function listProducts()
    {
        $products = (new Product())->find()->fetch(true);

        if (!$products) {
            return Response::success([], message: "Nenhum produto encontrado.", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($products as $product) {
            $response[] = DTO::ProductDTO($product);
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

        return Response::success(
            DTO::ProductDTO($product),
            code: Code::$OK
        );
    }

    public function insertProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "name" => [FieldValidator::required],
            "description" => [FieldValidator::required],
            "color" => [FieldValidator::required],
            "size_type" => [FieldValidator::required],
            "price_brl" => [FieldValidator::required],
            "max_installments" => [FieldValidator::required],
            "discount_brl_percentage" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $ALLOWED_IMAGES = ["principal_image", "additional_image_1", "additional_image_2", "additional_image_3"];

        if (!$_FILES[$ALLOWED_IMAGES[0]]) throw new InvalidArgumentException("Imagem principal não enviada! Campo: '$ALLOWED_IMAGES[0]'.", Code::$BAD_REQUEST);

        $type = (new ProductSizeType())->findById($request_body["size_type"])->data();
        if (!$type) {
            throw new InvalidArgumentException("Id de tipo de tamanho inválido!", Code::$BAD_REQUEST);
        }

        $product = new Product();
        $product->setData($request_body);

        $isCreated = $product->save();

        if (!$isCreated) throw new PDOException($product->fail(), Code::$BAD_REQUEST);

        self::doInsideRoot(function () use ($product, $ALLOWED_IMAGES) {
            $product->saveImage($_FILES[$ALLOWED_IMAGES[0]], $product->id, ProductImage::$PRINCIPAL);

            for ($i = 1; $i < $ALLOWED_IMAGES; $i++) {
                if (isset($_FILES[$ALLOWED_IMAGES[$i]])) {
                    echo json_encode($_FILES[$ALLOWED_IMAGES[$i]]);
                    $product->saveImage($_FILES[$ALLOWED_IMAGES[$i]], $product->id, ProductImage::$ADDITIONAL);
                }
            }

        });

        return Response::success(message: "Produto criado com sucesso.", code: Code::$CREATED);
    }

    public function updateProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $request_body = parent::validate($data);
        $ALLOWED_IMAGES = ["principal_image", "additional_image_1", "additional_image_2", "additional_image_3"];

        $product = (new Product())->findById($id);
        if (!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $product->setData($request_body);

        if (!$product->save()) {
            throw new PDOException($product->fail()->getMessage(), code: Code::$BAD_REQUEST);
        }

        self::doInsideRoot(function () use ($product, $ALLOWED_IMAGES) {
            if (isset($_FILES[$ALLOWED_IMAGES[0]])) {
                $product->updateImage($_FILES[$ALLOWED_IMAGES[0]], ProductImage::$PRINCIPAL);
            }

            for ($i = 1; $i < count($ALLOWED_IMAGES); $i++) {
                if (isset($_FILES[$ALLOWED_IMAGES[$i]])) {
                    $product->updateImage($_FILES[$ALLOWED_IMAGES[$i]], ProductImage::$ADDITIONAL, order: $i);
                }
            }
        });


        return Response::success(message: "Produto atualizado com sucesso.", code: Code::$OK);
    }

    public function deleteProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];

        $product = (new Product())->findById($id);

        if (!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        if (!$product->deleteImageDir()) {
            throw new PDOException("Erro ao apagar arquivos de imagem!");
        }

        $isDestroyed = $product->destroy();
        if (!$isDestroyed) {
            throw new PDOException($product->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Produto deletado com sucesso.", code: Code::$OK);
    }
}