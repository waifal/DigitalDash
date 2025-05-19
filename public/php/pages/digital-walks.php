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
	<section> <!-- Hero Section -->
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
					<img src="../../assets/images/logo/logo_color_white_transparent_png.png" alt="DigitalDash Logo"
						draggable="false">
				</div>
				<div class="hero-content-grid">
					<!-- Grid Item 1 -->
					<div>
						<img src="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							alt="Scenic winter landscape of Austrian Alps" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							imagesrcset="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg">
					</div>
					<!-- Grid Item 2 -->
					<div>
						<img src="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg"
							alt="Scenic mountain bridge over river landscape" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg"
							imagesrcset="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg">
					</div>
					<!-- Grid Item 3 -->
					<div>
						<img src="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg"
							alt="Gorsa Bridge in Norway with waterfall and mountains, drone view" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg"
							imagesrcset="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg">
					</div>
					<!-- Grid Item 4 -->
					<div>
						<img src="../../assets/images/backgrounds/creek_in_a_forest.jpeg" alt="Creek in a forest"
							loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/creek_in_a_forest.jpeg"
							imagesrcset="../../assets/images/backgrounds/creek_in_a_forest.jpeg">
					</div>
					<!-- Grid Item 5 -->
					<div>
						<img src="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							alt="Bridge in Iceland landscape" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							imagesrcset="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg">
					</div>
					<!-- Grid Item 6 -->
					<div>
						<img src="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg"
							alt="Aerial view of river and forest trees" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg"
							imagesrcset="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg">
					</div>
					<!-- Grid Item 7 -->
					<div>
						<img src="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							alt="Captivating mountain view in Ruidoso, New Mexico" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							imagesrcset="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg">
					</div>
					<!-- Grid Item 8 -->
					<div>
						<img src="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg"
							alt="Majestic mountain landscape in Hooker Valley, New Zealand" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg"
							imagesrcset="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg">
					</div>
					<!-- Grid Item 9 -->
					<div>
						<img src="../../assets/images/backgrounds/Rocky_Mountain.jpeg" alt="Rocky Mountain landscape"
							loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/Rocky_Mountain.jpeg"
							imagesrcset="../../assets/images/backgrounds/Rocky_Mountain.jpeg">
					</div>
					<!-- Grid Item 10 -->
					<div>
						<img src="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg"
							alt="Green trees and snowy mountains under blue sky" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg"
							imagesrcset="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg">
					</div>
					<!-- Grid Item 11 -->
					<div>
						<img src="../../assets/images/backgrounds/stunning_hooker_valley_landscape_in_new_zealand.jpeg"
							alt="Stunning Hooker Valley landscape in New Zealand" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/stunning_hooker_valley_landscape_in_new_zealand.jpeg"
							imagesrcset="../../assets/images/backgrounds/stunning_hooker_valley_landscape_in_new_zealand.jpeg">
					</div>
					<!-- Grid Item 12 -->
					<div>
						<img src="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							alt="Captivating mountain view in Ruidoso, New Mexico" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							imagesrcset="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg">
					</div>
					<!-- Grid Item 13 -->
					<div>
						<img src="../../assets/images/backgrounds/landscape_photograph_of_snowcap_mountains.jpeg"
							alt="Landscape photograph of snowcapped mountains" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/landscape_photograph_of_snowcap_mountains.jpeg"
							imagesrcset="../../assets/images/backgrounds/landscape_photograph_of_snowcap_mountains.jpeg">
					</div>
					<!-- Grid Item 14 -->
					<div>
						<img src="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg"
							alt="Winding trail among the mountains of Mount Cook National Park" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg"
							imagesrcset="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg">
					</div>
					<!-- Grid Item 15 -->
					<div>
						<img src="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							alt="Captivating mountain view in Ruidoso, New Mexico" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							imagesrcset="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg">
					</div>
					<!-- Grid Item 16 -->
					<div>
						<img src="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg"
							alt="Mount Cook in New Zealand" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg"
							imagesrcset="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg">
					</div>
					<!-- Grid Item 17 -->
					<div>
						<img src="../../assets/images/backgrounds/4k-green-forest.jpg" alt="Green forest landscape"
							loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/4k-green-forest.jpg"
							imagesrcset="../../assets/images/backgrounds/4k-green-forest.jpg">
					</div>
					<!-- Grid Item 18 -->
					<div>
						<img src="../../assets/images/backgrounds/scenic-forest-path-in-gia-lai-vietnam.jpg"
							alt="Scenic forest path in Gia Lai, Vietnam" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/scenic-forest-path-in-gia-lai-vietnam.jpg"
							imagesrcset="../../assets/images/backgrounds/scenic-forest-path-in-gia-lai-vietnam.jpg">
					</div>
					<!-- Grid Item 19 -->
					<div>
						<img src="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg"
							alt="Empty wooden pathway in forest" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg"
							imagesrcset="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg">
					</div>
					<!-- Grid Item 20 -->
					<div>
						<img src="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg"
							alt="Landscape photography of volcano" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg"
							imagesrcset="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg">
					</div>
					<!-- Grid Item 21 -->
					<div>
						<img src="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							alt="Scenic winter landscape of Austrian Alps" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							imagesrcset="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg">
					</div>
					<!-- Grid Item 22 -->
					<div>
						<img src="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							alt="Bridge in Iceland landscape" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							imagesrcset="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg">
					</div>
					<!-- Grid Item 23 -->
					<div>
						<img src="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg"
							alt="Aerial view of river and forest trees" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg"
							imagesrcset="../../assets/images/backgrounds/River-and-Forest-Trees-Aerial-View.jpg">
					</div>
					<!-- Grid Item 24 -->
					<div>
						<img src="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							alt="Captivating mountain view in Ruidoso, New Mexico" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							imagesrcset="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg">
					</div>
					<!-- Grid Item 25 -->
					<div>
						<img src="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg"
							alt="Majestic mountain landscape in Hooker Valley, New Zealand" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg"
							imagesrcset="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg">
					</div>
					<!-- Grid Item 26 -->
					<div>
						<img src="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg"
							alt="Winding trail among the mountains of Mount Cook National Park" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg"
							imagesrcset="../../assets/images/backgrounds/winding_trail_among_the_mountains_of_mount_cook_national_park.jpeg">
					</div>
					<!-- Grid Item 27 -->
					<div>
						<img src="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							alt="Captivating mountain view in Ruidoso, New Mexico" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg"
							imagesrcset="../../assets/images/backgrounds/captivating_mountain_view_in_ruidoso_new_mexico.jpg">
					</div>
					<!-- Grid Item 28 -->
					<div>
						<img src="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg"
							alt="Mount Cook in New Zealand" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg"
							imagesrcset="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg">
					</div>
					<!-- Grid Item 29 -->
					<div>
						<img src="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							alt="Scenic winter landscape of Austrian Alps" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							imagesrcset="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg">
					</div>
					<!-- Grid Item 30 -->
					<div>
						<img src="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg"
							alt="Scenic mountain bridge over river landscape" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg"
							imagesrcset="../../assets/images/backgrounds/scenic_mountain_bridge_river_landscape.jpg">
					</div>
					<!-- Grid Item 31 -->
					<div>
						<img src="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg"
							alt="Gorsa Bridge in Norway with waterfall and mountains, drone view" loading="lazy"
							fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg"
							imagesrcset="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg">
					</div>
					<!-- Grid Item 32 -->
					<div>
						<img src="../../assets/images/backgrounds/creek_in_a_forest.jpeg" alt="Creek in a forest"
							loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/creek_in_a_forest.jpeg"
							imagesrcset="../../assets/images/backgrounds/creek_in_a_forest.jpeg">
					</div>
					<!-- Grid Item 33 -->
					<div>
						<img src="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							alt="Bridge in Iceland landscape" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image" href="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg"
							imagesrcset="../../assets/images/backgrounds/iceland_photo_of_bridge.jpg">
					</div>
					<!-- Grid Item 34 -->
					<div>
						<img src="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg"
							alt="Empty wooden pathway in forest" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg"
							imagesrcset="../../assets/images/backgrounds/empty_wooden_pathway_in_forest.jpg">
					</div>
					<!-- Grid Item 35 -->
					<div>
						<img src="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg"
							alt="Landscape photography of volcano" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg"
							imagesrcset="../../assets/images/backgrounds/landscape_photography_of_volcano.jpeg">
					</div>
					<!-- Grid Item 36 -->
					<div>
						<img src="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							alt="Scenic winter landscape of Austrian Alps" loading="lazy" fetchpriority="low">
						<link rel="preload" as="image"
							href="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg"
							imagesrcset="../../assets/images/backgrounds/Scenic_Winter_Landscape_of_Austrian_Alps.jpg">
					</div>
				</div>
		</section>
		<!-- Recommended Section -->
		<section class="recommended__section">
			<!-- Title -->
			<div>
				<span class="subtitle"><small>Discover the Best Virtual Hikes</small></span>
				<h2>Trending <span>Now</span></h2>
			</div>
			<br>
			<br>
			<!-- Content -->
			<div class="popular-container">
				<!-- Popular #1 -->
				<div>
					<div class="popular-content">
						<video muted>
							<source src="../../assets/videos/glen_coe.mp4" type="video/mp4">
						</video>
						<div class="overlay"></div>
						<h2>Glen Coe</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo"
							draggable="false">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/glen_coe.mp4', {
                                    title: 'Glen Coe',
                                    location: 'Scotland',
                                    duration: '7 Seconds',
                                    quality: 'HD',
                                    description: 'Hidden within the rugged heart of the Scottish Highlands, Glen Coe is a breathtaking valley where nature’s drama unfolds in towering peaks and misty trails. Steeped in history and mystery, it’s a place where ancient legends whisper through the winds and cinematic landscapes pull you into their untamed beauty. Whether bathed in golden light or cloaked in mist, Glen Coe is pure magic—an awe-inspiring spectacle you have to see to believe. Watch the video and immerse yourself in its haunting, majestic allure.'
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/glen_coe.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Glen Coe</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> Scotland</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 7 Seconds</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p>Hidden within the rugged heart of the Scottish Highlands, Glen Coe is a breathtaking valley where nature’s drama unfolds in towering peaks and misty trails. Steeped in history and mystery, it’s a place where ancient legends whisper through the winds and cinematic landscapes pull you into their untamed beauty. Whether bathed in golden light or cloaked in mist, Glen Coe is pure magic—an awe-inspiring spectacle you have to see to believe. Watch the video and immerse yourself in its haunting, majestic allure.</p>
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
						<h2>Mountain Range Lake</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo"
							draggable="false">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/mountain_range_with_lake.mp4', {
                                    title: 'Mountain Range Lake',
                                    location: 'N/A',
                                    duration: '14 Seconds',
                                    quality: 'HD',
                                    description: 'A solitary giant rises, kissed by golden sunlight, its peaks crowned with drifting veils of cloud. Below, emerald meadows sway, dotted with wildflowers that exhale whispers of fragrance into the crisp, pine-scented air. A crystalline river hums its lullaby, threading through the valley like liquid silver. Birds glide, their melodies stitching the sky with soft serenity. Here, amid nature’s embrace, time dissolves, and the soul breathes freely—weightless, calm, whole. Let the mountain’s quiet grandeur enfold you. Let its stillness speak.'
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/mountain_range_with_lake.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Mountain Range Lake</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> N/A</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 14 Seconds</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>     
                                        </div>
                                        <p>A solitary giant rises, kissed by golden sunlight, its peaks crowned with drifting veils of cloud. Below, emerald meadows sway, dotted with wildflowers that exhale whispers of fragrance into the crisp, pine-scented air. A crystalline river hums its lullaby, threading through the valley like liquid silver. Birds glide, their melodies stitching the sky with soft serenity. Here, amid nature’s embrace, time dissolves, and the soul breathes freely—weightless, calm, whole. Let the mountain’s quiet grandeur enfold you. Let its stillness speak.</p>
                                    </div>
                                `)"><i class="fa-solid fa-circle-info"></i> More Info</button>
						</div>
					</div>
				</div>
				<!-- Popular #3 -->
				<div>
					<div class="popular-content">
						<video muted>
							<source
								src="../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4"
								type="video/mp4">
						</video>
						<div class="overlay"></div>
						<h2>Sun Peek Forest</h2>
						<img src="../../assets/images/logo/logo_color_black_transparent_png.png" alt="DigitalDash Logo"
							draggable="false">
						<div class="popular-banner">
							<span><span>Top</span> <span>3</span></span>
						</div>
						<div class="button__container">
							<!-- Play Button -->
							<button type="button" class="primary-btn" onclick="playFullscreenVideo('../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4', {
                                    title: 'Sun Peek Forest',
                                    location: 'N/A',
                                    duration: '17 Seconds',
                                    quality: 'HD',
                                    description: 'Witness the ethereal dance of sunlight filtering through ancient forest canopies, creating a mesmerizing display of light and shadow. As golden rays pierce through towering trees, they paint the forest floor in a warm, dappled glow, inviting you into a moment of pure tranquility. This peaceful scene captures nature\'s simple yet profound ability to create moments of wonder and serenity.'
                                    })"><i class="fa-solid fa-play"></i> Play</button>
							<!-- Learn More Button -->
							<button type="button" onclick="initModal(this, 'previewModal', `
                                    <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                        <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                    </video>  
                                    <div class='video-info'>
                                        <div>
                                            <h2>Sun Peek Forest</h2>
                                            <ul>
                                                <li><small><i class='fa-solid fa-location-dot'></i> N/A</small></li>
                                                <li><small><i class='fa-solid fa-hourglass-start'></i> 17 Seconds</small></li>
                                                <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                                            </ul>    
                                        </div>
                                        <p>Witness the ethereal dance of sunlight filtering through ancient forest canopies, creating a mesmerizing display of light and shadow. As golden rays pierce through towering trees, they paint the forest floor in a warm, dappled glow, inviting you into a moment of pure tranquility. This peaceful scene captures nature's simple yet profound ability to create moments of wonder and serenity.</p>
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
						<div class="arrow__container">
							<button type="button"><i class="fa-solid fa-arrow-left"></i></button>
						</div>
						<!-- Video Cards -->
						<div class="cards">
							<!-- Card #1 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/green_trees_snowy_mountains_during_blue_sunny_cloudy_sky.jpeg"
										alt="">
									<button type="button">
										<i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Green Trees Snowy Mt.</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span
													class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Green Trees Snowy Mt.</h2>
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
									<img src="../../assets/images/backgrounds/mount_cook_in_new_zealand.jpeg" alt="">
									<button type="button">
										<i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Aoraki/Mount Cook</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span
													class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Aoraki/Mount Cook</h2>
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
									<img src="../../assets/images/backgrounds/majestic_mountain_landscape_in_hooker_valley_new_zealand.jpeg"
										alt="">
									<button type="button">
										<i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Hooker Valley</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span
													class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Hooker Valley</h2>
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
						<div class="arrow__container">
							<button type="button"><i class="fa-solid fa-arrow-right"></i></button>
						</div>
					</div>
				</div>
				<!-- Lake Walks -->
				<div data-access="true">
					<h2 class="genre"><i class="fa-solid fa-water"></i> Lake Walks</h2>
					<div class="video__section-content">
						<div class="arrow__container">
							<button type="button"><i class="fa-solid fa-arrow-left"></i></button>
						</div>
						<!-- Video Cards -->
						<div class="cards">
							<!-- Card #1 -->
							<div>
								<div class="poster">
									<img src="../../assets/images/backgrounds/landscape_photograph_of_snowcap_mountains.jpeg"
										alt="">
									<button type="button">
										<i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Snowcap Mountains</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span
													class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Snowcap Mountains</h2>
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
									<img src="../../assets/images/backgrounds/gorsa_bridge_en_norvege_vue_de_drone_chute_d_eau_montagne_pont.jpg"
										alt="">
									<button type="button">
										<i class="fa-regular fa-circle-play"></i>
									</button>
								</div>
								<div class="context">
									<h3>Gorsa Bridge</h3>
									<ul>
										<li><small><i class='fa-solid fa-location-dot'></i> New Zealand</small></li>
										<li><small><i class='fa-solid fa-hourglass-start'></i> 15 Minutes</small>
										</li>
										<li><small><i class='fa-solid fa-image'></i> <span
													class='quality'>HD</span></small></li>
									</ul>
									<button type="button" onclick="initModal(this, 'previewModal', `
                                            <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                                                <source src='../../assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4' type='video/mp4'></source>
                                            </video>  
                                            <div class='video-info'>
                                                <div>
                                                    <h2>Gorsa Bridge</h2>
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
						<div class="arrow__container">
							<button type="button"><i class="fa-solid fa-arrow-right"></i></button>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>