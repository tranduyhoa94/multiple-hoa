<template>
    <div>
        <v-app id="inspire">
          
          <v-navigation-drawer
            fixed
            :clipped="$vuetify.breakpoint.mdAndUp"
            :mini-variant.sync="mini"
            hide-overlay
            stateless
            app
            v-model="drawer"
          >
            <side-bar></side-bar>
          </v-navigation-drawer>

          <!-- header -->
          <v-toolbar
            color="orange darken-3"
            dark
            app
            :clipped-left="$vuetify.breakpoint.mdAndUp"
            fixed
          >

            <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
              <v-toolbar-side-icon @click.stop="mini = !mini"></v-toolbar-side-icon>
              <span class="hidden-sm-and-down">Integra</span>
             <!--  <v-btn icon  @click.stop="mini = !mini">
              <v-icon>chevron_left</v-icon> -->
            </v-btn>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
              <v-icon>apps</v-icon>
            </v-btn>
            <v-btn icon>
              <v-icon>notifications</v-icon>
            </v-btn>

          </v-toolbar>
          <!-- end header -->

          <v-content>
            <v-container>
              <router-view></router-view>
            </v-container>
          </v-content>
          <!-- <v-btn
            fab
            bottom
            right
            color="pink"
            dark
            fixed
            @click.stop="dialog = !dialog"
          >
            <v-icon>add</v-icon>
          </v-btn>
          <v-dialog v-model="dialog" width="800px">
            <v-card>
              <v-card-title
                class="grey lighten-4 py-4 title"
              >
                Create contact
              </v-card-title>
              <v-container grid-list-sm class="pa-4">
                <v-layout row wrap>
                  <v-flex xs12 align-center justify-space-between>
                    <v-layout align-center>
                      <v-avatar size="40px" class="mr-3">
                        <img
                          src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                          alt=""
                        >
                      </v-avatar>
                      <v-text-field
                        placeholder="Name"
                      ></v-text-field>
                    </v-layout>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      prepend-icon="business"
                      placeholder="Company"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      placeholder="Job title"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mail"
                      placeholder="Email"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field
                      type="tel"
                      prepend-icon="phone"
                      placeholder="(000) 000 - 0000"
                      mask="phone"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="notes"
                      placeholder="Notes"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card-actions>
                <v-btn flat color="primary">More</v-btn>
                <v-spacer></v-spacer>
                <v-btn flat color="primary" @click="dialog = false">Cancel</v-btn>
                <v-btn flat @click="dialog = false">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog> -->
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
        // drawer: null,
      drawer: true,
      mini: true,
      right:null
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