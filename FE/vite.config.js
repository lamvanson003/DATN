import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  build: {
    chunkSizeWarningLimit: 2000, // Tăng giới hạn cảnh báo (nếu cần)
    rollupOptions: {
      output: {
        manualChunks: {
          vendor: ["react", "react-dom"], // Chia các thư viện lớn
        },
      },
    },
  },
});