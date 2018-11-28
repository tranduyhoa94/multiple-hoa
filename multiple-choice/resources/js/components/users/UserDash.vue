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
  <add></add>
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
        @vuetable:load-error="handleLoadError"
        @vuetable:load-success="handleLoadSuccess"
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
              <div style="float:right" class="form-inline">
            <label>Per Page:</label>
            <select class="ui simple dropdown form-control" v-model.number="perPage">
              <option value=10>10</option>
              <option value=15>15</option>
              <option value=20>20</option>
              <option value=25>25</option>
              <option value=50>50</option>
              <option value=100>100</option>
              <option value=250>250</option>
            </select>
          </div>
          <div class="clearfix"></div>
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
import Add from './Add.vue'
export default {

  name: 'UserDash',
  components:{
  	Vuetable,VuetablePagination,VuetablePaginationInfo,Add
  },
  data () {
    return {	
    	status:false,
          apiUrl: config.API_URL + 'user_dash',
          perPage: 20,
          moreParams: {},
          
          httpOptions: {
                headers: {
                    'Authorization': localStorage.getItem('access_token'),
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
              wrapperClass: 'vuetable-pagination pull-left left',
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
    watch: {
      'perPage': function(val, oldVal) {
          Vue.nextTick( () => this.$refs.vuetable.refresh())
      },
    },
    methods: {
    	onPaginationData (paginationData) {
          this.$refs.pagination.setPaginationData(paginationData)
          this.$refs.paginationInfo.setPaginationData(paginationData)
	    },
	    onChangePage (page) {
	          this.$refs.vuetable.changePage(page)
	    },
      showAdd() {
        // console.log(this.item)
        this.status = true
        let obj = {
          status: this.status,
          showDialog: true
        }
        this.$root.$emit('change-status', obj)
        // console.log(this.setLocaleUser)
      },
      showCopy(){
         this.status = false
        let obj = {
          status: this.status,
          showDialog: true
        }
        this.$root.$emit('change-status', obj)
        // console.log(this.item2)
      },
      handleLoadError(response){
        console.log(response)
      },
      handleLoadSuccess(response){
        console.log(response.data)
        if(response.data.status == 401 || response.data.status == 408 || response.data.status == 500) {
            localStorage.removeItem('access_token')
            this.$router.push('/login');
        }
      }
    }
}
</script>

<style lang="css" scoped>
</style>