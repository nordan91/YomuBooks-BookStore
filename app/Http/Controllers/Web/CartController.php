<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems(auth()->id());

        // Mengambil data provinsi dari API Raja Ongkir
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        if ($response->failed()) {
            \Illuminate\Support\Facades\Log::error('RajaOngkir Error: ' . $response->body());
        }

        $provinces = $response->successful() ? ($response->json()['data'] ?? []) : [];

        return view('web.cart.index', compact('cartItems', 'provinces'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'qty' => 'required|integer|min:1',
        ]);

        $userId = auth()->id();
        $book = Book::findOrFail($request->book_id);
        $quantity = $request->qty;
        $price = $book->price;
        $bookImage = $book->images->first() ? $book->images->first()->image : 'https://via.placeholder.com/450x450?text=No+Image';
        $weight = $book->weight ?? 1; // Asumsi weight dalam gram

        $this->cartService->addToCart($userId, $book->id, $quantity, $price, $bookImage, $weight);

        return redirect()->route('cart.index')->with('success', 'Book added to cart!');
    }

    public function deleteCartItem($book_id)
    {
        $userId = auth()->id();
        if ($this->cartService->removeItemFromCart($userId, $book_id)) {
            return redirect()->back()->with('success', 'Item removed from cart.');
        }
        return redirect()->back()->with('error', 'Item not found in your cart.');
    }

    public function getCities(Request $request)
    {
        $provinceId = $request->query('province_id');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        return $response->successful() ? response()->json($response->json()['data'] ?? []) : response()->json([]);
    }

    public function getDistricts($cityId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        return $response->successful() ? response()->json($response->json()['data'] ?? []) : response()->json([]);
    }

    public function getShippingCost(Request $request)
    {
        $request->validate([
            'destination' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'courier' => 'required|string|in:jne,pos,tiki',
        ]);

        try {
            $originDistrictId = 1366; // Origin district ID
            $response = Http::asForm()->withHeaders([
                'Accept' => 'application/json',
                'key' => config('rajaongkir.api_key'),
            ])->post('https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost', [
                'origin' => $originDistrictId,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier,
                'price' => 'lowest',
            ]);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                if (empty($data)) {
                    return response()->json(['message' => 'No shipping options available'], 200);
                }
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Failed to fetch shipping cost: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
