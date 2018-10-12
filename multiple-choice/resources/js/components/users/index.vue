<template>
	<div class="main">
		<!-- paginator -->
            <div class="paging">
            	<div class="paging-top ntf-pagination">
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
                    <div class="pagination">
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
</template>

<script>
import config from '../../config/index.js'
export default {

  name: 'indexUser',

  data () {
    return {
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
    	}
  	},
  	methods:{
  		
  		loadData(){
            // this.$root.$emit('show-loading', true)

            let url = config.API_URL

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
                this.$root.$emit('show-loading', false)

                if(response && response.success){
                    this.participants = response.data
                    this.paginator.lastPage = response.data.last_page
                    this.paginator.from = response.data.from
                    this.paginator.to = response.data.to
                    this.paginator.total = response.data.total
                }
            })
            .catch(e => {
                this.$root.$emit('show-loading', false)
            })
        },

  		changePerPage(){

  			let lastPage = _.ceil(this.paginator.total/this.paginator.perPage)

            if(this.paginator.currentPage > lastPage){
                this.paginator.currentPage = 1
            }

            // this.loadData()
  		},

  		goToPage (page) {
            if(page > 0 && page <= this.paginator.lastPage && page != this.paginator.currentPage){
                this.paginator.currentPage = page
                // this.loadData()
            }
        },

         goToPreviousPage () {
            if (this.paginator.currentPage > 1) {
                this.paginator.currentPage--
                // this.loadData()
            }
        },

        isCurrentPage (page) {
            return page === this.paginator.currentPage
        },

        goToNextPage () {
            if (this.paginator.currentPage < this.paginator.lastPage) {
                this.paginator.currentPage++
                // this.loadData()
            }
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