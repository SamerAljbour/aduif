<?php
return [
    'header' => [
        'tag' => 'Demande d\'adhésion',
        'title' => 'Rejoignez notre réseau',
        'desc' => 'Remplissez le formulaire ci-dessous pour soumettre votre demande. Les champs marqués * sont obligatoires.',
    ],

    'steps' => [
        'basic' => 'Informations de base',
        'professional' => 'Professionnel',
        'documents' => 'Documents',
        'review' => 'Révision',
    ],

    'buttons' => [
        'continue' => 'Continuer',
        'back' => 'Retour',
        'review' => 'Réviser',
        'submit' => 'Soumettre la demande',
    ],

    'fields' => [
        'name_fr' => 'Nom et prénom (Français)',
        'name_ar' => 'Nom et prénom (Arabe)',
        'email' => 'Adresse email',
        'phone' => 'Numéro de téléphone',
        'nationality' => 'Nationalité',
        'jordanian' => 'Jordanien',
        'non_jordanian' => 'Non-Jordanien',
        'degree' => 'Diplôme le plus élevé',
        'select_degree' => 'Choisir le diplôme',
        'specialization_fr' => 'Spécialisation (Français)',
        'specialization_ar' => 'Spécialisation (Arabe)',
        'university_fr' => 'Université de diplomation (Français)',
        'university_ar' => 'Université de diplomation (Arabe)',
        'job_fr' => 'Poste actuel (Français)',
        'job_ar' => 'Poste actuel (Arabe)',
        'workplace_fr' => 'Lieu de travail / organisation (Français)',
        'workplace_ar' => 'Lieu de travail / organisation (Arabe)',
        'interests_fr' => 'Centres d’intérêt (Français)',
        'interests_ar' => 'Centres d’intérêt (Arabe)',
        'bio_fr' => 'Courte biographie (Français)',
        'bio_ar' => 'Courte biographie (Arabe)',
    ],

    'sections' => [
        'personal' => 'Informations personnelles',
        'academic' => 'Parcours académique',
        'current_position' => 'Poste actuel',
        'about' => 'À propos de vous',
        'profile_documents' => 'Photo de profil et CV',
    ],

    'placeholders' => [
        'name_fr' => 'Ahmad Al-Hassan',
        'name_ar' => 'أحمد الحسن',
        'email' => 'ahmad@example.com',
        'phone' => '+962 7X XXX XXXX',
        'specialization_fr' => 'ex. Informatique',
        'specialization_ar' => 'مثلا علوم الحاسب',
        'university_fr' => 'ex. Université Paris-Saclay',
        'university_ar' => 'مثلا جامعة باريس ساكلي',
        'job_fr' => 'ex. Ingénieur senior',
        'job_ar' => 'مثلا مهندس أول',
        'workplace_fr' => 'ex. Ministère de l’Éducation',
        'workplace_ar' => 'مثلا وزارة التربية والتعليم',
        'interests_fr' => 'Domaines de recherche, loisirs, intérêts professionnels...',
        'interests_ar' => 'مجالات الاهتمام والبحث...',
        'bio_fr' => 'Un court paragraphe pour vous présenter au réseau...',
        'bio_ar' => 'نبذة قصيرة عن نفسك للشبكة...',
    ],

    'upload' => [
        'photo_label' => 'Photo de profil',
        'photo' => 'Télécharger une photo',
        'photo_hint' => 'JPG, PNG, WEBP — max 5 Mo',
        'cv_label' => 'CV',
        'cv' => 'Télécharger le CV',
        'cv_hint' => 'PDF, DOC, DOCX — max 10 Mo',
        'docs' => 'Documents supplémentaires',
        'docs_desc' => 'Joignez tout document justificatif : certificat',
        'docs_drop' => 'Déposez les fichiers ici ou cliquez pour parcourir',
        'docs_hint' => 'PDF, DOC, DOCX, JPG, PNG — max 10 Mo chacun',
    ],

    'review' => [
        'title' => 'Vérifiez votre demande',
        'personal' => 'Informations personnelles',
        'professional' => 'Informations professionnelles',
        'documents' => 'Documents',
        'empty' => '—',
        'not_uploaded' => 'Non téléversé',
        'none' => 'Aucun',
    ],

    'success' => [
        'title' => 'Demande envoyée !',
        'desc' => 'Merci pour votre demande. Nous vous répondrons par email dans 3 à 5 jours ouvrables.',
        'status' => 'Statut : En cours de révision',
    ],

    'validation' => [
        'fix_errors' => 'Veuillez corriger les erreurs suivantes :',
        'required' => 'Ce champ est obligatoire',
        'name_fr_required' => 'Le nom en français est obligatoire',
        'name_ar_required' => 'Le nom en arabe est obligatoire',
        'email_required' => 'Une adresse email valide est obligatoire',
        'file_too_large' => ':file dépasse 10 Mo et a été ignoré.',
        'french_only' => 'Ce champ doit contenir uniquement du texte français (caractères latins)',
        'arabic_only' => 'Ce champ doit contenir uniquement du texte arabe',
    ],

    'actions' => [
        'remove' => 'Supprimer',
    ],

    'units' => [
        'file' => 'fichier',
        'files' => 'fichiers',
        'selected' => 'sélectionné(s)',
    ],
];
