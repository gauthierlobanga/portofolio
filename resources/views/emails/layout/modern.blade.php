<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Notification' }}</title>
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #09090b; color: #f4f4f5; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #09090b; padding: 40px 0; }
        .main { margin: 0 auto; width: 100%; max-width: 600px; background-color: #18181b; border: 1px solid #27272a; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .header { background-color: #18181b; padding: 30px; text-align: center; border-bottom: 1px solid #27272a; }
        .header h1 { margin: 0; color: #f4f4f5; font-size: 24px; font-weight: 700; letter-spacing: -0.025em; }
        .header h1 span { color: #10b981; }
        .content { padding: 40px 30px; line-height: 1.6; color: #d4d4d8; font-size: 16px; }
        
        .footer-portfolio { padding: 30px; background-color: #121214; border-top: 1px solid #27272a; }
        .section-title { font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; color: #10b981; margin-top: 0; margin-bottom: 12px; }
        .about-text { color: #a1a1aa; font-size: 14px; line-height: 1.6; margin-top: 0; margin-bottom: 24px; }
        
        .badge-container { margin-bottom: 24px; }
        .service-badge { display: inline-block; background-color: rgba(16, 185, 129, 0.1); color: #34d399; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500; margin: 0 6px 8px 0; border: 1px solid rgba(16, 185, 129, 0.2); }
        .skill-badge { display: inline-block; background-color: #27272a; color: #e4e4e7; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500; margin: 0 6px 8px 0; border: 1px solid #3f3f46; }
        
        .footer-bottom { padding: 20px 30px; background-color: #09090b; text-align: center; border-top: 1px solid #27272a; color: #71717a; font-size: 13px; }
        
        .btn { display: inline-block; background-color: #10b981; color: #09090b; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 20px; transition: background-color 0.2s; }
        .btn:hover { background-color: #059669; }
        
        h2 { color: #f4f4f5; font-size: 20px; font-weight: 600; margin-top: 0; margin-bottom: 16px; }
        p { margin-top: 0; margin-bottom: 16px; }
        
        /* Utility classes */
        .text-emerald { color: #10b981; }
        .text-zinc { color: #a1a1aa; }
        .font-semibold { font-weight: 600; }
        .mt-4 { margin-top: 16px; }
        .mb-2 { margin-bottom: 8px; }
    </style>
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <h1>{{ app(\App\Settings\SettingApp::class)->name ?? 'GauDev' }}<span>.</span></h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td class="content">
                            @yield('content')
                        </td>
                    </tr>
                    
                    <!-- Portfolio Footer Info -->
                    <tr>
                        <td class="footer-portfolio">
                            
                            @php
                                $aboutText = app(\App\Settings\AboutSettings::class)->about_text ?? 'Développeur passionné, créant des expériences web modernes, performantes et intuitives.';
                                $services = \App\Models\Service::take(4)->get();
                                $skills = \App\Models\Skill::take(6)->get();
                            @endphp

                            @if($aboutText)
                            <h3 class="section-title">À propos de moi</h3>
                            <p class="about-text">{{ \Illuminate\Support\Str::limit(strip_tags($aboutText), 200) }}</p>
                            @endif

                            @if($services->isNotEmpty())
                            <h3 class="section-title">Mes Services</h3>
                            <div class="badge-container">
                                @foreach($services as $service)
                                    <span class="service-badge">{{ $service->title }}</span>
                                @endforeach
                            </div>
                            @endif

                            @if($skills->isNotEmpty())
                            <h3 class="section-title">Mes Compétences</h3>
                            <div class="badge-container">
                                @foreach($skills as $skill)
                                    <span class="skill-badge">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                            @endif
                        </td>
                    </tr>
                    
                    <!-- Real Footer -->
                    <tr>
                        <td class="footer-bottom">
                            &copy; {{ date('Y') }} {{ app(\App\Settings\SettingApp::class)->name ?? 'GauDev' }}. Tous droits réservés.<br>
                            <span style="display:inline-block; margin-top: 8px;">
                                @if(app(\App\Settings\SettingApp::class)->email)
                                    <a href="mailto:{{ app(\App\Settings\SettingApp::class)->email }}" style="color: #71717a; text-decoration: underline;">{{ app(\App\Settings\SettingApp::class)->email }}</a>
                                @endif
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
