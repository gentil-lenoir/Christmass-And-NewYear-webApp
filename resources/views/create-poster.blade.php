<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer votre Affiche Personnalisée - Féérie de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        /* ===== ADS ROW STYLES ===== */
        .ad-row{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 5px;
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
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* ===== BOUTON HOME OVERLAY ===== */
        .home-overlay {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 9999;
            animation: floatElement 3s ease-in-out infinite;
        }

        .home-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 25px;
            background: linear-gradient(135deg, var(--rose-principal), var(--rose-fonce));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 8px 20px rgba(255, 143, 163, 0.4);
            transition: all 0.3s ease;
            border: 3px solid white;
            cursor: pointer;
        }

        .home-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 30px rgba(255, 143, 163, 0.6);
            background: linear-gradient(135deg, var(--rose-fonce), var(--violet-doux));
        }

        .home-btn:active {
            transform: translateY(-2px) scale(1.02);
        }

        .home-btn i {
            font-size: 1.3rem;
            animation: glow 2s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .home-overlay {
                top: 10px;
                left: 10px;
            }

            .home-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .home-btn span {
                display: none;
            }

            .home-btn i {
                margin: 0;
            }
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
            position: relative;
        }
        
        .canvas-wrapper {
            position: relative;
            display: inline-block;
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
            display: block;
        }

        .canvas-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
        }

        .draggable-element {
            position: absolute;
            cursor: move;
            pointer-events: auto;
            user-select: none;
            border: 2px dashed transparent;
            transition: border-color 0.2s ease;
            display: inline-block;
            line-height: 1;
        }

        .draggable-element span {
            display: inline-block;
            line-height: 1;
            vertical-align: top;
        }

        .draggable-element:hover {
            border-color: var(--rose-principal);
        }

        .draggable-element.selected {
            border-color: var(--rose-fonce);
            box-shadow: 0 0 10px rgba(255, 143, 163, 0.5);
        }

        .draggable-element img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            pointer-events: none;
        }

        .resize-handle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: var(--rose-fonce);
            border: 2px solid white;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 20;
        }

        .draggable-element.selected .resize-handle {
            opacity: 1;
        }

        .resize-handle.se {
            bottom: -6px;
            right: -6px;
            cursor: se-resize;
        }

        .resize-handle.sw {
            bottom: -6px;
            left: -6px;
            cursor: sw-resize;
        }

        .resize-handle.ne {
            top: -6px;
            right: -6px;
            cursor: ne-resize;
        }

        .resize-handle.nw {
            top: -6px;
            left: -6px;
            cursor: nw-resize;
        }

        .delete-handle {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 24px;
            height: 24px;
            background: var(--rouge-vif);
            border: 2px solid white;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 20;
            font-size: 12px;
            font-weight: bold;
        }

        .draggable-element.selected .delete-handle {
            opacity: 1;
        }

        .delete-handle:hover {
            background: #ff4444;
            transform: scale(1.1);
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
    <!-- Bouton Home en Overlay -->
    <div class="home-overlay">
        <a href="/" class="home-btn">
            <i class="fas fa-home"></i>
            <span>Accueil</span>
        </a>
    </div>

    <div class="container">
        <!-- Header -->
        <header class="header-poster">
            <h1 class="poster-title">AFFICHE PERSONNALISÉE</h1>
            <p class="poster-subtitle">Créez votre chef-d'œuvre festif unique</p>
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
                        <div class="color-swatch" style="background: #ffffff;" data-color="#ffffff"></div>
                        <div class="color-swatch" style="background: #000000;" data-color="#000000"></div>
                        <div class="color-swatch" style="background: #4a4a4a;" data-color="#4a4a4a"></div>
                        <div class="color-swatch" style="background: linear-gradient(45deg, #ff8fa3, #ffd700);" data-color="gradient"></div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Couleur personnalisée</label>
                        <input type="color" id="customColor" value="#ff8fa3" style="width: 100%; height: 40px; border-radius: 10px; border: 2px solid var(--rose-clair); cursor: pointer;">
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

                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Taille du texte</label>
                        <input type="range" id="textSize" min="20" max="100" value="40" style="width: 100%;">
                        <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                            <span style="font-size: 0.9rem;">20px</span>
                            <span style="font-size: 0.9rem;" id="textSizeValue">40px</span>
                            <span style="font-size: 0.9rem;">100px</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Canvas principal -->
            <div class="canvas-container">
                <div class="canvas-wrapper">
                    <canvas id="posterCanvas"></canvas>
                    <div class="canvas-overlay" id="canvasOverlay"></div>
                </div>

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
                            Glissez-déposez ou cliquez
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
                            <span class="element-name">Dégradé</span>
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
        
        <!-- Formulaire de texte -->
        <div class="text-inputs">
            <h2 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem; color: var(--rose-fonce); text-align: center; margin-bottom: 30px;">
                <i class="fas fa-edit"></i> Informations de l'affiche
            </h2>
            
            <form id="posterForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Titre de l'affiche</label>
                        <input type="text" class="form-input" id="posterTitle" placeholder="Ex: Joyeux Noël 2025!" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-users"></i> Noms à afficher</label>
                        <input type="text" class="form-input" id="posterNames" placeholder="Ex: Papa, Maman, Julie">
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
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
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
  
        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button type="button" class="btn-action btn-download" id="downloadBtn">
                <i class="fas fa-download"></i> Télécharger
            </button>
            
            <button type="submit" form="posterForm" class="btn-action btn-save">
                <i class="fas fa-paper-plane"></i> Enregistrer
            </button>
            
            <button type="button" class="btn-action btn-share" id="shareBtn">
                <i class="fas fa-share-alt"></i> Partager
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
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Opération réussie!</span>
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
        let canvas, ctx, canvasOverlay;
        let currentTool = 'draw';
        let currentColor = '#ff8fa3';
        let brushSize = 5;
        let textSize = 40;
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;
        let history = [];
        let historyIndex = -1;
        let addedElements = [];

        // Drag and drop variables
        let selectedElement = null;
        let isDragging = false;
        let isResizing = false;
        let dragStartX = 0;
        let dragStartY = 0;
        let resizeHandle = null;
        let elementStartWidth = 0;
        let elementStartHeight = 0;
        let elementStartX = 0;
        let elementStartY = 0;
        
        // ===== INITIALISATION CANVAS =====
        function initCanvas() {
            canvas = document.getElementById('posterCanvas');
            canvasOverlay = document.getElementById('canvasOverlay');
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

            // Événements de drag and drop
            document.addEventListener('mousedown', handleMouseDown);
            document.addEventListener('mousemove', handleMouseMove);
            document.addEventListener('mouseup', handleMouseUp);
        }

        // ===== DRAG, DROP & RESIZE =====
        function handleMouseDown(e) {
            const element = e.target.closest('.draggable-element');
            
            if (element) {
                e.preventDefault();
                selectElement(element);
                
                // Check si on clique sur un handle de resize
                if (e.target.classList.contains('resize-handle')) {
                    isResizing = true;
                    resizeHandle = e.target.classList[1]; // nw, ne, sw, se
                    
                    elementStartWidth = element.offsetWidth;
                    elementStartHeight = element.offsetHeight;
                    elementStartX = element.offsetLeft;
                    elementStartY = element.offsetTop;
                    dragStartX = e.clientX;
                    dragStartY = e.clientY;
                } 
                // Check si on clique sur le bouton de suppression
                else if (e.target.classList.contains('delete-handle') || e.target.closest('.delete-handle')) {
                    deleteElement(element);
                    return;
                }
                // Sinon c'est un drag normal
                else {
                    isDragging = true;
                    dragStartX = e.clientX;
                    dragStartY = e.clientY;
                    elementStartX = element.offsetLeft;
                    elementStartY = element.offsetTop;
                }
            } else {
                deselectElement();
            }
        }

        function handleMouseMove(e) {
            if (!selectedElement) return;

            if (isResizing) {
                e.preventDefault();
                
                const deltaX = e.clientX - dragStartX;
                const deltaY = e.clientY - dragStartY;
                
                let newWidth = elementStartWidth;
                let newHeight = elementStartHeight;
                let newLeft = elementStartX;
                let newTop = elementStartY;

                // Calculer nouvelles dimensions selon le handle
                if (resizeHandle.includes('e')) {
                    newWidth = elementStartWidth + deltaX;
                }
                if (resizeHandle.includes('w')) {
                    newWidth = elementStartWidth - deltaX;
                    newLeft = elementStartX + deltaX;
                }
                if (resizeHandle.includes('s')) {
                    newHeight = elementStartHeight + deltaY;
                }
                if (resizeHandle.includes('n')) {
                    newHeight = elementStartHeight - deltaY;
                    newTop = elementStartY + deltaY;
                }

                // Taille minimale
                newWidth = Math.max(30, newWidth);
                newHeight = Math.max(30, newHeight);

                // Appliquer les changements
                selectedElement.style.width = newWidth + 'px';
                selectedElement.style.height = newHeight + 'px';
                selectedElement.style.left = newLeft + 'px';
                selectedElement.style.top = newTop + 'px';

                // Ajuster la taille du texte/emoji proportionnellement
                const content = selectedElement.querySelector('span');
                if (content && content.dataset.originalSize) {
                    const scaleFactor = Math.min(newWidth / elementStartWidth, newHeight / elementStartHeight);
                    const originalSize = parseFloat(content.dataset.originalSize);
                    content.style.fontSize = (originalSize * scaleFactor) + 'px';
                }

            } else if (isDragging) {
                e.preventDefault();
                
                const deltaX = e.clientX - dragStartX;
                const deltaY = e.clientY - dragStartY;
                
                let newX = elementStartX + deltaX;
                let newY = elementStartY + deltaY;

                // Contraindre aux limites du canvas
                const maxX = canvasOverlay.offsetWidth - selectedElement.offsetWidth;
                const maxY = canvasOverlay.offsetHeight - selectedElement.offsetHeight;
                
                newX = Math.max(0, Math.min(newX, maxX));
                newY = Math.max(0, Math.min(newY, maxY));

                selectedElement.style.left = newX + 'px';
                selectedElement.style.top = newY + 'px';
            }
        }

        function handleMouseUp(e) {
            if (isDragging || isResizing) {
                // Mettre à jour les données de l'élément
                if (selectedElement) {
                    const elementId = selectedElement.dataset.id;
                    const elementData = addedElements.find(el => el.id === elementId);
                    
                    if (elementData) {
                        elementData.x = selectedElement.offsetLeft;
                        elementData.y = selectedElement.offsetTop;
                        elementData.width = selectedElement.offsetWidth;
                        elementData.height = selectedElement.offsetHeight;
                        
                        // Mettre à jour la taille de police si c'est du texte/emoji
                        const span = selectedElement.querySelector('span');
                        if (span && span.style.fontSize) {
                            elementData.fontSize = parseFloat(span.style.fontSize);
                        }
                    }
                }
                saveState();
            }
            isDragging = false;
            isResizing = false;
            resizeHandle = null;
        }

        function selectElement(element) {
            if (selectedElement) {
                selectedElement.classList.remove('selected');
            }
            selectedElement = element;
            element.classList.add('selected');
        }

        function deselectElement() {
            if (selectedElement) {
                selectedElement.classList.remove('selected');
                selectedElement = null;
            }
        }

        function deleteElement(element) {
            if (confirm('Supprimer cet élément ?')) {
                const elementId = element.dataset.id;
                addedElements = addedElements.filter(el => el.id !== elementId);
                element.remove();
                selectedElement = null;
                saveState();
                showNotification('Élément supprimé', 'success');
            }
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
            history = history.slice(0, historyIndex + 1);
            history.push({
                canvas: canvas.toDataURL(),
                elements: JSON.parse(JSON.stringify(addedElements))
            });
            historyIndex++;
            
            if (history.length > 50) {
                history.shift();
                historyIndex--;
            }
        }
        
        function restoreState() {
            if (historyIndex >= 0 && history[historyIndex]) {
                const state = history[historyIndex];
                
                // Restaurer le canvas
                const img = new Image();
                img.onload = function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                };
                img.src = state.canvas;
                
                // Restaurer les éléments overlay
                canvasOverlay.innerHTML = '';
                addedElements = JSON.parse(JSON.stringify(state.elements));
                
                addedElements.forEach(elementData => {
                    recreateElement(elementData);
                });
            }
        }

        function recreateElement(data) {
            const element = document.createElement('div');
            element.className = 'draggable-element';
            element.dataset.id = data.id;
            element.style.left = data.x + 'px';
            element.style.top = data.y + 'px';

            // Contenu selon le type
            if (data.type === 'text') {
                element.style.width = 'auto';
                element.style.height = 'auto';
                element.style.padding = '5px';
                
                const span = document.createElement('span');
                span.textContent = data.text;
                span.style.fontSize = data.fontSize + 'px';
                span.style.fontFamily = data.font;
                span.style.color = data.color;
                span.style.whiteSpace = 'nowrap';
                span.dataset.originalSize = data.fontSize;
                element.appendChild(span);
            } else if (data.type === 'sticker' || data.type === 'shape') {
                element.style.width = 'auto';
                element.style.height = 'auto';
                
                const span = document.createElement('span');
                span.textContent = data.content;
                span.style.fontSize = data.fontSize + 'px';
                span.dataset.originalSize = data.fontSize;
                element.appendChild(span);
            } else if (data.type === 'photo') {
                element.style.width = data.width + 'px';
                element.style.height = data.height + 'px';
                
                const img = document.createElement('img');
                img.src = data.src;
                element.appendChild(img);
            }

            // Ajouter les handles
            addHandles(element);
            canvasOverlay.appendChild(element);
        }

        function addHandles(element) {
            // Handles de resize
            ['nw', 'ne', 'sw', 'se'].forEach(pos => {
                const handle = document.createElement('div');
                handle.className = `resize-handle ${pos}`;
                element.appendChild(handle);
            });

            // Handle de suppression
            const deleteHandle = document.createElement('div');
            deleteHandle.className = 'delete-handle';
            deleteHandle.innerHTML = '×';
            element.appendChild(deleteHandle);
        }
        
        function undo() {
            if (historyIndex > 0) {
                historyIndex--;
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

        // Taille du texte
        const textSizeInput = document.getElementById('textSize');
        const textSizeValue = document.getElementById('textSizeValue');
        
        textSizeInput.addEventListener('input', function() {
            textSize = parseInt(this.value);
            textSizeValue.textContent = textSize + 'px';
        });
        
        // Couleurs
        document.querySelectorAll('.color-swatch').forEach(swatch => {
            swatch.addEventListener('click', function() {
                document.querySelectorAll('.color-swatch').forEach(s => {
                    s.classList.remove('selected');
                });
                this.classList.add('selected');
                currentColor = this.dataset.color;
                
                if (currentColor !== 'gradient') {
                    document.getElementById('customColor').value = currentColor;
                }
            });
        });
        
        document.getElementById('customColor').addEventListener('input', function() {
            currentColor = this.value;
            document.querySelectorAll('.color-swatch').forEach(s => {
                s.classList.remove('selected');
            });
        });
        
        // ===== AJOUT DE TEXTE =====
        document.getElementById('addTextBtn').addEventListener('click', function() {
            const text = document.getElementById('textInput').value.trim();
            if (!text) {
                showNotification('Veuillez entrer du texte', 'error');
                return;
            }
            
            const elementId = 'text_' + Date.now();
            const font = document.getElementById('fontSelect').value;
            const x = Math.random() * (canvasOverlay.offsetWidth - 200) + 100;
            const y = Math.random() * (canvasOverlay.offsetHeight - 100) + 50;

            // Créer l'élément draggable
            const element = document.createElement('div');
            element.className = 'draggable-element';
            element.dataset.id = elementId;
            element.style.left = x + 'px';
            element.style.top = y + 'px';
            element.style.width = 'auto';
            element.style.height = 'auto';
            element.style.padding = '10px';

            const span = document.createElement('span');
            span.textContent = text;
            span.style.fontSize = textSize + 'px';
            span.style.fontFamily = font;
            span.style.color = currentColor;
            span.style.whiteSpace = 'nowrap';
            span.dataset.originalSize = textSize;
            
            element.appendChild(span);
            addHandles(element);
            canvasOverlay.appendChild(element);

            addedElements.push({
                id: elementId,
                type: 'text',
                text: text,
                font: font,
                color: currentColor,
                fontSize: textSize,
                x: x,
                y: y,
                width: element.offsetWidth,
                height: element.offsetHeight
            });
            
            saveState();
            document.getElementById('textInput').value = '';
            showNotification('Texte ajouté! Cliquez dessus pour le déplacer/redimensionner', 'success');
        });
        
        // ===== AJOUT D'ÉLÉMENTS =====
        document.querySelectorAll('[data-shape]').forEach(btn => {
            btn.addEventListener('click', function() {
                const shape = this.dataset.shape;
                addShape(shape);
            });
        });
        
        function addShape(shape) {
            const elementId = 'shape_' + Date.now();
            const x = Math.random() * (canvasOverlay.offsetWidth - 100) + 50;
            const y = Math.random() * (canvasOverlay.offsetHeight - 100) + 50;
            const size = 80;

            const element = document.createElement('div');
            element.className = 'draggable-element';
            element.dataset.id = elementId;
            element.style.left = x + 'px';
            element.style.top = y + 'px';
            element.style.width = 'auto';
            element.style.height = 'auto';

            const span = document.createElement('span');
            span.style.fontSize = size + 'px';
            span.dataset.originalSize = size;
            
            const shapeIcons = {
                'heart': '❤️',
                'star': '⭐',
                'tree': '🎄',
                'snowflake': '❄️',
                'gift': '🎁',
                'circle': '⭕'
            };
            
            span.textContent = shapeIcons[shape] || '⭐';
            element.appendChild(span);
            addHandles(element);
            canvasOverlay.appendChild(element);

            addedElements.push({
                id: elementId,
                type: 'shape',
                shape: shape,
                content: shapeIcons[shape],
                fontSize: size,
                x: x,
                y: y,
                width: element.offsetWidth,
                height: element.offsetHeight
            });

            saveState();
            showNotification('Forme ajoutée!', 'success');
        }

        // ===== STICKERS =====
        document.querySelectorAll('.sticker-item').forEach(sticker => {
            sticker.addEventListener('click', function() {
                const emoji = this.dataset.sticker;
                addSticker(emoji);
            });
        });
        
        function addSticker(emoji) {
            const elementId = 'sticker_' + Date.now();
            const x = Math.random() * (canvasOverlay.offsetWidth - 100) + 50;
            const y = Math.random() * (canvasOverlay.offsetHeight - 100) + 50;
            const size = 60;
            
            const element = document.createElement('div');
            element.className = 'draggable-element';
            element.dataset.id = elementId;
            element.style.left = x + 'px';
            element.style.top = y + 'px';
            element.style.width = 'auto';
            element.style.height = 'auto';

            const span = document.createElement('span');
            span.textContent = emoji;
            span.style.fontSize = size + 'px';
            span.dataset.originalSize = size;
            
            element.appendChild(span);
            addHandles(element);
            canvasOverlay.appendChild(element);

            addedElements.push({
                id: elementId,
                type: 'sticker',
                content: emoji,
                fontSize: size,
                x: x,
                y: y,
                width: element.offsetWidth,
                height: element.offsetHeight
            });
            
            saveState();
            showNotification('Sticker ajouté!', 'success');
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
                const elementId = 'photo_' + Date.now();
                const x = (canvasOverlay.offsetWidth - 200) / 2;
                const y = (canvasOverlay.offsetHeight - 200) / 2;
                
                const element = document.createElement('div');
                element.className = 'draggable-element';
                element.dataset.id = elementId;
                element.style.left = x + 'px';
                element.style.top = y + 'px';
                element.style.width = '200px';
                element.style.height = '200px';

                const img = document.createElement('img');
                img.src = event.target.result;
                element.appendChild(img);
                
                addHandles(element);
                canvasOverlay.appendChild(element);

                addedElements.push({
                    id: elementId,
                    type: 'photo',
                    src: event.target.result,
                    x: x,
                    y: y,
                    width: 200,
                    height: 200
                });
                
                saveState();
                showNotification('Photo ajoutée! Redimensionnez-la avec les poignées', 'success');
            };
            reader.readAsDataURL(file);
            
            // Réinitialiser l'input
            this.value = '';
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
                        
                        ctx.font = '30px Arial';
                        for (let i = 0; i < 30; i++) {
                            const x = Math.random() * canvas.width;
                            const y = Math.random() * canvas.height;
                            ctx.fillText('🎄', x, y);
                        }
                    } else if (bgValue === 'snow') {
                        ctx.fillStyle = '#a5f3fc';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        
                        ctx.font = '20px Arial';
                        for (let i = 0; i < 60; i++) {
                            const x = Math.random() * canvas.width;
                            const y = Math.random() * canvas.height;
                            ctx.fillText('❄️', x, y);
                        }
                    }
                }
                
                saveState();
                showNotification('Arrière-plan changé!', 'success');
            });
        });
        
        // ===== CONTROLES DU CANVAS =====
        document.getElementById('clearCanvasBtn').addEventListener('click', function() {
            if (confirm('Voulez-vous vraiment tout effacer?')) {
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                canvasOverlay.innerHTML = '';
                addedElements = [];
                selectedElement = null;
                saveState();
                showNotification('Canvas effacé!', 'success');
            }
        });
        
        document.getElementById('undoBtn').addEventListener('click', function() {
            undo();
            showNotification('Action annulée', 'success');
        });
        
        document.getElementById('saveCanvasBtn').addEventListener('click', async function() {
            try {
                // S'assurer que toutes les images sont chargées
                const imagePromises = [];
                addedElements.forEach(elementData => {
                    if (elementData.type === 'photo') {
                        const promise = new Promise((resolve) => {
                            const img = new Image();
                            img.onload = () => resolve();
                            img.onerror = () => resolve();
                            img.src = elementData.src;
                        });
                        imagePromises.push(promise);
                    }
                });
                
                await Promise.all(imagePromises);
                await new Promise(resolve => setTimeout(resolve, 100));
                
                const finalCanvas = combineCanvasAndOverlay();
                const dataURL = finalCanvas.toDataURL('image/png');
                localStorage.setItem('lastPoster', dataURL);
                showNotification('Affiche sauvegardée localement!', 'success');
            } catch (error) {
                console.error('Erreur de sauvegarde:', error);
                showNotification('Erreur lors de la sauvegarde', 'error');
            }
        });

        // ===== COMBINER CANVAS ET OVERLAY =====
        function combineCanvasAndOverlay() {
            const finalCanvas = document.createElement('canvas');
            finalCanvas.width = canvas.width;
            finalCanvas.height = canvas.height;
            const finalCtx = finalCanvas.getContext('2d');
            
            // Copier le canvas de dessin
            finalCtx.drawImage(canvas, 0, 0);
            
            // Calculer le ratio entre le canvas réel et son affichage
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;
            
            // Mettre à jour les données de tous les éléments avant de les dessiner
            document.querySelectorAll('.draggable-element').forEach(el => {
                const elementId = el.dataset.id;
                const elementData = addedElements.find(item => item.id === elementId);
                
                if (elementData) {
                    elementData.x = el.offsetLeft;
                    elementData.y = el.offsetTop;
                    elementData.width = el.offsetWidth;
                    elementData.height = el.offsetHeight;
                    
                    const span = el.querySelector('span');
                    if (span && span.style.fontSize) {
                        elementData.fontSize = parseFloat(span.style.fontSize);
                    }
                }
            });
            
            // Dessiner tous les éléments
            addedElements.forEach(elementData => {
                const x = elementData.x * scaleX;
                const y = elementData.y * scaleY;
                const width = elementData.width * scaleX;
                const height = elementData.height * scaleY;
                
                if (elementData.type === 'text') {
                    finalCtx.font = `${elementData.fontSize * scaleX}px ${elementData.font}`;
                    finalCtx.fillStyle = elementData.color;
                    finalCtx.textBaseline = 'top';
                    finalCtx.fillText(elementData.text, x, y);
                } else if (elementData.type === 'sticker' || elementData.type === 'shape') {
                    finalCtx.font = `${elementData.fontSize * scaleX}px Arial`;
                    finalCtx.textBaseline = 'top';
                    finalCtx.fillText(elementData.content, x, y);
                } else if (elementData.type === 'photo') {
                    // Créer une image temporaire pour le dessin
                    const img = new Image();
                    img.src = elementData.src;
                    try {
                        finalCtx.drawImage(img, x, y, width, height);
                    } catch (error) {
                        console.warn('Erreur lors du dessin de l\'image:', error);
                    }
                }
            });
            
            return finalCanvas;
        }
        
        // ===== TÉLÉCHARGEMENT =====
        document.getElementById('downloadBtn').addEventListener('click', async function() {
            try {
                // S'assurer que toutes les images sont chargées
                const imagePromises = [];
                addedElements.forEach(elementData => {
                    if (elementData.type === 'photo') {
                        const promise = new Promise((resolve) => {
                            const img = new Image();
                            img.onload = () => resolve();
                            img.onerror = () => resolve();
                            img.src = elementData.src;
                        });
                        imagePromises.push(promise);
                    }
                });
                
                await Promise.all(imagePromises);
                
                // Attendre un peu pour s'assurer que tout est à jour
                await new Promise(resolve => setTimeout(resolve, 100));
                
                const finalCanvas = combineCanvasAndOverlay();
                const link = document.createElement('a');
                link.download = `affiche-noel-${Date.now()}.png`;
                link.href = finalCanvas.toDataURL('image/png');
                link.click();
                showNotification('Image téléchargée avec succès!', 'success');
            } catch (error) {
                console.error('Erreur de téléchargement:', error);
                showNotification('Erreur lors du téléchargement', 'error');
            }
        });
        
        // ===== SAUVEGARDE ET ENVOI =====
        document.getElementById('posterForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const title = document.getElementById('posterTitle').value;
            const names = document.getElementById('posterNames').value;
            const message = document.getElementById('posterMessage').value;
            const year = document.getElementById('posterYear').value;
            const style = document.getElementById('posterStyle').value;
            
            if (!title) {
                showNotification('Veuillez entrer un titre', 'error');
                return;
            }
            
            try {
                const finalCanvas = combineCanvasAndOverlay();
                const posterData = {
                    id: 'poster_' + Date.now(),
                    title: title,
                    names: names,
                    message: message,
                    year: year,
                    style: style,
                    canvasData: finalCanvas.toDataURL('image/png'),
                    elements: addedElements,
                    createdAt: new Date().toISOString()
                };
                
                // Sauvegarder localement
                let posters = JSON.parse(localStorage.getItem('christmasPosters') || '[]');
                posters.push(posterData);
                localStorage.setItem('christmasPosters', JSON.stringify(posters));
                
                showNotification('Affiche enregistrée avec succès!', 'success');
                
                // WhatsApp si numéro fourni
                const phone = document.getElementById('recipientPhone').value.trim();
                if (phone) {
                    const countryCode = document.getElementById('countryCode').value;
                    sendWhatsApp(countryCode + phone, posterData);
                }
                
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur lors de l\'enregistrement', 'error');
            }
        });
        
        // ===== PARTAGE =====
        document.getElementById('shareBtn').addEventListener('click', async function() {
            try {
                // S'assurer que toutes les images sont chargées
                const imagePromises = [];
                addedElements.forEach(elementData => {
                    if (elementData.type === 'photo') {
                        const promise = new Promise((resolve) => {
                            const img = new Image();
                            img.onload = () => resolve();
                            img.onerror = () => resolve();
                            img.src = elementData.src;
                        });
                        imagePromises.push(promise);
                    }
                });
                
                await Promise.all(imagePromises);
                await new Promise(resolve => setTimeout(resolve, 100));
                
                const finalCanvas = combineCanvasAndOverlay();
                const dataURL = finalCanvas.toDataURL('image/png');
                
                if (navigator.share) {
                    const blob = await (await fetch(dataURL)).blob();
                    const file = new File([blob], 'affiche-noel.png', { type: 'image/png' });
                    
                    await navigator.share({
                        files: [file],
                        title: 'Mon affiche de Noël',
                        text: 'Regardez mon affiche de Noël personnalisée!'
                    });
                    showNotification('Partagé avec succès!', 'success');
                } else {
                    const link = document.createElement('a');
                    link.download = `affiche-noel-${Date.now()}.png`;
                    link.href = dataURL;
                    link.click();
                    showNotification('Image téléchargée pour partage manuel', 'success');
                }
            } catch (error) {
                console.error('Erreur de partage:', error);
                showNotification('Partage annulé ou impossible', 'error');
            }
        });
        
        function sendWhatsApp(phone, posterData) {
            const message = `🎨 Bonjour! Découvrez mon affiche de Noël personnalisée! 🎄\n\n"${posterData.title}"\n${posterData.names ? 'Avec: ' + posterData.names : ''}\n\nJoyeuses fêtes! ✨`;
            
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${phone}?text=${encodedMessage}`;
            
            window.open(whatsappUrl, '_blank');
            showNotification('WhatsApp ouvert!', 'success');
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
            }, 4000);
        }
        
        // ===== INITIALISATION =====
        window.addEventListener('load', function() {
            initCanvas();
            
            // Charger la dernière affiche sauvegardée
            const lastPoster = localStorage.getItem('lastPoster');
            if (lastPoster) {
                const img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                img.src = lastPoster;
            }
            
            console.log('✨ Créateur d\'affiche initialisé!');
            showNotification('Bienvenue! Créez votre affiche personnalisée 🎨', 'success');
        });

        // Empêcher la sélection de texte lors du drag
        document.addEventListener('selectstart', function(e) {
            if (isDragging || isResizing) {
                e.preventDefault();
            }
        });

        // Touche Suppr pour supprimer l'élément sélectionné
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Delete' && selectedElement) {
                deleteElement(selectedElement);
            } else if (e.key === 'Escape' && selectedElement) {
                deselectElement();
            }
        });
    </script>
</body>
</html>