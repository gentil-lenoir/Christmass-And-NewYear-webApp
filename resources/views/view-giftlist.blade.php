<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $giftList->title }} - Liste de Cadeaux</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Cookie&family=Parisienne&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --rose-principal: #ffb6c1;
            --rose-clair: #ffebf0;
            --rose-fonce: #ff8fa3;
            --vert-noel: #2e8b57;
            --or: #ffd700;
            --blanc: #fff9fb;
            --noir-doux: #5a4a4a;
            --rouge-cadeau: #ff6b6b;
            --bleu-clair: #a5f3fc;
            --violet-doux: #d8b4fe;
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
        @keyframes giftBounce {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(-5deg); }
            75% { transform: translateY(-5px) rotate(5deg); }
        }
        
        @keyframes ribbonWave {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(3deg); }
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        /* ===== CADEAUX FLOTTANTS ===== */
        .floating-gift {
            position: fixed;
            font-size: 3rem;
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
            animation: giftBounce 6s infinite ease-in-out;
        }
        
        .gift-1 { top: 10%; left: 5%; animation-delay: 0s; }
        .gift-2 { top: 20%; right: 10%; animation-delay: 2s; }
        .gift-3 { bottom: 15%; left: 8%; animation-delay: 4s; }
        .gift-4 { bottom: 25%; right: 15%; animation-delay: 6s; }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        /* ===== HEADER ===== */
        .header-giftlist {
            text-align: center;
            padding: 50px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            background: linear-gradient(45deg, var(--rouge-cadeau), var(--or), var(--violet-doux));
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
            box-shadow: 0 20px 40px rgba(255, 107, 107, 0.3);
        }
        
        .view-title {
            font-family: 'Cookie', cursive;
            font-size: 4.5rem;
            font-weight: 400;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            letter-spacing: 2px;
        }
        
        .view-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== RUBAN ===== */
        .ribbon {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 250px;
            height: 40px;
            background: var(--vert-noel);
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 5px 15px rgba(46, 139, 87, 0.3);
            animation: ribbonWave 4s infinite ease-in-out;
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
        }
        
        .ribbon::before, .ribbon::after {
            content: '';
            position: absolute;
            bottom: -20px;
            border: 20px solid var(--vert-noel);
            border-bottom-color: transparent;
        }
        
        .ribbon::before {
            left: -20px;
            border-left-color: transparent;
        }
        
        .ribbon::after {
            right: -20px;
            border-right-color: transparent;
        }
        
        /* ===== INFORMATIONS DE LA LISTE ===== */
        .list-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 0 auto 40px;
            max-width: 1000px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            text-align: center;
        }
        
        .list-owner {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            color: var(--rose-fonce);
            margin-bottom: 20px;
        }
        
        .list-message {
            font-size: 1.3rem;
            line-height: 1.8;
            color: var(--noir-doux);
            max-width: 800px;
            margin: 0 auto 30px;
            padding: 25px;
            background: var(--rose-clair);
            border-radius: 15px;
            border-left: 5px solid var(--rose-fonce);
        }
        
        .list-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            .list-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .list-stats {
                grid-template-columns: 1fr;
            }
        }
        
        .stat-item {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 20px;
            border: 2px solid var(--rose-clair);
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
            border-color: var(--rose-fonce);
            box-shadow: 0 10px 20px rgba(255, 143, 163, 0.2);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 15px;
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--noir-doux);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 1rem;
            color: #7a6a6a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* ===== LISTE DES CADEAUX ===== */
        .gifts-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
        }
        
        .section-title {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            color: var(--rose-fonce);
            margin-bottom: 40px;
            text-align: center;
            border-bottom: 3px solid var(--rose-clair);
            padding-bottom: 20px;
        }
        
        /* Filtres */
        .gift-filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 12px 25px;
            background: white;
            border: 2px solid var(--rose-principal);
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            color: var(--noir-doux);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: var(--rose-principal);
            color: white;
        }
        
        /* Grille de cadeaux */
        .gifts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 768px) {
            .gifts-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        /* Carte de cadeau */
        .gift-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-clair);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .gift-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 143, 163, 0.2);
        }
        
        .gift-card.reserved {
            border-color: var(--vert-noel);
            opacity: 0.9;
        }
        
        .gift-card.priority-high {
            border-left: 5px solid #d32f2f;
        }
        
        .gift-card.priority-medium {
            border-left: 5px solid #ff8f00;
        }
        
        .gift-card.priority-low {
            border-left: 5px solid #2e7d32;
        }
        
        .gift-header {
            padding: 25px 25px 15px;
            position: relative;
        }
        
        .gift-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--noir-doux);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .gift-category {
            display: inline-block;
            padding: 5px 15px;
            background: var(--rose-clair);
            color: var(--rose-fonce);
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .gift-priority {
            position: absolute;
            top: 25px;
            right: 25px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .priority-high { background: #ffebee; color: #d32f2f; }
        .priority-medium { background: #fff8e1; color: #ff8f00; }
        .priority-low { background: #e8f5e9; color: #2e7d32; }
        
        .gift-image {
            height: 200px;
            background: var(--rose-clair);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .gift-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .gift-image-placeholder {
            text-align: center;
            color: var(--rose-fonce);
            padding: 20px;
        }
        
        .gift-image-placeholder i {
            font-size: 4rem;
            margin-bottom: 15px;
        }
        
        .gift-body {
            padding: 25px;
        }
        
        .gift-price {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--vert-noel);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .gift-store {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: #7a6a6a;
            font-size: 0.95rem;
        }
        
        .gift-notes {
            color: #7a6a6a;
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 0.95rem;
            max-height: 100px;
            overflow-y: auto;
            padding-right: 10px;
        }
        
        .gift-link {
            display: inline-block;
            color: var(--rose-fonce);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 15px;
            word-break: break-all;
        }
        
        .gift-link:hover {
            text-decoration: underline;
        }
        
        .gift-footer {
            padding: 20px 25px;
            background: var(--rose-clair);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 182, 193, 0.3);
        }
        
        .reservation-status {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .reserved-badge {
            padding: 6px 15px;
            background: var(--vert-noel);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .reserve-btn {
            padding: 10px 20px;
            background: var(--rose-fonce);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .reserve-btn:hover {
            background: var(--rose-principal);
            transform: scale(1.05);
        }
        
        .reserve-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
        }
        
        /* ===== RÉSERVATION MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
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
        }
        
        /* ===== ACTIONS ===== */
        .actions-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 25px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
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
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--rose-principal);
        }
        
        .thankyou-title {
            font-family: 'Cookie', cursive;
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
        
        .notification.info {
            background: linear-gradient(45deg, #2196f3, #03a9f4);
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .view-title { font-size: 3.5rem; }
            .view-subtitle { font-size: 2rem; }
            .list-owner { font-size: 2.5rem; }
            .list-message { font-size: 1.1rem; padding: 20px; }
            .section-title { font-size: 2.5rem; }
            .gift-filters { flex-direction: column; align-items: center; }
            .filter-btn { width: 100%; max-width: 300px; justify-content: center; }
            .actions-grid { grid-template-columns: repeat(2, 1fr); }
            .thankyou-title { font-size: 2.8rem; }
        }
        
        @media (max-width: 480px) {
            .view-title { font-size: 2.8rem; }
            .list-owner { font-size: 2rem; }
            .section-title { font-size: 2rem; }
            .gifts-grid { grid-template-columns: 1fr; }
            .actions-grid { grid-template-columns: 1fr; }
            .footer-links { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>
    <!-- Cadeaux flottants décoratifs -->
    <div class="floating-gift gift-1">🎁</div>
    <div class="floating-gift gift-2">🎀</div>
    <div class="floating-gift gift-3">✨</div>
    <div class="floating-gift gift-4">🦌</div>
    
    <div class="container">
        <!-- Header -->
        <header class="header-giftlist">
            <div class="ribbon">LISTE DE SOUHAITS</div>
            <h1 class="view-title">{{ $giftList->title }}</h1>
            <p class="view-subtitle">Partagez la magie de Noël</p>
        </header>
        
        <!-- Informations de la liste -->
        <div class="list-info">
            <div class="list-owner">
                <i class="fas fa-user-circle"></i> Liste de {{ $giftList->owner }}
            </div>
            
            @if($giftList->message)
            <div class="list-message">
                <i class="fas fa-quote-left" style="color: var(--rose-fonce); margin-right: 10px;"></i>
                {{ $giftList->message }}
                <i class="fas fa-quote-right" style="color: var(--rose-fonce); margin-left: 10px;"></i>
            </div>
            @endif
            
            <div class="list-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="stat-value">{{ $giftList->gifts_count }}</div>
                    <div class="stat-label">Cadeaux</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                    <div class="stat-value">{{ number_format($giftList->total_price, 2, ',', ' ') }}€</div>
                    <div class="stat-label">Budget total</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-value">{{ $giftList->views }}</div>
                    <div class="stat-label">Vues</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="stat-value">
                        <span id="shareCount">{{ $giftList->shares ?? 0 }}</span>
                    </div>
                    <div class="stat-label">Partages</div>
                </div>
            </div>
            
            <!-- QR Code -->
            <div style="text-align: center; margin-top: 40px;">
                <div style="font-size: 1.2rem; color: var(--noir-doux); margin-bottom: 15px;">
                    <i class="fas fa-qrcode"></i> Scanner pour partager
                </div>
                <div id="qrcode" style="display: inline-block; padding: 20px; background: white; border-radius: 15px;"></div>
            </div>
        </div>
        
        <!-- Liste des cadeaux -->
        <div class="gifts-section">
            <h2 class="section-title">
                <i class="fas fa-list-check"></i> Les Souhaits de {{ $giftList->owner }}
            </h2>
            
            <!-- Filtres -->
            <div class="gift-filters">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th-large"></i> Tous ({{ $giftList->gifts_count }})
                </button>
                <button class="filter-btn" data-filter="high">
                    <i class="fas fa-exclamation-circle"></i> Haute priorité ({{ $giftList->high_priority_count }})
                </button>
                <button class="filter-btn" data-filter="medium">
                    <i class="fas fa-star"></i> Moyenne priorité ({{ $giftList->medium_priority_count }})
                </button>
                <button class="filter-btn" data-filter="low">
                    <i class="fas fa-heart"></i> Basse priorité ({{ $giftList->low_priority_count }})
                </button>
                <button class="filter-btn" data-filter="available">
                    <i class="fas fa-check-circle"></i> Disponibles
                </button>
                <button class="filter-btn" data-filter="reserved">
                    <i class="fas fa-lock"></i> Réservés
                </button>
            </div>
            
            <!-- Grille de cadeaux -->
            <div class="gifts-grid" id="giftsGrid">
                @foreach($giftList->gifts as $index => $gift)
                <div class="gift-card priority-{{ $gift['priority'] }} {{ $gift['reserved'] ?? false ? 'reserved' : '' }}" 
                     data-priority="{{ $gift['priority'] }}" 
                     data-reserved="{{ $gift['reserved'] ?? 'false' }}"
                     data-index="{{ $index }}">
                    
                    <div class="gift-header">
                        <h3 class="gift-title">{{ $gift['name'] }}</h3>
                        <div class="gift-category">
                            <i class="fas fa-{{ getCategoryIcon($gift['category'] ?? 'autre') }}"></i>
                            {{ getCategoryName($gift['category'] ?? 'autre') }}
                        </div>
                        <span class="gift-priority priority-{{ $gift['priority'] }}">
                            @if($gift['priority'] == 'high')
                                Haute
                            @elseif($gift['priority'] == 'medium')
                                Moyenne
                            @else
                                Basse
                            @endif
                        </span>
                    </div>
                    
                    <div class="gift-image">
                        @if(isset($gift['image']) && $gift['image'])
                            <img src="{{ $gift['image'] }}" alt="{{ $gift['name'] }}">
                        @else
                            <div class="gift-image-placeholder">
                                <i class="fas fa-{{ getCategoryIcon($gift['category'] ?? 'autre') }}"></i>
                                <div>{{ getCategoryName($gift['category'] ?? 'autre') }}</div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="gift-body">
                        @if(isset($gift['price']) && $gift['price'] > 0)
                        <div class="gift-price">
                            <i class="fas fa-euro-sign"></i> {{ number_format($gift['price'], 2, ',', ' ') }}€
                        </div>
                        @endif
                        
                        @if(isset($gift['store']) && $gift['store'])
                        <div class="gift-store">
                            <i class="fas fa-store"></i> {{ $gift['store'] }}
                        </div>
                        @endif
                        
                        @if(isset($gift['notes']) && $gift['notes'])
                        <div class="gift-notes">
                            <i class="fas fa-sticky-note"></i> {{ $gift['notes'] }}
                        </div>
                        @endif
                        
                        @if(isset($gift['link']) && $gift['link'])
                        <a href="{{ $gift['link'] }}" target="_blank" class="gift-link">
                            <i class="fas fa-external-link-alt"></i> Voir le produit
                        </a>
                        @endif
                    </div>
                    
                    <div class="gift-footer">
                        @if($gift['reserved'] ?? false)
                        <div class="reservation-status">
                            <div class="reserved-badge">
                                <i class="fas fa-check-circle"></i> Réservé
                                @if(isset($gift['reserved_by']))
                                <span style="font-size: 0.8rem;">par {{ $gift['reserved_by'] }}</span>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="reservation-status">
                            <span style="color: var(--vert-noel); font-weight: 600;">
                                <i class="fas fa-unlock"></i> Disponible
                            </span>
                        </div>
                        <button class="reserve-btn" onclick="reserveGift({{ $index }})">
                            <i class="fas fa-lock"></i> Réserver
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Message si liste vide -->
            @if(count($giftList->gifts) == 0)
            <div style="text-align: center; padding: 60px 20px; color: #9a8a8a;">
                <div style="font-size: 5rem; color: var(--rose-clair); margin-bottom: 20px;">
                    <i class="fas fa-gift"></i>
                </div>
                <p style="font-size: 1.5rem; margin-bottom: 10px;">La liste est vide</p>
                <p style="color: #7a6a6a;">Aucun cadeau n'a été ajouté à cette liste pour le moment.</p>
            </div>
            @endif
        </div>
        
        <!-- Modal de réservation -->
        <div class="modal" id="reservationModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Réserver un cadeau</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom: 25px;">
                        <p style="color: var(--noir-doux); margin-bottom: 15px;" id="giftNameText">
                            Réserver: <strong id="selectedGiftName"></strong>
                        </p>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--noir-doux);">
                                <i class="fas fa-user"></i> Votre nom
                            </label>
                            <input type="text" id="reserverName" 
                                   placeholder="Ex: Marie, La famille Dupont..."
                                   style="width: 100%; padding: 15px; border: 2px solid var(--rose-clair); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 1rem;">
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--noir-doux);">
                                <i class="fas fa-envelope"></i> Email (optionnel)
                            </label>
                            <input type="email" id="reserverEmail" 
                                   placeholder="Pour confirmation"
                                   style="width: 100%; padding: 15px; border: 2px solid var(--rose-clair); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 1rem;">
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--noir-doux);">
                                <i class="fas fa-comment"></i> Message (optionnel)
                            </label>
                            <textarea id="reserverMessage" 
                                      placeholder="Un petit mot pour {{ $giftList->owner }}..."
                                      style="width: 100%; padding: 15px; border: 2px solid var(--rose-clair); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 1rem; min-height: 100px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button class="action-btn" id="confirmReservationBtn" style="padding: 12px 30px; border: none; background: var(--vert-noel);">
                            <i class="fas fa-check"></i> Confirmer
                        </button>
                        <button class="action-btn" id="cancelReservationBtn" style="padding: 12px 30px; background: transparent; border: 2px solid var(--rose-fonce); color: var(--rose-fonce);">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions-section">
            <h2 class="actions-title"><i class="fas fa-magic"></i> Que souhaitez-vous faire?</h2>
            
            <div class="actions-grid">
                <a href="#" class="action-btn" id="shareListBtn">
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
                
                <a href="#" class="action-btn" id="downloadBtn">
                    <div class="action-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <span class="action-label">Télécharger</span>
                </a>
                
                <a href="/create-giftlist" class="action-btn">
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
                
                <a href="mailto:?subject=Liste de cadeaux de {{ $giftList->owner }}" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span class="action-label">Contacter</span>
                </a>
            </div>
        </div>
        
        <!-- Message de remerciement -->
        <div class="thankyou-section">
            <h2 class="thankyou-title">Merci pour votre générosité!</h2>
            <p class="thankyou-text">
                Cette liste a été créée avec joie et anticipation pour partager les souhaits de cœur. 
                Chaque cadeau représente un rêve, un espoir ou un besoin spécial. 
                Votre attention et votre générosité rendent cette saison encore plus magique.
            </p>
            <div style="font-size: 4rem; margin: 20px 0; color: var(--rose-fonce);">
                🎁❤️✨
            </div>
            <p style="font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--rose-fonce);">
                Joyeux Noël et merci de faire des rêves une réalité!
            </p>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p style="font-size: 1.1rem; margin-bottom: 15px;">
                Partagez l'amour, partagez la magie de Noël 🎄
            </p>
            <div class="footer-links">
                <a href="/create-giftlist" class="footer-link">
                    <i class="fas fa-plus"></i> Créer ma liste
                </a>
                <a href="/create-letter" class="footer-link">
                    <i class="fas fa-envelope"></i> Écrire une lettre
                </a>
                <a href="/create-card" class="footer-link">
                    <i class="fas fa-gift"></i> Créer une carte
                </a>
                <a href="/create-poster" class="footer-link">
                    <i class="fas fa-image"></i> Créer une affiche
                </a>
            </div>
        </footer>
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
        const listId = "{{ $giftList->unique_id }}";
        const shareUrl = "{{ route('giftlists.show', $giftList->unique_id) }}";
        const listTitle = "{{ $giftList->title }}";
        const listOwner = "{{ $giftList->owner }}";
        let currentGiftIndex = null;
        
        // ===== FONCTIONS D'AIDE =====
        function getCategoryIcon(category) {
            const icons = {
                'mode': 'tshirt',
                'technologie': 'laptop',
                'maison': 'home',
                'loisirs': 'gamepad',
                'livres': 'book',
                'beaute': 'spa',
                'sport': 'dumbbell',
                'autre': 'gift'
            };
            return icons[category] || 'gift';
        }
        
        function getCategoryName(category) {
            const names = {
                'mode': 'Mode',
                'technologie': 'Tech',
                'maison': 'Maison',
                'loisirs': 'Loisirs',
                'livres': 'Livres',
                'beaute': 'Beauté',
                'sport': 'Sport',
                'autre': 'Autre'
            };
            return names[category] || 'Autre';
        }
        
        // ===== INITIALISATION =====
        window.addEventListener('load', function() {
            // Générer QR Code
            generateQRCode();
            
            // Initialiser les filtres
            initFilters();
            
            // Animation d'entrée des cadeaux
            animateGiftsEntrance();
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
        
        // ===== FILTRES =====
        function initFilters() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Retirer la classe active de tous les boutons
                    filterButtons.forEach(b => b.classList.remove('active'));
                    // Ajouter la classe active au bouton cliqué
                    this.classList.add('active');
                    
                    // Appliquer le filtre
                    const filter = this.dataset.filter;
                    filterGifts(filter);
                });
            });
        }
        
        function filterGifts(filter) {
            const giftCards = document.querySelectorAll('.gift-card');
            
            giftCards.forEach(card => {
                const priority = card.dataset.priority;
                const reserved = card.dataset.reserved === 'true';
                
                let showCard = true;
                
                switch(filter) {
                    case 'all':
                        showCard = true;
                        break;
                    case 'high':
                        showCard = priority === 'high';
                        break;
                    case 'medium':
                        showCard = priority === 'medium';
                        break;
                    case 'low':
                        showCard = priority === 'low';
                        break;
                    case 'available':
                        showCard = !reserved;
                        break;
                    case 'reserved':
                        showCard = reserved;
                        break;
                }
                
                if (showCard) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }
        
        // ===== ANIMATION D'ENTRÉE =====
        function animateGiftsEntrance() {
            const giftCards = document.querySelectorAll('.gift-card');
            
            giftCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });
        }
        
        // ===== RÉSERVATION DE CADEAUX =====
        function reserveGift(index) {
            currentGiftIndex = index;
            const giftCards = document.querySelectorAll('.gift-card');
            const selectedCard = Array.from(giftCards).find(card => card.dataset.index == index);
            
            if (selectedCard) {
                const giftName = selectedCard.querySelector('.gift-title').textContent;
                document.getElementById('selectedGiftName').textContent = giftName;
                document.getElementById('reservationModal').style.display = 'flex';
            }
        }
        
        document.getElementById('confirmReservationBtn').addEventListener('click', function() {
            const name = document.getElementById('reserverName').value.trim();
            if (!name) {
                showNotification('Veuillez entrer votre nom', 'error');
                return;
            }
            
            const email = document.getElementById('reserverEmail').value.trim();
            const message = document.getElementById('reserverMessage').value.trim();
            
            // Envoyer la réservation au backend
            fetch(`/giftlist/${listId}/reserve/${currentGiftIndex}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    reserved_by: name,
                    email: email,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour l'affichage
                    updateGiftReservation(currentGiftIndex, name);
                    showNotification('Cadeau réservé avec succès!', 'success');
                    document.getElementById('reservationModal').style.display = 'none';
                    resetReservationForm();
                } else {
                    showNotification(data.message || 'Erreur lors de la réservation', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur de connexion', 'error');
            });
        });
        
        document.getElementById('cancelReservationBtn').addEventListener('click', function() {
            document.getElementById('reservationModal').style.display = 'none';
            resetReservationForm();
        });
        
        function resetReservationForm() {
            document.getElementById('reserverName').value = '';
            document.getElementById('reserverEmail').value = '';
            document.getElementById('reserverMessage').value = '';
            currentGiftIndex = null;
        }
        
        function updateGiftReservation(index, reservedBy) {
            const giftCards = document.querySelectorAll('.gift-card');
            const card = Array.from(giftCards).find(card => card.dataset.index == index);
            
            if (card) {
                // Mettre à jour les données
                card.dataset.reserved = 'true';
                card.classList.add('reserved');
                
                // Mettre à jour le footer
                const footer = card.querySelector('.gift-footer');
                footer.innerHTML = `
                    <div class="reservation-status">
                        <div class="reserved-badge">
                            <i class="fas fa-check-circle"></i> Réservé
                            <span style="font-size: 0.8rem;">par ${reservedBy}</span>
                        </div>
                    </div>
                `;
            }
        }
        
        // ===== PARTAGE =====
        document.getElementById('shareListBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const message = `🎁 Découvrez la liste de cadeaux de Noël de ${listOwner}!\n\n"${listTitle}"\n\nConsultez-la ici: ${shareUrl}\n\nJoyeuses fêtes! 🎄✨`;
            
            if (navigator.share) {
                navigator.share({
                    title: listTitle,
                    text: message,
                    url: shareUrl
                })
                .then(() => {
                    incrementShareCount();
                    showNotification('Liste partagée avec succès!', 'success');
                })
                .catch(error => {
                    console.error('Erreur de partage:', error);
                    fallbackShare(message);
                });
            } else {
                fallbackShare(message);
            }
        });
        
        function fallbackShare(message) {
            const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
            incrementShareCount();
        }
        
        function incrementShareCount() {
            const shareCountElement = document.getElementById('shareCount');
            let currentCount = parseInt(shareCountElement.textContent) || 0;
            shareCountElement.textContent = currentCount + 1;
            
            // Envoyer au backend
            fetch(`/giftlist/${listId}/share`, {
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
            const gifts = @json($giftList->gifts);
            
            let giftsHTML = '';
            gifts.forEach((gift, index) => {
                giftsHTML += `
                    <div class="print-gift" style="margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px; color: #ff8fa3;">${gift.name}</h3>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: #666;">Priorité: ${gift.priority === 'high' ? 'Haute' : gift.priority === 'medium' ? 'Moyenne' : 'Basse'}</span>
                            ${gift.price ? `<span style="font-weight: bold; color: #2e8b57;">${gift.price.toFixed(2)}€</span>` : ''}
                        </div>
                        ${gift.store ? `<p style="margin: 5px 0; color: #666;"><strong>Magasin:</strong> ${gift.store}</p>` : ''}
                        ${gift.notes ? `<p style="margin: 5px 0; color: #666;">${gift.notes}</p>` : ''}
                        ${gift.reserved ? `<p style="margin: 5px 0; color: #2e8b57; font-weight: bold;"><i class="fas fa-check"></i> Réservé${gift.reserved_by ? ` par ${gift.reserved_by}` : ''}</p>` : '<p style="margin: 5px 0; color: #666;"><i class="fas fa-unlock"></i> Disponible</p>'}
                    </div>
                `;
            });
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${listTitle} - Liste de Cadeaux</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');
                        
                        body { 
                            font-family: 'Poppins', sans-serif; 
                            margin: 0; 
                            padding: 40px; 
                            color: #5a4a4a; 
                        }
                        
                        .print-header { 
                            text-align: center; 
                            margin-bottom: 40px; 
                            padding-bottom: 20px; 
                            border-bottom: 3px solid #ffb6c1; 
                        }
                        
                        .print-title { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 3rem; 
                            color: #ff8fa3; 
                            margin: 0 0 10px; 
                        }
                        
                        .print-owner { 
                            font-size: 1.5rem; 
                            color: #666; 
                            margin-bottom: 20px; 
                        }
                        
                        .print-message { 
                            font-style: italic; 
                            color: #666; 
                            margin: 20px 0; 
                            padding: 15px; 
                            background: #ffebf0; 
                            border-radius: 10px; 
                        }
                        
                        .print-stats { 
                            display: grid; 
                            grid-template-columns: repeat(4, 1fr); 
                            gap: 15px; 
                            margin: 30px 0; 
                        }
                        
                        .print-stat { 
                            text-align: center; 
                            padding: 15px; 
                            background: #ffebf0; 
                            border-radius: 10px; 
                        }
                        
                        .print-stat-value { 
                            font-size: 1.8rem; 
                            font-weight: bold; 
                            color: #ff8fa3; 
                        }
                        
                        .print-stat-label { 
                            font-size: 0.9rem; 
                            color: #666; 
                            text-transform: uppercase; 
                        }
                        
                        .print-gifts-title { 
                            font-family: 'Dancing Script', cursive; 
                            font-size: 2.5rem; 
                            color: #ff8fa3; 
                            margin: 40px 0 20px; 
                            text-align: center; 
                        }
                        
                        .print-footer { 
                            margin-top: 50px; 
                            padding-top: 20px; 
                            border-top: 1px solid #ddd; 
                            text-align: center; 
                            color: #666; 
                            font-size: 0.9rem; 
                        }
                        
                        @media print {
                            body { padding: 20px; }
                            .print-stat { break-inside: avoid; }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-header">
                        <h1 class="print-title">${listTitle}</h1>
                        <div class="print-owner">
                            <i class="fas fa-user"></i> Liste de ${listOwner}
                        </div>
                        ${$giftList->message ? `<div class="print-message">"${$giftList->message}"</div>` : ''}
                        
                        <div class="print-stats">
                            <div class="print-stat">
                                <div class="print-stat-value">${$giftList->gifts_count}</div>
                                <div class="print-stat-label">Cadeaux</div>
                            </div>
                            <div class="print-stat">
                                <div class="print-stat-value">${$giftList->total_price.toFixed(2)}€</div>
                                <div class="print-stat-label">Budget total</div>
                            </div>
                            <div class="print-stat">
                                <div class="print-stat-value">${$giftList->high_priority_count}</div>
                                <div class="print-stat-label">Haute priorité</div>
                            </div>
                            <div class="print-stat">
                                <div class="print-stat-value">${$giftList->views}</div>
                                <div class="print-stat-label">Vues</div>
                            </div>
                        </div>
                    </div>
                    
                    <h2 class="print-gifts-title">Les Souhaits de ${listOwner}</h2>
                    
                    ${giftsHTML}
                    
                    <div class="print-footer">
                        <p>Liste créée via Féérie de Noël • {{ url('/') }}</p>
                        <p>Imprimée le ${new Date().toLocaleDateString('fr-FR')} à ${new Date().toLocaleTimeString('fr-FR')}</p>
                        <p>Partagée avec ❤️ pour un Noël magique!</p>
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
        
        // ===== TÉLÉCHARGEMENT =====
        document.getElementById('downloadBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Capture de la liste comme image
            const listSection = document.querySelector('.gifts-section');
            html2canvas(listSection, {
                backgroundColor: '#ffffff',
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = `liste-cadeaux-${listId}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                showNotification('Liste téléchargée avec succès!', 'success');
            }).catch(error => {
                console.error('Erreur de capture:', error);
                showNotification('Erreur lors du téléchargement', 'error');
            });
        });
        
        // ===== GESTION DES MODAUX =====
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
                resetReservationForm();
            });
        });
        
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                    resetReservationForm();
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
    </script>
    
    <!-- Bibliothèque pour capture d'écran -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</body>
</html>

<?php
// Fonctions helpers pour les catégories
function getCategoryIcon($category) {
    $icons = [
        'mode' => 'tshirt',
        'technologie' => 'laptop',
        'maison' => 'home',
        'loisirs' => 'gamepad',
        'livres' => 'book',
        'beaute' => 'spa',
        'sport' => 'dumbbell',
        'autre' => 'gift'
    ];
    return $icons[$category] ?? 'gift';
}

function getCategoryName($category) {
    $names = [
        'mode' => 'Mode',
        'technologie' => 'Tech',
        'maison' => 'Maison',
        'loisirs' => 'Loisirs',
        'livres' => 'Livres',
        'beaute' => 'Beauté',
        'sport' => 'Sport',
        'autre' => 'Autre'
    ];
    return $names[$category] ?? 'Autre';
}
?>