<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Créer votre Lettre de Noël - Féérie de Noël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        
        /* ===== ANIMATIONS DE COULEURS ===== */
        @keyframes colorPulse {
            0% { color: var(--rose-fonce); }
            33% { color: var(--vert-noel); }
            66% { color: var(--or); }
            100% { color: var(--rose-fonce); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        /* ===== HEADER ANIMÉ ===== */
        .header-letter {
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            background: linear-gradient(45deg, var(--rose-principal), var(--violet-doux), var(--bleu-clair));
            background-size: 300% 300%;
            animation: gradientShift 8s ease infinite;
            box-shadow: 0 15px 35px rgba(255, 182, 193, 0.3);
        }
        
        .header-letter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://cdn.jsdelivr.net/npm/emoji-datasource-apple/img/apple/64/2728.png') repeat;
            background-size: 50px;
            opacity: 0.1;
            animation: sparkle 2s infinite;
        }
        
        .letter-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.8rem;
            font-weight: 700;
            color: white;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
            animation: colorPulse 6s infinite;
            position: relative;
        }
        
        .letter-subtitle {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            color: white;
            opacity: 0.9;
            font-weight: 500;
        }
        
        /* ===== FORMULAIRE DE LETTRE ===== */
        .letter-form {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 25px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--rose-principal);
        }
        
        .form-section {
            margin-bottom: 35px;
            padding-bottom: 35px;
            border-bottom: 2px dashed var(--rose-clair);
        }
        
        .form-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: var(--rose-fonce);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .section-title i {
            font-size: 1.8rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
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
        }
        
        .form-input, .form-textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--rose-clair);
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--rose-fonce);
            box-shadow: 0 0 0 3px rgba(255, 143, 163, 0.2);
        }
        
        /* ===== ÉDITEUR DE TEXTE ===== */
        .editor-toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
            padding: 15px;
            background: var(--rose-clair);
            border-radius: 15px;
        }
        
        .editor-btn {
            padding: 10px 15px;
            background: white;
            border: 2px solid var(--rose-principal);
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            color: var(--noir-doux);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .editor-btn:hover {
            background: var(--rose-principal);
            color: white;
            transform: translateY(-2px);
        }
        
        .editor-btn.active {
            background: var(--rose-fonce);
            color: white;
            border-color: var(--rose-fonce);
        }
        
        .letter-content {
            min-height: 300px;
            padding: 25px;
            border: 2px solid var(--rose-clair);
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            line-height: 1.8;
            background: white;
            overflow-y: auto;
        }
        
        .letter-content:focus {
            outline: none;
            border-color: var(--rose-fonce);
        }
        
        /* ===== BACKGROUND SELECTOR ===== */
        .background-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .bg-option {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            height: 120px;
        }
        
        .bg-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .bg-option.selected {
            border-color: var(--rose-fonce);
            box-shadow: 0 0 0 3px rgba(255, 143, 163, 0.3);
        }
        
        .bg-preview {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        
        .bg-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            text-align: center;
            font-weight: 600;
            color: var(--noir-doux);
        }
        
        /* Backgrounds prédéfinis */
        .bg-rose { background: linear-gradient(135deg, #ffb6c1, #ffd1dc); }
        .bg-vintage { background: linear-gradient(135deg, #f8c8dc, #e0bbe4); }
        .bg-noel { background: linear-gradient(135deg, #2e8b57, #90ee90); background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><text x="10" y="20" font-family="Arial" font-size="15" fill="%232e8b57">🎄</text><text x="80" y="50" font-family="Arial" font-size="15" fill="%232e8b57">⭐</text><text x="30" y="80" font-family="Arial" font-size="15" fill="%232e8b57">❄️</text></svg>'); }
        .bg-neige { background: linear-gradient(135deg, #a5f3fc, #e0f7ff); background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white"/><circle cx="60" cy="40" r="2" fill="white"/><circle cx="40" cy="70" r="2" fill="white"/><circle cx="80" cy="20" r="2" fill="white"/></svg>'); }
        .bg-or { background: linear-gradient(135deg, #ffd700, #ffec8b); }
        .bg-etoile { background: linear-gradient(135deg, #1e3a8a, #3b82f6); background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><text x="20" y="30" font-family="Arial" font-size="20" fill="white">⭐</text><text x="70" y="60" font-family="Arial" font-size="15" fill="white">✨</text></svg>'); }
        
        /* ===== SECTION TÉLÉPHONE ===== */
        .phone-section {
            background: linear-gradient(135deg, var(--rose-clair), #fff0f5);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            border: 2px dashed var(--rose-fonce);
        }
        
        .whatsapp-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: var(--noir-doux);
        }
        
        .whatsapp-info i {
            color: #25D366;
            font-size: 2rem;
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
            padding: 16px 35px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .btn-save {
            background: linear-gradient(45deg, var(--rose-fonce), var(--rose-principal));
            color: white;
        }
        
        .btn-preview {
            background: white;
            color: var(--rose-fonce);
            border: 2px solid var(--rose-fonce);
        }
        
        .btn-share {
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: white;
        }
        
        .btn-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* ===== MODAL DE PRÉVISUALISATION ===== */
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
            background: var(--rose-clair);
            border-radius: 25px 25px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: var(--rose-fonce);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--rose-fonce);
            cursor: pointer;
            line-height: 1;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 30px 20px;
            color: #7a6a6a;
            margin-top: 50px;
            border-top: 2px solid var(--rose-clair);
        }
        
        .back-link {
            color: var(--rose-fonce);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
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
            .letter-title { font-size: 2.8rem; }
            .letter-form { padding: 25px; }
            .section-title { font-size: 1.8rem; }
            .form-row { grid-template-columns: 1fr; }
            .action-buttons { flex-direction: column; }
            .btn-action { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="container">

        @include('components.floating-home')

        <!-- Header animé -->
        <header class="header-letter">
            <h1 class="letter-title">Ma Lettre de Noël Magique</h1>
            <p class="letter-subtitle">Écrivez votre plus beau message festif</p>
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
        
        <!-- Formulaire de lettre -->
        <form id="letterForm" class="letter-form">
            <!-- Section Expéditeur/Destinataire -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-user-circle"></i> De la part de... à...</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Expéditeur (Votre nom)</label>
                        <input type="text" class="form-input" id="fromName" placeholder="Ex: Marie" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Destinataire (À qui écrivez-vous?)</label>
                        <input type="text" class="form-input" id="toName" placeholder="Ex: Papa et Maman" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Titre de votre lettre</label>
                    <input type="text" class="form-input" id="letterTitle" placeholder="Ex: Mes vœux les plus chaleureux pour Noël" required>
                </div>
            </div>
            
            <!-- Section Éditeur de texte -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-pen-nib"></i> Rédigez votre lettre</h2>
                
                <div class="editor-toolbar">
                    <button type="button" class="editor-btn" data-command="bold" title="Gras">
                        <i class="fas fa-bold"></i>
                    </button>
                    <button type="button" class="editor-btn" data-command="italic" title="Italique">
                        <i class="fas fa-italic"></i>
                    </button>
                    <button type="button" class="editor-btn" data-command="underline" title="Souligné">
                        <i class="fas fa-underline"></i>
                    </button>
                    <select class="editor-btn" id="fontSize" style="appearance: none; padding-right: 35px;">
                        <option value="1rem">Normal</option>
                        <option value="1.2rem">Grand</option>
                        <option value="1.4rem">Très grand</option>
                        <option value="0.9rem">Petit</option>
                    </select>
                    <select class="editor-btn" id="fontFamily" style="appearance: none; padding-right: 35px;">
                        <option value="'Poppins', sans-serif">Poppins</option>
                        <option value="'Dancing Script', cursive">Dancing Script</option>
                        <option value="'Playfair Display', serif">Playfair Display</option>
                        <option value="'Arial', sans-serif">Arial</option>
                    </select>
                    <input type="color" class="editor-btn" id="textColor" title="Couleur du texte" style="padding: 5px; height: 40px;">
                </div>
                
                <div 
                    class="letter-content" 
                    id="letterContent" 
                    contenteditable="true"
                    data-placeholder="Commencez à écrire votre belle lettre de Noël ici... Vous pouvez parler de vos souvenirs, vos souhaits, votre gratitude. Laissez parler votre cœur ! 🎄❤️"
                ></div>
            </div>
            
            <!-- Section Background -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-palette"></i> Choisissez votre fond</h2>
                <p style="margin-bottom: 20px; color: #7a6a6a;">Sélectionnez un arrière-plan pour votre lettre</p>
                
                <div class="background-selector">
                    <div class="bg-option selected" data-bg="bg-rose">
                        <div class="bg-preview bg-rose"></div>
                        <div class="bg-name">Rose Doux</div>
                    </div>
                    
                    <div class="bg-option" data-bg="bg-vintage">
                        <div class="bg-preview bg-vintage"></div>
                        <div class="bg-name">Vintage</div>
                    </div>
                    
                    {{-- <div class="bg-option" data-bg="bg-noel">
                        <div class="bg-preview bg-noel"></div>
                        <div class="bg-name">Noël Vert</div>
                    </div>
                    
                    <div class="bg-option" data-bg="bg-neige">
                        <div class="bg-preview bg-neige"></div>
                        <div class="bg-name">Neige</div>
                    </div> --}}
                    
                    <div class="bg-option" data-bg="bg-or">
                        <div class="bg-preview bg-or"></div>
                        <div class="bg-name">Doré</div>
                    </div>
                    
                    {{-- <div class="bg-option" data-bg="bg-etoile">
                        <div class="bg-preview bg-etoile"></div>
                        <div class="bg-name">Étoilé</div>
                    </div> --}}
                </div>
            </div>
            
            <!-- Section WhatsApp -->
            <div class="phone-section">
                <div class="whatsapp-info">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <strong>Envoyez votre lettre par WhatsApp</strong>
                        <p>Renseignez le numéro du destinataire pour lui envoyer un lien vers sa lettre</p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Numéro WhatsApp du destinataire</label>
                    <div style="display: flex; gap: 10px;">
                        {{-- <select class="form-input" style="width: 100px;" id="countryCode">
                            <option value="+33">+33 FR</option>
                            <option value="+1">+1 US</option>
                            <option value="+32">+32 BE</option>
                            <option value="+41">+41 CH</option>
                            <option value="+237">+237 CM</option>
                            <option value="+221">+221 SN</option>
                        </select> --}}
                    <select class="form-input" style="width: 100px;" id="countryCode">
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
                    <input type="tel" class="form-input" id="recipientPhone" placeholder="6 12 34 56 78" style="flex: 1;">
                    </div>
                    <small style="display: block; margin-top: 8px; color: #7a6a6a;">
                        Format: sans le 0 initial. Ex: 6 12 34 56 78
                    </small>
                </div>
            </div>
            
            <!-- Boutons d'action -->
            <div class="action-buttons">
                <button type="button" class="btn-action btn-preview" id="previewBtn">
                    <i class="fas fa-eye"></i> Prévisualiser
                </button>
                
                <button type="submit" class="btn-action btn-save">
                    <i class="fas fa-save"></i> Sauvegarder & Envoyer
                </button>
            </div>
        </form>
        
        <!-- Footer -->
        <footer class="footer">
            <p>Votre lettre sera sauvegardée localement et vous pourrez la retrouver à tout moment.</p>
            <a href="/" class="back-link">
                <i class="fas fa-arrow-left"></i> Retour à l'accueil
            </a>
        </footer>
    </div>
    
    <!-- Modal de prévisualisation -->
    <div class="modal" id="previewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Prévisualisation de votre lettre</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="previewContent" style="padding: 20px; border-radius: 15px; min-height: 400px;">
                    <!-- Le contenu de la lettre sera inséré ici -->
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
    
    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Votre lettre a été sauvegardée avec succès!</span>
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
        let selectedBackground = 'bg-rose';
        let letterId = null;
        
        // ===== ÉDITEUR DE TEXTE =====
        document.querySelectorAll('.editor-btn[data-command]').forEach(btn => {
            btn.addEventListener('click', function() {
                const command = this.dataset.command;
                document.execCommand(command, false, null);
                this.classList.toggle('active');
            });
        });
        
        document.getElementById('fontSize').addEventListener('change', function() {
            document.execCommand('fontSize', false, this.value);
        });
        
        document.getElementById('fontFamily').addEventListener('change', function() {
            document.execCommand('fontName', false, this.value);
        });
        
        document.getElementById('textColor').addEventListener('input', function() {
            document.execCommand('foreColor', false, this.value);
        });
        
        // Placeholder pour l'éditeur
        const letterContent = document.getElementById('letterContent');
        const placeholder = letterContent.dataset.placeholder;
        
        letterContent.addEventListener('focus', function() {
            if (this.innerHTML === placeholder) {
                this.innerHTML = '';
                this.style.color = 'var(--noir-doux)';
            }
        });
        
        letterContent.addEventListener('blur', function() {
            if (this.innerHTML === '') {
                this.innerHTML = placeholder;
                this.style.color = '#9a8a8a';
            }
        });
        
        // Initialiser le placeholder
        if (!letterContent.innerHTML.trim()) {
            letterContent.innerHTML = placeholder;
            letterContent.style.color = '#9a8a8a';
        }
        
        // ===== SELECTION DE BACKGROUND =====
        document.querySelectorAll('.bg-option').forEach(option => {
            option.addEventListener('click', function() {
                // Retirer la sélection précédente
                document.querySelectorAll('.bg-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Ajouter la nouvelle sélection
                this.classList.add('selected');
                selectedBackground = this.dataset.bg;
            });
        });
        
        // ===== PRÉVISUALISATION =====
        document.getElementById('previewBtn').addEventListener('click', function() {
            const fromName = document.getElementById('fromName').value || 'Expéditeur';
            const toName = document.getElementById('toName').value || 'Destinataire';
            const letterTitle = document.getElementById('letterTitle').value || 'Lettre de Noël';
            const content = letterContent.innerHTML === placeholder ? '' : letterContent.innerHTML;
            
            const previewHTML = `
                <div class="${selectedBackground}" style="padding: 40px; border-radius: 15px; min-height: 500px; color: ${selectedBackground.includes('etoile') || selectedBackground.includes('noel') ? 'white' : 'var(--noir-doux)'};">
                    <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 20px; text-align: center;">${letterTitle}</h1>
                    
                    <div style="margin-bottom: 30px; text-align: center; font-family: 'Dancing Script', cursive; font-size: 1.5rem;">
                        <div>À: <strong>${toName}</strong></div>
                        <div>De: <strong>${fromName}</strong></div>
                    </div>
                    
                    <div style="margin-top: 40px; line-height: 1.8; font-size: 1.1rem;">
                        ${content || '<p style="text-align: center; opacity: 0.7;">Votre lettre apparaîtra ici...</p>'}
                    </div>
                    
                    <div style="margin-top: 60px; text-align: right; font-family: 'Dancing Script', cursive; font-size: 1.8rem;">
                        Joyeux Noël et Bonne Année ! 🎄✨
                    </div>
                </div>
            `;
            
            document.getElementById('previewContent').innerHTML = previewHTML;
            document.getElementById('previewModal').style.display = 'flex';
        });
        
        // Fermer le modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('previewModal').style.display = 'none';
        });
        
        // ===== SAUVEGARDE & ENVOI =====
        document.getElementById('letterForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            // ... validation ...

            const countryCode = document.getElementById('countryCode').value;
            const phone = document.getElementById('recipientPhone').value;

            const letterData = {
                id: 'letter_' + Date.now(), // ID local
                from: document.getElementById('fromName').value,
                to: document.getElementById('toName').value,
                title: document.getElementById('letterTitle').value,
                content: letterContent.innerHTML === placeholder ? '' : letterContent.innerHTML,
                background: selectedBackground,
                phone: countryCode + phone,
                createdAt: new Date().toISOString(),
                synced: false
            };
            
            try {
                // Sauvegarder localement d'abord
                saveToLocalStorage(letterData);
                
                // Envoyer au backend
                const response = await saveToBackend({
                    ...letterData,
                    local_id: letterData.id // Envoyer l'ID local au backend
                });
                
                if (response.success) {
                    // Marquer comme synchronisé dans le localStorage
                    let letters = JSON.parse(localStorage.getItem('christmasLetters')) || [];
                    letters = letters.map(letter => {
                        if (letter.id === letterData.id) {
                            letter.synced = true;
                            letter.server_id = response.data.id; // Sauvegarder l'ID serveur
                        }
                        return letter;
                    });
                    
                    localStorage.setItem('christmasLetters', JSON.stringify(letters));
                    
                    showNotification('Lettre sauvegardée et envoyée avec succès!', 'success');
                    
                    // Redirection
                    setTimeout(() => {
                        window.location.href = response.data.share_link;
                    }, 2000);
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('La lettre a été sauvegardée localement. Elle sera synchronisée dès que possible.', 'success');
            }
        });        


        // ===== FONCTIONS UTILITAIRES =====
        
        function saveToLocalStorage(data) {
            // Ajouter un flag pour indiquer si c'est synchronisé
            data.synced = false;
            
            let letters = JSON.parse(localStorage.getItem('christmasLetters')) || [];
            
            // Vérifier si une lettre avec le même ID existe déjà
            const existingIndex = letters.findIndex(l => l.id === data.id);
            
            if (existingIndex !== -1) {
                // Mettre à jour la lettre existante
                letters[existingIndex] = data;
            } else {
                // Ajouter la nouvelle lettre
                letters.push(data);
            }
            
            localStorage.setItem('christmasLetters', JSON.stringify(letters));
            
            // Tenter une synchronisation immédiate
            setTimeout(syncUnsentLetters, 1000);
        }        

        // Synchroniser les lettres du localStorage qui n'ont pas encore été envoyées
        async function syncUnsentLetters() {
            const letters = JSON.parse(localStorage.getItem('christmasLetters')) || [];
            const unsentLetters = letters.filter(letter => !letter.synced);
            
            if (unsentLetters.length === 0) return;

            try {
                const response = await fetch('/api/letters/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ letters: unsentLetters })
                });

                const data = await response.json();
                
                if (data.success) {
                    // Marquer les lettres comme synchronisées dans le localStorage
                    letters.forEach(letter => {
                        if (unsentLetters.some(unsent => unsent.id === letter.id)) {
                            letter.synced = true;
                        }
                    });
                    
                    localStorage.setItem('christmasLetters', JSON.stringify(letters));
                                        
                    // Afficher une notification si nécessaire
                    if (data.synced_count > 0) {
                        showNotification(`${data.synced_count} lettre(s) sauvegardée(s) en ligne`, 'success');
                    }
                }
            } catch (error) {
                console.error('Erreur de synchronisation:', error);
            }
        }


        async function saveToBackend(data) {
            try {
                const response = await fetch('/letters', {
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
                        content: data.content,
                        background: data.background,
                        phone: data.phone
                    })
                });

                if (!response.ok) {
                    throw new Error('Erreur serveur');
                }

                const result = await response.json();
                
                if (result.success) {
                    letterId = result.data.id;
                    
                    // Ouvrir WhatsApp avec le lien généré par Laravel
                    if (result.data.whatsapp_url) {
                        window.open(result.data.whatsapp_url, '_blank');
                    }
                    
                    return result;
                } else {
                    throw new Error(result.message || 'Erreur inconnue');
                }
            } catch (error) {
                console.error('Erreur backend:', error);
                throw error;
            }
        }

        function sendWhatsApp(link, phone) {
            // Formater le message WhatsApp
            const message = `🎄 Bonjour! Vous avez reçu une lettre de Noël personnalisée! 🎁\n\nCliquez sur ce lien pour la découvrir:\n${link}\n\nJoyeuses fêtes! ✨`;
            
            // Encoder le message pour URL
            const encodedMessage = encodeURIComponent(message);
            
            // Ouvrir WhatsApp Web ou app
            const whatsappUrl = `https://wa.me/${phone}?text=${encodedMessage}`;
            
            // Ouvrir dans un nouvel onglet
            window.open(whatsappUrl, '_blank');
            
            return Promise.resolve();
        }
        
        function showNotification(text, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = text;
            notification.className = `notification ${type}`;
            notification.classList.add('show');
            
            // Cacher après 5 secondes
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }
        
        // ===== CHARGEMENT AU DÉMARRAGE =====
        window.addEventListener('load', function() {
            // Vérifier si on vient de créer une lettre
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('saved') === 'true') {
                showNotification('Votre lettre a été sauvegardée avec succès!', 'success');
            }
        });
    </script>
</body>
</html>