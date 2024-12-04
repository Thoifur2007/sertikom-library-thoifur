<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
     

  public function up(): void{Schema::create('pinjambukus', function (Blueprint $table) 
  {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('book_id')->constrained()->onDelete('cascade');
    $table->date('tanggal_pinjam');
    $table->date('tanggal_kembali')->nullable();
    $table->integer('sisa_hari')->nullable();  // Menambahkan kolom sisa_hari
    $table->string('status')->default('borrowed');
    $table->timestamps();});}

    
     

  public function down(): void{Schema::dropIfExists('pinjambukus');}
};