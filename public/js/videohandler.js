/**
 * Enhanced Video Player Implementation
 * Features:
 * - Fullscreen video playback with custom controls
 * - Modal video player with persistent state
 * - Keyboard shortcuts for playback control
 * - Seamless transition between fullscreen and modal views
 * - Responsive design and accessibility improvements
 */

const VideoStateManager = {
    createState() {
        return {
            currentTime: 0,
            isPaused: false,
            volume: 1,
            playbackRate: 1
        };
    },

    updateFromPlayer(state, player) {
        if (!player || typeof player.currentTime !== 'function') return state;

        try {
            state.currentTime = player.currentTime();
            state.isPaused = player.paused();
            state.volume = player.volume();
            state.playbackRate = player.playbackRate();
        } catch (e) {
            console.warn('Error updating state:', e);
        }
        return state;
    },

    applyToPlayer(state, player) {
        if (!player || typeof player.currentTime !== 'function') return;

        try {
            player.currentTime(state.currentTime);
            player.volume(state.volume);
            player.playbackRate(state.playbackRate);

            if (state.isPaused) {
                player.pause();
            } else {
                player.play().catch(err => console.warn('Auto-play prevented:', err));
            }
        } catch (e) {
            console.warn('Error applying state:', e);
        }
    }
};

const FullscreenUtils = {
    async request(element) {
        return new Promise((resolve, reject) => {
            if (!element.isConnected) {
                reject(new Error('Element must be connected to the DOM before requesting fullscreen'));
                return;
            }

            try {
                let requestPromise;
                if (element.requestFullscreen) {
                    requestPromise = element.requestFullscreen();
                } else if (element.webkitRequestFullscreen) {
                    requestPromise = element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) {
                    requestPromise = element.msRequestFullscreen();
                }

                if (requestPromise) {
                    requestPromise.then(resolve).catch(reject);
                } else {
                    reject(new Error('Fullscreen API not supported'));
                }
            } catch (error) {
                console.error('Fullscreen request failed:', error);
                reject(error);
            }
        });
    },

    exit() {
        try {
            if (document.exitFullscreen) {
                return document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                return document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                return document.msExitFullscreen();
            }
        } catch (error) {
            console.error('Exit fullscreen failed:', error);
        }
    },

    isFullscreen() {
        return !!(document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.msFullscreenElement);
    },

    onChange(callback) {
        ['fullscreenchange', 'webkitfullscreenchange', 'MSFullscreenChange'].forEach(event => {
            document.addEventListener(event, callback);
        });

        return () => {
            ['fullscreenchange', 'webkitfullscreenchange', 'MSFullscreenChange'].forEach(event => {
                document.removeEventListener(event, callback);
            });
        };
    }
};

const PlayerConfig = {
    getFullscreenConfig() {
        return {
            controls: true,
            fullscreen: {
                enabled: true,
                fallback: true
            },
            autoplay: true,
            fluid: false,
            fill: true,
            responsive: true,
            preload: 'auto',
            disablePictureInPicture: true,
            controlBar: {
                pictureInPictureToggle: false,
                fullscreenToggle: true,
                children: [
                    'playToggle',
                    'volumePanel',
                    'currentTimeDisplay',
                    'timeDivider',
                    'durationDisplay',
                    'progressControl',
                    'playbackRateMenuButton',
                    'fullscreenToggle'
                ]
            }
        };
    },

    getModalConfig() {
        return {
            autoplay: false,
            controls: true,
            fluid: false,
            muted: false,
            playsInline: true,
            disablePictureInPicture: true,
            preload: 'auto',
            controlBar: {
                pictureInPictureToggle: false,
                children: [
                    'playToggle',
                    'volumePanel',
                    'currentTimeDisplay',
                    'timeDivider',
                    'durationDisplay',
                    'progressControl',
                    'playbackRateMenuButton',
                    'fullscreenToggle'
                ]
            }
        };
    }
};

const PathResolver = {
    isPhpPage() {
        return window.location.pathname.includes('/php/');
    },

    getVideoPath(path) {
        const basePath = path.replace(/^(\.\.\/)*/, '');
        if (this.isPhpPage()) {
            return '../../' + basePath;
        }
        return basePath;
    }
};

