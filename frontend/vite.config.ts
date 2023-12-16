import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  server: {    // <-- this object is added
    port: 3010
  },
  plugins: [vue()]
})

