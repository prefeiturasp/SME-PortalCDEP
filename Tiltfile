docker_compose('docker-compose.yml')
docker_build('wordpress/cdep', '.',
  live_update = [
    sync('.', '/var/www/html/cdep')
  ])