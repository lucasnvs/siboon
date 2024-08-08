<?php

namespace Source\Support;
use Source\Models\Product\ProductImage;

class DTO {

    private static function calc_discount(float $value, $p_discount = 0): float { return $value - ($value * $p_discount / 100); }

    private static function format_price($value): string { return "R$ " . number_format($value, 2, ",", "."); }

    public static function ProductDTO($product)
    {

        $product->formated_price_brl = self::format_price($product->price_brl);
        $product->formated_price_brl_with_discount = self::format_price(self::calc_discount($product->price_brl, $product->discount_brl_percentage));
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

        return $product->data();
    }

    public static function UserDTO($user): array
    {
        $dtoUser = [
            "id" => $user->id,
            "name" => $user->first_name." ".$user->last_name,
            "email" => $user->email,
            "role" => $user->role,
        ];

        return $dtoUser;
    }
}