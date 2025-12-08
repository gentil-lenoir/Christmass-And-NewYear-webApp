<!-- Composant Bouton Home Flottant -->
<div id="floatingHome" class="floating-home-container">
    <a href="/" class="floating-home-btn" id="floatingHomeBtn">
        <i class="fas fa-home"></i>
        <span class="home-tooltip">Accueil</span>
    </a>
</div>

<style>
    /* ===== COMPOSANT HOME FLOTTANT ===== */
    .floating-home-container {
        position: fixed;
        top: 25px;
        left: 25px;
        z-index: 9999;
        animation: homeFloat 3s infinite ease-in-out;
    }
    
    @keyframes homeFloat {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-5px) rotate(5deg);
        }
    }
    
    .floating-home-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--rose-fonce, #ff8fa3), var(--rose-principal, #ffb6c1));
        border-radius: 50%;
        color: white;
        font-size: 1.8rem;
        text-decoration: none;
        box-shadow: 
            0 10px 25px rgba(255, 143, 163, 0.4),
            0 0 0 3px rgba(255, 255, 255, 0.2),
            inset 0 2px 5px rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        border: none;
        cursor: pointer;
    }
    
    .floating-home-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .floating-home-btn:hover {
        transform: scale(1.15) rotate(15deg);
        box-shadow: 
            0 15px 35px rgba(255, 143, 163, 0.6),
            0 0 0 5px rgba(255, 255, 255, 0.3),
            inset 0 2px 8px rgba(255, 255, 255, 0.4);
        background: linear-gradient(135deg, var(--rose-principal, #ffb6c1), var(--violet-doux, #d8b4fe));
    }
    
    .floating-home-btn:hover::before {
        transform: translateX(100%);
    }
    
    .floating-home-btn:active {
        transform: scale(0.95) rotate(0deg);
        transition: all 0.1s ease;
    }
    
    /* Tooltip */
    .home-tooltip {
        position: absolute;
        top: 50%;
        left: 70px;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        pointer-events: none;
        backdrop-filter: blur(5px);
    }
    
    .home-tooltip::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -6px;
        transform: translateY(-50%);
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 6px solid rgba(0, 0, 0, 0.8);
    }
    
    .floating-home-btn:hover .home-tooltip {
        opacity: 1;
        visibility: visible;
        left: 75px;
    }
    
    /* Animation de notification */
    @keyframes homePulse {
        0% {
            box-shadow: 
                0 10px 25px rgba(255, 143, 163, 0.4),
                0 0 0 3px rgba(255, 255, 255, 0.2);
        }
        50% {
            box-shadow: 
                0 10px 25px rgba(255, 143, 163, 0.4),
                0 0 0 8px rgba(255, 182, 193, 0.3);
        }
        100% {
            box-shadow: 
                0 10px 25px rgba(255, 143, 163, 0.4),
                0 0 0 3px rgba(255, 255, 255, 0.2);
        }
    }
    
    .floating-home-btn.new-notification {
        animation: homePulse 2s infinite;
    }
    
    /* Badge de notification */
    .home-notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 22px;
        height: 22px;
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        color: white;
        border-radius: 50%;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 8px rgba(255, 107, 107, 0.4);
        animation: badgePulse 1.5s infinite;
    }
    
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .floating-home-container {
            top: 15px;
            left: 15px;
        }
        
        .floating-home-btn {
            width: 55px;
            height: 55px;
            font-size: 1.6rem;
        }
        
        .home-tooltip {
            display: none;
        }
        
        .floating-home-btn:hover {
            transform: scale(1.1) rotate(10deg);
        }
    }
    
    @media (max-width: 480px) {
        .floating-home-container {
            top: 10px;
            left: 10px;
        }
        
        .floating-home-btn {
            width: 50px;
            height: 50px;
            font-size: 1.4rem;
        }
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .floating-home-btn {
            box-shadow: 
                0 10px 25px rgba(0, 0, 0, 0.3),
                0 0 0 3px rgba(255, 255, 255, 0.1);
        }
        
        .floating-home-btn:hover {
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.4),
                0 0 0 5px rgba(255, 255, 255, 0.2);
        }
    }
</style>

