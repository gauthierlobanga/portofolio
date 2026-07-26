<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\site\SitemapController;
use App\Livewire\Assessments\TakeAssessment;
use App\Models\FormationRegistration;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// ==================== Routes principales ====================
// Rediriger l'ancienne URL de connexion Filament vers la page de connexion publique
Route::redirect('/admin/login', '/login');
Route::livewire('/', 'pages::site.home')->name('home');
Route::livewire('/about', 'pages::site.about')->name('about');
Route::livewire('/contact', 'pages::site.contact')->name('contact');
Route::livewire('/gallery', 'pages::site.gallery')->name('gallery');
Route::livewire('/faq', 'pages::faq.index')->name('faq');

// ==================== Services ====================

Route::livewire('/services', 'pages::services.index')->name('services.index');
Route::livewire('/services/{service}', 'pages::services.show')->name('services.show');

// ==================== Projets ====================
Route::livewire('/projects', 'pages::projets.index')->name('projects.index');
Route::livewire('/projects/{project}', 'pages::projets.show')->name('projects.show');

// ==================== Projets ====================
Route::livewire('/skills', 'pages::skills.index')->name('skill');

// ==================== Articles / Actualités ====================
Route::livewire('/posts', 'pages::posts.index')->name('posts.index');
Route::livewire('/posts/{post:slug}', 'pages::posts.show')->name('posts.show');

// ==================== Formations ====================
Route::livewire('/formations', 'pages::formations.index')->name('formations.index');

// // ==================== Newsletter ====================

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// ==================== Pages légales ====================

Route::view('/mentions-legales', 'pages.legal')->name('legal');
Route::view('/politique-confidentialite', 'pages.privacy')->name('privacy');
Route::view('/conditions-utilisation', 'pages.terms')->name('terms');
Route::view('/cookies', 'pages.cookies')->name('cookies');

// ==================== Plan du site ====================

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::livewire('/search', 'pages::site.search')->name('search');

// Tableau de bord
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $recentProjects = Project::active()->ordered()->take(8)->get();
        $skills = Skill::take(12)->get();
        $services = Service::active()->ordered()->take(8)->get();

        return view('dashboard', compact('recentProjects', 'skills', 'services'));
    })->name('dashboard');

    Route::get('/assessments/{assessment}/take', TakeAssessment::class)->name('assessments.take');
});

// ==================== Formations ====================
Route::livewire('/formations', 'pages::formations.index')->name('formations.index');

// Route de suivi (doit être placée AVANT la route avec paramètre)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/formations/suivi', function () {
        $registrations = FormationRegistration::with('formation')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('formations.suivi', compact('registrations'));
    })->name('formations.suivi');
});

// Route show (générique) – en dernier
Route::livewire('/formations/{formation:slug}', 'pages::formations.show')->name('formations.show');
Route::feeds();

require __DIR__.'/settings.php';
