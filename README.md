# Nathan RPGLogs Exercise

This is the take-home coding exercise for the RPGLogs Full Stack Developer interview as completed by me, Nathan Ogden.
For this exercise I choose to source my data from FFLogs as opposed to WarcraftLogs as I'm intimately familar with FFLogs.

This was my first time using Laravel so that slowed me down a little bit. I am however very familar and comfortable with Symfony and there were quite a few similarities, both of them are MVC frameworks afterall.

I used MySQL and Redis with this application because they would likely have been used in a real world scenario where scalability is important. If I was creating this as a small personal project I would have went with Sqlite for the database and possibly just file system level caching.


## Run Locally With Docker + Platform.CC

For local development I use a tool I built called Platform.CC. All the nessacary files have been included to run this application with Platform.CC.

1. Run `curl -L -s https://platform.cc/releases/install.sh | bash /dev/stdin`
2. Run `~/.pcc/pcc var:set env:RPGLOGS_KEY {your api key here}` , replace `{your api key here}` with your RPGLogs API key.
3. Run `~/.pcc/pcc p:start`
4. Navigate to `http://rpglogs-exercise-ogden-tech.platform.cc/` in your browser.
5. When you are done you can run `~/.pcc/pcc all:purge` to stop the containers and delete all data.


## Online Demo

Additionally I am hosting a demo on this application at https://rpglogs-exercise.ogden.tech.


## Relevant Code

A lot of this repo contains Laravel boilerplate code and isn't very relevant to this exercise. Here is a list of directories and files that contain the relevant code.

- resources/js/
- resources/scss/
- app/Connectors
- app/Console/Commands
- app/Http/Controllers
- app/Models/CharacterParseFetchHistory.php
- app/Providers/AppServiceProvider.php


## Extra Features Of Note

Features that were't part of the original spec...

- Display character avatar via fetch from FFXIV Lodestone site. (This however is very slow and makes fetches slow.)
- Displays list of previous fetched character parses using database.
- Use Redis to cache parses and character avatar.
- Small touches here and there, random names displayed in placeholder of fetch form, etc.


## Missing Features

Features/things I would have added if I had more time...

- Ability to use the browser's back/foward buttons to load previous queries.
- Ability to access character parses via sharable URL.
- Paginate character parse list.
- Display more information about the character (stats, gear, etc) (this data wasn't available via the FFLogs API).
- Limit previous queries to one entry per character+server combination.
- Fix display of data for mobile, hide/shrink less relevant data so that most relevant data can remain prominent.
- Better error handling.
- General beautifcation, cool animations, etc.
- Clean up of unneeded boilerplate code.