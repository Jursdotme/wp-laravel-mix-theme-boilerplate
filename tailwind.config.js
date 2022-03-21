module.exports = {
  content: [
    './templates/**/**/*.php',
    './templates/**/**/*.vue',
    './header.php',
    './index.php',
    './footer.php',
    './404.php',
    './archive.php',
    './front-page.php',
    './page.php',
    './searcg.php',
    './sidebar.php',
    './single.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography'),],
}
