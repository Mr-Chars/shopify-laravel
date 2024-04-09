<?php

namespace App\Http\Controllers\Api\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public $shopifyTokenAccessPanel = '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';
    public $shopifyApiKey = '8fde63ee5203722dcf09202aa83e0bd4';
    public $shopifyBaseUrlApi = 'ecommercerisso.myshopify.com/admin/api';

    public function search()
    {
        $url = "https://$this->shopifyApiKey:$this->shopifyTokenAccessPanel@$this->shopifyBaseUrlApi/2024-04/products.json";
        try {
            $products = Http::get($url);
            $products = $products->json();
            return response()->json([
                'status' => true,
                'products' => $products['products'],
                'url' => $url,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Ocurrió un error',
            ]);
        }
    }

    public function add(Request $request)
    {
        $url = "https://$this->shopifyApiKey:$this->shopifyTokenAccessPanel@$this->shopifyBaseUrlApi/2024-04/products.json";

        $product = array(
            "product" => array(
                "title"        => "vapper 2",
                "body_html"    => "<strong>Description!</strong>",
                "vendor"       => "DC",
                "product_type" => "Test",
                "published"    => true,
                "variants"     => array(
                    array(
                        "option1"     => "modelo xx1",
                        "sku"     => "t_009",
                        "price"   => 20.00,
                        "grams"   => 200,
                        "taxable" => false,
                    ),
                    array(
                        "option1"     => "modelo xx2",
                        "sku"     => "t_009",
                        "price"   => 50.00,
                        "grams"   => 600,
                        "taxable" => true,
                    )
                )
            )
        );

        try {
            $productAdded = Http::post($url, $product);
            $productAdded = $productAdded->json();
            return response()->json([
                'status' => true,
                'response' => $productAdded,
            ]);
        } catch (\Throwable $th) {
            print_r($th);
            return;
        }
    }

    public function update(Request $request)
    {
        $idProductToUpdate = 7491955556388;
        $url = "https://$this->shopifyApiKey:$this->shopifyTokenAccessPanel@$this->shopifyBaseUrlApi/2024-04/products/$idProductToUpdate.json";

        $product = array(
            "product" => array(
                "title"        => "vapper 229",
                "body_html"    => "<strong>Description!</strong>",
                "vendor"       => "DC",
                "product_type" => "Test",
                "published"    => true,
                "variants"     => array(
                    array(
                        "option1"     => "modelo xx1",
                        "sku"     => "t_009",
                        "price"   => 20.00,
                        "grams"   => 200,
                        "taxable" => false,
                        "inventory_quantity" => 9,
                    ),
                    array(
                        "option1"     => "modelo xx2",
                        "sku"     => "t_009",
                        "price"   => 50.00,
                        "grams"   => 600,
                        "taxable" => true,
                        "inventory_quantity" => 12,
                    )
                )
            )
        );

        try {
            $productUpdated = Http::put($url, $product);
            $productUpdated = $productUpdated->json();
            return response()->json([
                'status' => true,
                'response' => $productUpdated,
            ]);
        } catch (\Throwable $th) {
            print_r($th);
            return;
        }
    }

    public function delete(Request $request)
    {
        $idProductToUpdate = 7491955097636;
        $url = "https://$this->shopifyApiKey:$this->shopifyTokenAccessPanel@$this->shopifyBaseUrlApi/2024-04/products/$idProductToUpdate.json";


        try {
            $productRemoved = Http::delete($url);
            $productRemoved = $productRemoved->json();
            return response()->json([
                'status' => true,
                'response' => $productRemoved,
            ]);
        } catch (\Throwable $th) {
            print_r($th);
            return;
        }
    }
}
