const API_BASE_URL = import.meta.env.VITE_API_BASE_URL ?? '/api'

export function trackVisit(): void {
  fetch(`${API_BASE_URL}/visits`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      path: window.location.pathname,
      referrer: document.referrer || null,
    }),
  }).catch(() => {
    // Falha silenciosa: não deve afetar a experiência do visitante.
  })
}
