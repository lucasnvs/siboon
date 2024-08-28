<?php

/**
 * Class PaymentService
 *
 * Simulates a payment processing service. Provides methods to process, cancel, and check the status of payments.
 */
class PaymentService
{
    /**
     * Processes a simulated payment.
     *
     * @param string $orderId The order ID to be paid.
     * @param float $amount The payment amount in Brazilian reais.
     *
     * @return array The result of the payment processing, including status and message.
     *
     * @throws InvalidArgumentException If the order ID is empty or the payment amount is less than or equal to zero.
     */
    public static function processPayment($orderId, $amount)
    {
        // Validates input data
        if (empty($orderId) || $amount <= 0) {
            return [
                'status' => 'error',
                'message' => 'Invalid order ID or amount'
            ];
        }

        // Simulates payment processing
        $paymentId = uniqid('pay_', true);
        $success = rand(0, 1) == 1; // 50% chance of success

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
     * Cancels a simulated payment.
     *
     * @param string $paymentId The payment ID to be canceled.
     *
     * @return array The result of the payment cancellation, including status and message.
     *
     * @throws InvalidArgumentException If the payment ID is empty.
     */
    public static function cancelPayment($paymentId)
    {
        // Validates the payment ID
        if (empty($paymentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid payment ID'
            ];
        }

        // Simulates payment cancellation
        $success = rand(0, 1) == 1; // 50% chance of success

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
     * Checks the status of a simulated payment.
     *
     * @param string $paymentId The payment ID to be checked.
     *
     * @return array The result of the payment status check, including status and message.
     *
     * @throws InvalidArgumentException If the payment ID is empty.
     */
    public static function checkPaymentStatus($paymentId)
    {
        // Validates the payment ID
        if (empty($paymentId)) {
            return [
                'status' => 'error',
                'message' => 'Invalid payment ID'
            ];
        }

        // Simulates payment status check
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
