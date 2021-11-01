<!-- Footer -->

<footer class="bg-white">
	<div class="container text-center">
		<div class="wow fadeIn" data-wow-delay=".4s">
			<p><i class="icon icon-layer display-4"></i></p>
			<ul class="list-group list-group-horizontal list-group-clean justify-content-center">
				<li class="list-group-item pr-3"><a href="#">
					{{ (session()->get('language') == 'bangla') ? 'আমাদের দোকান' : 'Our store' }}
				</a></li>
				<li class="list-group-item pr-3"><a href="#">
					{{ (session()->get('language') == 'bangla') ? 'দোকান' : 'Shop' }}
				</a></li>
				<li class="list-group-item pr-3"><a href="#">
					{{ (session()->get('language') == 'bangla') ? 'ক্যাটেগরীজ' : 'Categories' }}
				</a></li>
				<li class="list-group-item pr-3"><a href="#">
					{{ (session()->get('language') == 'bangla') ? 'তথ্য' : 'Info' }}
				</a></li>
				<li class="list-group-item pr-3"><a href="#">
					{{ (session()->get('language') == 'bangla') ? 'যোগাযোগ' : 'Contact' }}
				</a></li>
			</ul>
		</div>
		<div class="wow fadeIn" data-wow-delay=".8s">
			<p class="text-muted">
				@if (session()->get('language') == 'bangla')
					<small>সমস্ত অধিকার সংরক্ষিত <span id="current-year"></span> © প্রকাশ</small>
				@else
					<small>All rights reserved <span id="current-year"></span> © Reveal</small>
				@endif
			</p>
		</div>
	</div>
  </footer>

  <script>
	  document.getElementById('current-year').innerText = new Date().getFullYear();
  </script>