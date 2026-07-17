<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    private array $usedTitles = [];

    private array $usedSlugs = [];

    public function run(): void
    {
        if (User::count() === 0) {
            $this->command->error('Aucun utilisateur trouvé. Veuillez d\'abord créer des utilisateurs.');

            return;
        }

        if (PostCategory::count() === 0) {
            $this->command->error('Aucune catégorie trouvée. Veuillez d\'abord exécuter BlogCategorySeeder.');

            return;
        }

        $userIds = User::pluck('id')->toArray();
        $categoryIds = PostCategory::pluck('id')->toArray();

        $themes = [
            'agriculture' => [
                'titles' => [
                    'Techniques de culture du maïs en zone tropicale',
                    'L\'agroécologie pour une production durable',
                    'Gestion intégrée des sols agricoles',
                    'Irrigation : systèmes économes pour petits producteurs',
                    'Semences améliorées : atouts et précautions',
                ],
                'tags' => ['agriculture', 'maïs', 'agroécologie', 'sol', 'irrigation'],
            ],
            'elevage' => [
                'titles' => [
                    'Élevage de poules pondeuses en milieu rural',
                    'Alimentation des bovins en saison sèche',
                    'Prévention des maladies animales courantes',
                    'Mise en place d\'un élevage caprin',
                    'Production de fourrage de qualité',
                ],
                'tags' => ['élevage', 'bovins', 'caprins', 'aviculture', 'santé animale'],
            ],
            'nutrition' => [
                'titles' => [
                    'Alimentation des nourrissons : les bonnes pratiques',
                    'Repas équilibrés pour femmes enceintes et allaitantes',
                    'Valorisation des protéines végétales',
                    'Démonstrations culinaires à base d\'aliments locaux',
                    'L\'importance de la diversification alimentaire',
                ],
                'tags' => ['nutrition', 'enfants', 'femmes enceintes', 'protéines', 'aliments locaux'],
            ],
            'projets' => [
                'titles' => [
                    'Projet de renforcement de la résilience à Luiza',
                    'Bilan du programme de nutrition sensible',
                    'Construction d\'entrepôts communautaires à Gemena',
                    'Formation des coopératives agricoles au Kasaï Central',
                    'Distribution de kits AGR : impact sur les bénéficiaires',
                ],
                'tags' => ['projets', 'résilience', 'nutrition', 'entrepôts', 'coopératives'],
            ],
            'formation' => [
                'titles' => [
                    'Atelier sur la gestion post-récolte',
                    'Formation en alphabétisation fonctionnelle',
                    'Sensibilisation à la nutrition infantile',
                    'Atelier de fabrication de foyers améliorés',
                    'Formation en entrepreneurial agricole',
                ],
                'tags' => ['formation', 'alphabétisation', 'nutrition', 'foyers améliorés', 'entrepreneuriat'],
            ],
            'temoignages' => [
                'titles' => [
                    'Histoire de Marie, productrice à Luiza',
                    'Témoignage de Jean, bénéficiaire du projet',
                    'Retour d\'expérience d\'une coopérative',
                    'Impact du programme sur la vie des femmes',
                    'Paroles de partenaires : PAM et CADERSA',
                ],
                'tags' => ['témoignage', 'bénéficiaire', 'coopérative', 'femmes', 'partenaires'],
            ],
            'environnement' => [
                'titles' => [
                    'Reboisement communautaire : bilan de la campagne',
                    'Lutte antiérosive : techniques efficaces',
                    'Agroforesterie pour préserver la biodiversité',
                    'Gestion durable des déchets agricoles',
                    'Adaptation aux changements climatiques',
                ],
                'tags' => ['environnement', 'reboisement', 'antiérosive', 'agroforesterie', 'climat'],
            ],
            'partenariats' => [
                'titles' => [
                    'Collaboration avec le PAM pour la sécurité alimentaire',
                    'Appui de la FAO à l\'agriculture familiale',
                    'Partenariat avec le gouvernement congolais',
                    'Synergie avec les ONG locales',
                    'Coopération internationale pour le développement rural',
                ],
                'tags' => ['partenariat', 'PAM', 'FAO', 'gouvernement', 'ONG'],
            ],
        ];

        $postsCrees = 0;

        foreach ($themes as $themeKey => $theme) {
            foreach ($theme['titles'] as $title) {
                if (in_array($title, $this->usedTitles)) {
                    continue;
                }
                $this->usedTitles[] = $title;

                $numCategories = rand(1, 3);
                $categories = (array) array_rand(array_flip($categoryIds), min($numCategories, count($categoryIds)));

                do {
                    $slug = Str::slug($title);
                    if (in_array($slug, $this->usedSlugs)) {
                        $slug .= '-'.rand(100, 999);
                    }
                } while (in_array($slug, $this->usedSlugs) || Post::where('slug', $slug)->exists());
                $this->usedSlugs[] = $slug;

                $statuses = ['draft', 'published', 'archived'];
                $status = $statuses[array_rand($statuses)];
                $isPinned = rand(0, 9) === 0;

                $publishedAt = null;
                $scheduledFor = null;
                $expiresAt = null;

                if ($status === 'published') {
                    $publishedAt = Carbon::now()->subDays(rand(0, 90));
                } elseif ($status === 'draft' && rand(0, 4) === 0) {
                    $scheduledFor = Carbon::now()->addDays(rand(1, 30));
                } elseif ($status === 'archived') {
                    $publishedAt = Carbon::now()->subMonths(rand(6, 24));
                    $expiresAt = Carbon::now()->subMonths(rand(1, 3));
                }

                $post = Post::create([
                    'user_id' => $userIds[array_rand($userIds)],
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $this->generateExcerpt($title),
                    'content' => $this->generateLongContent($themeKey),
                    'metadata' => [
                        'author_bio' => 'Contributeur de CADERSA',
                        'difficulty' => ['Débutant', 'Intermédiaire', 'Avancé'][array_rand(['Débutant', 'Intermédiaire', 'Avancé'])],
                    ],
                    'status' => $status,
                    'is_pinned' => $isPinned,
                    'views_count' => $status === 'published' ? rand(50, 50000) : 0,
                    'likes_count' => $status === 'published' ? rand(5, 200) : 0,
                    'comments_count' => $status === 'published' ? rand(0, 50) : 0,
                    'meta_title' => $title.' | CADERSA',
                    'meta_description' => Str::limit('Article traitant de '.strtolower($title), 160),
                    'meta_keywords' => implode(',', $theme['tags']),
                    'published_at' => $publishedAt,
                    'scheduled_for' => $scheduledFor,
                    'expires_at' => $expiresAt,
                ]);

                $tagIds = [];
                foreach ($theme['tags'] as $tagName) {
                    $tagSlug = Str::slug($tagName);
                    $tag = Tag::firstOrCreate(
                        ['slug' => $tagSlug],
                        [
                            'id' => (string) Str::uuid(),
                            'name' => ['en' => $tagName],
                            'type' => 'default',
                            'order_column' => 0,
                        ]
                    );
                    $tagIds[] = $tag->id;
                }
                $post->tags()->sync($tagIds);

                $syncData = [];
                foreach ($categories as $index => $categoryId) {
                    $syncData[$categoryId] = [
                        'est_principale' => ($index === 0),
                        'ordre' => $index,
                    ];
                }
                $post->categories()->sync($syncData);

                $postsCrees++;
            }
        }

        // Compléter jusqu'à 30 articles si nécessaire
        if (Post::count() < 30) {
            $remaining = 30 - Post::count();
            for ($i = 0; $i < $remaining; $i++) {
                do {
                    $title = 'Article complémentaire '.($i + 1);
                } while (in_array($title, $this->usedTitles));
                $this->usedTitles[] = $title;

                $categories = (array) array_rand(array_flip($categoryIds), min(2, count($categoryIds)));
                do {
                    $slug = Str::slug($title);
                    if (in_array($slug, $this->usedSlugs)) {
                        $slug .= '-'.rand(100, 999);
                    }
                } while (in_array($slug, $this->usedSlugs) || Post::where('slug', $slug)->exists());
                $this->usedSlugs[] = $slug;

                $statuses = ['draft', 'published', 'archived'];
                $status = $statuses[array_rand($statuses)];
                $publishedAt = null;
                if ($status === 'published') {
                    $publishedAt = Carbon::now()->subDays(rand(0, 90));
                }

                $post = Post::create([
                    'user_id' => $userIds[array_rand($userIds)],
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $this->generateExcerpt($title),
                    'content' => $this->generateRandomContent(),
                    'metadata' => [],
                    'status' => $status,
                    'is_pinned' => false,
                    'views_count' => rand(10, 1000),
                    'likes_count' => rand(0, 20),
                    'comments_count' => rand(0, 5),
                    'meta_title' => $title,
                    'meta_description' => Str::limit('Article complémentaire '.($i + 1), 160),
                    'meta_keywords' => implode(',', ['article', 'complémentaire', 'cadersa']),
                    'published_at' => $publishedAt,
                    'scheduled_for' => null,
                    'expires_at' => null,
                ]);

                $tags = ['article', 'complémentaire', 'cadersa'];
                $tagIds = [];
                foreach ($tags as $tagName) {
                    $tagSlug = Str::slug($tagName);
                    $tag = Tag::firstOrCreate(
                        ['slug' => $tagSlug],
                        [
                            'id' => (string) Str::uuid(),
                            'name' => ['en' => $tagName],
                            'type' => 'default',
                            'order_column' => 0,
                        ]
                    );
                    $tagIds[] = $tag->id;
                }
                $post->tags()->sync($tagIds);

                $syncData = [];
                foreach ($categories as $index => $categoryId) {
                    $syncData[$categoryId] = [
                        'est_principale' => ($index === 0),
                        'ordre' => $index,
                    ];
                }
                $post->categories()->sync($syncData);

                $postsCrees++;
            }
        }

        $this->command->info("✅ {$postsCrees} articles de blog créés avec succès.");
    }

    private function generateExcerpt(string $title): array
    {
        $intros = ['Découvrez dans cet article', 'Guide complet sur', 'Tout ce qu\'il faut savoir sur', 'Analyse de', 'Nos conseils pour'];
        $intro = $intros[array_rand($intros)];
        $subject = str_replace(['Comment ', 'Pourquoi ', 'Guide ', 'Les '], '', $title);
        $subject = strtolower($subject);

        $text = $intro.' '.$subject.'. Un contenu riche et informatif pour mieux comprendre les enjeux du développement rural.';

        return [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        ['type' => 'text', 'text' => $text],
                    ],
                ],
            ],
        ];
    }

    private function generateLongContent(string $themeKey): array
    {
        $nodes = [];
        $numParagraphs = rand(8, 15);

        $leadTexts = [
            'agriculture' => 'L\'agriculture reste le pilier fondamental de la sécurité alimentaire en République Démocratique du Congo.',
            'elevage' => 'L\'élevage familial constitue une source essentielle de protéines et de revenus pour les communautés rurales.',
            'nutrition' => 'Une alimentation équilibrée est la clé d\'une bonne santé, surtout pour les enfants et les femmes enceintes.',
            'projets' => 'Les projets de développement rural visent à améliorer durablement les conditions de vie des populations.',
            'formation' => 'Le renforcement des capacités permet aux communautés de s\'approprier les techniques innovantes.',
            'temoignages' => 'Les témoignages des bénéficiaires illustrent l\'impact concret des actions sur le terrain.',
            'environnement' => 'La protection de l\'environnement est indissociable du développement rural durable.',
            'partenariats' => 'Les partenariats stratégiques permettent de mutualiser les ressources et les expertises.',
        ];

        $nodes[] = [
            'type' => 'paragraph',
            'attrs' => ['class' => 'lead'],
            'content' => [
                ['type' => 'text', 'text' => $leadTexts[$themeKey] ?? $leadTexts['agriculture']],
            ],
        ];

        for ($i = 0; $i < $numParagraphs; $i++) {
            if ($i % 3 === 0 && $i > 0) {
                $headings = ['Contexte et enjeux', 'Méthodologie adoptée', 'Résultats obtenus', 'Leçons apprises', 'Perspectives d\'avenir', 'Recommandations', 'Facteurs clés de succès'];
                $nodes[] = [
                    'type' => 'heading',
                    'attrs' => ['level' => 2],
                    'content' => [
                        ['type' => 'text', 'text' => $headings[$i % count($headings)]],
                    ],
                ];
            }

            if ($i % 5 === 0) {
                $listItems = [];
                for ($j = 0; $j < rand(3, 6); $j++) {
                    $listItems[] = [
                        'type' => 'listItem',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    ['type' => 'text', 'text' => 'Point essentiel concernant '.$themeKey.' ('.($j + 1).')'],
                                ],
                            ],
                        ],
                    ];
                }
                $nodes[] = [
                    'type' => 'bulletList',
                    'content' => $listItems,
                ];
            }

            $paragraphs = [
                'Les actions menées dans ce domaine ont démontré leur efficacité sur le terrain, avec des résultats tangibles observés au sein des communautés bénéficiaires.',
                'La participation active des populations locales constitue un facteur déterminant pour la réussite et la durabilité des interventions.',
                'Les partenaires techniques et financiers ont apporté un soutien précieux, permettant de déployer des ressources adaptées aux besoins identifiés.',
                'Les formations dispensées ont permis aux producteurs d\'acquérir des compétences nouvelles, directement applicables dans leurs activités quotidiennes.',
                'Le suivi régulier des activités a permis d\'ajuster les stratégies en fonction des réalités du terrain et des retours des bénéficiaires.',
            ];
            $nodes[] = [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => $paragraphs[$i % count($paragraphs)]],
                ],
            ];

            if ($i % 7 === 0) {
                $quotes = [
                    'Cette initiative a transformé notre façon de travailler la terre. — Témoignage d\'un bénéficiaire',
                    'Grâce à cette formation, j\'ai pu diversifier mes cultures et améliorer mes rendements. — Producteur local',
                    'Le soutien reçu nous a permis de créer une coopérative solide et autonome. — Membre d\'une OP',
                ];
                $nodes[] = [
                    'type' => 'blockquote',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                ['type' => 'text', 'text' => $quotes[array_rand($quotes)]],
                            ],
                        ],
                    ],
                ];
            }
        }

        $nodes[] = [
            'type' => 'heading',
            'attrs' => ['level' => 2],
            'content' => [
                ['type' => 'text', 'text' => 'Conclusion'],
            ],
        ];
        $nodes[] = [
            'type' => 'paragraph',
            'content' => [
                ['type' => 'text', 'text' => 'Les actions du CADERSA continuent de porter des fruits dans les communautés rurales. L\'engagement des équipes et le soutien des partenaires restent essentiels pour relever les défis à venir.'],
            ],
        ];

        return [
            'type' => 'doc',
            'content' => $nodes,
        ];
    }

    private function generateRandomContent(): array
    {
        $nodes = [];
        $numParagraphs = rand(5, 12);

        for ($i = 0; $i < $numParagraphs; $i++) {
            if ($i % 4 === 0 && $i > 0) {
                $nodes[] = [
                    'type' => 'heading',
                    'attrs' => ['level' => 2],
                    'content' => [
                        ['type' => 'text', 'text' => 'Section '.($i / 4 + 1)],
                    ],
                ];
            }

            $nodes[] = [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'Contenu informatif sur les activités de développement rural menées par le CADERSA.'],
                ],
            ];
        }

        return [
            'type' => 'doc',
            'content' => $nodes,
        ];
    }
}
