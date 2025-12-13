<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer votre Carte de Vœux - Féérie de Noël</title>
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
            0%, 100% { box-shadow: 0 10px 30px rgba(255, 182, 193, 0.3); }
            50% { box-shadow: 0 15px 40px rgba(255, 182, 193, 0.6); }
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
        }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        /* ===== HEADER MAGIQUE ===== */
        .header-card {
            text-align: center;
            padding: 50px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            background: linear-gradient(45deg, var(--rose-principal), var(--or), var(--violet-doux));
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
            box-shadow: 0 20px 40px rgba(255, 182, 193, 0.4);
        }
        
        .card-title {
            font-family: 'Great Vibes', cursive;
            font-size: 4.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
        }
        
        .card-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== LAYOUT DE CRÉATION ===== */
        .creation-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        
        @media (max-width: 992px) {
            .creation-layout {
                grid-template-columns: 1fr;
            }
        }
        
        /* ===== PANEL D'ÉDITION ===== */
        .editor-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            backdrop-filter: blur(10px);
        }
        
        .panel-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--rose-fonce);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 3px solid var(--rose-clair);
            padding-bottom: 15px;
        }
        
        /* ===== FORMULAIRE ===== */
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
            min-height: 120px;
            resize: vertical;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--rose-fonce);
            box-shadow: 0 0 0 3px rgba(255, 143, 163, 0.2);
        }
        
        /* ===== SELECTION DE TEMPLATE ===== */
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .templates-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .template-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            height: 140px;
            background: white;
        }
        
        .template-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .template-card.selected {
            border-color: var(--rose-fonce);
            box-shadow: 0 0 0 3px rgba(255, 143, 163, 0.3);
        }
        
        .template-preview {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            text-align: center;
        }
        
        .template-name {
            margin-top: 10px;
            font-weight: 600;
            color: var(--noir-doux);
            font-size: 0.9rem;
        }
        
        /* ===== AD ROW ===== */
        .ad-row{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap
        }
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


        /* Styles des templates */
        .template-classique { background: linear-gradient(135deg, #f8c8dc, #e0bbe4); color: #5a4a4a; }
        .template-modern { background: linear-gradient(135deg, #a5f3fc, #e0f7ff); color: #1e3a8a; }
        .template-elegant { background: linear-gradient(135deg, #ffd1dc, #fff0f5); color: #8b0000; }
        .template-festif { background: linear-gradient(135deg, #2e8b57, #90ee90); color: white; }
        .template-romantic { background: linear-gradient(135deg, #ffb6c1, #ff8fa3); color: white; }
        .template-golden { background: linear-gradient(135deg, #ffd700, #ffec8b); color: #8b4513; }
        
        /* ===== ÉMOTICONES ===== */
        .emoji-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
            padding: 15px;
            background: var(--rose-clair);
            border-radius: 15px;
            max-height: 150px;
            overflow-y: auto;
        }
        
        .emoji-btn {
            font-size: 1.8rem;
            background: white;
            border: 2px solid var(--rose-principal);
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .emoji-btn:hover {
            background: var(--rose-principal);
            transform: scale(1.1);
        }
        
        .emoji-btn.selected {
            background: var(--rose-fonce);
            color: white;
            border-color: var(--rose-fonce);
        }
        
        /* ===== PRÉVISUALISATION ===== */
        .preview-panel {
            position: sticky;
            top: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            backdrop-filter: blur(10px);
            animation: cardGlow 3s infinite;
        }
        
        .card-preview {
            min-height: 500px;
            border-radius: 20px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }
        
        .preview-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .preview-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .preview-fromto {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            opacity: 0.9;
        }
        
        .preview-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px 0;
            line-height: 1.8;
            font-size: 1.2rem;
        }
        
        .preview-message {
            margin-bottom: 20px;
        }
        
        .preview-emoji {
            font-size: 3rem;
            margin: 20px 0;
            animation: sparkleEffect 2s infinite;
        }
        
        .preview-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px dashed rgba(255, 255, 255, 0.3);
            font-family: 'Great Vibes', cursive;
            font-size: 1.8rem;
        }
        
        /* ===== SECTION WHATSAPP ===== */
        .whatsapp-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 20px;
            padding: 30px;
            margin: 40px 0;
            border: 2px dashed var(--rose-fonce);
        }
        
        .whatsapp-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .whatsapp-header i {
            color: #25D366;
            font-size: 2.5rem;
        }
        
        .phone-input-group {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 15px;
            align-items: center;
        }
        
        @media (max-width: 576px) {
            .phone-input-group {
                grid-template-columns: 1fr;
            }
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
        
        .btn-preview {
            background: white;
            color: var(--rose-fonce);
            border: 3px solid var(--rose-fonce);
        }
        
        .btn-share {
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: white;
        }
        
        .btn-action:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        /* ===== MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.85);
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
            overflow: hidden;
        }
        
        .modal-header {
            padding: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--violet-doux));
            color: white;
            text-align: center;
        }
        
        .modal-body {
            padding: 30px;
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
            .card-title { font-size: 3.2rem; }
            .card-subtitle { font-size: 1.8rem; }
            .creation-layout { gap: 25px; }
            .editor-panel, .preview-panel { padding: 25px; }
            .panel-title { font-size: 2rem; }
            .btn-action { min-width: 100%; }
            .action-buttons { flex-direction: column; }
            .templates-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 480px) {
            .card-title { font-size: 2.5rem; }
            .panel-title { font-size: 1.8rem; }
            .templates-grid { grid-template-columns: 1fr; }
            .template-card { height: 120px; }
        }
    </style>
</head>
<body>
    {{-- @component('components.ads.popunder')
    @endcomponent --}}

    <!-- Confetti animé -->
    <div id="confettiContainer"></div>

    @include('components.floating-home')
    
    <div class="container">
        <!-- Header animé -->
        <header class="header-card">
            <h1 class="card-title">Carte de Vœux Enchantée</h1>
            <p class="card-subtitle">Créez des souhaits magiques pour le Nouvel An</p>
        </header>

        <div class="ad-row">
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
            <!-- Panel d'édition -->
            <div class="editor-panel">
                <h2 class="panel-title"><i class="fas fa-magic"></i> Personnalisez votre carte</h2>
                
                <form id="cardForm">
                    <!-- Expéditeur / Destinataire -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> De la part de</label>
                        <input type="text" class="form-input" id="fromName" placeholder="Votre nom" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-heart"></i> Pour</label>
                        <input type="text" class="form-input" id="toName" placeholder="Nom du destinataire" required>
                    </div>
                    
                    <!-- Titre du message -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-star"></i> Titre de vos vœux</label>
                        <input type="text" class="form-input" id="cardTitle" placeholder="Ex: Meilleurs vœux pour 2026!" required>
                    </div>
                    
                    <!-- Message principal -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-envelope"></i> Votre message</label>
                        <textarea class="form-textarea" id="cardMessage" placeholder="Écrivez ici votre message de vœux..." rows="4" required></textarea>
                    </div>
                    
                    <!-- Sélection du template -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-palette"></i> Design de la carte</label>
                        <div class="templates-grid">
                            <div class="template-card selected" data-template="classique">
                                <div class="template-preview template-classique">
                                    <i class="fas fa-gem" style="font-size: 2rem;"></i>
                                    <div class="template-name">Classique</div>
                                </div>
                            </div>
                            
                            <div class="template-card" data-template="modern">
                                <div class="template-preview template-modern">
                                    <i class="fas fa-snowflake" style="font-size: 2rem;"></i>
                                    <div class="template-name">Moderne</div>
                                </div>
                            </div>
                            
                            <div class="template-card" data-template="elegant">
                                <div class="template-preview template-elegant">
                                    <i class="fas fa-crown" style="font-size: 2rem;"></i>
                                    <div class="template-name">Élégant</div>
                                </div>
                            </div>
                            
                            <div class="template-card" data-template="festif">
                                <div class="template-preview template-festif">
                                    <i class="fas fa-tree" style="font-size: 2rem;"></i>
                                    <div class="template-name">Festif</div>
                                </div>
                            </div>
                            
                            <div class="template-card" data-template="romantic">
                                <div class="template-preview template-romantic">
                                    <i class="fas fa-heart" style="font-size: 2rem;"></i>
                                    <div class="template-name">Romantique</div>
                                </div>
                            </div>
                            
                            <div class="template-card" data-template="golden">
                                <div class="template-preview template-golden">
                                    <i class="fas fa-star" style="font-size: 2rem;"></i>
                                    <div class="template-name">Doré</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Émojis -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-smile"></i> Ajoutez un émoji spécial</label>
                        <div class="emoji-selector">
                            <button type="button" class="emoji-btn" data-emoji="🎊">🎊</button>
                            <button type="button" class="emoji-btn" data-emoji="✨">✨</button>
                            <button type="button" class="emoji-btn selected" data-emoji="🎉">🎉</button>
                            <button type="button" class="emoji-btn" data-emoji="🥂">🥂</button>
                            <button type="button" class="emoji-btn" data-emoji="🎁">🎁</button>
                            <button type="button" class="emoji-btn" data-emoji="❤️">❤️</button>
                            <button type="button" class="emoji-btn" data-emoji="🌟">🌟</button>
                            <button type="button" class="emoji-btn" data-emoji="🎆">🎆</button>
                            <button type="button" class="emoji-btn" data-emoji="🍾">🍾</button>
                            <button type="button" class="emoji-btn" data-emoji="🕯️">🕯️</button>
                            <button type="button" class="emoji-btn" data-emoji="🎇">🎇</button>
                            <button type="button" class="emoji-btn" data-emoji="💫">💫</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Prévisualisation -->
            <div class="preview-panel">
                <h2 class="panel-title"><i class="fas fa-eye"></i> Prévisualisation</h2>
                
                <div class="card-preview template-classique" id="cardPreview">
                    <div class="preview-header">
                        <h3 class="preview-title" id="previewTitle">Meilleurs vœux pour 2026!</h3>
                        <div class="preview-fromto">
                            <span id="previewFrom">De: Marie</span> • 
                            <span id="previewTo">Pour: Maman</span>
                        </div>
                    </div>
                    
                    <div class="preview-content">
                        <div class="preview-emoji" id="previewEmoji">🎉</div>
                        <div class="preview-message" id="previewMessage">
                            Que cette nouvelle année vous apporte bonheur, santé et succès dans tous vos projets!
                        </div>
                    </div>
                    
                    <div class="preview-footer" id="previewFooter">
                        Bonne Année 2026!
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 25px; color: #7a6a6a; font-size: 0.9rem;">
                    <i class="fas fa-sync-alt"></i> La prévisualisation se met à jour automatiquement
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

        <div class="ad-row">
            <div>
                @component('components.ads.banners.banner-320x50')
                @endcomponent
            </div>
            <div>
                @component('components.ads.banners.banner-320x50')
                @endcomponent
            </div>
        </div>
        
        <!-- Section WhatsApp -->
        <div class="whatsapp-section">
            <div class="whatsapp-header">
                <i class="fab fa-whatsapp"></i>
                <div>
                    <h3 style="margin: 0; color: var(--noir-doux);">Envoyez par WhatsApp</h3>
                    <p style="margin: 5px 0 0; color: #7a6a6a;">Le destinataire recevra un lien vers sa carte personnalisée</p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="phone-input-group">
                <select class="form-select" id="countryCode" style="width: 200px;">
                    <!-- Pays Africains -->
                    <optgroup label="🌍 Afrique">
                        <option value="+213">+213 DZ Algérie</option>
                        <option value="+244">+244 AO Angola</option>
                        <option value="+229">+229 BJ Bénin</option>
                        <option value="+267">+267 BW Botswana</option>
                        <option value="+226">+226 BF Burkina Faso</option>
                        <option value="+257">+257 BI Burundi</option>
                        <option value="+237">+237 CM Cameroun</option>
                        <option value="+238">+238 CV Cap-Vert</option>
                        <option value="+236">+236 CF Centrafrique</option>
                        <option value="+235">+235 TD Tchad</option>
                        <option value="+269">+269 KM Comores</option>
                        <option value="+242">+242 CG Congo</option>
                        <option value="+243">+243 CD RD Congo</option>
                        <option value="+225">+225 CI Côte d'Ivoire</option>
                        <option value="+253">+253 DJ Djibouti</option>
                        <option value="+20">+20 EG Égypte</option>
                        <option value="+240">+240 GQ Guinée équatoriale</option>
                        <option value="+291">+291 ER Érythrée</option>
                        <option value="+268">+268 SZ Eswatini</option>
                        <option value="+251">+251 ET Éthiopie</option>
                        <option value="+241">+241 GA Gabon</option>
                        <option value="+220">+220 GM Gambie</option>
                        <option value="+233">+233 GH Ghana</option>
                        <option value="+224">+224 GN Guinée</option>
                        <option value="+245">+245 GW Guinée-Bissau</option>
                        <option value="+254">+254 KE Kenya</option>
                        <option value="+266">+266 LS Lesotho</option>
                        <option value="+231">+231 LR Libéria</option>
                        <option value="+218">+218 LY Libye</option>
                        <option value="+261">+261 MG Madagascar</option>
                        <option value="+265">+265 MW Malawi</option>
                        <option value="+223">+223 ML Mali</option>
                        <option value="+222">+222 MR Mauritanie</option>
                        <option value="+230">+230 MU Maurice</option>
                        <option value="+212">+212 MA Maroc</option>
                        <option value="+258">+258 MZ Mozambique</option>
                        <option value="+264">+264 NA Namibie</option>
                        <option value="+227">+227 NE Niger</option>
                        <option value="+234">+234 NG Nigéria</option>
                        <option value="+250">+250 RW Rwanda</option>
                        <option value="+239">+239 ST Sao Tomé-et-Principe</option>
                        <option value="+221">+221 SN Sénégal</option>
                        <option value="+248">+248 SC Seychelles</option>
                        <option value="+232">+232 SL Sierra Leone</option>
                        <option value="+252">+252 SO Somalie</option>
                        <option value="+27">+27 ZA Afrique du Sud</option>
                        <option value="+211">+211 SS Soudan du Sud</option>
                        <option value="+249">+249 SD Soudan</option>
                        <option value="+255">+255 TZ Tanzanie</option>
                        <option value="+228">+228 TG Togo</option>
                        <option value="+216">+216 TN Tunisie</option>
                        <option value="+256">+256 UG Ouganda</option>
                        <option value="+260">+260 ZM Zambie</option>
                        <option value="+263">+263 ZW Zimbabwe</option>
                    </optgroup>

                    <!-- Europe -->
                    <optgroup label="🇪🇺 Europe">
                        <option value="+33">+33 FR France</option>
                        <option value="+49">+49 DE Allemagne</option>
                        <option value="+44">+44 GB Royaume-Uni</option>
                        <option value="+39">+39 IT Italie</option>
                        <option value="+34">+34 ES Espagne</option>
                        <option value="+32">+32 BE Belgique</option>
                        <option value="+41">+41 CH Suisse</option>
                        <option value="+31">+31 NL Pays-Bas</option>
                        <option value="+351">+351 PT Portugal</option>
                        <option value="+7">+7 RU Russie</option>
                        <option value="+48">+48 PL Pologne</option>
                        <option value="+46">+46 SE Suède</option>
                        <option value="+45">+45 DK Danemark</option>
                        <option value="+47">+47 NO Norvège</option>
                        <option value="+358">+358 FI Finlande</option>
                        <option value="+43">+43 AT Autriche</option>
                        <option value="+30">+30 GR Grèce</option>
                        <option value="+353">+353 IE Irlande</option>
                    </optgroup>

                    <!-- Amérique du Nord -->
                    <optgroup label="🌎 Amérique du Nord">
                        <option value="+1">+1 US/CA États-Unis/Canada</option>
                        <option value="+52">+52 MX Mexique</option>
                    </optgroup>

                    <!-- Amérique du Sud -->
                    <optgroup label="🌎 Amérique du Sud">
                        <option value="+55">+55 BR Brésil</option>
                        <option value="+54">+54 AR Argentine</option>
                        <option value="+56">+56 CL Chili</option>
                        <option value="+57">+57 CO Colombie</option>
                        <option value="+51">+51 PE Pérou</option>
                        <option value="+58">+58 VE Venezuela</option>
                    </optgroup>

                    <!-- Asie -->
                    <optgroup label="🌏 Asie">
                        <option value="+86">+86 CN Chine</option>
                        <option value="+91">+91 IN Inde</option>
                        <option value="+81">+81 JP Japon</option>
                        <option value="+82">+82 KR Corée du Sud</option>
                        <option value="+62">+62 ID Indonésie</option>
                        <option value="+66">+66 TH Thaïlande</option>
                        <option value="+84">+84 VN Vietnam</option>
                        <option value="+63">+63 PH Philippines</option>
                        <option value="+65">+65 SG Singapour</option>
                        <option value="+60">+60 MY Malaisie</option>
                        <option value="+92">+92 PK Pakistan</option>
                        <option value="+880">+880 BD Bangladesh</option>
                        <option value="+971">+971 AE Émirats Arabes Unis</option>
                        <option value="+966">+966 SA Arabie Saoudite</option>
                        <option value="+972">+972 IL Israël</option>
                        <option value="+90">+90 TR Turquie</option>
                    </optgroup>

                    <!-- Océanie -->
                    <optgroup label="🌏 Océanie">
                        <option value="+61">+61 AU Australie</option>
                        <option value="+64">+64 NZ Nouvelle-Zélande</option>
                    </optgroup>
                </select>

                <input type="tel" class="form-input" id="recipientPhone" placeholder="Numéro du destinataire (sans le 0)" required>
                </div>
                <small style="display: block; margin-top: 8px; color: #7a6a6a;">
                    Exemple: 6 12 34 56 78 (sans espaces)
                </small>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button type="button" class="btn-action btn-preview" id="fullPreviewBtn">
                <i class="fas fa-expand"></i> Voir en grand
            </button>
            
            <button type="submit" form="cardForm" class="btn-action btn-save">
                <i class="fas fa-paper-plane"></i> Envoyer la carte
            </button>
            
            <button type="button" class="btn-action btn-share" id="shareBtn">
                <i class="fas fa-share-alt"></i> Partager
            </button>
        </div>

        <div class="ad-row">
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
                Créez des souvenirs magiques qui resteront dans les cœurs 💖
            </p>
            <a href="/" class="back-link">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
        </footer>
    </div>
    
    <!-- Modal de prévisualisation -->
    <div class="modal" id="fullPreviewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="margin: 0; font-family: 'Dancing Script', cursive; font-size: 2.5rem;">
                    Votre carte de vœux
                </h3>
            </div>
            <div class="modal-body">
                <div id="fullPreview" style="min-height: 400px; border-radius: 15px;"></div>
            </div>
        </div>
    </div>
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Votre carte a été créée avec succès!</span>
    </div>

        <div class="ad-row">
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
        let selectedTemplate = 'classique';
        let selectedEmoji = '🎉';
        let cardId = null;
        
        // ===== INITIALISATION DES CONFÉTIS =====
        function createConfetti() {
            const colors = ['#ff8fa3', '#ffd700', '#d8b4fe', '#a5f3fc', '#2e8b57'];
            const container = document.getElementById('confettiContainer');
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.width = Math.random() * 20 + 10 + 'px';
                confetti.style.height = confetti.style.width;
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 5 + 's';
                
                container.appendChild(confetti);
                
                // Supprimer après l'animation
                setTimeout(() => {
                    confetti.remove();
                }, 7000);
            }
        }
        
        // Lancer les confettis au chargement
        window.addEventListener('load', function() {
            createConfetti();
            setInterval(createConfetti, 8000);
        });
        
        // ===== SÉLECTION DE TEMPLATE =====
        document.querySelectorAll('.template-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.template-card').forEach(c => {
                    c.classList.remove('selected');
                });
                
                this.classList.add('selected');
                selectedTemplate = this.dataset.template;
                
                // Mettre à jour la prévisualisation
                updatePreview();
            });
        });
        
        // ===== SÉLECTION D'ÉMOJI =====
        document.querySelectorAll('.emoji-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.emoji-btn').forEach(b => {
                    b.classList.remove('selected');
                });
                
                this.classList.add('selected');
                selectedEmoji = this.dataset.emoji;
                
                // Mettre à jour la prévisualisation
                updatePreview();
            });
        });
        
        // ===== MISE À JOUR EN TEMPS RÉEL =====
        const inputs = ['fromName', 'toName', 'cardTitle', 'cardMessage'];
        inputs.forEach(id => {
            document.getElementById(id).addEventListener('input', updatePreview);
        });
        
        function updatePreview() {
            // Mettre à jour le template
            const preview = document.getElementById('cardPreview');
            preview.className = 'card-preview template-' + selectedTemplate;
            
            // Mettre à jour le contenu
            document.getElementById('previewTitle').textContent = 
                document.getElementById('cardTitle').value || 'Meilleurs vœux pour 2026!';
            
            document.getElementById('previewFrom').textContent = 
                'De: ' + (document.getElementById('fromName').value || 'Vous');
            
            document.getElementById('previewTo').textContent = 
                'Pour: ' + (document.getElementById('toName').value || 'Destinataire');
            
            document.getElementById('previewEmoji').textContent = selectedEmoji;
            
            document.getElementById('previewMessage').textContent = 
                document.getElementById('cardMessage').value || 
                'Que cette nouvelle année vous apporte bonheur, santé et succès dans tous vos projets!';
            
            // Ajuster la couleur du texte selon le template
            const textColor = selectedTemplate === 'festif' || selectedTemplate === 'romantic' ? 'white' : 'var(--noir-doux)';
            preview.style.color = textColor;
        }
        
        // ===== PRÉVISUALISATION COMPLÈTE =====
        document.getElementById('fullPreviewBtn').addEventListener('click', function() {
            const from = document.getElementById('fromName').value || 'Vous';
            const to = document.getElementById('toName').value || 'Destinataire';
            const title = document.getElementById('cardTitle').value || 'Meilleurs vœux pour 2026!';
            const message = document.getElementById('cardMessage').value || 
                'Que cette nouvelle année vous apporte bonheur, santé et succès dans tous vos projets!';
            
            const fullPreviewHTML = `
                <div class="card-preview template-${selectedTemplate}" style="min-height: 500px;">
                    <div class="preview-header">
                        <h3 class="preview-title" style="font-size: 2.8rem;">${title}</h3>
                        <div class="preview-fromto" style="font-size: 1.8rem;">
                            De: ${from} • Pour: ${to}
                        </div>
                    </div>
                    
                    <div class="preview-content">
                        <div class="preview-emoji" style="font-size: 4rem;">${selectedEmoji}</div>
                        <div class="preview-message" style="font-size: 1.4rem; line-height: 1.6;">
                            ${message.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                    
                    <div class="preview-footer" style="font-size: 2.2rem;">
                        Bonne Année 2026! 🎊
                    </div>
                </div>
            `;
            
            document.getElementById('fullPreview').innerHTML = fullPreviewHTML;
            document.getElementById('fullPreviewModal').style.display = 'flex';
        });
        
        // Fermer le modal
        document.getElementById('fullPreviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
        
        // ===== SAUVEGARDE ET ENVOI =====
        document.getElementById('cardForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validation
            const countryCode = document.getElementById('countryCode').value;
            const phone = document.getElementById('recipientPhone').value.replace(/\s/g, '');
            
            if (!phone) {
                showNotification('Veuillez entrer un numéro de téléphone', 'error');
                return;
            }
            
            if (!/^\d{9,15}$/.test(phone)) {
                showNotification('Format de téléphone invalide', 'error');
                return;
            }
            
            // Préparer les données
            const cardData = {
                id: 'card_' + Date.now(),
                from: document.getElementById('fromName').value,
                to: document.getElementById('toName').value,
                title: document.getElementById('cardTitle').value,
                message: document.getElementById('cardMessage').value,
                template: selectedTemplate,
                emoji: selectedEmoji,
                phone: countryCode + phone,
                type: 'card',
                createdAt: new Date().toISOString(),
                synced: false
            };
            
            try {
                // Sauvegarder localement
                saveToLocalStorage(cardData);
                
                // Envoyer au backend Laravel
                const response = await saveToBackend(cardData);
                
                if (response.success) {
                    cardId = response.data.id;
                    
                    // Générer le message WhatsApp
                    const shareLink = response.data.share_link || `${window.location.origin}/card/${cardId}`;
                    await sendWhatsApp(shareLink, countryCode + phone, cardData);
                    
                    showNotification('Carte envoyée avec succès!', 'success');
                    
                    // Redirection
                    setTimeout(() => {
                        window.location.href = shareLink;
                    }, 2000);
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Carte sauvegardée localement. Synchronisation en cours...', 'success');
            }
        });
        
        // ===== PARTAGE =====
        document.getElementById('shareBtn').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Ma carte de vœux',
                    text: 'J\'ai créé une belle carte de vœux!',
                    url: window.location.href
                });
            } else {
                showNotification('Copiez le lien pour partager', 'success');
            }
        });
        
        // ===== FONCTIONS UTILITAIRES =====
        function saveToLocalStorage(data) {
            let cards = JSON.parse(localStorage.getItem('christmasCards')) || [];
            
            // Vérifier les doublons
            const existingIndex = cards.findIndex(c => c.id === data.id);
            
            if (existingIndex !== -1) {
                cards[existingIndex] = data;
            } else {
                cards.push(data);
            }
            
            localStorage.setItem('christmasCards', JSON.stringify(cards));
        }
        
        async function saveToBackend(data) {
            try {
                const response = await fetch('/cards', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        from: data.from,
                        to: data.to,
                        title: data.title,
                        message: data.message,
                        template: data.template,
                        emoji: data.emoji,
                        phone: data.phone,
                        local_id: data.id
                    })
                });
                
                if (!response.ok) {
                    throw new Error('Erreur serveur');
                }
                
                const result = await response.json();
                
                if (result.success) {
                    return result;
                } else {
                    throw new Error(result.message);
                }
            } catch (error) {
                console.error('Erreur backend:', error);
                throw error;
            }
        }
        
        function sendWhatsApp(link, phone, cardData) {
            const message = `🎊 Bonjour ${cardData.to}! ${cardData.from} vous a envoyé une carte de vœux pour le Nouvel An! 🎁\n\nCliquez sur ce lien pour découvrir votre carte personnalisée:\n${link}\n\n${cardData.emoji} Bonne Année 2026! ${cardData.emoji}`;
            
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${phone}?text=${encodedMessage}`;
            
            window.open(whatsappUrl, '_blank');
            return Promise.resolve();
        }
        
        function showNotification(text, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = text;
            notification.className = `notification ${type}`;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }
        
        // ===== SYNCHRONISATION =====
        async function syncUnsentCards() {
            const cards = JSON.parse(localStorage.getItem('christmasCards')) || [];
            const unsentCards = cards.filter(card => !card.synced);
            
            if (unsentCards.length === 0) return;
            
            try {
                const response = await fetch('/api/cards/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ cards: unsentCards })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Marquer comme synchronisé
                    cards.forEach(card => {
                        if (unsentCards.some(unsent => unsent.id === card.id)) {
                            card.synced = true;
                        }
                    });
                    
                    localStorage.setItem('christmasCards', JSON.stringify(cards));
                    
                    if (data.synced_count > 0) {
                        console.log(`${data.synced_count} cartes synchronisées`);
                    }
                }
            } catch (error) {
                console.error('Erreur de synchronisation:', error);
            }
        }
        
        // Synchronisation automatique
        window.addEventListener('load', function() {
            setTimeout(syncUnsentCards, 3000);
            setInterval(syncUnsentCards, 5 * 60 * 1000);
        });
        
        window.addEventListener('online', syncUnsentCards);
        
        // ===== INITIALISATION =====
        updatePreview();
    </script>
</body>
</html>