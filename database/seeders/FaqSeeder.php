<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        Faq::create([
            'question' => 'Quels sont les sites touristiques les plus visités ?',
            'answer' => 'Les sites les plus visités incluent la Porte du Non-Retour, la Place Goho, et la Chute de Tanougou.',
            'order' => 1,
        ]);

        Faq::create([
            'question' => 'Quels sont les meilleurs hôtels proches des sites touristiques ?',
            'answer' => 'Le Golden Tulip, Novotel et Nobila Airport Hotel sont parmi les meilleurs.',
            'order' => 2,
        ]);

        Faq::create([
            'question' => 'Quelles sont les spécialités culinaires locales ?',
            'answer' => 'Le Bénin est connu pour le "pâte\' rouge", l’igname pilée et le poisson braisé.',
            'order' => 3,
        ]);
    }
}
