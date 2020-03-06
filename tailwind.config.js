module.exports = {
  prefix: 'tw-',
  important: true,
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
    }
  },
  variants: {
    opacity: ['responsive', 'hover']
  },
}
