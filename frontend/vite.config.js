import { fileURLToPath, URL } from "url";
import { defineConfig } from "vite";
import { createVuePlugin } from "vite-plugin-vue2";
import { VuetifyResolver } from "unplugin-vue-components/resolvers";
import Components from "unplugin-vue-components/vite";
import path from "path";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    createVuePlugin(/* options */),
    Components({
      resolvers: [
        // Vuetify
        VuetifyResolver(),
      ],
    }),
  ],
  server: {
    host: "127.0.0.1",
    port: 8080,
  },
  resolve: {
    symlinks: false,
    alias: [
      {
        find: "@",
        replacement: fileURLToPath(new URL("./src", import.meta.url)),
      },
      {
        find: "vue",
        replacement: path.resolve(__dirname, 'node_modules/vue/dist/vue.runtime.esm.js'),
      },
      
    ],
    
    extensions: [".js", ".ts", ".tsx", ".jsx", ".vue"],
  },
});
