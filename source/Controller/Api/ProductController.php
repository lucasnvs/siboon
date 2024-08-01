<?php

namespace Source\Controller\Api;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\Uploader\Image;
use http\Exception\InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product;
use Source\Response\Code;
use Source\Response\Response;

class ProductController extends ApiController
{

    private function calc_discount(float $value, $p_discount = 0): float
    {
        return $value - ($value * $p_discount / 100);
    }

    private function format_price($value): string
    {
        return "R$ ".number_format($value,2,",",".");
    }

    private function mapToViewLayer(DataLayer $product)
    {
        $product->formated_price_brl = $this->format_price($product->price_brl);
        $product->formated_price_brl_with_discount = $this->format_price($this->calc_discount($product->price_brl, $product->discount_brl_percentage));
        return $product;
    }

    public function listProducts(array $data = null, $isLocalReq = false)
    {
        $products = (new Product())->find()->fetch(true);
        if (!$products) {
            return Response::success(message: "Nenhum produto encontrado.", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($products as $product) {
            $response[] = $this->mapToViewLayer($product)->data();
        }

        if ($isLocalReq) return $response;

        return Response::success($response, code: Code::$OK);
    }

    public function getProduct(array $data, $isLocalReq = false)
    {
        $id = $data['id'];
        $product = (new Product())->findById($id);

        if (!$product) {
            return Response::success(message: "Produto não existe.", code: Code::$NO_CONTENT);
        }


        if ($isLocalReq) return $this->mapToViewLayer($product)->data();

        return Response::success($this->mapToViewLayer($product)->data(), code: Code::$OK);
    }

    public function insertProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $REQUIRED_FIELDS = ["name", "description", "color", "size_type", "price_brl"];
        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);
        if (!$_FILES["image"]) throw new InvalidArgumentException("Você deve enviar a imagem do produto. Campo: 'product-img'", Code::$BAD_REQUEST);

        $ALLOWED_SIZE_TYPES = ["cloth", "shoes", "unique"];

        if(!in_array($request_body["size_type"], $ALLOWED_SIZE_TYPES)) {
            throw new InvalidArgumentException("Tipo de tamanho inválido! São aceitos: " . implode(", ", $ALLOWED_SIZE_TYPES), Code::$BAD_REQUEST);
        }

        $product = new Product();

        $product->name = $request_body["name"];
        $product->description = $request_body["description"];
        $product->color = $request_body["color"];
        $product->size_type = $request_body["size_type"];
        $product->price_brl = $request_body["price_brl"];

        chdir("..");
        $image = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);
        $name = md5(uniqid(rand(), true));
        $upload = $image->upload($_FILES['image'], $name, 1000);

        $product->res_path = $upload;

        $isCreated = $product->save();

        if(!$isCreated) {
            throw new PDOException($product->fail(), Code::$BAD_REQUEST);
        }

        return Response::success(message: "Produto criado com sucesso.", code: Code::$CREATED);
    }

    public function updateProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $request_body = $this->validateRequestData($data);

        $product = (new Product())->findById($id);

        if (isset($request_body["name"])) {
            $product->name = $request_body["name"];
        }
        if (isset($request_body["description"])) {
            $product->description = $request_body["description"];
        }
        if (isset($request_body["color"])) {
            $product->color = $request_body["color"];
        }
        if (isset($request_body["size"])) {
            $product->size = $request_body["size"];
        }
        if (isset($request_body["price_brl"])) {
            $product->price_brl = $request_body["price_brl"];
        }
        if (isset($request_body["res_path"])) {
            $product->res_path = $request_body["res_path"];
        }

        if (!$product->save()) {
            throw new PDOException($product->fail(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Produto atualizado com sucesso.", code: Code::$OK);
    }


    public function deleteProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];

        $product = new Product();

        $isDestroyed = $product->findById($id)->destroy();

        if(!$isDestroyed) {
            throw new PDOException($product->fail(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Produto deletado com sucesso.", code: Code::$NO_CONTENT);
    }
}