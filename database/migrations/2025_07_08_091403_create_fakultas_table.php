class CreateFakultasTable extends Migration
{
    public function up()
    {
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fakultas');
    }
}
