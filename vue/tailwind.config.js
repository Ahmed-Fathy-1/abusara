/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        primary: '#88b06a',
        body: '#e9ecef',
        footer: '#202124'
      },
      fontFamily: {
        primary: ['system-ui', 'sans-serif'],
        secondary: ['system-ui', 'sans-serif']
      },
      container: {
        center: true
      },
      screens: {
        sm: '640.999999px',
        md: '768.999999px',
        lg: '1024.999999px',
        xl: '1280.999999px',
        '2xl': '1536.999999px'
      }
    }
  },
  plugins: []
}
