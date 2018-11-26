<template>
     <div id="app">
        <v-app id="inspire">
            <v-navigation-drawer
              fixed
              :clipped="$vuetify.breakpoint.mdAndUp"
              app
              v-model="drawer"
              absolute>
              <side-bar></side-bar>
            </v-navigation-drawer>
            
            <v-toolbar
              flat
              color="pink"
              dark
              app
              :clipped-left="$vuetify.breakpoint.mdAndUp"
              fixed
              class="transparent">
              <v-toolbar-title >
                  <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                  <span class="hidden-sm-and-down"><img src="#" height="30" width="140" alt=""></span>
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <!-- <full-screen></full-screen> -->
              <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
              <v-btn icon large flat slot="activator">
                <v-avatar size="30px">
                  <img v-bind:src="url" alt="Michael Wang" class="avata-image" />
                </v-avatar>
              </v-btn>
              <v-list class="pa-0">
                <v-list-tile v-for="(item,index) in items" :to="!item.href ? { name: item.name } : null" :href="item.href" @click="item.click" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="index">
                  <v-list-tile-action v-if="item.icon">
                    <v-icon>{{ item.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-menu>
            </v-toolbar>
         

            <v-content>
              <v-container>
                  <router-view></router-view>
              </v-container>
            </v-content>
      </v-app>
    </div>
</template>

<script>
  import Vue from 'vue'
  import Vuetify from 'vuetify'
  import 'vuetify/dist/vuetify.min.css'
  import 'material-design-icons-iconfont/dist/material-design-icons.css'
  import SideBar from './partials/Sidebar.vue'
  import Header from './partials/Header.vue'
  import auth from '../auth/index.js'

  Vue.use(Vuetify,{
    iconfont: 'md'
  })
export default {
  name: 'Dashboard',

  data () {
   return {
        height: $(window).height(),
        hidden: 'auto',
        dialog: false,
        drawer: null,
        url:'#',
        items: [
        {
          icon: 'account_circle',
          href: '#',
          title: 'Profile',
          click: (e) => {
            console.log(e);
          }
        },
        {
          icon: 'settings',
          href: '#',
          title: 'Settings',
          click: (e) => {
            console.log(e);
          }
        },
        {
          icon: 'fullscreen_exit',
          href: '#',
          title: 'Logout',
          click: (e) => {
            // localStorage.removeItem('access_token')
            // this.$router.push('/login');
             auth.logout()
          }
        }
      ],
      }
  },
  components: {
      'side-bar':SideBar,
      'app-header':Header
    }
}
</script>

<style lang="css" scoped>
</style>