<?php

namespace Source\Controller\Api;

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

        $company = new Company();
        $information = $company->find()->fetch(true);

        if (empty($information)) {
            return Response::success([], "Nenhuma informação encontrada.", Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($information as $info) {
            $response[$info->key_unique] = $info->value;
        }

        return Response::success($response, code: Code::$OK);
    }

    public function saveInformation(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $request_body = parent::validate($data);
        $updatedAttributes = [];

        foreach ($request_body as $field_key => $field_value) {
            $normalized_key = str_replace("-", "_", $field_key);

            $attribute = (new Company())->findByKey($normalized_key);

            if ($attribute) {
                if ($attribute->value !== $field_value) {
                    $attribute->value = $field_value;
                    if (!$attribute->save()) {
                        throw new PDOException($attribute->fail()->getMessage(), Code::$BAD_REQUEST);
                    }
                    $updatedAttributes[] = $normalized_key;
                }
            } else {
                throw new InvalidArgumentException("Atributo '$normalized_key' não encontrado.", Code::$BAD_REQUEST);
            }
        }

        if (empty($updatedAttributes)) {
            return Response::success(message: "Nenhum atributo foi atualizado.", code: Code::$OK);
        }

        return Response::success(message: "Atributo(s) atualizado(s) com sucesso.", code: Code::$OK);
    }
}
