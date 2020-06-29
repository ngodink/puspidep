@extends('web::layouts.default')

@section('title', 'Tentang kami - ')

@section('content')
<div class="container py-4 bg-white rounded">
	<h5 class="mb-5"><strong>Tentang kami</strong></h5>
	<div>
		<div class="row d-flex flex-row align-items-center mb-5">
			<div class="col-md-6">
				<img class="img-fluid" src="{{ asset('img/page/about.jpg') }}" alt="">
			</div>
			<div class="col-md-6">
				<div class="py-4">
					<h4 class="mb-4"><strong>Pusat Pengkajian Islam Demokrasi dan Perdamaian</strong></h4>
					<p>(PusPIDeP) adalah lembaga profesional yang bergerak di bidang sosial, keagamaan, dan kemanusiaan. PusPIDeP mempunyai komitmen kuat dalam melakukan penelitian, advokasi, diseminasi dan publikasi terkait topik-topik keislaman dan demokrasi serta berpartisipasi aktif dalam mengupayakan perdamaian dan dialog antar iman. Untuk itu, PusPIDeP membuka diri untuk bekerja sama dengan pihak-pihak terkait baik dari dalam maupun luar negeri.</p>
					<hr>
					<ul class="pl-3">
						<li>Konsentrasi Keislaman</li>
						<li>Konsentrasi Demokrasi</li>
						<li>Konsentrasi Generasi Millenial</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-4">
				<h5 class="mb-5"><strong>History</strong></h5>
				<p class="mb-5">PusPIDeP merupakan lembaga penelitian dan advokasi independen yang bertujuan untuk mengkaji isu isu keislaman, demokrasi dan kemanusiaan.</p>
			</div>
			<div class="col-md-8">
				<div class="accordion" id="accordion">
					<div class="card border-0 rounded-0 mb-2">
						<div class="card-header border-0 border-left-dark rounded-0" data-toggle="collapse" data-target="#collapseOne" style="cursor: pointer;">
							What we do?
						</div>
						<div id="collapseOne" class="collapse show" aria data-parent="#accordion">
							<div class="card-body">
								PusPIDeP merupakan lembaga penelitian dan advokasi independen yang bertujuan untuk mengkaji isu-isu keislaman, demokrasi dan kemanusiaan. PusPIDeP berkomitmen untuk menanamkan dan memperkuat nilai-nilai sosial demokrasi dan perdamaian dalam masyarakat dengan mengadakan kegiatan penelitian, pengkajian, seminar, pelatihan, pendampingan, resolusi konflik serta publikasi.
							</div>
						</div>
					</div>
					<div class="card border-0 rounded-0 mb-2">
						<div class="card-header border-0 border-left-dark rounded-0" data-toggle="collapse" data-target="#collapseTwo" style="cursor: pointer;">
							Visi
						</div>
						<div id="collapseTwo" class="collapse" aria data-parent="#accordion">
							<div class="card-body">
								Visi PusPIDeP adalah menciptakan kehidupan sosial dan masyarakat Indonesia berdasarkan pada nilai-nilai kebangsaan, keagamaan, dan kemanusiaan, serta turut berkontribusi untuk menciptakan masyarakat Muslim yang bermartabat dan berkeadaban dengan mengintegrasikan gagasan keislaman, kebangsaan dan demokrasi.
							</div>
						</div>
					</div>
					<div class="card border-0 rounded-0 mb-2">
						<div class="card-header border-0 border-left-dark rounded-0" data-toggle="collapse" data-target="#collapseThree" style="cursor: pointer;">
							Misi
						</div>
						<div id="collapseThree" class="collapse" aria data-parent="#accordion">
							<div class="card-body">
								Untuk mewujudkan visi tersebut, PusPIDeP memandang perlu untuk mengambil langkah-langkah strategis dengan:
								<ol>
									<li>Mengadakan penelitian sosial dan pemberdayaan masyarakat dalam isu kajian Islam, kajian agama.</li>
									<li>Melaksanakan pelatihan dan pendidikan masyarakat dalam rangka penenaman dan penguatan nilai-nilai demokrasi dan perdamaian.</li>
									<li>Mendorong peran pemeluk agama dan masyarakat dalam demokrasi, serta peran pemeluk agama dan masyarakat dalam menciptakan dan menjaga perdamaian dalam semua lingkup kehidupan.</li>
									<li>Mengadakan pelatihan dan pendampingan manajemen dan resolusi konflik di masyarakat dalam rangka penanaman dan penguatan demokrasi dan perdamaian.</li>
									<li>Menjembatani jarak antara kajian-kajian akademik, aspirasi masarakat dan arah kebijakan pemerintah dalam upaya ikut merumuskan rekomendasi kebijakan dalam bidang keislaman, demokrasi dan perdamaian.</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div>
			<h5 class="mb-5"><strong>Get in touch</strong></h5>
			<div class="d-flex flex-row align-items-center mb-5">
				<div class="bg-light rounded text-center px-4 py-2 mr-4">
					<i class="mdi mdi-email-outline mdi-48px"></i>
				</div>
				<div>
					<strong>E-mail</strong> <br>
					<a class="text-dark" href="mailto:puspidep@gmail.com">puspidep@gmail.com</a>
				</div>
			</div>
			<div class="d-flex flex-row align-items-center mb-5">
				<div class="bg-light rounded text-center px-4 py-2 mr-4">
					<i class="mdi mdi-phone-outline mdi-48px"></i>
				</div>
				<div>
					<strong>Telepon</strong> <br>
					<div>02744399482</div>
				</div>
			</div>
			<div class="d-flex flex-row align-items-center">
				<div class="bg-light rounded text-center px-4 py-2 mr-4">
					<i class="mdi mdi-home-outline mdi-48px"></i>
				</div>
				<div>
					<strong>Alamat</strong> <br>
					<div>Jl. Gurami No. 51 Kelurahan Sorosutan, Kecamatan Umbulharjo, Kota Yogyakarta, DIY.</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection