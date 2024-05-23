<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_product_stock_after_insert
            AFTER INSERT ON inventory_details
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock + NEW.quantity
                WHERE id = NEW.product_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_product_stock_after_insert');
    }
};
