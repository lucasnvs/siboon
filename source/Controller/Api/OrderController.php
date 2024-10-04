<?php

namespace Source\Controller\Api;

use Example\Models\Address;
use InvalidArgumentException;
use PaymentService;
use PDOException;
use ShipmentService;
use Source\Core\ApiController;
use Source\Core\Controller;
use Source\Exceptions\PaymentException;
use Source\Models\Order\Order;
use Source\Models\Product\Product;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class OrderController extends ApiController
{
    public function listOrders(array $data)
    {
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $orders = (new Order())->find()->fetch(true);

        if (!$orders) {
            return Response::success([], message: "Nenhum pedido encontrado.", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($orders as $order) {
            $response[] = DTO::OrderDTO($order);
        }

        return Response::success($response, code: Code::$OK);
    }

    public function getOrder(array $data)
    {
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $id = $data['id'];
        $order = (new Order())->findById($id);

        if (!$order) {
            return Response::success(message: "Pedido não existe.", code: Code::$NO_CONTENT);
        }

        return Response::success(
            DTO::OrderDTO($order),
            code: Code::$OK
        );
    }

    public function createOrder(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "user_id" => [FieldValidator::required],
            "address_id" => [FieldValidator::required],
            "order_items" => [FieldValidator::required],
        ];
        $request_body = parent::validate($data, $FIELDS);

        $totalPrice = 0;
        foreach ($request_body["order_items"] as $order_item) {
            $product = (new Product())->findById($order_item["id"]);
            $totalPrice += $product->price_brl;
        }
        $request_body["total_price"] = $totalPrice;

        $order = new Order();
        $order->setData($request_body);

        $isCreated = $order->save();
        if (!$isCreated) throw new PDOException($order->fail()->getMessage(), Code::$BAD_REQUEST);

        return Response::success(["order_id" => $order->id],message: "Pedido efetuado com sucesso.", code: Code::$CREATED);
    }

    public function updateOrder(array $data)
    {

    }

    public function deleteOrder(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $id = $data['id'];
        $order = (new Order())->findById($id);

        if (!isset($order)) {
            throw new InvalidArgumentException("Pedido com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $order->destroy();

        if (!$isDestroyed) {
            throw new PDOException($order->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Pedido deletado com sucesso.", code: Code::$OK);
    }
    public function finishOrder(array $data)
    {
        $order = (new Order())->findById($data['id']);
        if (!$order) {
            return Response::success(message: "Pedido não existe.", code: Code::$NO_CONTENT);
        }

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $order->user_id);

        try {
            $processPayment = PaymentService::processPayment($order->id, $order->total_price);
            $paymentId = $processPayment["paymentId"];

            $paymentStatus = PaymentService::checkPaymentStatus($paymentId);
            if ($paymentStatus["status"] !== "completed") {
                throw new PaymentException("Pagamento não foi finalizado.");
            }

            $order->payment_status = Order::PAYMENT_STATUS_PAID;
        } catch (\Exception $e) {
            throw new PaymentException("Erro ao processar pagamento: " . $e->getMessage(), Code::$BAD_REQUEST);
        }

        try {
            $address = (new Address())->findById($order->address_id);
            if (!$address) {
                throw new InvalidArgumentException("Endereço não encontrado.", Code::$BAD_REQUEST);
            }

            $shipmentStatus = ShipmentService::createShipment($order->id, $address->cep);
            if ($shipmentStatus["status"] === "success") {
                $order->shipment_status = Order::SHIPMENT_STATUS_SENDED;
            }
        } catch (\Exception $e) {
            throw new PDOException("Erro ao processar envio: " . $e->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }

        if (!$order->save()) {
            throw new PDOException("Erro ao salvar pedido: " . $order->fail()->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success("Pedido finalizado com sucesso.", code: Code::$OK);
    }

}