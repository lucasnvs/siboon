<?php

/**
 * Class PaymentService
 *
 * Simula um serviço de processamento de pagamentos. Oferece métodos para processar, cancelar e verificar o status de pagamentos.
 */
class PaymentService
{
    /**
     * Processa um pagamento simulado.
     *
     * @param string $orderId ID do pedido a ser pago.
     * @param float $amount Valor do pagamento em reais.
     *
     * @return array Resultado do processamento do pagamento, incluindo status e mensagem.
     *
     * @throws InvalidArgumentException Se o ID do pedido estiver vazio ou o valor do pagamento for menor ou igual a zero.
     */
    public static function processPayment($orderId, $amount)
    {
        // Valida os dados de entrada
        if (empty($orderId) || $amount <= 0) {
            return [
                'status' => 'error',
                'message' => 'Invalid order ID or amount'
            ];
        }

        // Simula um processamento de pagamento
        $paymentId = uniqid('pay_', true);
        $success = rand(0, 1) == 1; // 50% chance de sucesso

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'Payment processed successfully',
                'paymentId' => $paymentId,
                'orderId' => $orderId,
                'amount' => $amount,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Payment failed, please try again'
            ];
        }
    }

    /**
     * Cancela um pagamento simulado.
     *
     * @param string $paymentId ID do pagamento a ser cancelado.
     *
     * @return array Resultado do cancelamento do pagamento, incluindo status e mensagem.
     *
     * @throws InvalidArgumentException Se o ID do pagamento estiver vazio.
     */
    public static function cancelPayment($paymentId)
    {
        // Valida o ID do pagamento
        if (empty($paymentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid payment ID'
            ];
        }

        // Simula um cancelamento de pagamento
        $success = rand(0, 1) == 1; // 50% chance de sucesso

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'Payment cancelled successfully',
                'paymentId' => $paymentId,
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
     * Verifica o status de um pagamento simulado.
     *
     * @param string $paymentId ID do pagamento a ser verificado.
     *
     * @return array Resultado da verificação do status do pagamento, incluindo status e mensagem.
     *
     * @throws InvalidArgumentException Se o ID do pagamento estiver vazio.
     */
    public static function checkPaymentStatus($paymentId)
    {
        // Valida o ID do pagamento
        if (empty($paymentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid payment ID'
            ];
        }

        // Simula uma verificação de status de pagamento
        $status = rand(0, 1) == 1 ? 'completed' : 'pending';

        return [
            'status' => 'success',
            'message' => 'Payment status retrieved successfully',
            'paymentId' => $paymentId,
            'status' => $status,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}
