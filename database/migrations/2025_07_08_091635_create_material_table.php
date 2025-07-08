class CreateMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material');
    }
}
