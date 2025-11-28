<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    use RefreshDatabase; // Esto borra la BD de prueba cada vez para empezar limpio

    /**
     * Prueba para ver si podemos listar productos.
     */
    public function test_can_list_products()
    {
        // 1. Crear 3 productos falsos en la memoria
        Product::factory()->count(3)->create();

        // 2. Hacer una petición GET a la ruta de la API
        $response = $this->getJson('/api/products');

        // 3. Verificar que la respuesta sea 200 (OK)
        $response->assertStatus(200);

        // 4. Verificar que recibimos 3 productos
        $response->assertJsonCount(3);
    }

    /**
     * Prueba para ver si podemos crear un producto.
     */
    public function test_can_create_product()
    {
        // 1. Datos del producto a crear
        $data = [
            'sku' => 'TEST-001',
            'name' => 'Producto de Prueba',
            'price' => 100.50,
            'stock' => 10
        ];

        // 2. Enviar petición POST
        $response = $this->postJson('/api/products', $data);

        // 3. Verificar que se creó (Status 201)
        $response->assertStatus(201);

        // 4. Verificar que existe en la base de datos
        $this->assertDatabaseHas('products', ['sku' => 'TEST-001']);
    }
}