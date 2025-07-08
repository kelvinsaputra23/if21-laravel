class CreateProdiTable extends Migration
{
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('fakultas_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodi');
    }
}
