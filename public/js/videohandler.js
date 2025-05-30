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
        state.currentTime = player.currentTime();
        state.isPaused = player.paused();
        state.volume = player.volume();
        state.playbackRate = player.playbackRate();
        return state;
    },

    applyToPlayer(state, player) {
        player.currentTime(state.currentTime);
        player.volume(state.volume);
        player.playbackRate(state.playbackRate);

        if (state.isPaused) {
            player.pause();
        } else {
            player.play().catch(err => console.warn('Auto-play prevented:', err));
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
                    requestPromise
                        .then(resolve)
                        .catch(reject);
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
            fluid: true,
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
        // Strip any existing prefixes first
        const basePath = path.replace(/^(\.\.\/)*/, '');
        if (this.isPhpPage()) {
            // For PHP pages, we need to go up two levels
            return '../../' + basePath;
        }
        // For HTML pages, use the path as is
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
        }, 'assets/videos/mountain_range_with_lake.mp4': {
            title: 'Mountain Range Lake',
            location: 'N/A',
            duration: '14 Seconds',
            quality: 'HD',
            description: 'A solitary giant rises, kissed by golden sunlight, its peaks crowned with drifting veils of cloud. Below, emerald meadows sway, dotted with wildflowers that exhale whispers of fragrance into the crisp, pine-scented air. A crystalline river hums its lullaby, threading through the valley like liquid silver. Birds glide, their melodies stitching the sky with soft serenity. Here, amid nature’s embrace, time dissolves, and the soul breathes freely—weightless, calm, whole. Let the mountain’s quiet grandeur enfold you. Let its stillness speak.'
        }, 'assets/videos/the_rays_of_the_sun_peeking_through_the_tall_trees_of_a_forest.mp4': {
            title: 'Sun Peek Forest',
            location: 'N/A',
            duration: '17 Seconds',
            quality: 'HD',
            description: 'Witness the ethereal dance of sunlight filtering through ancient forest canopies, creating a mesmerizing display of light and shadow. As golden rays pierce through towering trees, they paint the forest floor in a warm, dappled glow, inviting you into a moment of pure tranquility. This peaceful scene captures nature\'s simple yet profound ability to create moments of wonder and serenity.'
        },
    }, getVideoInfo(src) {
        // Strip any existing prefix
        const basePath = src.replace(/^(\.\.\/)*/, '');

        // Try to find the video info using the base path
        if (this.videos[basePath]) {
            return this.videos[basePath];
        }

        // Default fallback
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
    // Get the correct path based on whether we're in a PHP page or HTML page
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
        // Get the correct path based on whether we're in a PHP page or HTML page
        const src = PathResolver.getVideoPath(videoSrc);
        const videoInfo = customData || VideoRegistry.getVideoInfo(videoSrc);

        const container = document.createElement('div');
        container.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background-color:black;z-index:9999;';
        container.setAttribute('role', 'dialog');
        container.setAttribute('aria-label', 'Video Player');

        const videoElement = document.createElement('video');
        videoElement.className = 'video-js vjs-theme-forest';
        videoElement.id = 'fullscreen-player'; const source = document.createElement('source');
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

        try {
            await FullscreenUtils.request(container);
        } catch (error) {
            console.warn('Fullscreen request failed:', error);
            showInfoModal(videoSrc, videoInfo, videoState);
            cleanup();
            return;
        }

        const fullscreenToggle = player.controlBar.fullscreenToggle.el();
        fullscreenToggle.onclick = async () => {
            if (FullscreenUtils.isFullscreen()) {
                await FullscreenUtils.exit();
                VideoStateManager.updateFromPlayer(videoState, player);
                cleanup();
                showInfoModal(videoSrc, videoInfo, videoState);
            } else {
                try {
                    await FullscreenUtils.request(container);
                } catch (error) {
                    console.warn('Fullscreen toggle failed:', error);
                }
            }
        };

        const playToggle = player.controlBar.playToggle.el();
        playToggle.onclick = () => {
            VideoStateManager.updateFromPlayer(videoState, player);
        };

        const volumePanel = player.controlBar.volumePanel.el();
        volumePanel.onclick = () => {
            VideoStateManager.updateFromPlayer(videoState, player);
        };

        const playbackRateMenu = player.controlBar.playbackRateMenuButton.el();
        playbackRateMenu.onclick = () => {
            VideoStateManager.updateFromPlayer(videoState, player);
        };

        const handleKeyPress = (e) => {
            if (!FullscreenUtils.isFullscreen()) return;

            switch (e.code) {
                case 'Space':
                    e.preventDefault();
                    player[player.paused() ? 'play' : 'pause']();
                    VideoStateManager.updateFromPlayer(videoState, player);
                    break;
                case 'KeyF':
                    e.preventDefault();
                    FullscreenUtils.exit();
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    player.volume(Math.min(player.volume() + 0.1, 1));
                    VideoStateManager.updateFromPlayer(videoState, player);
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    player.volume(Math.max(player.volume() - 0.1, 0));
                    VideoStateManager.updateFromPlayer(videoState, player);
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    player.currentTime(player.currentTime() + 5);
                    VideoStateManager.updateFromPlayer(videoState, player);
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    player.currentTime(player.currentTime() - 5);
                    VideoStateManager.updateFromPlayer(videoState, player);
                    break;
                case 'Escape':
                    e.preventDefault();
                    if (FullscreenUtils.isFullscreen()) {
                        FullscreenUtils.exit();
                    }
                    break;
            }
        };

        document.addEventListener('keydown', handleKeyPress);

        ['play', 'pause', 'timeupdate', 'volumechange', 'ratechange'].forEach(event => {
            player.on(event, () => VideoStateManager.updateFromPlayer(videoState, player));
        });

        const removeFullscreenListener = FullscreenUtils.onChange(() => {
            if (!FullscreenUtils.isFullscreen()) {
                VideoStateManager.updateFromPlayer(videoState, player);
                cleanup();
                showInfoModal(videoSrc, videoInfo, videoState);
            }
        });

        const cleanup = () => {
            document.removeEventListener('keydown', handleKeyPress);
            removeFullscreenListener();
            player.dispose();
            container.remove();
        };
    };
});

