<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->title }} - Carte de Vœux</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
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
            --rouge-vif: #ff6b6b;
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
        @keyframes confettiFall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
        
        @keyframes sparkleEffect {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        @keyframes cardGlow {
            0%, 100% { box-shadow: 0 20px 40px rgba(255, 182, 193, 0.4); }
            50% { box-shadow: 0 25px 50px rgba(255, 182, 193, 0.7); }
        }
        
        /* ===== CONFETTI ===== */
        .confetti {
            position: fixed;
            width: 15px;
            height: 15px;
            background: var(--rose-fonce);
            opacity: 0.7;
            z-index: 0;
            pointer-events: none;
            animation: confettiFall 5s linear infinite;
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
        .header-view {
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--or), var(--violet-doux));
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
            box-shadow: 0 15px 35px rgba(255, 182, 193, 0.3);
        }
        
        .view-title {
            font-family: 'Great Vibes', cursive;
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
        
        /* ===== CARTE PRINCIPALE ===== */
        .card-display {
            max-width: 800px;
            margin: 0 auto 60px;
            animation: cardGlow 4s infinite ease-in-out;
        }
        
        .card-container {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 5px solid white;
        }
        
        /* Template styles for card */
        .card-classique { background: linear-gradient(135deg, #f8c8dc, #e0bbe4); color: #5a4a4a; }
        .card-modern { background: linear-gradient(135deg, #a5f3fc, #e0f7ff); color: #1e3a8a; }
        .card-elegant { background: linear-gradient(135deg, #ffd1dc, #fff0f5); color: #8b0000; }
        .card-festif { background: linear-gradient(135deg, #2e8b57, #90ee90); color: white; }
        .card-romantic { background: linear-gradient(135deg, #ffb6c1, #ff8fa3); color: white; }
        .card-golden { background: linear-gradient(135deg, #ffd700, #ffec8b); color: #8b4513; }
        
        .card-header {
            padding: 50px 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .card-header::before {
            content: '✨';
            position: absolute;
            top: 20px;
            left: 40px;
            font-size: 2rem;
            animation: sparkleEffect 2s infinite;
        }
        
        .card-header::after {
            content: '✨';
            position: absolute;
            top: 20px;
            right: 40px;
            font-size: 2rem;
            animation: sparkleEffect 2s infinite reverse;
        }
        
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .card-fromto {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }
        
        .card-date {
            font-size: 1.1rem;
            opacity: 0.8;
            margin-top: 10px;
        }
        
        .card-body {
            padding: 40px;
            text-align: center;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .card-emoji {
            font-size: 4rem;
            margin-bottom: 30px;
            animation: sparkleEffect 3s infinite;
        }
        
        .card-message {
            font-size: 1.5rem;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
            white-space: pre-line;
        }
        
        .card-footer {
            padding: 40px;
            text-align: center;
            position: relative;
        }
        
        .card-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
        }
        
        .card-signature {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            margin-bottom: 20px;
        }
        
        .card-wishes {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            opacity: 0.9;
        }
        
        /* ===== INFORMATIONS ===== */
        .card-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 800px;
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
            max-width: 800px;
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
            max-width: 800px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--rose-principal);
        }
        
        .thankyou-title {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            color: var(--rose-fonce);
            margin-bottom: 20px;
        }
        
        .thankyou-text {
            font-size: 1.3rem;
            line-height: 1.8;
            color: var(--noir-doux);
            max-width: 600px;
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
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .view-title { font-size: 2.8rem; }
            .view-subtitle { font-size: 1.8rem; }
            .card-title { font-size: 2.5rem; }
            .card-fromto { font-size: 1.8rem; }
            .card-message { font-size: 1.3rem; }
            .card-emoji { font-size: 3rem; }
            .card-signature { font-size: 2.2rem; }
            .card-wishes { font-size: 1.8rem; }
            .info-grid { grid-template-columns: 1fr; }
            .actions-grid { grid-template-columns: repeat(2, 1fr); }
            .thankyou-title { font-size: 2.8rem; }
        }
        
        @media (max-width: 480px) {
            .view-title { font-size: 2.2rem; }
            .card-title { font-size: 2rem; }
            .card-header { padding: 30px 20px; }
            .card-body { padding: 30px 20px; }
            .card-footer { padding: 30px 20px; }
            .actions-grid { grid-template-columns: 1fr; }
            .footer-links { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>

    @include('components.floating-home')

    <!-- Confettis animés -->
    <div id="confettiContainer"></div>
    
    <div class="container">
        <!-- Header -->
        <header class="header-view">
            <h1 class="view-title">Carte de Vœux Reçue!</h1>
            <p class="view-subtitle">Quelqu'un pense à vous avec affection</p>
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

        <!-- Carte principale -->
        <div class="card-display">
            <div class="card-container card-{{ $card->template }}">
                <div class="card-header">
                    <h2 class="card-title">{{ $card->title }}</h2>
                    <div class="card-fromto">
                        De: <strong>{{ $card->from_name }}</strong> • Pour: <strong>{{ $card->to_name }}</strong>
                    </div>
                    <div class="card-date">
                        Envoyée le {{ $card->created_at->translatedFormat('d F Y') }} à {{ $card->created_at->format('H:i') }}
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="card-emoji">{{ $card->emoji }}</div>
                    <div class="card-message">{{ $card->message }}</div>
                </div>
                
                <div class="card-footer">
                    <div class="card-signature">{{ $card->from_name }}</div>
                    <div class="card-wishes">Bonne Année {{ now()->year }}! 🎊</div>
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
        <div class="card-info">
            <h2 class="info-title"><i class="fas fa-info-circle"></i> Informations</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="info-label">Expéditeur</span>
                    <span class="info-value">{{ $card->from_name }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="info-label">Destinataire</span>
                    <span class="info-value">{{ $card->to_name }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <span class="info-label">Style</span>
                    <span class="info-value">
                        @switch($card->template)
                            @case('classique') Classique @break
                            @case('modern') Moderne @break
                            @case('elegant') Élégant @break
                            @case('festif') Festif @break
                            @case('romantic') Romantique @break
                            @case('golden') Doré @break
                            @default Classique
                        @endswitch
                    </span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span class="info-label">Vues</span>
                    <span class="info-value">{{ $card->views }} vue(s)</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="info-label">Date</span>
                    <span class="info-value">{{ $card->created_at->translatedFormat('d F Y') }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <span class="info-label">Partage</span>
                    <span class="info-value">
                        <span id="shareCount">{{ $card->shares ?? 0 }}</span> partage(s)
                    </span>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <div style="font-size: 1.2rem; color: var(--noir-doux); margin-bottom: 15px;">
                    <i class="fas fa-qrcode"></i> <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" rel="noopener noreferrer">Scanner pour partager</a>
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
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="action-btn" id="replyBtn">
                    <div class="action-icon">
                        <i class="fas fa-reply"></i>
                    </div>
                    <span class="action-label">Répondre</span>
                </a>
                
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="action-btn" id="downloadBtn">
                    <div class="action-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <span class="action-label">Télécharger</span>
                </a>
                
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="action-btn" id="shareBtn">
                    <div class="action-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <span class="action-label">Partager</span>
                </a>
                
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="action-btn" id="printBtn">
                    <div class="action-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <span class="action-label">Imprimer</span>
                </a>
                
                <a href="/create-card" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <span class="action-label">Créer la mienne</span>
                </a>
                
                <a href="/" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="action-label">Accueil</span>
                </a>
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
      
        <!-- Message de remerciement -->
        <div class="thankyou-section">
            <h2 class="thankyou-title">Merci d'avoir visité!</h2>
            <p class="thankyou-text">
                Cette carte de vœux a été créée avec amour et attention pour vous. 
                Les pensées les plus chaleureuses vous sont adressées pour cette nouvelle année.
            </p>
            <div style="font-size: 4rem; margin: 20px 0;">
                🎊✨🎉
            </div>
            <p style="font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--rose-fonce);">
                Que 2025 vous apporte bonheur et succès!
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
                Partagé avec ❤️ via Féérie de Noël
            </p>
            <div class="footer-links">
                <a href="/create-card" class="footer-link">
                    <i class="fas fa-plus"></i> Créer ma carte
                </a>
                <a href="/create-letter" class="footer-link">
                    <i class="fas fa-envelope"></i> Écrire une lettre
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
 
    <!-- Modal de réponse -->
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Répondre à {{ $card->from_name }}</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Envoyez un message de remerciement à {{ $card->from_name }}
                    </p>
                    <textarea id="replyMessage" placeholder="Écrivez votre message ici..." 
                              style="width: 100%; padding: 15px; border: 2px solid var(--rose-clair); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 1rem; min-height: 150px; resize: vertical;"></textarea>
                </div>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button class="action-btn" id="sendReplyBtn" style="padding: 12px 30px; border: none;">
                        <i class="fas fa-paper-plane"></i> Envoyer
                    </button>
                    <button class="action-btn" id="cancelReplyBtn" style="padding: 12px 30px; background: transparent; border: 2px solid var(--rose-fonce); color: var(--rose-fonce);">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de partage -->
    <div class="modal" id="shareModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Partager cette carte</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Choisissez comment partager cette belle carte:
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
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Opération réussie!</span>
    </div>

    <x-footer></x-footer>
    
    <!-- Bibliothèque QR Code -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    
    <script>
        // ===== VARIABLES =====
        const cardId = "{{ $card->unique_id }}";
        const shareUrl = "{{ route('cards.show', $card->unique_id) }}";
        const cardTitle = "{{ $card->title }}";
        const fromName = "{{ $card->from_name }}";
        const toName = "{{ $card->to_name }}";
        
        // ===== CONFÉTIS =====
        function createConfetti() {
            const colors = ['#ff8fa3', '#ffd700', '#d8b4fe', '#a5f3fc', '#2e8b57'];
            const container = document.getElementById('confettiContainer');
            
            for (let i = 0; i < 30; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.width = Math.random() * 20 + 10 + 'px';
                    confetti.style.height = confetti.style.width;
                    confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                    confetti.style.animationDelay = Math.random() * 5 + 's';
                    
                    container.appendChild(confetti);
                    
                    setTimeout(() => {
                        confetti.remove();
                    }, 7000);
                }, i * 100);
            }
        }
        
        // Lancer les confettis au chargement et périodiquement
        window.addEventListener('load', function() {
            createConfetti();
            setInterval(createConfetti, 10000);
            
            // Générer QR Code
            generateQRCode();
        });
        
        // ===== QR CODE =====
        function generateQRCode() {
            QRCode.toCanvas(document.getElementById('qrcode'), shareUrl, {
                width: 150,
                height: 150,
                color: {
                    dark: '#ff8fa3',
                    light: '#ffffff'
                },
                margin: 1
            }, function(error) {
                if (error) console.error(error);
            });
        }
        
        // ===== MODAL DE RÉPONSE =====
        document.getElementById('replyBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('replyModal').style.display = 'flex';
        });
        
        document.getElementById('sendReplyBtn').addEventListener('click', function() {
            const message = document.getElementById('replyMessage').value.trim();
            if (!message) {
                showNotification('Veuillez écrire un message', 'error');
                return;
            }
            
            // Ici, vous pourriez envoyer le message au backend
            showNotification('Message envoyé à ' + fromName, 'success');
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
            
            // Capture de la carte comme image
            const card = document.querySelector('.card-container');
            html2canvas(card, {
                backgroundColor: null,
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = `carte-voeux-${cardId}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                showNotification('Carte téléchargée avec succès!', 'success');
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
                shareCard(platform);
            });
        });
        
        function shareCard(platform) {
            const message = `🎊 J'ai reçu une belle carte de vœux de ${fromName}!\n\n"${cardTitle}"\n\nDécouvrez-la ici: ${shareUrl}\n\nJoyeuses fêtes! ✨`;
            
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
                    window.location.href = `mailto:?subject=Carte de vœux de ${fromName}&body=${encodeURIComponent(message)}`;
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
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${cardTitle} - Carte de Vœux</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap');
                        
                        body { 
                            font-family: Arial, sans-serif; 
                            margin: 0; 
                            padding: 40px; 
                            background: #f9f9f9; 
                        }
                        
                        .print-card { 
                            max-width: 800px; 
                            margin: 0 auto; 
                            border-radius: 20px; 
                            overflow: hidden; 
                            box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
                            border: 5px solid white; 
                            background: linear-gradient(135deg, 
                                ${getTemplateGradient({{ json_encode($card->template) }})}
                            ); 
                            color: ${getTextColor({{ json_encode($card->template) }})}; 
                        }
                        
                        .print-header { 
                            padding: 40px; 
                            text-align: center; 
                            border-bottom: 2px dashed rgba(255,255,255,0.3); 
                        }
                        
                        .print-title { 
                            font-family: 'Playfair Display', serif; 
                            font-size: 2.5rem; 
                            font-weight: 700; 
                            margin-bottom: 20px; 
                        }
                        
                        .print-fromto { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 1.8rem; 
                            margin-bottom: 10px; 
                        }
                        
                        .print-date { 
                            font-size: 1rem; 
                            opacity: 0.8; 
                            margin-top: 10px; 
                        }
                        
                        .print-body { 
                            padding: 40px; 
                            text-align: center; 
                            min-height: 200px; 
                        }
                        
                        .print-emoji { 
                            font-size: 3rem; 
                            margin-bottom: 20px; 
                        }
                        
                        .print-message { 
                            font-size: 1.3rem; 
                            line-height: 1.8; 
                            white-space: pre-line; 
                        }
                        
                        .print-footer { 
                            padding: 40px; 
                            text-align: center; 
                            border-top: 2px dashed rgba(255,255,255,0.3); 
                        }
                        
                        .print-signature { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 2.2rem; 
                            margin-bottom: 15px; 
                        }
                        
                        .print-wishes { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 1.8rem; 
                            opacity: 0.9; 
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
                            .print-card { box-shadow: none; border: 1px solid #ddd; }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-card">
                        <div class="print-header">
                            <h2 class="print-title">${cardTitle}</h2>
                            <div class="print-fromto">
                                De: <strong>${fromName}</strong> • Pour: <strong>${toName}</strong>
                            </div>
                            <div class="print-date">
                                Envoyée le {{ $card->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        
                        <div class="print-body">
                            <div class="print-emoji">{{ $card->emoji }}</div>
                            <div class="print-message">{{ $card->message }}</div>
                        </div>
                        
                        <div class="print-footer">
                            <div class="print-signature">${fromName}</div>
                            <div class="print-wishes">Bonne Année {{ now()->year }}! 🎊</div>
                        </div>
                    </div>
                    
                    <div class="print-info">
                        <p>Carte créée via Féérie de Noël • {{ url('/') }}</p>
                        <p>Partagée avec ❤️ le {{ now()->translatedFormat('d F Y à H:i') }}</p>
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
        
        function getTemplateGradient(template) {
            const gradients = {
                'classique': '#f8c8dc, #e0bbe4',
                'modern': '#a5f3fc, #e0f7ff',
                'elegant': '#ffd1dc, #fff0f5',
                'festif': '#2e8b57, #90ee90',
                'romantic': '#ffb6c1, #ff8fa3',
                'golden': '#ffd700, #ffec8b'
            };
            return gradients[template] || gradients['classique'];
        }
        
        function getTextColor(template) {
            const colors = {
                'classique': '#5a4a4a',
                'modern': '#1e3a8a',
                'elegant': '#8b0000',
                'festif': 'white',
                'romantic': 'white',
                'golden': '#8b4513'
            };
            return colors[template] || '#5a4a4a';
        }
        
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
            fetch(`/cards/${cardId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ method: 'share' })
            }).catch(error => console.error('Erreur:', error));
        }
        
        // ===== ANIMATION DE LA CARTE =====
        window.addEventListener('load', function() {
            const card = document.querySelector('.card-container');
            card.style.transform = 'scale(0.9)';
            card.style.opacity = '0';
            
            setTimeout(() => {
                card.style.transition = 'all 1s ease';
                card.style.transform = 'scale(1)';
                card.style.opacity = '1';
            }, 500);
        });
    </script>
    
    <!-- Bibliothèque pour capture d'écran -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</body>
</html>