/* Chat IA Widget - Aprende Idiomas */
(function () {
  if (window.__aiChatLoaded) return;
  window.__aiChatLoaded = true;

  var ENDPOINT = '/a-includes/chat-ia.php';
  var STORAGE_KEY = 'ai_chat_history_v1';
  var MAX_HISTORY = 10;

  var SUGGESTIONS = [
    '¿Qué cursos tienen?',
    '¿Cómo es el pago?',
    '¿El acceso es inmediato?',
    '¿Cuánto dura el curso?'
  ];

  var WELCOME = '¡Hola! Soy el asistente de Aprende Idiomas. Puedo ayudarte con consultas sobre los cursos y el proceso de compra. ¿En qué te ayudo?';

  function el(tag, attrs, children) {
    var e = document.createElement(tag);
    if (attrs) for (var k in attrs) {
      if (k === 'class') e.className = attrs[k];
      else if (k === 'html') e.innerHTML = attrs[k];
      else e.setAttribute(k, attrs[k]);
    }
    (children || []).forEach(function (c) {
      e.appendChild(typeof c === 'string' ? document.createTextNode(c) : c);
    });
    return e;
  }

  function loadHistory() {
    try { return JSON.parse(sessionStorage.getItem(STORAGE_KEY)) || []; }
    catch (e) { return []; }
  }
  function saveHistory(h) {
    try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(h.slice(-MAX_HISTORY))); } catch (e) {}
  }

  function linkify(text) {
    // Escape HTML
    var safe = text.replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
    // Links a rutas /curso/
    safe = safe.replace(/(^|\s)(\/[a-z0-9\-]+\/)(?=\s|$|[.,;:!?])/gi, function (_, pre, path) {
      return pre + '<a href="' + path + '">' + path + '</a>';
    });
    // Links http(s)
    safe = safe.replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener">$1</a>');
    return safe;
  }

  var history = loadHistory();

  // ---- Markup ----
  var fabIcon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>';
  var avatarIcon = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a5 5 0 0 1 5 5v2a5 5 0 1 1-10 0V7a5 5 0 0 1 5-5zm-7 18.5c0-3.5 3.5-5.5 7-5.5s7 2 7 5.5V22H5v-1.5z"/></svg>';
  var sendIcon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4z"/></svg>';

  var fab = el('button', { id: 'ai-chat-fab', 'aria-label': 'Abrir chat de ayuda', html: fabIcon });
  var panel = el('div', { id: 'ai-chat-panel', role: 'dialog', 'aria-label': 'Chat de ayuda' });

  var header = el('div', { id: 'ai-chat-header' }, [
    el('div', { class: 'ai-chat-avatar', html: avatarIcon }),
    el('div', { class: 'ai-chat-title', html: '<strong>Asistente</strong><small>Consultas sobre cursos</small>' }),
    el('button', { 'aria-label': 'Cerrar', id: 'ai-chat-close' }, ['×'])
  ]);

  var messages = el('div', { id: 'ai-chat-messages' });
  var suggestions = el('div', { id: 'ai-chat-suggestions' });
  var form = el('form', { id: 'ai-chat-form', autocomplete: 'off' });
  var input = el('input', { type: 'text', placeholder: 'Escribí tu consulta...', maxlength: '500' });
  var sendBtn = el('button', { type: 'submit', 'aria-label': 'Enviar', html: sendIcon });
  form.appendChild(input);
  form.appendChild(sendBtn);

  var footer = el('div', { id: 'ai-chat-footer' }, ['Respuestas automáticas · solo temas del sitio']);

  panel.appendChild(header);
  panel.appendChild(messages);
  panel.appendChild(suggestions);
  panel.appendChild(form);
  panel.appendChild(footer);

  var root = el('div', { id: 'ai-chat-root' });
  root.appendChild(fab);
  root.appendChild(panel);
  document.body.appendChild(root);

  function renderMessage(role, text) {
    var msg = el('div', { class: 'ai-chat-msg ' + (role === 'user' ? 'user' : 'bot') });
    if (role === 'user') msg.textContent = text;
    else msg.innerHTML = linkify(text);
    messages.appendChild(msg);
    messages.scrollTop = messages.scrollHeight;
  }

  function renderTyping(show) {
    var existing = messages.querySelector('.ai-chat-typing');
    if (existing) existing.remove();
    if (show) {
      var t = el('div', { class: 'ai-chat-typing', html: '<span></span><span></span><span></span>' });
      messages.appendChild(t);
      messages.scrollTop = messages.scrollHeight;
    }
  }

  function renderSuggestions() {
    suggestions.innerHTML = '';
    if (history.length >= 2) return; // ocultar tras primer turno
    SUGGESTIONS.forEach(function (s) {
      var b = el('button', { type: 'button' }, [s]);
      b.addEventListener('click', function () { send(s); });
      suggestions.appendChild(b);
    });
  }

  function initConversation() {
    messages.innerHTML = '';
    if (history.length === 0) {
      renderMessage('assistant', WELCOME);
    } else {
      history.forEach(function (m) { renderMessage(m.role, m.content); });
    }
    renderSuggestions();
  }

  function openPanel() {
    panel.classList.add('open');
    setTimeout(function () { input.focus(); }, 100);
  }
  function closePanel() { panel.classList.remove('open'); }

  fab.addEventListener('click', function () {
    if (panel.classList.contains('open')) closePanel();
    else { initConversation(); openPanel(); }
  });
  header.querySelector('#ai-chat-close').addEventListener('click', closePanel);

  var sending = false;
  function send(text) {
    text = (text || '').trim();
    if (!text || sending) return;
    sending = true;
    sendBtn.disabled = true;
    input.value = '';

    history.push({ role: 'user', content: text });
    saveHistory(history);
    renderMessage('user', text);
    renderSuggestions();
    renderTyping(true);

    fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ messages: history })
    })
      .then(function (r) { return r.json().then(function (j) { return { status: r.status, json: j }; }); })
      .then(function (res) {
        renderTyping(false);
        if (res.json && res.json.ok && res.json.reply) {
          history.push({ role: 'assistant', content: res.json.reply });
          saveHistory(history);
          renderMessage('assistant', res.json.reply);
        } else {
          renderMessage('assistant', (res.json && res.json.error) || 'Ocurrió un problema. Probá de nuevo.');
        }
      })
      .catch(function () {
        renderTyping(false);
        renderMessage('assistant', 'No pudimos conectar. Revisá tu internet e intentá de nuevo.');
      })
      .finally(function () {
        sending = false;
        sendBtn.disabled = false;
        input.focus();
      });
  }

  form.addEventListener('submit', function (ev) {
    ev.preventDefault();
    send(input.value);
  });
})();
