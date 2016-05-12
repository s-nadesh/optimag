<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->increments('about_us_id');
            $table->text('content_fr');
            $table->text('content_en');
            $table->timestamps();
        });
        DB::table('about_us')->insert([
            'content_fr' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ullamcorper libero sit amet est maximus consectetur. Suspendisse gravida turpis a aliquet maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce laoreet tortor nec enim tincidunt, varius accumsan est pharetra. Phasellus felis turpis, imperdiet a metus varius, ultricies semper nulla. Sed posuere nec est sit amet venenatis. Aliquam imperdiet placerat bibendum. Pellentesque egestas mi sit amet purus vehicula euismod. Vestibulum nisl eros, facilisis eu sodales vel, venenatis nec tortor. Nulla sed efficitur leo. Morbi sit amet viverra risus.
                              Nulla ut efficitur turpis. Aenean vitae elementum tellus, vitae mattis dui. Vestibulum pretium, neque nec facilisis condimentum, magna enim sodales lorem, quis dictum neque quam eu nulla. Aliquam nec varius tellus, ac ultricies orci. Nullam nunc orci, semper vitae consequat nec, euismod et nisl. Curabitur vehicula, dui nec iaculis porttitor, risus massa porta sem, et sodales nisl justo maximus tortor. Nam ac vehicula tellus. Phasellus ac placerat justo, sit amet tempus tellus. Nunc hendrerit sem at mauris hendrerit accumsan. Donec posuere eros ut arcu gravida dictum. Donec pretium dui nec aliquet consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ',
            'content_en' => ' Curabitur vitae dignissim velit. Curabitur non libero nec diam lobortis auctor et quis ante. Nulla vehicula libero at arcu sollicitudin vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean non quam a quam porttitor condimentum. Vivamus efficitur tellus lectus. Pellentesque nulla enim, elementum nec felis in, rhoncus placerat leo. Nullam varius nisl id magna convallis, nec vulputate purus blandit. Aenean et leo feugiat, fringilla quam at, varius arcu. Mauris vitae viverra elit. Phasellus et lectus massa. Nullam id libero ac diam congue volutpat. Nam mollis enim in urna malesuada viverra ut nec leo. Quisque interdum ornare risus, non auctor libero maximus at. Mauris vestibulum nunc nec enim elementum imperdiet. Proin ornare dictum bibendum.
                              Vivamus erat eros, gravida sit amet porttitor quis, imperdiet in nisi. Integer ac malesuada massa. Mauris quis quam placerat, iaculis arcu eu, semper neque. Nam enim sem, pretium at bibendum in, faucibus ut urna. Etiam lectus massa, volutpat sed nisl quis, feugiat vulputate ipsum. In ac urna mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eleifend, elit sit amet varius rutrum, odio turpis eleifend purus, vel viverra nulla velit in ipsum. Aenean volutpat a mauris quis aliquet. Nunc ac ultrices nisl. Proin non massa ultrices, condimentum lacus eu, faucibus arcu. Aliquam consequat faucibus rhoncus. Donec eget condimentum ante, dignissim ultrices lectus. Sed at mattis magna. Praesent commodo luctus neque in egestas. Nunc ipsum nisi, euismod ut felis ut, fermentum vehicula arcu. ',
                ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('about_us');
    }
}
