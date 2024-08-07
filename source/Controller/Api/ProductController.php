<?php

namespace Source\Controller\Api;

use CoffeeCode\Uploader\Image;
use http\Exception\InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product\Product;
use Source\Models\Product\ProductImage;
use Source\Models\Product\ProductSizeType;
use Source\Response\Code;
use Source\Response\Response;
use Source\Support\DTO;
use Source\Support\Validator\FieldValidator;

class ProductController extends ApiController
{

    private function saveImage($imageFile, $name, $product_id, $type)
    {
        $image = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR . "/products/" . $product_id, false);
        $upload = $image->upload($imageFile, $name);


        if(!file_exists($upload)) throw new PDOException("Erro ao salvar imagem $name");

        $productImages = new ProductImage();
        $productImages->product_id = $product_id;
        $productImages->image = $upload;
        $productImages->type = $type;

       $productImages->save();
    }

    private function deleteImage($product_id, $name)
    {
        $path = CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/products/" . $product_id . "/" . $name;
        $params = http_build_query(["product_id" => $product_id, "image" => $path]);
        $image = (new ProductImage())->find("product_id = :product_id AND image LIKE ':image%' ", $params);
        if (file_exists($image->image)) {
            unlink($image->image);
            if (!$image->destroy()) throw new PDOException("Erro ao deletar imagem no banco de dados.");
        }
    }

    private function deleteImageDir($product_id)
    {
        function delTree($dir)
        {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }

        $path = CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/products/" . $product_id . "/";

        return delTree($path);
    }

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

        $ALLOW_TO_SET = [
            "name" => "name",
            "description" => "description",
            "color" => "color",
            "size_type" => "size_type_id",
            "price_brl" => "price_brl",
            "max_installments" => "max_installments",
            "discount_brl_percentage" => "discount_brl_percentage",
        ];

        $product = new Product();
        parent::setObjectAttributes($product, $ALLOW_TO_SET,$request_body);

        $isCreated = $product->save();

        if (!$isCreated) throw new PDOException($product->fail(), Code::$BAD_REQUEST);

        chdir("..");
        $this->saveImage($_FILES[$ALLOWED_IMAGES[0]], $ALLOWED_IMAGES[0], $product->id, ProductImage::$PRINCIPAL);
        for ($i = 1; $i < count($ALLOWED_IMAGES); $i++) {
            if (isset($_FILES[$ALLOWED_IMAGES[$i]])) {
                $this->saveImage($_FILES[$ALLOWED_IMAGES[$i]], $ALLOWED_IMAGES[$i], $product->id, ProductImage::$ADDITIONAL);
            }
        }

        return Response::success(message: "Produto criado com sucesso.", code: Code::$CREATED);
    }

    public function updateProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $request_body = $this->validate($data);
        $ALLOWED_IMAGES = ["principal-image", "additional-image-1", "additional-image-2", "additional-image-3"];


        $product = (new Product())->findById($id);
        if(!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $ALLOW_TO_SET = [
            "name" => "name",
            "description" => "description",
            "color" => "color",
            "size_type" => "size_type",
            "price_brl" => "price_brl",
            "max_installments" => "max_installments",
            "discount_brl_percentage" => "discount_brl_percentage"
        ];
        parent::setObjectAttributes($product, $ALLOW_TO_SET, $request_body);

        if (!$product->save()) {
            throw new PDOException($product->fail(), code: Code::$BAD_REQUEST);
        }

        // Tenho que mudar isso aq, ta confuso e com bug;
        chdir("..");
        if (isset($_FILES[$ALLOWED_IMAGES[0]])) {
            $this->deleteImage($product->id, $ALLOWED_IMAGES[0]);
            $this->saveImage($_FILES[$ALLOWED_IMAGES[0]], $ALLOWED_IMAGES[0], $product->id, ProductImage::$PRINCIPAL);
        }

        for ($i = 1; $i < count($ALLOWED_IMAGES); $i++) {
            if (isset($_FILES[$ALLOWED_IMAGES[$i]])) {
                $this->deleteImage($product->id, $ALLOWED_IMAGES[$i]);
                $this->saveImage($_FILES[$ALLOWED_IMAGES[$i]], $ALLOWED_IMAGES[$i], $product->id, ProductImage::$ADDITIONAL);
            }
        }

        return Response::success(message: "Produto atualizado com sucesso.", code: Code::$OK);
    }

    public function deleteProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];

        $product = (new Product())->findById($id);

        if(!$product) {
            throw new InvalidArgumentException("Produto com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $product->destroy();

        chdir("..");
        if (!$this->deleteImageDir($product->id)) throw new PDOException("Erro ao apagar arquivos de imagem!");

        if (!$isDestroyed) {
            throw new PDOException($product->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }


        return Response::success(message: "Produto deletado com sucesso.", code: Code::$OK);
    }
}