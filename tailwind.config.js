module.exports = {
  content: [
    './templates/**/**/*.php',
    './header.php',
    './index.php',
    './footer.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography'),],
}
