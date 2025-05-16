/**
 * Initializes video player functionality with fullscreen and modal support.
 * Handles video playback controls, state management, and UI interactions.
 * Uses Video.js for player implementation with custom theme and controls.
 */
document.addEventListener('DOMContentLoaded', function() {
    window.playFullscreenVideo = function(videoSrc) {
        const container = document.createElement('div');
        container.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background-color:black;z-index:9999;';
    
        const videoElement = document.createElement('video');
        videoElement.className = 'video-js vjs-theme-forest';
        videoElement.id = 'fullscreen-player';
        
        const source = document.createElement('source');
        source.src = videoSrc;
        source.type = 'video/mp4';
        
        videoElement.appendChild(source);
        container.appendChild(videoElement);
        document.body.appendChild(container);
    
        const player = videojs('fullscreen-player', {
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
        });
    
        const videoState = {
            currentTime: 0,
            isPaused: false,
            volume: player.volume(),
            playbackRate: player.playbackRate()
        };
    
        const requestFullscreen = () => {
            try {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) {
                    container.msRequestFullscreen();
                }
            } catch (error) {
                console.error('Fullscreen request failed:', error);
            }
        };
    
        requestFullscreen();

        player.ready(() => {
            const fullscreenToggle = player.controlBar.fullscreenToggle.el();
            fullscreenToggle.onclick = () => {
                if (document.fullscreenElement) {
                    document.exitFullscreen?.() || 
                    document.webkitExitFullscreen?.() || 
                    document.msExitFullscreen?.();
                    updateVideoState();
                    cleanup();
                    showInfoModal();
                } else {
                    requestFullscreen();
                }
            };

            const playToggle = player.controlBar.playToggle.el();
            playToggle.onclick = () => {
                player[player.paused() ? 'play' : 'pause']();
                updateVideoState();
            };

            const volumePanel = player.controlBar.volumePanel.el();
            volumePanel.onclick = () => {
                updateVideoState();
            };

            const playbackRateMenu = player.controlBar.playbackRateMenuButton.el();
            playbackRateMenu.onclick = () => {
                updateVideoState();
            };
        });
    
        const handleKeyPress = (e) => {
            if (!document.fullscreenElement) return;
            
            if (e.code === 'Space') {
                e.preventDefault();
                player[player.paused() ? 'play' : 'pause']();
                updateVideoState();
            } else if (e.code === 'KeyF') {
                e.preventDefault();
                document.exitFullscreen?.() || 
                document.webkitExitFullscreen?.() || 
                document.msExitFullscreen?.();
            } else if (e.code === 'ArrowUp') {
                e.preventDefault();
                player.volume(Math.min(player.volume() + 0.1, 1));
                updateVideoState();
            } else if (e.code === 'ArrowDown') {
                e.preventDefault();
                player.volume(Math.max(player.volume() - 0.1, 0));
                updateVideoState();
            }
        };
    
        document.addEventListener('keydown', handleKeyPress);
    
        const updateVideoState = () => {
            videoState.currentTime = player.currentTime();
            videoState.isPaused = player.paused();
            videoState.volume = player.volume();
            videoState.playbackRate = player.playbackRate();
        };
    
        ['play', 'pause', 'timeupdate', 'volumechange', 'ratechange'].forEach(event => {
            player.on(event, updateVideoState);
        });
    
        const exitHandler = () => {
            if (document.fullscreenElement || document.webkitIsFullScreen || document.msFullscreenElement) return;
    
            updateVideoState();
            cleanup();
            showInfoModal();
        };
    
        const cleanup = () => {
            document.removeEventListener('keydown', handleKeyPress);
            player.dispose();
            container.remove();
            ['fullscreenchange', 'webkitfullscreenchange', 'MSFullscreenChange'].forEach(event => {
                document.removeEventListener(event, exitHandler);
            });
        };
    
        const showInfoModal = () => {
            initModal(null, 'previewModal popularVideoFull', `
                <video id='digital-dash-player' class='video-js vjs-theme-forest'>
                    <source src='${videoSrc}' type='video/mp4'></source>
                </video>  
                <div class='video-info'>
                    <div>
                        <h2>Glen Coe</h2>
                        <ul>
                            <li><small><i class='fa-solid fa-location-dot'></i> Scotland</small></li>
                            <li><small><i class='fa-solid fa-hourglass-start'></i> 17 Seconds</small></li>
                            <li><small><i class='fa-solid fa-image'></i> <span class='quality'>HD</span></small></li>
                        <ul>    
                    </div>
                    <p>Hidden within the rugged heart of the Scottish Highlands, Glen Coe is a breathtaking valley where nature's drama unfolds in towering peaks and misty trails. Steeped in history and mystery, it's a place where ancient legends whisper through the winds and cinematic landscapes pull you into their untamed beauty. Whether bathed in golden light or cloaked in mist, Glen Coe is pure magic—an awe-inspiring spectacle you have to see to believe. Watch the video and immerse yourself in its haunting, majestic allure.</p>
                </div>
            `);
    
            setTimeout(() => {
                const modalPlayer = videojs('digital-dash-player');
                modalPlayer.currentTime(videoState.currentTime);
                modalPlayer.volume(videoState.volume);
                modalPlayer.playbackRate(videoState.playbackRate);
                modalPlayer[videoState.isPaused ? 'pause' : 'play']();
            }, 100);
        };
    
        ['fullscreenchange', 'webkitfullscreenchange', 'MSFullscreenChange'].forEach(event => {
            document.addEventListener(event, exitHandler);
        });
    };
    
    document.addEventListener('modalOpened', function() {
        const playerId = 'digital-dash-player';
        videojs.getPlayer(playerId)?.dispose();
    
        if (!document.querySelector(`#${playerId}`)) return;
    
        const player = videojs(playerId, {
            autoplay: false,
            controls: true,
            fluid: false,
            muted: true,
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
        });
    
        const videoState = {
            isPaused: true,
            volume: player.volume(),
            playbackRate: player.playbackRate()
        };
    
        let hasPlayed = false;
    
        player.ready(function() {
            player.el().querySelectorAll('.vjs-control-bar button').forEach(button => {
                button.setAttribute('tabindex', '-1');
                button.addEventListener('click', () => {
                    updateVideoState();
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
            fullscreenButton.setAttribute('tabindex', '-1');
            player.on('fullscreenchange', () => {
                videoState.isPaused = player.paused();
                fullscreenButton.blur();
            });
    
            const bigPlayButton = player.el().querySelector('.vjs-big-play-button');
            bigPlayButton.addEventListener('click', () => {
                if (!hasPlayed) {
                    if (!player.isFullscreen()) {
                        player.requestFullscreen();
                    }
                    player.play();
                    videoState.isPaused = false;
                    hasPlayed = true;
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
    
            const handleModalKeyPress = (e) => {
                if (e.code === 'Space') {
                    e.preventDefault();
                    player[player.paused() ? 'play' : 'pause']();
                    updateVideoState();
                } else if (e.code === 'KeyF') {
                    e.preventDefault();
                    player[player.isFullscreen() ? 'exitFullscreen' : 'requestFullscreen']();
                } else if (e.code === 'ArrowUp') {
                    e.preventDefault();
                    player.volume(Math.min(player.volume() + 0.1, 1));
                    updateVideoState();
                } else if (e.code === 'ArrowDown') {
                    e.preventDefault();
                    player.volume(Math.max(player.volume() - 0.1, 0));
                    updateVideoState();
                }
            };
    
            document.addEventListener('keydown', handleModalKeyPress);
            player.on('dispose', () => {
                document.removeEventListener('keydown', handleModalKeyPress);
            });
        });
    });
});