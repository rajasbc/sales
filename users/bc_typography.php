<?php
include '../includes/config.php';
include 'header.php';
?>
	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<div class="page-header">
								<div class="page-block">
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="page-header-title">
												<h5 class="m-b-10">Typography</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Basic Components</a></li>
												<li class="breadcrumb-item"><a href="#!">Typography</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">
								<!-- [ Typography ] start -->
								<div class="col-sm-12">
									<div class="card">
										<div class="card-header">
											<h5>Headings</h5>
										</div>
										<div class="card-body">
											<h1>This is a Heading 1</h1>
											<p class="text-muted mb-4">Suspendisse vel quam malesuada, aliquet sem sit amet, fringilla elit. Morbi tempor tincidunt tempor. Etiam id turpis viverra, vulputate sapien nec, varius sem. Curabitur
												ullamcorper fringilla eleifend. In ut eros hendrerit est consequat posuere et at velit.</p>
											<div class="clearfix"></div>
											<h2>This is a Heading 2</h2>
											<p class="text-muted mb-4">In nec rhoncus eros. Vestibulum eu mattis nisl. Quisque viverra viverra magna nec pulvinar. Maecenas pellentesque porta augue, consectetur facilisis diam porttitor sed.
												Suspendisse tempor est sodales augue rutrum tincidunt. Quisque a malesuada purus.</p>
											<div class="clearfix"></div>
											<h3>This is a Heading 3</h3>
											<p class="text-muted mb-4">Vestibulum auctor tincidunt semper. Phasellus ut vulputate lacus. Suspendisse ultricies mi eros, sit amet tempor nulla varius sed. Proin nisl nisi, feugiat quis bibendum vitae,
												dapibus in tellus.</p>
											<div class="clearfix"></div>
											<h4>This is a Heading 4</h4>
											<p class="text-muted mb-4">Nulla et mattis nunc. Curabitur scelerisque commodo condimentum. Mauris blandit, velit a consectetur egestas, diam arcu fermentum justo, eget ultrices arcu eros vel erat.</p>
											<div class="clearfix"></div>
											<h5>This is a Heading 5</h5>
											<p class="text-muted mb-4">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas mattis dui. Aliquam mattis dictum aliquet. Nulla sapien mauris, eleifend et
												sem ac, commodo dapibus odio. Vivamus pretium nec odio cursus elementum. Suspendisse molestie ullamcorper ornare.
											</p>
											<div class="clearfix"></div>
											<h6>This is a Heading 6</h6>
											<p class="text-muted mb-0">Donec ultricies, lacus id tempor condimentum, orci leo faucibus sem, a molestie libero lectus ac justo. ultricies mi eros, sit amet tempor nulla varius sed. Proin nisl nisi,
												feugiat quis bibendum vitae, dapibus in tellus.
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="card">
										<div class="card-header">
											<h5>Display Headings</h5>
										</div>
										<div class="card-body">
											<h1 class="display-1">Display 1</h1>
											<h1 class="display-2">Display 2</h1>
											<h1 class="display-3">Display 3</h1>
											<h1 class="display-4">Display 4</h1>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h5>Inline Text Elements</h5>
										</div>
										<div class="card-body">
											<p class="lead m-t-0">Your title goes here</p>
											You can use the mark tag to
											<mark>highlight</mark> text.
											<br>
											<del>This line of text is meant to be treated as deleted text.</del>
											<br>
											<ins>This line of text is meant to be treated as an addition to the document.</ins>
											<br>
											<strong>rendered as bold text</strong>
											<br>
											<em>rendered as italicized text</em>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h5>Contextual Text Colors</h5>
										</div>
										<div class="card-body">
											<p class="text-muted mb-1">
												Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.
											</p>
											<p class="text-primary mb-1">
												Nullam id dolor id nibh ultricies vehicula ut id elit.
											</p>
											<p class="text-success mb-1">
												Duis mollis, est non commodo luctus, nisi erat porttitor ligula.
											</p>
											<p class="text-info mb-1">
												Maecenas sed diam eget risus varius blandit sit amet non magna.
											</p>
											<p class="text-warning mb-1">
												Etiam porta sem malesuada magna mollis euismod.
											</p>
											<p class="text-danger mb-1">
												Donec ullamcorper nulla non metus auctor fringilla.
											</p>
											<p class="text-dark mb-1">
												Nullam id dolor id nibh ultricies vehicula ut id elit.
											</p>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-4">
									<div class="card">
										<div class="card-header">
											<h5>Unordered</h5>
										</div>
										<div class="card-body">
											<ul>
												<li>Lorem ipsum dolor sit amet</li>
												<li>Consectetur adipiscing elit</li>
												<li>Integer molestie lorem at massa</li>
												<li>Facilisis in pretium nisl aliquet</li>
												<li>Nulla volutpat aliquam velit
													<ul>
														<li>Phasellus iaculis neque</li>
														<li>Purus sodales ultricies</li>
														<li>Vestibulum laoreet porttitor sem</li>
														<li>Ac tristique libero volutpat at</li>
													</ul>
												</li>
												<li>Faucibus porta lacus fringilla vel</li>
												<li>Aenean sit amet erat nunc</li>
												<li>Eget porttitor lorem</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-4">
									<div class="card">
										<div class="card-header">
											<h5>Ordered</h5>
										</div>
										<div class="card-body">
											<ol>
												<li>Lorem ipsum dolor sit amet</li>
												<li>Consectetur adipiscing elit</li>
												<li>Integer molestie lorem at massa</li>
												<li>Facilisis in pretium nisl aliquet</li>
												<li>Nulla volutpat aliquam velit
													<ul>
														<li>Phasellus iaculis neque</li>
														<li>Purus sodales ultricies</li>
														<li>Vestibulum laoreet porttitor sem</li>
														<li>Ac tristique libero volutpat at</li>
													</ul>
												</li>
												<li>Faucibus porta lacus fringilla vel</li>
												<li>Aenean sit amet erat nunc</li>
												<li>Eget porttitor lorem</li>
											</ol>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-lg-4">
									<div class="card">
										<div class="card-header">
											<h5>Unstyled</h5>
										</div>
										<div class="card-body">
											<ul class="list-unstyled">
												<li>Lorem ipsum dolor sit amet</li>
												<li>Integer molestie lorem at massa
													<ul>
														<li>Phasellus iaculis neque</li>
													</ul>
												</li>
												<li>Faucibus porta lacus fringilla vel</li>
												<li>Eget porttitor lorem</li>
											</ul>
											<h5>Inline</h5>
											<hr>
											<ul class="list-inline m-b-0">
												<li class="list-inline-item">Lorem ipsum</li>
												<li class="list-inline-item">Phasellus iaculis</li>
												<li class="list-inline-item">Nulla volutpat</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h5>Blockquotes</h5>
										</div>
										<div class="card-body">
											<p class="text-muted m-b-30">
												Your awesome text goes here.
											</p>
											<blockquote class="blockquote">
												<p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
												<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
											</blockquote>
											<p class="text-muted m-b-15 m-t-20">
												Add <code>.text-right</code> for a blockquote with right-aligned content.
											</p>
											<blockquote class="blockquote text-right">
												<p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
												<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
											</blockquote>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h5>Horizontal Description</h5>
										</div>
										<div class="card-body">
											<dl class="dl-horizontal row">
												<dt class="col-sm-3">Description lists</dt>
												<dd class="col-sm-9">A description list is perfect for defining terms.</dd>

												<dt class="col-sm-3">Euismod</dt>
												<dd class="col-sm-9">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
												<dd class="col-sm-9">Donec id elit non mi porta gravida at eget metus.</dd>

												<dt class="col-sm-3">Malesuada porta</dt>
												<dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>

												<dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
												<dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
											</dl>
										</div>
									</div>
								</div>
								<!-- [ Typography ] end -->
							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	include 'footer.php';
	?>
	