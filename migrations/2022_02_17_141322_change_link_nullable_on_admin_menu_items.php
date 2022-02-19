<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
	public function up(){
		Schema::table('admin_menu_items', function (Blueprint $table){
			$table->string('link')->nullable()->change();
		});
	}
	public function down(){
		Schema::table('admin_menu_items', function (Blueprint $table){
			$table->string('link')->nullable(false)->change();
		});
	}
};
