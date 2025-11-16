(() => {
  const qs = (s, r = document) => r.querySelector(s);
  const body = document.body;

  const toggles = [
    { id: 'btn-readable', cls: 'a11y-readable' },
    { id: 'btn-bigtext', cls: 'a11y-bigtext' },
    { id: 'btn-contrast', cls: 'a11y-contrast' },
  ];

  toggles.forEach(({ id, cls }) => {
    const btn = qs(`#${id}`);
    if (!btn) return;
    btn.addEventListener('click', () => {
      const active = body.classList.toggle(cls);
      btn.setAttribute('aria-pressed', String(active));
    });
  });

  const bubble = qs('#helpBubble');
  const tooltip = qs('#helpTooltip');
  const close = qs('#helpClose');
  if (bubble && tooltip) {
    const setOpen = (open) => {
      bubble.setAttribute('aria-expanded', String(open));
      tooltip.setAttribute('aria-hidden', String(!open));
    };
    setOpen(false);
    bubble.addEventListener('click', () => setOpen(tooltip.getAttribute('aria-hidden') === 'true'));
    close && close.addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setOpen(false);
    });
  }
})();