document.addEventListener('modalOpened', function () {
    const playerId = 'digital-dash-player';

    try {
        videojs.getPlayer(playerId)?.dispose();
    } catch (e) {
        console.warn('Error disposing player:', e);
    }

    if (!document.querySelector(`#${playerId}`)) return;

    const player = videojs(playerId, PlayerConfig.getModalConfig());

    const videoState = {
        isPaused: true,
        volume: player.volume(),
        playbackRate: player.playbackRate()
    };

    let hasPlayed = false;

    player.ready(function () {
        player.el().querySelectorAll('.vjs-control-bar button').forEach(button => {
            button.setAttribute('tabindex', '0');
            button.addEventListener('click', () => {
                videoState.isPaused = player.paused();
                videoState.volume = player.volume();
                videoState.playbackRate = player.playbackRate();
                button.blur();
            });
        });

        const playControl = player.el().querySelector('.vjs-play-control');
        if (playControl) {
            playControl.addEventListener('click', () => {
                videoState.isPaused = player.paused();
                playControl.blur();
            });
        }

        const fullscreenButton = player.controlBar.fullscreenToggle.el();
        fullscreenButton.addEventListener('click', () => {
            fullscreenButton.blur();
        });

        player.on('fullscreenchange', () => {
            videoState.isPaused = player.paused();
        });

        const bigPlayButton = player.el().querySelector('.vjs-big-play-button');
        bigPlayButton.addEventListener('click', async () => {
            if (!hasPlayed) {
                try {
                    if (!player.isFullscreen()) {
                        const playerElement = player.el();
                        if (playerElement && playerElement.isConnected) {
                            await FullscreenUtils.request(playerElement);
                        }
                    }
                    await player.play();
                    videoState.isPaused = false;
                    hasPlayed = true;
                } catch (err) {
                    console.warn('Video playback or fullscreen request failed:', err);
                }
            }
        });

        player.on('play', () => {
            videoState.isPaused = false;
            hasPlayed = true;
        });

        player.on('pause', () => {
            videoState.isPaused = true;
        });

        const updateVideoState = () => {
            videoState.isPaused = player.paused();
            videoState.volume = player.volume();
            videoState.playbackRate = player.playbackRate();
        };

        player.el().querySelector('video').addEventListener('click', () => {
            if (hasPlayed) {
                player[player.paused() ? 'play' : 'pause']();
                updateVideoState();
            }
        });

        const handleModalKeyPress = async (e) => {
            switch (e.code) {
                case 'Space':
                    e.preventDefault();
                    player[player.paused() ? 'play' : 'pause']();
                    updateVideoState();
                    break;
                case 'KeyF':
                    e.preventDefault();
                    try {
                        const playerElement = player.el();
                        if (playerElement && playerElement.isConnected) {
                            if (player.isFullscreen()) {
                                await FullscreenUtils.exit();
                            } else {
                                await FullscreenUtils.request(playerElement);
                            }
                        }
                    } catch (error) {
                        console.warn('Fullscreen toggle failed:', error);
                    }
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    player.volume(Math.min(player.volume() + 0.1, 1));
                    updateVideoState();
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    player.volume(Math.max(player.volume() - 0.1, 0));
                    updateVideoState();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    player.currentTime(player.currentTime() + 5);
                    updateVideoState();
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    player.currentTime(player.currentTime() - 5);
                    updateVideoState();
                    break;
            }
        };

        document.addEventListener('keydown', handleModalKeyPress);

        player.on('dispose', () => {
            document.removeEventListener('keydown', handleModalKeyPress);
        });
    });
});