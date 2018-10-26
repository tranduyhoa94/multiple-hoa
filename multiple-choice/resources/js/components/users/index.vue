<template>
	<div class="main">
        <div class="as-body">
            <div class="as-answer-group" >
                <div class="table-responsive">
                <table class="table table-striped table-hover" ref="vuetable" id="program-participants-table" >
                <!-- sort row -->
                <thead>
                    <tr class="text-table-head" role="row">
                        <th style="width: 10%;">
                            <div class="caret-title"></div>
                        </th>
                        <th style="width: 20%;" @click="sortByColumn('firstname')">
                            <div class="caret-title">
                                First Name
                                <span class="sorting secondary-color pl-2" v-if="sortColumn === 'firstname'">
                                    <i class="fa fa-caret-up" aria-hidden="true" v-if="sortType === 'asc'"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true" v-if="sortType === 'desc'"></i>
                                </span>
                            </div>
                        </th>
                        <th style="width: 20%;" @click="sortByColumn('lastname')">
                            <div class="caret-title">
                                Last Name
                                <span class="sorting secondary-color pl-2" v-if="sortColumn === 'lastname'">
                                    <i class="fa fa-caret-up" aria-hidden="true" v-if="sortType === 'asc'"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true" v-if="sortType === 'desc'"></i>
                                </span>
                          </div>
                        </th>
                        <th style="width: 25%;" @click="sortByColumn('email')">
                            <div class="caret-title">
                                Email
                                <span class="sorting secondary-color pl-2" v-if="sortColumn === 'email'">
                                    <i class="fa fa-caret-up" aria-hidden="true" v-if="sortType === 'asc'"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true" v-if="sortType === 'desc'"></i>
                                </span>
                            </div>
                        </th>
                        <th style="width: 10%;" @click="sortByColumn('mentor')">
                            <div class="caret-title">
                                Mentor
                                <span class="sorting secondary-color pl-2" v-if="sortColumn === 'mentor'">
                                    <i class="fa fa-caret-up" aria-hidden="true" v-if="sortType === 'asc'"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true" v-if="sortType === 'desc'"></i>
                                </span>
                            </div>
                        </th>
                        <th style="width: 10%;" @click="sortByColumn('mentee')">
                            <div class="caret-title">
                                Mentee
                                <span class="sorting secondary-color pl-2" v-if="sortColumn === 'mentee'">
                                    <i class="fa fa-caret-up" aria-hidden="true" v-if="sortType === 'asc'"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true" v-if="sortType === 'desc'"></i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <!-- end sort row -->
                <!-- search row -->
                <thead>
                    <tr class="search-table-head" role="row">
                        <th style="width: 10%;">
                              <div class="form-group group-bottom">
                                 <date-picker   :editable='false' v-model="searchColumn.from_day" lang="en" type="date" format="YYYY-MM-DD" @keyup="handleSearch()" @change="handleSearch()" width="150" placeholder=""></date-picker>
                                <!--   <div class="form-group group-bottom">
                                 <date-picker   :editable='false' v-model="searchColumn.from_day" lang="en" type="date" format="YYYY-MM-DD" @keyup="handleSearch()" @change="handleSearch()" width="150" placeholder=""></date-picker> -->
                            <!-- </div>   -->
                            </div>  
                        </th>
                        <th style="width: 20%;">
                          <div class="form-group group-bottom">
                            <input class="form-control" type="text" @keyup="handleSearch()" @change="handleSearch()" v-model="searchColumn.firstname" id="input-1">
                          </div>
                        </th>
                        <th style="width: 20%;">
                            <div class="form-group group-bottom">
                                <input class="form-control" type="text" @keyup="handleSearch()" @change="handleSearch()" v-model="searchColumn.lastname" id="input-2">
                            </div>
                        </th>
                        <th style="width: 25%;">
                           <div class="form-group group-bottom">
                                <input class="form-control" type="text" @keyup="handleSearch()" @change="handleSearch()" v-model="searchColumn.email" id="input-3">
                          </div>
                        </th>
                        <th style="width: 10%;">
                            <div class="input-group input-group-sm custom-input-group">
                               <!--  <div class="select-control">
                                    <select class="search-input-select form-control font-weight-bold" type="select" aria-controls="example" v-model="searchColumn.mentor" v-on:change="handleSearch()">
                                        <option v-for="(r, key) in searchRoles" :value="r">
                                            {{r}}
                                        </option>
                                    </select>
                                    <span class="caret secondary-color">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </span>
                                </div> -->
                            </div>
                        </th>
                        <th style="width: 10%;">
                            <div class="input-group input-group-sm custom-input-group">
                                <!-- <div class="select-control">
                                    <select class="search-input-select form-control font-weight-bold" type="select" aria-controls="example" v-model="searchColumn.mentee" v-on:change="handleSearch()">
                                        <option v-for="(r, key) in searchRoles" :value="r">
                                            {{r}}
                                        </option>
                                    </select>
                                    <span class="caret secondary-color">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </span>
                                </div> -->
                            </div>
                        </th>
                    </tr>
                </thead>
                <!-- end search row -->
                <tbody>
                        <tr role="row" v-for="(pp,index) in participants.data" v-if="participants.data && participants.data.length">
                            <td>
                            123
                                <!-- <div class="image-profile">
                                    <img class="custome-image" :src="'uploads/' + pp.profile_image" v-if="pp.profile_image">
                                    <img class="custome-image" src="img/profile-img.png" v-else>
                                </div> -->
                            </td>
                            <td>
                                <div class="prp-text text-capitalize">
                                    {{pp.first_name}}
                                </div>
                            </td>
                            <td>
                                <div class="prp-text text-capitalize">
                                    {{pp.last_name}}
                                </div>
                            </td>
                            <td>
                                <div class="prp-text">
                                    {{pp.email}}
                                </div>
                            </td>
                            <td>
                    
                                <input v-if = "pp.edit" v-model = "pp.address"
                                  @blur= "pp.edit = false; editTodo(pp.address,pp.id)"
                                  @keyup.enter = "pp.edit=false; editTodo()" class="form-control">
                                <div v-else>
                                    <strong class="primary--text"><label @click = "pp.edit = true;">  {{pp.address || 'edit'}} </label></strong>
                                </div>
                                
                            </td>
                            <td>
                                <!-- <div class="prp-text">
                                    {{pp.mentee_role}}
                                </div> -->
                            </td>
                        </tr>

                        <tr class="odd listing" v-if="participants.data && !participants.data.length"><td valign="top" colspan="6" class="text-center">No data available in table</td></tr>
                    </tbody>

        		</table>
                <!-- paginator -->
                    <div class="paging">
                    	<div class="paging-top ntf-pagination ">
                            <span class="pr-2">Rows per page</span>
                            <select class="form-control notification-dropdown-form-control" v-model="paginator.perPage" v-on:change="changePerPage()">
                                <option v-for="(r, key) in rowsPerPage" :value="r">
                                    {{r}}
                                </option>
                            </select>
                        </div>
                        <!-- <div class="paging-bottom" v-if="participants.data && participants.data.length"> -->
                         <div class="paging-bottom">
                            <div class="pagination-info">{{ paginationInfo }}</div>
                            <div class="pagination-style">
                                <a class="btn-nav link disabled" @click="goToPage(1)">
                                    <i class="fa fa-angle-double-left"></i>
                                </a>
                                <a class="btn-nav link disabled secondary-color" @click="goToPreviousPage()">
                    				<i class="fa fa-angle-left"></i>
                    			</a>
                                <template v-if="isNotLongPage">
                                    <template v-for="n in paginator.lastPage">
                                        <a class="page" @click="goToPage(n)" :class="isCurrentPage(n) ? 'secondary-color' : ''">{{ n }}</a>
                                    </template>
                                </template>

                                <template v-else>
                                    <span v-if="existPageBefore">...</span>
                                    <template v-for="n in longPaginatorSize">
                                        <a class="page" @click="goToPage(longPaginatorStart + n - 1)" :class="isCurrentPage(longPaginatorStart + n - 1) ? 'secondary-color ': ''">{{ longPaginatorStart + n - 1 }}</a>
                                    </template>
                                    <span v-if="existPageAfter">...</span>
                                </template>

                    			<a class="btn-nav link disabled secondary-color" @click="goToNextPage()">
                    				<i class="fa fa-angle-right"></i>
                    			</a>

                                <a class="btn-nav link disabled" @click="goToPage(paginator.lastPage)">
                    				<i class="fa fa-angle-double-right"></i>
                    			</a>
                            </div>
                        </div>
                    </div>
               <!-- end paginator -->
	           </div>
            </div>
       </div>
    </div>
