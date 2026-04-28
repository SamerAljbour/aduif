<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('management_translations')->delete();
        DB::table('managements')->delete();

        // ══════════════════════════════════════════════════════════
        //  BUREAU ACTUEL
        // ══════════════════════════════════════════════════════════

        // ── 1. Président ─────────────────────────────────────────
        $president = $this->insert('president', null, 1, 'president@club.jo', 'current');
        $this->translate($president, [
            'ar' => [
                'name' => 'أحمد محمد الخالدي',
                'bio'  => 'يتولى رئاسة النادي منذ عام 2020، وله خبرة تزيد عن خمسة عشر عاماً في إدارة المنظمات الرياضية والثقافية. حقق خلال فترة رئاسته إنجازات بارزة على المستوى المحلي والإقليمي، وأشرف على إطلاق أكثر من عشرين مبادرة تنموية.',
            ],
            'fr' => [
                'name' => 'Ahmad Mohammad Al-Khalidi',
                'bio'  => 'Président du club depuis 2020, il possède plus de quinze ans d\'expérience dans la gestion d\'organisations sportives et culturelles. Il a réalisé des accomplissements remarquables aux niveaux local et régional, supervisant le lancement de plus de vingt initiatives de développement.',
            ],
        ]);

        // ── 2. Vice-présidents (DEUX) ────────────────────────────
        $vp1 = $this->insert('vice_president', $president, 1, 'vp1@club.jo', 'current');
        $this->translate($vp1, [
            'ar' => [
                'name' => 'سارة عبدالله النعيمي',
                'bio'  => 'نائبة الرئيس للشؤون الداخلية، مسؤولة عن التنسيق بين اللجان وإدارة الاجتماعات الدورية. تحمل ماجستير في إدارة الأعمال وخبرة عملية تزيد عن عشر سنوات في القطاع غير الربحي.',
            ],
            'fr' => [
                'name' => 'Sara Abdullah Al-Nuaimi',
                'bio'  => 'Vice-présidente aux affaires internes, chargée de la coordination entre les comités et de la gestion des réunions périodiques. Titulaire d\'un MBA avec plus de dix ans d\'expérience dans le secteur à but non lucratif.',
            ],
        ]);

        $vp2 = $this->insert('vice_president', $president, 2, 'vp2@club.jo', 'current');
        $this->translate($vp2, [
            'ar' => [
                'name' => 'محمد راشد العتيبي',
                'bio'  => 'نائب الرئيس للشؤون الخارجية والعلاقات العامة، يتولى تمثيل النادي في المحافل الدولية والمفاوضات الرسمية. يحمل دكتوراه في العلاقات الدولية.',
            ],
            'fr' => [
                'name' => 'Mohammad Rashed Al-Otaibi',
                'bio'  => 'Vice-président aux affaires extérieures et aux relations publiques, il représente le club dans les forums internationaux et les négociations officielles. Titulaire d\'un doctorat en Relations Internationales.',
            ],
        ]);

        // ── 3. Secrétaires (TROIS) ───────────────────────────────
        $sec1 = $this->insert('secretary', $vp1, 1, 'secretary1@club.jo', 'current');
        $this->translate($sec1, [
            'ar' => [
                'name' => 'خالد يوسف المصري',
                'bio'  => 'أمين السر الأول المسؤول عن توثيق محاضر الاجتماعات وإدارة المراسلات الرسمية. يمتلك خلفية قانونية متينة وخبرة تزيد عن ثماني سنوات في إدارة الوثائق المؤسسية.',
            ],
            'fr' => [
                'name' => 'Khalid Yousef Al-Masri',
                'bio'  => 'Premier secrétaire chargé de la documentation des procès-verbaux et de la gestion de la correspondance officielle. Solide formation juridique et plus de huit ans d\'expérience en gestion documentaire institutionnelle.',
            ],
        ]);

        $sec2 = $this->insert('secretary', $vp1, 2, 'secretary2@club.jo', 'current');
        $this->translate($sec2, [
            'ar' => [
                'name' => 'نور محمد البكري',
                'bio'  => 'أمينة السر الثانية مسؤولة عن الأرشفة الإلكترونية وإدارة قواعد بيانات الأعضاء. متخصصة في تقنية المعلومات وإدارة الأنظمة الرقمية.',
            ],
            'fr' => [
                'name' => 'Nour Mohammad Al-Bakri',
                'bio'  => 'Deuxième secrétaire responsable de l\'archivage électronique et de la gestion des bases de données des membres. Spécialisée en informatique et administration des systèmes numériques.',
            ],
        ]);

        $sec3 = $this->insert('secretary', $vp2, 1, 'secretary3@club.jo', 'current');
        $this->translate($sec3, [
            'ar' => [
                'name' => 'ريم سلطان الدوسري',
                'bio'  => 'أمينة السر للشؤون الخارجية، تتولى صياغة المراسلات الدبلوماسية والتقارير الموجهة للجهات الرسمية. تتقن أربع لغات وتحمل بكالوريوس في الترجمة والعلاقات الدولية.',
            ],
            'fr' => [
                'name' => 'Reem Sultan Al-Dosari',
                'bio'  => 'Secrétaire aux affaires extérieures, elle rédige la correspondance diplomatique et les rapports destinés aux instances officielles. Maîtrise quatre langues et est titulaire d\'une licence en Traduction et Relations Internationales.',
            ],
        ]);

        // ── 4. Trésoriers (DEUX) ─────────────────────────────────
        $tr1 = $this->insert('treasurer', $sec1, 1, 'treasurer1@club.jo', 'current');
        $this->translate($tr1, [
            'ar' => [
                'name' => 'منى حسن الزيدي',
                'bio'  => 'محاسبة قانونية معتمدة تشرف على الميزانية العامة وإعداد التقارير المالية الدورية. خبرة تزيد عن ثماني سنوات في القطاع غير الربحي وإدارة صناديق المنح.',
            ],
            'fr' => [
                'name' => 'Mona Hassan Al-Zaidi',
                'bio'  => 'Comptable agréée supervisant le budget général et la préparation des rapports financiers périodiques. Plus de huit ans d\'expérience dans le secteur à but non lucratif et la gestion de fonds de subventions.',
            ],
        ]);

        $tr2 = $this->insert('treasurer', $sec1, 2, 'treasurer2@club.jo', 'current');
        $this->translate($tr2, [
            'ar' => [
                'name' => 'فيصل عمر الرشيد',
                'bio'  => 'يتولى متابعة عمليات الصرف والإيراد وإعداد الميزانية التقديرية السنوية. خبير مالي معتمد سبق له العمل في عدد من المؤسسات المالية الكبرى.',
            ],
            'fr' => [
                'name' => 'Faisal Omar Al-Rashid',
                'bio'  => 'Supervise les opérations de dépenses et de recettes et élabore le budget prévisionnel annuel. Expert financier certifié ayant travaillé auparavant dans plusieurs grandes institutions financières.',
            ],
        ]);

        // ── 5. Membres du conseil (SIX) ──────────────────────────
        $membresConseil = [
            [
                'order' => 1,
                'email' => 'board1@club.jo',
                'ar' => [
                    'name' => 'عمر فيصل الحربي',
                    'bio'  => 'عضو هيئة إدارية متخصص في الشؤون الرياضية والتدريب. أشرف على تنظيم أكثر من خمس عشرة بطولة محلية وإقليمية، ويعمل حالياً على تطوير برامج اكتشاف المواهب الشبابية.'
                ],
                'fr' => [
                    'name' => 'Omar Faisal Al-Harbi',
                    'bio'  => 'Membre du conseil spécialisé dans les affaires sportives et la formation. A supervisé plus de quinze tournois locaux et régionaux et développe actuellement des programmes de détection de jeunes talents.'
                ],
            ],
            [
                'order' => 2,
                'email' => 'board2@club.jo',
                'ar' => [
                    'name' => 'ليلى إبراهيم القاسم',
                    'bio'  => 'عضوة هيئة إدارية مسؤولة عن الأنشطة الثقافية والتطوعية. تعمل على تعزيز الشراكات المجتمعية وتنظيم الفعاليات الثقافية والمهرجانات السنوية للنادي.'
                ],
                'fr' => [
                    'name' => 'Layla Ibrahim Al-Qasim',
                    'bio'  => 'Membre du conseil responsable des activités culturelles et bénévoles. Renforce les partenariats communautaires et organise les événements culturels et les festivals annuels du club.'
                ],
            ],
            [
                'order' => 3,
                'email' => 'board3@club.jo',
                'ar' => [
                    'name' => 'ناصر علي الشمري',
                    'bio'  => 'عضو هيئة إدارية متخصص في الشؤون القانونية والتنظيمية. يتولى مراجعة العقود والاتفاقيات، وسبق له العمل مستشاراً قانونياً في عدة مؤسسات حكومية.'
                ],
                'fr' => [
                    'name' => 'Nasser Ali Al-Shammari',
                    'bio'  => 'Membre du conseil spécialisé dans les affaires juridiques et réglementaires. Examine les contrats et conventions, a précédemment exercé en tant que conseiller juridique dans plusieurs institutions gouvernementales.'
                ],
            ],
            [
                'order' => 4,
                'email' => 'board4@club.jo',
                'ar' => [
                    'name' => 'هند طارق المنصور',
                    'bio'  => 'عضوة هيئة إدارية مسؤولة عن ملف التسويق والتواصل الرقمي. طوّرت الحضور الرقمي للنادي وضاعفت قاعدة متابعيه على منصات التواصل الاجتماعي ثلاث مرات خلال عامين.'
                ],
                'fr' => [
                    'name' => 'Hind Tariq Al-Mansour',
                    'bio'  => 'Membre du conseil responsable du marketing et de la communication numérique. A développé la présence en ligne du club et triplé sa communauté sur les réseaux sociaux en deux ans.'
                ],
            ],
            [
                'order' => 5,
                'email' => 'board5@club.jo',
                'ar' => [
                    'name' => 'بدر سعود الغامدي',
                    'bio'  => 'عضو هيئة إدارية متخصص في إدارة المشاريع والبنية التحتية. يشرف على مشاريع التطوير العمراني للنادي ويتابع تنفيذ الخطط الاستراتيجية طويلة الأمد.'
                ],
                'fr' => [
                    'name' => 'Badr Saud Al-Ghamdi',
                    'bio'  => 'Membre du conseil spécialisé en gestion de projets et en infrastructure. Supervise les projets de développement immobilier du club et assure le suivi des plans stratégiques à long terme.'
                ],
            ],
            [
                'order' => 6,
                'email' => 'board6@club.jo',
                'ar' => [
                    'name' => 'رنا جاسم الكواري',
                    'bio'  => 'عضوة هيئة إدارية مسؤولة عن شؤون الأعضاء وخدمات المجتمع. تعمل على تحسين تجربة الأعضاء وتطوير برامج الرعاية الاجتماعية والصحية للنادي.'
                ],
                'fr' => [
                    'name' => 'Rana Jasim Al-Kawari',
                    'bio'  => 'Membre du conseil responsable des affaires des membres et des services communautaires. Améliore l\'expérience des membres et développe les programmes de protection sociale et sanitaire du club.'
                ],
            ],
        ];

        foreach ($membresConseil as $m) {
            $id = $this->insert('board_member', $tr1, $m['order'], $m['email'], 'current');
            $this->translate($id, ['ar' => $m['ar'], 'fr' => $m['fr']]);
        }

        // ══════════════════════════════════════════════════════════
        //  ANCIEN BUREAU
        // ══════════════════════════════════════════════════════════

        $fmrPresident = $this->insert('president', null, 1, 'former.president@club.jo', 'former');
        $this->translate($fmrPresident, [
            'ar' => [
                'name' => 'يوسف ماجد السالم',
                'bio'  => 'تولى رئاسة النادي خلال الفترة 2015–2020. قاد النادي نحو الاحترافية وأسس أول أكاديمية رياضية متكاملة في تاريخ النادي.'
            ],
            'fr' => [
                'name' => 'Yousef Majed Al-Salem',
                'bio'  => 'A présidé le club de 2015 à 2020. Il a conduit le club vers le professionnalisme et fondé la première académie sportive intégrée de l\'histoire du club.'
            ],
        ]);

        $fmrVp = $this->insert('vice_president', $fmrPresident, 1, 'former.vp@club.jo', 'former');
        $this->translate($fmrVp, [
            'ar' => [
                'name' => 'عبدالرحمن ناصر القحطاني',
                'bio'  => 'نائب رئيس سابق أسهم في بناء شراكات استراتيجية مع عدد من الاتحادات الرياضية الدولية خلال فترة توليه المنصب.'
            ],
            'fr' => [
                'name' => 'Abdulrahman Nasser Al-Qahtani',
                'bio'  => 'Ancien vice-président ayant contribué à l\'établissement de partenariats stratégiques avec plusieurs fédérations sportives internationales durant son mandat.'
            ],
        ]);

        $fmrBoard = $this->insert('board_member', $fmrVp, 1, 'former.board@club.jo', 'former');
        $this->translate($fmrBoard, [
            'ar' => [
                'name' => 'جميلة حمد العجمي',
                'bio'  => 'عضوة هيئة إدارية سابقة أشرفت على إنشاء برنامج المنح الدراسية لأبناء الأعضاء الذي لا يزال قائماً حتى اليوم.'
            ],
            'fr' => [
                'name' => 'Jameela Hamad Al-Ajmi',
                'bio'  => 'Ancienne membre du conseil ayant supervisé la création du programme de bourses d\'études pour les enfants des membres, qui perdure encore aujourd\'hui.'
            ],
        ]);

        // ══════════════════════════════════════════════════════════
        //  MEMBRES D'HONNEUR
        // ══════════════════════════════════════════════════════════

        $hon1 = $this->insert('president', null, 1, null, 'honorary');
        $this->translate($hon1, [
            'ar' => [
                'name' => 'الأمير فهد بن سلمان',
                'bio'  => 'عضو شرفي فخري للنادي، قدّم دعماً لا محدوداً لمسيرة النادي على مدار عقدين من الزمن.'
            ],
            'fr' => [
                'name' => 'Prince Fahd bin Salman',
                'bio'  => 'Membre honoraire du club, il a apporté un soutien indéfectible au parcours du club pendant deux décennies.'
            ],
        ]);

        $hon2 = $this->insert('board_member', null, 1, 'honorary2@club.jo', 'honorary');
        $this->translate($hon2, [
            'ar' => [
                'name' => 'د. سلوى إبراهيم الحمدان',
                'bio'  => 'عضو شرف تقديراً لإسهاماتها الأكاديمية في تطوير برامج الرياضة والصحة المجتمعية المرتبطة بالنادي.'
            ],
            'fr' => [
                'name' => 'Dr. Salwa Ibrahim Al-Hamdan',
                'bio'  => 'Membre honoraire en reconnaissance de ses contributions académiques au développement des programmes de santé communautaire et de sport affiliés au club.'
            ],
        ]);

        // ── Résumé ───────────────────────────────────────────────
        $this->command->info('✅  Hiérarchie des gestionnaires insérée (AR + FR).');
        $this->command->table(
            ['Type', 'Poste', 'Nom (AR)', 'Email'],
            [
                ['current',  'Président',                 'أحمد محمد الخالدي',       'president@club.jo'],
                ['current',  'Vice-président (1)',        'سارة عبدالله النعيمي',    'vp1@club.jo'],
                ['current',  'Vice-président (2)',        'محمد راشد العتيبي',       'vp2@club.jo'],
                ['current',  'Secrétaire (1)',            'خالد يوسف المصري',        'secretary1@club.jo'],
                ['current',  'Secrétaire (2)',            'نور محمد البكري',          'secretary2@club.jo'],
                ['current',  'Secrétaire (3)',            'ريم سلطان الدوسري',       'secretary3@club.jo'],
                ['current',  'Trésorier (1)',             'منى حسن الزيدي',          'treasurer1@club.jo'],
                ['current',  'Trésorier (2)',             'فيصل عمر الرشيد',         'treasurer2@club.jo'],
                ['current',  'Membre (1)',                'عمر فيصل الحربي',         'board1@club.jo'],
                ['current',  'Membre (2)',                'ليلى إبراهيم القاسم',     'board2@club.jo'],
                ['current',  'Membre (3)',                'ناصر علي الشمري',         'board3@club.jo'],
                ['current',  'Membre (4)',                'هند طارق المنصور',        'board4@club.jo'],
                ['current',  'Membre (5)',                'بدر سعود الغامدي',        'board5@club.jo'],
                ['current',  'Membre (6)',                'رنا جاسم الكواري',        'board6@club.jo'],
                ['former',   'Ancien président',          'يوسف ماجد السالم',        'former.president@club.jo'],
                ['former',   'Ancien vice-président',     'عبدالرحمن ناصر القحطاني', 'former.vp@club.jo'],
                ['former',   'Ancien membre',             'جميلة حمد العجمي',        'former.board@club.jo'],
                ['honorary', 'Président d\'honneur',      'الأمير فهد بن سلمان',     '—'],
                ['honorary', 'Membre d\'honneur',         'د. سلوى إبراهيم الحمدان', 'honorary2@club.jo'],
            ]
        );
    }

    // ── Helpers ───────────────────────────────────────────────────
    private function insert(
        string  $position,
        ?int    $parentId,
        int     $order,
        ?string $email,
        string  $type
    ): int {
        return DB::table('managements')->insertGetId([
            'position'   => $position,
            'parent_id'  => $parentId,
            'order'      => $order,
            'email'      => $email,
            'photo'      => null,
            'type'       => $type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function translate(int $id, array $locales): void
    {
        foreach ($locales as $locale => $data) {
            DB::table('management_translations')->insert([
                'management_id' => $id,
                'locale'        => $locale,
                'name'          => $data['name'],
                'bio'           => $data['bio'] ?? null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
