<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <x-seo></x-seo>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeux Noël et Nouvel An - Créez vos Souhaits Festifs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Pacifico&family=Satisfy&display=swap" rel="stylesheet">
    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --rose-principal: #ffb6c1;
            --rose-clair: #ffebf0;
            --rose-fonce: #ff8fa3;
            --rose-vintage: #f8c8dc;
            --rose-neon: #ff69b4;
            --violet-doux: #dda0dd;
            --lavande: #e6e6fa;
            --peche: #ffdab9;
            --corail: #ff7f50;
            --vert-noel: #2e8b57;
            --vert-pastel: #98d8c8;
            --or: #ffd700;
            --argent: #c0c0c0;
            --blanc: #fff9fb;
            --noir-doux: #5a4a4a;
            --rouge-noel: #dc143c;
            --bleu-glace: #add8e6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff0f5 0%, #ffe4e1 25%, #ffd4e5 50%, #ffe4f7 75%, #fff0f5 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            color: var(--noir-doux);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* ===== PARTICULES MAGIQUES ===== */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: floatParticle 20s infinite linear;
        }
        
        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(720deg) scale(1);
                opacity: 0;
            }
        }
        
        /* ===== FLOCONS DE NEIGE ANIMÉS ===== */
        .snowflake {
            position: fixed;
            top: -10px;
            z-index: 1;
            user-select: none;
            cursor: default;
            animation: snowfall linear infinite;
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }
        
        @keyframes snowfall {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) translateX(100px) rotate(360deg);
                opacity: 0.7;
            }
        }
        
        /* ===== FLEURS ET DÉCORATIONS DE FOND ===== */
        .fleur {
            position: absolute;
            opacity: 0.2;
            z-index: 0;
            animation: floatFlower 25s infinite ease-in-out;
            filter: drop-shadow(0 0 10px rgba(255, 182, 193, 0.5));
        }
        
        .fleur-1 { 
            top: 10%; 
            left: 5%; 
            font-size: 80px; 
            animation-delay: 0s;
            animation-duration: 20s;
        }
        .fleur-2 { 
            top: 20%; 
            right: 10%; 
            font-size: 100px; 
            animation-delay: 3s;
            animation-duration: 25s;
        }
        .fleur-3 { 
            bottom: 15%; 
            left: 8%; 
            font-size: 70px; 
            animation-delay: 6s;
            animation-duration: 22s;
        }
        .fleur-4 { 
            bottom: 25%; 
            right: 15%; 
            font-size: 90px; 
            animation-delay: 9s;
            animation-duration: 28s;
        }
        .fleur-5 { 
            top: 50%; 
            left: 20%; 
            font-size: 60px; 
            animation-delay: 12s;
            animation-duration: 24s;
        }
        .fleur-6 {
            top: 60%;
            right: 25%;
            font-size: 85px;
            animation-delay: 15s;
            animation-duration: 26s;
        }
        .fleur-7 {
            top: 35%;
            left: 50%;
            font-size: 75px;
            animation-delay: 18s;
            animation-duration: 23s;
        }

        .ad-row{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap
        }
        
        @keyframes floatFlower {
            0%, 100% { 
                transform: translateY(0) translateX(0) rotate(0deg) scale(1);
            }
            25% { 
                transform: translateY(-30px) translateX(20px) rotate(10deg) scale(1.1);
            }
            50% { 
                transform: translateY(-50px) translateX(-20px) rotate(-10deg) scale(0.9);
            }
            75% { 
                transform: translateY(-30px) translateX(10px) rotate(5deg) scale(1.05);
            }
        }
        
        /* ===== ÉTOILES SCINTILLANTES ===== */
        .star {
            position: absolute;
            color: var(--or);
            font-size: 20px;
            animation: twinkle 2s infinite ease-in-out;
            text-shadow: 0 0 10px var(--or);
            z-index: 1;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.3; transform: scale(1.3) rotate(180deg); }
        }
        
        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 2;
        }
        
        /* ===== HEADER ULTRA ANIMÉ ===== */
        .header {
            text-align: center;
            padding: 50px 30px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 240, 245, 0.95) 100%);
            border-radius: 40px;
            margin-bottom: 50px;
            box-shadow: 
                0 15px 40px rgba(255, 182, 193, 0.3),
                0 0 0 1px rgba(255, 182, 193, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 3px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
            animation: headerFloat 6s ease-in-out infinite;
        }
        
        @keyframes headerFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-10px) scale(1.02); }
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 30% 40%, var(--rose-vintage) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, var(--lavande) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, var(--peche) 0%, transparent 70%);
            opacity: 0.4;
            animation: rotateBackground 30s linear infinite;
            z-index: -1;
        }
        
        @keyframes rotateBackground {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.2); }
            100% { transform: rotate(360deg) scale(1); }
        }
        
        .header::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, 
                var(--rose-principal), 
                var(--violet-doux), 
                var(--or), 
                var(--rose-neon),
                var(--lavande),
                var(--rose-principal)
            );
            border-radius: 40px;
            z-index: -2;
            animation: borderRotate 4s linear infinite;
            background-size: 400% 400%;
        }
        
        @keyframes borderRotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .logo {
            font-family: 'Dancing Script', cursive;
            font-size: 4.5rem;
            background: linear-gradient(45deg, 
                var(--rose-fonce), 
                var(--rose-neon), 
                var(--violet-doux),
                var(--rose-fonce)
            );
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            text-shadow: 3px 3px 0px rgba(255, 143, 163, 0.2);
            animation: logoGradient 3s ease infinite, logoBounce 2s ease-in-out infinite;
            filter: drop-shadow(0 0 20px rgba(255, 105, 180, 0.5));
            position: relative;
            display: inline-block;
        }
        
        @keyframes logoGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes logoBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(1.05); }
        }
        
        .logo::before,
        .logo::after {
            content: '✨';
            position: absolute;
            font-size: 2rem;
            animation: sparkle 1.5s infinite ease-in-out;
        }
        
        .logo::before {
            left: -50px;
            top: 0;
            animation-delay: 0s;
        }
        
        .logo::after {
            right: -50px;
            top: 0;
            animation-delay: 0.75s;
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.5; transform: scale(1.5) rotate(180deg); }
        }
        
        .sous-titre {
            font-size: 1.5rem;
            color: var(--noir-doux);
            max-width: 850px;
            margin: 0 auto 30px;
            line-height: 1.8;
            animation: fadeInUp 1s ease-out;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .noel-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--vert-noel), var(--vert-pastel), var(--or));
            background-size: 200% 200%;
            color: white;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 700;
            margin: 20px 0;
            box-shadow: 
                0 8px 20px rgba(46, 139, 87, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            animation: badgePulse 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }
        
        @keyframes badgePulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 8px 20px rgba(46, 139, 87, 0.4);
                background-position: 0% 50%;
            }
            50% { 
                transform: scale(1.08);
                box-shadow: 0 12px 30px rgba(46, 139, 87, 0.6);
                background-position: 100% 50%;
            }
        }
        
        .noel-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: badgeShine 2s linear infinite;
        }
        
        @keyframes badgeShine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        /* ===== SECTIONS AVEC ANIMATIONS ===== */
        .section-titre {
            font-family: 'Dancing Script', cursive;
            font-size: 3.5rem;
            background: linear-gradient(90deg, 
                var(--rose-fonce), 
                var(--violet-doux), 
                var(--rose-neon),
                var(--rose-fonce)
            );
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin: 60px 0 40px;
            position: relative;
            animation: titleGradient 4s ease infinite, titleFloat 3s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255, 105, 180, 0.4));
        }
        
        @keyframes titleGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes titleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .section-titre::after {
            content: '';
            display: block;
            width: 120px;
            height: 5px;
            background: linear-gradient(90deg, 
                transparent,
                var(--rose-principal), 
                var(--or),
                var(--violet-doux),
                var(--rose-principal),
                transparent
            );
            background-size: 200% 100%;
            margin: 15px auto;
            border-radius: 10px;
            animation: lineGradient 3s linear infinite;
            box-shadow: 0 0 15px rgba(255, 182, 193, 0.6);
        }
        
        @keyframes lineGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }
        
        /* ===== CARTES OPTIONS ULTRA ANIMÉES ===== */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 70px;
        }
        
        .option-card {
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.95) 0%, 
                rgba(255, 240, 245, 0.9) 100%
            );
            border-radius: 30px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 2px solid transparent;
            box-shadow: 
                0 10px 30px rgba(255, 182, 193, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
            animation: cardFloat 6s ease-in-out infinite;
        }
        
        .option-card:nth-child(1) { animation-delay: 0s; }
        .option-card:nth-child(2) { animation-delay: 0.5s; }
        .option-card:nth-child(3) { animation-delay: 1s; }
        .option-card:nth-child(4) { animation-delay: 1.5s; }
        
        @keyframes cardFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        .option-card:hover {
            transform: translateY(-20px) scale(1.05) rotate(2deg);
            border-color: var(--rose-neon);
            box-shadow: 
                0 20px 50px rgba(255, 105, 180, 0.4),
                0 0 30px rgba(255, 182, 193, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .option-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent,
                rgba(255, 255, 255, 0.5),
                transparent
            );
            transition: left 0.5s;
        }
        
        .option-card:hover::before {
            left: 100%;
        }
        
        .option-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, 
                var(--rose-principal), 
                var(--violet-doux), 
                var(--or),
                var(--rose-neon),
                var(--rose-principal)
            );
            background-size: 300% 100%;
            animation: topBorderGradient 3s linear infinite;
        }
        
        @keyframes topBorderGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }
        
        .option-icon {
            font-size: 4rem;
            color: var(--rose-fonce);
            margin-bottom: 25px;
            height: 120px;
            width: 120px;
            line-height: 120px;
            background: linear-gradient(135deg, var(--rose-clair), var(--lavande));
            border-radius: 50%;
            display: inline-block;
            box-shadow: 
                0 8px 25px rgba(255, 182, 193, 0.3),
                inset 0 -3px 10px rgba(255, 182, 193, 0.2);
            animation: iconPulse 2s ease-in-out infinite;
            position: relative;
        }
        
        @keyframes iconPulse {
            0%, 100% { 
                transform: scale(1) rotate(0deg);
                box-shadow: 0 8px 25px rgba(255, 182, 193, 0.3);
            }
            50% { 
                transform: scale(1.1) rotate(5deg);
                box-shadow: 0 12px 35px rgba(255, 182, 193, 0.5);
            }
        }
        
        .option-icon::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            border: 3px dashed var(--rose-principal);
            animation: iconRotate 10s linear infinite;
            opacity: 0.5;
        }
        
        @keyframes iconRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .option-icon i {
            animation: iconBounce 1.5s ease-in-out infinite;
        }
        
        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        .option-titre {
            font-size: 2rem;
            color: var(--noir-doux);
            margin-bottom: 18px;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }
        
        .option-card:hover .option-titre {
            color: var(--rose-neon);
            transform: scale(1.05);
        }
        
        .option-description {
            color: #7a6a6a;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        .btn-option {
            display: inline-block;
            background: linear-gradient(135deg, var(--rose-fonce), var(--rose-neon), var(--violet-doux));
            /* background-size: 200% 200%; */
            color: white;
            padding: 14px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            /* transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); */
            border: none;
            /* cursor: pointer; */
            font-size: 1.05rem;
            box-shadow: 
                0 6px 20px rgba(255, 143, 163, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            animation: buttonGradient 3s ease infinite;
        }
        
        @keyframes buttonGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .btn-option::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-option:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-option:hover {
            transform: scale(1.1) translateY(-3px);
            box-shadow: 
                0 10px 30px rgba(255, 105, 180, 0.6),
                0 0 20px rgba(255, 182, 193, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        
        .btn-option i {
            position: relative;
            z-index: 1;
            margin-right: 8px;
        }
        
        .btn-option span {
            position: relative;
            z-index: 1;
        }
        
        /* ===== GALERIE AVEC IMAGES EXTERNES ===== */
        .galerie {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 35px;
            margin-bottom: 70px;
        }
        
        .exemple-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 2px solid var(--rose-clair);
            position: relative;
            animation: cardAppear 0.6s ease-out;
        }
        
        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .exemple-card:nth-child(1) { animation-delay: 0.1s; }
        .exemple-card:nth-child(2) { animation-delay: 0.2s; }
        .exemple-card:nth-child(3) { animation-delay: 0.3s; }
        .exemple-card:nth-child(4) { animation-delay: 0.4s; }
        
        .exemple-card:hover {
            transform: translateY(-12px) scale(1.05) rotate(-2deg);
            box-shadow: 
                0 20px 40px rgba(255, 182, 193, 0.35),
                0 0 30px rgba(255, 105, 180, 0.3);
            border-color: var(--rose-neon);
        }
        
        .exemple-image {
            height: 220px;
            background: linear-gradient(135deg, var(--rose-clair), var(--lavande), var(--peche));
            background-size: 200% 200%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            color: var(--rose-fonce);
            position: relative;
            overflow: hidden;
            animation: imageGradient 8s ease infinite;
        }
        
        @keyframes imageGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .exemple-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            animation: imageShine 4s linear infinite;
        }
        
        @keyframes imageShine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .exemple-image i {
            position: relative;
            z-index: 1;
            animation: iconFloat 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 10px rgba(255, 182, 193, 0.5));
        }
        
        @keyframes iconFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(10deg); }
        }
        
        .exemple-titre {
            padding: 25px;
            font-weight: 700;
            color: var(--noir-doux);
            text-align: center;
            font-size: 1.15rem;
            background: linear-gradient(90deg, transparent, rgba(255, 240, 245, 0.5), transparent);
        }
        
        /* ===== CTA FINAL SPECTACULAIRE ===== */
        .cta-section {
            background: linear-gradient(135deg, 
                rgba(255, 182, 193, 0.95), 
                rgba(221, 160, 221, 0.9),
                rgba(255, 215, 0, 0.85),
                rgba(255, 105, 180, 0.9)
            );
            background-size: 400% 400%;
            border-radius: 40px;
            padding: 60px 40px;
            text-align: center;
            margin: 70px 0;
            position: relative;
            overflow: hidden;
            animation: ctaGradient 10s ease infinite, ctaPulse 4s ease-in-out infinite;
            box-shadow: 
                0 20px 60px rgba(255, 105, 180, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
            border: 3px solid rgba(255, 255, 255, 0.6);
        }
        
        @keyframes ctaGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes ctaPulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 20px 60px rgba(255, 105, 180, 0.4);
            }
            50% { 
                transform: scale(1.02);
                box-shadow: 0 25px 70px rgba(255, 105, 180, 0.6);
            }
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 215, 0, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255, 182, 193, 0.3) 0%, transparent 70%);
            animation: ctaBackgroundRotate 20s linear infinite;
            z-index: 0;
        }
        
        @keyframes ctaBackgroundRotate {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }
        
        .cta-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.2) 50%, transparent 60%);
            background-size: 200% 200%;
            animation: ctaShine 3s linear infinite;
            z-index: 1;
        }
        
        @keyframes ctaShine {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .cta-titre {
            font-family: 'Dancing Script', cursive;
            font-size: 4rem;
            color: white;
            margin-bottom: 25px;
            text-shadow: 
                3px 3px 6px rgba(0, 0, 0, 0.3),
                0 0 20px rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 2;
            animation: ctaTitleFloat 3s ease-in-out infinite;
        }
        
        @keyframes ctaTitleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .cta-description {
            color: white;
            font-size: 1.3rem;
            max-width: 750px;
            margin: 0 auto 35px;
            opacity: 0.98;
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            line-height: 1.8;
        }
        
        .btn-cta {
            background: white;
            color: var(--rose-neon);
            padding: 18px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.3rem;
            display: inline-block;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 2;
            overflow: hidden;
            border: 3px solid transparent;
        }
        
        .btn-cta::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--rose-clair), var(--lavande));
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }
        
        .btn-cta:hover::before {
            width: 400px;
            height: 400px;
        }
        
        .btn-cta:hover {
            transform: scale(1.15) translateY(-5px) rotate(-2deg);
            box-shadow: 
                0 15px 40px rgba(255, 105, 180, 0.4),
                0 0 30px rgba(255, 182, 193, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            color: var(--vert-noel);
            border-color: var(--rose-neon);
        }
        
        .btn-cta i {
            animation: ctaIconSpin 2s linear infinite;
            display: inline-block;
            margin-right: 10px;
        }
        
        @keyframes ctaIconSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ===== DÉCORATIONS SUPPLÉMENTAIRES ===== */
        .hearts-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        
        .floating-heart {
            position: absolute;
            font-size: 30px;
            color: var(--rose-principal);
            opacity: 0.3;
            animation: floatHeart 15s infinite ease-in-out;
        }
        
        @keyframes floatHeart {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg) scale(0.5);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(720deg) scale(1.2);
                opacity: 0;
            }
        }
        
        /* ===== CONFETTIS ANIMÉS ===== */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: var(--rose-principal);
            opacity: 0.7;
            animation: confettiFall 8s infinite linear;
            pointer-events: none;
            z-index: 1;
        }
        
        @keyframes confettiFall {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) translateX(50px) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* ===== BOUTONS AVEC EFFET MAGIQUE ===== */
        .magical-button {
            position: relative;
            isolation: isolate;
        }
        
        .magical-button::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: linear-gradient(45deg, 
                var(--rose-principal),
                var(--violet-doux),
                var(--or),
                var(--rose-neon)
            );
            background-size: 300% 300%;
            animation: magicalBorder 3s linear infinite;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .magical-button:hover::before {
            opacity: 1;
        }
        
        @keyframes magicalBorder {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        /* ===== ÉLÉMENTS DE NOËL ANIMÉS ===== */
        .christmas-lights {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 20px;
            display: flex;
            justify-content: space-around;
            z-index: 100;
            pointer-events: none;
        }
        
        .light {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            animation: lightBlink 2s infinite ease-in-out;
        }
        
        .light:nth-child(1) { background: var(--rouge-noel); animation-delay: 0s; }
        .light:nth-child(2) { background: var(--or); animation-delay: 0.2s; }
        .light:nth-child(3) { background: var(--vert-noel); animation-delay: 0.4s; }
        .light:nth-child(4) { background: var(--rose-neon); animation-delay: 0.6s; }
        .light:nth-child(5) { background: var(--bleu-glace); animation-delay: 0.8s; }
        .light:nth-child(6) { background: var(--violet-doux); animation-delay: 1s; }
        .light:nth-child(7) { background: var(--corail); animation-delay: 1.2s; }
        .light:nth-child(8) { background: var(--or); animation-delay: 1.4s; }
        .light:nth-child(9) { background: var(--rouge-noel); animation-delay: 1.6s; }
        .light:nth-child(10) { background: var(--vert-noel); animation-delay: 1.8s; }
        
        @keyframes lightBlink {
            0%, 100% { 
                opacity: 1; 
                transform: scale(1);
                box-shadow: 0 0 10px currentColor;
            }
            50% { 
                opacity: 0.3; 
                transform: scale(0.8);
                box-shadow: 0 0 5px currentColor;
            }
        }
        
        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .logo { 
                font-size: 3.2rem;
            }
            .logo::before,
            .logo::after {
                font-size: 1.5rem;
                left: -35px;
                right: -35px;
            }
            .section-titre { 
                font-size: 2.8rem;
            }
            .cta-titre { 
                font-size: 3rem;
            }
            .options-grid { 
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .galerie { 
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
            .container { 
                padding: 15px;
            }
            .header {
                padding: 40px 20px;
            }
            .option-card {
                padding: 30px 20px;
            }
            .option-icon {
                width: 100px;
                height: 100px;
                line-height: 100px;
                font-size: 3.5rem;
            }
            .btn-cta {
                padding: 15px 40px;
                font-size: 1.15rem;
            }
            .social-icons {
                gap: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .logo { 
                font-size: 2.5rem;
            }
            .logo::before,
            .logo::after {
                display: none;
            }
            .sous-titre { 
                font-size: 1.15rem;
            }
            .section-titre {
                font-size: 2.3rem;
            }
            .cta-titre {
                font-size: 2.5rem;
            }
            .galerie { 
                grid-template-columns: 1fr;
            }
            .option-card { 
                padding: 25px 15px;
            }
            .option-icon {
                width: 90px;
                height: 90px;
                line-height: 90px;
                font-size: 3rem;
            }
            .option-titre {
                font-size: 1.6rem;
            }
            .btn-option,
            .btn-cta {
                padding: 12px 30px;
                font-size: 1rem;
            }
            .social-icon {
                width: 48px;
                height: 48px;
                font-size: 1.2rem;
            }
            .exemple-image {
                height: 180px;
                font-size: 4rem;
            }
            .noel-badge {
                font-size: 0.9rem;
                padding: 10px 25px;
            }
        }
        
        /* ===== ANIMATIONS D'ENTRÉE ===== */
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideInFromRight {
            0% {
                transform: translateX(100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes zoomIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* ===== EFFETS LUMINEUX ===== */
        .glow-effect {
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from {
                box-shadow: 0 0 10px rgba(255, 182, 193, 0.5),
                            0 0 20px rgba(255, 182, 193, 0.3),
                            0 0 30px rgba(255, 182, 193, 0.2);
            }
            to {
                box-shadow: 0 0 20px rgba(255, 105, 180, 0.8),
                            0 0 30px rgba(255, 105, 180, 0.6),
                            0 0 40px rgba(255, 105, 180, 0.4);
            }
        }
        
        /* ===== OVERLAY SCINTILLANT ===== */
        .sparkle-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 999;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 1%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 1%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 1%);
            background-size: 200px 200px;
            animation: sparkleMove 20s linear infinite;
        }
        
        @keyframes sparkleMove {
            0% { background-position: 0 0; }
            100% { background-position: 200px 200px; }
        }
    </style>
</head>
<body>
    <!-- Guirlandes de Noël lumineuses -->
    <div class="christmas-lights">
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
        <div class="light"></div>
    </div>
    
    <!-- Overlay scintillant -->
    <div class="sparkle-overlay"></div>
    
    <!-- Container pour les particules -->
    <div class="particles-container" id="particlesContainer"></div>
    
    <!-- Container pour les cœurs flottants -->
    <div class="hearts-decoration" id="heartsContainer"></div>
    
    <!-- Fleurs décoratives en fond -->
    <div class="fleur fleur-1">🌸</div>
    <div class="fleur fleur-2">🌺</div>
    <div class="fleur fleur-3">🌷</div>
    <div class="fleur fleur-4">💮</div>
    <div class="fleur fleur-5">🏵️</div>
    <div class="fleur fleur-6">🌹</div>
    <div class="fleur fleur-7">💐</div>
    
    <!-- Étoiles scintillantes -->
    <div class="star" style="top: 15%; left: 10%;">⭐</div>
    <div class="star" style="top: 25%; right: 15%;">✨</div>
    <div class="star" style="top: 45%; left: 5%;">🌟</div>
    <div class="star" style="bottom: 30%; right: 8%;">💫</div>
    <div class="star" style="top: 70%; left: 15%;">⭐</div>
    <div class="star" style="top: 55%; right: 20%;">✨</div>
    
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1 class="logo">Joyeux Noël et Nouvel An</h1>
            <div class="noel-badge">
                <i class="fas fa-gift"></i> Joyeuses Fêtes 2026 <i class="fas fa-star"></i>
                    {{-- @component('components.ads.smartlink')
                    @endcomponent --}}
            </div>
            <p class="sous-titre">
                Créez des souvenirs magiques ! Concoctez de magnifiques affiches, cartes de vœux et messages festifs 
                pour partager la joie de Noël et du Nouvel An avec vos proches.
            </p>
            <a href="#creer" class="btn-option magical-button" style="font-size: 1.1rem; padding: 14px 35px;">
                <i class="fas fa-magic"></i> <span>Commencer la Magie</span>
            </a>
        </header>
        
        <!-- Section Options de Création -->
        <h2 class="section-titre" id="creer">Choisissez Votre Création</h2>
        
        <div class="options-grid">
            <!-- Option 1 -->
            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-scroll"></i>
                    {{-- @component('components.ads.smartlink')
                    @endcomponent --}}
                </div>
                <h3 class="option-titre">Lettre de Noël</h3>
                <p class="option-description">
                    Rédigez une belle lettre au Père Noël ou à vos proches avec des designs festifs, 
                    des polices élégantes et des décorations magiques.
                </p>
                <a href="/create-letter" class="btn-option magical-button">
                    <i class="fas fa-pen-fancy"></i> <span>Écrire une Lettre</span>
                </a>
            </div>

            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-ad"></i>
                    @component('components.ads.smartlink')
                    @endcomponent
                </div>

                    @component('components.ads.banners.banner-160x300')
                    @endcomponent

                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="btn-option magical-button">
                    <i class="fas fa-eye"></i> <span>Visiter cette publicité</span>
                </a>
            </div>
            
            <!-- Option 2 -->
            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-images"></i>
                    {{-- @component('components.ads.smartlink')
                    @endcomponent --}}
                </div>
                <h3 class="option-titre">Affiche Personnalisée</h3>
                <p class="option-description">
                    Créez une affiche festive avec vos noms, photos et souhaits. Parfait pour les couples, 
                    familles ou messages de vœux professionnels.
                </p>
                <a href="/create-poster" class="btn-option magical-button">
                    <i class="fas fa-palette"></i> <span>Créer une Affiche</span>
                </a>
            </div>
            
            <!-- Option 3 -->
            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-gifts"></i>
                    {{-- @component('components.ads.smartlink')
                    @endcomponent --}}
                </div>
                <h3 class="option-titre">Liste de Cadeaux</h3>
                <p class="option-description">
                    Partagez votre liste de souhaits de Noël avec un design adorable. 
                    Ajoutez des images, des liens et des notes pour chaque cadeau rêvé.
                </p>
                <a href="/create-giftlist" class="btn-option magical-button">
                    <i class="fas fa-list-ul"></i> <span>Faire ma Liste</span>
                </a>
            </div>

            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-ad"></i>
                    @component('components.ads.smartlink')
                    @endcomponent
                </div>

                    @component('components.ads.banners.banner-160x300')
                    @endcomponent

                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="btn-option magical-button">
                    <i class="fas fa-eye"></i> <span>Visiter cette publicité</span>
                </a>
            </div>
            
            <!-- Option 4 -->
            <div class="option-card">
                <div class="option-icon">
                    <i class="fas fa-heart"></i>
                    {{-- @component('components.ads.smartlink')
                    @endcomponent --}}
                </div>
                <h3 class="option-titre">Carte de Vœux</h3>
                <p class="option-description">
                    Envoyez des vœux du Nouvel An personnalisés. Choisissez parmi nos templates romantiques 
                    ou festifs, ajoutez votre message et partagez.
                </p>
                <a href="/create-card" class="btn-option magical-button">
                    <i class="fas fa-envelope"></i> <span>Envoyer des Vœux</span>
                </a>
            </div>
        </div>
        
        <!-- Section Galerie d'Exemples -->
        <h2 class="section-titre">Inspirez-vous de Nos Publicités</h2>
        
        <div class="galerie">
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-300x250')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="exemple-titre">Carte Couple Étoilée</a>
            </div>
            
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-160x300')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" class="exemple-titre">Affiche Familiale de Noël</a>
            </div>
            
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-300x250')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="exemple-titre">Vœux Nouvel An Élégants</a>
            </div>
            
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-160x300')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" class="exemple-titre">Lettre Enfantine Joyeuse</a>
            </div>
        
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-300x250')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="exemple-titre">Carte Couple Étoilée</a>
            </div>
            
            <div class="exemple-card">
                <div class="exemple-image">
                    @component('components.ads.banners.banner-160x300')
                    @endcomponent
                </div>
                <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" class="exemple-titre">Affiche Familiale de Noël</a>
            </div>
        </div>
        
        <!-- CTA Final -->
        <div class="cta-section">
            <h2 class="cta-titre">Prête à Créer la Magie ?</h2>
            <p class="cta-description">
                Rejoignez des milliers de personnes qui partagent déjà la joie des fêtes 
                avec des créations personnalisées. C'est gratuit, simple et tellement amusant !
            </p>
            <a href="/create-giftlist" class="btn-cta magical-button">
                <i class="fas fa-sparkles"></i> Créer ma Première Cadeau
            </a>
        </div>

        @component('components.ads.banners.banner-728x90')
        @endcomponent

        <div class="ad-row">
            <div>
                @component('components.ads.banners.banner-320x50')
                @endcomponent
            </div>
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
    @component('components.ads.popunder')
    @endcomponent
    </div>
    
    <script>
        // ===== CRÉATION DES FLOCONS DE NEIGE =====
        function createSnowflakes() {
            const snowflakeCount = window.innerWidth > 768 ? 50 : 25;
            
            for (let i = 0; i < snowflakeCount; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.innerHTML = ['❄️', '❅', '❆'][Math.floor(Math.random() * 3)];
                snowflake.style.left = Math.random() * 100 + '%';
                snowflake.style.fontSize = (Math.random() * 15 + 10) + 'px';
                snowflake.style.animationDuration = (Math.random() * 10 + 10) + 's';
                snowflake.style.animationDelay = Math.random() * 5 + 's';
                snowflake.style.opacity = Math.random() * 0.6 + 0.4;
                
                document.body.appendChild(snowflake);
            }
        }
        
        // ===== CRÉATION DES PARTICULES MAGIQUES =====
        function createParticles() {
            const particlesContainer = document.getElementById('particlesContainer');
            const particleCount = window.innerWidth > 768 ? 30 : 15;
            const colors = [
                'rgba(255, 182, 193, 0.6)',
                'rgba(221, 160, 221, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(255, 105, 180, 0.6)',
                'rgba(230, 230, 250, 0.6)',
                'rgba(255, 218, 185, 0.6)'
            ];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = Math.random() * 100 + '%';
                particle.style.width = (Math.random() * 8 + 4) + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.animationDuration = (Math.random() * 15 + 15) + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // ===== CRÉATION DES CŒURS FLOTTANTS =====
        function createFloatingHearts() {
            const heartsContainer = document.getElementById('heartsContainer');
            const heartCount = window.innerWidth > 768 ? 20 : 10;
            const heartEmojis = ['💕', '💖', '💗', '💓', '💝', '❤️', '🩷'];
            
            for (let i = 0; i < heartCount; i++) {
                const heart = document.createElement('div');
                heart.classList.add('floating-heart');
                heart.innerHTML = heartEmojis[Math.floor(Math.random() * heartEmojis.length)];
                heart.style.left = Math.random() * 100 + '%';
                heart.style.fontSize = (Math.random() * 20 + 20) + 'px';
                heart.style.animationDuration = (Math.random() * 10 + 15) + 's';
                heart.style.animationDelay = Math.random() * 10 + 's';
                
                heartsContainer.appendChild(heart);
            }
        }
        
        // ===== CRÉATION DES CONFETTIS =====
        function createConfetti() {
            const confettiCount = window.innerWidth > 768 ? 40 : 20;
            const colors = [
                '#ffb6c1', '#dda0dd', '#ffd700', '#ff69b4', 
                '#e6e6fa', '#ffdab9', '#ff7f50', '#98d8c8'
            ];
            
            setInterval(() => {
                for (let i = 0; i < 5; i++) {
                    const confetti = document.createElement('div');
                    confetti.classList.add('confetti');
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.width = (Math.random() * 8 + 5) + 'px';
                    confetti.style.height = confetti.style.width;
                    confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                    confetti.style.animationDuration = (Math.random() * 5 + 5) + 's';
                    
                    document.body.appendChild(confetti);
                    
                    setTimeout(() => {
                        confetti.remove();
                    }, 10000);
                }
            }, 3000);
        }
        
        // ===== ANIMATIONS INTERACTIVES DES BOUTONS =====
        document.querySelectorAll('.btn-option, .btn-cta').forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                createSparkles(e.pageX, e.pageY);
            });

            button.addEventListener('click', function(e) {
                const href = button.getAttribute('href');
                // Only prevent default for placeholder links (#) or anchor links
                if (href === '#' || href.startsWith('#')) {
                    e.preventDefault();
                    createBurst(e.pageX, e.pageY);
                }
                // For real navigation links (starting with /), allow default behavior
            });
        });
        
        // ===== CRÉATION D'ÉTINCELLES AU SURVOL =====
        function createSparkles(x, y) {
            for (let i = 0; i < 8; i++) {
                const sparkle = document.createElement('div');
                sparkle.innerHTML = '✨';
                sparkle.style.position = 'fixed';
                sparkle.style.left = x + 'px';
                sparkle.style.top = y + 'px';
                sparkle.style.pointerEvents = 'none';
                sparkle.style.zIndex = '9999';
                sparkle.style.fontSize = '20px';
                sparkle.style.animation = 'sparkleExplosion 1s ease-out forwards';
                
                const angle = (Math.PI * 2 * i) / 8;
                const velocity = 50;
                sparkle.style.setProperty('--tx', Math.cos(angle) * velocity + 'px');
                sparkle.style.setProperty('--ty', Math.sin(angle) * velocity + 'px');
                
                document.body.appendChild(sparkle);
                
                setTimeout(() => sparkle.remove(), 1000);
            }
        }
        
        // ===== CRÉATION D'EXPLOSION DE PARTICULES =====
        function createBurst(x, y) {
            const colors = ['#ffb6c1', '#dda0dd', '#ffd700', '#ff69b4'];
            
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.width = '8px';
                particle.style.height = '8px';
                particle.style.borderRadius = '50%';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '9999';
                
                const angle = Math.random() * Math.PI * 2;
                const velocity = Math.random() * 100 + 50;
                const tx = Math.cos(angle) * velocity;
                const ty = Math.sin(angle) * velocity;
                
                particle.animate([
                    { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                    { transform: `translate(${tx}px, ${ty}px) scale(0)`, opacity: 0 }
                ], {
                    duration: 800,
                    easing: 'ease-out'
                });
                
                document.body.appendChild(particle);
                
                setTimeout(() => particle.remove(), 800);
            }
        }
        
        // ===== ANIMATION DES CARTES AU SCROLL =====
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.option-card, .exemple-card').forEach(card => {
            observer.observe(card);
        });
        
        // ===== EFFET DE PARALLAXE SUR LES FLEURS =====
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            document.querySelectorAll('.fleur').forEach((fleur, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed * 50;
                const y = (mouseY - 0.5) * speed * 50;
                
                fleur.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
        
        // ===== SMOOTH SCROLL POUR LES ANCRES =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // ===== EFFET CURSOR TRAIL (TRAÎNÉE DE CURSEUR) =====
        let cursorTrail = [];
        const maxTrailLength = 15;
        
        document.addEventListener('mousemove', (e) => {
            const trail = document.createElement('div');
            trail.style.position = 'fixed';
            trail.style.left = e.clientX + 'px';
            trail.style.top = e.clientY + 'px';
            trail.style.width = '10px';
            trail.style.height = '10px';
            trail.style.borderRadius = '50%';
            trail.style.background = 'radial-gradient(circle, rgba(255, 182, 193, 0.8), transparent)';
            trail.style.pointerEvents = 'none';
            trail.style.zIndex = '9998';
            trail.style.transform = 'translate(-50%, -50%)';
            trail.style.transition = 'all 0.3s ease-out';
            
            document.body.appendChild(trail);
            cursorTrail.push(trail);
            
            setTimeout(() => {
                trail.style.opacity = '0';
                trail.style.transform = 'translate(-50%, -50%) scale(2)';
            }, 10);
            
            setTimeout(() => {
                trail.remove();
            }, 300);
            
            if (cursorTrail.length > maxTrailLength) {
                const oldTrail = cursorTrail.shift();
                if (oldTrail && oldTrail.parentNode) {
                    oldTrail.remove();
                }
            }
        });
        
        // ===== ANIMATION DES ICÔNES DANS LES CARTES =====
        document.querySelectorAll('.option-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.option-icon i');
                icon.style.animation = 'none';
                setTimeout(() => {
                    icon.style.animation = 'iconBounce 0.6s ease-in-out';
                }, 10);
            });
        });
        
        // ===== EFFET DE TYPING POUR LE TITRE =====
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            const originalText = element.textContent;
            element.textContent = '';
            
            function type() {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                } else {
                    element.textContent = originalText;
                }
            }
            
            type();
        }
        
        // ===== COMPTEUR ANIMÉ POUR LES STATISTIQUES =====
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start);
                }
            }, 16);
        }
        
        // ===== CRÉATION D'ÉTOILES FILANTES ALÉATOIRES =====
        function createShootingStar() {
            const star = document.createElement('div');
            star.innerHTML = '⭐';
            star.style.position = 'fixed';
            star.style.top = Math.random() * 50 + '%';
            star.style.left = '-50px';
            star.style.fontSize = '30px';
            star.style.zIndex = '1';
            star.style.pointerEvents = 'none';
            star.style.filter = 'drop-shadow(0 0 10px gold)';
            
            document.body.appendChild(star);
            
            star.animate([
                { 
                    left: '-50px', 
                    top: (Math.random() * 50) + '%',
                    opacity: 0,
                    transform: 'rotate(0deg)'
                },
                { 
                    left: '110%', 
                    top: (Math.random() * 50 + 30) + '%',
                    opacity: 1,
                    transform: 'rotate(720deg)'
                }
            ], {
                duration: 2000,
                easing: 'ease-out'
            });
            
            setTimeout(() => star.remove(), 2000);
        }
        
        // Créer des étoiles filantes périodiquement
        setInterval(createShootingStar, 5000);
        
        // ===== EFFET DE SHAKE SUR LES BADGES =====
        setInterval(() => {
            const badge = document.querySelector('.noel-badge');
            if (badge) {
                badge.animate([
                    { transform: 'scale(1) rotate(0deg)' },
                    { transform: 'scale(1.05) rotate(-2deg)' },
                    { transform: 'scale(1.05) rotate(2deg)' },
                    { transform: 'scale(1) rotate(0deg)' }
                ], {
                    duration: 500,
                    iterations: 1
                });
            }
        }, 8000);
        
        // ===== AJOUT DE STYLES DYNAMIQUES POUR LES ANIMATIONS =====
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            @keyframes sparkleExplosion {
                0% {
                    transform: translate(0, 0) scale(1);
                    opacity: 1;
                }
                100% {
                    transform: translate(var(--tx), var(--ty)) scale(0);
                    opacity: 0;
                }
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            @keyframes rainbow {
                0% { filter: hue-rotate(0deg); }
                100% { filter: hue-rotate(360deg); }
            }
            
            .hover-lift {
                transition: transform 0.3s ease;
            }
            
            .hover-lift:hover {
                transform: translateY(-5px);
            }
        `;
        document.head.appendChild(styleSheet);
        
        // ===== EFFET DE ROTATION 3D SUR LES CARTES =====
        document.querySelectorAll('.option-card, .exemple-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-20px) scale(1.05)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
        
        // ===== EFFET DE VAGUES SUR LE FOND =====
        function createWaveEffect() {
            const wave = document.createElement('div');
            wave.style.position = 'fixed';
            wave.style.bottom = '0';
            wave.style.left = '0';
            wave.style.width = '100%';
            wave.style.height = '100px';
            wave.style.background = 'linear-gradient(transparent, rgba(255, 182, 193, 0.1))';
            wave.style.pointerEvents = 'none';
            wave.style.zIndex = '0';
            wave.style.animation = 'wave 10s ease-in-out infinite';
            
            const waveStyle = document.createElement('style');
            waveStyle.textContent = `
                @keyframes wave {
                    0%, 100% { transform: translateX(-25%) translateY(0); }
                    50% { transform: translateX(25%) translateY(-20px); }
                }
            `;
            document.head.appendChild(waveStyle);
        }
        
        // ===== INITIALISATION DE TOUTES LES ANIMATIONS =====
        function initializeAnimations() {
            createSnowflakes();
            createParticles();
            createFloatingHearts();
            createConfetti();
            createWaveEffect();
            
            // Ajouter des classes d'animation aux éléments
            document.querySelectorAll('.option-card, .exemple-card').forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        }
        
        // ===== EASTER EGG: TRIPLE CLICK SUR LE LOGO =====
        let logoClickCount = 0;
        const logo = document.querySelector('.logo');
        
        logo.addEventListener('click', () => {
            logoClickCount++;
            
            if (logoClickCount === 3) {
                // Explosion de confettis et étoiles
                for (let i = 0; i < 100; i++) {
                    setTimeout(() => {
                        const x = Math.random() * window.innerWidth;
                        const y = Math.random() * window.innerHeight;
                        createBurst(x, y);
                    }, i * 50);
                }
                
                // Animation arc-en-ciel du logo
                logo.style.animation = 'rainbow 2s linear infinite, logoBounce 2s ease-in-out infinite';
                
                setTimeout(() => {
                    logo.style.animation = '';
                    logoClickCount = 0;
                }, 5000);
            }
            
            // Reset après 1 seconde
            setTimeout(() => {
                if (logoClickCount < 3) logoClickCount = 0;
            }, 1000);
        });
        
        // // ===== EFFET DE NEIGE INTERACTIVE =====
        // document.addEventListener('click', (e) => {
        //     for (let i = 0; i < 10; i++) {
        //         const snowflake = document.createElement('div');
        //         snowflake.innerHTML = '❄️';
        //         snowflake.style.position = 'fixed';
        //         snowflake.style.left = e.clientX + (Math.random() - 0.5) * 100 + 'px';
        //         snowflake.style.top = e.clientY + (Math.random() - 0.5) * 100 + 'px';
        //         snowflake.style.fontSize = (Math.random() * 20 + 15) + 'px';
        //         snowflake.style.pointerEvents = 'none';
        //         snowflake.style.zIndex = '9999';
        //         snowflake.style.opacity = '0';
                
        //         document.body.appendChild(snowflake);
                
        //         snowflake.animate([
        //             { 
        //                 opacity: 1, 
        //                 transform: 'translateY(0) rotate(0deg) scale(1)' 
        //             },
        //             { 
        //                 opacity: 0, 
        //                 transform: `translateY(${Math.random() * 100 + 50}px) rotate(${Math.random() * 360}deg) scale(0)` 
        //             }
        //         ], {
        //             duration: 1500,
        //             easing: 'ease-out'
        //         });
                
        //         setTimeout(() => snowflake.remove(), 1500);
        //     }
        // });
        
        // ===== CHANGEMENT DE COULEUR DU FOND SELON L'HEURE =====
        function updateBackgroundByTime() {
            const hour = new Date().getHours();
            const body = document.body;
            
            if (hour >= 6 && hour < 12) {
                // Matin: couleurs douces et lumineuses
                body.style.background = 'linear-gradient(135deg, #fff0f5 0%, #ffe4e1 25%, #ffd4e5 50%, #ffe4f7 75%, #fff0f5 100%)';
            } else if (hour >= 12 && hour < 18) {
                // Après-midi: couleurs vives et chaleureuses
                body.style.background = 'linear-gradient(135deg, #ffebf0 0%, #ffd4e5 25%, #ffbcd4 50%, #ffd4e5 75%, #ffebf0 100%)';
            } else if (hour >= 18 && hour < 22) {
                // Soirée: couleurs plus profondes
                body.style.background = 'linear-gradient(135deg, #f8c8dc 0%, #dda0dd 25%, #e6c3e6 50%, #dda0dd 75%, #f8c8dc 100%)';
            } else {
                // Nuit: couleurs douces et apaisantes
                body.style.background = 'linear-gradient(135deg, #e6d5e6 0%, #d4c4dd 25%, #c8b4d8 50%, #d4c4dd 75%, #e6d5e6 100%)';
            }
            
            body.style.backgroundSize = '400% 400%';
            body.style.animation = 'gradientShift 15s ease infinite';
        }
        
        // Mettre à jour toutes les heures
        updateBackgroundByTime();
        setInterval(updateBackgroundByTime, 3600000);
        
        // ===== DÉMARRAGE DE TOUTES LES ANIMATIONS =====
        window.addEventListener('load', () => {
            initializeAnimations();
            
            // Animation d'entrée du contenu
            document.querySelectorAll('.container > *').forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
        
        // ===== PERFORMANCE: PAUSE ANIMATIONS WHEN TAB IS INACTIVE =====
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                document.querySelectorAll('.fleur, .snowflake, .particle, .floating-heart').forEach(el => {
                    el.style.animationPlayState = 'paused';
                });
            } else {
                document.querySelectorAll('.fleur, .snowflake, .particle, .floating-heart').forEach(el => {
                    el.style.animationPlayState = 'running';
                });
            }
        });
    </script>
</body>
</html>