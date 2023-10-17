import '@fortawesome/fontawesome-free/css/all.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import colors from 'vuetify/lib/util/colors'

Vue.use(Vuetify);

export default new Vuetify({
    icons: {
        iconfont: 'md' || 'fa' || 'mdi'
    },
    theme: {
        themes: {
          light: {
            primary: colors.orange,
            secondary: colors.grey.darken1,
            font1: colors.white,
            accent: colors.shades.black,
            error: colors.red.accent3,
          },
          dark: {
            primary: colors.grey.darken3,
            font2: colors.white,
            biru: colors.blue,
          },
        },
      },
});
