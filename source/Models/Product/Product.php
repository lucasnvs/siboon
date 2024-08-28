<?php

namespace Source\Models\Product;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\Uploader\Image;
use Error;
use Exception;
use PDOException;
use function delTree;

/**
 * @property string|null $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $color
 * @property int|null $size_type_id
 * @property double|null $price_brl
 * @property int|null $max_installments
 * @property int|null $discount_brl_percentage
 */
class Product extends DataLayer {
    private $message;

    public function __construct()
    {
        parent::__construct("products", ["name", "color", "size_type_id", "price_brl", "max_installments"]);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function setData($data): void
    {
        if (isset($data["name"])) {
            $this->name = $data["name"];
        }
        if (isset($data["description"])) {
            $this->description = $data["description"];
        }
        if (isset($data["color"])) {
            $this->color = $data["color"];
        }
        if (isset($data["size_type"])) {
            $this->size_type_id = $data["size_type"];
        }
        if (isset($data["price_brl"])) {
            $this->price_brl = $data["price_brl"];
        }
        if (isset($data["max_installments"])) {
            $this->max_installments = $data["max_installments"];
        }
        if (isset($data["discount_brl_percentage"])) {
            $this->discount_brl_percentage = $data["discount_brl_percentage"];
        }
    }

    /**
     * @param $imageFile
     * @param $product_id
     * @param $name
     * @return string
     * @throws Exception
     */
    private function storageUploadImage($imageFile, $product_id, $name): string
    {
        $imagePathUploader = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR . "/products/" . $product_id, false);

        $upload = $imagePathUploader->upload($imageFile, $name);
        if (!file_exists($upload)) throw new PDOException("Erro ao salvar imagem $name");

        return $upload;
    }

    /**
     * @param $imageFile
     * @param $product_id
     * @param $type
     * @return void
     * @throws Exception
     */
    public function saveImage($imageFile, $product_id, $type): void
    {
        $name = null;
        $newItemValue = null;
        if ($type === ProductImage::$PRINCIPAL) {
            $name = "principal_image";
        }
        if ($type === ProductImage::$ADDITIONAL) {
            $params = http_build_query(["product_id" => $product_id, "type" => $type]);
            $imageFinded = (new ProductImage())->find("product_id = :product_id AND type = :type ORDER BY additional_order DESC;", $params);
            if (!isset($imageFinded)) {
                $name = "additional_image-1";
                $newItemValue = 1;
            } else {
                $newItemValue = $imageFinded->additional_order + 1;
                $name = "additional_image-$newItemValue";
            }
        }

        if (isset($name)) {
            $upload = $this->storageUploadImage($imageFile, $product_id, $name);

            $productImages = new ProductImage();
            $productImages->product_id = $product_id;
            $productImages->image = $upload;
            $productImages->type = $type;
            $productImages->additional_order = $newItemValue;

            $productImages->save();
        }
    }

    /**
     * Update a product image
     *
     * @param $imageFile
     * @param $type
     * @param $order
     * @return void
     * @throws Exception
     */
    public function updateImage($imageFile, $type, $order = null): void
    {
        $product_id = $this->id;

        if ($type === ProductImage::$ADDITIONAL && $order == null) {
            throw new Error("Implementation Error: Se o type for $type você tem que passar um valor de order correto");
        }

        if ($type === ProductImage::$PRINCIPAL) {
            $params = http_build_query(["product_id" => $product_id, "type" => $type]);
            $imageFinded = (new ProductImage())->find("product_id = :product_id AND `type` = :type", $params)->fetch();

            if (!isset($imageFinded->id)) { // sempre da null / true
                $this->saveImage($imageFile, $product_id, $type);
                return;
            }

            $this->deleteImage($imageFinded->id);

            $upload = $this->storageUploadImage($imageFile, $product_id, "principal-image");

            $imageFinded->image = $upload;
            $imageFinded->save();
        }

        if ($type === ProductImage::$ADDITIONAL) {
            $params = http_build_query(["product_id" => $product_id, "type" => $type, "order" => $order]);
            $imageFinded = (new ProductImage())->find("product_id = :product_id AND type = :type AND additional_order = :order", $params)->fetch();
            if ($imageFinded === null) {
                $this->saveImage($imageFile, $product_id, $type);
                return;
            }
            $this->deleteImage($imageFinded->id, $imageFinded->image);
            $upload = $this->storageUploadImage($imageFile, $product_id, "additional-image-$order");
            $imageFinded->image = $upload;

            $imageFinded->save();
        }
    }

    /**
     * Delete an image on directory and Database.
     *
     * @param $imageId
     * @param bool $deleteOnDatabase
     * @return void
     * @throws Exception
     */
    private function deleteImage($imageId, bool $deleteOnDatabase = false): void
    {
        $image = (new ProductImage())->findById($imageId);
        $path = $image->image;

        if (file_exists($path)) {
            if(!unlink($path)) throw new Exception("Erro ao deletar imagem.");
            if ($deleteOnDatabase) {
                if (!$image->destroy()) throw new PDOException("Erro ao deletar imagem no banco de dados.");
            }
        }
    }

    /**
     * Deletes an image directory on CONF_UPLOAD_DIR/CONF_UPLOAD_IMAGE_DIR.
     *
     * @return bool
     */
    public function deleteImageDir(): bool
    {
        $path = CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/products/" . $this->id . "/";

        return delTree($path);
    }
}