<script>
    // ===== GESTION DU COMPOSANT HOME =====
    document.addEventListener('DOMContentLoaded', function() {
        const homeBtn = document.getElementById('floatingHomeBtn');
        const homeContainer = document.getElementById('floatingHome');
        
        // Vérifier si on est déjà sur la page d'accueil
        if (window.location.pathname === '/') {
            homeBtn.classList.add('new-notification');
            homeBtn.innerHTML = '<i class="fas fa-star"></i><span class="home-tooltip">Vous êtes à l\'accueil</span>';
            
            // Retirer l'animation après 5 secondes
            setTimeout(() => {
                homeBtn.classList.remove('new-notification');
            }, 5000);
        }
        
        // Vérifier les nouvelles notifications
        checkForNotifications();
        
        // Animation au clic
        homeBtn.addEventListener('click', function(e) {
            // Animation de clic
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Sauvegarder la position actuelle pour retour possible
            if (window.location.pathname !== '/') {
                sessionStorage.setItem('previousPage', window.location.href);
            }
        });
        
        // Effet au survol pour mobile (touch)
        homeBtn.addEventListener('touchstart', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        homeBtn.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        
        // Cacher le bouton lors du défilement (optionnel)
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Défilement vers le bas - cacher
                homeContainer.style.opacity = '0.5';
                homeContainer.style.transform = 'translateX(-10px)';
            } else {
                // Défilement vers le haut ou haut de page - montrer
                homeContainer.style.opacity = '1';
                homeContainer.style.transform = 'translateX(0)';
            }
            
            lastScrollTop = scrollTop;
        });
        
        // Fonction pour vérifier les notifications
        function checkForNotifications() {
            // Vérifier dans le localStorage
            const hasNewMessages = localStorage.getItem('hasNewMessages');
            const unreadLetters = JSON.parse(localStorage.getItem('unreadLetters')) || [];
            
            if (hasNewMessages || unreadLetters.length > 0) {
                addNotificationBadge(unreadLetters.length);
            }
            
            // Vérifier périodiquement
            setInterval(() => {
                const updatedUnread = JSON.parse(localStorage.getItem('unreadLetters')) || [];
                if (updatedUnread.length > 0) {
                    updateNotificationBadge(updatedUnread.length);
                } else {
                    removeNotificationBadge();
                }
            }, 30000); // Toutes les 30 secondes
        }
        
        function addNotificationBadge(count) {
            if (!document.querySelector('.home-notification-badge')) {
                const badge = document.createElement('div');
                badge.className = 'home-notification-badge';
                badge.textContent = count > 99 ? '99+' : count;
                badge.title = `${count} nouvelle(s) notification(s)`;
                homeBtn.appendChild(badge);
                
                // Animation de notification
                homeBtn.classList.add('new-notification');
            }
        }
        
        function updateNotificationBadge(count) {
            const badge = document.querySelector('.home-notification-badge');
            if (badge) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.title = `${count} nouvelle(s) notification(s)`;
            } else {
                addNotificationBadge(count);
            }
        }
        
        function removeNotificationBadge() {
            const badge = document.querySelector('.home-notification-badge');
            if (badge) {
                badge.remove();
                homeBtn.classList.remove('new-notification');
            }
        }
        
        // Ajouter un effet de confettis au clic (optionnel)
        homeBtn.addEventListener('click', function() {
            if (window.location.pathname === '/') {
                createHomeConfetti();
            }
        });
        
        function createHomeConfetti() {
            const colors = ['#ff8fa3', '#ffb6c1', '#d8b4fe', '#a5f3fc', '#ffd700'];
            
            for (let i = 0; i < 20; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.style.position = 'fixed';
                    confetti.style.width = '10px';
                    confetti.style.height = '10px';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.borderRadius = '50%';
                    confetti.style.top = '50px';
                    confetti.style.left = '50px';
                    confetti.style.zIndex = '9998';
                    confetti.style.pointerEvents = 'none';
                    confetti.style.opacity = '0.8';
                    
                    document.body.appendChild(confetti);
                    
                    // Animation
                    const angle = Math.random() * Math.PI * 2;
                    const velocity = 2 + Math.random() * 3;
                    const gravity = 0.1;
                    let x = 50;
                    let y = 50;
                    let vx = Math.cos(angle) * velocity;
                    let vy = Math.sin(angle) * velocity;
                    
                    function animate() {
                        x += vx;
                        y += vy;
                        vy += gravity;
                        
                        confetti.style.left = x + 'px';
                        confetti.style.top = y + 'px';
                        confetti.style.opacity = parseFloat(confetti.style.opacity) - 0.01;
                        
                        if (parseFloat(confetti.style.opacity) > 0 && y < window.innerHeight) {
                            requestAnimationFrame(animate);
                        } else {
                            confetti.remove();
                        }
                    }
                    
                    animate();
                }, i * 50);
            }
        }
        
        // Raccourci clavier (Alt+H ou Cmd/Ctrl+H)
        document.addEventListener('keydown', function(e) {
            if ((e.altKey || e.metaKey) && e.key === 'h') {
                e.preventDefault();
                homeBtn.click();
            }
        });
        
        // Info tooltip au chargement
        setTimeout(() => {
            homeBtn.classList.add('new-notification');
            setTimeout(() => {
                homeBtn.classList.remove('new-notification');
            }, 2000);
        }, 1000);
    });
    
    // ===== FONCTION EXPORTÉE POUR AJOUTER DES NOTIFICATIONS =====
    function addHomeNotification(count = 1) {
        const homeBtn = document.getElementById('floatingHomeBtn');
        if (!homeBtn) return;
        
        const existingBadge = homeBtn.querySelector('.home-notification-badge');
        let currentCount = 0;
        
        if (existingBadge) {
            const badgeText = existingBadge.textContent;
            currentCount = badgeText === '99+' ? 100 : parseInt(badgeText) || 0;
        }
        
        const newCount = currentCount + count;
        
        if (existingBadge) {
            existingBadge.textContent = newCount > 99 ? '99+' : newCount;
            existingBadge.title = `${newCount} nouvelle(s) notification(s)`;
        } else {
            const badge = document.createElement('div');
            badge.className = 'home-notification-badge';
            badge.textContent = newCount > 99 ? '99+' : newCount;
            badge.title = `${newCount} nouvelle(s) notification(s)`;
            homeBtn.appendChild(badge);
        }
        
        homeBtn.classList.add('new-notification');
        
        // Retirer l'animation après 5 secondes
        setTimeout(() => {
            homeBtn.classList.remove('new-notification');
        }, 5000);
    }
    
    // ===== FONCTION POUR SUPPRIMER LES NOTIFICATIONS =====
    function clearHomeNotifications() {
        const homeBtn = document.getElementById('floatingHomeBtn');
        if (!homeBtn) return;
        
        const badge = homeBtn.querySelector('.home-notification-badge');
        if (badge) {
            badge.remove();
            homeBtn.classList.remove('new-notification');
        }
    }
</script>