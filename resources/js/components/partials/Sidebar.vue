<template>
  <v-list dense expand >
        <template v-for="item in items">
          <v-layout
            row
            v-if="item.heading"
            align-center
            :key="item.heading"
          >
          </v-layout>
          <v-list-group 
            v-else-if="item.children"
            v-model="item.model"
            :key="item.text"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <v-list-tile slot="activator" >
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ item.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile
              v-for="(child, i) in item.children"
              :key="child.text"
              @click=""
              :to="child.link"

            >
              <v-list-tile-action v-if="child.icon" >
                <v-icon color="pink">{{ child.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ child.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else @click="" :key="item.text" :to="item.link">
            <v-list-tile-action>
              <v-icon color="pink">{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
</template>

<script>
  export default {
    data() {
      return {
        items: [
            {
              icon: 'fa-caret-up',
              'icon-alt': 'fa-caret-down',
              text: 'Admin',
              model: false,
              children: [
                { text: 'Dashboard Admin' ,link: 'users', icon: 'dashboard' },
                { icon: 'fa-universal-access', text: 'Acl Admin', link: 'slide' },
                { icon: 'link', text: 'Links Admin', link: 'user-dash' },
                { text: 'Users', link: 'user', icon:'people'}
              ]
            }
          ]
      }
    },
    name: 'Sidebar',
    components: {
    }
  }
</script>