/**
 * Aprende Idiomas · Cookie consent banner (self-contained)
 *
 * Se carga con: <script src="/libraries/js/cookie-banner.js" defer></script>
 * Guarda la preferencia en localStorage y no muestra de nuevo.
 * Soporta: aceptar todas / rechazar / mas info
 */
(function() {
    'use strict';

    var STORAGE_KEY = 'ai_cookie_consent';
    // Reaparece si han pasado más de 6 meses
    var MAX_AGE_DAYS = 180;

    // Si ya consintió recientemente, no mostrar
    try {
        var saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            var parsed = JSON.parse(saved);
            var ageDays = (Date.now() - parsed.ts) / (1000 * 60 * 60 * 24);
            if (ageDays < MAX_AGE_DAYS) return;
        }
    } catch (e) { /* ignore */ }

    function render() {
        var style = document.createElement('style');
        style.textContent = `
            .ai-cookie-banner{position:fixed;left:16px;right:16px;bottom:16px;max-width:520px;margin:0 auto;background:#0a0a0f;color:#fff;border-radius:20px;padding:22px 24px;box-shadow:0 24px 64px rgba(0,0,0,.35),0 4px 12px rgba(0,0,0,.2);z-index:99999;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;animation:aiCookieIn .4s cubic-bezier(.2,.8,.2,1)}
            .ai-cookie-banner::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 80% 20%,rgba(236,19,137,.18),transparent 60%),radial-gradient(circle at 20% 80%,rgba(0,182,237,.18),transparent 60%);border-radius:20px;pointer-events:none}
            .ai-cookie-banner > *{position:relative;z-index:1}
            .ai-cookie-head{display:flex;align-items:center;gap:10px;margin-bottom:10px}
            .ai-cookie-icon{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#ec1389,#00b6ed);display:inline-flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0}
            .ai-cookie-title{font-family:'Sora','Inter',sans-serif;font-size:1.02rem;font-weight:700;color:#fff;letter-spacing:-0.02em}
            .ai-cookie-text{font-size:.88rem;line-height:1.55;color:rgba(255,255,255,.75);margin-bottom:16px}
            .ai-cookie-text a{color:#00b6ed;text-decoration:underline;font-weight:600}
            .ai-cookie-text a:hover{color:#ec1389}
            .ai-cookie-btns{display:flex;gap:8px;flex-wrap:wrap}
            .ai-cookie-btn{flex:1;min-width:110px;padding:12px 16px;border-radius:999px;font-family:inherit;font-weight:700;font-size:.88rem;border:none;cursor:pointer;transition:all .2s cubic-bezier(.2,.8,.2,1);white-space:nowrap}
            .ai-cookie-btn-primary{background:linear-gradient(135deg,#ec1389,#00b6ed);color:#fff;box-shadow:0 8px 24px rgba(236,19,137,.32)}
            .ai-cookie-btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(236,19,137,.45)}
            .ai-cookie-btn-ghost{background:rgba(255,255,255,.08);color:#fff;border:1px solid rgba(255,255,255,.15)}
            .ai-cookie-btn-ghost:hover{background:rgba(255,255,255,.14)}
            .ai-cookie-btn-link{background:transparent;color:rgba(255,255,255,.6);border:none;text-decoration:underline;padding:12px 8px;font-size:.82rem;flex:0 0 auto;min-width:0}
            .ai-cookie-btn-link:hover{color:#fff}
            @keyframes aiCookieIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
            @keyframes aiCookieOut{to{opacity:0;transform:translateY(20px)}}
            .ai-cookie-banner.is-closing{animation:aiCookieOut .25s ease-out forwards}
            @media(max-width:560px){
                .ai-cookie-banner{left:8px;right:8px;bottom:8px;padding:18px 20px;border-radius:16px}
                .ai-cookie-btns{flex-direction:column;gap:6px}
                .ai-cookie-btn{flex:1 0 100%}
                .ai-cookie-btn-link{order:3}
            }
            @media(prefers-reduced-motion:reduce){
                .ai-cookie-banner{animation:none}
                .ai-cookie-btn{transition:none}
            }
        `;
        document.head.appendChild(style);

        var banner = document.createElement('div');
        banner.className = 'ai-cookie-banner';
        banner.setAttribute('role', 'dialog');
        banner.setAttribute('aria-live', 'polite');
        banner.setAttribute('aria-label', 'Aviso de cookies');
        banner.innerHTML = '' +
            '<div class="ai-cookie-head">' +
                '<span class="ai-cookie-icon" aria-hidden="true">🍪</span>' +
                '<span class="ai-cookie-title">Usamos cookies</span>' +
            '</div>' +
            '<p class="ai-cookie-text">' +
                'Usamos cookies propias y de terceros para mejorar tu experiencia y mostrarte contenido relevante. ' +
                'Podés aceptar todas, rechazarlas o leer <a href="/politicas-de-cookies/">más información</a>.' +
            '</p>' +
            '<div class="ai-cookie-btns">' +
                '<button class="ai-cookie-btn ai-cookie-btn-ghost" data-action="reject">Rechazar</button>' +
                '<button class="ai-cookie-btn ai-cookie-btn-primary" data-action="accept">Aceptar todas</button>' +
                '<a class="ai-cookie-btn ai-cookie-btn-link" href="/politicas-de-cookies/">Más info</a>' +
            '</div>';
        document.body.appendChild(banner);

        function save(choice) {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify({
                    choice: choice,
                    ts: Date.now()
                }));
            } catch (e) { /* ignore */ }
        }

        function close(choice) {
            save(choice);
            banner.classList.add('is-closing');
            setTimeout(function() { banner.remove(); }, 250);
            // Emit event for downstream scripts (GTM, consent-gated tracking)
            try {
                window.dispatchEvent(new CustomEvent('ai:cookie-consent', {
                    detail: { choice: choice }
                }));
            } catch (e) { /* older browsers */ }
        }

        banner.addEventListener('click', function(e) {
            var t = e.target;
            if (t.matches('[data-action="accept"]')) close('accept');
            else if (t.matches('[data-action="reject"]')) close('reject');
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', render);
    } else {
        render();
    }
})();
