<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Liste de Cadeaux de Noël - Féérie de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Cookie&family=Parisienne&display=swap" rel="stylesheet">
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
            --rouge-cadeau: #ff6b6b;
            --bleu-clair: #a5f3fc;
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

        @media (max-width: 605px) {
            .ad-row{
                gap: 5px;
            }
        }

        
        /* ===== ANIMATIONS ===== */
        @keyframes giftFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        @keyframes ribbonWave {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(5deg); }
        }
        
        /* ===== ÉLÉMENTS DÉCORATIFS ===== */
        .floating-gift {
            position: fixed;
            font-size: 3rem;
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
            animation: giftFloat 8s infinite ease-in-out;
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
            background: linear-gradient(45deg, var(--rouge-cadeau), var(--or), var(--rose-fonce));
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
            box-shadow: 0 20px 40px rgba(255, 107, 107, 0.3);
        }
        
        .giftlist-title {
            font-family: 'Cookie', cursive;
            font-size: 5rem;
            font-weight: 400;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            letter-spacing: 2px;
        }
        
        .giftlist-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== RIBBON DECORATION ===== */
        .ribbon {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 40px;
            background: var(--vert-noel);
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 5px 15px rgba(46, 139, 87, 0.3);
            animation: ribbonWave 3s infinite ease-in-out;
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
        
        /* ===== LAYOUT DE CRÉATION ===== */
        .creation-layout {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            margin-bottom: 50px;
        }
        
        @media (max-width: 992px) {
            .creation-layout {
                grid-template-columns: 1fr;
            }
        }
        
        /* ===== PANEL D'INFORMATIONS ===== */
        .info-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            backdrop-filter: blur(10px);
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .panel-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 3px solid var(--rose-clair);
            padding-bottom: 15px;
        }
        
        /* ===== FORMULAIRE DE LISTE ===== */
        .list-form {
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--noir-doux);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-label i {
            color: var(--rose-fonce);
        }
        
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--rose-clair);
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--rose-fonce);
            box-shadow: 0 0 0 3px rgba(255, 143, 163, 0.2);
        }
        
        /* ===== BOUTON AJOUTER CADEAU ===== */
        .add-gift-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(45deg, var(--rose-fonce), var(--rose-principal));
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
        }
        
        .add-gift-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 143, 163, 0.3);
        }
        
        /* ===== LISTE DES CADEAUX ===== */
        .gifts-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            backdrop-filter: blur(10px);
            min-height: 600px;
        }
        
        .gifts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .gifts-count {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: var(--rose-fonce);
        }
        
        .gifts-actions {
            display: flex;
            gap: 15px;
        }
        
        .action-btn {
            padding: 10px 20px;
            background: white;
            border: 2px solid var(--rose-principal);
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            color: var(--noir-doux);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .action-btn:hover {
            background: var(--rose-principal);
            color: white;
        }
        
        /* ===== LISTE VIDE ===== */
        .empty-list {
            text-align: center;
            padding: 60px 20px;
            color: #9a8a8a;
        }
        
        .empty-icon {
            font-size: 5rem;
            color: var(--rose-clair);
            margin-bottom: 20px;
            animation: giftFloat 4s infinite ease-in-out;
        }
        
        .empty-text {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        /* ===== GRILLE DE CADEAUX ===== */
        .gifts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 768px) {
            .gifts-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* ===== CARTE DE CADEAU ===== */
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
            border-color: var(--rose-fonce);
        }
        
        .gift-card.priority-high {
            border-color: var(--rouge-cadeau);
        }
        
        .gift-card.priority-medium {
            border-color: var(--or);
        }
        
        .gift-card.priority-low {
            border-color: var(--vert-noel);
        }
        
        .gift-header {
            padding: 20px;
            border-bottom: 2px solid var(--rose-clair);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .gift-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--noir-doux);
            margin-bottom: 5px;
            flex: 1;
        }
        
        .gift-priority {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-left: 10px;
        }
        
        .priority-high { background: #ffebee; color: #d32f2f; }
        .priority-medium { background: #fff8e1; color: #ff8f00; }
        .priority-low { background: #e8f5e9; color: #2e7d32; }
        
        .gift-image {
            height: 180px;
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
        }
        
        .gift-image-placeholder i {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        
        .gift-body {
            padding: 20px;
        }
        
        .gift-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--vert-noel);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .gift-description {
            color: #7a6a6a;
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 0.95rem;
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
            padding: 15px 20px;
            background: var(--rose-clair);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .gift-actions {
            display: flex;
            gap: 10px;
        }
        
        .gift-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--rose-principal);
            color: var(--rose-fonce);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .gift-btn:hover {
            background: var(--rose-fonce);
            color: white;
            transform: scale(1.1);
        }
        
        /* ===== MODAL AJOUT/ÉDITION CADEAU ===== */
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
            border-radius: 25px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
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
            border-radius: 25px 25px 0 0;
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
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .image-upload {
            border: 3px dashed var(--rose-clair);
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .image-upload:hover {
            border-color: var(--rose-fonce);
            background: var(--rose-clair);
        }
        
        .upload-icon {
            font-size: 3rem;
            color: var(--rose-fonce);
            margin-bottom: 15px;
        }
        
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            margin: 0 auto 20px;
            display: none;
        }
        
        /* ===== SECTION PARTAGE ===== */
        .share-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 20px;
            padding: 30px;
            margin: 40px 0;
            border: 2px dashed var(--rose-fonce);
        }
        
        .share-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .share-header i {
            color: var(--vert-noel);
            font-size: 2.5rem;
        }
        
        .share-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }
        
        .share-option {
            padding: 15px;
            background: white;
            border: 2px solid var(--rose-clair);
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .share-option:hover {
            border-color: var(--rose-fonce);
            transform: translateY(-3px);
        }
        
        .share-option i {
            font-size: 2rem;
            color: var(--rose-fonce);
            margin-bottom: 10px;
        }
        
        /* ===== BOUTONS D'ACTION ===== */
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        
        .btn-action {
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            min-width: 220px;
            justify-content: center;
        }
        
        .btn-save {
            background: linear-gradient(45deg, var(--rose-fonce), var(--rose-principal));
            color: white;
        }
        
        .btn-share {
            background: linear-gradient(45deg, var(--vert-noel), #4caf50);
            color: white;
        }
        
        .btn-print {
            background: white;
            color: var(--rose-fonce);
            border: 3px solid var(--rose-fonce);
        }
        
        .btn-action:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
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
        
        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 40px 20px;
            color: #7a6a6a;
            margin-top: 60px;
            border-top: 3px solid var(--rose-clair);
        }
        
        .back-link {
            color: var(--rose-fonce);
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-top: 25px;
            font-size: 1.1rem;
            padding: 12px 25px;
            border: 2px solid var(--rose-fonce);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            background: var(--rose-fonce);
            color: white;
            transform: translateX(-5px);
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .giftlist-title { font-size: 3.5rem; }
            .giftlist-subtitle { font-size: 2rem; }
            .creation-layout { gap: 25px; }
            .info-panel { position: static; }
            .panel-title { font-size: 2rem; }
            .gifts-header { flex-direction: column; align-items: flex-start; }
            .gifts-actions { width: 100%; justify-content: space-between; }
            .btn-action { min-width: 100%; }
            .action-buttons { flex-direction: column; }
        }
        
        @media (max-width: 480px) {
            .giftlist-title { font-size: 2.8rem; }
            .panel-title { font-size: 1.8rem; }
            .modal-body { padding: 20px; }
        }
    </style>
</head>
<body>

    @include('components.floating-home')

    <!-- Cadeaux flottants décoratifs -->
    <div class="floating-gift gift-1">🎁</div>
    <div class="floating-gift gift-2">🎀</div>
    <div class="floating-gift gift-3">🦌</div>
    <div class="floating-gift gift-4">✨</div>
    
    <div class="container">
        <!-- Header -->
        <header class="header-giftlist">
            <div class="ribbon">MA LISTE DE CADEAUX</div>
            <h1 class="giftlist-title">Ma Liste Magique</h1>
            <p class="giftlist-subtitle">Partagez vos rêves de Noël avec vos proches</p>
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

        <!-- Layout de création -->
        <div class="creation-layout">
            <!-- Panel d'informations -->
            <div class="info-panel">
                <h2 class="panel-title"><i class="fas fa-user-circle"></i> Ma Liste</h2>
                
                <form id="listForm" class="list-form">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Votre nom</label>
                        <input type="text" class="form-input" id="listOwner" placeholder="Ex: Sophie" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-tree"></i> Titre de la liste</label>
                        <input type="text" class="form-input" id="listTitle" placeholder="Ex: Mes souhaits pour Noël 2026" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-comment"></i> Message aux donateurs</label>
                        <textarea class="form-textarea" id="listMessage" placeholder="Un petit mot pour ceux qui consulteront votre liste..." rows="4"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-palette"></i> Thème de la liste</label>
                        <select class="form-select" id="listTheme">
                            <option value="classique">Classique</option>
                            <option value="moderne">Moderne</option>
                            <option value="enfant">Enfantin</option>
                            <option value="luxe">Luxe</option>
                            <option value="vintage">Vintage</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Visibilité</label>
                        <select class="form-select" id="listVisibility">
                            <option value="public">Publique</option>
                            <option value="private" selected>Privée (avec lien)</option>
                            <option value="secret">Secrète</option>
                        </select>
                    </div>
                </form>
                
                <button class="add-gift-btn" id="addGiftBtn">
                    <i class="fas fa-plus-circle"></i> Ajouter un cadeau
                </button>
                
                <!-- Statistiques -->
                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px dashed var(--rose-clair);">
                    <h3 style="font-size: 1.2rem; margin-bottom: 15px; color: var(--noir-doux);">
                        <i class="fas fa-chart-pie"></i> Statistiques
                    </h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; font-weight: 700; color: var(--rose-fonce);" id="giftCount">0</div>
                            <div style="font-size: 0.9rem; color: #7a6a6a;">Cadeaux</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; font-weight: 700; color: var(--vert-noel);" id="totalPrice">0$</div>
                            <div style="font-size: 0.9rem; color: #7a6a6a;">Total</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Panel des cadeaux -->
            <div class="gifts-panel">
                <div class="gifts-header">
                    <h2 class="gifts-count" id="giftsCountTitle">Mes cadeaux (0)</h2>
                    <div class="gifts-actions">
                        <button class="action-btn" id="sortBtn">
                            <i class="fas fa-sort-amount-down"></i> Trier
                        </button>
                        <button class="action-btn" id="filterBtn">
                            <i class="fas fa-filter"></i> Filtrer
                        </button>
                        <button class="action-btn" id="clearAllBtn">
                            <i class="fas fa-trash"></i> Tout effacer
                        </button>
                    </div>
                </div>
                
                <!-- Liste vide -->
                <div class="empty-list" id="emptyList">
                    <div class="empty-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <p class="empty-text">Votre liste est vide</p>
                    <p style="color: #9a8a8a;">Ajoutez vos premiers cadeaux en cliquant sur le bouton "Ajouter un cadeau"</p>
                </div>
                
                <!-- Grille de cadeaux -->
                <div class="gifts-grid" id="giftsGrid"></div>
                
                <!-- Résumé -->
                <div style="background: var(--rose-clair); border-radius: 15px; padding: 25px; margin-top: 30px;">
                    <h3 style="font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--rose-fonce); margin-bottom: 15px;">
                        <i class="fas fa-list-check"></i> Résumé
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                        <div>
                            <div style="font-weight: 700; color: var(--noir-doux);">Priorité haute</div>
                            <div style="font-size: 1.5rem; color: #d32f2f;" id="highCount">0</div>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--noir-doux);">Priorité moyenne</div>
                            <div style="font-size: 1.5rem; color: #ff8f00;" id="mediumCount">0</div>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--noir-doux);">Priorité basse</div>
                            <div style="font-size: 1.5rem; color: #2e7d32;" id="lowCount">0</div>
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
                
            </div>
        </div>
        
        <!-- Modal ajout/édition cadeau -->
        <div class="modal" id="giftModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalTitle">Ajouter un cadeau</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="giftForm">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-gift"></i> Nom du cadeau</label>
                            <input type="text" class="form-input" id="giftName" placeholder="Ex: Montre connectée" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-tag"></i> Catégorie</label>
                                <select class="form-select" id="giftCategory">
                                    <option value="mode">Mode & Accessoires</option>
                                    <option value="technologie">Technologie</option>
                                    <option value="maison">Maison & Déco</option>
                                    <option value="loisirs">Loisirs & Jeux</option>
                                    <option value="livres">Livres & Culture</option>
                                    <option value="beaute">Beauté & Soins</option>
                                    <option value="sport">Sport & Fitness</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-exclamation-circle"></i> Priorité</label>
                                <select class="form-select" id="giftPriority">
                                    <option value="low">Basse</option>
                                    <option value="medium" selected>Moyenne</option>
                                    <option value="high">Haute</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-euro-sign"></i> Prix estimé ($)</label>
                                <input type="number" class="form-input" id="giftPrice" placeholder="Ex: 99.99" step="0.01" min="0">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-store"></i> Magasin/Boutique</label>
                                <input type="text" class="form-input" id="giftStore" placeholder="Ex: Amazon, Décathlon...">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-link"></i> Lien du produit (optionnel)</label>
                            <input type="url" class="form-input" id="giftLink" placeholder="https://...">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-image"></i> Image du cadeau</label>
                            <div class="image-upload" id="imageUploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p style="font-weight: 600; color: var(--noir-doux);">Cliquez pour uploader une image</p>
                                <p style="font-size: 0.9rem; color: #7a6a6a;">ou glissez-déposez</p>
                                <input type="file" id="imageInput" accept="image/*" style="display: none;">
                            </div>
                            <img id="imagePreview" class="image-preview" alt="Aperçu de l'image">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-sticky-note"></i> Notes supplémentaires</label>
                            <textarea class="form-textarea" id="giftNotes" placeholder="Couleur, taille, modèle préféré..." rows="3"></textarea>
                        </div>
                        
                        <div class="form-group" style="text-align: center; margin-top: 30px;">
                            <button type="submit" class="btn-action btn-save" style="min-width: 200px;">
                                <i class="fas fa-save"></i> Enregistrer le cadeau
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Section partage -->
        <div class="share-section">
            <div class="share-header">
                <i class="fas fa-share-alt"></i>
                <div>
                    <h3 style="margin: 0; color: var(--noir-doux);">Partagez votre liste</h3>
                    <p style="margin: 5px 0 0; color: #7a6a6a;">Envoyez votre liste à vos proches</p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label"><i class="fas fa-link"></i> Lien de partage</label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" class="form-input" id="shareLink" readonly style="flex: 1;">
                    <button class="action-btn" id="copyLinkBtn">
                        <i class="fas fa-copy"></i> Copier
                    </button>
                </div>
            </div>
            
            <div class="share-options">
                <div class="share-option" data-share="whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <div>WhatsApp</div>
                </div>
                <div class="share-option" data-share="email">
                    <i class="fas fa-envelope"></i>
                    <div>Email</div>
                </div>
                <div class="share-option" data-share="facebook">
                    <i class="fab fa-facebook"></i>
                    <div>Facebook</div>
                </div>
                <div class="share-option" data-share="print">
                    <i class="fas fa-print"></i>
                    <div>Imprimer</div>
                </div>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button type="button" class="btn-action btn-print" id="printListBtn">
                <i class="fas fa-print"></i> Imprimer la liste
            </button>
            
            <button type="submit" form="listForm" class="btn-action btn-save">
                <i class="fas fa-save"></i> Enregistrer la liste
            </button>
            
            <button type="button" class="btn-action btn-share" id="shareListBtn">
                <i class="fas fa-paper-plane"></i> Partager la liste
            </button>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p style="font-size: 1.1rem; margin-bottom: 15px;">
                Faites plaisir à vos proches en leur montrant ce qui vous ferait vraiment plaisir ! 🎀
            </p>
            <a href="/" class="back-link">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
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
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Cadeau ajouté avec succès!</span>
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
    
    <script>
        // ===== VARIABLES GLOBALES =====
        let gifts = [];
        let editingGiftIndex = -1;
        let currentImage = null;
        let listId = null;
        
        // ===== INITIALISATION =====
        window.addEventListener('load', function() {
            loadFromLocalStorage();
            updateStats();
            updateShareLink();
        });
        
        // ===== GESTION DE LA LISTE =====
        document.getElementById('listForm').addEventListener('submit', function(e) {
            e.preventDefault();
            saveList();
        });
        
        function saveList() {
            const listData = {
                id: listId || 'list_' + Date.now(),
                owner: document.getElementById('listOwner').value,
                title: document.getElementById('listTitle').value,
                message: document.getElementById('listMessage').value,
                theme: document.getElementById('listTheme').value,
                visibility: document.getElementById('listVisibility').value,
                gifts: gifts,
                createdAt: new Date().toISOString(),
                updatedAt: new Date().toISOString()
            };
            
            listId = listData.id;
            
            // Sauvegarder localement
            localStorage.setItem('giftList', JSON.stringify(listData));
            
            // Mettre à jour le lien de partage
            updateShareLink();
            
            showNotification('Liste sauvegardée avec succès!', 'success');
            
            // Envoyer au backend
            saveToBackend(listData);
        }
        
        function loadFromLocalStorage() {
            const savedList = localStorage.getItem('giftList');
            if (savedList) {
                const listData = JSON.parse(savedList);
                
                // Charger les données
                document.getElementById('listOwner').value = listData.owner || '';
                document.getElementById('listTitle').value = listData.title || '';
                document.getElementById('listMessage').value = listData.message || '';
                document.getElementById('listTheme').value = listData.theme || 'classique';
                document.getElementById('listVisibility').value = listData.visibility || 'private';
                
                gifts = listData.gifts || [];
                listId = listData.id;
                
                // Afficher les cadeaux
                renderGifts();
            }
        }
        
        // ===== GESTION DES CADEAUX =====
        document.getElementById('addGiftBtn').addEventListener('click', function() {
            editingGiftIndex = -1;
            document.getElementById('modalTitle').textContent = 'Ajouter un cadeau';
            document.getElementById('giftForm').reset();
            document.getElementById('imagePreview').style.display = 'none';
            currentImage = null;
            document.getElementById('giftModal').style.display = 'flex';
        });
        
        document.getElementById('giftForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const giftData = {
                id: 'gift_' + Date.now(),
                name: document.getElementById('giftName').value,
                category: document.getElementById('giftCategory').value,
                priority: document.getElementById('giftPriority').value,
                price: parseFloat(document.getElementById('giftPrice').value) || 0,
                store: document.getElementById('giftStore').value,
                link: document.getElementById('giftLink').value,
                image: currentImage,
                notes: document.getElementById('giftNotes').value,
                addedAt: new Date().toISOString(),
                reserved: false,
                reservedBy: null
            };
            
            if (editingGiftIndex === -1) {
                // Ajouter un nouveau cadeau
                gifts.push(giftData);
                showNotification('Cadeau ajouté avec succès!', 'success');
            } else {
                // Modifier un cadeau existant
                gifts[editingGiftIndex] = giftData;
                showNotification('Cadeau modifié avec succès!', 'success');
            }
            
            // Fermer le modal
            document.getElementById('giftModal').style.display = 'none';
            
            // Mettre à jour l'affichage
            renderGifts();
            updateStats();
            saveList();
        });
        
        // ===== UPLOAD D'IMAGE =====
        document.getElementById('imageUploadArea').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });
        
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            if (!file.type.startsWith('image/')) {
                showNotification('Veuillez sélectionner une image', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                currentImage = event.target.result;
                const preview = document.getElementById('imagePreview');
                preview.src = currentImage;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
            
            // Drag & Drop
            document.addEventListener('dragover', function(e) {
                e.preventDefault();
                document.getElementById('imageUploadArea').style.borderColor = 'var(--rose-fonce)';
                document.getElementById('imageUploadArea').style.background = 'var(--rose-clair)';
            });
            
            document.addEventListener('dragleave', function(e) {
                if (!document.getElementById('imageUploadArea').contains(e.relatedTarget)) {
                    document.getElementById('imageUploadArea').style.borderColor = 'var(--rose-clair)';
                    document.getElementById('imageUploadArea').style.background = 'white';
                }
            });
            
            document.addEventListener('drop', function(e) {
                e.preventDefault();
                document.getElementById('imageUploadArea').style.borderColor = 'var(--rose-clair)';
                document.getElementById('imageUploadArea').style.background = 'white';
                
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        currentImage = event.target.result;
                        const preview = document.getElementById('imagePreview');
                        preview.src = currentImage;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        
        // ===== AFFICHAGE DES CADEAUX =====
        function renderGifts() {
            const giftsGrid = document.getElementById('giftsGrid');
            const emptyList = document.getElementById('emptyList');
            
            if (gifts.length === 0) {
                giftsGrid.innerHTML = '';
                emptyList.style.display = 'block';
                return;
            }
            
            emptyList.style.display = 'none';
            
            // Trier par priorité (haute -> moyenne -> basse)
            const sortedGifts = [...gifts].sort((a, b) => {
                const priorityOrder = { high: 3, medium: 2, low: 1 };
                return priorityOrder[b.priority] - priorityOrder[a.priority];
            });
            
            giftsGrid.innerHTML = sortedGifts.map((gift, index) => `
                <div class="gift-card priority-${gift.priority}">
                    <div class="gift-header">
                        <h3 class="gift-title">${gift.name}</h3>
                        <span class="gift-priority priority-${gift.priority}">
                            ${gift.priority === 'high' ? 'Haute' : gift.priority === 'medium' ? 'Moyenne' : 'Basse'}
                        </span>
                    </div>
                    
                    <div class="gift-image">
                        ${gift.image ? 
                            `<img src="${gift.image}" alt="${gift.name}">` : 
                            `<div class="gift-image-placeholder">
                                <i class="fas fa-${getCategoryIcon(gift.category)}"></i>
                                <div>${getCategoryName(gift.category)}</div>
                            </div>`
                        }
                    </div>
                    
                    <div class="gift-body">
                        ${gift.price > 0 ? `
                            <div class="gift-price">
                                <i class="fas fa-euro-sign"></i> ${gift.price.toFixed(2)}$
                                ${gift.store ? `<span style="font-size: 0.9rem; color: #7a6a6a;">• ${gift.store}</span>` : ''}
                            </div>
                        ` : ''}
                        
                        ${gift.notes ? `
                            <div class="gift-description">${gift.notes}</div>
                        ` : ''}
                        
                        ${gift.link ? `
                            <a href="${gift.link}" target="_blank" class="gift-link">
                                <i class="fas fa-external-link-alt"></i> Voir le produit
                            </a>
                        ` : ''}
                    </div>
                    
                    <div class="gift-footer">
                        <div style="font-size: 0.9rem; color: #7a6a6a;">
                            ${gift.reserved ? `<i class="fas fa-check-circle" style="color: var(--vert-noel);"></i> Réservé` : 'Disponible'}
                        </div>
                        <div class="gift-actions">
                            <button class="gift-btn" onclick="editGift(${index})" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="gift-btn" onclick="toggleReserve(${index})" title="${gift.reserved ? 'Libérer' : 'Réserver'}">
                                <i class="fas ${gift.reserved ? 'fa-unlock' : 'fa-lock'}"></i>
                            </button>
                            <button class="gift-btn" onclick="deleteGift(${index})" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
            
            // Mettre à jour le titre
            document.getElementById('giftsCountTitle').textContent = `Mes cadeaux (${gifts.length})`;
        }
        
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
        
        // ===== ACTIONS SUR LES CADEAUX =====
        function editGift(index) {
            editingGiftIndex = index;
            const gift = gifts[index];
            
            document.getElementById('modalTitle').textContent = 'Modifier le cadeau';
            document.getElementById('giftName').value = gift.name;
            document.getElementById('giftCategory').value = gift.category;
            document.getElementById('giftPriority').value = gift.priority;
            document.getElementById('giftPrice').value = gift.price || '';
            document.getElementById('giftStore').value = gift.store || '';
            document.getElementById('giftLink').value = gift.link || '';
            document.getElementById('giftNotes').value = gift.notes || '';
            
            if (gift.image) {
                currentImage = gift.image;
                const preview = document.getElementById('imagePreview');
                preview.src = gift.image;
                preview.style.display = 'block';
            } else {
                document.getElementById('imagePreview').style.display = 'none';
                currentImage = null;
            }
            
            document.getElementById('giftModal').style.display = 'flex';
        }
        
        function toggleReserve(index) {
            gifts[index].reserved = !gifts[index].reserved;
            if (gifts[index].reserved) {
                gifts[index].reservedBy = prompt('Par qui est réservé ce cadeau?') || 'Quelqu\'un';
            } else {
                gifts[index].reservedBy = null;
            }
            renderGifts();
            saveList();
        }
        
        function deleteGift(index) {
            if (confirm('Voulez-vous vraiment supprimer ce cadeau?')) {
                gifts.splice(index, 1);
                renderGifts();
                updateStats();
                saveList();
                showNotification('Cadeau supprimé', 'success');
            }
        }
        
        // ===== STATISTIQUES =====
        function updateStats() {
            const giftCount = gifts.length;
            const totalPrice = gifts.reduce((sum, gift) => sum + (gift.price || 0), 0);
            const highCount = gifts.filter(g => g.priority === 'high').length;
            const mediumCount = gifts.filter(g => g.priority === 'medium').length;
            const lowCount = gifts.filter(g => g.priority === 'low').length;
            
            document.getElementById('giftCount').textContent = giftCount;
            document.getElementById('totalPrice').textContent = totalPrice.toFixed(2) + '$';
            document.getElementById('highCount').textContent = highCount;
            document.getElementById('mediumCount').textContent = mediumCount;
            document.getElementById('lowCount').textContent = lowCount;
        }
        
        // ===== PARTAGE =====
        function updateShareLink() {
            const baseUrl = window.location.origin;
            const link = listId ? `${baseUrl}/giftlist/${listId}` : `${baseUrl}/giftlist/new`;
            document.getElementById('shareLink').value = link;
        }
        
        document.getElementById('copyLinkBtn').addEventListener('click', function() {
            const linkInput = document.getElementById('shareLink');
            linkInput.select();
            navigator.clipboard.writeText(linkInput.value)
                .then(() => showNotification('Lien copié dans le presse-papier!', 'success'))
                .catch(() => showNotification('Impossible de copier le lien', 'error'));
        });
        
        document.querySelectorAll('.share-option').forEach(option => {
            option.addEventListener('click', function() {
                const method = this.dataset.share;
                shareList(method);
            });
        });
        
        function shareList(method) {
            const link = document.getElementById('shareLink').value;
            const title = document.getElementById('listTitle').value || 'Ma liste de cadeaux';
            const message = `🎁 ${document.getElementById('listOwner').value || 'Quelqu\'un'} a partagé sa liste de cadeaux de Noël!\n\n${title}\n\nConsultez-la ici: ${link}`;
            
            switch(method) {
                case 'whatsapp':
                    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                    break;
                    
                case 'email':
                    const emailUrl = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(message)}`;
                    window.location.href = emailUrl;
                    break;
                    
                case 'facebook':
                    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(link)}`;
                    window.open(facebookUrl, '_blank');
                    break;
                    
                case 'print':
                    window.print();
                    break;
            }
        }
        
        document.getElementById('shareListBtn').addEventListener('click', function() {
            shareList('whatsapp');
        });
        
        // ===== IMPRESSION =====
        document.getElementById('printListBtn').addEventListener('click', function() {
            const printWindow = window.open('', '_blank');
            const listOwner = document.getElementById('listOwner').value || 'Moi';
            const listTitle = document.getElementById('listTitle').value || 'Ma liste de cadeaux';
            const listMessage = document.getElementById('listMessage').value || '';
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${listTitle}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h1 { color: #ff8fa3; }
                        .gift { border: 1px solid #ccc; padding: 15px; margin: 10px 0; border-radius: 8px; }
                        .priority-high { border-left: 5px solid #d32f2f; }
                        .priority-medium { border-left: 5px solid #ff8f00; }
                        .priority-low { border-left: 5px solid #2e7d32; }
                        .price { font-weight: bold; color: #2e7d32; }
                    </style>
                </head>
                <body>
                    <h1>${listTitle}</h1>
                    <p>Liste de ${listOwner}</p>
                    ${listMessage ? `<p><em>${listMessage}</em></p>` : ''}
                    <hr>
                    ${gifts.map(gift => `
                        <div class="gift priority-${gift.priority}">
                            <h3>${gift.name}</h3>
                            ${gift.price > 0 ? `<p class="price">${gift.price.toFixed(2)}$</p>` : ''}
                            ${gift.store ? `<p><strong>Magasin:</strong> ${gift.store}</p>` : ''}
                            ${gift.notes ? `<p>${gift.notes}</p>` : ''}
                            ${gift.link ? `<p><a href="${gift.link}">Lien du produit</a></p>` : ''}
                            <p><strong>Priorité:</strong> ${gift.priority === 'high' ? 'Haute' : gift.priority === 'medium' ? 'Moyenne' : 'Basse'}</p>
                        </div>
                    `).join('')}
                    <hr>
                    <p><strong>Total:</strong> ${gifts.reduce((sum, g) => sum + (g.price || 0), 0).toFixed(2)}$</p>
                    <p><strong>Nombre de cadeaux:</strong> ${gifts.length}</p>
                    <p>Imprimé le ${new Date().toLocaleDateString('fr-FR')}</p>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        });
        
        // ===== ACTIONS SUR LA LISTE =====
        document.getElementById('clearAllBtn').addEventListener('click', function() {
            if (gifts.length === 0) return;
            
            if (confirm('Voulez-vous vraiment supprimer tous les cadeaux de votre liste?')) {
                gifts = [];
                renderGifts();
                updateStats();
                saveList();
                showNotification('Tous les cadeaux ont été supprimés', 'success');
            }
        });
        
        document.getElementById('sortBtn').addEventListener('click', function() {
            gifts.sort((a, b) => {
                // Trier par priorité, puis par prix, puis par nom
                const priorityOrder = { high: 3, medium: 2, low: 1 };
                if (priorityOrder[b.priority] !== priorityOrder[a.priority]) {
                    return priorityOrder[b.priority] - priorityOrder[a.priority];
                }
                if (a.price !== b.price) {
                    return (b.price || 0) - (a.price || 0);
                }
                return a.name.localeCompare(b.name);
            });
            
            renderGifts();
            saveList();
            showNotification('Liste triée avec succès', 'success');
        });
        
        document.getElementById('filterBtn').addEventListener('click', function() {
            const category = prompt('Filtrer par catégorie (mode, technologie, maison, loisirs, livres, beaute, sport, autre):');
            if (!category) return;
            
            const filteredGifts = gifts.filter(g => g.category === category);
            if (filteredGifts.length === 0) {
                showNotification(`Aucun cadeau dans la catégorie "${category}"`, 'error');
                return;
            }
            
            // Temporairement afficher seulement les cadeaux filtrés
            const originalGifts = [...gifts];
            gifts = filteredGifts;
            renderGifts();
            
            // Restaurer après 5 secondes
            setTimeout(() => {
                gifts = originalGifts;
                renderGifts();
                showNotification('Filtre retiré', 'success');
            }, 5000);
        });
        
        // ===== SAUVEGARDE BACKEND =====
        async function saveToBackend(data) {
            try {
                const response = await fetch('/giftlists', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        owner: data.owner,
                        title: data.title,
                        message: data.message,
                        theme: data.theme,
                        visibility: data.visibility,
                        gifts: data.gifts,
                        local_id: data.id
                    })
                });
                
                if (response.ok) {
                    const result = await response.json();
                    if (result.success && result.data.id) {
                        listId = result.data.id;
                        updateShareLink();
                    }
                }
            } catch (error) {
                console.error('Erreur de sauvegarde backend:', error);
                // Continuer avec le localStorage seulement
            }
        }
        
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
        
        // ===== GESTION MODAL =====
        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('giftModal').style.display = 'none';
        });
        
        document.getElementById('giftModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</body>
</html>