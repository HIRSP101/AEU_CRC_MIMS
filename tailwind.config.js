/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {},
      fontFamily:{
        siemreap: ['Siemreap', 'sans-serif'],
        koulen: ["Koulen", "serif"],
        battambang: ["Battambang", "serif"]
      }
    
    },
    plugins: [],
  
  }