<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::table(

            'reviews',

            function (

                Blueprint $table

            ){

                $table

                ->foreignId(

                    'reviewed_user_id'

                )

                ->after(

                    'user_id'

                )

                ->nullable()

                ->constrained(

                    'users'

                );



                $table

                ->foreignId(

                    'rental_id'

                )

                ->after(

                    'item_id'

                )

                ->nullable()

                ->constrained();



            }

        );

    }

    public function down(): void
    {

        Schema::table(

            'reviews',

            function (

                Blueprint $table

            ){

                $table

                ->dropForeign([

                    'reviewed_user_id'

                ]);

                $table

                ->dropForeign([

                    'rental_id'

                ]);


                $table

                ->dropColumn(

                    'reviewed_user_id'

                );

                $table

                ->dropColumn(

                    'rental_id'

                );

            }

        );

    }

};