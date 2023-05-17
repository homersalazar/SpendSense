/** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
    theme: {
      extend: {
        colors: {
            pc: '#365A08',
            sc: '#5D9D0B',
            tc: '#72EB3A',
            bg: '#fdfbd2',
            card: '#bfda84',
            cardTitle: '#efef99',
        },
      },
    },
    plugins: [],
  }
