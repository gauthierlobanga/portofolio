<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Home page section titles and dynamic content
        $this->migrator->add('about.service_title', 'Des solutions durables pour chaque besoin');
        $this->migrator->add('about.service_subtitle', 'À travers notre approche 4B (Bonne cuisson, Bonne alimentation, Bonne planification familiale pour la Bonne santé), nous développons des solutions durables.');
        $this->migrator->add('about.formation_title', 'Plongez au cœur de mes formations');
        $this->migrator->add('about.formation_subtitle', 'En présentiel ou à distance, je vous accompagne dans la maîtrise du développement web moderne.');
        $this->migrator->add('about.skill_title', 'Compétences');
        $this->migrator->add('about.skill_subtitle', 'Un aperçu des technologies et outils que je maîtrise au quotidien.');
        $this->migrator->add('about.partner_title', 'Ensemble pour un impact durable');
        $this->migrator->add('about.partner_subtitle', 'C’est grâce à la confiance et à l’engagement de nos partenaires que nous pouvons concrétiser nos actions sur le terrain.');
        $this->migrator->add('about.team_title', 'Notre équipe');
        $this->migrator->add('about.team_subtitle', 'Nous réunissons des talents passionnés, animés par l’envie de créer de la valeur et d’accompagner nos clients vers le succès.');

        $this->migrator->add('about.project_hero_badge', 'Projets');
        $this->migrator->add('about.project_hero_title', 'Des projets qui parlent d’eux-mêmes');
        $this->migrator->add('about.project_hero_subtitle', 'De la conception à la mise en ligne, chaque réalisation illustre mon expertise en développement web full‑stack.');
        $this->migrator->add('about.project_content_title', 'Nos réalisations');
        $this->migrator->add('about.project_content_subtitle', 'Applications modernes, API robustes et interfaces soignées : voici un aperçu de notre savoir-faire.');
        $this->migrator->add('about.project_banner_title', 'Projets sélectionnés');
        $this->migrator->add('about.project_banner_subtitle', 'Des cas concrets qui mettent en lumière des solutions pensées pour le terrain.');

        $this->migrator->add('about.blog_hero_badge', 'Blog & Actualités');
        $this->migrator->add('about.blog_hero_title', 'Le pouls de CADERSA ASBL');
        $this->migrator->add('about.blog_hero_subtitle', 'Retrouvez des articles, des nouvelles et des ressources pour mieux comprendre nos actions et nos engagements.');
        $this->migrator->add('about.blog_content_title', 'Actualités et savoir-faire');
        $this->migrator->add('about.blog_content_subtitle', 'Des contenus pensés pour partager nos retours d’expérience et nos apprentissages.');
        $this->migrator->add('about.blog_banner_title', 'Ressources utiles');
        $this->migrator->add('about.blog_banner_subtitle', 'Des billets et des guides pour appuyer vos projets de développement et d’agriculture durable.');

        $this->migrator->add('about.author_home', 'Full-Stack Web Developer');
        $this->migrator->add('about.auteur_about', 'Gauthier Lobanga');
        $this->migrator->add('about.citation_footer', 'Vivre c’est reconnaître ses semblables créés à l’image de Dieu. — Prof. Dr Bernard HANGI');

        // Contact page dynamic content
        $this->migrator->add('app.contact_hero_badge', 'Nous contacter');
        $this->migrator->add('app.contact_hero_title', 'Parlons de votre projet');
        $this->migrator->add('app.contact_hero_subtitle', 'Notre équipe est disponible pour répondre à toutes vos questions et vous accompagner dans vos projets de développement rural.');
        $this->migrator->add('app.contact_form_heading', 'Envoyez-nous un message');
        $this->migrator->add('app.contact_form_description', 'Remplissez le formulaire ci-dessous, nous vous répondrons dans les plus brefs délais.');
        $this->migrator->add('app.contact_support_title', 'Un accompagnement sur mesure');
        $this->migrator->add('app.contact_support_description', 'Notre équipe traite chaque demande avec attention. Réponse rapide, suivi personnalisé et solutions adaptées à vos besoins.');
        $this->migrator->add('app.contact_offices_title', 'Nos bureaux');

        // Static policy and legal page headers
        $this->migrator->add('cookie.hero_badge', 'Confidentialité');
        $this->migrator->add('cookie.hero_title', 'Gestion des Cookies');
        $this->migrator->add('cookie.hero_subtitle', 'Comment nous utilisons les cookies pour améliorer votre expérience de navigation.');

        $this->migrator->add('legal.hero_badge', 'Informations Juridiques');
        $this->migrator->add('legal.hero_title', 'Mentions Légales');
        $this->migrator->add('legal.hero_subtitle', 'Transparence et conformité concernant l’édition et l’hébergement du site de CADERSA ASBL.');

        $this->migrator->add('privacy.hero_badge', 'Données Personnelles');
        $this->migrator->add('privacy.hero_title', 'Politique de Confidentialité');
        $this->migrator->add('privacy.hero_subtitle', 'Nous accordons une importance primordiale à la protection et au respect de vos données personnelles.');

        $this->migrator->add('terms.hero_badge', 'Règles d’Usage');
        $this->migrator->add('terms.hero_title', 'Conditions d’Utilisation');
        $this->migrator->add('terms.hero_subtitle', 'Les règles régissant l’utilisation de la plateforme web de CADERSA ASBL.');
    }
};
