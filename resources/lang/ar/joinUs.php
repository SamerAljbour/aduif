<?php
return [
    'header' => [
        'tag' => 'طلب عضوية',
        'title' => 'انضم إلى شبكتنا',
        'desc' => 'قم بملء النموذج أدناه لإرسال طلب الانضمام. الحقول التي تحتوي على * مطلوبة.',
    ],

    'steps' => [
        'basic' => 'المعلومات الأساسية',
        'professional' => 'المعلومات المهنية',
        'documents' => 'الملفات',
        'review' => 'المراجعة',
    ],

    'buttons' => [
        'continue' => 'متابعة',
        'back' => 'رجوع',
        'review' => 'مراجعة',
        'submit' => 'إرسال الطلب',
    ],

    'fields' => [
        'name_fr' => 'الاسم الكامل (فرنسي)',
        'name_ar' => 'الاسم الكامل (عربي)',
        'email' => 'البريد الإلكتروني',
        'phone' => 'رقم الهاتف',
        'nationality' => 'الجنسية',
        'jordanian' => 'أردني',
        'non_jordanian' => 'غير أردني',
        'degree' => 'أعلى شهادة',
        'select_degree' => 'اختر الشهادة',
        'specialization_fr' => 'التخصص (فرنسي)',
        'specialization_ar' => 'التخصص (عربي)',
        'university_fr' => 'جامعة التخرج (فرنسي)',
        'university_ar' => 'جامعة التخرج (عربي)',
        'job_fr' => 'الوظيفة الحالية (فرنسي)',
        'job_ar' => 'الوظيفة الحالية (عربي)',
        'workplace_fr' => 'مكان العمل / المؤسسة (فرنسي)',
        'workplace_ar' => 'مكان العمل / المؤسسة (عربي)',
        'interests_fr' => 'مجالات الاهتمام (فرنسي)',
        'interests_ar' => 'مجالات الاهتمام (عربي)',
        'bio_fr' => 'نبذة قصيرة (فرنسي)',
        'bio_ar' => 'نبذة قصيرة (عربي)',
    ],

    'sections' => [
        'personal' => 'المعلومات الشخصية',
        'academic' => 'الخلفية الأكاديمية',
        'current_position' => 'المنصب الحالي',
        'about' => 'نبذة عنك',
        'profile_documents' => 'صورة الملف الشخصي والسيرة الذاتية',
    ],

    'placeholders' => [
        'name_fr' => 'Ahmad Al-Hassan',
        'name_ar' => 'أحمد الحسن',
        'email' => 'ahmad@example.com',
        'phone' => '+962 7X XXX XXXX',
        'specialization_fr' => 'مثلا Informatique',
        'specialization_ar' => 'مثلا علوم الحاسب',
        'university_fr' => 'مثلا Université Paris-Saclay',
        'university_ar' => 'مثلا جامعة باريس ساكلي',
        'job_fr' => 'مثلا Ingénieur senior',
        'job_ar' => 'مثلا مهندس أول',
        'workplace_fr' => 'مثلا Ministère de l’Éducation',
        'workplace_ar' => 'مثلا وزارة التربية والتعليم',
        'interests_fr' => 'مجالات البحث والهوايات والاهتمامات المهنية...',
        'interests_ar' => 'مجالات الاهتمام والبحث...',
        'bio_fr' => 'فقرة قصيرة للتعريف بنفسك للشبكة...',
        'bio_ar' => 'نبذة قصيرة عن نفسك للشبكة...',
    ],

    'upload' => [
        'photo_label' => 'صورة الملف الشخصي',
        'photo' => 'تحميل صورة',
        'photo_hint' => 'JPG, PNG, WEBP — الحد الأقصى 5 ميغابايت',
        'cv_label' => 'السيرة الذاتية',
        'cv' => 'تحميل السيرة الذاتية',
        'cv_hint' => 'PDF, DOC, DOCX — الحد الأقصى 10 ميغابايت',
        'docs' => 'ملفات إضافية',
        'docs_desc' => 'أرفق أي مستندات داعمة: شهادات، خطابات توصية، أوراق بحثية، وغيرها. يمكنك تحميل عدة ملفات مرة واحدة.',
        'docs_drop' => 'اسحب الملفات هنا أو انقر للتصفح',
        'docs_hint' => 'PDF, DOC, DOCX, JPG, PNG — الحد الأقصى 10 ميغابايت لكل ملف',
    ],

    'review' => [
        'title' => 'راجع طلبك',
        'personal' => 'المعلومات الشخصية',
        'professional' => 'المعلومات المهنية',
        'documents' => 'الملفات',
        'empty' => '—',
        'not_uploaded' => 'لم يتم التحميل',
        'none' => 'لا يوجد',
    ],

    'success' => [
        'title' => 'تم إرسال الطلب!',
        'desc' => 'شكراً لطلبك. سنقوم بمراجعته والرد عليك عبر البريد الإلكتروني خلال 3-5 أيام عمل.',
        'status' => 'الحالة: قيد المراجعة',
    ],

    'validation' => [
        'fix_errors' => 'يرجى تصحيح الأخطاء التالية:',
        'name_fr_required' => 'الاسم بالفرنسية مطلوب',
        'name_ar_required' => 'الاسم بالعربية مطلوب',
        'email_required' => 'البريد الإلكتروني الصحيح مطلوب',
        'file_too_large' => 'الملف :file يتجاوز 10 ميغابايت وتم تخطيه.',
    ],

    'actions' => [
        'remove' => 'إزالة',
    ],

    'units' => [
        'file' => 'ملف',
        'files' => 'ملفات',
        'selected' => 'محددة',
    ],
];
