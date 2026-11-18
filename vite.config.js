import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath } from 'node:url'

const js = fileURLToPath(new URL('./resources/js', import.meta.url))

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/js/home.js',
        'resources/sass/app.scss',
        'resources/sass/home.scss',
        'resources/sass/themes/default-theme.scss',
        'resources/sass/themes/gray-theme.scss',
      ],
    }),
    vue({
      template: {
        compilerOptions: {
          whitespace: 'preserve',
        },
      },
    }),
  ],
  resolve: {
    extensions: ['.mjs', '.js', '.json', '.vue'],
    alias: [
      { find: /^vue$/, replacement: 'vue/dist/vue.esm-bundler.js' },
      { find: /^~(.+)/, replacement: '$1' },
      { find: /^(config|lang|plugins|vendor|dashboard|home)\//, replacement: `${js}/$1/` },
      { find: /^js\//, replacement: `${js}/` },
    ],
  },
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler',
        quietDeps: true,
        silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'slash-div'],
      },
    },
  },
})
