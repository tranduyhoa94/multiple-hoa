<template>
	<div class="page-login">
		<div class="vertical-align-wrap inner-content">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="templates/assets/img/logo-dark.png" alt="Klorofil Logo"></div>
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="#">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" placeholder="Password">
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<!-- <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span> -->
									<span class="helper-text"><h4>OR</h4></span>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN WITH FACEBOOK</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="test">
						<h1>test</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</template>

<script>

export default {

  name: 'Login',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>