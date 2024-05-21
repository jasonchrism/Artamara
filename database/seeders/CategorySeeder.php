<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_id' => '1',
                'name' => 'Realism',
                'Description' => 'Realism is an artistic movement that emerged in the mid-19th century in France in response to Romanticism. It emphasized the depiction of everyday life and subjects in a realistic and objective manner. Realist artists rejected the idealized forms and dramatic subject matter of Romanticism, and instead focused on portraying the world around them in a truthful and unbiased way.'
            ],
            [
                'category_id' => '2',
                'name' => 'PhotoRealism',
                'Description' => 'Photorealism is an art form that emerged in the late 1960s and early 1970s. It is a branch of realism that strives to reproduce a photograph in a painting or other medium with a high degree of accuracy and detail. Photorealist artists often use photographs as source material, and they meticulously recreate the image using techniques such as airbrushing, pencil drawing, and oil painting.'
            ],
            [
                'category_id' => '3',
                'name' => 'Expressionism',
                'Description' => 'Expressionism  was an artistic movement that originated in early 20th-century Germany. It emerged as a reaction to the naturalism and realism movements that dominated 19th-century art. Expressionist artists sought to express their emotional experience rather than portray objective reality. They distorted forms, used vivid colors, and applied paint in unconventional ways to convey their inner feelings and ideas.'
            ],
            [
                'category_id' => '4',
                'name' => 'Impressionism',
                'Description' => 'Impressionism is a painting style most commonly associated with the 19th century where small brush strokes are used to build up a larger picture. This art style lies somewhere between expressionism and realism, with a focus on accurate lighting but with no emphasis on a realistic scene.'
            ],
            [
                'category_id' => '5',
                'name' => 'Abstract',
                'Description' => 'Abstract painting eschew realism altogether. Whatever the subject in the painting, it may not be accurately represented at all in the artwork. Objects may be represented by a colour or a shape instead, with the interpretation left up to the viewer. The impact of an abstract painting cannot be understated, with many using shocking displays of colour and form to dizzy the senses.'
            ],
            [
                'category_id' => '6',
                'name' => 'Surealism',
                'Description' => 'Surrealism first became a movement in the 20th century, with artists such as Salvador Dali becoming household names. Combining abstract concepts with semi-realistic objects that have been twisted or morphed into something unusual, they can be illogical or dreamlike, giving the viewer a heightened sense of reality.'
            ],
            [
                'category_id' => '7',
                'name' => 'Pop Art',
                'Description' => 'In the 1950s and onwards, pop art became a movement that drew inspiration from the commodification and commercialism of modern life. Using cartoons or adverts in many of the styles most famous works, pop art uses realistic imagery combined with bold colours to highlight the artists intent.'
            ],
        ]);
    }
}
