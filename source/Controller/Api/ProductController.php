<?php

namespace Source\Controller\Api;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\Uploader\Image;
use http\Exception\InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Product\Product;
use Source\Models\Product\ProductImage;
use Source\Models\Product\ProductSizeType;
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
        return "R$ " . number_format($value, 2, ",", ".");
    }

    private function mapToViewLayer(DataLayer $product)
    {
        $product->formated_price_brl = $this->format_price($product->price_brl);
        $product->formated_price_brl_with_discount = $this->format_price($this->calc_discount($product->price_brl, $product->discount_brl_percentage));
        $product->url = $product->id;

        $params = http_build_query(["product_id" => $product->id]);
        $images = (new ProductImage())->find("product_id = :product_id", $params)->fetch(true);
        $additional_imgs = [];
        if (!empty($images)) {
            foreach ($images as $image) {
                if ($image->type === ProductImage::$PRINCIPAL) {
                    $product->principal_img = $image->image;
                }
                if ($image->type === ProductImage::$ADDITIONAL) {
                    $additional_imgs[] = $image->image;
                }
            }
        }

        if (count($additional_imgs) > 0) {
            $product->additional_imgs = $additional_imgs;
        }

        return $product;
    }

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
            $response[] = $this->mapToViewLayer($product)->data();
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

        return Response::success($this->mapToViewLayer($product)->data(), code: Code::$OK);
    }

    public function insertProduct(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $REQUIRED_FIELDS = ["name", "description", "color", "size_type", "price_brl", "max_installments", "discount_brl_percentage"];
        $ALLOWED_IMAGES = ["principal_image", "additional_image_1", "additional_image_2", "additional_image_3"];

        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

        if (!$_FILES[$ALLOWED_IMAGES[0]]) throw new InvalidArgumentException("Imagem principal não enviada! Campo: '$ALLOWED_IMAGES[0]'.", Code::$BAD_REQUEST);

        $type = (new ProductSizeType())->findById($request_body["size_type"])->data();
        if (!$type) {
            throw new InvalidArgumentException("Id de tipo de tamanho inválido!", Code::$BAD_REQUEST);
        }
        $request_body["size_type_id"] = $type->id;

        $product = new Product();
        $product->setData($request_body);

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
        $request_body = $this->validateRequestData($data);
        $ALLOWED_IMAGES = ["principal-image", "additional-image-1", "additional-image-2", "additional-image-3"];

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
        if (isset($request_body["size_type"])) {
            $product->size_type_id = $request_body["size_type"];
        }
        if (isset($request_body["price_brl"])) {
            $product->price_brl = $request_body["price_brl"];
        }
        if (isset($request_body["max_installments"])) {
            $product->max_installments = $request_body["max_installments"];
        }
        if (isset($request_body["discount_brl_percentage"])) {
            $product->discount_brl_percentage = $request_body["discount_brl_percentage"];
        }

        if (!$product->save()) {
            throw new PDOException($product->fail(), code: Code::$BAD_REQUEST);
        }

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
        $isDestroyed = $product->destroy();

        chdir("..");
        if (!$this->deleteImageDir($product->id)) throw new PDOException("Erro ao apagar arquivos de imagem!");

        if (!$isDestroyed) {
            throw new PDOException($product->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }


        return Response::success(message: "Produto deletado com sucesso.", code: Code::$OK);
    }
}