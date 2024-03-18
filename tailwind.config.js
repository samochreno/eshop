/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  safelist: [
  ],
  theme: {
    colors: {
        'primary':   'var(--color-primary)',
        'secondary': 'var(--color-secondary)',
        'tertiary':  'var(--color-tertiary)',

        'detail':      'var(--color-detail)',
        'detail-soft': 'var(--color-detail-soft)',

        'info':    'var(--color-info)',
        'success': 'var(--color-success)',
        'danger':  'var(--color-danger)',
        'warning': 'var(--color-warning)',
    },
    fontSize: {
      'xs': '0.725rem',
      'sm': '0.95rem',
      'md': '1.1rem',
      'lg': '1.5rem',
      'xl': '2rem',
      '2xl': '2.5rem',
    },
    boxShadow: {
      'sm': '0 0 5px 5px var(--color-shadow-sm)',
      'md': '0 0 8px 8px var(--color-shadow-md)',
      'cn': '0 8px 20px 12px var(--color-shadow-cn)',
    },
    dropShadow: {
      'sm': '0 0px 8px var(--color-drop-shadow-sm)',
      'cn': '0 0px 10px var(--color-drop-shadow-cn)',
    },
  },
  plugins: [],
}

