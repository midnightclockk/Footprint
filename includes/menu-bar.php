<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
			<li class="dropdown yamm-fw<?php if($currentPage == 'index.php') echo ' active'; ?>">
				<a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
				
			</li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-hover="dropdown">Brands <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu" style="position: absolute; top: 100%; left: 0;">
                    <li><a href="category.php?cid=3">Nike</a></li>
                    <li><a href="category.php?cid=4">Adidas</a></li>
                    <li><a href="category.php?cid=5">Puma</a></li>
                    <li><a href="category.php?cid=8">New Balance</a></li>
                    <li><a href="category.php?cid=9">Caliber</a></li>
                </ul>
            </li>

            <li class="dropdown yamm<?php if($currentPage == 'about-us.php') echo ' active'; ?>">
                <a href="about-us.php">About Us</a>
            </li>

            <li class="dropdown yamm<?php if($currentPage == 'latest.php') echo ' active'; ?>">
                <a href="latest.php">Latest</a>
            </li>

            <li class="dropdown yamm<?php if($currentPage == 'blog.php') echo ' active'; ?>">
                <a href="blog.php">Blog</a>
            </li>

            <li class="dropdown yamm<?php if($currentPage == 'before-you-buy.php') echo ' active'; ?>">
                <a href="before-you-buy.php">Before You Buy</a>
            </li>

			<li class="dropdown yamm">
				<a href="admin/" style="color:#000"> Admin Login</a>
			
			</li>
            <li class="pull-right">
                <div class="search-area">
                    <form name="search" method="post" action="search-result.php">
                        <div class="control-group">
                            <input class="search-field" placeholder="Search here..." name="product" required="required" />
                            <button class="search-button" type="submit" name="search"></button>
                        </div>
                    </form>
                </div>
            </li>
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div>
</div>

            </div>
        </div>
    </div>
</div>
