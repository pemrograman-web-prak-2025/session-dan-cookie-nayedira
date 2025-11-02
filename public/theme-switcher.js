function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const cname = name + "=";
    const decoded = decodeURIComponent(document.cookie);
    const parts = decoded.split(';');
    for (let i = 0; i < parts.length; i++) {
        let c = parts[i].trim();
        if (c.indexOf(cname) === 0) return c.substring(cname.length, c.length);
    }
    return null;
}

function setTheme(theme, persistCookie = true) {
    document.documentElement.setAttribute('data-theme', theme);
    // keep localStorage for backward compatibility
    try { localStorage.setItem('theme', theme); } catch(e) {}
    if (persistCookie) setCookie('theme', theme, 30);
    // update any toggle inputs on the page
    document.querySelectorAll('#theme-toggle').forEach(cb => {
        cb.checked = (theme === 'dark');
    });
}

function toggleTheme() {
    const current = getCookie('theme') || (localStorage.getItem('theme') || 'light');
    const next = current === 'light' ? 'dark' : 'light';
    setTheme(next, true);
}

// Initialize theme on load (cookie preferred)
document.addEventListener('DOMContentLoaded', () => {
    const cookieTheme = getCookie('theme');
    const stored = localStorage.getItem('theme');
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = cookieTheme || stored || (prefersDark ? 'dark' : 'light');
    setTheme(theme, false); // avoid re-setting cookie on init (cookie already read)

    // wire up any toggles (in case the input wasn't wired inline)
    document.querySelectorAll('#theme-toggle').forEach(cb => {
        cb.checked = (theme === 'dark');
        cb.addEventListener('change', () => {
            const newTheme = cb.checked ? 'dark' : 'light';
            setTheme(newTheme, true);
        });
    });
});