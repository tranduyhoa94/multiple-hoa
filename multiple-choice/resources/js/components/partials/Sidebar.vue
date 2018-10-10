<template>
	<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li> <router-link :to="{ name: 'Dashboard' }" :class="item === 'Dashboard' ? 'active' : ''"><i class="lnr lnr-home"></i> <span>Dashboard</span></router-link></li>
						<li><router-link :to="{ name: 'indexUser' }" :class="item === 'indexUser' ? 'active' : ''"><i class="lnr lnr-code"></i> <span>Elements</span></router-link></li>
						<li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
						<!-- <li @click="abc">{{item}}</li> -->
						<li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Profile</a></li>
									<li><a href="page-login.html" class="">Login</a></li>
									<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
								</ul>
							</div>
						</li>
						<li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
						<li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
						<li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
</template>

<script>
export default {

  name: 'Sidebar',

  data () {
    return {
    	// item: this.$route.name
    }
  },
  methods:{
  	// abc(){
  	// 	alert(this.item)

  	// }
  },
  computed:{
  	item(){
  		return this.$route.name
  	}
  }
}
</script>

<style lang="css" scoped>
	.active{
		color: white !important;
		z-index: 1000;
	}
</style>