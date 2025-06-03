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
                                    description: 'Discover a place designed for relaxation and tranquility. Hamilton Gardens offers peaceful landscapes, calming water features, and lush greenery, perfect for unwinding and clearing your mind.'
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
                                        <p>Discover a place designed for relaxation and tranquility. Hamilton Gardens offers peaceful landscapes, calming water features, and lush greenery, perfect for unwinding and clearing your mind.</p>
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
                                    description: 'Taitua Arboretum is a hidden gem just outside Hamilton, offering a peaceful retreat into nature. With lush woodland gardens, tranquil lakes, and meandering walking trails, it’s the perfect place to unwind and reconnect with the outdoors. The towering trees provide shade and serenity, while the gentle rustling of leaves and birdsong create a soothing atmosphere.'
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
                                        <p>Taitua Arboretum is a hidden gem just outside Hamilton, offering a peaceful retreat into nature. With lush woodland gardens, tranquil lakes, and meandering walking trails, it’s the perfect place to unwind and reconnect with the outdoors. The towering trees provide shade and serenity, while the gentle rustling of leaves and birdsong create a soothing atmosphere.</p>
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
                                    description: 'Sandford Park in Hamilton is a peaceful retreat, perfect for unwinding amidst nature. With lush greenery, meandering trails, and scenic river views, it offers a tranquil escape from the bustle of daily life. Whether you\'re taking a leisurely walk along the pathways or simply sitting by the water, the park provides a calming atmosphere to relax and recharge.'
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
                                        <p>Sandford Park in Hamilton is a peaceful retreat, perfect for unwinding amidst nature. With lush greenery, meandering trails, and scenic river views, it offers a tranquil escape from the bustle of daily life. Whether you're taking a leisurely walk along the pathways or simply sitting by the water, the park provides a calming atmosphere to relax and recharge.</p>
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
									<img src="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg" alt="Hamilton Gardens" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Hamilton Gardens',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: 'Discover a place designed for relaxation and tranquility. Hamilton Gardens offers peaceful landscapes, calming water features, and lush greenery, perfect for unwinding and clearing your mind.'
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
                                                <p>Discover a place designed for relaxation and tranquility. Hamilton Gardens offers peaceful landscapes, calming water features, and lush greenery, perfect for unwinding and clearing your mind.</p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg" alt="Taitua Arboretum" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Taitua Arboretum',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: 'Taitua Arboretum is a hidden gem just outside Hamilton, offering a peaceful retreat into nature. With lush woodland gardens, tranquil lakes, and meandering walking trails, it’s the perfect place to unwind and reconnect with the outdoors. The towering trees provide shade and serenity, while the gentle rustling of leaves and birdsong create a soothing atmosphere.'
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
                                                <p>Taitua Arboretum is a hidden gem just outside Hamilton, offering a peaceful retreat into nature. With lush woodland gardens, tranquil lakes, and meandering walking trails, it’s the perfect place to unwind and reconnect with the outdoors. The towering trees provide shade and serenity, while the gentle rustling of leaves and birdsong create a soothing atmosphere.</p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #3 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg" alt="Sandford Park" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Sandford Park',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: 'Sandford Park in Hamilton is a peaceful retreat, perfect for unwinding amidst nature. With lush greenery, meandering trails, and scenic river views, it offers a tranquil escape from the bustle of daily life. Whether you\'re taking a leisurely walk along the pathways or simply sitting by the water, the park provides a calming atmosphere to relax and recharge.'
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
                                                <p>Sandford Park in Hamilton is a peaceful retreat, perfect for unwinding amidst nature. With lush greenery, meandering trails, and scenic river views, it offers a tranquil escape from the bustle of daily life. Whether you're taking a leisurely walk along the pathways or simply sitting by the water, the park provides a calming atmosphere to relax and recharge.</p>
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
									<img src="../../assets/images/backgrounds/lake_rotoroa_hamilton.jpg" alt="Hamilton Lake" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/hamilton_lake_rotoroa.MP4', {
                                            title: 'Hamilton Lake',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: 'Hamilton Lake is a peaceful retreat in the heart of the city, offering scenic walking trails, calm waters, and open green spaces perfect for relaxation. Whether you\'re enjoying a quiet stroll, watching the reflections on the lake, or simply taking in the fresh air, it\'s an ideal place to unwind.'
                                            })"><i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Hamilton Lake</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/hamilton_lake_rotoroa.MP4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Hamilton Lake</h2>
                                                    <ul>
                                                        <li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
                                                        <li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small></li>
                                                        <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                                    </ul>    
                                                </div>
                                                <p>Hamilton Lake is a peaceful retreat in the heart of the city, offering scenic walking trails, calm waters, and open green spaces perfect for relaxation. Whether you're enjoying a quiet stroll, watching the reflections on the lake, or simply taking in the fresh air, it's an ideal place to unwind.</p>
                                            </div>
                                        `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
								</div>
							</div>
							<!-- Card #2 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg" alt="Lake Ngaroto" loading="lazy">
									<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                            title: 'Lake Ngaroto',
                                            location: 'New Zealand',
                                            duration: '15 Minutes',
                                            quality: 'HD',
                                            description: 'Lake Ngaroto is a peaceful retreat surrounded by lush wetlands and scenic walking trails. Whether you\'re enjoying a leisurely stroll along the 6 km loop track, watching the gentle ripples on the water, or simply taking in the quiet beauty of the landscape, it\’s the perfect place to unwind and reconnect with nature.'
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
                                                <p>Lake Ngaroto is a peaceful retreat surrounded by lush wetlands and scenic walking trails. Whether you're enjoying a leisurely stroll along the 6 km loop track, watching the gentle ripples on the water, or simply taking in the quiet beauty of the landscape, it’s the perfect place to unwind and reconnect with nature.</p>
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