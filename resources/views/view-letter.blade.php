<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $letter->title }} - Lettre de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Courgette&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --rose-principal: #ffb6c1;
            --rose-clair: #ffebf0;
            --rose-fonce: #ff8fa3;
            --rose-vintage: #f8c8dc;
            --vert-noel: #2e8b57;
            --or: #ffd700;
            --blanc: #fff9fb;
            --noir-doux: #5a4a4a;
            --violet-doux: #d8b4fe;
            --bleu-clair: #a5f3fc;
            --parchemin: #f5e6d3;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--rose-clair) 0%, #fff0f5 100%);
            color: var(--noir-doux);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        
        /* ===== ADS ROW STYLES ===== */
        .ad-row2{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap
        }

        /* ===== ANIMATIONS ===== */
        @keyframes snowFall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
        
        @keyframes letterGlow {
            0%, 100% { box-shadow: 0 20px 40px rgba(139, 0, 0, 0.1); }
            50% { box-shadow: 0 25px 50px rgba(139, 0, 0, 0.2); }
        }
        
        @keyframes sealRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ===== NEIGE ===== */
        .snowflake {
            position: fixed;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            opacity: 0.7;
            z-index: 0;
            pointer-events: none;
            animation: snowFall 10s linear infinite;
        }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        /* ===== HEADER ===== */
        .header-letter {
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--or), var(--violet-doux));
            background-size: 300% 300%;
            animation: gradientShift 8s ease infinite;
            box-shadow: 0 15px 35px rgba(255, 182, 193, 0.3);
        }
        
        .view-title {
            font-family: 'Courgette', cursive;
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
        }
        
        .view-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== LETTRE PRINCIPALE ===== */
        .letter-display {
            max-width: 900px;
            margin: 0 auto 60px;
            animation: letterGlow 4s infinite ease-in-out;
        }
        
        .letter-container {
            background: var(--parchemin);
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 8px solid #8b4513;
            padding: 60px 50px;
            min-height: 800px;
        }
        
        /* Effet de papier vieilli */
        .letter-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23d4a76a" opacity="0.1"/><circle cx="60" cy="40" r="2" fill="%23d4a76a" opacity="0.1"/><circle cx="40" cy="70" r="2" fill="%23d4a76a" opacity="0.1"/><circle cx="80" cy="20" r="2" fill="%23d4a76a" opacity="0.1"/></svg>');
            pointer-events: none;
        }
        
        /* Cachet de cire */
        .letter-seal {
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #8b0000, #b22222);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            box-shadow: 0 10px 20px rgba(139, 0, 0, 0.3);
            border: 5px solid #8b4513;
            z-index: 2;
            animation: sealRotate 20s linear infinite;
        }
        
        /* En-tête de lettre */
        .letter-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            padding-bottom: 30px;
            border-bottom: 3px double #8b4513;
        }
        
        .letter-main-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #8b0000;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(139, 0, 0, 0.1);
        }
        
        .letter-address {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: #5a4a4a;
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .letter-date {
            font-size: 1.2rem;
            color: #8b4513;
            margin-top: 20px;
            font-style: italic;
        }
        
        /* Contenu de la lettre */
        .letter-content {
            font-size: 1.3rem;
            line-height: 1.8;
            color: #5a4a4a;
            margin-bottom: 50px;
            white-space: pre-line;
            text-align: justify;
        }
        
        .letter-content p {
            margin-bottom: 25px;
            text-indent: 40px;
        }
        
        /* Signature */
        .letter-footer {
            text-align: right;
            margin-top: 80px;
            padding-top: 30px;
            border-top: 2px solid #8b4513;
            position: relative;
        }
        
        .letter-signature {
            font-family: 'Dancing Script', cursive;
            font-size: 3.5rem;
            color: #8b0000;
            margin-bottom: 20px;
            display: inline-block;
            position: relative;
        }
        
        .letter-signature::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 2px;
            background: #8b4513;
            width: 200px;
            margin: 0 auto;
        }
        
        .letter-closing {
            font-family: 'Courgette', cursive;
            font-size: 1.8rem;
            color: #5a4a4a;
            font-style: italic;
        }
        
        /* ===== INFORMATIONS ===== */
        .letter-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 900px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
        }
        
        .info-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 3px solid var(--rose-clair);
            padding-bottom: 15px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .info-item {
            text-align: center;
            padding: 25px;
            background: var(--rose-clair);
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            transform: translateY(-5px);
            background: var(--rose-principal);
        }
        
        .info-icon {
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 15px;
        }
        
        .info-item:hover .info-icon {
            color: white;
        }
        
        .info-label {
            display: block;
            font-weight: 600;
            color: var(--noir-doux);
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .info-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--rose-fonce);
        }
        
        .info-item:hover .info-label,
        .info-item:hover .info-value {
            color: white;
        }
        
        /* ===== ACTIONS ===== */
        .actions-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 900px;
            border: 2px dashed var(--rose-fonce);
            text-align: center;
        }
        
        .actions-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 30px;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .action-btn {
            padding: 20px;
            background: white;
            border: 2px solid var(--rose-principal);
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: var(--noir-doux);
        }
        
        .action-btn:hover {
            background: var(--rose-principal);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 143, 163, 0.3);
        }
        
        .action-icon {
            font-size: 2.5rem;
            color: var(--rose-fonce);
        }
        
        .action-btn:hover .action-icon {
            color: white;
        }
        
        .action-label {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        /* ===== MESSAGE DE REMERCIEMENT ===== */
        .thankyou-section {
            text-align: center;
            padding: 60px 40px;
            margin: 60px auto;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--rose-principal);
        }
        
        .thankyou-title {
            font-family: 'Courgette', cursive;
            font-size: 3.5rem;
            color: var(--rose-fonce);
            margin-bottom: 20px;
        }
        
        .thankyou-text {
            font-size: 1.3rem;
            line-height: 1.8;
            color: var(--noir-doux);
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 40px 20px;
            color: #7a6a6a;
            margin-top: 60px;
            border-top: 3px solid var(--rose-clair);
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: var(--rose-fonce);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            border: 2px solid var(--rose-fonce);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .footer-link:hover {
            background: var(--rose-fonce);
            color: white;
            transform: translateY(-3px);
        }
        
        /* ===== MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: white;
            border-radius: 30px;
            max-width: 500px;
            width: 100%;
            position: relative;
        }
        
        .modal-header {
            padding: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--violet-doux));
            color: white;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 30px 30px 0 0;
        }
        
        .modal-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            margin: 0;
        }
        
        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            line-height: 1;
        }
        
        .modal-body {
            padding: 30px;
            text-align: center;
        }
        
        /* ===== NOTIFICATIONS ===== */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 20px 25px;
            border-radius: 15px;
            color: white;
            font-weight: 600;
            z-index: 1001;
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateX(150%);
            transition: transform 0.5s ease;
            max-width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background: linear-gradient(45deg, #2e8b57, #3cb371);
        }
        
        .notification.error {
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .view-title { font-size: 2.8rem; }
            .view-subtitle { font-size: 1.8rem; }
            .letter-container { padding: 40px 25px; }
            .letter-main-title { font-size: 2.5rem; }
            .letter-address { font-size: 1.8rem; }
            .letter-content { font-size: 1.1rem; }
            .letter-signature { font-size: 2.8rem; }
            .letter-closing { font-size: 1.5rem; }
            .letter-seal { width: 70px; height: 70px; font-size: 1.8rem; }
            .info-grid { grid-template-columns: repeat(2, 1fr); }
            .actions-grid { grid-template-columns: repeat(2, 1fr); }
            .thankyou-title { font-size: 2.8rem; }
        }
        
        @media (max-width: 480px) {
            .view-title { font-size: 2.2rem; }
            .letter-main-title { font-size: 2rem; }
            .letter-container { padding: 30px 20px; }
            .letter-seal { display: none; }
            .info-grid { grid-template-columns: 1fr; }
            .actions-grid { grid-template-columns: 1fr; }
            .footer-links { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>
    {{-- @component('components.ads.popunder')
    @endcomponent --}}

    @include('components.floating-home')

    <!-- Flocons de neige -->
    <div id="snowContainer"></div>
    
    <div class="container">
        <!-- Header -->
        <header class="header-letter">
            <h1 class="view-title">Lettre de Noël Reçue!</h1>
            <p class="view-subtitle">Un message chaleureux pour les fêtes</p>
        </header>

    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>
        
        <!-- Lettre principale -->
        <div class="letter-display">
            <div class="letter-container">
                <!-- Cachet de cire -->
                <div class="letter-seal">
                    <i class="fas fa-star"></i>
                </div>
                
                <!-- En-tête -->
                <div class="letter-header">
                    <h2 class="letter-main-title">{{ $letter->title }}</h2>
                    
                    <div class="letter-address">
                        <div>À l'attention de: <strong>{{ $letter->to_name }}</strong></div>
                        <div style="margin-top: 10px;">De la part de: <strong>{{ $letter->from_name }}</strong></div>
                    </div>
                    
                    <div class="letter-date">
                        Écrite le {{ $letter->created_at->translatedFormat('d F Y') }} à {{ $letter->created_at->format('H:i') }}
                    </div>
                </div>
                
                <!-- Contenu -->
                <div class="letter-content">
                    {!! nl2br(e($letter->content)) !!}
                </div>
                
                <!-- Signature -->
                <div class="letter-footer">
                    <div class="letter-signature">{{ $letter->from_name }}</div>
                    <div class="letter-closing">
                        Joyeux Noël et Bonne Année {{ now()->year }}!
                        <br>
                        <span style="font-size: 2rem;">🎄✨🎁</span>
                    </div>
                </div>
            </div>
        </div>

    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>
        
        <!-- Informations -->
        <div class="letter-info">
            <h2 class="info-title"><i class="fas fa-scroll"></i> Détails de la lettre</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-feather-alt"></i>
                    </div>
                    <span class="info-label">Auteur</span>
                    <span class="info-value">{{ $letter->from_name }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="info-label">Destinataire</span>
                    <span class="info-value">{{ $letter->to_name }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <span class="info-label">Style</span>
                    <span class="info-value">
                        @switch($letter->background)
                            @case('bg-rose') Rose Doux @break
                            @case('bg-vintage') Vintage @break
                            @case('bg-noel') Noël Vert @break
                            @case('bg-neige') Neige @break
                            @case('bg-or') Doré @break
                            @case('bg-etoile') Étoilé @break
                            @default Classique
                        @endswitch
                    </span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span class="info-label">Vues</span>
                    <span class="info-value">{{ $letter->views }} vue(s)</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="info-label">Date d'envoi</span>
                    <span class="info-value">{{ $letter->created_at->translatedFormat('d/m/Y') }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <span class="info-label">Partages</span>
                    <span class="info-value">
                        <span id="shareCount">{{ $letter->shares ?? 0 }}</span> partage(s)
                    </span>
                </div>
            </div>
            
            <!-- QR Code -->
            <div style="text-align: center; margin-top: 40px;">
                <div style="font-size: 1.2rem; color: var(--noir-doux); margin-bottom: 15px;">
                    <i class="fas fa-qrcode"></i><a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" rel="noopener noreferrer">Cliquer pour sauvegarder</a>
                </div>
                <div id="qrcode" style="display: inline-block; padding: 20px; background: white; border-radius: 15px;"></div>
            </div>
        </div>

    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>

        
        <!-- Actions -->
        <div class="actions-section">
            <h2 class="actions-title"><i class="fas fa-magic"></i> Que souhaitez-vous faire?</h2>
            
            <div class="actions-grid">
                <a href="#" class="action-btn" id="replyBtn">
                    <div class="action-icon">
                        <i class="fas fa-reply"></i>
                    </div>
                    <span class="action-label">Répondre</span>
                </a>
                
                <a href="#" class="action-btn" id="downloadBtn">
                    <div class="action-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <span class="action-label">Télécharger</span>
                </a>
                
                <a href="#" class="action-btn" id="shareBtn">
                    <div class="action-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <span class="action-label">Partager</span>
                </a>
                
                <a href="#" class="action-btn" id="printBtn">
                    <div class="action-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <span class="action-label">Imprimer</span>
                </a>
                
                <a href="/create-letter" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <span class="action-label">Écrire la mienne</span>
                </a>
                
                <a href="/" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="action-label">Accueil</span>
                </a>
            </div>
        </div>
        
        <!-- Message de remerciement -->
        <div class="thankyou-section">
            <h2 class="thankyou-title">Une pensée spéciale</h2>
            <p class="thankyou-text">
                Les lettres de Noël sont des trésors qui traversent le temps. 
                Cette lettre a été écrite avec le cœur pour transmettre des vœux sincères 
                et des pensées affectueuses durant cette période magique de l'année.
            </p>
            <div style="font-size: 4rem; margin: 20px 0; color: var(--rose-fonce);">
                ❤️🎄✨
            </div>
            <p style="font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--rose-fonce);">
                Que l'esprit de Noël vous accompagne toute l'année!
            </p>
        </div>

    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p style="font-size: 1.1rem; margin-bottom: 15px;">
                Message partagé avec affection via Féérie de Noël
            </p>
            <div class="footer-links">
                <a href="/create-letter" class="footer-link">
                    <i class="fas fa-pen-fancy"></i> Écrire une lettre
                </a>
                <a href="/create-card" class="footer-link">
                    <i class="fas fa-envelope"></i> Créer une carte
                </a>
                <a href="/create-poster" class="footer-link">
                    <i class="fas fa-image"></i> Créer une affiche
                </a>
                <a href="/create-giftlist" class="footer-link">
                    <i class="fas fa-gift"></i> Liste de cadeaux
                </a>
            </div>
        </footer>
    </div>

    {{-- <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div> --}}
    
    <!-- Modal de réponse -->
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Répondre à {{ $letter->from_name }}</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Écrivez votre réponse à {{ $letter->from_name }}
                    </p>
                    <textarea id="replyMessage" placeholder="Cher/chère {{ $letter->from_name }},&#10;&#10;Merci pour votre belle lettre..." 
                              style="width: 100%; padding: 15px; border: 2px solid var(--rose-clair); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 1rem; min-height: 200px; resize: vertical;"></textarea>
                </div>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button class="action-btn" id="sendReplyBtn" style="padding: 12px 30px; border: none;">
                        <i class="fas fa-paper-plane"></i> Envoyer la réponse
                    </button>
                    <button class="action-btn" id="cancelReplyBtn" style="padding: 12px 30px; background: transparent; border: 2px solid var(--rose-fonce); color: var(--rose-fonce);">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>

    <!-- Modal de partage -->
    <div class="modal" id="shareModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Partager cette lettre</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Choisissez comment partager cette belle lettre:
                    </p>
                    <div class="actions-grid" style="grid-template-columns: repeat(2, 1fr);">
                        <button class="action-btn share-option" data-platform="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </button>
                        <button class="action-btn share-option" data-platform="facebook">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </button>
                        <button class="action-btn share-option" data-platform="twitter">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </button>
                        <button class="action-btn share-option" data-platform="email">
                            <i class="fas fa-envelope"></i>
                            <span>Email</span>
                        </button>
                        <button class="action-btn share-option" data-platform="copy">
                            <i class="fas fa-copy"></i>
                            <span>Copier lien</span>
                        </button>
                        <button class="action-btn share-option" data-platform="download">
                            <i class="fas fa-download"></i>
                            <span>Télécharger</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ad-row2">
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
        <div>
            @component('components.ads.banners.banner-320x50')
            @endcomponent
        </div>
    </div>

    <x-footer></x-footer>
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Opération réussie!</span>
    </div>
    
    <!-- Bibliothèque QR Code -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    
    <script>
        // ===== VARIABLES =====
        const letterId = "{{ $letter->unique_id }}";
        const shareUrl = "{{ route('letters.show', $letter->unique_id) }}";
        const letterTitle = "{{ $letter->title }}";
        const fromName = "{{ $letter->from_name }}";
        const toName = "{{ $letter->to_name }}";
        
        // ===== NEIGE ANIMÉE =====
        function createSnow() {
            const container = document.getElementById('snowContainer');
            
            for (let i = 0; i < 50; i++) {
                const snowflake = document.createElement('div');
                snowflake.className = 'snowflake';
                snowflake.style.left = Math.random() * 100 + 'vw';
                snowflake.style.width = Math.random() * 10 + 5 + 'px';
                snowflake.style.height = snowflake.style.width;
                snowflake.style.animationDuration = Math.random() * 5 + 5 + 's';
                snowflake.style.animationDelay = Math.random() * 10 + 's';
                
                container.appendChild(snowflake);
                
                setTimeout(() => {
                    snowflake.remove();
                }, 15000);
            }
        }
        
        // Lancer la neige au chargement et périodiquement
        window.addEventListener('load', function() {
            createSnow();
            setInterval(createSnow, 8000);
            
            // Générer QR Code
            generateQRCode();
            
            // Animation d'entrée de la lettre
            animateLetterEntrance();
        });
        
        // ===== QR CODE =====
        function generateQRCode() {
            QRCode.toCanvas(document.getElementById('qrcode'), shareUrl, {
                width: 150,
                height: 150,
                color: {
                    dark: '#8b0000',
                    light: '#ffffff'
                },
                margin: 1
            }, function(error) {
                if (error) console.error(error);
            });
        }
        
        // ===== ANIMATION D'ENTRÉE =====
        function animateLetterEntrance() {
            const letter = document.querySelector('.letter-container');
            const seal = document.querySelector('.letter-seal');
            
            // Initial state
            letter.style.transform = 'translateY(50px) scale(0.95)';
            letter.style.opacity = '0';
            seal.style.transform = 'scale(0)';
            
            // Animate letter
            setTimeout(() => {
                letter.style.transition = 'all 1s ease';
                letter.style.transform = 'translateY(0) scale(1)';
                letter.style.opacity = '1';
            }, 300);
            
            // Animate seal with delay
            setTimeout(() => {
                seal.style.transition = 'all 0.8s ease';
                seal.style.transform = 'scale(1)';
            }, 1000);
        }
        
        // ===== MODAL DE RÉPONSE =====
        document.getElementById('replyBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('replyModal').style.display = 'flex';
        });
        
        document.getElementById('sendReplyBtn').addEventListener('click', function() {
            const message = document.getElementById('replyMessage').value.trim();
            if (!message) {
                showNotification('Veuillez écrire votre réponse', 'error');
                return;
            }
            
            // Ici, vous pourriez envoyer la réponse au backend
            showNotification('Réponse envoyée à ' + fromName, 'success');
            document.getElementById('replyModal').style.display = 'none';
            document.getElementById('replyMessage').value = '';
        });
        
        document.getElementById('cancelReplyBtn').addEventListener('click', function() {
            document.getElementById('replyModal').style.display = 'none';
            document.getElementById('replyMessage').value = '';
        });
        
        // ===== TÉLÉCHARGEMENT =====
        document.getElementById('downloadBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Capture de la lettre comme image
            const letter = document.querySelector('.letter-container');
            html2canvas(letter, {
                backgroundColor: '#f5e6d3',
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = `lettre-noel-${letterId}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                showNotification('Lettre téléchargée avec succès!', 'success');
            }).catch(error => {
                console.error('Erreur de capture:', error);
                showNotification('Erreur lors du téléchargement', 'error');
            });
        });
        
        // ===== PARTAGE =====
        document.getElementById('shareBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('shareModal').style.display = 'flex';
        });
        
        document.querySelectorAll('.share-option').forEach(btn => {
            btn.addEventListener('click', function() {
                const platform = this.dataset.platform;
                shareLetter(platform);
            });
        });
        
        function shareLetter(platform) {
            const message = `📜 J'ai reçu une belle lettre de Noël de ${fromName}!\n\n"${letterTitle}"\n\nDécouvrez-la ici: ${shareUrl}\n\nJoyeux Noël et Bonne Année! 🎄✨`;
            
            switch(platform) {
                case 'whatsapp':
                    window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, '_blank');
                    break;
                    
                case 'facebook':
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`, '_blank');
                    break;
                    
                case 'twitter':
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}&url=${encodeURIComponent(shareUrl)}`, '_blank');
                    break;
                    
                case 'email':
                    window.location.href = `mailto:?subject=Lettre de Noël de ${fromName}&body=${encodeURIComponent(message)}`;
                    break;
                    
                case 'copy':
                    navigator.clipboard.writeText(shareUrl)
                        .then(() => showNotification('Lien copié dans le presse-papier!', 'success'))
                        .catch(() => showNotification('Impossible de copier le lien', 'error'));
                    break;
                    
                case 'download':
                    document.getElementById('downloadBtn').click();
                    break;
            }
            
            // Incrémenter le compteur de partages
            incrementShareCount();
            
            // Fermer le modal après un court délai
            setTimeout(() => {
                document.getElementById('shareModal').style.display = 'none';
            }, 1000);
        }
        
        // ===== IMPRESSION =====
        document.getElementById('printBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const printWindow = window.open('', '_blank');
            const letterContent = `{!! addslashes(nl2br(e($letter->content))) !!}`.replace(/\n/g, '<br>');
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${letterTitle} - Lettre de Noël</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap');
                        
                        body { 
                            font-family: Georgia, serif; 
                            margin: 0; 
                            padding: 40px; 
                            background: #f9f9f9; 
                            color: #5a4a4a; 
                        }
                        
                        .print-letter { 
                            max-width: 800px; 
                            margin: 0 auto; 
                            background: #f5e6d3; 
                            padding: 60px 50px; 
                            border: 8px solid #8b4513; 
                            border-radius: 20px; 
                            position: relative; 
                            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
                            min-height: 1000px; 
                        }
                        
                        .print-seal { 
                            position: absolute; 
                            top: -30px; 
                            right: -30px; 
                            width: 80px; 
                            height: 80px; 
                            background: #8b0000; 
                            border-radius: 50%; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            color: white; 
                            font-size: 2rem; 
                            border: 5px solid #8b4513; 
                        }
                        
                        .print-header { 
                            text-align: center; 
                            margin-bottom: 50px; 
                            padding-bottom: 30px; 
                            border-bottom: 3px double #8b4513; 
                        }
                        
                        .print-title { 
                            font-family: 'Playfair Display', serif; 
                            font-size: 2.8rem; 
                            font-weight: 700; 
                            color: #8b0000; 
                            margin-bottom: 20px; 
                        }
                        
                        .print-address { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 1.8rem; 
                            margin-bottom: 10px; 
                        }
                        
                        .print-date { 
                            font-size: 1.1rem; 
                            color: #8b4513; 
                            margin-top: 20px; 
                            font-style: italic; 
                        }
                        
                        .print-content { 
                            font-size: 1.2rem; 
                            line-height: 1.8; 
                            margin-bottom: 50px; 
                            text-align: justify; 
                        }
                        
                        .print-content p { 
                            margin-bottom: 25px; 
                            text-indent: 40px; 
                        }
                        
                        .print-footer { 
                            text-align: right; 
                            margin-top: 80px; 
                            padding-top: 30px; 
                            border-top: 2px solid #8b4513; 
                        }
                        
                        .print-signature { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 2.8rem; 
                            color: #8b0000; 
                            margin-bottom: 15px; 
                            display: inline-block; 
                            position: relative; 
                        }
                        
                        .print-signature::after { 
                            content: ''; 
                            position: absolute; 
                            bottom: -8px; 
                            left: 0; 
                            right: 0; 
                            height: 2px; 
                            background: #8b4513; 
                            width: 180px; 
                            margin: 0 auto; 
                        }
                        
                        .print-closing { 
                            font-size: 1.5rem; 
                            color: #5a4a4a; 
                            font-style: italic; 
                        }
                        
                        .print-info { 
                            margin-top: 40px; 
                            padding: 20px; 
                            background: white; 
                            border-radius: 15px; 
                            font-size: 0.9rem; 
                            color: #666; 
                            text-align: center; 
                        }
                        
                        @media print {
                            body { padding: 0; background: white; }
                            .print-letter { box-shadow: none; border: 2px solid #8b4513; }
                            .print-seal { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-letter">
                        <div class="print-seal">✉️</div>
                        
                        <div class="print-header">
                            <h2 class="print-title">${letterTitle}</h2>
                            <div class="print-address">
                                <div>À l'attention de: <strong>${toName}</strong></div>
                                <div style="margin-top: 10px;">De la part de: <strong>${fromName}</strong></div>
                            </div>
                            <div class="print-date">
                                Écrite le {{ $letter->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        
                        <div class="print-content">
                            ${letterContent}
                        </div>
                        
                        <div class="print-footer">
                            <div class="print-signature">${fromName}</div>
                            <div class="print-closing">
                                Joyeux Noël et Bonne Année {{ now()->year }}! 🎄✨
                            </div>
                        </div>
                    </div>
                    
                    <div class="print-info">
                        <p>Lettre créée via Féérie de Noël • {{ url('/') }}</p>
                        <p>Partagée avec affection le {{ now()->translatedFormat('d F Y à H:i') }}</p>
                    </div>
                    
                    <script>
                        window.onload = function() {
                            window.print();
                            setTimeout(function() {
                                window.close();
                            }, 1000);
                        };
                    <\/script>
                </body>
                </html>
            `);
            
            printWindow.document.close();
        });
        
        // ===== GESTION DES MODAUX =====
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        });
        
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
        
        // ===== NOTIFICATIONS =====
        function showNotification(text, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = text;
            notification.className = `notification ${type}`;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
        
        // ===== INCRÉMENTATION DES PARTAGES =====
        function incrementShareCount() {
            const shareCountElement = document.getElementById('shareCount');
            let currentCount = parseInt(shareCountElement.textContent) || 0;
            shareCountElement.textContent = currentCount + 1;
            
            // Envoyer au backend
            fetch(`/letters/${letterId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ method: 'share' })
            }).catch(error => console.error('Erreur:', error));
        }
        
        // ===== EFFET DE PARCHEMIN =====
        function addParcheminEffect() {
            const letterContent = document.querySelector('.letter-content');
            if (letterContent) {
                // Ajouter des sauts de ligne automatiques
                letterContent.innerHTML = letterContent.innerHTML.replace(/\n/g, '<br><br>');
            }
        }
        
        // Initialiser les effets
        window.addEventListener('load', addParcheminEffect);
    </script>
    
    <!-- Bibliothèque pour capture d'écran -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</body>
</html>