<?php

session_start();

$_SESSION['index'] = false;
$_SESSION['digital_walks'] = true;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: login.php'); // Change to index.html
	exit;
}

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main id="virtual-walks">
	<section>
		<!-- Hero Section -->
		<section class="hero__section">
			<div class="hero-content">
				<div>
					<div>
						<h1>Explore Digital <span>Walks</span></h1>
						<p>
							Escape the ordinary and embark on a journey through breathtaking landscapes—no hiking
							boots
							required. Digital Walks brings the beauty and serenity of nature right to your screen,
							letting you explore lush forests, tranquil lakes, and majestic mountains from anywhere.
							Reconnect with the outdoors, find your calm, and let each virtual step inspire your next
							adventure.
						</p>
						<a href="#video__section" class="primary-btn"><i class="fa-solid fa-play"></i> Start
							Watching Now</a>
					</div>
					<img src="../../assets/images/logo/logo_color_white_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
				</div>
		</section>
		<!-- Recommended Section -->
		<section class="recommended__section">
			<!-- Title -->
			<div>
				<span class="subtitle"><small>Discover the Best Virtual Hikes</small></span>
				<h2>Latest <span>Hikes</span></h2>
			</div>
			<br>
			<br>
			<!-- Content -->
			<div class="popular-container">
				<!-- Popular #2 -->
				<div>
					<div class="popular-content">
						<div class="overlay"></div>
						<video src="../../assets/videos/previews/taitua.mp4" muted type="video/mp4" poster="../../assets/images/backgrounds/taitua.jpg"></video>
						<h2>Taitua Arboretum</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class='primary-btn' onclick="initModal(this, 'previewModal', `
									<iframe src='https://www.youtube.com/embed/zcxXi3F9UOg?si=yWY7tYPuX_wKwQf-' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                    <div class='video-info'>
                                        <div>
                                            <h2>Taitua Arboretum</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p>Taitua Arboretum in Hamilton is a peaceful retreat filled with towering trees, winding trails, and quiet ponds. Originally planted in the 1970s, it has grown into a lush sanctuary where visitors can wander through woodland gardens, spot native birds, and enjoy a picnic under the shade. The walking paths weave through 22 hectares of greenery, offering a gentle escape into nature. Whether you're looking for a relaxing stroll or a scenic spot to unwind, Taitua Arboretum provides a calm, welcoming space just outside the city.</p>
                                    </div>
                                `)"><i class="fa-solid fa-play"></i> Play</button>
						</div>
					</div>
				</div>
				<!-- Popular #3 -->
				<div>
					<div class="popular-content">
						<div class="overlay"></div>
						<video src="../../assets/videos/previews/hamilton_lake_preview.mp4" muted type="video/mp4" poster="../../assets/images/backgrounds/sandford_park.png"></video>
						<h2>Sanford Park</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class='primary-btn' onclick="initModal(this, 'previewModal', `
									<iframe src='https://www.youtube.com/embed/1fkyWVtZ-Qs?si=vW0q_isVT0mTfX7v' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                    <div class='video-info'>
                                        <div>
                                            <h2>Sandford Park</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p>Sandford Park in Hamilton is a quiet, open space where you can take a walk, sit under the trees, or let children play in the playground. The wide grassy areas offer plenty of room for picnics or a moment of stillness. Near the Waikato River, the park has peaceful trails and gentle scenery, making it a good spot to step away from the noise and enjoy the outdoors. Whether you're out for a casual stroll or simply looking for a quiet place to rest, Sandford Park provides a natural, uncomplicated retreat.</p>
                                    </div>
                                `)"><i class="fa-solid fa-play"></i> Play</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Video Section -->
		<section class="video__section">
			<!-- Title -->
			<div>
				<span class="subtitle"><small>Explore the World</small></span>
				<h2>Virtual <span>Walks</span></h2>
			</div>
			<br>
			<br>
			<div id="video__section" class="video__section">
				<!-- Bush Walks -->
				<div data-access="true">
					<h2 class="genre"><i class="fa-solid fa-tree"></i> Bush Walks</h2>
					<div class="video__section-content">
						<!-- Video Cards -->
						<div class="cards">
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/taitua.jpg" alt="Taitua Arboretum" loading="lazy">
									<!-- Play Button -->
									<button type="button" class="primary-btn" onclick="initModal(this, 'previewModal', `
                                            <iframe src='https://www.youtube.com/embed/zcxXi3F9UOg?si=yWY7tYPuX_wKwQf-' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                                <div class='video-info'>
                                                    <div>
                                                        <h2>Taitua Arboretum</h2>
                                                        <ul>
                                                            <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                            <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                            <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                        </ul>
                                                    </div>
                                                    <p>Taitua Arboretum in Hamilton is a peaceful retreat filled with towering trees, winding trails, and quiet ponds. Originally planted in the 1970s, it has grown into a lush sanctuary where visitors can wander through woodland gardens, spot native birds, and enjoy a picnic under the shade. The walking paths weave through 22 hectares of greenery, offering a gentle escape into nature. Whether you're looking for a relaxing stroll or a scenic spot to unwind, Taitua Arboretum provides a calm, welcoming space just outside the city.</p>
                                                </div>
                                        `)"><i class="fa-regular fa-circle-play"></i></button>
								</div>
								<div class="context">
									<h3>Taitua Arboretum</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
								</div>
							</div>
							<!-- Card #3 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/sandford_park.png" alt="Sandford Park" loading="lazy">
									<!-- Play Button -->
									<button type="button" class="primary-btn" onclick="initModal(this, 'previewModal', `
                                            <iframe src='https://www.youtube.com/embed/1fkyWVtZ-Qs?si=vW0q_isVT0mTfX7v' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                                <div class='video-info'>
                                                    <div>
                                                        <h2>Sandford Park</h2>
                                                        <ul>
                                                            <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                            <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                            <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                        </ul>
                                                    </div>
                                                    <p>Sandford Park in Hamilton is a quiet, open space where you can take a walk, sit under the trees, or let children play in the playground. The wide grassy areas offer plenty of room for picnics or a moment of stillness. Near the Waikato River, the park has peaceful trails and gentle scenery, making it a good spot to step away from the noise and enjoy the outdoors. Whether you're out for a casual stroll or simply looking for a quiet place to rest, Sandford Park provides a natural, uncomplicated retreat.</p>
                                                </div>
                                        `)"><i class="fa-regular fa-circle-play"></i></button>
								</div>
								<div class="context">
									<h3>Sandford Park</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
								</div>
							</div>
							<div></div>
						</div>
					</div>
				</div>
				<!-- Lake Walks -->
				<div data-access="true" id="lake-walks">
					<h2 class="genre"><i class="fa-solid fa-water"></i> Lake Walks</h2>
					<div class="video__section-content">
						<!-- Video Cards -->
						<div class="cards">
							<!-- Card #1 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/lake_rotoroa_hamilton.jpg" alt="Hamilton Lake" loading="lazy">
									<button type="button" class="primary-btn" onclick="initModal(this, 'previewModal localVideo', `
										<video class='player' src='../../assets/videos/hamilton_lake.mp4' controls autoplay type='video/mp4'>Your browser does not support this video.</video>
											<div class='video-info'>
												<div>
													<h2>Hamilton Lake</h2>
													<ul>
														<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
														<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
														<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
													</ul>
												</div>
												<p>Hamilton’s lakes are peaceful retreats, perfect for a quiet walk or a moment to unwind. The paths weave through trees and open spaces, offering calming views of the water. Birds glide across the surface, and the gentle sound of waves brushing the shore adds to the serenity. Whether you’re taking a slow stroll or simply sitting by the edge, the lakes invite you to pause, breathe, and enjoy the stillness.</p>
											</div>
										`)"><i class="fa-regular fa-circle-play"></i></button>
								</div>
								<div class="context">
									<h3>Hamilton Lake</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
								</div>
							</div>
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/lake-ngaroto.jpg" alt="Lake Ngaroto" loading="lazy">
									<button type="button" class="primary-btn" onclick="initModal(this, 'previewModal localVideo', `
										<video class='player' src='../../assets/videos/hamilton_lake.mp4' controls autoplay type='video/mp4'>Your browser does not support this video.</video>
											<div class='video-info'>
												<div>
													<h2>Lake Ngaroto</h2>
													<ul>
														<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
														<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
														<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
													</ul>
												</div>
												<p>Lake Ngaroto feels like a secret retreat—just you, the soft crunch of the path, and the gentle ripple of water. The air is crisp, carrying the scent of damp earth and native bush. Ducks glide lazily, reeds sway, and the whole world seems to exhale. You walk without urgency, the lake mirroring the sky, inviting you to pause, breathe, and just exist.</p>
											</div>
										`)"><i class="fa-regular fa-circle-play"></i></button>
								</div>
								<div class="context">
									<h3>Lake Ngaroto</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
								</div>
							</div>
							<div></div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
</main>
<script>
	document.addEventListener("DOMContentLoaded", () => {
		const containers = document.querySelectorAll(".popular-content");

		containers.forEach(container => {
			const video = container.querySelector("video");

			container.addEventListener("mouseenter", () => {
				if (video) {
					video.currentTime = 0;
					video.play().catch(error => console.warn("Autoplay prevented:", error));

					video.previewTimeout = setTimeout(() => {
						video.pause();
						video.currentTime = 0;
					}, 5000);
				}
			});

			container.addEventListener("mouseleave", () => {
				if (video) {
					clearTimeout(video.previewTimeout);
					video.pause();
					video.currentTime = 0;
				}
			});
		});
	});
</script>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>