const VideoRegistry = {
    videos: {
        'assets/videos/glen_coe.mp4': {
            title: 'Glen Coe',
            location: 'Scotland',
            duration: '7 Seconds',
            quality: 'HD',
            description: 'Hidden within the rugged heart of the Scottish Highlands, Glen Coe is a breathtaking valley where nature\'s drama unfolds in towering peaks and misty trails. Steeped in history and mystery, it\'s a place where ancient legends whisper through the winds and cinematic landscapes pull you into their untamed beauty. Whether bathed in golden light or cloaked in mist, Glen Coe is pure magic—an awe-inspiring spectacle you have to see to believe. Watch the video and immerse yourself in its haunting, majestic allure.'
        },
        'assets/videos/mountain_range_with_lake.mp4': {
            title: 'Mountain Range Lake',
            location: 'N/A',
            duration: '14 Seconds',
            quality: 'HD',
            description: 'A solitary giant rises, kissed by golden sunlight, its peaks crowned with drifting veils of cloud. Below, emerald meadows sway, dotted with wildflowers that exhale whispers of fragrance into the crisp, pine-scented air. A crystalline river hums its lullaby, threading through the valley like liquid silver. Birds glide, their melodies stitching the sky with soft serenity. Here, amid nature\'s embrace, time dissolves, and the soul breathes freely—weightless, calm, whole.Let the mountain\'s quiet grandeur enfold you. Let its stillness speak.'
        },
        'assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4': {
            title: 'Sun Peek Forest',
            location: 'N/A',
            duration: '17 Seconds',
            quality: 'HD',
            description: 'Witness the ethereal dance of sunlight filtering through ancient forest canopies, creating a mesmerizing display of light and shadow. As golden rays pierce through towering trees, they paint the forest floor in a warm, dappled glow, inviting you into a moment of pure tranquility. This peaceful scene captures nature\'s simple yet profound ability to create moments of wonder and serenity.'
        },
    },

    getVideoInfo(src) {
        const basePath = src.replace(/^(\.\.\/)*/, '');

        if (this.videos[basePath]) {
            return this.videos[basePath];
        }

        return {
            title: 'Video',
            location: 'Location',
            duration: 'Unknown',
            quality: 'SD',
            description: 'No description available.'
        };
    }
};

function showInfoModal(videoSrc, videoInfo, videoState) {
    const src = PathResolver.getVideoPath(videoSrc);

    initModal(null, 'previewModal popularVideoFull', `
      <video id='digital-dash-player' class='video-js vjs-theme-forest'>
        <source src='${src}' type='video/mp4'></source>
      </video>  
      <div class='video-info'>
        <div>
          <h2>${videoInfo.title}</h2>
          <ul>
            <li><small><i class='fa-solid fa-location-dot'></i> ${videoInfo.location}</small></li>
            <li><small><i class='fa-solid fa-hourglass-start'></i> ${videoInfo.duration}</small></li>
            <li><small><i class='fa-solid fa-image'></i> <span class='quality'>${videoInfo.quality}</span></small></li>
          </ul>    
        </div>
        <p>${videoInfo.description}</p>
      </div>
    `);

    setTimeout(() => {
        const modalPlayer = videojs('digital-dash-player');
        VideoStateManager.applyToPlayer(videoState, modalPlayer);
    }, 100);
}

