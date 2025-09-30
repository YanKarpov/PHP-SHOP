<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixMenuItemsTableColumns extends Migration
{
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'position') && !Schema::hasColumn('menu_items', 'sort_order')) {
                $table->renameColumn('position', 'sort_order');
            }

            if (!Schema::hasColumn('menu_items', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('url');
            }
        });
    }

    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'sort_order') && !Schema::hasColumn('menu_items', 'position')) {
                $table->renameColumn('sort_order', 'position');
            }
            
            if (Schema::hasColumn('menu_items', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
}