</template>

<script>
import config from '../../config/index.js'
import DatePicker from 'vue2-datepicker'
import moment from 'moment'

export default {

  name: 'indexUser',

  data () {
    return {
            participants: [],
	    	rowsPerPage: [10, 20, 30, 40, 50],
	    	paginator: {
	                perPage: 10,
	                currentPage: 1,
	                lastPage: 1,
	                total: 0,
	                from: 0,
	                to: 0,
        	},
        	longPaginatorEachSize: 2,
            existPageBefore: false,
            existPageAfter: false,

            sortColumn: '',
            sortType: '',
            sortBy: '',

            searchColumn: {
                firstname: '',
                lastname: '',
                email: '',
                from_day:''
            },
            month:'',
            editing:0,
    	}
  	},
    components : {
            DatePicker
    },
    created () {
        this.makeSearchParams()
        this.loadData()
    },
  	methods:{

        makeSearchParams () {
            let searchValues = []

            if(_.trim(this.searchColumn.firstname)){
                searchValues.push('firstname:' + this.searchColumn.firstname)
            }

            if(_.trim(this.searchColumn.lastname)){
                searchValues.push('lastname:' + this.searchColumn.lastname)
            }

            if(_.trim(this.searchColumn.email)){
                searchValues.push('email:' + this.searchColumn.email)
            }

            if(_.trim(this.searchColumn.from_day)){
                searchValues.push('from_day:' + moment(this.searchColumn.from_day, 'YYYY-MM-DD hh:mm:ss').format('YYYY-MM-DD'))
            }

            this.searchBy = searchValues.join(";")
        },

        handleSearch(){
            this.makeSearchParams()

            this.loadData()
        },
  		
  		loadData(){
            this.$root.$emit('show', true)
            let url = config.API_URL + 'program'

            let params = {
                perPage: this.paginator.perPage,
                sort: this.sortBy,
                search: this.searchBy,
                page: this.paginator.currentPage
            }

            axios.get(url, {
                params: params
            })
            .then(response => {
                // console.log(response.data);
                this.$root.$emit('show', false)

                if(response && response.data.success){
                     _.forEach(response.data.data.data, function(index,value) {
                        // console.log(response.data.data.data[value]);
                        response.data.data.data[value].edit = false;                
                    });
                    this.participants = response.data.data
                    // console.log(this.participants)
                    this.paginator.lastPage = response.data.data.last_page
                    this.paginator.from = response.data.data.from
                    this.paginator.to = response.data.data.to
                    this.paginator.total = response.data.data.total
                }
            })
            .catch(e => {
                this.$root.$emit('show', false)
            })
        },

  		changePerPage(){

  			let lastPage = _.ceil(this.paginator.total/this.paginator.perPage)

            if(this.paginator.currentPage > lastPage){
                this.paginator.currentPage = 1
            }

            this.loadData()
  		},

  		goToPage (page) {
            if(page > 0 && page <= this.paginator.lastPage && page != this.paginator.currentPage){
                this.paginator.currentPage = page
                this.loadData()
            }
        },

         goToPreviousPage () {
            if (this.paginator.currentPage > 1) {
                this.paginator.currentPage--
                this.loadData()
            }
        },

        isCurrentPage (page) {
            return page === this.paginator.currentPage
        },

        goToNextPage () {
            if (this.paginator.currentPage < this.paginator.lastPage) {
                this.paginator.currentPage++
                this.loadData()
            }
        },

        sortByColumn(column){

            this.sortColumn = column

            if (this.sortType == 'asc') {
                this.sortType = 'desc'
            }else {
                this.sortType = 'asc'
            }

            if(column == 'firstname'){
                this.sortBy = 'users|firstname' + '|' + this.sortType
            }

            if(column == 'lastname'){
                this.sortBy = 'users|lastname' + '|' + this.sortType
            }

            if(column == 'email'){
                this.sortBy = 'users|email' + '|' + this.sortType
            }

            if(column == 'mentor'){
                this.sortBy = 'virtual_fields|mentor_role' + '|' + this.sortType
            }

            if(column == 'mentee'){
                this.sortBy = 'virtual_fields|mentee_role' + '|' + this.sortType
            }

            this.loadData()
        },

        editTodo(address,id) {
            this.$root.$emit('show', true)
            var params = {
                address:address,
                user_id:id
            }
            var url = config.API_URL + 'update-address'
            axios.get(url,{
                params:params
            })
            .then(res => {

            })

        },
  	},
  	computed: {
  		paginationInfo () {
            return this.paginator.from + ' - ' + this.paginator.to + ' of ' + this.paginator.total
        },

        isNotLongPage () {
            return this.paginator.lastPage <= (this.longPaginatorEachSize * 2) + 4
        },

        longPaginatorSize () {
            return this.longPaginatorEachSize * 2 + 1;
        },

        longPaginatorStart () {

            if (this.paginator.currentPage <= this.longPaginatorEachSize + 1) {
                this.existPageBefore = false
                this.existPageAfter = true
                return 1
            }

            if (this.paginator.currentPage >= (this.paginator.lastPage - this.longPaginatorEachSize)) {
                this.existPageBefore = true
                this.existPageAfter = false
                return this.paginator.lastPage - (this.longPaginatorEachSize*2)
            }

            this.existPageBefore = true
            this.existPageAfter = true
            return this.paginator.currentPage - this.longPaginatorEachSize
        }
  	}

}
</script>

<style lang="css" scoped>
</style>