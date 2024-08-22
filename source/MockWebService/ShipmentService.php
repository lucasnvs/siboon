<?php
class ShipmentService
{
    /**
     * Simula o processamento de um envio.
     *
     * @param string $orderId ID do pedido.
     * @param string $destination Destino do envio.
     * @return array Resposta simulada do serviço.
     */
    public static function createShipment($orderId, $destination)
    {
        if (empty($orderId) || empty($destination)) {
            return [
                'status' => 'error',
                'message' => 'Invalid order ID or destination'
            ];
        }

        // Simula um processamento de envio
        $shipmentId = uniqid('shp_', true);
        return [
            'status' => 'success',
            'message' => 'Shipment created successfully',
            'shipmentId' => $shipmentId,
            'orderId' => $orderId,
            'destination' => $destination,
            'estimatedDelivery' => date('Y-m-d', strtotime('+5 days'))
        ];
    }

    /**
     * Simula o rastreamento de um envio.
     *
     * @param string $shipmentId ID do envio.
     * @return array Resposta simulada do rastreamento.
     */
    public static function trackShipment($shipmentId)
    {
        if (empty($shipmentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid shipment ID'
            ];
        }

        // Simula o rastreamento de envio
        $status = rand(0, 1) == 1 ? 'In Transit' : 'Delivered';

        return [
            'status' => 'success',
            'message' => 'Shipment status retrieved successfully',
            'shipmentId' => $shipmentId,
            'status' => $status,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Simula o cancelamento de um envio.
     *
     * @param string $shipmentId ID do envio.
     * @return array Resposta simulada do cancelamento.
     */
    public static function cancelShipment($shipmentId)
    {
        if (empty($shipmentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid shipment ID'
            ];
        }

        // Simula o cancelamento de um envio
        $success = rand(0, 1) == 1; // 50% chance de sucesso

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'Shipment cancelled successfully',
                'shipmentId' => $shipmentId,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Cancellation failed, please try again'
            ];
        }
    }

    /**
     * Simula o cálculo do custo do frete baseado no CEP.
     *
     * @param string $cep CEP para cálculo do frete.
     * @param float $weight Peso da encomenda em kg.
     * @return array Resposta simulada do cálculo do frete.
     */
    public static function calculateShippingCost($cep, $weight)
    {
        if (empty($cep) || $weight <= 0) {
            return [
                'status' => 'error',
                'message' => 'Invalid CEP or weight'
            ];
        }

        // Simula o cálculo do custo do frete
        $baseCost = 10.00; // Custo base
        $costPerKg = 5.00; // Custo por kg
        $shippingCost = $baseCost + ($weight * $costPerKg);

        return [
            'status' => 'success',
            'message' => 'Shipping cost calculated successfully',
            'cep' => $cep,
            'weight' => $weight,
            'shippingCost' => number_format($shippingCost, 2),
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}
