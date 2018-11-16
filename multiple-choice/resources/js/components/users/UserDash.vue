<template>
<div>
	<v-toolbar flat color="white">
      <v-toolbar-title>Dashboard Admin</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      
      <!-- <div>asdsads</div> -->
      <v-btn  color="primary" dark class="mb-2" @click="showAdd()">ADD</v-btn>
      <v-btn  color="primary" dark class="mb-2" @click="showCopy()">COPY</v-btn>
  </v-toolbar>

  <div class="table-content">
   <vuetable ref="vuetable" 
        :fields="userFields" 
        :api-url="apiUrl"
        :http-options="httpOptions"
        :css="css.table"
        :multi-sort="true"
        :per-page="perPage"
        data-path="data.data"
        pagination-path="data"
        :append-params="moreParams"
        @vuetable:pagination-data="onPaginationData"
    >
      <template slot="actions" slot-scope="props">        
        <v-icon
          @click="destroy(props.rowData.id)">
          delete
        </v-icon>
      </template>
    </vuetable>
    </div>
    <div class="vuetable-pagination">
      <vuetable-pagination-info ref="paginationInfo"
          :css="css.paginationInfo"
      ></vuetable-pagination-info>
      <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    <!-- <v-snackbar v-model="snack" :timeout="3000" :color="snackColor" right bottom>
      {{ snackText }}
      <v-btn flat @click="snack = false">Close</v-btn>
    </v-snackbar> -->
  </div>  
</template>

<script>
import config from '../../config/index.js'
import { get,del } from '../../helpers/index.js'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
export default {

  name: 'UserDash',
  components:{
  	Vuetable,VuetablePagination,VuetablePaginationInfo
  },
  data () {
    return {	
    	status:false,
          apiUrl: config.API_URL + 'user_dash',
          perPage: 30,
          moreParams: {},
          
          httpOptions: {
                headers: {
                    'Authorization': "Bearer " + localStorage.getItem('access_token'),
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
          },
          userFields: [ 
          { name :'email', 
            title:'Email', 
            sortField:'email'
          }, 
          { name :'widget', 
            title:'Widget', 
            sortField:'widget',
          },
          { name :'__slot:actions', 
            title:'Actions'
          },
        ],
          css: {
            table: {
                tableClass: 'table table-bordered table-striped table-hover ',
                ascendingIcon: 'fas fa-long-arrow-alt-up',
                descendingIcon: 'fas fa-long-arrow-alt-down'
            },
            pagination: {
              infoClass: 'pull-left',
              wrapperClass: 'vuetable-pagination pull-left',
              activeClass: 'btn-primary',
              disabledClass: 'disabled',
              pageClass: 'btn btn-default',
              linkClass: 'btn btn-default',
              icons: {
                first: 'fas fa-angle-double-left',
                prev: 'fas fa-angle-left',
                next: 'fas fa-angle-right',
                last: 'fas fa-angle-double-right',
              },
            },
            paginationInfo:{
                infoClass: 'pagination-info'
            },
            icons: {
                first: 'glyphicon glyphicon-step-backward',
                prev: 'glyphicon glyphicon-chevron-left',
                next: 'glyphicon glyphicon-chevron-right',
                last: 'glyphicon glyphicon-step-forward',
            	},
        	},
    	}
  	},
  	mounted(){
      this.$root.$on('reload-table', res => {
          this.$refs.vuetable.refresh()
      })
    },
    methods: {
    	onPaginationData (paginationData) {
          this.$refs.pagination.setPaginationData(paginationData)
          this.$refs.paginationInfo.setPaginationData(paginationData)
	    },
	    onChangePage (page) {
	          this.$refs.vuetable.changePage(page)
	    },
    }
}
</script>

<style lang="css" scoped>
</style>