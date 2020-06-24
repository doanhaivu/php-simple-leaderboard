# php-simple-leaderboard

Simple APIs written in PHP, interacting with a NoSQL database (using memcached client)
Has the following operations:
- Get timestamp
- Post a transaction with SHA-1 hash verificatiton
- Get an user's transactions stats
- Post an user's score to the leaderboard, support multiple leaderboard
- Get a leaderboard data with offset and limit
- Save user data
- Load user data

Further work to handle concurrent update to the leaderboard
