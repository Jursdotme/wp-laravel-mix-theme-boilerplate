module.exports = {
  content: [
    './templates/**/**/*.php',
    './templates/**/**/*.vue',
    './header.php',
    './index.php',
    './footer.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography'),],
}
