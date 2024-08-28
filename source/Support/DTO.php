<?php

namespace Source\Support;
use Source\Models\Faq\Type;
use Source\Models\Product\ProductImage;
use Source\Models\Product\ProductSizeType;

/**
 *  Class with Data Transfer Object functions to return formated data to client.
 */
abstract class DTO {

    private static function calc_discount(float $value, $p_discount = 0): float { return $value - ($value * $p_discount / 100); }

    private static function format_price($value): string { return "R$ " . number_format($value, 2, ",", "."); }

    public static function ProductDTO($product): array
    {
        $responseDto = [
            "id" => $product->id,
            "name" => $product->name,
            "description" => $product->description,
            "color" => $product->color,
            "price_brl" => $product->price_brl,
            "formated_price_brl" => self::format_price($product->price_brl),
            "discount_brl_percentage" => $product->discount_brl_percentage,
            "formated_price_brl_with_discount" => self::format_price(self::calc_discount($product->price_brl, $product->discount_brl_percentage)),
            "max_installments" => $product->max_installments,
            "url" => buildFriendlyURL($product->name) . "-" . $product->id,
            "size_type_id" => $product->size_type_id,
        ];

        $size = (new ProductSizeType())->findById($product->size_type_id);
        if(!empty($size)) {
            $responseDto["size_type"] = $size->name;
        }

        $params = http_build_query(["product_id" => $product->id]);
        $images = (new ProductImage())->find("product_id = :product_id", $params)->fetch(true);
        $additional_imgs = [];
        if (!empty($images)) {
            foreach ($images as $image) {
                if ($image->type === ProductImage::$PRINCIPAL) {
                    $responseDto["principal_img"] = $image->image;
                }
                if ($image->type === ProductImage::$ADDITIONAL) {
                    $additional_imgs[] = $image->image;
                }
            }
        }

        if (count($additional_imgs) > 0) {
            $responseDto["additional_imgs"] = $additional_imgs;
        }

        return $responseDto;
    }

    public static function UserDTO($user): array
    {
        return [
            "id" => $user->id,
            "name" => $user->first_name." ".$user->last_name,
            "email" => $user->email,
            "role" => $user->role,
        ];
    }

    public static function FaqDTO($question)
    {
        $typeModel = new Type();
        $types = $typeModel->find()->fetch(true);

        $filter = array_filter($types, function ($type) use ($question) {
            return $type->data()->id == $question->data()->type_id;
        })[1] ?? null;

        $question->type = $filter->data()->description;

        return $question->data();
    }

    public static function OrderDTO($order): array
    {
        return [
            "id" => $order->id,
            "user_id" => $order->user->id,
            "address_id" => $order->address_id,
            "total_price" => $order->total_price,
            "payment_status" => $order->payment_status,
            "shipment_status" => $order->shipment_status,
        ];
    }
}