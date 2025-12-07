<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $poster->title }} - Affiche de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --turquoise: #40e0d0;
            --rouge-cadeau: #ff6b6b;
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
        
        /* ===== ANIMATIONS ===== */
        @keyframes floatElement {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }
        
        @keyframes posterGlow {
            0%, 100% { box-shadow: 0 25px 50px rgba(255, 182, 193, 0.4); }
            50% { box-shadow: 0 30px 60px rgba(255, 182, 193, 0.7); }
        }
        
        @keyframes starTwinkle {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        
        /* ===== ÉLÉMENTS DÉCORATIFS ===== */
        .floating-star {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.2;
            z-index: 0;
            pointer-events: none;
            animation: floatElement 8s infinite ease-in-out;
        }
        
        .star-1 { top: 10%; left: 5%; animation-delay: 0s; }
        .star-2 { top: 20%; right: 10%; animation-delay: 2s; }
        .star-3 { bottom: 15%; left: 8%; animation-delay: 4s; }
        .star-4 { bottom: 25%; right: 15%; animation-delay: 6s; }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        /* ===== HEADER ===== */
        .header-poster {
            text-align: center;
            padding: 50px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            background: linear-gradient(45deg, var(--rose-principal), var(--violet-doux), var(--turquoise));
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            box-shadow: 0 20px 40px rgba(255, 182, 193, 0.4);
        }
        
        .view-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .view-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== AFFICHE PRINCIPALE ===== */
        .poster-display {
            max-width: 1000px;
            margin: 0 auto 60px;
            animation: posterGlow 4s infinite ease-in-out;
        }
        
        .poster-container {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            border: 10px solid white;
            background: white;
            padding: 20px;
        }
        
        .poster-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            border: 5px solid #8b4513;
            background: white;
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);
        }
        
        .poster-image {
            width: 100%;
            height: auto;
            display: block;
            background: white;
            min-height: 600px;
            position: relative;
        }
        
        /* Cadre décoratif */
        .frame-decoration {
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 3px dashed var(--rose-fonce);
            border-radius: 25px;
            pointer-events: none;
            z-index: 1;
        }
        
        .frame-corner {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid var(--or);
            border-radius: 10px;
        }
        
        .corner-tl { top: -5px; left: -5px; border-right: none; border-bottom: none; }
        .corner-tr { top: -5px; right: -5px; border-left: none; border-bottom: none; }
        .corner-bl { bottom: -5px; left: -5px; border-right: none; border-top: none; }
        .corner-br { bottom: -5px; right: -5px; border-left: none; border-top: none; }
        
        /* ===== INFORMATIONS ===== */
        .poster-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
        }
        
        .info-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
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
        
        /* ===== STATISTIQUES ===== */
        .stats-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
            border: 2px dashed var(--rose-fonce);
        }
        
        .stats-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .stat-item {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 143, 163, 0.2);
        }
        
        .stat-icon {
            font-size: 3rem;
            color: var(--rose-fonce);
            margin-bottom: 20px;
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--noir-doux);
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #7a6a6a;
            font-weight: 600;
        }
        
        /* ===== ACTIONS ===== */
        .actions-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            text-align: center;
        }
        
        .actions-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
            color: var(--rose-fonce);
            margin-bottom: 40px;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .action-btn {
            padding: 25px 20px;
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
            font-size: 2.8rem;
            color: var(--rose-fonce);
        }
        
        .action-btn:hover .action-icon {
            color: white;
        }
        
        .action-label {
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        /* ===== MESSAGE DE REMERCIEMENT ===== */
        .thankyou-section {
            text-align: center;
            padding: 60px 40px;
            margin: 60px auto;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--rose-principal);
        }
        
        .thankyou-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            color: var(--rose-fonce);
            margin-bottom: 20px;
        }
        
        .thankyou-text {
            font-size: 1.3rem;
            line-height: 1.8;
            color: var(--noir-doux);
            max-width: 800px;
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
            font-weight: 700;
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
            max-width: 600px;
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
        @media (max-width: 992px) {
            .container { padding: 15px; }
            .view-title { font-size: 3.2rem; }
            .view-subtitle { font-size: 2rem; }
            .poster-display { max-width: 90%; }
            .info-grid { grid-template-columns: repeat(2, 1fr); }
            .actions-grid { grid-template-columns: repeat(2, 1fr); }
            .thankyou-title { font-size: 2.8rem; }
        }
        
        @media (max-width: 768px) {
            .view-title { font-size: 2.5rem; }
            .info-title { font-size: 2.2rem; }
            .actions-title { font-size: 2.2rem; }
            .info-grid { grid-template-columns: 1fr; }
            .actions-grid { grid-template-columns: 1fr; }
            .poster-image { min-height: 400px; }
        }
        
        @media (max-width: 480px) {
            .view-title { font-size: 2rem; }
            .footer-links { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>
    <!-- Étoiles flottantes décoratives -->
    <div class="floating-star star-1">⭐</div>
    <div class="floating-star star-2">✨</div>
    <div class="floating-star star-3">🌟</div>
    <div class="floating-star star-4">💫</div>
    
    <div class="container">
        <!-- Header -->
        <header class="header-poster">
            <h1 class="view-title">AFFICHE DE NOËL</h1>
            <p class="view-subtitle">Une création unique et personnalisée</p>
        </header>
        
        <!-- Affiche principale -->
        <div class="poster-display">
            <div class="poster-container">
                <div class="poster-frame">
                    <!-- Cadre décoratif -->
                    <div class="frame-decoration"></div>
                    <div class="frame-corner corner-tl"></div>
                    <div class="frame-corner corner-tr"></div>
                    <div class="frame-corner corner-bl"></div>
                    <div class="frame-corner corner-br"></div>
                    
                    <!-- Image de l'affiche -->
                    <img src="{{ $poster->image_url ?? $poster->canvas_data }}" 
                         alt="{{ $poster->title }}" 
                         class="poster-image"
                         id="posterImage"
                         onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"600\" viewBox=\"0 0 800 600\"><rect width=\"800\" height=\"600\" fill=\"%23ffebf0\"/><text x=\"400\" y=\"300\" font-family=\"Arial\" font-size=\"24\" text-anchor=\"middle\" fill=\"%23ff8fa3\">Affiche de Noël</text></svg>'">
                </div>
            </div>
        </div>
        
        <!-- Informations -->
        <div class="poster-info">
            <h2 class="info-title"><i class="fas fa-info-circle"></i> Détails de l'affiche</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-heading"></i>
                    </div>
                    <span class="info-label">Titre</span>
                    <span class="info-value">{{ $poster->title }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="info-label">Noms affichés</span>
                    <span class="info-value">{{ $poster->names }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <span class="info-label">Style</span>
                    <span class="info-value">
                        @switch($poster->style)
                            @case('festif') Festif @break
                            @case('elegant') Élégant @break
                            @case('familial') Familial @break
                            @case('romantique') Romantique @break
                            @default Festif
                        @endswitch
                    </span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="info-label">Année</span>
                    <span class="info-value">{{ $poster->year }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span class="info-label">Vues</span>
                    <span class="info-value">{{ $poster->views }}</span>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <span class="info-label">Partages</span>
                    <span class="info-value">
                        <span id="shareCount">{{ $poster->shares ?? 0 }}</span>
                    </span>
                </div>
            </div>
            
            <!-- Message (si présent) -->
            @if($poster->message)
            <div style="background: var(--rose-clair); border-radius: 15px; padding: 25px; margin-top: 30px;">
                <h3 style="font-family: 'Dancing Script', cursive; font-size: 1.8rem; color: var(--rose-fonce); margin-bottom: 15px;">
                    <i class="fas fa-quote-left"></i> Message
                </h3>
                <p style="font-size: 1.2rem; line-height: 1.6; color: var(--noir-doux);">
                    {{ $poster->message }}
                </p>
            </div>
            @endif
            
            <!-- QR Code -->
            <div style="text-align: center; margin-top: 40px;">
                <div style="font-size: 1.2rem; color: var(--noir-doux); margin-bottom: 15px;">
                    <i class="fas fa-qrcode"></i> Scanner pour partager
                </div>
                <div id="qrcode" style="display: inline-block; padding: 20px; background: white; border-radius: 15px;"></div>
            </div>
        </div>
        
        <!-- Statistiques -->
        <div class="stats-section">
            <h2 class="stats-title"><i class="fas fa-chart-line"></i> Statistiques</h2>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-value">{{ $poster->views }}</div>
                    <div class="stat-label">Vues totales</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="stat-value">
                        <span id="statShareCount">{{ $poster->shares ?? 0 }}</span>
                    </div>
                    <div class="stat-label">Partages</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-value">{{ $poster->year }}</div>
                    <div class="stat-label">Année</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value">
                        {{ count(explode(',', $poster->names)) }}
                    </div>
                    <div class="stat-label">Personnes</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-value" id="likeCount">0</div>
                    <div class="stat-label">J'aime</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-value" id="downloadCount">0</div>
                    <div class="stat-label">Téléchargements</div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions-section">
            <h2 class="actions-title"><i class="fas fa-magic"></i> Que souhaitez-vous faire?</h2>
            
            <div class="actions-grid">
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
                
                <a href="#" class="action-btn" id="likeBtn">
                    <div class="action-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="action-label">J'aime</span>
                </a>
                
                <a href="/create-poster" class="action-btn">
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
            
            <!-- Boutons supplémentaires -->
            <div style="margin-top: 40px; display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <button class="action-btn" id="editBtn" style="padding: 15px 30px; border: 2px solid var(--turquoise);">
                    <i class="fas fa-edit" style="color: var(--turquoise);"></i>
                    <span>Modifier</span>
                </button>
                
                <button class="action-btn" id="frameBtn" style="padding: 15px 30px; border: 2px solid var(--or);">
                    <i class="fas fa-square" style="color: var(--or);"></i>
                    <span>Changer cadre</span>
                </button>
                
                <button class="action-btn" id="orderBtn" style="padding: 15px 30px; border: 2px solid var(--vert-noel); background: var(--vert-noel); color: white;">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Commander</span>
                </button>
            </div>
        </div>
        
        <!-- Galerie des cadres -->
        <div class="actions-section" id="framesSection" style="display: none;">
            <h2 class="actions-title"><i class="fas fa-border-style"></i> Choisissez un cadre</h2>
            
            <div class="actions-grid" style="grid-template-columns: repeat(3, 1fr);">
                <button class="action-btn frame-option" data-frame="classic">
                    <div class="action-icon">
                        <i class="fas fa-square-full"></i>
                    </div>
                    <span class="action-label">Classique</span>
                </button>
                
                <button class="action-btn frame-option" data-frame="gold">
                    <div class="action-icon" style="color: var(--or);">
                        <i class="fas fa-gem"></i>
                    </div>
                    <span class="action-label">Doré</span>
                </button>
                
                <button class="action-btn frame-option" data-frame="wood">
                    <div class="action-icon" style="color: #8b4513;">
                        <i class="fas fa-tree"></i>
                    </div>
                    <span class="action-label">Bois</span>
                </button>
                
                <button class="action-btn frame-option" data-frame="modern">
                    <div class="action-icon" style="color: var(--violet-doux);">
                        <i class="fas fa-border-none"></i>
                    </div>
                    <span class="action-label">Moderne</span>
                </button>
                
                <button class="action-btn frame-option" data-frame="christmas">
                    <div class="action-icon" style="color: var(--vert-noel);">
                        <i class="fas fa-candy-cane"></i>
                    </div>
                    <span class="action-label">Noël</span>
                </button>
                
                <button class="action-btn frame-option" data-frame="none">
                    <div class="action-icon" style="color: var(--rose-fonce);">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <span class="action-label">Sans cadre</span>
                </button>
            </div>
            
            <button class="action-btn" id="closeFramesBtn" style="margin-top: 30px; padding: 15px 30px; background: transparent; border: 2px solid var(--rose-fonce); color: var(--rose-fonce);">
                <i class="fas fa-times"></i> Fermer
            </button>
        </div>
        
        <!-- Message de remerciement -->
        <div class="thankyou-section">
            <h2 class="thankyou-title">Une création unique!</h2>
            <p class="thankyou-text">
                Cette affiche a été créée avec amour et créativité pour immortaliser 
                les moments magiques de Noël. Chaque détail a été pensé pour 
                transmettre la joie et l'esprit festif de cette période spéciale.
            </p>
            <div style="font-size: 4rem; margin: 20px 0; color: var(--rose-fonce);">
                🎨🎄✨
            </div>
            <p style="font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--rose-fonce);">
                Que la magie de Noël habite votre foyer!
            </p>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p style="font-size: 1.1rem; margin-bottom: 15px;">
                Créée avec passion via Féérie de Noël
            </p>
            <div class="footer-links">
                <a href="/create-poster" class="footer-link">
                    <i class="fas fa-paint-brush"></i> Créer une affiche
                </a>
                <a href="/create-letter" class="footer-link">
                    <i class="fas fa-envelope"></i> Écrire une lettre
                </a>
                <a href="/create-card" class="footer-link">
                    <i class="fas fa-gift"></i> Créer une carte
                </a>
                <a href="/create-giftlist" class="footer-link">
                    <i class="fas fa-list"></i> Liste de cadeaux
                </a>
            </div>
        </footer>
    </div>
    
    <!-- Modal de partage -->
    <div class="modal" id="shareModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Partager cette affiche</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Choisissez comment partager cette belle création:
                    </p>
                    <div class="actions-grid" style="grid-template-columns: repeat(2, 1fr); margin-top: 20px;">
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
                        <button class="action-btn share-option" data-platform="pinterest">
                            <i class="fab fa-pinterest"></i>
                            <span>Pinterest</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de commande -->
    <div class="modal" id="orderModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Commander cette affiche</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 25px;">
                    <p style="color: var(--noir-doux); margin-bottom: 15px;">
                        Choisissez le format et les options d'impression:
                    </p>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--noir-doux);">
                            <i class="fas fa-ruler"></i> Format
                        </label>
                        <select id="formatSelect" style="width: 100%; padding: 12px; border: 2px solid var(--rose-clair); border-radius: 10px; font-family: 'Poppins', sans-serif;">
                            <option value="a4">A4 (21x29.7 cm) - 9.99€</option>
                            <option value="a3">A3 (29.7x42 cm) - 14.99€</option>
                            <option value="a2">A2 (42x59.4 cm) - 24.99€</option>
                            <option value="canvas">Toile sur châssis - 39.99€</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--noir-doux);">
                            <i class="fas fa-border-style"></i> Cadre
                        </label>
                        <select id="frameSelect" style="width: 100%; padding: 12px; border: 2px solid var(--rose-clair); border-radius: 10px; font-family: 'Poppins', sans-serif;">
                            <option value="none">Sans cadre</option>
                            <option value="classic">Cadre classique (+7€)</option>
                            <option value="premium">Cadre premium (+15€)</option>
                            <option value="luxury">Cadre de luxe (+25€)</option>
                        </select>
                    </div>
                    
                    <div style="background: var(--rose-clair); padding: 15px; border-radius: 10px; margin-top: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Total estimé:</span>
                            <span id="totalPrice" style="font-weight: bold; color: var(--vert-noel);">9.99€</span>
                        </div>
                        <small style="color: #7a6a6a; display: block;">Frais de port inclus</small>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button class="action-btn" id="confirmOrderBtn" style="padding: 12px 30px; border: none; background: var(--vert-noel);">
                        <i class="fas fa-shopping-cart"></i> Commander
                    </button>
                    <button class="action-btn" id="cancelOrderBtn" style="padding: 12px 30px; background: transparent; border: 2px solid var(--rose-fonce); color: var(--rose-fonce);">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Opération réussie!</span>
    </div>
    
    <!-- Bibliothèque QR Code -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    
    <script>
        // ===== VARIABLES =====
        const posterId = "{{ $poster->unique_id }}";
        const shareUrl = "{{ route('posters.show', $poster->unique_id) }}";
        const posterTitle = "{{ $poster->title }}";
        const posterNames = "{{ $poster->names }}";
        let likeCount = 0;
        let downloadCount = 0;
        
        // ===== INITIALISATION =====
        window.addEventListener('load', function() {
            // Générer QR Code
            generateQRCode();
            
            // Charger les statistiques depuis le localStorage
            loadStatistics();
            
            // Animation d'entrée de l'affiche
            animatePosterEntrance();
            
            // Initialiser les cadres
            initFrames();
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
        
        // ===== STATISTIQUES =====
        function loadStatistics() {
            // Charger depuis le localStorage
            const stats = JSON.parse(localStorage.getItem(`poster_${posterId}_stats`)) || {
                likes: 0,
                downloads: 0
            };
            
            likeCount = stats.likes;
            downloadCount = stats.downloads;
            
            // Mettre à jour l'affichage
            document.getElementById('likeCount').textContent = likeCount;
            document.getElementById('downloadCount').textContent = downloadCount;
        }
        
        function saveStatistics() {
            const stats = {
                likes: likeCount,
                downloads: downloadCount,
                lastUpdated: new Date().toISOString()
            };
            
            localStorage.setItem(`poster_${posterId}_stats`, JSON.stringify(stats));
        }
        
        // ===== ANIMATION D'ENTRÉE =====
        function animatePosterEntrance() {
            const poster = document.querySelector('.poster-container');
            const stars = document.querySelectorAll('.floating-star');
            
            // Initial state
            poster.style.opacity = '0';
            poster.style.transform = 'scale(0.9) translateY(50px)';
            
            stars.forEach(star => {
                star.style.opacity = '0';
            });
            
            // Animate poster
            setTimeout(() => {
                poster.style.transition = 'all 1s ease';
                poster.style.opacity = '1';
                poster.style.transform = 'scale(1) translateY(0)';
            }, 500);
            
            // Animate stars with delay
            stars.forEach((star, index) => {
                setTimeout(() => {
                    star.style.transition = 'opacity 1s ease';
                    star.style.opacity = '0.2';
                }, 800 + (index * 300));
            });
        }
        
        // ===== TÉLÉCHARGEMENT =====
        document.getElementById('downloadBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const posterImage = document.getElementById('posterImage');
            const link = document.createElement('a');
            
            // Si c'est une URL, télécharger directement
            if (posterImage.src.startsWith('http') || posterImage.src.startsWith('data:')) {
                link.download = `affiche-noel-${posterId}.png`;
                link.href = posterImage.src;
                link.click();
                
                // Incrémenter le compteur de téléchargements
                downloadCount++;
                document.getElementById('downloadCount').textContent = downloadCount;
                saveStatistics();
                
                showNotification('Affiche téléchargée avec succès!', 'success');
            } else {
                // Sinon, utiliser html2canvas
                html2canvas(document.querySelector('.poster-frame'), {
                    backgroundColor: '#ffffff',
                    scale: 2,
                    useCORS: true,
                    logging: false
                }).then(canvas => {
                    link.download = `affiche-noel-${posterId}.png`;
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                    
                    // Incrémenter le compteur de téléchargements
                    downloadCount++;
                    document.getElementById('downloadCount').textContent = downloadCount;
                    saveStatistics();
                    
                    showNotification('Affiche téléchargée avec succès!', 'success');
                }).catch(error => {
                    console.error('Erreur de capture:', error);
                    showNotification('Erreur lors du téléchargement', 'error');
                });
            }
        });
        
        // ===== PARTAGE =====
        document.getElementById('shareBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('shareModal').style.display = 'flex';
        });
        
        document.querySelectorAll('.share-option').forEach(btn => {
            btn.addEventListener('click', function() {
                const platform = this.dataset.platform;
                sharePoster(platform);
            });
        });
        
        function sharePoster(platform) {
            const message = `🎨 Découvrez cette magnifique affiche de Noël!\n\n"${posterTitle}"\nAvec: ${posterNames}\n\nRegardez-la ici: ${shareUrl}\n\nJoyeuses fêtes! 🎄✨`;
            
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
                    window.location.href = `mailto:?subject=Affiche de Noël: ${posterTitle}&body=${encodeURIComponent(message)}`;
                    break;
                    
                case 'pinterest':
                    const imageUrl = document.getElementById('posterImage').src;
                    window.open(`https://pinterest.com/pin/create/button/?url=${encodeURIComponent(shareUrl)}&media=${encodeURIComponent(imageUrl)}&description=${encodeURIComponent(message)}`, '_blank');
                    break;
                    
                case 'copy':
                    navigator.clipboard.writeText(shareUrl)
                        .then(() => showNotification('Lien copié dans le presse-papier!', 'success'))
                        .catch(() => showNotification('Impossible de copier le lien', 'error'));
                    break;
            }
            
            // Incrémenter le compteur de partages
            incrementShareCount();
            
            // Fermer le modal après un court délai
            setTimeout(() => {
                document.getElementById('shareModal').style.display = 'none';
            }, 1000);
        }
        
        function incrementShareCount() {
            const shareCountElement = document.getElementById('shareCount');
            const statShareCountElement = document.getElementById('statShareCount');
            
            let currentCount = parseInt(shareCountElement.textContent) || 0;
            currentCount++;
            
            shareCountElement.textContent = currentCount;
            statShareCountElement.textContent = currentCount;
            
            // Envoyer au backend
            fetch(`/posters/${posterId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ method: 'share' })
            }).catch(error => console.error('Erreur:', error));
        }
        
        // ===== IMPRESSION =====
        document.getElementById('printBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const printWindow = window.open('', '_blank');
            const posterImage = document.getElementById('posterImage').src;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${posterTitle} - Affiche de Noël</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap');
                        
                        body { 
                            font-family: 'Montserrat', sans-serif; 
                            margin: 0; 
                            padding: 40px; 
                            background: #f9f9f9; 
                            color: #5a4a4a; 
                        }
                        
                        .print-container { 
                            max-width: 800px; 
                            margin: 0 auto; 
                            text-align: center; 
                        }
                        
                        .print-header { 
                            margin-bottom: 40px; 
                            padding-bottom: 20px; 
                            border-bottom: 3px solid #ffb6c1; 
                        }
                        
                        .print-title { 
                            font-size: 2.5rem; 
                            color: #ff8fa3; 
                            margin: 0 0 10px; 
                        }
                        
                        .print-subtitle { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 1.8rem; 
                            color: #666; 
                            margin-bottom: 20px; 
                        }
                        
                        .print-poster { 
                            margin: 30px 0; 
                            border: 5px solid #8b4513; 
                            border-radius: 15px; 
                            overflow: hidden; 
                            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
                        }
                        
                        .print-poster img { 
                            width: 100%; 
                            height: auto; 
                            display: block; 
                        }
                        
                        .print-info { 
                            margin: 30px 0; 
                            padding: 20px; 
                            background: #ffebf0; 
                            border-radius: 15px; 
                            text-align: left; 
                        }
                        
                        .print-info h3 { 
                            color: #ff8fa3; 
                            margin-bottom: 15px; 
                        }
                        
                        .print-footer { 
                            margin-top: 40px; 
                            padding-top: 20px; 
                            border-top: 1px solid #ddd; 
                            color: #666; 
                            font-size: 0.9rem; 
                        }
                        
                        @media print {
                            body { padding: 20px; background: white; }
                            .print-poster { border: 2px solid #8b4513; box-shadow: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-container">
                        <div class="print-header">
                            <h1 class="print-title">${posterTitle}</h1>
                            <div class="print-subtitle">Avec: ${posterNames}</div>
                            <div style="color: #666;">Année: {{ $poster->year }}</div>
                        </div>
                        
                        <div class="print-poster">
                            <img src="${posterImage}" alt="${posterTitle}">
                        </div>
                        
                        <div class="print-info">
                            <h3>Détails de l'affiche</h3>
                            <p><strong>Titre:</strong> ${posterTitle}</p>
                            <p><strong>Noms:</strong> ${posterNames}</p>
                            <p><strong>Année:</strong> {{ $poster->year }}</p>
                            <p><strong>Style:</strong> {{ $poster->style }}</p>
                            ${poster.message ? `<p><strong>Message:</strong> {{ $poster->message }}</p>` : ''}
                        </div>
                        
                        <div class="print-footer">
                            <p>Créée via Féérie de Noël • {{ url('/') }}</p>
                            <p>Imprimée le ${new Date().toLocaleDateString('fr-FR')}</p>
                            <p>Partagez la magie de Noël! 🎄✨</p>
                        </div>
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
        
        // ===== J'AIME =====
        document.getElementById('likeBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            likeCount++;
            document.getElementById('likeCount').textContent = likeCount;
            saveStatistics();
            
            // Animation du cœur
            const heartIcon = this.querySelector('.action-icon');
            heartIcon.style.color = 'var(--rouge-cadeau)';
            heartIcon.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                heartIcon.style.transform = 'scale(1.3)';
            }, 10);
            
            setTimeout(() => {
                heartIcon.style.transform = 'scale(1)';
            }, 300);
            
            showNotification('Merci pour votre like! ❤️', 'success');
            
            // Envoyer au backend
            fetch(`/posters/${posterId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).catch(error => console.error('Erreur:', error));
        });
        
        // ===== GESTION DES CADRES =====
        function initFrames() {
            document.getElementById('frameBtn').addEventListener('click', function() {
                document.getElementById('framesSection').style.display = 'block';
                this.scrollIntoView({ behavior: 'smooth' });
            });
            
            document.getElementById('closeFramesBtn').addEventListener('click', function() {
                document.getElementById('framesSection').style.display = 'none';
            });
            
            document.querySelectorAll('.frame-option').forEach(btn => {
                btn.addEventListener('click', function() {
                    const frameType = this.dataset.frame;
                    applyFrame(frameType);
                    showNotification('Cadre appliqué avec succès!', 'success');
                });
            });
        }
        
        function applyFrame(frameType) {
            const frame = document.querySelector('.poster-frame');
            const corners = document.querySelectorAll('.frame-corner');
            const decoration = document.querySelector('.frame-decoration');
            
            // Réinitialiser
            frame.style.border = '5px solid #8b4513';
            decoration.style.borderColor = 'var(--rose-fonce)';
            
            corners.forEach(corner => {
                corner.style.borderColor = 'var(--or)';
            });
            
            switch(frameType) {
                case 'classic':
                    frame.style.border = '10px solid #8b4513';
                    decoration.style.border = '5px solid #d4a76a';
                    break;
                    
                case 'gold':
                    frame.style.border = '15px solid var(--or)';
                    decoration.style.border = '3px solid #ffd700';
                    corners.forEach(corner => {
                        corner.style.borderColor = '#ffd700';
                        corner.style.borderWidth = '5px';
                    });
                    break;
                    
                case 'wood':
                    frame.style.border = '12px solid #8b4513';
                    frame.style.borderImage = 'repeating-linear-gradient(45deg, #8b4513, #a0522d 10px, #8b4513 20px) 30';
                    break;
                    
                case 'modern':
                    frame.style.border = '2px solid var(--noir-doux)';
                    decoration.style.display = 'none';
                    corners.forEach(corner => {
                        corner.style.display = 'none';
                    });
                    break;
                    
                case 'christmas':
                    frame.style.border = '8px solid var(--vert-noel)';
                    decoration.style.border = '3px dashed var(--rouge-cadeau)';
                    corners.forEach(corner => {
                        corner.style.borderColor = 'var(--rouge-cadeau)';
                    });
                    break;
                    
                case 'none':
                    frame.style.border = 'none';
                    decoration.style.display = 'none';
                    corners.forEach(corner => {
                        corner.style.display = 'none';
                    });
                    break;
            }
        }
        
        // ===== COMMANDE =====
        document.getElementById('orderBtn').addEventListener('click', function() {
            document.getElementById('orderModal').style.display = 'flex';
        });
        
        document.getElementById('confirmOrderBtn').addEventListener('click', function() {
            const format = document.getElementById('formatSelect').value;
            const frame = document.getElementById('frameSelect').value;
            
            showNotification('Commande envoyée! Vous recevrez un email de confirmation.', 'success');
            document.getElementById('orderModal').style.display = 'none';
            
            // Ici, vous enverriez la commande au backend
            console.log('Commande:', { format, frame, posterId });
        });
        
        document.getElementById('cancelOrderBtn').addEventListener('click', function() {
            document.getElementById('orderModal').style.display = 'none';
        });
        
        // Calcul du prix
        document.getElementById('formatSelect').addEventListener('change', updateTotalPrice);
        document.getElementById('frameSelect').addEventListener('change', updateTotalPrice);
        
        function updateTotalPrice() {
            const formatPrices = {
                'a4': 9.99,
                'a3': 14.99,
                'a2': 24.99,
                'canvas': 39.99
            };
            
            const framePrices = {
                'none': 0,
                'classic': 7,
                'premium': 15,
                'luxury': 25
            };
            
            const format = document.getElementById('formatSelect').value;
            const frame = document.getElementById('frameSelect').value;
            
            const total = formatPrices[format] + framePrices[frame];
            document.getElementById('totalPrice').textContent = total.toFixed(2) + '€';
        }
        
        // Initialiser le prix
        updateTotalPrice();
        
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
        
        // ===== ÉDITION =====
        document.getElementById('editBtn').addEventListener('click', function() {
            showNotification('Fonctionnalité d\'édition bientôt disponible!', 'info');
        });
    </script>
    
    <!-- Bibliothèque pour capture d'écran -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</body>
</html>