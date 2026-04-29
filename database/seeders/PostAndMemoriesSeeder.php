<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostAndMemoriesSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'type' => 'news',
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c',
                'event_date' => now(),

                'translations' => [
                    'fr' => [
                        'title' => 'Conférence académique en France',
                        'description' => 'Une conférence internationale réunissant des chercheurs et diplômés pour échanger des idées innovantes.'
                    ],
                    'ar' => [
                        'title' => 'مؤتمر أكاديمي في فرنسا',
                        'description' => 'مؤتمر دولي يجمع الباحثين والخريجين لتبادل الأفكار المبتكرة.'
                    ],
                ]
            ],

            [
                'type' => 'news',
                'image' => 'https://images.unsplash.com/photo-1492724441997-5dc865305da7',
                'event_date' => now()->subDays(5),

                'translations' => [
                    'fr' => [
                        'title' => 'Signature d’un partenariat',
                        'description' => 'Signature d’un partenariat entre des institutions françaises et jordaniennes.'
                    ],
                    'ar' => [
                        'title' => 'توقيع اتفاقية تعاون',
                        'description' => 'تم توقيع اتفاقية تعاون بين مؤسسات فرنسية وأردنية.'
                    ],
                ]
            ],

            [
                'type' => 'memory',
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac',
                'event_date' => now()->subMonths(1),

                'translations' => [
                    'fr' => [
                        'title' => 'Rencontre des diplômés',
                        'description' => 'Un événement chaleureux réunissant les anciens diplômés.'
                    ],
                    'ar' => [
                        'title' => 'لقاء الخريجين',
                        'description' => 'فعالية مميزة جمعت الخريجين في أجواء ودية.'
                    ],
                ]
            ],

            [
                'type' => 'memory',
                'image' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754',
                'event_date' => now()->subMonths(2),

                'translations' => [
                    'fr' => [
                        'title' => 'Soirée culturelle',
                        'description' => 'Une soirée culturelle célébrant la diversité franco-jordanienne.'
                    ],
                    'ar' => [
                        'title' => 'أمسية ثقافية',
                        'description' => 'أمسية ثقافية تعكس التنوع بين الثقافة الفرنسية والأردنية.'
                    ],
                ]
            ],
        ];

        foreach ($posts as $p) {

            $post = Post::create([
                'type' => $p['type'],
                'image' => $p['image'],
                'event_date' => $p['event_date'],
            ]);

            foreach ($p['translations'] as $locale => $t) {
                $post->translations()->create([
                    'locale' => $locale,
                    'title' => $t['title'],
                    'description' => $t['description'],
                ]);
            }
        }
    }
}
