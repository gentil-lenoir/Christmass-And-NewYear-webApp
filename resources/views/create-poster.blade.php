<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer votre Affiche Personnalisée - Féérie de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --turquoise: #40e0d0;
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
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(255, 182, 193, 0.5)); }
            50% { filter: drop-shadow(0 0 20px rgba(255, 182, 193, 0.8)); }
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        
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
        
        .poster-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .poster-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: white;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* ===== LAYOUT DE CRÉATION ===== */
        .creation-container {
            display: grid;
            grid-template-columns: 300px 1fr 300px;
            gap: 30px;
            margin-bottom: 50px;
            min-height: 800px;
        }
        
        @media (max-width: 1200px) {
            .creation-container {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto;
            }
        }
        
        /* ===== SIDEBAR GAUCHE - OUTILS ===== */
        .tools-sidebar {
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
        
        .sidebar-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: var(--rose-fonce);
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 3px solid var(--rose-clair);
            padding-bottom: 15px;
        }
        
        /* ===== CANVAS PRINCIPAL ===== */
        .canvas-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        #posterCanvas {
            width: 100%;
            max-width: 800px;
            height: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--rose-clair);
            cursor: crosshair;
        }
        
        .canvas-controls {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .canvas-btn {
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
        
        .canvas-btn:hover {
            background: var(--rose-principal);
            color: white;
            transform: translateY(-3px);
        }
        
        .canvas-btn.active {
            background: var(--rose-fonce);
            color: white;
            border-color: var(--rose-fonce);
        }
        
        /* ===== SIDEBAR DROITE - ÉLÉMENTS ===== */
        .elements-sidebar {
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
        
        /* ===== GROUPES D'OUTILS ===== */
        .tool-group {
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px dashed var(--rose-clair);
        }
        
        .tool-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .group-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--noir-doux);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .group-title i {
            color: var(--rose-fonce);
            font-size: 1.5rem;
        }
        
        /* ===== BOUTONS D'ÉLÉMENTS ===== */
        .elements-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .element-btn {
            padding: 15px;
            background: white;
            border: 2px solid var(--rose-clair);
            border-radius: 15px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .element-btn:hover {
            border-color: var(--rose-fonce);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 143, 163, 0.2);
        }
        
        .element-icon {
            font-size: 2rem;
            color: var(--rose-fonce);
        }
        
        .element-name {
            font-weight: 600;
            color: var(--noir-doux);
            font-size: 0.9rem;
        }
        
        /* ===== SELECTEUR DE COULEURS ===== */
        .color-palette {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 15px;
        }
        
        .color-swatch {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .color-swatch:hover {
            transform: scale(1.1);
        }
        
        .color-swatch.selected {
            border-color: white;
            box-shadow: 0 0 0 3px var(--noir-doux);
        }
        
        /* ===== STICKERS ===== */
        .stickers-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            background: var(--rose-clair);
            border-radius: 15px;
        }
        
        .sticker-item {
            font-size: 2rem;
            text-align: center;
            cursor: pointer;
            padding: 10px;
            background: white;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .sticker-item:hover {
            transform: scale(1.2);
            background: var(--rose-principal);
        }
        
        /* ===== UPLOAD PHOTO ===== */
        .photo-upload {
            text-align: center;
            padding: 25px;
            border: 3px dashed var(--rose-principal);
            border-radius: 20px;
            background: var(--rose-clair);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }
        
        .photo-upload:hover {
            background: var(--rose-principal);
            border-color: var(--rose-fonce);
        }
        
        .upload-icon {
            font-size: 3rem;
            color: var(--rose-fonce);
            margin-bottom: 15px;
        }
        
        /* ===== FORMULAIRES DE TEXTE ===== */
        .text-inputs {
            margin-top: 40px;
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 20px;
            padding: 30px;
            border: 2px solid var(--rose-fonce);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
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
        }
        
        .whatsapp-header i {
            color: #25D366;
            font-size: 2.5rem;
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
        
        .btn-download {
            background: linear-gradient(45deg, var(--vert-noel), var(--turquoise));
            color: white;
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
            overflow: hidden;
        }
        
        .modal-header {
            padding: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--violet-doux));
            color: white;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        @media (max-width: 1200px) {
            .tools-sidebar, .elements-sidebar {
                position: static;
            }
        }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .poster-title { font-size: 3rem; }
            .poster-subtitle { font-size: 2rem; }
            .creation-container { gap: 20px; }
            .elements-grid { grid-template-columns: repeat(3, 1fr); }
            .btn-action { min-width: 100%; }
            .action-buttons { flex-direction: column; }
        }
        
        @media (max-width: 480px) {
            .poster-title { font-size: 2.5rem; }
            .sidebar-title { font-size: 1.8rem; }
            .elements-grid { grid-template-columns: repeat(2, 1fr); }
            #posterCanvas { height: 400px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header-poster">
            <h1 class="poster-title">AFFICHE PERSONNALISÉE</h1>
            <p class="poster-subtitle">Créez votre chef-d'œuvre festif unique</p>
        </header>
        
        <!-- Container principal -->
        <div class="creation-container">
            <!-- Sidebar gauche - Outils -->
            <div class="tools-sidebar">
                <h2 class="sidebar-title"><i class="fas fa-paint-brush"></i> Outils</h2>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-brush"></i> Pinceau</h3>
                    <div class="canvas-controls">
                        <button class="canvas-btn active" data-tool="draw">
                            <i class="fas fa-pen"></i> Dessiner
                        </button>
                        <button class="canvas-btn" data-tool="erase">
                            <i class="fas fa-eraser"></i> Effacer
                        </button>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Taille du pinceau</label>
                        <input type="range" id="brushSize" min="1" max="50" value="5" style="width: 100%;">
                        <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                            <span style="font-size: 0.9rem;">Fin</span>
                            <span style="font-size: 0.9rem;" id="brushValue">5px</span>
                            <span style="font-size: 0.9rem;">Épais</span>
                        </div>
                    </div>
                </div>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-fill-drip"></i> Couleurs</h3>
                    <div class="color-palette">
                        <div class="color-swatch selected" style="background: #ff8fa3;" data-color="#ff8fa3"></div>
                        <div class="color-swatch" style="background: #ffd700;" data-color="#ffd700"></div>
                        <div class="color-swatch" style="background: #2e8b57;" data-color="#2e8b57"></div>
                        <div class="color-swatch" style="background: #d8b4fe;" data-color="#d8b4fe"></div>
                        <div class="color-swatch" style="background: #a5f3fc;" data-color="#a5f3fc"></div>
                        <div class="color-swatch" style="background: #ff6b6b;" data-color="#ff6b6b"></div>
                        <div class="color-swatch" style="background: #40e0d0;" data-color="#40e0d0"></div>
                        <div class="color-swatch" style="background: #8b4513;" data-color="#8b4513"></div>
                        <div class="color-swatch" style="background: #ffffff;" data-color="#ffffff" data-border="true"></div>
                        <div class="color-swatch" style="background: #000000;" data-color="#000000"></div>
                        <div class="color-swatch" style="background: #4a4a4a;" data-color="#4a4a4a"></div>
                        <div class="color-swatch" style="background: linear-gradient(45deg, #ff8fa3, #ffd700);" data-color="gradient"></div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Couleur personnalisée</label>
                        <input type="color" id="customColor" value="#ff8fa3" style="width: 100%; height: 40px; border-radius: 10px; border: 2px solid var(--rose-clair);">
                    </div>
                </div>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-text-height"></i> Texte</h3>
                    <div class="form-group">
                        <input type="text" class="form-input" id="textInput" placeholder="Tapez votre texte...">
                    </div>
                    <div class="canvas-controls">
                        <button class="canvas-btn" id="addTextBtn">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                        <button class="canvas-btn" id="clearTextBtn">
                            <i class="fas fa-trash"></i> Effacer
                        </button>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Police</label>
                        <select class="form-select" id="fontSelect">
                            <option value="'Dancing Script', cursive">Dancing Script</option>
                            <option value="'Poppins', sans-serif">Poppins</option>
                            <option value="'Montserrat', sans-serif">Montserrat</option>
                            <option value="'Playfair Display', serif">Playfair Display</option>
                            <option value="Arial">Arial</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Canvas principal -->
            <div class="canvas-container">
                <canvas id="posterCanvas"></canvas>
                
                <div class="canvas-controls">
                    <button class="canvas-btn" id="clearCanvasBtn">
                        <i class="fas fa-broom"></i> Effacer tout
                    </button>
                    <button class="canvas-btn" id="undoBtn">
                        <i class="fas fa-undo"></i> Annuler
                    </button>
                    <button class="canvas-btn" id="saveCanvasBtn">
                        <i class="fas fa-save"></i> Sauvegarder
                    </button>
                </div>
            </div>
            
            <!-- Sidebar droite - Éléments -->
            <div class="elements-sidebar">
                <h2 class="sidebar-title"><i class="fas fa-star"></i> Éléments</h2>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-shapes"></i> Formes</h3>
                    <div class="elements-grid">
                        <button class="element-btn" data-shape="heart">
                            <i class="fas fa-heart element-icon"></i>
                            <span class="element-name">Cœur</span>
                        </button>
                        <button class="element-btn" data-shape="star">
                            <i class="fas fa-star element-icon"></i>
                            <span class="element-name">Étoile</span>
                        </button>
                        <button class="element-btn" data-shape="tree">
                            <i class="fas fa-tree element-icon"></i>
                            <span class="element-name">Sapin</span>
                        </button>
                        <button class="element-btn" data-shape="snowflake">
                            <i class="fas fa-snowflake element-icon"></i>
                            <span class="element-name">Flocon</span>
                        </button>
                        <button class="element-btn" data-shape="gift">
                            <i class="fas fa-gift element-icon"></i>
                            <span class="element-name">Cadeau</span>
                        </button>
                        <button class="element-btn" data-shape="circle">
                            <i class="fas fa-circle element-icon"></i>
                            <span class="element-name">Cercle</span>
                        </button>
                    </div>
                </div>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-sticky-note"></i> Stickers</h3>
                    <div class="stickers-grid">
                        <div class="sticker-item" data-sticker="🎄">🎄</div>
                        <div class="sticker-item" data-sticker="🎁">🎁</div>
                        <div class="sticker-item" data-sticker="⭐">⭐</div>
                        <div class="sticker-item" data-sticker="❄️">❄️</div>
                        <div class="sticker-item" data-sticker="✨">✨</div>
                        <div class="sticker-item" data-sticker="🎊">🎊</div>
                        <div class="sticker-item" data-sticker="🎉">🎉</div>
                        <div class="sticker-item" data-sticker="❤️">❤️</div>
                        <div class="sticker-item" data-sticker="🌟">🌟</div>
                        <div class="sticker-item" data-sticker="🦌">🦌</div>
                        <div class="sticker-item" data-sticker="🔔">🔔</div>
                        <div class="sticker-item" data-sticker="🕯️">🕯️</div>
                    </div>
                </div>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-images"></i> Photos</h3>
                    <div class="photo-upload" id="photoUpload">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <p style="font-weight: 600; color: var(--noir-doux);">Ajouter une photo</p>
                        <p style="font-size: 0.9rem; color: #7a6a6a; margin-top: 5px;">
                            Glissez-déposez ou cliquez pour uploader
                        </p>
                        <input type="file" id="fileInput" accept="image/*" style="display: none;">
                    </div>
                </div>
                
                <div class="tool-group">
                    <h3 class="group-title"><i class="fas fa-layer-group"></i> Arrière-plans</h3>
                    <div class="elements-grid">
                        <button class="element-btn" data-bg="solid" data-color="#ffebf0">
                            <div style="width: 40px; height: 40px; background: #ffebf0; border-radius: 8px;"></div>
                            <span class="element-name">Rose clair</span>
                        </button>
                        <button class="element-btn" data-bg="gradient" data-color="linear-gradient(135deg, #ffb6c1, #ffd1dc)">
                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ffb6c1, #ffd1dc); border-radius: 8px;"></div>
                            <span class="element-name">Dégradé rose</span>
                        </button>
                        <button class="element-btn" data-bg="pattern" data-color="noel">
                            <div style="width: 40px; height: 40px; background: #2e8b57; border-radius: 8px; position: relative;">
                                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">🎄</span>
                            </div>
                            <span class="element-name">Noël</span>
                        </button>
                        <button class="element-btn" data-bg="pattern" data-color="snow">
                            <div style="width: 40px; height: 40px; background: #a5f3fc; border-radius: 8px; position: relative;">
                                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">❄️</span>
                            </div>
                            <span class="element-name">Neige</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulaire de texte -->
        <div class="text-inputs">
            <h2 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem; color: var(--rose-fonce); text-align: center; margin-bottom: 30px;">
                <i class="fas fa-edit"></i> Informations de l'affiche
            </h2>
            
            <form id="posterForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Titre de l'affiche</label>
                        <input type="text" class="form-input" id="posterTitle" placeholder="Ex: Joyeux Noël Famille Dupont!" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-users"></i> Noms à afficher</label>
                        <input type="text" class="form-input" id="posterNames" placeholder="Ex: Papa, Maman, Julie, Tom" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-quote-left"></i> Message principal</label>
                    <textarea class="form-textarea" id="posterMessage" placeholder="Écrivez votre message festif ici..." rows="3"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-calendar"></i> Année</label>
                        <select class="form-select" id="posterYear">
                            <option value="2026">2026</option>
                            <option value="2026" selected>2026</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-palette"></i> Style</label>
                        <select class="form-select" id="posterStyle">
                            <option value="festif">Festif</option>
                            <option value="elegant">Élégant</option>
                            <option value="familial">Familial</option>
                            <option value="romantique">Romantique</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Section WhatsApp -->
        <div class="whatsapp-section">
            <div class="whatsapp-header">
                <i class="fab fa-whatsapp"></i>
                <div>
                    <h3 style="margin: 0; color: var(--noir-doux);">Partagez votre création</h3>
                    <p style="margin: 5px 0 0; color: #7a6a6a;">Envoyez un lien vers votre affiche personnalisée</p>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-phone"></i> Numéro WhatsApp</label>
                    <div style="display: flex; gap: 15px;">
                        <select class="form-select" id="countryCode" style="flex: 0 0 120px;">
                            <option value="+33">+33 FR</option>
                            <option value="+1">+1 US</option>
                            <option value="+32">+32 BE</option>
                        </select>
                        <input type="tel" class="form-input" id="recipientPhone" placeholder="Numéro du destinataire" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user-friends"></i> Multiples destinataires</label>
                    <input type="text" class="form-input" id="multiplePhones" placeholder="Séparez par des virgules (optionnel)">
                </div>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button type="button" class="btn-action btn-download" id="downloadBtn">
                <i class="fas fa-download"></i> Télécharger l'image
            </button>
            
            <button type="submit" form="posterForm" class="btn-action btn-save">
                <i class="fas fa-paper-plane"></i> Enregistrer & Partager
            </button>
            
            <button type="button" class="btn-action btn-share" id="shareBtn">
                <i class="fas fa-share-alt"></i> Partager sur réseaux
            </button>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p style="font-size: 1.1rem; margin-bottom: 15px;">
                Créez, personnalisez, partagez — vos souvenirs festifs en un clic ✨
            </p>
            <a href="/" class="back-link">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
        </footer>
    </div>
    
    <!-- Modal de prévisualisation -->
    <div class="modal" id="previewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="margin: 0; font-family: 'Dancing Script', cursive; font-size: 2.5rem;">
                    Votre affiche personnalisée
                </h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="previewContainer" style="text-align: center;">
                    <canvas id="previewCanvas" style="max-width: 100%; border-radius: 15px;"></canvas>
                </div>
                <div style="margin-top: 25px; display: flex; gap: 15px; justify-content: center;">
                    <button class="canvas-btn" id="printBtn">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                    <button class="canvas-btn" id="saveImageBtn">
                        <i class="fas fa-save"></i> Sauvegarder
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Votre affiche a été créée avec succès!</span>
    </div>
    
    <script>
        // ===== VARIABLES GLOBALES =====
        let canvas, ctx;
        let currentTool = 'draw';
        let currentColor = '#ff8fa3';
        let brushSize = 5;
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;
        let history = [];
        let historyIndex = -1;
        let addedElements = [];
        let posterId = null;
        
        // ===== INITIALISATION CANVAS =====
        function initCanvas() {
            canvas = document.getElementById('posterCanvas');
            ctx = canvas.getContext('2d');
            
            // Définir la taille du canvas
            canvas.width = 800;
            canvas.height = 600;
            
            // Fond blanc par défaut
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Sauvegarder l'état initial
            saveState();
            
            // Événements de dessin
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);
            
            // Support tactile
            canvas.addEventListener('touchstart', handleTouchStart);
            canvas.addEventListener('touchmove', handleTouchMove);
            canvas.addEventListener('touchend', stopDrawing);
        }
        
        // ===== FONCTIONS DE DESSIN =====
        function startDrawing(e) {
            isDrawing = true;
            const pos = getMousePos(canvas, e);
            [lastX, lastY] = [pos.x, pos.y];
        }
        
        function draw(e) {
            if (!isDrawing) return;
            
            e.preventDefault();
            const pos = getMousePos(canvas, e);
            
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(pos.x, pos.y);
            ctx.strokeStyle = currentTool === 'erase' ? '#ffffff' : currentColor;
            ctx.lineWidth = brushSize;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.stroke();
            
            [lastX, lastY] = [pos.x, pos.y];
        }
        
        function stopDrawing() {
            if (isDrawing) {
                isDrawing = false;
                saveState();
            }
        }
        
        function getMousePos(canvas, evt) {
            const rect = canvas.getBoundingClientRect();
            let clientX, clientY;
            
            if (evt.type.includes('touch')) {
                clientX = evt.touches[0].clientX;
                clientY = evt.touches[0].clientY;
            } else {
                clientX = evt.clientX;
                clientY = evt.clientY;
            }
            
            return {
                x: (clientX - rect.left) * (canvas.width / rect.width),
                y: (clientY - rect.top) * (canvas.height / rect.height)
            };
        }
        
        function handleTouchStart(e) {
            if (e.touches.length === 1) {
                e.preventDefault();
                startDrawing(e);
            }
        }
        
        function handleTouchMove(e) {
            if (e.touches.length === 1) {
                e.preventDefault();
                draw(e);
            }
        }
        
        // ===== GESTION DE L'HISTORIQUE =====
        function saveState() {
            // Supprimer les états futurs si on a annulé
            history = history.slice(0, historyIndex + 1);
            
            // Sauvegarder l'état actuel
            history.push(canvas.toDataURL());
            historyIndex++;
            
            // Limiter l'historique à 50 états
            if (history.length > 50) {
                history.shift();
                historyIndex--;
            }
        }
        
        function restoreState() {
            if (historyIndex >= 0) {
                const img = new Image();
                img.onload = function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                };
                img.src = history[historyIndex];
            }
        }
        
        function undo() {
            if (historyIndex > 0) {
                historyIndex--;
                restoreState();
            }
        }
        
        function redo() {
            if (historyIndex < history.length - 1) {
                historyIndex++;
                restoreState();
            }
        }
        
        // ===== OUTILS DE DESSIN =====
        document.querySelectorAll('[data-tool]').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('[data-tool]').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                currentTool = this.dataset.tool;
            });
        });
        
        // Taille du pinceau
        const brushSizeInput = document.getElementById('brushSize');
        const brushValue = document.getElementById('brushValue');
        
        brushSizeInput.addEventListener('input', function() {
            brushSize = parseInt(this.value);
            brushValue.textContent = brushSize + 'px';
        });
        
        // Couleurs
        document.querySelectorAll('.color-swatch').forEach(swatch => {
            swatch.addEventListener('click', function() {
                document.querySelectorAll('.color-swatch').forEach(s => {
                    s.classList.remove('selected');
                });
                this.classList.add('selected');
                
                if (this.dataset.color === 'gradient') {
                    currentColor = 'linear-gradient(45deg, #ff8fa3, #ffd700)';
                } else {
                    currentColor = this.dataset.color;
                }
                
                // Mettre à jour le sélecteur de couleur personnalisée
                if (this.dataset.color !== 'gradient' && this.dataset.color.length === 7) {
                    document.getElementById('customColor').value = this.dataset.color;
                }
            });
        });
        
        // Couleur personnalisée
        document.getElementById('customColor').addEventListener('input', function() {
            currentColor = this.value;
            
            // Mettre à jour la sélection
            document.querySelectorAll('.color-swatch').forEach(s => {
                s.classList.remove('selected');
            });
        });
        
        // ===== AJOUT DE TEXTE =====
        document.getElementById('addTextBtn').addEventListener('click', function() {
            const text = document.getElementById('textInput').value.trim();
            if (!text) return;
            
            const font = document.getElementById('fontSelect').value;
            const x = canvas.width / 2;
            const y = canvas.height / 2;
            
            ctx.font = `40px ${font}`;
            ctx.fillStyle = currentColor;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(text, x, y);
            
            addedElements.push({
                type: 'text',
                text: text,
                font: font,
                color: currentColor,
                x: x,
                y: y
            });
            
            saveState();
            document.getElementById('textInput').value = '';
        });
        
        document.getElementById('clearTextBtn').addEventListener('click', function() {
            // Retirer le dernier texte ajouté
            const lastText = addedElements.filter(el => el.type === 'text').pop();
            if (lastText) {
                const index = addedElements.indexOf(lastText);
                addedElements.splice(index, 1);
                undo();
            }
        });
        
        // ===== AJOUT D'ÉLÉMENTS =====
        document.querySelectorAll('[data-shape]').forEach(btn => {
            btn.addEventListener('click', function() {
                const shape = this.dataset.shape;
                addShape(shape);
            });
        });
        
        function addShape(shape) {
            const x = canvas.width / 2;
            const y = canvas.height / 2;
            const size = 50;
            
            ctx.fillStyle = currentColor;
            ctx.strokeStyle = currentColor;
            ctx.lineWidth = 3;
            
            switch(shape) {
                case 'heart':
                    drawHeart(x, y, size);
                    break;
                case 'star':
                    drawStar(x, y, 5, size, size/2);
                    break;
                case 'tree':
                    drawTree(x, y, size);
                    break;
                case 'snowflake':
                    drawSnowflake(x, y, size);
                    break;
                case 'gift':
                    drawGift(x, y, size);
                    break;
                case 'circle':
                    ctx.beginPath();
                    ctx.arc(x, y, size/2, 0, Math.PI * 2);
                    ctx.fill();
                    break;
            }
            
            addedElements.push({
                type: 'shape',
                shape: shape,
                color: currentColor,
                x: x,
                y: y
            });
            
            saveState();
        }
        
        // Fonctions de dessin de formes
        function drawHeart(x, y, size) {
            ctx.beginPath();
            const topCurveHeight = size * 0.3;
            ctx.moveTo(x, y + topCurveHeight);
            // Gauche
            ctx.bezierCurveTo(
                x, y, 
                x - size/2, y, 
                x - size/2, y + size/3
            );
            // Bas gauche
            ctx.bezierCurveTo(
                x - size/2, y + (size/2), 
                x, y + size, 
                x, y + size
            );
            // Bas droit
            ctx.bezierCurveTo(
                x, y + size, 
                x + size/2, y + (size/2), 
                x + size/2, y + size/3
            );
            // Droit
            ctx.bezierCurveTo(
                x + size/2, y, 
                x, y, 
                x, y + topCurveHeight
            );
            ctx.closePath();
            ctx.fill();
        }
        
        function drawStar(x, y, spikes, outerRadius, innerRadius) {
            let rot = Math.PI / 2 * 3;
            let step = Math.PI / spikes;
            
            ctx.beginPath();
            ctx.moveTo(x, y - outerRadius);
            
            for (let i = 0; i < spikes; i++) {
                ctx.lineTo(
                    x + Math.cos(rot) * outerRadius,
                    y + Math.sin(rot) * outerRadius
                );
                rot += step;
                
                ctx.lineTo(
                    x + Math.cos(rot) * innerRadius,
                    y + Math.sin(rot) * innerRadius
                );
                rot += step;
            }
            
            ctx.lineTo(x, y - outerRadius);
            ctx.closePath();
            ctx.fill();
        }
        
        function drawTree(x, y, size) {
            // Tronc
            ctx.fillStyle = '#8b4513';
            ctx.fillRect(x - size/6, y + size/2, size/3, size/2);
            
            // Feuillage
            ctx.fillStyle = '#2e8b57';
            ctx.beginPath();
            ctx.moveTo(x, y - size/2);
            ctx.lineTo(x - size/2, y + size/3);
            ctx.lineTo(x + size/2, y + size/3);
            ctx.closePath();
            ctx.fill();
            
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x - size/1.5, y + size);
            ctx.lineTo(x + size/1.5, y + size);
            ctx.closePath();
            ctx.fill();
        }
        
        function drawSnowflake(x, y, size) {
            ctx.strokeStyle = currentColor;
            ctx.lineWidth = 2;
            
            for (let i = 0; i < 6; i++) {
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(x, y - size/2);
                ctx.moveTo(x, y);
                ctx.lineTo(x + size/4, y - size/4);
                ctx.moveTo(x, y);
                ctx.lineTo(x + size/4, y + size/4);
                ctx.moveTo(x, y);
                ctx.lineTo(x - size/4, y - size/4);
                ctx.moveTo(x, y);
                ctx.lineTo(x - size/4, y + size/4);
                ctx.stroke();
                
                ctx.rotate(Math.PI / 3);
            }
        }
        
        function drawGift(x, y, size) {
            // Boîte
            ctx.fillStyle = '#ff6b6b';
            ctx.fillRect(x - size/2, y - size/2, size, size);
            
            // Ruban horizontal
            ctx.fillStyle = '#2e8b57';
            ctx.fillRect(x - size/2, y - size/10, size, size/5);
            
            // Ruban vertical
            ctx.fillRect(x - size/10, y - size/2, size/5, size);
            
            // Noeud
            ctx.beginPath();
            ctx.arc(x, y, size/5, 0, Math.PI * 2);
            ctx.fill();
        }
        
        // ===== STICKERS =====
        document.querySelectorAll('.sticker-item').forEach(sticker => {
            sticker.addEventListener('click', function() {
                const emoji = this.dataset.sticker;
                addSticker(emoji);
            });
        });
        
        function addSticker(emoji) {
            const x = Math.random() * (canvas.width - 100) + 50;
            const y = Math.random() * (canvas.height - 100) + 50;
            const size = 60;
            
            ctx.font = `${size}px Arial`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(emoji, x, y);
            
            addedElements.push({
                type: 'sticker',
                emoji: emoji,
                x: x,
                y: y,
                size: size
            });
            
            saveState();
        }
        
        // ===== UPLOAD DE PHOTOS =====
        document.getElementById('photoUpload').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });
        
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    // Redimensionner l'image pour qu'elle rentre dans le canvas
                    const maxWidth = 300;
                    const maxHeight = 300;
                    let width = img.width;
                    let height = img.height;
                    
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }
                    
                    const x = (canvas.width - width) / 2;
                    const y = (canvas.height - height) / 2;
                    
                    ctx.drawImage(img, x, y, width, height);
                    
                    addedElements.push({
                        type: 'photo',
                        src: event.target.result,
                        x: x,
                        y: y,
                        width: width,
                        height: height
                    });
                    
                    saveState();
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        });
        
        // ===== ARRIÈRE-PLANS =====
        document.querySelectorAll('[data-bg]').forEach(btn => {
            btn.addEventListener('click', function() {
                const bgType = this.dataset.bg;
                const bgValue = this.dataset.color;
                
                if (bgType === 'solid') {
                    ctx.fillStyle = bgValue;
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                } else if (bgType === 'gradient') {
                    const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
                    gradient.addColorStop(0, '#ffb6c1');
                    gradient.addColorStop(1, '#ffd1dc');
                    ctx.fillStyle = gradient;
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                } else if (bgType === 'pattern') {
                    if (bgValue === 'noel') {
                        ctx.fillStyle = '#2e8b57';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        
                        // Ajouter des sapins en fond
                        ctx.fillStyle = '#1e7a46';
                        for (let i = 0; i < 20; i++) {
                            const x = Math.random() * canvas.width;
                            const y = Math.random() * canvas.height;
                            ctx.font = '20px Arial';
                            ctx.fillText('🎄', x, y);
                        }
                    } else if (bgValue === 'snow') {
                        ctx.fillStyle = '#a5f3fc';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        
                        // Ajouter des flocons
                        ctx.fillStyle = 'white';
                        for (let i = 0; i < 50; i++) {
                            const x = Math.random() * canvas.width;
                            const y = Math.random() * canvas.height;
                            ctx.font = '15px Arial';
                            ctx.fillText('❄️', x, y);
                        }
                    }
                }
                
                saveState();
            });
        });
        
        // ===== CONTROLES DU CANVAS =====
        document.getElementById('clearCanvasBtn').addEventListener('click', function() {
            if (confirm('Voulez-vous vraiment effacer toute la création?')) {
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                addedElements = [];
                saveState();
            }
        });
        
        document.getElementById('undoBtn').addEventListener('click', undo);
        
        document.getElementById('saveCanvasBtn').addEventListener('click', function() {
            const dataURL = canvas.toDataURL('image/png');
            localStorage.setItem('lastPoster', dataURL);
            showNotification('Affiche sauvegardée localement', 'success');
        });
        
        // ===== TÉLÉCHARGEMENT =====
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const link = document.createElement('a');
            link.download = `affiche-noel-${Date.now()}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
        
        // ===== SAUVEGARDE ET ENVOI =====
        document.getElementById('posterForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validation
            const countryCode = document.getElementById('countryCode').value;
            const phone = document.getElementById('recipientPhone').value.replace(/\s/g, '');
            
            if (!phone) {
                showNotification('Veuillez entrer un numéro de téléphone', 'error');
                return;
            }
            
            // Préparer les données
            const posterData = {
                id: 'poster_' + Date.now(),
                title: document.getElementById('posterTitle').value,
                names: document.getElementById('posterNames').value,
                message: document.getElementById('posterMessage').value,
                year: document.getElementById('posterYear').value,
                style: document.getElementById('posterStyle').value,
                phone: countryCode + phone,
                multiplePhones: document.getElementById('multiplePhones').value,
                canvasData: canvas.toDataURL('image/png'),
                elements: addedElements,
                type: 'poster',
                createdAt: new Date().toISOString(),
                synced: false
            };
            
            try {
                // Sauvegarder localement
                saveToLocalStorage(posterData);
                
                // Envoyer au backend Laravel
                const response = await saveToBackend(posterData);
                
                if (response.success) {
                    posterId = response.data.id;
                    
                    // Envoyer par WhatsApp
                    const shareLink = response.data.share_link || `${window.location.origin}/poster/${posterId}`;
                    await sendWhatsApp(shareLink, countryCode + phone, posterData);
                    
                    // Envoyer à plusieurs numéros si spécifié
                    const multiplePhones = posterData.multiplePhones;
                    if (multiplePhones) {
                        const phones = multiplePhones.split(',').map(p => p.trim());
                        for (const phoneNum of phones) {
                            if (phoneNum) {
                                await sendWhatsApp(shareLink, countryCode + phoneNum, posterData);
                            }
                        }
                    }
                    
                    showNotification('Affiche créée et partagée avec succès!', 'success');
                    
                    // Redirection
                    setTimeout(() => {
                        window.location.href = shareLink;
                    }, 2000);
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Affiche sauvegardée localement. Synchronisation en cours...', 'success');
            }
        });
        
        // ===== PARTAGE =====
        document.getElementById('shareBtn').addEventListener('click', async function() {
            const dataURL = canvas.toDataURL('image/png');
            
            if (navigator.share) {
                try {
                    // Convertir dataURL en blob
                    const blob = await (await fetch(dataURL)).blob();
                    const file = new File([blob], 'affiche-noel.png', { type: 'image/png' });
                    
                    await navigator.share({
                        files: [file],
                        title: 'Mon affiche de Noël',
                        text: 'Regardez l\'affiche de Noël que j\'ai créée!'
                    });
                } catch (error) {
                    console.error('Erreur de partage:', error);
                    // Fallback: téléchargement
                    downloadImage(dataURL);
                }
            } else {
                downloadImage(dataURL);
            }
        });
        
        function downloadImage(dataURL) {
            const link = document.createElement('a');
            link.download = `affiche-noel-${Date.now()}.png`;
            link.href = dataURL;
            link.click();
            showNotification('Image téléchargée! Partagez-la manuellement.', 'success');
        }
        
        // ===== FONCTIONS UTILITAIRES =====
        function saveToLocalStorage(data) {
            let posters = JSON.parse(localStorage.getItem('christmasPosters')) || [];
            
            const existingIndex = posters.findIndex(p => p.id === data.id);
            
            if (existingIndex !== -1) {
                posters[existingIndex] = data;
            } else {
                posters.push(data);
            }
            
            localStorage.setItem('christmasPosters', JSON.stringify(posters));
            console.log('Affiche sauvegardée localement:', data.id);
        }
        
        async function saveToBackend(data) {
            try {
                const response = await fetch('/posters', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        title: data.title,
                        names: data.names,
                        message: data.message,
                        year: data.year,
                        style: data.style,
                        phone: data.phone,
                        multiple_phones: data.multiplePhones,
                        canvas_data: data.canvasData,
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
        
        function sendWhatsApp(link, phone, posterData) {
            const message = `🎨 Bonjour! Regardez l'affiche de Noël personnalisée créée pour vous! 🎄\n\n"${posterData.title}"\nAvec: ${posterData.names}\n\nCliquez sur ce lien pour la voir:\n${link}\n\nJoyeuses fêtes! ✨`;
            
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
        async function syncUnsentPosters() {
            const posters = JSON.parse(localStorage.getItem('christmasPosters')) || [];
            const unsentPosters = posters.filter(poster => !poster.synced);
            
            if (unsentPosters.length === 0) return;
            
            try {
                const response = await fetch('/api/posters/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ posters: unsentPosters })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    posters.forEach(poster => {
                        if (unsentPosters.some(unsent => unsent.id === poster.id)) {
                            poster.synced = true;
                        }
                    });
                    
                    localStorage.setItem('christmasPosters', JSON.stringify(posters));
                    
                    if (data.synced_count > 0) {
                        console.log(`${data.synced_count} affiches synchronisées`);
                    }
                }
            } catch (error) {
                console.error('Erreur de synchronisation:', error);
            }
        }
        
        // ===== INITIALISATION =====
        window.addEventListener('load', function() {
            initCanvas();
            
            // Synchronisation
            setTimeout(syncUnsentPosters, 3000);
            setInterval(syncUnsentPosters, 5 * 60 * 1000);
            window.addEventListener('online', syncUnsentPosters);
            
            // Charger la dernière affiche sauvegardée
            const lastPoster = localStorage.getItem('lastPoster');
            if (lastPoster) {
                const img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                    saveState();
                };
                img.src = lastPoster;
            }
        });
        
        // ===== MODAL =====
        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('previewModal').style.display = 'none';
        });
        
        document.getElementById('previewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</body>
</html>