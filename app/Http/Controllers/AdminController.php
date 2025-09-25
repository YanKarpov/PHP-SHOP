<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{

    /**
     * Get all orders
     */
    public function orders(): JsonResponse
    {
        // Fetch all orders with their associated user data
        // Newest first btw
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                // Transform each order into a standardized format
                return [
                    'id' => $order->id,
                    'user_name' => $order->user->name,
                    'user_email' => $order->user->email,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'order_items' => $order->order_items,
                    'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                ];
            });

        // Return standardized JSON response with success indicator
        // and order count for frontend pagination/display purposes
        return response()->json([
            'success' => true,
            'data' => $orders,
            'count' => $orders->count(),
        ]);
    }

    /**
     * Edit an existing order
     */
    public function editOrder(Request $request, Order $order): JsonResponse
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
                'total_amount' => 'required|numeric|min:0',
                'order_items' => 'required|array',
                'order_items.*.product_id' => 'required|integer|exists:products,id',
                'order_items.*.product_name' => 'required|string',
                'order_items.*.quantity' => 'required|integer|min:1',
                'order_items.*.price' => 'required|numeric|min:0',
            ]);

            // Update the order
            $order->update([
                'status' => $validated['status'],
                'total_amount' => $validated['total_amount'],
                'order_items' => $validated['order_items'],
            ]);

            // Load the updated order with user relationship
            $order->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => [
                    'id' => $order->id,
                    'user_name' => $order->user->name,
                    'user_email' => $order->user->email,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'order_items' => $order->order_items,
                    'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $order->updated_at->format('Y-m-d H:i:s'),
                ],
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete an order
     */
    public function deleteOrder(Order $order): JsonResponse
    {
        try {
            $orderId = $order->id;
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => "Order #{$orderId} deleted successfully",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order: ' . $e->getMessage(),
            ], 500);
        }
    }
}
