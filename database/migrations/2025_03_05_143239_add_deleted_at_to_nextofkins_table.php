<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToNextofkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('nextofkins', function (Blueprint $table) {
        $table->softDeletes(); // This will add the deleted_at column
    });
}

public function down()
{
    Schema::table('nextofkins', function (Blueprint $table) {
        $table->dropColumn('deleted_at'); // This will remove the deleted_at column if needed
    });
}

}
