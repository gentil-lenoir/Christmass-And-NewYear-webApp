FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# 1. Copier VOTRE application Laravel
COPY . .

# 2. CRÉER UN AUTOLOADER COMPLET POUR LARAVEL
RUN mkdir -p vendor
RUN cat > vendor/autoload.php << 'EOF'
<?php
// Autoloader complet pour Laravel RNDR

// 1. Charger les classes App\
spl_autoload_register(function ($class) {
    // Classes App\
    if (strpos($class, 'App\\') === 0) {
        $file = __DIR__ . '/../app/' . str_replace('\\', '/', substr($class, 4)) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
    
    // Classes Illuminate\ (Laravel core)
    if (strpos($class, 'Illuminate\\') === 0) {
        // Convertir Illuminate\Foundation\Application en chemin
        $parts = explode('\\', $class);
        if (count($parts) >= 2) {
            $vendor = strtolower($parts[0]); // 'illuminate'
            $package = strtolower($parts[1]); // 'foundation', 'support', etc.
            $subPath = implode('/', array_slice($parts, 2)); // 'Application'
            
            // Chercher dans plusieurs emplacements possibles
            $possiblePaths = [
                __DIR__ . "/../vendor/illuminate/{$package}/src/{$subPath}.php",
                __DIR__ . "/../vendor/illuminate/{$package}/{$subPath}.php",
                __DIR__ . "/../vendor/{$vendor}/{$package}/src/{$subPath}.php",
                __DIR__ . "/../vendor/{$vendor}/{$package}/{$subPath}.php",
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    require $path;
                    return;
                }
            }
        }
    }
});

// 2. Inclure manuellement les fichiers essentiels Laravel s'ils existent
$essentialFiles = [
    __DIR__ . '/../vendor/illuminate/support/helpers.php',
    __DIR__ . '/../vendor/illuminate/collections/helpers.php',
    __DIR__ . '/../vendor/symfony/polyfill-mbstring/bootstrap.php',
    __DIR__ . '/../vendor/symfony/polyfill-php80/bootstrap.php',
];

foreach ($essentialFiles as $file) {
    if (file_exists($file)) {
        require $file;
    }
}

// 3. Définir quelques constantes essentielles si elles n'existent pas
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

echo "<!-- Autoloader Laravel RNDR chargé -->\n";
?>
EOF

# 3. CRÉER UN FICHIER bootstrap/app.php SIMPLIFIÉ si manquant
RUN if [ ! -f bootstrap/app.php ] || grep -q "Illuminate\\\\Foundation\\\\Application" bootstrap/app.php; then \
    echo "Création/Correction de bootstrap/app.php..." && \
    cat > bootstrap/app.php << 'APP'
<?php
// Application Laravel simplifiée pour RNDR

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Http\Kernel;

// Créer l'application
$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Bindings importants
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
APP
    fi

# 4. CRÉER LES FICHIERS KERNEL ESSENTIELS s'ils manquent
RUN if [ ! -f app/Http/Kernel.php ]; then \
    echo "Création de app/Http/Kernel.php..." && \
    mkdir -p app/Http && \
    cat > app/Http/Kernel.php << 'KERNEL'
<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
KERNEL
    # fi

# 5. Configuration Nginx
RUN echo 'events{} http { server { listen 8080; root /var/www/public; index index.php; location / { try_files $uri $uri/ /index.php?$query_string; } location ~ \.php$ { fastcgi_pass 127.0.0.1:9000; include fastcgi_params; } } }' > /etc/nginx/nginx.conf

EXPOSE 8080
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"