document.addEventListener('DOMContentLoaded', () => {
    window.playFullscreenVideo = async function (videoSrc, customData = null) {
        console.log('🎬 Starting fullscreen video:', videoSrc);

        const src = PathResolver.getVideoPath(videoSrc);
        const videoInfo = customData || VideoRegistry.getVideoInfo(videoSrc);

        const container = document.createElement('div');
        container.style.cssText = 'position:fixed;top:0;left:0;width:100vw;height:100vh;background-color:black;z-index:9999;display:flex;align-items:center;justify-content:center;';
        container.setAttribute('role', 'dialog');
        container.setAttribute('aria-label', 'Video Player');

        const videoElement = document.createElement('video');
        videoElement.className = 'video-js vjs-theme-forest';
        videoElement.id = 'fullscreen-player';
        videoElement.style.cssText = 'width:100%;height:100%;';

        const source = document.createElement('source');
        source.src = src;
        source.type = 'video/mp4';

        videoElement.appendChild(source);
        container.appendChild(videoElement);
        document.body.appendChild(container);

        const player = videojs('fullscreen-player', PlayerConfig.getFullscreenConfig());

        const videoState = VideoStateManager.createState();
        videoState.volume = player.volume();
        videoState.videoSrc = videoSrc;
        videoState.videoInfo = videoInfo;

        await new Promise(resolve => {
            player.ready(() => {
                resolve();
            });
        });

        let isCleanedUp = false;

        const cleanup = () => {
            if (isCleanedUp) return;
            console.log('🧹 Starting cleanup...');
            isCleanedUp = true;

            removeFullscreenListener();

            try {
                player.dispose();
            } catch (e) {
                console.warn('Player dispose error:', e);
            }

            container.remove();
            console.log('✅ Cleanup complete');
        };

        player.on('fullscreenchange', () => {
            if (!player.isFullscreen()) {
                console.log('🔘 Exiting fullscreen via toggle...');
                VideoStateManager.updateFromPlayer(videoState, player);
                cleanup();
                showInfoModal(videoSrc, videoInfo, videoState);
            }
        });

        try {
            await FullscreenUtils.request(player.el());
            console.log('📺 Fullscreen requested successfully');

            if (!player.isFullscreen()) {
                player.requestFullscreen();
            }
        } catch (error) {
            console.warn('Fullscreen request failed:', error);
            showInfoModal(videoSrc, videoInfo, videoState);
            cleanup();
            return;
        }

        ['play', 'pause', 'timeupdate', 'volumechange', 'ratechange'].forEach(event => {
            player.on(event, () => VideoStateManager.updateFromPlayer(videoState, player));
        });

        const removeFullscreenListener = FullscreenUtils.onChange(() => {
            console.log('📺 Fullscreen change detected. Current state:', FullscreenUtils.isFullscreen());
            if (!FullscreenUtils.isFullscreen() && !isCleanedUp) {
                console.log('📺 Exited fullscreen, transitioning to modal...');
                VideoStateManager.updateFromPlayer(videoState, player);
                cleanup();
                console.log('📺 About to show modal...');
                showInfoModal(videoSrc, videoInfo, videoState);
            }
        });

        console.log('📺 Fullscreen listener added');
    };
});

document.addEventListener('modalOpened', function () {
    console.log('🎭 Modal opened event fired');

    const playerId = 'digital-dash-player';

    try {
        videojs.getPlayer(playerId)?.dispose();
    } catch (e) {
        console.warn('Error disposing player:', e);
    }

    if (!document.querySelector(`#${playerId}`)) {
        console.log('🎭 No modal player element found, exiting');
        return;
    }

    console.log('🎭 Creating modal player');
    const player = videojs(playerId, PlayerConfig.getModalConfig());

    player.ready(function () {
        console.log('🎭 Modal player ready');

        player.el().querySelectorAll('.vjs-control-bar button').forEach(button => {
            button.setAttribute('tabindex', '0');
            button.addEventListener('click', () => {
                setTimeout(() => button.blur(), 100);
            }, true);
        });

        const bigPlayButton = player.el().querySelector('.vjs-big-play-button');
        if (bigPlayButton) {
            bigPlayButton.addEventListener('click', async () => {
                try {
                    await player.play();
                } catch (err) {
                    console.warn('Video playback failed:', err);
                }
            });
        }

        const video = player.el().querySelector('video');
        if (video) {
            video.addEventListener('click', () => {
                if (player.paused()) {
                    player.play();
                } else {
                    player.pause();
                }
            });
        }
    });
});

document.addEventListener('modalClosed', function () {
    console.log('🎭 Modal closed event fired');

    const playerId = 'digital-dash-player';
    const playerInstance = videojs.getPlayer(playerId);

    if (playerInstance) {
        console.log('🧹 Disposing modal player');
        try {
            playerInstance.dispose();
        } catch (err) {
            console.warn('❌ Error disposing modal player:', err);
        }
    }
});