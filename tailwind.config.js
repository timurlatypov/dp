module.exports = {
  prefix: 'tw-',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    fontFamily: {
      display: ['TTNorms', 'sans-serif'],
      body: ['TTNorms', 'sans-serif'],
    },
    extend: {
      colors: {
        cyan: '#9cdbff',
      },
      margin: {
        '96': '24rem',
        '128': '32rem',
      },
      fontSize: {
        'lg': ['1.125rem', { // Changed from default 1.125rem (18px)
          lineHeight: '1.5rem',
          letterSpacing: '-0.01em',
        }],
      },
    }
  },
  variants: {
    opacity: ['responsive', 'hover']
  },
  plugins: [],
}
