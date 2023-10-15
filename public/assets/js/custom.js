<script>
  const videoFrame = document.getElementById('videoFrame');
  const playButton = document.getElementById('playButton');

  playButton.addEventListener('click', function () {
    videoFrame.src = 'assets/video/video.mp4'; // Replace 'https://www.example.com/video-url' with your video URL
    playButton.style.display = 'none';
  });
</script>
