<?php

namespace Source\Controller\Api;

use Example\Models\Address;
use InvalidArgumentException;
use PaymentService;
use PDOException;
use ShipmentService;
use Source\Core\Controller;
use Source\Models\Order\Order;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class OrderController extends Controller
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

        // Pega os items do pedido
        // faz a soma do total
        // add total_price na order;

        $order = new Order();
        $order->setData($request_body);

        $isCreated = $order->save();
        if (!$isCreated) throw new PDOException($order->fail()->getMessage(), Code::$BAD_REQUEST);

        return Response::success(message: "Pedido efetuado com sucesso.", code: Code::$CREATED);
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
        if(!$order) {
            return Response::success(message: "Pedido não existe.", code: Code::$NO_CONTENT);
        }

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $order->user_id);

        /*
         * Isso daq ta horrivel, pfv eu do futuro, melhore isto.
         */
        $processPayment = PaymentService::processPayment($order->id, $order->total_price);
        $paymentId = $processPayment["paymentId"];

        $paymentStatus = PaymentService::checkPaymentStatus($paymentId);
        $status = $paymentStatus["status"];
        if($status != "completed") return;

        $order->payment_status = Order::PAYMENT_STATUS_PAID;

        try{
            $address = (new Address())->findById($order->address_id);
            $shipmentStatus = ShipmentService::createShipment($order->orderId, $address->cep);
            if($shipmentStatus["status"] == "success") {
                // Salva ou não informacoes de envio;
                $order->shipment_status = Order::SHIPMENT_STATUS_SENDED;
            }

        } catch(\Exception $e) {} // try catch cala boca :(

        if(!$order->save()) {
            throw new PDOException($order->fail()->getMessage(), Code::$INTERNAL_SERVER_ERROR);
        }
        return Response::success("Pedido finalizado com sucesso.", code: Code::$OK);
    }
}