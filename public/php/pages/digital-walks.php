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
				<!-- Popular #1 -->
				<div>
					<div class="popular-content">
						<video muted data-preview>
							<source src="../../assets/videos/glen_coe.mp4" type="video/mp4">
						</video>
						<div class="overlay"></div>
						<h2>Hamilton Gardens</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/glen_coe.mp4', {
                                    title: 'Hamilton Gardens',
                                    location: 'New Zealand',
                                    duration: '15 Minutes',
                                    quality: 'HD',
                                    description: ''
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/glen_coe.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Hamilton Gardens</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p></p>
                                    </div>
                                `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
						</div>
					</div>
				</div>
				<!-- Popular #2 -->
				<div>
					<div class="popular-content">
						<video muted>
							<source src="../../assets/videos/mountain_range_with_lake.mp4" type="video/mp4">
						</video>
						<div class="overlay"></div>
						<h2>Taitua Arboretum</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/mountain_range_with_lake.mp4', {
                                    title: 'Taitua Arboretum',
                                    location: 'New Zealand',
                                    duration: '15 Minutes',
                                    quality: 'HD',
                                    description: ''
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/mountain_range_with_lake.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Taitua Arboretum</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>     
                                        </div>
                                        <p></p>
                                    </div>
                                `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
						</div>
					</div>
				</div>
				<!-- Popular #3 -->
				<div>
					<div class="popular-content">
						<video muted>
							<source src="../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4" type="video/mp4">
						</video>
						<div class="overlay"></div>
						<h2>Sanford Park</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo" draggable="false" loading="lazy">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                    title: 'Sandford Park',
                                    location: 'New Zealand',
                                    duration: '15 Minutes',
                                    quality: 'HD',
                                    description: ''
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Sandford Park</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p></p>
                                    </div>
                                `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
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
							<!-- Card #1 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg" alt="" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Hamilton Gardens',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: ''
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Hamilton Gardens</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Hamilton Gardens</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p></p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg" alt="" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Taitua Arboretum',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: ''
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Taitua Arboretum</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Taitua Arboretum</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p></p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #3 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg" alt="" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Sandford Park',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: ''
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Sandford Park</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Sandford Park</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p></p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
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
									<img src="../../assets/images/backgrounds/landscape_photograph_of_snowcap_mountains.jpeg" alt="" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Lake Rotoroa',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: ''
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Lake Rotoroa</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Lake Rotoroa</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p></p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg" alt="" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Lake Ngaroto',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: ''
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Lake Ngaroto</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Lake Ngaroto</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p></p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
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

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>