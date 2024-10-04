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
    private const ALLOWED_IMAGES = [
        "principal_image",
        "additional_image_1",
        "additional_image_2",
        "additional_image_3"
    ];

    public function listProducts()
    {
        $products = (new Product())->find()->fetch(true);

        if (empty($products)) {
            return Response::success([], "Nenhum produto encontrado.", Code::$NO_CONTENT);
        }

        $response = array_map([DTO::class, 'ProductDTO'], $products);

        return Response::success($response, code: Code::$OK);
    }

    public function getProduct(array $data)
    {
        $id = $data['id'];
        $product = (new Product())->findById($id);

        if (!$product) {
            return Response::success([], "Produto não existe.", Code::$NO_CONTENT);
        }

        return Response::success(DTO::ProductDTO($product), code: Code::$OK);
    }

    public function insertProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $request_body = $this->validateProductData($data);

        if (empty($_FILES[self::ALLOWED_IMAGES[0]])) {
            throw new InvalidArgumentException("Imagem principal não enviada! Campo: '" . self::ALLOWED_IMAGES[0] . "'.", Code::$BAD_REQUEST);
        }

        $type = (new ProductSizeType())->findById($request_body["size_type"])->data();
        if (!$type) {
            throw new InvalidArgumentException("Id de tipo de tamanho inválido!", Code::$BAD_REQUEST);
        }

        $product = new Product();
        $product->setData($request_body);

        if (!$product->save()) {
            throw new PDOException($product->fail(), Code::$BAD_REQUEST);
        }

        self::doInsideRoot(function () use ($product) {
            $this->handleProductImages($product);
        });

        return Response::success("Produto criado com sucesso.", Code::$CREATED);
    }

    public function updateProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $product = (new Product())->findById($id);

        if (!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", Code::$BAD_REQUEST);
        }

        $request_body = parent::validate($data);
        $product->setData($request_body);

        if (!$product->save()) {
            throw new PDOException($product->fail()->getMessage(), Code::$BAD_REQUEST);
        }

        self::doInsideRoot(function () use ($product) {
            $this->handleProductImages($product, true);
        });

        return Response::success("Produto atualizado com sucesso.", Code::$OK);
    }

    public function deleteProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $product = (new Product())->findById($id);

        if (!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", Code::$BAD_REQUEST);
        }

        if (!$product->deleteImageDir()) {
            throw new PDOException("Erro ao apagar arquivos de imagem!");
        }

        if (!$product->destroy()) {
            throw new PDOException($product->fail()->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success("Produto deletado com sucesso.", Code::$OK);
    }

    private function validateProductData(array $data): array
    {
        $FIELDS = [
            "name" => [FieldValidator::required],
            "description" => [FieldValidator::required],
            "color" => [FieldValidator::required],
            "size_type" => [FieldValidator::required],
            "price_brl" => [FieldValidator::required],
            "max_installments" => [FieldValidator::required],
            "discount_brl_percentage" => [FieldValidator::required],
        ];

        return parent::validate($data, $FIELDS);
    }

    private function handleProductImages(Product $product, bool $isUpdate = false): void
    {
        if (isset($_FILES[self::ALLOWED_IMAGES[0]])) {
            $product->saveImage($_FILES[self::ALLOWED_IMAGES[0]], $product->id, ProductImage::$PRINCIPAL);
        }

        for ($i = 1; $i < count(self::ALLOWED_IMAGES); $i++) {
            if (isset($_FILES[self::ALLOWED_IMAGES[$i]])) {
                if ($isUpdate) {
                    $product->updateImage($_FILES[self::ALLOWED_IMAGES[$i]], ProductImage::$ADDITIONAL, order: $i);
                } else {
                    $product->saveImage($_FILES[self::ALLOWED_IMAGES[$i]], $product->id, ProductImage::$ADDITIONAL);
                }
            }
        }
    }
}
