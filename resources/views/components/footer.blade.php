<!-- Footer -->
<footer class="footer">
    @component('components.ads.social-bar')
    @endcomponent
    
    <h3 class="footer-logo">Joyeux Noël et Nouvel An</h3>
    <p class="footer-text">
        Un projet fait avec ❤️ pour rendre les fêtes encore plus spéciales. 
        Partagez l'amour, la joie et la magie de Noël avec tous vos proches.
    </p>
    
    <div class="social-icons">
        <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="https://www.effectivegatecpm.com/xspcjpn1?key=9ad6498b57e30e462d0980590cf05d4d" target="_blank" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
        <a href="https://www.effectivegatecpm.com/absjb07064?key=5258d3aa02a1038dea64f8e63a8cd16b" target="_blank" class="social-icon"><i class="fab fa-tiktok"></i></a>
        <a href="https://wa.me/?text=Savourez votre Nouvel An🥂 et Noël🎄 avec votre partenaire❤️❤️ ou votre ami(e)❤️ sur http://https://christmass-and-newyear.onrender.com et créez des cartes de voeux🎄, des lettres🎄, des textes à père noël🎄, des cadeaux🎄 .." target="_blank" class="social-icon"><i class="fas fa-share-alt"></i></a>
    </div>
    
    <p class="copyright">
        &copy; 2026 Joyeux Noël et Nouvel An. Tous droits réservés. 
        <br>🎄 Joyeux Noël 2026 et Bonne Année 2026 ! 🥂
        <br> Developpé et Programmé par <a href="https://gentil-lenoir.vercel.app" target="_blank" rel="noopener noreferrer">Gntil Le NoiR MaliyaMungu</a>
    </p>
</footer>

<style>
        /* ===== FOOTER STYLISÉ ===== */
        .footer {
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.9) 0%, 
                rgba(255, 240, 245, 0.95) 100%
            );
            padding: 10px;
            text-align: center;
            border-radius: 40px 40px 0 0;
            margin-top: 20px;
            border-top: 5px solid transparent;
            background-clip: padding-box;
            position: relative;
            box-shadow: 0 -10px 40px rgba(255, 182, 193, 0.2);
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, 
                var(--rose-principal), 
                var(--violet-doux), 
                var(--or),
                var(--rose-neon),
                var(--rose-principal)
            );
            background-size: 300% 100%;
            animation: footerBorderGradient 4s linear infinite;
        }
        
        @keyframes footerBorderGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }
        
        .footer-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 3.2rem;
            background: linear-gradient(45deg, 
                var(--rose-fonce), 
                var(--violet-doux),
                var(--rose-neon)
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 25px;
            animation: footerLogoFloat 4s ease-in-out infinite;
            filter: drop-shadow(0 0 10px rgba(255, 182, 193, 0.4));
        }
        
        @keyframes footerLogoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        .footer-text {
            color: #7a6a6a;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.8;
            font-size: 1.05rem;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .social-icon {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--rose-clair), var(--lavande));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--rose-fonce);
            font-size: 1.4rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 5px 15px rgba(255, 182, 193, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .social-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--rose-neon), var(--violet-doux));
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
            z-index: 0;
        }
        
        .social-icon:hover::before {
            width: 100px;
            height: 100px;
        }
        
        .social-icon i {
            position: relative;
            z-index: 1;
        }
        
        .social-icon:hover {
            color: black;
            transform: translateY(-8px) scale(1.15) rotate(360deg);
            box-shadow: 
                0 10px 25px rgba(255, 105, 180, 0.5),
                0 0 20px rgba(255, 182, 193, 0.4);
        }
        
        .copyright {
            color: #9a8a8a;
            font-size: 0.95rem;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid var(--rose-clair);
            opacity: 0.9;
        }
        
</style>