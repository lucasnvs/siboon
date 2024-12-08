<?php

namespace Source\Controller\Api;

use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Website\FeaturedItem;
use Source\Models\Website\Section;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class WebsiteController extends ApiController
{
    public function listSections(array $data)
    {
        $sections = (new Section())->find()->fetch(true);

        if (empty($sections)) {
            return Response::success([], "Nenhuma seção encontrada.", Code::$NO_CONTENT);
        }

        $response = array_map(function($section) {
            $featuredItems = (new FeaturedItem())->find("section_id = :section_id", "section_id={$section->id}")->fetch(true);

            if (empty($featuredItems)) {
                $featuredItems = [];
            }

            $sectionFeaturedItems = array_map([DTO::class, 'FeaturedItemDTO'], $featuredItems);

            $sectionData = DTO::SectionDTO($section);
            $sectionData['featured_items'] = $sectionFeaturedItems;

            return $sectionData;
        }, $sections);

        return Response::success($response, code: Code::$OK);
    }


    public function getSection(array $data)
    {
        $id = $data['id'];
        $section = (new Section())->findById($id);

        if (!$section) {
            return Response::success([], "Seção não existe.", Code::$NO_CONTENT);
        }

        $featuredItems = (new FeaturedItem())->find("section_id = :section_id", "section_id={$id}")->fetch(true);
        if (empty($featuredItems)) {
            $featuredItems = [];
        }

        $sectionFeaturedItems = array_map([DTO::class, 'FeaturedItemDTO'], $featuredItems);

        return Response::success([
            ...DTO::SectionDTO($section),
            "featured_items" => $sectionFeaturedItems,
        ], code: Code::$OK);
    }

    public function insertSection(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "name" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $section = new Section();
        $section->name = $request_body["name"];

        if (!$section->save()) throw new PDOException($section->fail()->getMessage(), Code::$BAD_REQUEST);

        return Response::success(message: "Seção criada com sucesso.", code: Code::$CREATED);
    }

    public function updateSection(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $FIELDS = [
            "name" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $id = $data['id'];
        $section = (new Section())->findById($id);

        if(!$section) {
            throw new InvalidArgumentException("Seção com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $section->name = $request_body["name"];

        if (!$section->save()) {
            throw new PDOException($section->fail()->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Seção atualizada com sucesso.", code: Code::$OK);
    }

    public function deleteSection(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $section = (new Section())->findById($id);

        if (!$section) {
            throw new InvalidArgumentException("Seção com id $id não existe.", Code::$BAD_REQUEST);
        }

        if (!$section->destroy()) {
            throw new PDOException($section->fail()->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Seção deletada com sucesso.", code: Code::$OK);
    }

    public function listFeaturedItems(array $data)
    {
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $featuredItems = (new FeaturedItem())->find()->fetch(true);

        if (empty($featuredItems)) {
            return Response::success([], "Nenhum item em destaque encontrado.", Code::$NO_CONTENT);
        }

        $response = array_map([DTO::class, 'FeaturedItemDTO'], $featuredItems);

        return Response::success($response, code: Code::$OK);
    }

    public function getFeaturedItem(array $data)
    {
        $id = $data['id'];
        $featuredItem = (new FeaturedItem())->findById($id);

        if (!$featuredItem) {
            return Response::success([], "Item em destaque não existe.", Code::$NO_CONTENT);
        }

        return Response::success(DTO::FeaturedItemDTO($featuredItem), code: Code::$OK);
    }

    public function insertFeaturedItem(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "section_id" => [FieldValidator::required],
            "product_id" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $section = (new Section())->findById($request_body["section_id"]);
        if (!$section) {
            throw new InvalidArgumentException("Seção com id {$request_body['section_id']} não existe.", Code::$BAD_REQUEST);
        }

        $featuredItem = new FeaturedItem();
        $featuredItem->section_id = $request_body["section_id"];
        $featuredItem->product_id = $request_body["product_id"];
        $featuredItem->display_order = $request_body["display_order"] ?? 1;

        if (!$featuredItem->save()) {
            throw new PDOException($featuredItem->fail()->getMessage(), Code::$BAD_REQUEST);
        }

        return Response::success(message: "Item em destaque criado com sucesso.", code: Code::$CREATED);
    }

    public function updateFeaturedItem(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $FIELDS = [
            "section_id" => [FieldValidator::required],
            "product_id" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $id = $data['id'];
        $featuredItem = (new FeaturedItem())->findById($id);

        if (!$featuredItem) {
            throw new InvalidArgumentException("Item em destaque com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $section = (new Section())->findById($request_body["section_id"]);
        if (!$section) {
            throw new InvalidArgumentException("Seção com id {$request_body['section_id']} não existe.", Code::$BAD_REQUEST);
        }

        $featuredItem->section_id = $request_body["section_id"];
        $featuredItem->product_id = $request_body["product_id"];
        $featuredItem->display_order = $request_body["display_order"] ?? $featuredItem->display_order;

        if (!$featuredItem->save()) {
            throw new PDOException($featuredItem->fail()->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Item em destaque atualizado com sucesso.", code: Code::$OK);
    }

    public function deleteFeaturedItem(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $featuredItem = (new FeaturedItem())->findById($id);

        if (!$featuredItem) {
            throw new InvalidArgumentException("Item em destaque com id $id não existe.", Code::$BAD_REQUEST);
        }

        if (!$featuredItem->destroy()) {
            throw new PDOException($featuredItem->fail()->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Item em destaque deletado com sucesso.", code: Code::$OK);
    }
}