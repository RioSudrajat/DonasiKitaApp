// Service Worker for DonasiKita PWA
const CACHE_NAME = 'donasikita-v3';
const OFFLINE_URL = '/offline.html';

const urlsToCache = [
    '/',
    '/offline.html',
    '/css/app.css',
    '/js/app.js',
    '/js/bootstrap.js',
    '/manifest.json',
    '/images/icon-192x192.png',
    '/images/icon-512x512.png',
    '/images/icon-192x192-maskable.png',
    '/images/icon-512x512-maskable.png'
];

// Install event - cache essential files
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                return cache.addAll(urlsToCache.filter(url => url !== OFFLINE_URL))
                    .catch((err) => {
                        console.log('Cache addAll error:', err);
                    });
            })
            .then(() => {
                // Cache offline page separately to handle errors
                return caches.open(CACHE_NAME)
                    .then((cache) => {
                        return fetch(OFFLINE_URL)
                            .then((response) => cache.put(OFFLINE_URL, response))
                            .catch(() => console.log('Could not cache offline page'));
                    });
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME && cacheName !== 'offline') {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Fetch event - Network first, fallback to cache
self.addEventListener('fetch', (event) => {
    const { request } = event;

    // Skip POST requests, non-GET requests, and external requests
    if (request.method !== 'GET' || !request.url.startsWith(self.location.origin)) {
        return;
    }

    event.respondWith(
        fetch(request)
            .then((response) => {
                // Don't cache if not a success response
                if (!response || response.status !== 200 || response.type === 'error') {
                    return response;
                }

                // Clone the response
                const responseToCache = response.clone();

                // Cache successful HTML, CSS, JS responses
                if (shouldCache(request.url)) {
                    caches.open(CACHE_NAME)
                        .then((cache) => {
                            cache.put(request, responseToCache);
                        });
                }

                return response;
            })
            .catch(() => {
                // Network failed - serve from cache
                return caches.match(request)
                    .then((response) => {
                        if (response) {
                            return response;
                        }

                        // If it's a navigation request, show offline page
                        if (request.mode === 'navigate') {
                            return caches.match(OFFLINE_URL);
                        }

                        return new Response('Offline - Resource not available', {
                            status: 503,
                            statusText: 'Service Unavailable',
                            headers: new Headers({
                                'Content-Type': 'text/plain'
                            })
                        });
                    });
            })
    );
});

// Helper function to determine if URL should be cached
function shouldCache(url) {
    const pathsToCache = [
        '.html',
        '.css',
        '.js',
        '.json',
        '.png',
        '.jpg',
        '.jpeg',
        '.gif',
        '.svg',
        '.woff',
        '.woff2'
    ];

    return pathsToCache.some((path) => url.includes(path));
}

// Listen for messages from clients
self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});
