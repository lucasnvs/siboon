<?php

namespace Source\Controller\Api;

use CoffeeCode\DataLayer\DataLayer;
use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Company\Company;
use Source\Support\Response\Code;
use Source\Support\Response\Response;

class CompanyController extends ApiController
{
    public function listInformation()
    {
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $response = [];

        $company = new Company();

        $information = $company->find()->fetch(true);

        foreach ($information as $info) {
            $response[$info->key] = $info->value;
        }
        return Response::success($response, code: Code::$OK);
    }

//    public function saveInformation($data)
//    {
//        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
//        $request_body = parent::validate($data);
//
//        foreach ($request_body as $field_key => $field_value) {
//            $field_key = str_replace("-", "_", $field_key);
////            $attribute = (new Company())->findByKey($field_key);
//            $attribute = (new Company())->findById(1);
//            echo json_encode($attribute->data());
//            $isEditable = $attribute && $field_value != $attribute->value;
//
//            if ($isEditable) {
//                $attribute->value = "ETRERO"; //
//                if (!$attribute->save()) {
//                    throw new PDOException($attribute->fail()->getMessage(), code: Code::$BAD_REQUEST);
//                }
//            }
//        }
//
//        return Response::success(message: "Atributo(s) atualizado(s) com sucesso.", code: Code::$OK);
//    }
}